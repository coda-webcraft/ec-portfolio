<?php
function my_theme_woocommerce_support()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'my_theme_woocommerce_support');

function my_theme_enqueue_styles()
{
    wp_enqueue_style('my-theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function my_theme_setup_menus()
{
    register_nav_menus(array(
        'header-menu' => 'ヘッダーメニュー',
    ));
}
add_action('after_setup_theme', 'my_theme_setup_menus');

add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// WooCommerce ページの標準サイドバーを出さない
add_action('init', function () {
    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
});

add_filter('single_product_archive_thumbnail_size', function () {
    return 'woocommerce_single';
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script(
        'ec-nav',
        get_theme_file_uri('/assets/js/nav.js'),
        array(),
        filemtime(get_theme_file_path('/assets/js/nav.js')),
        true
    );
});

add_action('woocommerce_thankyou', function () {
    printf(
        '<p class="thankyou-actions"><a class="home-btn home-btn--outline" href="%s">買い物を続ける</a></p>',
        esc_url(wc_get_page_permalink('shop'))
    );
}, 20);