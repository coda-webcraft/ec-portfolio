<?php
// カテゴリー(トップ階層のみ / 「未分類」は除外 / 商品が入っているものだけ)
$footer_cats = array();
if (function_exists('wc_get_page_permalink')) {
    $footer_cats = get_terms(
        array(
            'taxonomy' => 'product_cat',
            'parent' => 0,
            'hide_empty' => true,
            'exclude' => array((int) get_option('default_product_cat')),
        )
    );
}
?>

<footer class="site-footer">
    <div class="site-footer__inner">

        <div class="site-footer__brand">
            <p class="site-footer__logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <?php bloginfo('name'); ?>
                </a>
            </p>
            <p class="site-footer__lead">
                毎日に、そっと寄り添う<br>
                やさしい輝きを。
            </p>
        </div>

        <?php if (function_exists('wc_get_page_permalink')): ?>

            <nav class="site-footer__nav" aria-label="ショップ">
                <p class="site-footer__nav-title">Shop</p>
                <ul>
                    <li><a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">すべての商品</a></li>
                    <?php if (!empty($footer_cats) && !is_wp_error($footer_cats)): ?>
                        <?php foreach ($footer_cats as $cat): ?>
                            <li><a href="<?php echo esc_url(get_term_link($cat)); ?>">
                                    <?php echo esc_html($cat->name); ?>
                                </a></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </nav>

            <nav class="site-footer__nav" aria-label="ご利用について">
                <p class="site-footer__nav-title">Info</p>
                <ul>
                    <li><a href="<?php echo esc_url(wc_get_cart_url()); ?>">カート</a></li>
                    <li><a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>">マイアカウント</a></li>
                </ul>
            </nav>

        <?php endif; ?>

    </div>

    <p class="site-footer__copy">
        &copy;
        <?php echo esc_html(date('Y')); ?>
        <?php bloginfo('name'); ?>
    </p>
</footer>

<?php wp_footer(); ?>

</body>

</html>