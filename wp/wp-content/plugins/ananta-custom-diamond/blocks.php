<?php
// File: wp/wp-content/plugins/ananta-custom-diamond/blocks.php

// Register block
function ananta_custom_diamond_register_block()
{
    wp_register_script(
        'ananta-custom-diamond-block',
        plugin_dir_url(__FILE__) . 'blocks/diamond-block.js',
        ['wp-blocks', 'wp-element', 'wp-block-editor'],
        '1.0',
        true
    );

    register_block_type('ananta/custom-diamond', [
        'editor_script' => 'ananta-custom-diamond-block',
        'render_callback' => 'ananta_custom_diamond_render_block'
    ]);
}
add_action('init', 'ananta_custom_diamond_register_block');

// Render callback: 6 random diamonds
function ananta_custom_diamond_render_block()
{
    global $wpdb;
    $table = $wpdb->prefix . 'diamonds';
    $diamonds = $wpdb->get_results("SELECT * FROM $table ORDER BY RAND() LIMIT 6");

    ob_start();
    echo '<div class="ananta-custom-diamond-block">';
    foreach ($diamonds as $d) {
        printf(
            '<div class="diamond-item">
                <strong>%s - %.2f ct</strong><br>
                %s: %s<br>
                %s: $%.2f
            </div><hr>',
            esc_html($d->shape),
            floatval($d->size),
            esc_html__('Color', 'ananta-custom-diamond'),
            esc_html($d->color),
            esc_html__('Price', 'ananta-custom-diamond'),
            floatval($d->price_usd)
        );
    }
    echo '</div>';
    return ob_get_clean();
}
