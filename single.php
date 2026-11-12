<?php
get_header();
if ( have_posts() ) : the_post();
	$id = get_the_ID();
	$cat = pw_main_cat( $id );
	$press = has_category( 'bao-chi', $id );
	$src = get_post_meta( $id, 'press_src', true );
	$url = get_post_meta( $id, 'press_url', true );
	$cat_url = $cat ? get_category_link( $cat ) : pw_cat_url( 'kien-thuc-nha-khoa' );
?>
<section class="art"><div class="wrap art-grid">
	<article class="art-main">
		<nav class="crumbs" aria-label="Breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a><span>&gt;</span><?php if ( $cat ) echo '<a href="' . esc_url( $cat_url ) . '">' . esc_html( $cat->name ) . '</a>'; ?></nav>
		<time class="art-time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_time( 'H:i:s' ) . ' ' . get_the_date( 'd/m/Y' ) ); ?><?php if ( $press && $src ) echo ' · Nguồn: ' . esc_html( $src ); ?></time>
		<h1 class="art-title"><?php the_title(); ?></h1>
		<div class="art-hero"><?php echo pw_post_hero( $id ); ?></div>
		<div class="sv-content content-body"><?php the_content(); ?></div>
		<?php if ( $press && $url ) : ?><p class="art-src">Bài viết gốc: <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener nofollow"><?php echo esc_html( $src ?: 'Xem nguồn' ); ?> ↗</a></p><?php endif; ?>
		<div class="art-share"><span>Chia sẻ:</span>
			<a target="_blank" rel="noopener" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_permalink() ); ?>">Facebook</a>
			<a target="_blank" rel="noopener" href="https://zalo.me/share?u=<?php echo rawurlencode( get_permalink() ); ?>">Zalo</a>
			<button type="button" data-copy="<?php echo esc_attr( get_permalink() ); ?>">Sao chép link</button>
		</div>
		<?php $pv = get_previous_post( true ); $nx = get_next_post( true );
		if ( $pv || $nx ) : ?>
		<nav class="art-nav">
			<?php if ( $pv ) echo '<a href="' . esc_url( get_permalink( $pv ) ) . '"><small>← Bài trước</small><b>' . esc_html( get_the_title( $pv ) ) . '</b></a>'; else echo '<span></span>'; ?>
			<?php if ( $nx ) echo '<a class="r" href="' . esc_url( get_permalink( $nx ) ) . '"><small>Bài sau →</small><b>' . esc_html( get_the_title( $nx ) ) . '</b></a>'; ?>
		</nav>
		<?php endif; ?>
	</article>
	<?php echo pw_hot_news( $id ); ?>
</div></section>

<section class="booking" id="dat-lich">
	<div class="wrap"><div class="book-card">
		<h2>Để lại số điện thoại để được nhận cuộc gọi tư vấn miễn phí</h2>
		<?php get_template_part( 'template-parts/booking-form', null, [ 'id' => 'po' ] ); ?>
	</div></div>
</section>
<?php endif; get_footer();
