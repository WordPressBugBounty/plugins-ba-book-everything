<?php

if (!defined('ABSPATH')) {
    exit;
}

BABE_Features::init();

class BABE_Features
{

    public const BA_ADDON_PRODUCT_PAGE_BASE_URL = 'https://ba-booking.com/shop/downloads/';
    public const BA_ADDON_PRODUCT_PAGE_DEFAULT = 'https://ba-booking.com/shop/';
    public const BA_ADDON_DOC_PAGE_BASE_URL = 'https://ba-booking.com/ba-book-everything-docs';
    public const BA_ADDON_DOC_PAGE_DEFAULT = 'https://ba-booking.com/ba-book-everything-docs';

    public const BA_ADDON_NAMES = [
        'babe-payment-pack' => 'BABE Payment pack',
        'babe-backoffice' => 'BABE Backoffice',
        'babe-backoffice-email' => 'BABE Backoffice',
        'babe-backoffice-ical' => 'BABE Backoffice',
        'babe-backoffice-order' => 'BABE Backoffice',
        'babe-backoffice-calendar' => 'BABE Backoffice',
        'babe-backoffice-sales' => 'BABE Backoffice',
        'babe-currency-switcher' => 'BABE Currency switcher',
        'babe-marketplace' => 'BABE Marketplace',
        'babe-payment-banktransfer' => 'BABE Payment Bank transfer',
        'babe-payment-razorpay' => 'BABE Payment Razorpay',
        'babe-payment-wompi' => 'BABE Payment Wompi',
        'babe-payment-mercado' => 'BABE Payment Mercado',
        'babe-payment-pesapal' => 'BABE Payment Pesapal',
        'babe-payment-ifthenpay' => 'BABE Payment IfthenPay',
        'babe-payment-onepay' => 'BABE Payment Onepay',
        'babe-payment-redsys' => 'BABE Payment Redsys',
        'babe-payment-cashfree' => 'BABE Payment Cashfree',
    ];

    public const BA_ADDON_PRODUCT_PAGES = [
        'babe-payment-pack' => '/ba-book-everything-payment_pack/',
        'babe-backoffice' => '/babe-backoffice/',
        'babe-backoffice-email' => '/babe-backoffice/',
        'babe-backoffice-ical' => '/babe-backoffice/',
        'babe-backoffice-order' => '/babe-backoffice/',
        'babe-backoffice-calendar' => '/babe-backoffice/',
        'babe-backoffice-sales' => '/babe-backoffice/',
        'babe-currency-switcher' => '/babe-currency-switcher/',
        'babe-marketplace' => '/babe-marketplace/',
        'babe-payment-banktransfer' => '/babe-payment-bank-transfer/',
        'babe-payment-razorpay' => '/babe-payment-razorpay/',
        'babe-payment-wompi' => '/babe-payment-wompi/',
        'babe-payment-mercado' => '/babe-payment-mercado/',
        'babe-payment-pesapal' => '/babe-payment-pesapal/',
        'babe-payment-ifthenpay' => '/babe-payment-ifthenpay/',
        'babe-payment-onepay' => '/babe-payment-onepay/',
        'babe-payment-redsys' => '/babe-payment-redsys/',
        'babe-payment-cashfree' => '/babe-payment-cashfree/',
    ];

    public const BA_ADDON_DOC_PAGES = [
        'babe-backoffice' => '/babe-backoffice',
        'babe-backoffice-email' => '/babe-backoffice/order-emails-and-routes',
        'babe-backoffice-ical' => '/babe-backoffice/ical-synchronization',
        'babe-backoffice-order' => '/babe-backoffice/order-emails-and-routes#order-statuses-actions--routes',
        'babe-backoffice-calendar' => '/babe-backoffice/backoffice-calendar',
        'babe-backoffice-sales' => '/babe-backoffice/sales-report',
        'babe-currency-switcher' => '/babe-currency-switcher',
        'babe-marketplace' => '/babe-marketplace/',
    ];

    private static array $more_gateways = [];

    public static function init()
    {

        if (!is_plugin_active('babe-payment-pack/babe-payment-pack.php')) {

            self::$more_gateways['paypal'] = 'PayPal';
            self::$more_gateways['stripe'] = 'Stripe';

            add_action('babe_settings_after_payment_fields', array(__CLASS__, 'add_payment_pack_settings'), 20, 2);
        }

        if (!is_plugin_active('babe-payment-banktransfer/bootstrap.php')) {

            self::$more_gateways['banktransfer'] = 'Direct bank transfer';

            add_action('babe_settings_after_payment_fields', array(__CLASS__, 'add_payment_banktransfer_settings'), 20, 2);
        }

        if (!is_plugin_active('babe-payment-razorpay/bootstrap.php')) {

            self::$more_gateways['razorpay'] = 'Razorpay';

            add_action('babe_settings_after_payment_fields', array(__CLASS__, 'add_payment_razorpay_settings'), 20, 2);
        }

        if ( !is_plugin_active('babe-payment-wompi/bootstrap.php') ) {

            self::$more_gateways['wompi'] = 'Wompi';

            add_action('babe_settings_after_payment_fields', array(__CLASS__, 'add_payment_wompi_settings'), 20, 2);
        }

        if ( !is_plugin_active('babe-payment-mercado/bootstrap.php') ) {

            self::$more_gateways['mercado'] = 'Mercado';

            add_action('babe_settings_after_payment_fields', array(__CLASS__, 'add_payment_mercado_settings'), 20, 2);
        }

        if ( !is_plugin_active('babe-payment-pesapal/bootstrap.php') ) {

            self::$more_gateways['pesapal'] = 'Pesapal';

            add_action('babe_settings_after_payment_fields', array(__CLASS__, 'add_payment_pesapal_settings'), 20, 2);
        }

        if ( !is_plugin_active('babe-payment-ifthenpay/bootstrap.php') ) {

            self::$more_gateways['ifthenpay'] = 'IfthenPay';

            add_action('babe_settings_after_payment_fields', array(__CLASS__, 'add_payment_ifthenpay_settings'), 20, 2);
        }

        if ( !is_plugin_active('babe-payment-onepay/bootstrap.php') ) {

            self::$more_gateways['onepay'] = 'Onepay';

            add_action('babe_settings_after_payment_fields', array(__CLASS__, 'add_payment_onepay_settings'), 20, 2);
        }

        if ( !is_plugin_active('babe-payment-redsys/bootstrap.php') ) {

            self::$more_gateways['redsys'] = 'Redsys';

            add_action('babe_settings_after_payment_fields', array(__CLASS__, 'add_payment_redsys_settings'), 20, 2);
        }

        if ( !is_plugin_active('babe-payment-cashfree/babe-payment-cashfree.php') ) {

            self::$more_gateways['cashfree'] = 'Cashfree';

            add_action('babe_settings_after_payment_fields', array(__CLASS__, 'add_payment_cashfree_settings'), 20, 2);
        }

        if (!empty(self::$more_gateways)) {
            add_action('babe_settings_after_payment_fields', array(__CLASS__, 'add_payment_more_tabs'), 15, 2);
        }

        if (!is_plugin_active('babe-backoffice/babe-backoffice.php')) {
            add_action('babe_settings_after_order_fields', array(__CLASS__, 'add_backoffice_refund_settings'), 20, 2);
            add_action('babe_settings_after_email_fields', array(__CLASS__, 'add_backoffice_invoice_settings'), 20, 2);
            add_action('admin_menu', array(__CLASS__, 'add_admin_menu_pages_backoffice'), 20);
        }

        if (!is_plugin_active('babe-currency-switcher/babe-currency-switcher.php')) {
            add_action('admin_menu', array(__CLASS__, 'add_admin_menu_page_currency_switcher'), 20);
        }

        if (!is_plugin_active('babe-marketplace/babe-marketplace.php')) {
            add_action('babe_settings_after_order_fields', array(__CLASS__, 'add_marketplace_provider_settings'), 20, 2);
        }
    }

    //////////////////////////

    public static function add_payment_cashfree_settings(
        string $option_menu_slug,
        string $option_name
    ): void
    {
        $section_id = 'setting_section_payment';

        add_settings_field(
            'title_payment_method_demo_cashfree',
            __('Gateway: ', 'ba-book-everything') . 'Cashfree',
            array(__CLASS__, 'unlock_with_addon_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_subtitle tab-target-payment tab-target-payment-inactive tab-target-payment-cashfree',
                'addon' => 'babe-payment-cashfree',
                'section_title' => 'Cashfree',
            ]
        );

        add_settings_field(
            'cashfree_tab_title',
            __('Payment tab title', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-cashfree',
                'option' => 'cashfree_tab_title',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'cashfree_description',
            __('Payment description', 'ba-book-everything'),
            array( __CLASS__, 'textarea_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-cashfree',
                'option' => 'cashfree_description',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'cashfree_sandbox',
            __('Use Cashfree test mode?', 'ba-book-everything'),
            array( __CLASS__, 'is_active_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-cashfree',
                'option' => 'cashfree_sandbox',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'cashfree_live_client_id',
            __('Live Client ID', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-cashfree',
                'option' => 'cashfree_live_client_id',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'cashfree_live_secret_key',
            __('Live Secret key', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-cashfree',
                'option' => 'cashfree_live_secret_key',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'cashfree_test_client_id',
            __('Test Client ID', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-cashfree',
                'option' => 'cashfree_test_client_id',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'cashfree_test_secret_key',
            __('Test Secret key', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-cashfree',
                'option' => 'cashfree_test_secret_key',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'cashfree_url_webhook',
            sprintf(__('IPN Webhook endpoint. It is required to add endpoint into your %1$s and activate events: failed payment, success payment, user dropped payment.', 'ba-book-everything'), '<a href="https://docs.cashfree.com/docs/webhooks" target="_blank">'.__('Cashfree dashboard', 'ba-book-everything').'</a>'),
            array( __CLASS__, 'url_readonly_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-cashfree',
                'option' => 'cashfree_url_webhook',
                'settings_name' => $option_name,
                'gateway' => 'cashfree',
            ]
        );
    }

    public static function add_payment_redsys_settings(
        string $option_menu_slug,
        string $option_name
    ): void
    {
        $section_id = 'setting_section_payment';

        add_settings_field(
            'title_payment_method_demo_redsys',
            __('Gateway: ', 'ba-book-everything') . 'Redsys',
            array(__CLASS__, 'unlock_with_addon_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_subtitle tab-target-payment tab-target-payment-inactive tab-target-payment-redsys',
                'addon' => 'babe-payment-redsys',
                'section_title' => 'Redsys',
            ]
        );

        add_settings_field(
            'redsys_tab_title',
            __('Payment tab title', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-redsys',
                'option' => 'redsys_tab_title',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'redsys_description',
            __('Payment description', 'ba-book-everything'),
            array( __CLASS__, 'textarea_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-redsys',
                'option' => 'redsys_description',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'redsys_sandbox',
            __('Use Redsys sandbox mode?', 'ba-book-everything'),
            array( __CLASS__, 'is_active_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-redsys',
                'option' => 'redsys_sandbox',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
             'redsys_merchant_terminal',
             __('Merchant terminal', 'ba-book-everything'),
             array( __CLASS__, 'text_field_callback' ),
             $option_menu_slug,
             $section_id,
             [
                 'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-redsys',
                 'option' => 'redsys_merchant_terminal',
                 'settings_name' => $option_name,
             ]
        );

        add_settings_field(
             'redsys_merchant_code',
             __('Merchant Number (code)', 'ba-book-everything'),
             array( __CLASS__, 'text_field_callback' ),
             $option_menu_slug,
             $section_id,
             [
                 'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-redsys',
                 'option' => 'redsys_merchant_code',
                 'settings_name' => $option_name,
             ]
        );

        add_settings_field(
             'redsys_secret_key',
             __('Secret Encryption Key', 'ba-book-everything'),
             array( __CLASS__, 'text_field_callback' ),
             $option_menu_slug,
             $section_id,
             [
                 'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-redsys',
                 'option' => 'redsys_secret_key',
                 'settings_name' => $option_name,
             ]
        );
    }

    public static function add_payment_onepay_settings(
        string $option_menu_slug,
        string $option_name
    ): void
    {
        $section_id = 'setting_section_payment';

        add_settings_field(
            'title_payment_method_demo_onepay',
            __('Gateway: ', 'ba-book-everything') . 'Onepay',
            array(__CLASS__, 'unlock_with_addon_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_subtitle tab-target-payment tab-target-payment-inactive tab-target-payment-onepay',
                'addon' => 'babe-payment-onepay',
                'section_title' => 'Onepay',
            ]
        );

        add_settings_field(
            'onepay_tab_title',
            __('Payment tab title', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-onepay',
                'option' => 'onepay_tab_title',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'onepay_description',
            __('Payment description', 'ba-book-everything'),
            array( __CLASS__, 'textarea_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-onepay',
                'option' => 'onepay_description',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'onepay_pay_in_vnd',
            __('Always pay in VND currency', 'ba-book-everything'),
            array( __CLASS__, 'is_active_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-onepay',
                'option' => 'onepay_pay_in_vnd',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'onepay_get_rates_automatically',
            sprintf(__('Get exchange rates automatically as a sell rate from the %1$sVietcombank%2$s', 'ba-book-everything'),
                '<a href="https://portal.vietcombank.com.vn/Usercontrols/TVPortal.TyGia/pXML.aspx" target="_blank">',
                '</a>'
            ),
            array( __CLASS__, 'is_active_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-onepay',
                'option' => 'onepay_get_rates_automatically',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'onepay_exchange_rate',
            __('Exchange rate', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-onepay',
                'option' => 'onepay_exchange_rate',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'onepay_pay_in_vnd_description',
            __('Additional note on exchange rate when paying in VND (use %s as a placeholder to insert the current rate automatically)', 'ba-book-everything'),
            array( __CLASS__, 'textarea_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-onepay',
                'option' => 'onepay_pay_in_vnd_description',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'onepay_sandbox',
            __('Use Onepay in a test mode?', 'ba-book-everything'),
            array( __CLASS__, 'is_active_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-onepay',
                'option' => 'onepay_sandbox', 
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'onepay_live_merchant_id',
            __('Live Merchant id from your Onepay account', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-onepay',
                'option' => 'onepay_live_merchant_id',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'onepay_live_access_code',
            __('Live Access code', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-onepay',
                'option' => 'onepay_live_access_code',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'onepay_live_hash_code',
            __('Live Hash code', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-onepay',
                'option' => 'onepay_live_hash_code',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'onepay_test_merchant_id',
            __('Test Merchant id from your Onepay account', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-onepay',
                'option' => 'onepay_test_merchant_id',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'onepay_test_access_code',
            __('Test Access code', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-onepay',
                'option' => 'onepay_test_access_code',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'onepay_test_hash_code',
            __('Test Hash code', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-onepay',
                'option' => 'onepay_test_hash_code', 
                'settings_name' => $option_name,
            ]
        );
    }

    public static function add_payment_ifthenpay_settings(
        string $option_menu_slug,
        string $option_name
    ): void
    {
        $section_id = 'setting_section_payment';

        add_settings_field(
            'title_payment_method_demo_ifthenpay',
            __('Gateway: ', 'ba-book-everything') . 'IfthenPay',
            array(__CLASS__, 'unlock_with_addon_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_subtitle tab-target-payment tab-target-payment-inactive tab-target-payment-ifthenpay',
                'addon' => 'babe-payment-ifthenpay',
                'section_title' => 'IfthenPay',
            ]
        );

        add_settings_field(
            'ifthenpay_tab_title',
            __('Payment tab title', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-ifthenpay',
                'option' => 'ifthenpay_tab_title',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'ifthenpay_description_general',
            __('Payment description', 'ba-book-everything'),
            array( __CLASS__, 'textarea_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-ifthenpay',
                'option' => 'ifthenpay_description_general',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'ifthenpay_ifthenpay_account_email',
            __('IfthenPay account email', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-ifthenpay',
                'option' => 'ifthenpay_ifthenpay_account_email',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'ifthenpay_debug',
            __('Use debug mode to show error messages?', 'ba-book-everything'),
            array( __CLASS__, 'is_active_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-ifthenpay',
                'option' => 'ifthenpay_debug',
                'settings_name' => $option_name,
            ]
        );

        $option_titles = [
            'payshop' => [
                'active' => __('Activate Payshop payment option', 'ba-book-everything'),
                'key' => __('Payshop key', 'ba-book-everything'),
                'anti_phishing_key' => __('Anti-phishing key', 'ba-book-everything'),
                'title' => __('Payshop option title', 'ba-book-everything'),
                'description' => __('Payshop option description', 'ba-book-everything'),
                'extra_instructions' => __('Payshop extra instructions', 'ba-book-everything'),
            ],
            'multibanco' => [
                'active' => __('Activate Multibanco payment option', 'ba-book-everything'),
                'sandbox' => __('Use Multibanco payments in a test mode?', 'ba-book-everything'),
                'entity' => __('Entity', 'ba-book-everything'),
                'subentity' => __('Subentity', 'ba-book-everything'),
                'anti_phishing_key' => __('Anti-phishing key', 'ba-book-everything'),
                'title' => __('Multibanco option title', 'ba-book-everything'),
                'description' => __('Multibanco option description', 'ba-book-everything'),
                'extra_instructions' => __('Multibanco extra instructions', 'ba-book-everything'),
            ],
            'mbway' => [
                'active' => __('Activate MB WAY payment option', 'ba-book-everything'),
                'key' => __('MB WAY key', 'ba-book-everything'),
                'anti_phishing_key' => __('Anti-phishing key', 'ba-book-everything'),
                'title' => __('MB WAY option title', 'ba-book-everything'),
                'description' => __('MB WAY option description', 'ba-book-everything'),
                'extra_instructions' => __('MB WAY extra instructions', 'ba-book-everything'),
            ],
            'creditcard' => [
                'active' => __('Activate Credit Card payment option', 'ba-book-everything'),
                'key' => __('Credit card key', 'ba-book-everything'),
                'anti_phishing_key' => __('Anti-phishing key', 'ba-book-everything'),
                'title' => __('Credit card option title', 'ba-book-everything'),
                'description' => __('Credit card option description', 'ba-book-everything'),
            ],
        ];

        $payways = [
            'payshop' => [
                'active' => 0,
                'key' => '',
                'anti_phishing_key' => '',
                'title' => __('Payshop', 'ba-book-everything'),
                'description' => __('Easy and simple payment on the “Payshop” agents network, CTT stores or post offices. (Payment service provided by IfthenPay)', 'ba-book-everything'),
                'extra_instructions' => __('Payable at any <a href="https://www.payshop.pt/fepsapl/app/open/showSearchAgent.jspx" target="_blank">Payshop agent</a>, <a href="https://www.ctt.pt/feapl_2/app/open/stationSearch/stationSearch.jspx?request_locale=en" target="_blank">CTT store or post office</a>.', 'ba-book-everything'),
            ],
            'multibanco' => [
                'active' => 0,
                'sandbox' => 0,
                'entity' => '',
                'subentity' => '',
                'anti_phishing_key' => __('Anti-phishing key', 'ba-book-everything'),
                'title' => __('Multibanco', 'ba-book-everything'),
                'description' => __('Easy and simple payment using “Pagamento de Serviços” at any “Multibanco” ATM terminal or your Home Banking service. (Only available to customers of Portuguese banks - Payment service provided by IfthenPay)', 'ba-book-everything'),
                'extra_instructions' => __('The receipt issued by the ATM machine is a proof of payment. Keep it.', 'ba-book-everything'),
            ],
            'mbway' => [
                'active' => 0,
                'key' => '',
                'anti_phishing_key' => '',
                'title' => __('MB WAY', 'ba-book-everything'),
                'description' => __('Easy and simple payment using “MB WAY” on your mobile phone. (Only available for customers of Portuguese banks with MB WAY app installed - Payment service provided by IfthenPay)', 'ba-book-everything'),
                'extra_instructions' => __('Use the MB WAY app on your phone to approve the payment.', 'ba-book-everything'),
            ],
            'creditcard' => [
                'active' => 0,
                'key' => '',
                'anti_phishing_key' => '',
                'title' => __('Credit or debit card', 'ba-book-everything'),
                'description' => __('Easy and simple payment using a Credit or debit card. (Payment service provided by IfthenPay)', 'ba-book-everything'),
            ],
        ];

        foreach ( $payways as $payway => $payway_options ){

            add_settings_field(
                'ifthenpay_'.$payway.'_icon',
                __('Payment method: ', 'ba-book-everything') . $payway_options['title'],
                '__return_false',
                $option_menu_slug,
                $section_id,
                [
                    'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-ifthenpay',
                    'payway'=>$payway,
                ]
            );

            foreach ( $payway_options as $option => $value ){

                $option_name = 'ifthenpay_'.$payway.'_'.$option;
                $callback_function = 'text_field_callback';

                if ( $option === 'active' || $option === 'sandbox' ){
                    $callback_function = 'is_active_callback';
                } elseif ( $option === 'description' || $option === 'extra_instructions' ){
                    $callback_function = 'textarea_callback';
                }

                add_settings_field(
                    $option_name,
                    $option_titles[$payway][$option],
                    array( __CLASS__, $callback_function ),
                    $option_menu_slug,
                    $section_id,
                    array(
                        'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-ifthenpay',
                        'option' => $option_name,
                        'settings_name' => $option_name,
                        'payway'=>$payway,
                        'payway_option'=>$option,
                    )
                );
            }

            if ( $payway === 'creditcard' ){

                add_settings_field(
                    'ifthenpay_creditcard_sandbox',
                    __('Use credit card payments in a test mode?', 'ba-book-everything'),
                    array( __CLASS__, 'is_active_callback' ),
                    $option_menu_slug,
                    $section_id,
                    [
                        'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-ifthenpay',
                        'option' => 'ifthenpay_creditcard_sandbox',
                        'settings_name' => $option_name,
                    ]
                );
            }
        }
    }

    public static function add_payment_pesapal_settings(
        string $option_menu_slug,
        string $option_name
    ): void
    {
        $section_id = 'setting_section_payment';

        add_settings_field(
            'title_payment_method_demo_pesapal',
            __('Gateway: ', 'ba-book-everything') . 'Pesapal',
            array(__CLASS__, 'unlock_with_addon_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_subtitle tab-target-payment tab-target-payment-inactive tab-target-payment-pesapal',
                'addon' => 'babe-payment-pesapal',
                'section_title' => 'Pesapal',
            ]
        );

        add_settings_field(
            'pesapal_tab_title',
            __('Payment tab title', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-pesapal',
                'option' => 'pesapal_tab_title',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'pesapal_description',
            __('Payment description', 'ba-book-everything'),
            array( __CLASS__, 'textarea_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-pesapal',
                'option' => 'pesapal_description',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'pesapal_description_remove_icon',
            __('Remove logo images from description text?', 'ba-book-everything'),
            array( __CLASS__, 'is_active_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-pesapal',
                'option' => 'pesapal_description_remove_icon',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'pesapal_country',
            __('Your country', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-pesapal',
                'option' => 'pesapal_country',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'pesapal_sandbox',
            __('Use Pesapal in a test mode?', 'ba-book-everything'),
            array( __CLASS__, 'is_active_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-pesapal',
                'option' => 'pesapal_sandbox',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'pesapal_debug',
            __('Use debug mode to show error messages?', 'ba-book-everything'),
            array( __CLASS__, 'is_active_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-pesapal',
                'option' => 'pesapal_debug',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'pesapal_live_consumer_key',
            __('Live Consumer Key from business account on www.pesapal.com', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-pesapal',
                'option' => 'pesapal_live_consumer_key',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'pesapal_live_consumer_secret',
            __('Live Secret Key', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-pesapal',
                'option' => 'pesapal_live_consumer_secret',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'pesapal_live_notification_id',
            sprintf(__('%1$sRegister Live IPN Notification ID%2$s and put it here. This will enable you receive notifications upon status change. Use the following URL as your IPN URL: %3$s', 'ba-book-everything'), '<a href="https://pay.pesapal.com/iframe/PesapalIframe3/IpnRegistration" target="_blank">', '</a>', BABE_Payments::get_payment_server_response_page_url('pesapal')),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-pesapal',
                'option' => 'pesapal_live_notification_id', 
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'pesapal_test_consumer_key',
            __('Test Consumer Key from demo business account on demo.pesapal.com', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-pesapal',
                'option' => 'pesapal_test_consumer_key',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'pesapal_test_consumer_secret',
            __('Test Secret Key', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-pesapal',
                'option' => 'pesapal_test_consumer_secret', 
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'pesapal_test_notification_id',
            sprintf(__('%1$sRegister Test IPN Notification ID%2$s and put it here. This will enable you receive notifications upon status change. Use the following URL as your IPN URL: %3$s', 'ba-book-everything'), '<a href="https://cybqa.pesapal.com/PesapalIframe/PesapalIframe3/IpnRegistration" target="_blank">', '</a>', BABE_Payments::get_payment_server_response_page_url('pesapal')),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-pesapal',
                'option' => 'pesapal_test_notification_id',
                'settings_name' => $option_name,
            ]
        );
    }

    public static function add_payment_mercado_settings(
        string $option_menu_slug,
        string $option_name
    ): void
    {
        $section_id = 'setting_section_payment';

        add_settings_field(
            'title_payment_method_demo_mercado',
            __('Gateway: ', 'ba-book-everything') . 'Mercado',
            array(__CLASS__, 'unlock_with_addon_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_subtitle tab-target-payment tab-target-payment-inactive tab-target-payment-mercado',
                'addon' => 'babe-payment-mercado',
                'section_title' => 'Mercado',
            ]
        );

        add_settings_field(
            'mercado_payment_gateway_fee_title',
            __('Payment gateway fee title (optional)', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-mercado',
                'option' => 'mercado_payment_gateway_fee_title',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'mercado_payment_gateway_fee_percents',
            __('Payment gateway fee value, % (optional)', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-mercado',
                'option' => 'mercado_payment_gateway_fee_percents',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'mercado_description',
            __('Payment description ', 'ba-book-everything'),
            array(__CLASS__, 'textarea_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-mercado',
                'option' => 'mercado_description',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'mercado_sandbox',
            __('Use Mercado Pago in a test mode?', 'ba-book-everything'),
            array( __CLASS__, 'is_active_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-mercado',
                'option' => 'mercado_sandbox',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'mercado_test_public_key',
            __('Test Public key', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-mercado',
                'option' => 'mercado_test_public_key',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'mercado_test_access_token',
            __('Test Access token', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-mercado',
                'option' => 'mercado_test_access_token',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'mercado_live_public_key',
            __('Live Public key', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-mercado',
                'option' => 'mercado_live_public_key',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'mercado_live_access_token',
            __('Live Access token', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-mercado',
                'option' => 'mercado_live_access_token',
                'settings_name' => $option_name,
            ]
        );
    }

    public static function add_payment_wompi_settings(
        string $option_menu_slug,
        string $option_name
    ): void
    {
        $section_id = 'setting_section_payment';

        add_settings_field(
            'title_payment_method_demo_wompi',
            __('Gateway: ', 'ba-book-everything') . 'Wompi',
            array(__CLASS__, 'unlock_with_addon_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_subtitle tab-target-payment tab-target-payment-inactive tab-target-payment-wompi',
                'addon' => 'babe-payment-wompi',
                'section_title' => 'Wompi',
            ]
        );

        add_settings_field(
            'wompi_description',
            __('Payment description ', 'ba-book-everything'),
            array(__CLASS__, 'textarea_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-wompi',
                'option' => 'wompi_description',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'wompi_sandbox',
            __('Use Wompi in a test mode?', 'ba-book-everything'),
            array( __CLASS__, 'is_active_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-wompi',
                'option' => 'wompi_sandbox',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'wompi_test_public_key',
            __('Test public key', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-wompi',
                'option' => 'wompi_test_public_key',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'wompi_test_private_key',
            __('Test private key', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-wompi',
                'option' => 'wompi_test_private_key',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'wompi_test_integrity_key',
            __('Test integrity key', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-wompi',
                'option' => 'wompi_test_integrity_key',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'wompi_test_event_secret_key',
            __('Test event secret key', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-wompi',
                'option' => 'wompi_test_event_secret_key',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'wompi_live_public_key',
            __('Live public key', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-wompi',
                'option' => 'wompi_live_public_key',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'wompi_live_private_key',
            __('Live private key', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-wompi',
                'option' => 'wompi_live_private_key',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'wompi_live_integrity_key',
            __('Live integrity key', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-wompi',
                'option' => 'wompi_live_integrity_key',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'wompi_live_event_secret_key',
            __('Live event secret key', 'ba-book-everything'),
            array( __CLASS__, 'text_field_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-wompi',
                'option' => 'wompi_live_event_secret_key',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'wompi_url_webhook',
            __( 'You must add the following webhook endpoint to your <a href="https://comercios.wompi.co/my-account" target="_blank">Wompi account settings</a> for both Production and Sandbox environments.', 'ba-book-everything' ),
            array( __CLASS__, 'url_readonly_callback' ),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-wompi',
                'option' => 'wompi_url_webhook',
                'settings_name' => $option_name,
                'gateway' => 'wompi',
            ]
        );
    }

    public static function add_payment_razorpay_settings(
        string $option_menu_slug,
        string $option_name
    ): void
    {
        $section_id = 'setting_section_payment';

        add_settings_field(
            'title_payment_method_demo_razorpay',
            __('Gateway: ', 'ba-book-everything') . 'Razorpay',
            array(__CLASS__, 'unlock_with_addon_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_subtitle tab-target-payment tab-target-payment-inactive tab-target-payment-razorpay',
                'addon' => 'babe-payment-razorpay',
                'section_title' => 'Razorpay',
            ]
        );

        add_settings_field(
            'razorpay_description',
            __('Payment description ', 'ba-book-everything'),
            array(__CLASS__, 'textarea_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-razorpay',
                'option' => 'razorpay_description',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'razorpay_key_id',
            __('Client key id', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-razorpay',
                'option' => 'razorpay_key_id',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'razorpay_key_secret',
            __('Client key secret', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-razorpay',
                'option' => 'razorpay_key_secret',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'razorpay_webhook_secret',
            __('Webhook secret', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-razorpay',
                'option' => 'razorpay_webhook_secret',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'razorpay_url_webhook',
            sprintf(__('Webhook endpoint. Add it in your Razorpay dashboard %s', 'ba-book-everything'), '<a href="https://github.com/razorpay/razorpay-woocommerce/wiki/Webhooks" target="_blank">' . __('by this guide', 'ba-book-everything') . '</a>'),
            array(__CLASS__, 'url_readonly_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-razorpay',
                'option' => 'razorpay_url_webhook',
                'settings_name' => $option_name,
                'gateway' => 'razorpay',
            ]
        );
    }

    public static function add_payment_banktransfer_settings(
        string $option_menu_slug,
        string $option_name
    ): void
    {
        $section_id = 'setting_section_payment';

        add_settings_field(
            'title_payment_method_demo_banktransfer',
            __('Gateway: ', 'ba-book-everything') . 'Direct bank transfer',
            array(__CLASS__, 'unlock_with_addon_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_subtitle tab-target-payment tab-target-payment-inactive tab-target-payment-banktransfer',
                'addon' => 'babe-payment-banktransfer',
                'section_title' => 'Direct bank transfer',
            ]
        );

        add_settings_field(
            'banktransfer_title',
            __('Title', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-banktransfer',
                'option' => 'banktransfer_title',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'banktransfer_description',
            __('Description', 'ba-book-everything'),
            array(__CLASS__, 'textarea_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-banktransfer',
                'option' => 'banktransfer_description',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'banktransfer_instructions',
            __('Instructions', 'ba-book-everything'),
            array(__CLASS__, 'textarea_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-banktransfer',
                'option' => 'banktransfer_instructions',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'banktransfer_payment_gateway_fee_title',
            __('Payment gateway fee title (optional)', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-banktransfer',
                'option' => 'banktransfer_payment_gateway_fee_title',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'banktransfer_payment_gateway_fee_percents',
            __('Payment gateway fee value, % (optional)', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-banktransfer',
                'option' => 'banktransfer_payment_gateway_fee_percents',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'banktransfer_account_title',
            __('Account details', 'ba-book-everything'),
            '__return_false',
            BABE_Settings::$option_menu_slug,
            'setting_section_payment',
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-banktransfer',
            ]
        );

        $transfer_detail_titles = [
            'account_name' => __('Account name', 'ba-book-everything'),
            'account_number' => __('Account number', 'ba-book-everything'),
            'bank_name' => __('Bank name', 'ba-book-everything'),
            'sort_code' => __('Sort code', 'ba-book-everything'),
            'iban' => __('IBAN', 'ba-book-everything'),
            'bic_swift' => __('BIC/Swift', 'ba-book-everything'),
        ];

        foreach ($transfer_detail_titles as $field => $title) {
            add_settings_field(
                'banktransfer_' . $field,
                $title,
                array(__CLASS__, 'text_field_callback'),
                $option_menu_slug,
                $section_id,
                [
                    'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-banktransfer',
                    'option' => 'banktransfer_' . $field,
                    'settings_name' => $option_name,
                ]
            );
        }
    }

    public static function add_marketplace_provider_settings(
        string $option_menu_slug,
        string $option_name
    ): void
    {
        add_settings_section(
            'setting_section_provider',
            __('Provider', 'ba-book-everything') . ' <span class="babe-ext-badge">Addon</span>',
            '__return_false',
            $option_menu_slug
        );

        add_settings_field(
            'title_setting_section_provider',
            '',
            array(__CLASS__, 'unlock_with_addon_callback'),
            $option_menu_slug,
            'setting_section_provider',
            [
                'class' => 'babe_setting_subtitle',
                'addon' => 'babe-marketplace',
                'section_title' => 'Provider'
            ]
        );

        add_settings_field(
            'provider_capabilities_separator',
            __('Provider Capabilities', 'ba-book-everything'),
            '__return_false',
            $option_menu_slug,
            'setting_section_provider',
            ['class' => 'babe_setting_subtitle',]
        );

        add_settings_field(
            'provider_can_manage_profile',
            __('Can manage own profile', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_provider',
            [
                'class' => 'babe_setting_locked',
                'option' => 'provider_can_manage_profile',
                'settings_name' => $option_name,
                'default' => 1,
            ]
        );

        add_settings_field(
            'provider_can_manage_booking_objects',
            __('Can manage booking items', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_provider',
            [
                'class' => 'babe_setting_locked',
                'option' => 'provider_can_manage_booking_objects',
                'settings_name' => $option_name,
                'default' => 1,
            ]
        );

        add_settings_field(
            'provider_can_manage_services',
            __('Can manage services', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_provider',
            [
                'class' => 'babe_setting_locked',
                'option' => 'provider_can_manage_services',
                'settings_name' => $option_name,
                'default' => 1,
            ]
        );

        add_settings_field(
            'provider_can_manage_fees',
            __('Can manage fees', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_provider',
            [
                'class' => 'babe_setting_locked',
                'option' => 'provider_can_manage_fees',
                'settings_name' => $option_name,
                'default' => 1,
            ]
        );

        add_settings_field(
            'provider_can_manage_faqs',
            __('Can manage FAQs', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_provider',
            [
                'class' => 'babe_setting_locked',
                'option' => 'provider_can_manage_faqs',
                'settings_name' => $option_name,
                'default' => 1,
            ]
        );

        add_settings_field(
            'provider_can_manage_places',
            __('Can manage places', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_provider',
            [
                'class' => 'babe_setting_locked',
                'option' => 'provider_can_manage_places',
                'settings_name' => $option_name,
                'default' => 1,
            ]
        );

        add_settings_field(
            'provider_public_info_separator',
            __('Provider information displayed to customers', 'ba-book-everything'),
            '__return_false',
            $option_menu_slug,
            'setting_section_provider',
            ['class' => 'babe_setting_subtitle',]
        );

        $provider_text_fields = [
            'display_name' => __('Display company name (brand)', 'ba-book-everything'),
            'address' => __('Customer office address', 'ba-book-everything'),
            'customer_support_phone' => __('Customer support phone', 'ba-book-everything'),
            'customer_support_email' => __('Customer support Email', 'ba-book-everything'),
            'site_url' => __('Site URL', 'ba-book-everything'),
            'business_registration_number' => __('Business Registration Number', 'ba-book-everything'),
        ];

        foreach ($provider_text_fields as $field_key => $field_title) {
            add_settings_field(
                'provider_public_info_show_' . $field_key,
                $field_title,
                array(__CLASS__, 'is_active_callback'),
                $option_menu_slug,
                'setting_section_provider',
                [
                    'class' => 'babe_setting_locked',
                    'option' => 'provider_public_info_show_' . $field_key,
                    'settings_name' => $option_name,
                    'default' => 1,
                ]
            );
        }
    }

    public static function add_admin_menu_pages_backoffice(): void
    {
        add_submenu_page(
            'edit.php?post_type=' . BABE_Post_types::$booking_obj_post_type,
            __('Sales Report', 'ba-book-everything'),
            __('Sales Report', 'ba-book-everything') . ' <span class="babe-ext-badge">Addon</span>',
            'manage_options',
            'babe-sales-report',
            array(__CLASS__, 'create_sales_report_page')
        );

        add_submenu_page(
            'edit.php?post_type=' . BABE_Post_types::$booking_obj_post_type,
            __('Calendar', 'ba-book-everything'),
            __('Backoffice Calendar', 'ba-book-everything') . ' <span class="babe-ext-badge">Addon</span>',
            'manage_options',
            'calendar',
            array(__CLASS__, 'create_av_calendar_page')
        );
    }

    public static function create_av_calendar_page(): void
    {
        ?>
        <div class="wrap">
        <h2 class="babe_addon_title"><?php echo __('Availability Overview', 'ba-book-everything'); ?></h2>

        <div class="babe-addon-unlock-wrapper">
            <?php
            self::unlock_with_addon_callback([
                'addon' => 'babe-backoffice-calendar',
                'section_title' => __('Availability Overview', 'ba-book-everything')
            ]);
            ?>
        </div>
        <hr/>
        <?php
        echo self::get_addon_preview_screenshot_html("css/img/babe_av_calendar_preview.png");
    }

public static function create_sales_report_page(): void
{
    ?>
    <div class="wrap">
    <h2 class="babe_addon_title"><?php echo __('Sales Report', 'ba-book-everything'); ?></h2>

    <div class="babe-addon-unlock-wrapper">
        <?php
        self::unlock_with_addon_callback([
            'addon' => 'babe-backoffice-sales',
            'section_title' => __('Sales Report', 'ba-book-everything')
        ]);
        ?>
    </div>
    <hr/>
    <?php
    echo self::get_addon_preview_screenshot_html("css/img/babe_sales_report_preview.png");
}

    public static function add_admin_menu_page_currency_switcher(): void
    {
        add_submenu_page(
            'edit.php?post_type=' . BABE_Post_types::$booking_obj_post_type,
            __('Currency switcher', 'ba-book-everything'),
            __('Currency switcher', 'ba-book-everything') . ' <span class="babe-ext-badge">Addon</span>',
            'manage_options',
            'currency_switcher',
            array(__CLASS__, 'create_currency_switcher_page')
        );
    }

    public static function create_currency_switcher_page(): void
    {
        ?>
        <div class="wrap">
        <h2 class="babe_addon_title"><?php echo __('BABE Currency switcher', 'ba-book-everything'); ?></h2>

        <div class="babe-addon-unlock-wrapper">
            <?php
            self::unlock_with_addon_callback([
                'addon' => 'babe-currency-switcher',
                'section_title' => __('Currency switcher', 'ba-book-everything')
            ]);
            ?>
        </div>
        <hr/>
        <?php
        echo self::get_addon_preview_screenshot_html("css/img/ba_currency_switcher_preview.png");
    }

    public static function get_addon_preview_screenshot_html(string $img_path): string
    {
        return '<div class="babe-addon-preview-screenshot">
            <img src="' . plugins_url($img_path, BABE_PLUGIN) . '" alt="Addon preview">
            <div class="babe-addon-preview-screenshot-hover"></div>
        </div>';
    }

    public static function add_backoffice_invoice_settings(
        string $option_menu_slug,
        string $option_name
    ): void
    {
        add_settings_field(
            'custom_order_statuses_separator',
            __('Customizer', 'ba-book-everything'),
            array(__CLASS__, 'unlock_with_addon_callback'),
            $option_menu_slug,
            'setting_section_order',
            [
                'class' => 'babe_setting_subtitle',
                'addon' => 'babe-backoffice-order',
                'section_title' => 'Customizer'
            ]
        );

        add_settings_field(
            'custom_emails_enabled_separator',
            __('Customizer', 'ba-book-everything'),
            array(__CLASS__, 'unlock_with_addon_callback'),
            $option_menu_slug,
            'setting_section_emails',
            [
                'class' => 'babe_setting_subtitle',
                'addon' => 'babe-backoffice-email',
                'section_title' => 'Customizer'
            ]
        );

        add_settings_section(
            'setting_section_invoice',
            __('PDF Invoice', 'ba-book-everything') . ' <span class="babe-ext-badge">Addon</span>',
            '__return_false',
            $option_menu_slug
        );

        add_settings_field(
            'title_setting_section_invoice',
            '',
            array(__CLASS__, 'unlock_with_addon_callback'),
            $option_menu_slug,
            'setting_section_invoice',
            [
                'class' => 'babe_setting_subtitle',
                'addon' => 'babe-backoffice',
                'section_title' => 'PDF Invoice'
            ]
        );

        add_settings_field(
            'invoice_to_email',
            __('Attach invoice to the customer order email', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_invoice',
            [
                'class' => 'babe_setting_locked',
                'option' => 'invoice_to_email',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'invoice_to_admin_email',
            __('Attach invoice to the admin order notification email', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_invoice',
            [
                'class' => 'babe_setting_locked',
                'option' => 'invoice_to_admin_email',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'invoice_logo',
            __('Logo image', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            'setting_section_invoice',
            [
                'class' => 'babe_setting_locked',
                'option' => 'invoice_logo',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'invoice_company_name',
            __('Company name', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            'setting_section_invoice',
            [
                'class' => 'babe_setting_locked',
                'option' => 'invoice_company_name',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'invoice_company_address',
            __('Company address', 'ba-book-everything'),
            array(__CLASS__, 'textarea_callback'),
            $option_menu_slug,
            'setting_section_invoice',
            [
                'class' => 'babe_setting_locked',
                'option' => 'invoice_company_address',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'invoice_number_pref',
            __('Invoice number: prefix', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            'setting_section_invoice',
            [
                'class' => 'babe_setting_locked',
                'option' => 'invoice_number_pref',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'invoice_number_suf',
            __('Invoice number: suffix', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            'setting_section_invoice',
            [
                'class' => 'babe_setting_locked',
                'option' => 'invoice_number_suf',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'invoice_number_digits',
            __('Invoice number: number of digits', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            'setting_section_invoice',
            [
                'class' => 'babe_setting_locked',
                'option' => 'invoice_number_digits',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'invoice_current_number',
            __('Next invoice number (without prefix/suffix etc.)', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            'setting_section_invoice',
            [
                'class' => 'babe_setting_locked',
                'option' => 'invoice_current_number',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'invoice_text',
            __('Additional text (you can use &lt;small&gt; and other tags)', 'ba-book-everything'),
            array(__CLASS__, 'textarea_callback'),
            $option_menu_slug,
            'setting_section_invoice',
            [
                'class' => 'babe_setting_locked',
                'option' => 'invoice_text',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'invoice_footer_message',
            __('Footer text (copyright, etc.)', 'ba-book-everything'),
            array(__CLASS__, 'textarea_callback'),
            $option_menu_slug,
            'setting_section_invoice',
            [
                'class' => 'babe_setting_locked',
                'option' => 'invoice_footer_message',
                'settings_name' => $option_name,
            ]
        );

        /** Rewards */

        add_settings_section(
            'setting_section_rewards',
            __('Rewards', 'ba-book-everything') . ' <span class="babe-ext-badge">Addon</span>',
            '__return_false',
            $option_menu_slug
        );

        add_settings_field(
            'title_setting_section_rewards',
            '',
            array(__CLASS__, 'unlock_with_addon_callback'),
            $option_menu_slug,
            'setting_section_rewards',
            [
                'class' => 'babe_setting_subtitle',
                'addon' => 'babe-backoffice',
                'section_title' => 'Rewards'
            ]
        );

        add_settings_field(
            'rewards_separator',
            __('Rewards', 'ba-book-everything'),
            '__return_false',
            $option_menu_slug,
            'setting_section_rewards',
            ['class' => 'babe_setting_subtitle',]
        );

        add_settings_field(
            'rewards_is_active',
            __('Send gift discount code when order is completed', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_rewards',
            [
                'class' => 'babe_setting_locked',
                'option' => 'rewards_is_active',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'rewards_number_of_symbols_in_code',
            __('Number of symbols in code', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            'setting_section_rewards',
            [
                'class' => 'babe_setting_locked',
                'option' => 'rewards_number_of_symbols_in_code',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'rewards_code_for_same_category_only',
            __('Limit discount code only to items with booking category of ordered item', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_rewards',
            [
                'class' => 'babe_setting_locked',
                'option' => 'rewards_code_for_same_category_only',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'rewards_code_value_rule',
            __('The gift discount code value:', 'ba-book-everything'),
            array(__CLASS__, 'rewards_code_value_rule_callback'),
            $option_menu_slug,
            'setting_section_rewards',
            [
                'class' => 'babe_setting_locked',
                'option' => 'rewards_code_value_rule',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'rewards_send_coupon_after_date_to',
            __('Send an email with gift discount coupon after booking, after ... hours.', 'ba-book-everything'),
            array(__CLASS__, 'hours_amount_callback'),
            $option_menu_slug,
            'setting_section_rewards',
            [
                'class' => 'babe_setting_locked',
                'option' => 'rewards_send_coupon_after_date_to',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'rewards_order_statuses',
            __('Apply to order statuses:', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            'setting_section_rewards',
            [
                'class' => 'babe_setting_locked',
                'option' => 'rewards_order_statuses',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'rewards_points_separator',
            __('Points', 'ba-book-everything'),
            '__return_false',
            $option_menu_slug,
            'setting_section_rewards',
            ['class' => 'babe_setting_subtitle',]
        );

        add_settings_field(
            'rewards_points_is_active',
            __('Reward with points when order is completed', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_rewards',
            [
                'class' => 'babe_setting_locked',
                'option' => 'rewards_points_is_active',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'rewards_points_order_statuses',
            __('Apply to order statuses:', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            'setting_section_rewards',
            [
                'class' => 'babe_setting_locked',
                'option' => 'rewards_points_order_statuses',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'rewards_points_exchange_rate_to_points',
            __('Exchange rate for accrual of points', 'ba-book-everything'),
            array(__CLASS__, 'exchange_rate_to_points_callback'),
            $option_menu_slug,
            'setting_section_rewards',
            [
                'class' => 'babe_setting_locked',
                'option' => 'rewards_points_exchange_rate_to_points',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'rewards_points_maximum_awarded_per_order',
            __('Maximum number of points that can be awarded per order (leave blank to not use)', 'ba-book-everything'),
            array(__CLASS__, 'points_amount_callback'),
            $option_menu_slug,
            'setting_section_rewards',
            [
                'class' => 'babe_setting_locked',
                'option' => 'rewards_points_maximum_awarded_per_order',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'rewards_points_exchange_rate_to_currency',
            __('Exchange rate of points to currency', 'ba-book-everything'),
            array(__CLASS__, 'exchange_rate_to_points_callback'),
            $option_menu_slug,
            'setting_section_rewards',
            [
                'class' => 'babe_setting_locked',
                'option' => 'rewards_points_exchange_rate_to_currency',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'rewards_points_minimum_to_pay_per_order',
            __('Minimum number of points that can be used to pay for one order', 'ba-book-everything'),
            array(__CLASS__, 'points_amount_callback'),
            $option_menu_slug,
            'setting_section_rewards',
            [
                'class' => 'babe_setting_locked',
                'option' => 'rewards_points_minimum_to_pay_per_order',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'rewards_points_maximum_to_pay_per_order',
            __('Maximum number of points that can be used to pay for one order (leave blank to not use)', 'ba-book-everything'),
            array(__CLASS__, 'points_amount_callback'),
            $option_menu_slug,
            'setting_section_rewards',
            [
                'class' => 'babe_setting_locked',
                'option' => 'rewards_points_maximum_to_pay_per_order',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'rewards_points_maximum_to_pay_of_order_amount_percents',
            __('Allow to pay with points for no more than % of the order amount', 'ba-book-everything'),
            array(__CLASS__, 'percent_amount_callback'),
            $option_menu_slug,
            'setting_section_rewards',
            [
                'class' => 'babe_setting_locked',
                'option' => 'rewards_points_maximum_to_pay_of_order_amount_percents',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'rewards_send_points_after_date_to',
            __('Accrue points and send an email with added points after booking, after ... hours.', 'ba-book-everything'),
            array(__CLASS__, 'hours_amount_callback'),
            $option_menu_slug,
            'setting_section_rewards',
            [
                'class' => 'babe_setting_locked',
                'option' => 'rewards_send_points_after_date_to',
                'settings_name' => $option_name,
            ]
        );

        /** Referral */

        add_settings_section(
            'setting_section_referral',
            __('Referral', 'ba-book-everything') . ' <span class="babe-ext-badge">Addon</span>',
            '__return_false',
            $option_menu_slug
        );

        add_settings_field(
            'title_setting_section_rewards',
            '',
            array(__CLASS__, 'unlock_with_addon_callback'),
            $option_menu_slug,
            'setting_section_referral',
            [
                'class' => 'babe_setting_subtitle',
                'addon' => 'babe-backoffice',
                'section_title' => 'Referral'
            ]
        );

        add_settings_field(
            'referral_separator',
            __('Referral program', 'ba-book-everything'),
            '__return_false',
            $option_menu_slug,
            'setting_section_referral',
            ['class' => 'babe_setting_subtitle',]
        );

        add_settings_field(
            'referral_is_active',
            __('Enable referral program', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_referral',
            [
                'class' => 'babe_setting_locked',
                'option' => 'referral_is_active',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'referral_reward_type',
            __('Referral reward type', 'ba-book-everything'),
            array(__CLASS__, 'reward_type_callback'),
            $option_menu_slug,
            'setting_section_referral',
            [
                'class' => 'babe_setting_locked',
                'option' => 'referral_reward_type',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'referral_reward_points',
            __('Fixed amount of points to award', 'ba-book-everything'),
            array(__CLASS__, 'points_amount_callback'),
            $option_menu_slug,
            'setting_section_referral',
            [
                'class' => 'babe_setting_locked',
                'option' => 'referral_reward_points',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'referral_reward_percent',
            __('Percent of order amount to award as points', 'ba-book-everything'),
            array(__CLASS__, 'percent_amount_callback'),
            $option_menu_slug,
            'setting_section_referral',
            [
                'class' => 'babe_setting_locked',
                'option' => 'referral_reward_percent',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'referral_orders_limit',
            __('For how many first orders of the invited user to award points (0 or blank = unlimited)', 'ba-book-everything'),
            array(__CLASS__, 'orders_amount_callback'),
            $option_menu_slug,
            'setting_section_referral',
            [
                'class' => 'babe_setting_locked',
                'option' => 'referral_orders_limit',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'referral_min_order_amount',
            __('Minimum order amount to qualify (leave blank to not use)', 'ba-book-everything'),
            array(__CLASS__, 'currency_amount_callback'),
            $option_menu_slug,
            'setting_section_referral',
            [
                'class' => 'babe_setting_locked',
                'option' => 'referral_min_order_amount',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'referral_order_statuses',
            __('Apply to order statuses:', 'ba-book-everything'),
            array(__CLASS__, 'textarea_callback'),
            $option_menu_slug,
            'setting_section_referral',
            [
                'class' => 'babe_setting_locked',
                'option' => 'referral_order_statuses',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'referral_award_after_hours',
            __('Award points after booking, after ... hours.', 'ba-book-everything'),
            array(__CLASS__, 'hours_amount_callback'),
            $option_menu_slug,
            'setting_section_referral',
            [
                'class' => 'babe_setting_locked',
                'option' => 'referral_award_after_hours',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'referral_cookie_lifetime_days',
            __('Referral link attribution lifetime (days)', 'ba-book-everything'),
            array(__CLASS__, 'days_amount_callback'),
            $option_menu_slug,
            'setting_section_referral',
            [
                'class' => 'babe_setting_locked',
                'option' => 'referral_cookie_lifetime_days',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'referral_rules_page_id',
            __('Referral rules page (linked from My Account)', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            'setting_section_referral',
            [
                'class' => 'babe_setting_locked',
                'option' => 'referral_rules_page_id',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'referral_share_button_label',
            __('Share button label (on booking page)', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            'setting_section_referral',
            [
                'class' => 'babe_setting_locked',
                'option' => 'referral_share_button_label',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'referral_share_button_label_copied',
            __('Share button label after link is copied', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            'setting_section_referral',
            [
                'class' => 'babe_setting_locked',
                'option' => 'referral_share_button_label_copied',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'referral_emails_separator',
            __('Email notifications', 'ba-book-everything'),
            '__return_false',
            $option_menu_slug,
            'setting_section_referral',
            ['class' => 'babe_setting_subtitle',]
        );

        add_settings_field(
            'referral_email_on_award',
            __('Send email to referrer when points are awarded', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_referral',
            [
                'class' => 'babe_setting_locked',
                'option' => 'referral_email_on_award',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'referral_email_on_revoke',
            __('Send email to referrer when points are revoked (cancel/refund)', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_referral',
            [
                'class' => 'babe_setting_locked',
                'option' => 'referral_email_on_revoke',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'referral_email_admin_on_registration',
            __('Send email to admin when a new customer registers via referral link', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_referral',
            [
                'class' => 'babe_setting_locked',
                'option' => 'referral_email_admin_on_registration',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'referral_admin_email',
            __('Admin email for referral notifications (leave blank to use site admin email)', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            'setting_section_referral',
            [
                'class' => 'babe_setting_locked',
                'option' => 'referral_admin_email',
                'settings_name' => $option_name,
            ]
        );
    }

    public static function add_backoffice_refund_settings(
        string $option_menu_slug,
        string $option_name
    ): void
    {
        add_settings_section(
            'setting_section_refund',
            __('Editing and refund Orders', 'ba-book-everything') . ' <span class="babe-ext-badge">Addon</span>',
            '__return_false',
            $option_menu_slug
        );

        add_settings_field(
            'title_setting_section_refund',
            '',
            array(__CLASS__, 'unlock_with_addon_callback'),
            $option_menu_slug,
            'setting_section_refund',
            [
                'class' => 'babe_setting_subtitle',
                'addon' => 'babe-backoffice',
                'section_title' => 'Editing and refund Orders'
            ]
        );

        add_settings_field(
            'order_editing_enabled',
            __('Allow users to Edit and Cancel orders', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_refund',
            [
                'class' => 'babe_setting_locked',
                'option' => 'order_editing_enabled',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'order_refund_enabled',
            __('Enable Refund', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_refund',
            [
                'class' => 'babe_setting_locked',
                'option' => 'order_refund_enabled',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'order_cancelation_refund_all',
            __('Refund 100% of paid amount if order was canceled more than ... before the start (hours)', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            'setting_section_refund',
            [
                'class' => 'babe_setting_locked',
                'option' => 'order_cancelation_refund_all',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'order_cancelation_refund_partial_pc',
            __('Partial Refund amount (%)', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            'setting_section_refund',
            [
                'class' => 'babe_setting_locked',
                'option' => 'order_cancelation_refund_partial_pc',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'order_cancelation_refund_partial',
            __('Partial Refund if order was canceled more than ... before the start (hours)', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            'setting_section_refund',
            [
                'class' => 'babe_setting_locked',
                'option' => 'order_cancelation_refund_partial',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'order_cancelation_refund_none',
            __('No Refund if order was canceled less than ... before the start (hours)', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            'setting_section_refund',
            [
                'class' => 'babe_setting_locked',
                'option' => 'order_cancelation_refund_none',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'order_auto_refund',
            __('Try refund automatically if order amount is reduced after editing the order', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_refund',
            [
                'class' => 'babe_setting_locked',
                'option' => 'order_auto_refund',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'order_extra_charge',
            __('Request extra charge if order amount is increased after editing the order', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_refund',
            [
                'class' => 'babe_setting_locked',
                'option' => 'order_extra_charge',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'order_auto_extra_charge',
            __('Try to charge extra amount automatically', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_refund',
            [
                'class' => 'babe_setting_locked',
                'option' => 'order_auto_extra_charge',
                'settings_name' => $option_name,
            ]
        );

        /** iCalendar */

        add_settings_section(
            'setting_section_ical',
            __('iCalendar', 'ba-book-everything') . ' <span class="babe-ext-badge">Addon</span>',
            '__return_false',
            $option_menu_slug
        );

        add_settings_field(
            'title_setting_section_ical',
            '',
            array(__CLASS__, 'unlock_with_addon_callback'),
            $option_menu_slug,
            'setting_section_ical',
            [
                'class' => 'babe_setting_subtitle',
                'addon' => 'babe-backoffice-ical',
                'section_title' => 'iCal synch'
            ]
        );

        add_settings_field(
            'ical_note',
            __('Note!', 'ba-book-everything'),
            array(__CLASS__, 'note_section_ical'),
            $option_menu_slug,
            'setting_section_ical',
            [
                'class' => 'babe_setting_locked',
                'option' => 'ical_note',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'ical_enabled',
            __('Enable iCalendar synchronization', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_ical',
            [
                'class' => 'babe_setting_locked',
                'option' => 'ical_enabled',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'ical_check_canceled_orders',
            __('Search canceled orders in iCal import feed and synchronize with BA orders', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_ical',
            [
                'class' => 'babe_setting_locked',
                'option' => 'ical_check_canceled_orders',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'ical_allow_not_available_orders',
            __('Import "not available" dates from iCal feed', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_ical',
            [
                'class' => 'babe_setting_locked',
                'option' => 'ical_allow_not_available_orders',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'ical_order_status',
            __('Apply status to imported order', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            'setting_section_ical',
            [
                'class' => 'babe_setting_locked',
                'option' => 'ical_order_status',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'ical_order_amount_to_zero',
            __('Set imported order total amount to 0', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            'setting_section_ical',
            [
                'class' => 'babe_setting_locked',
                'option' => 'ical_order_amount_to_zero',
                'settings_name' => $option_name,
            ]
        );
    }

    public static function note_section_ical()
    {
        echo '<div style="text-decoration:underline;">' . __('iCalendar synchronization works only for objects with "night" booking period and "object" booking mode.', 'ba-book-everything') . '</div>';
    }

    public static function add_payment_more_tabs(
        string $option_menu_slug,
        string $option_name
    ): void
    {
        $section_id = 'setting_section_payment';

        add_settings_field(
            'payment_methods_more',
            __('More gateways: ', 'ba-book-everything'),
            array(__CLASS__, 'payment_method_tabs'),
            $option_menu_slug,
            $section_id,
            ['class' => 'babe_setting_more_payment_methods']
        );
    }

    public static function add_payment_pack_settings(
        string $option_menu_slug,
        string $option_name
    ): void
    {
        $section_id = 'setting_section_payment';

        add_settings_field(
            'title_payment_method_demo_paypal',
            __('Gateway: ', 'ba-book-everything') . 'PayPal',
            array(__CLASS__, 'unlock_with_addon_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_subtitle tab-target-payment tab-target-payment-inactive tab-target-payment-paypal',
                'addon' => 'babe-payment-pack',
                'section_title' => 'PayPal',
            ]
        );

        add_settings_field(
            'paypal_tab_title',
            __('Payment tab title', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-paypal',
                'option' => 'paypal_tab_title',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'paypal_description',
            __('Payment description', 'ba-book-everything'),
            array(__CLASS__, 'textarea_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-paypal',
                'option' => 'paypal_description',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'paypal_payment_gateway_fee_title',
            __('Payment gateway fee title (optional)', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-paypal',
                'option' => 'paypal_payment_gateway_fee_title',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'paypal_payment_gateway_fee_percents',
            __('Payment gateway fee value, % (optional)', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-paypal',
                'option' => 'paypal_payment_gateway_fee_percents',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'paypal_sandbox',
            __('Use PayPal sandbox mode?', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-paypal',
                'option' => 'paypal_sandbox',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'paypal_live_client_id',
            __('Live Client ID', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-paypal',
                'option' => 'paypal_live_client_id',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'paypal_live_secret',
            __('Live Secret', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-paypal',
                'option' => 'paypal_live_secret',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'paypal_test_client_id',
            __('Test Client ID', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-paypal',
                'option' => 'paypal_test_client_id',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'paypal_test_secret',
            __('Test Secret', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-paypal',
                'option' => 'paypal_test_secret',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'paypal_url_webhook',
            sprintf(__('Webhook endpoint. Add it in your %s', 'ba-book-everything'), '<a href="https://developer.paypal.com/developer/applications" target="_blank">' . __('REST API settings', 'ba-book-everything') . '</a>'),
            array(__CLASS__, 'url_readonly_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-paypal',
                'option' => 'paypal_url_webhook',
                'settings_name' => $option_name,
                'gateway' => 'paypal',
            ]
        );

        add_settings_field(
            'title_payment_method_demo_stripe',
            __('Gateway: ', 'ba-book-everything') . 'Stripe',
            array(__CLASS__, 'unlock_with_addon_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_subtitle tab-target-payment tab-target-payment-inactive tab-target-payment-stripe',
                'addon' => 'babe-payment-pack',
                'section_title' => 'Stripe',
            ]
        );

        add_settings_field(
            'stripe_tab_title',
            __('Payment tab title', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-stripe',
                'option' => 'stripe_tab_title',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'stripe_description',
            __('Payment description', 'ba-book-everything'),
            array(__CLASS__, 'textarea_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-stripe',
                'option' => 'stripe_description',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'stripe_sandbox',
            __('Use Stripe test mode?', 'ba-book-everything'),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-stripe',
                'option' => 'stripe_sandbox',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'stripe_integration_mode',
            __('Stripe integration mode. After switching the mode, make sure the webhook events required by the selected mode are activated in your Stripe dashboard (see the webhook endpoint field below).', 'ba-book-everything'),
            array(__CLASS__, 'setting_stripe_integration_mode_switch'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-stripe',
                'option' => 'stripe_integration_mode',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'stripe_manual_capture',
            sprintf(
                __('Only reserve (authorize) funds that you will capture later manually from Stripe dashboard (see details on %1$s%2$s%3$s). Requires to activate the payment_intent.amount_capturable_updated event', 'ba-book-everything'),
                '<a href="https://docs.stripe.com/payments/place-a-hold-on-a-payment-method" target="_blank">',
                'https://docs.stripe.com/payments/place-a-hold-on-a-payment-method',
                '</a>'
            ),
            array(__CLASS__, 'is_active_callback'),
            $option_menu_slug,
            $section_id,
            [
                'option' => 'stripe_manual_capture',
                'settings_name' => $option_name,
                'default' => 0,
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-stripe',
            ]
        );

        add_settings_field(
            'stripe_live_public_key',
            __('Live Public key', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-stripe',
                'option' => 'stripe_live_public_key',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'stripe_live_secret_key',
            __('Live Secret key', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-stripe',
                'option' => 'stripe_live_secret_key',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'stripe_live_webhook_endpoint_secret',
            __('Live webhook endpoint secret (go to the Developer Dashboard, open webhook and click "Reveal" under the "Signing secret" to recreate and show the secret)', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-stripe',
                'option' => 'stripe_live_webhook_endpoint_secret',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'stripe_test_public_key',
            __('Test Public key', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-stripe',
                'option' => 'stripe_test_public_key',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'stripe_test_secret_key',
            __('Test Secret key', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-stripe',
                'option' => 'stripe_test_secret_key',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'stripe_test_webhook_endpoint_secret',
            __('Test webhook endpoint secret (go to the Developer Dashboard, open webhook and click "Reveal" under the "Signing secret" to recreate and show the secret)', 'ba-book-everything'),
            array(__CLASS__, 'text_field_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-stripe',
                'option' => 'stripe_test_webhook_endpoint_secret',
                'settings_name' => $option_name,
            ]
        );

        add_settings_field(
            'stripe_url_webhook',
            sprintf(__('IPN Webhook endpoint. It is required to add endpoint into your %1$s and activate events', 'ba-book-everything'), '<a href="https://dashboard.stripe.com/account/webhooks" target="_blank">' . __('Stripe dashboard', 'ba-book-everything') . '</a>'),
            array(__CLASS__, 'url_readonly_callback'),
            $option_menu_slug,
            $section_id,
            [
                'class' => 'babe_setting_locked tab-target-payment tab-target-payment-inactive tab-target-payment-stripe',
                'option' => 'stripe_url_webhook',
                'settings_name' => $option_name,
                'gateway' => 'stripe',
            ]
        );
    }

    public static function payment_method_tabs($args)
    {

        $output = '<div class="nav-tab-payment-gateways">';

        foreach (self::$more_gateways as $tab_key => $tab_title) {
            $output .= '<span class="nav-tab-payment-gateway" data-target="tab-target-payment-' . $tab_key . '">' . $tab_title . '</span>';
        }

        $output .= '</div>';

        echo $output;
    }

    public static function setting_stripe_integration_mode_switch($args)
    {
        $current = 'payment_intent';

        $mode_labels = [
            'payment_intent' => __('Payment Intents (legacy)', 'ba-book-everything'),
            'checkout_session' => __('Checkout Sessions (Elements with Checkout Sessions API)', 'ba-book-everything'),
        ];

        echo '<p><input class="babe_stripe_integration_mode_switch" id="' . $args['option'] . '1" name="' . $args['settings_name'] . '[' . $args['option'] . ']" type="radio" value="payment_intent" ' . checked('payment_intent', $current, false) . ' disabled /><label for="' . $args['option'] . '1">' . $mode_labels['payment_intent'] . '</label></p>';
        echo '<p><input class="babe_stripe_integration_mode_switch" id="' . $args['option'] . '2" name="' . $args['settings_name'] . '[' . $args['option'] . ']" type="radio" value="checkout_session" ' . checked('checkout_session', $current, false) . ' disabled /><label for="' . $args['option'] . '2"><strong>' . $mode_labels['checkout_session'] . '</strong></label></p>';
    }

    public static function unlock_with_addon_callback($args)
    {
        if (empty($args['addon'])) {
            return;
        }

        $addon_name = self::BA_ADDON_NAMES[$args['addon']] ?? $args['addon'];
        $addon_product_url = self::get_addon_product_url($args['addon']);
        $addon_doc_url = self::get_addon_doc_url($args['addon']);

        $doc_button = '';

        if( $addon_doc_url !== $addon_product_url ){
            $doc_button = '<a class="babe-ext-button babe-ext-button-secondary" href="' . esc_url($addon_doc_url) . '">' . __('Documentation', 'ba-book-everything') . '</a>';
        }

        echo '<div class="unlock_with_addon_section">
            <div class="unlock_with_addon_star"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
            </svg></div>
            <div>
            ' . sprintf(__('Unlock "%1$s" with "%2$s" addon', 'ba-book-everything'), $args['section_title'], $addon_name) . '
            <div class="unlock_with_addon_buttons">
               <a class="babe-ext-button" href="' . esc_url($addon_product_url) . '">' . __('Get the addon', 'ba-book-everything') . '
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="babe-ext-button-arrow"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
               </a>
               '.$doc_button.'
            </div>
            </div>
            <div class="unlock_with_addon_star"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
</svg></div>
        </div>';
    }

    private static function get_addon_product_url(string $addon_name): string
    {
        if (!isset(self::BA_ADDON_PRODUCT_PAGES[$addon_name])) {
            return self::BA_ADDON_PRODUCT_PAGE_DEFAULT;
        }

        return rtrim(self::BA_ADDON_PRODUCT_PAGE_BASE_URL, '/')
            . '/'
            . ltrim(self::BA_ADDON_PRODUCT_PAGES[$addon_name], '/');
    }

    private static function get_addon_doc_url(string $addon_name): string
    {
        if ( !isset(self::BA_ADDON_DOC_PAGES[$addon_name]) ) {
            return self::get_addon_product_url($addon_name);
        }

        return rtrim(self::BA_ADDON_DOC_PAGE_BASE_URL, '/')
            . '/'
            . ltrim(self::BA_ADDON_DOC_PAGES[$addon_name], '/');
    }

    public static function url_readonly_callback($args)
    {
        echo '<span class="babe_inactive_setting_textarea">' . BABE_Payments::get_payment_server_response_page_url($args['gateway']) . '</span>';
    }

    public static function text_field_callback($args)
    {
        echo '<span class="babe_inactive_setting"></span>';
    }

    public static function textarea_callback($args)
    {
        echo '<span class="babe_inactive_setting_textarea"></span>';
    }

    public static function points_amount_callback(array $args)
    {

        self::amount_with_label_callback(__('points', 'ba-book-everything'));
    }

    public static function percent_amount_callback(array $args)
    {

        self::amount_with_label_callback('%');
    }

    public static function hours_amount_callback(array $args)
    {

        self::amount_with_label_callback(__('hours', 'ba-book-everything'));
    }

    public static function days_amount_callback(array $args): void
    {
        self::amount_with_label_callback(__('days', 'ba-book-everything'));
    }

    public static function orders_amount_callback(array $args): void
    {
        self::amount_with_label_callback(__('orders', 'ba-book-everything'));
    }

    public static function currency_amount_callback(array $args): void
    {
        self::amount_with_label_callback(BABE_Currency::get_currency_symbol());
    }

    public static function amount_with_label_callback(string $label)
    {

        echo '<span class="babe_inactive_setting"></span> ' . $label;
    }

    public static function exchange_rate_to_points_callback(array $args)
    {

        echo '<p>'
            . sprintf(__('1 %1$s =', 'ba-book-everything'), BABE_Currency::get_currency_symbol())
            . '<span class="babe_inactive_setting"></span> ' . __('points', 'ba-book-everything') . '
        </p>';
    }

    public static function rewards_code_value_rule_callback(array $args): void
    {
        echo '<p><input id="' . $args['settings_name'] . '[' . $args['option'] . ']1" 
        name="' . $args['settings_name'] . '[' . $args['option'] . ']" 
        type="radio" 
        value="1" checked disabled />
        <label for="' . $args['settings_name'] . '[' . $args['option'] . ']1">'
            . sprintf(
                __('amount, calculated as %1$s%% of booking', 'ba-book-everything'),
                '<input value="5">'
            )
            . '</label>
        </p>';

        echo '<p><input id="' . $args['settings_name'] . '[' . $args['option'] . ']2" 
        name="' . $args['settings_name'] . '[' . $args['option'] . ']" 
        type="radio" 
        value="2" disabled />
        <label for="' . $args['settings_name'] . '[' . $args['option'] . ']2">'
            . __('fixed percent', 'ba-book-everything')
            . '</label>
        <input value="5">%
        </p>';

        echo '<p><input id="' . $args['settings_name'] . '[' . $args['option'] . ']3" 
        name="' . $args['settings_name'] . '[' . $args['option'] . ']" 
        type="radio" 
        value="3" disabled />
        <label for="' . $args['settings_name'] . '[' . $args['option'] . ']3">'
            . __('fixed amount', 'ba-book-everything')
            . '</label> ' . BABE_Currency::get_currency_symbol() . '
        <input value="5">
        </p>';
    }

    public static function reward_type_callback(array $args): void
    {
        echo '<p><input id="' . $args['settings_name'] . '[' . $args['option'] . ']1"
            name="' . $args['settings_name'] . '[' . $args['option'] . ']"
            type="radio"
            value="1" checked disabled />
            <label for="' . $args['settings_name'] . '[' . $args['option'] . ']1">'
            . __('fixed amount of points', 'ba-book-everything')
            . '</label>
        </p>';

        echo '<p><input id="' . $args['settings_name'] . '[' . $args['option'] . ']2"
            name="' . $args['settings_name'] . '[' . $args['option'] . ']"
            type="radio"
            value="2" disabled />
            <label for="' . $args['settings_name'] . '[' . $args['option'] . ']2">'
            . __('percent of order amount', 'ba-book-everything')
            . '</label>
        </p>';
    }

    public static function is_active_callback($args)
    {

        $default = !empty($args['default']) ? 1 : 0;
        $checked1 = $default ? 'checked' : '';
        $checked2 = !$default ? 'checked' : '';

        echo '<p><input id="' . $args['settings_name'] . '[' . $args['option'] . ']1" name="' . $args['settings_name'] . '[' . $args['option'] . ']" type="radio" value="1" ' . $checked1 . ' disabled /><label for="' . $args['settings_name'] . '[' . $args['option'] . ']1">' . __('Yes', 'ba-book-everything') . '</label></p>';
        echo '<p><input id="' . $args['settings_name'] . '[' . $args['option'] . ']2" name="' . $args['settings_name'] . '[' . $args['option'] . ']" type="radio" value="0" ' . $checked2 . ' disabled /><label for="' . $args['settings_name'] . '[' . $args['option'] . ']2">' . __('No', 'ba-book-everything') . '</label></p>';
    }
}
