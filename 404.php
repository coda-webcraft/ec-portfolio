<?php
/**
 * 404 ページ (ページが見つからないとき)
 */

get_header();

$shop_url = function_exists('wc_get_page_permalink')
    ? wc_get_page_permalink('shop')
    : home_url('/');
?>

<main class="site-main not-found">
    <div class="not-found__inner">
        <p class="not-found__en">404 Not Found</p>
        <h1 class="not-found__title">ページが見つかりませんでした</h1>
        <p class="not-found__text">
            お探しのページは、移動または削除された可能性があります。<br>
            URLをご確認いただくか、ショップからお探しください。
        </p>
        <div class="not-found__actions">
            <a class="home-btn" href="<?php echo esc_url($shop_url); ?>">ショップを見る</a>
            <a class="home-btn home-btn--outline" href="<?php echo esc_url(home_url('/')); ?>">トップへ戻る</a>
        </div>
    </div>
</main>

<?php
get_footer();
