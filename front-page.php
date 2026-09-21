<?php
/**
 * トップページ用テンプレート (front-page.php)
 *
 * 構成:
 *  1. メインビジュアル
 *  2. カテゴリー導線 (WooCommerce の商品カテゴリーを自動取得)
 *  3. 新着商品 (WooCommerce の商品を自動取得)
 *  4. ブランドストーリー
 *  5. 特徴 (3つ)
 */

get_header();

// WooCommerce が有効かどうか
$has_wc = function_exists( 'wc_get_products' );

// ショップページのURL(WooCommerce 無効時は /shop/ にフォールバック)
$shop_url = function_exists( 'wc_get_page_permalink' )
	? wc_get_page_permalink( 'shop' )
	: home_url( '/shop/' );

// メインビジュアル画像(assets/images/hero.jpg があれば表示、なければ色面のみ)
$hero_rel  = '/assets/images/hero.jpg';
$hero_path = get_theme_file_path( $hero_rel );
$hero_url  = file_exists( $hero_path ) ? get_theme_file_uri( $hero_rel ) : '';
?>

<main class="site-main home">

	<!-- 1. メインビジュアル -->
	<section class="home-hero">
		<div class="home-hero__inner">
			<div class="home-hero__body">
				<p class="home-hero__en">Everyday Jewelry</p>
				<h1 class="home-hero__title">
					毎日に、そっと寄り添う<br>
					やさしい輝きを。
				</h1>
				<p class="home-hero__text">
					ピアス・ネックレス・指輪。<br class="u-br-sp">
					肌になじむ、シンプルなアクセサリーを集めました。
				</p>
				<a class="home-btn" href="<?php echo esc_url( $shop_url ); ?>">ショップを見る</a>
			</div>

			<div class="home-hero__visual">
				<?php if ( $hero_url ) : ?>
					<img src="<?php echo esc_url( $hero_url ); ?>" alt="" width="640" height="720">
				<?php endif; ?>
			</div>
		</div>
	</section>

	<?php if ( $has_wc ) : ?>

		<?php
		// 2. カテゴリー(トップ階層のみ / 「未分類」は除外 / 商品が入っているものだけ)
		$categories = get_terms(
			array(
				'taxonomy'   => 'product_cat',
				'parent'     => 0,
				'hide_empty' => true,
				'exclude'    => array( (int) get_option( 'default_product_cat' ) ),
			)
		);
		?>
		<?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
			<section class="home-section home-category">
				<div class="home-section__inner">
					<header class="home-section__head">
						<p class="home-section__en">Category</p>
						<h2 class="home-section__title">カテゴリーから探す</h2>
					</header>

					<ul class="home-category__list">
						<?php foreach ( $categories as $cat ) : ?>
							<?php
							$thumb_id  = (int) get_term_meta( $cat->term_id, 'thumbnail_id', true );
							$thumb_url = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'medium_large' ) : '';
							?>
							<li class="home-category__item">
								<a class="home-category__link" href="<?php echo esc_url( get_term_link( $cat ) ); ?>">
									<span class="home-category__image">
										<?php if ( $thumb_url ) : ?>
											<img src="<?php echo esc_url( $thumb_url ); ?>" alt="" loading="lazy">
										<?php endif; ?>
									</span>
									<span class="home-category__name"><?php echo esc_html( $cat->name ); ?></span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</section>
		<?php endif; ?>

		<?php
		// 3. 新着商品(4件)
		$products = wc_get_products(
			array(
				'status'  => 'publish',
				'limit'   => 4,
				'orderby' => 'date',
				'order'   => 'DESC',
			)
		);
		?>
		<?php if ( ! empty( $products ) ) : ?>
			<section class="home-section home-products">
				<div class="home-section__inner">
					<header class="home-section__head">
						<p class="home-section__en">New Arrival</p>
						<h2 class="home-section__title">新着アイテム</h2>
					</header>

					<ul class="home-products__list">
						<?php foreach ( $products as $product ) : ?>
							<li class="home-products__item">
								<a class="home-products__link" href="<?php echo esc_url( $product->get_permalink() ); ?>">
									<span class="home-products__image">
										<?php echo wp_kses_post( $product->get_image( 'woocommerce_thumbnail' ) ); ?>
									</span>
									<span class="home-products__name"><?php echo esc_html( $product->get_name() ); ?></span>
									<span class="home-products__price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>

					<p class="home-section__more">
						<a class="home-btn home-btn--outline" href="<?php echo esc_url( $shop_url ); ?>">すべての商品を見る</a>
					</p>
				</div>
			</section>
		<?php endif; ?>

	<?php endif; ?>

	<!-- 4. ブランドストーリー -->
	<section class="home-section home-story">
		<div class="home-section__inner home-story__inner">
			<header class="home-section__head home-story__head">
				<p class="home-section__en">Story</p>
				<h2 class="home-section__title">EC-portfolio について</h2>
			</header>
			<div class="home-story__body">
				<p>
					「がんばりすぎない、毎日のおしゃれを。」<br>
					EC-portfolio は、シンプルで身につけやすいアクセサリーを届けるショップです。
				</p>
				<p>
					肌なじみのよいゴールドやパールを中心に、
					どんな服にも合わせやすいデザインを選びました。
					ひとつ身につけるだけで、いつもの装いがやわらかく華やぎます。
				</p>
			</div>
		</div>
	</section>

	<!-- 5. 特徴 -->
	<section class="home-section home-feature">
		<div class="home-section__inner">
			<ul class="home-feature__list">
				<li class="home-feature__item">
					<p class="home-feature__num">01</p>
					<h3 class="home-feature__title">やさしい素材</h3>
					<p class="home-feature__text">肌にふれるものだから、身につけやすい素材を選んでいます。</p>
				</li>
				<li class="home-feature__item">
					<p class="home-feature__num">02</p>
					<h3 class="home-feature__title">ギフトにも</h3>
					<p class="home-feature__text">贈りものに使いやすい、シンプルで丁寧な梱包でお届けします。</p>
				</li>
				<li class="home-feature__item">
					<p class="home-feature__num">03</p>
					<h3 class="home-feature__title">迅速な発送</h3>
					<p class="home-feature__text">ご注文から最短でお届けできるよう、順次発送いたします。</p>
				</li>
			</ul>
		</div>
	</section>

</main>

<?php
get_footer();
