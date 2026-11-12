<?php get_header(); if ( have_posts() ) : the_post();
	$role = get_post_meta( get_the_ID(), 'role', true ) ?: 'Bác sĩ';
	$bul  = array_filter( array_map( 'trim', explode( "\n", (string) get_post_meta( get_the_ID(), 'bullets', true ) ) ) );
	$img  = has_post_thumbnail() ? get_the_post_thumbnail( null, 'large' ) : pw_stock_img( 'doctor', get_the_title(), 800, true ); ?>
<div class="sv-top"><div class="wrap">
	<nav class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a><span>›</span><a href="<?php echo esc_url( get_post_type_archive_link( 'bac_si' ) ); ?>">Đội ngũ bác sĩ</a></nav>
	<h1><?php the_title(); ?></h1>
</div></div>
<section class="sv"><div class="wrap sv-grid">
	<div class="sv-main">
		<small class="muted"><?php echo esc_html( $role ); ?></small>
		<?php if ( $bul ) { echo '<h2 class="sv-h">Chuyên môn &amp; chứng chỉ</h2><ul class="sv-check">'; foreach ( $bul as $b ) echo '<li>' . esc_html( $b ) . '</li>'; echo '</ul>'; } ?>
		<?php if ( get_the_content() ) { echo '<h2 class="sv-h">Giới thiệu</h2><div class="sv-content">'; the_content(); echo '</div>'; } ?>
	</div>
	<aside class="sv-side"><div class="sv-box"><div class="sv-hero" style="aspect-ratio:4/5"><?php echo $img; ?></div>
		<a class="btn btn-navy sv-btn" href="#dat-lich"><?php echo pw_icon( 'calendar' ); ?><span>Đặt lịch khám với bác sĩ</span></a></div></aside>
</div></section>
<section class="booking" id="dat-lich"><div class="wrap"><div class="book-card"><h2>Để lại số điện thoại để được nhận cuộc gọi tư vấn miễn phí</h2><?php get_template_part( 'template-parts/booking-form', null, [ 'id' => 'bs' ] ); ?></div></div></section>
<?php endif; get_footer();
