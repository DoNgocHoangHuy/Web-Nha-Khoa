<?php get_header(); $site = get_bloginfo( 'name' ); ?>
<div class="page-hd"><div class="wrap">
	<nav class="crumbs center-c" aria-label="Breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a><span>›</span><b>Bảng giá nha khoa <?php echo esc_html( $site ); ?></b></nav>
	<h1>Bảng giá nha khoa <?php echo esc_html( $site ); ?></h1>
</div></div>
<section class="section pv-sec"><div class="wrap"><?php get_template_part( 'template-parts/price-services' ); ?></div></section>
<?php if ( pw_price_rows() ) : ?>
<section class="section" style="background:var(--green-soft)"><div class="wrap"><?php get_template_part( 'template-parts/price-table' ); ?></div></section>
<?php endif; ?>
<section class="booking" id="dat-lich"><div class="wrap"><div class="book-card">
	<h2>Để lại số điện thoại để được nhận cuộc gọi tư vấn miễn phí</h2>
	<?php get_template_part( 'template-parts/booking-form', null, [ 'id' => 'bg' ] ); ?>
</div></div></section>
<?php get_footer();
