<?php
/*
 * Plugin Name: ANANTA Custom Diamond
 * Description: Enable customer to select a diamond for a ring setting.
 * Version: 1.0.0
 * Author: ANANTA Jewelry
 * Author URI: https://anantajewelry.com
 * License: Copyright 2025 by ANANTA Jewelry Co., Ltd.
 * Text Domain: ananta-custom-diamond
 */

if (!defined('ABSPATH')) exit;

class Ananta_Custom_Diamond
{

    public static function init()
    {
        add_action('admin_menu', [self::class, 'register_admin_menu']);
        add_action('init', [self::class, 'register_scripts']);
        add_action('rest_api_init', [self::class, 'register_rest_api']);

        // Enqueue frontend assets
        add_action('wp_enqueue_scripts', [self::class, 'enqueue_frontend_assets']);

        // WooCommerce hooks
        add_filter('woocommerce_add_cart_item_data', [self::class, 'add_cart_item_data'], 10, 2);
        add_action('woocommerce_before_calculate_totals', [self::class, 'add_diamond_price'], 20, 1);
        add_filter('woocommerce_get_item_data', [self::class, 'display_diamond_data'], 10, 2);
        add_action('woocommerce_add_order_item_meta', [self::class, 'save_order_item_meta'], 10, 2);
    }

    public static function register_rest_api()
    {
        register_rest_route('ananta/v1', '/diamonds', [
            'methods' => 'GET',
            'callback' => [self::class, 'get_diamonds'],
            'permission_callback' => '__return_true'
        ]);
    }

    public static function get_diamonds()
    {
        global $wpdb;
        $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}diamonds");
        return rest_ensure_response($results);
    }

    public static function register_scripts()
    {
        wp_register_script(
            'ananta-diamond-selector',
            plugin_dir_url(__FILE__) . 'assets/js/diamond-selector.js',
            [],
            '1.0',
            true
        );
        wp_register_style(
            'ananta-diamond-style',
            plugin_dir_url(__FILE__) . 'assets/css/diamond-selector.css',
            [],
            '1.0'
        );
    }

    public static function enqueue_frontend_assets()
    {
        if (is_product()) {
            wp_enqueue_script('ananta-diamond-selector');
            wp_enqueue_style('ananta-diamond-style');
        }
    }

    public static function register_admin_menu()
    {
        add_menu_page(
            __('Import Diamonds', 'ananta-custom-diamond'),
            __('Import Diamonds', 'ananta-custom-diamond'),
            'manage_options',
            'import-diamonds',
            [self::class, 'import_diamond_admin_page'],
            'dashicons-database-import'
        );
    }

    public static function import_diamond_admin_page()
    {
        if (isset($_POST['ananta_import_diamonds'])) {
            include_once plugin_dir_path(__FILE__) . 'includes/fetch_diamonds.php';
            ananta_custom_diamond_fetch_and_store();
            echo '<div class="notice notice-success"><p>' . esc_html__('Diamonds imported successfully!', 'ananta-custom-diamond') . '</p></div>';
        }
?>
        <div class="wrap">
            <h1><?php esc_html_e('Import Diamonds', 'ananta-custom-diamond'); ?></h1>
            <form method="post">
                <input type="submit" class="button-primary" name="ananta_import_diamonds" value="<?php esc_attr_e('Fetch & Save Diamonds', 'ananta-custom-diamond'); ?>">
            </form>
        </div>
<?php
    }

    public static function add_cart_item_data($cart_item_data, $product_id)
    {
        if (isset($_POST['selected_diamond'])) {
            $diamond = json_decode(stripslashes($_POST['selected_diamond']), true);
            if (is_array($diamond)) {
                $cart_item_data['selected_diamond'] = $diamond;
            }
        }
        return $cart_item_data;
    }

    public static function add_diamond_price($cart)
    {
        if (is_admin() && !defined('DOING_AJAX')) return;

        $exchange_rate = 36.5;

        foreach ($cart->get_cart() as $cart_item) {
            if (isset($cart_item['selected_diamond'])) {
                $diamond = $cart_item['selected_diamond'];
                $price_thb = floatval($diamond['price_usd']) * $exchange_rate;
                $product_price = floatval($cart_item['data']->get_price());
                $cart_item['data']->set_price($product_price + $price_thb);
            }
        }
    }

    public static function display_diamond_data($item_data, $cart_item)
    {
        if (isset($cart_item['selected_diamond'])) {
            $diamond = $cart_item['selected_diamond'];
            $exchange_rate = 36.5;
            $price_thb = floatval($diamond['price_usd']) * $exchange_rate;
            $item_data[] = [
                'key'   => __('Diamond', 'ananta-custom-diamond'),
                'value' => sprintf('%s | %.2f ct | ฿%.2f', esc_html($diamond['shape']), $diamond['size'], $price_thb)
            ];
        }
        return $item_data;
    }

    public static function save_order_item_meta($item_id, $values)
    {
        if (isset($values['selected_diamond'])) {
            wc_add_order_item_meta($item_id, 'selected_diamond', $values['selected_diamond']);
        }
    }

    public static function activate()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'diamonds';
        $charset_collate = $wpdb->get_charset_collate();
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $sql = "CREATE TABLE $table_name (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            diamond_id VARCHAR(36) NOT NULL,
            supplier_name VARCHAR(50) NOT NULL,
            shape VARCHAR(30) NOT NULL,
            size FLOAT NOT NULL,
            color VARCHAR(2) NOT NULL,
            clarity VARCHAR(5) NOT NULL,
            cut VARCHAR(20) NOT NULL,
            symmetry VARCHAR(20) NOT NULL,
            polish VARCHAR(20) NOT NULL,
            lab VARCHAR(10) NOT NULL,
            certification_number VARCHAR(30) NOT NULL,
            certificate_url TEXT NOT NULL,
            location VARCHAR(50) NOT NULL,
            price_usd FLOAT NOT NULL,
            PRIMARY KEY (id),
            UNIQUE KEY diamond_id (diamond_id)
        ) $charset_collate;";

        dbDelta($sql);
    }
}

Ananta_Custom_Diamond::init();
register_activation_hook(__FILE__, ['Ananta_Custom_Diamond', 'activate']);

// Load other functionality
require_once plugin_dir_path(__FILE__) . 'blocks.php';
require_once plugin_dir_path(__FILE__) . 'includes/fetch_diamonds.php';
