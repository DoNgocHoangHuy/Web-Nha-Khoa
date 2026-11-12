<?php get_header(); if ( have_posts() ) : the_post(); ?>
<div class="page-hd"><div class="wrap">
	<nav class="crumbs center-c" aria-label="Breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a><span>›</span><b><?php the_title(); ?></b></nav>
	<h1><?php the_title(); ?></h1>
</div></div>
<section class="booking uu-top" id="dat-lich"><div class="wrap">
	<div class="sv-content uu-intro"><?php the_content(); ?></div>
	<div class="book-card">
		<h2>Để lại số điện thoại để được nhận cuộc gọi tư vấn miễn phí</h2>
		<?php get_template_part( 'template-parts/booking-form', null, [ 'id' => 'ud' ] ); ?>
	</div>
</div></section>
<section class="sl"><div class="wrap">
	<h2 class="uu-h">Ưu đãi</h2>
	<?php $q = new WP_Query( [ 'post_type' => 'dich_vu', 'posts_per_page' => 24, 'orderby' => 'menu_order date', 'order' => 'ASC', 'no_found_rows' => true,
		'meta_query' => [ [ 'key' => 'price_old', 'value' => '', 'compare' => '!=' ], [ 'key' => 'price_new', 'value' => '', 'compare' => '!=' ] ] ] );
	if ( $q->have_posts() ) { echo '<div class="grid4">'; while ( $q->have_posts() ) { $q->the_post(); echo pw_service_card(); } echo '</div>'; } else echo '<p class="center">Chương trình ưu đãi sẽ sớm được cập nhật.</p>';
	wp_reset_postdata(); ?>
</div></section>
<?php endif; get_footer();
