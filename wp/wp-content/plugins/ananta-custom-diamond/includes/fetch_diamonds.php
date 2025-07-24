<?php
if (!defined('ABSPATH')) exit;

function ananta_custom_diamond_fetch_and_store()
{
    global $wpdb;

    $response = wp_remote_get('https://anantajewelry.com/pub/tech-test/mock-diamonds.json');

    if (is_wp_error($response)) {
        error_log('[ananta-custom-diamond] API error: ' . $response->get_error_message());
        return;
    }

    $diamonds = json_decode(wp_remote_retrieve_body($response), true);

    if (!is_array($diamonds)) {
        error_log('[ananta-custom-diamond] Invalid diamond format.');
        return;
    }

    $table = $wpdb->prefix . 'diamonds';

    foreach ($diamonds as $d) {
        $wpdb->replace($table, [
            'diamond_id' => sanitize_text_field($d['diamond_id']),
            'supplier_name' => sanitize_text_field($d['supplier_name']),
            'shape' => sanitize_text_field($d['shape']),
            'size' => floatval($d['size']),
            'color' => sanitize_text_field($d['color']),
            'clarity' => sanitize_text_field($d['clarity']),
            'cut' => sanitize_text_field($d['cut']),
            'symmetry' => sanitize_text_field($d['symmetry']),
            'polish' => sanitize_text_field($d['polish']),
            'lab' => sanitize_text_field($d['lab']),
            'certification_number' => sanitize_text_field($d['certification_number']),
            'certificate_url' => esc_url_raw($d['certificate_url']),
            'location' => sanitize_text_field($d['location']),
            'price_usd' => floatval($d['price_usd']),
        ]);
    }
}
