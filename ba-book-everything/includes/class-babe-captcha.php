<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

BABE_Captcha::init();

/**
 * BABE_Captcha Class.
 * Handles captcha/bot protection: Google reCAPTCHA v3 and Cloudflare Turnstile.
 *
 * @class   BABE_Captcha
 * @version 1.0.0
 * @author  Booking Algorithms
 */
class BABE_Captcha {

	const GOOGLE_RECAPTCHA_BASE = 'https://www.google.com/recaptcha/';
	const TURNSTILE_BASE        = 'https://challenges.cloudflare.com/turnstile/v0/';

	///////////////////////////////////////

	public static function init() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ), 15 );
		add_filter( 'babe_get_register_form', array( __CLASS__, 'add_token_field' ) );
		add_action( 'template_redirect', array( __CLASS__, 'validate' ), 5 );
	}

	///////////////////////////////////////

	protected static function get_captcha_type(): string {
		return BABE_Settings::get_option( 'captcha_type', 'disabled' );
	}

	protected static function is_target_page(): bool {
		global $post;
		return ! is_user_logged_in()
		&& is_singular()
		&& $post->ID === (int) ( BABE_Settings::$settings['my_account_page'] ?? 0 );	
	}

	///////////////////////////////////////

	public static function enqueue_scripts() {

		if ( ! self::is_target_page() ) {
			return;
		}

		$type = self::get_captcha_type();

		if ( $type === 'google' ) {

			$site_key = BABE_Settings::get_option( 'recaptcha_site_key', '' );
			if ( $site_key ) {
				wp_enqueue_script(
					'babe-google-recaptcha-v3',
					self::GOOGLE_RECAPTCHA_BASE . 'api.js?render=' . urlencode( $site_key ),
					[],
					null,
					true
				);
			}
		} elseif ( $type === 'turnstile' ) {

			$site_key = BABE_Settings::get_option( 'turnstile_site_key', '' );
			if ( $site_key ) {
				wp_enqueue_script(
					'babe-cf-turnstile',
					self::TURNSTILE_BASE . 'api.js?render=explicit',
					[],
					null,
					true
				);
			}
		}

		self::inline_script();
	}

	///////////////////////////////////////

	public static function add_token_field( string $output ): string {

		$type = self::get_captcha_type();

		if ( $type === 'disabled' ) {
			return $output;
		}

		if ( $type === 'turnstile' ) {
			$site_key = BABE_Settings::get_option( 'turnstile_site_key', '' );
			$widget   = $site_key
				? '<div id="babe_turnstile_widget" data-sitekey="' . esc_attr( $site_key ) . '"></div>'
				: '';
			$field    = $widget . '<input type="hidden" name="babe_captcha_token" id="babe_captcha_token" value="" />';
		} else {
			$field = '<input type="hidden" name="babe_captcha_token" id="babe_captcha_token" value="" />';
		}

		return str_replace( '</form>', $field . '</form>', $output );
	}

	///////////////////////////////////////

	public static function inline_script() {

		$type = self::get_captcha_type();

		if ( $type === 'google' ) {

			$site_key = BABE_Settings::get_option( 'recaptcha_site_key', '' );
			if ( ! $site_key || ! wp_script_is( 'babe-google-recaptcha-v3', 'enqueued' ) ) {
				return;
			}

			wp_add_inline_script( 'babe-google-recaptcha-v3', '
				function babeRefreshCaptchaToken() {
					grecaptcha.ready( function() {
						grecaptcha.execute( ' . wp_json_encode( $site_key ) . ', { action: "register" } ).then( function( token ) {
							var field = document.getElementById( "babe_captcha_token" );
							if ( field ) { field.value = token; }
						} );
					} );
				}
				document.addEventListener( "DOMContentLoaded", function() {
					if ( ! document.getElementById( "babe_captcha_token" ) ) { return; }
					babeRefreshCaptchaToken();
					setInterval( babeRefreshCaptchaToken, 110000 );
				} );
			' );

		} elseif ( $type === 'turnstile' ) {

			$site_key = BABE_Settings::get_option( 'turnstile_site_key', '' );
			if ( ! $site_key || ! wp_script_is( 'babe-cf-turnstile', 'enqueued' ) ) {
				return;
			}

			wp_add_inline_script( 'babe-cf-turnstile', '
				document.addEventListener( "DOMContentLoaded", function() {
					var widget = document.getElementById( "babe_turnstile_widget" );
					if ( ! widget ) { return; }
					turnstile.render( widget, {
						sitekey: ' . wp_json_encode( $site_key ) . ',
						callback: function( token ) {
							var field = document.getElementById( "babe_captcha_token" );
							if ( field ) { field.value = token; }
						}
					} );
				} );
			' );
		}
	}

	///////////////////////////////////////

	public static function validate() {

		if ( self::get_captcha_type() === 'disabled' ) {
			return;
		}

		if (
			! isset( $_GET['action'] )
			|| $_GET['action'] !== 'registration'
			|| ! self::is_target_page()) {
			return;
		}

		error_log( 'babe_recaptcha_validate fired. POST: ' . print_r( $_POST, true ) . ' GET: ' . print_r( $_GET, true ) );

		$token = isset( $_POST['babe_captcha_token'] ) ? $_POST['babe_captcha_token'] : '';

		if ( empty( $token ) ) {
			unset( $_POST['new_username'] );
			return;
		}

		$type = self::get_captcha_type();

		if ( $type === 'google' ) {
			self::validate_google( $token );
		} elseif ( $type === 'turnstile' ) {
			self::validate_turnstile( $token );
		}
	}

	///////////////////////////////////////

	protected static function validate_google( string $token ) {

		$secret = BABE_Settings::get_option( 'recaptcha_secret_key', '' );
		$score  = (float) BABE_Settings::get_option( 'recaptcha_score', 0.5 );

		$response = wp_remote_post( self::GOOGLE_RECAPTCHA_BASE . 'api/siteverify', [
			'body'    => [
				'secret'   => $secret,
				'response' => $token,
				'remoteip' => sanitize_text_field( $_SERVER['REMOTE_ADDR'] ),
			],
			'timeout' => 10,
		] );

		if ( is_wp_error( $response ) ) {
			unset( $_POST['new_username'] );
			return;
		}
		$body = json_decode( wp_remote_retrieve_body( $response ), true );

		error_log( 'reCAPTCHA response: ' . print_r( $body, true ) );

		if ( empty( $body['success'] ) || (float) $body['score'] < $score ) {
			unset( $_POST['new_username'] );
		}
	}

	///////////////////////////////////////

	protected static function validate_turnstile( string $token ) {

		$secret = BABE_Settings::get_option( 'turnstile_secret_key', '' );

		$response = wp_remote_post( self::TURNSTILE_BASE . 'siteverify', [
			'body'    => [
				'secret'   => $secret,
				'response' => $token,
				'remoteip' => sanitize_text_field( $_SERVER['REMOTE_ADDR'] ),
			],
			'timeout' => 10,
		] );

		if ( is_wp_error( $response ) ) {
			unset( $_POST['new_username'] );
			return;
		}

		$body = json_decode( wp_remote_retrieve_body( $response ), true );

		error_log( 'turnstile response: ' . print_r( $body, true ) );

		if ( empty( $body['success'] ) ) {
			unset( $_POST['new_username'] );
		}
	}

	///////////////////////////////////////
}
