<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header class="site-header">
        <h1 class="site-title">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <?php bloginfo('name'); ?>
            </a>
        </h1>

        <!-- ハンバーガーボタン(スマホ幅でのみ表示) -->
        <button type="button" class="header-toggle" aria-expanded="false" aria-controls="header-nav"
            aria-label="メニューを開く">
            <span class="header-toggle__bar"></span>
            <span class="header-toggle__bar"></span>
            <span class="header-toggle__bar"></span>
        </button>

        <nav class="header-nav" id="header-nav">
            <?php
            // トップページ以外では、メニューの先頭に「トップ」を追加する
            // (トップページ自体には出さない。管理画面のメニュー編集は不要)
            $home_item = '';
            if (!is_front_page()) {
                $home_item = sprintf(
                    '<li class="menu-item menu-item-home"><a href="%s">トップ</a></li>',
                    esc_url(home_url('/'))
                );
                $home_item = str_replace('%', '%%', $home_item); // items_wrap 内で % を壊さないため
            }

            wp_nav_menu(array(
                'theme_location' => 'header-menu',
                'container' => false,
                'menu_class' => 'header-nav__list',
                'fallback_cb' => false,
                'items_wrap' => '<ul id="%1$s" class="%2$s">' . $home_item . '%3$s</ul>',
            ));
            ?>
        </nav>

        <div class="header-cart">
            <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="header-cart__link">
                カート
                <?php if (WC()->cart->get_cart_contents_count() > 0): ?>
                    <span class="header-cart__count">
                        <?php echo WC()->cart->get_cart_contents_count(); ?>
                    </span>
                <?php endif; ?>
            </a>
        </div>
    </header>