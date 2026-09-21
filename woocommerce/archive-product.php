<?php
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="shop-page">

    <?php
    // パンくずなど
    do_action( 'woocommerce_before_main_content' );
    ?>

    <header class="shop-header">
        <h1 class="shop-header__title"><?php woocommerce_page_title(); ?></h1>
        <?php
        // カテゴリーの説明文(設定されている場合のみ表示)
        do_action( 'woocommerce_archive_description' );
        ?>
    </header>

    <?php
    if ( woocommerce_product_loop() ) {

        echo '<ul class="shop-grid">';

        while ( have_posts() ) {
            the_post();
            wc_get_template_part( 'content', 'product' );
        }

        echo '</ul>';

        // ページネーション(商品が多いとき用)
        do_action( 'woocommerce_after_shop_loop' );

    } else {
        do_action( 'woocommerce_no_products_found' );
    }

    do_action( 'woocommerce_after_main_content' );
    ?>

</div>

<?php
get_footer();
