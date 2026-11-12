<?php
get_header();
if ( have_posts() ) : the_post();
	$slug = get_post_field( 'post_name' );
	$hero = [ 'gioi-thieu' => [ 'lobby', 'Giới thiệu về ' ], 'tuyen-dung' => [ 'office2', 'Cùng làm việc tại ' ] ][ $slug ] ?? null;
?>
<div class="page-hd"><div class="wrap">
	<nav class="crumbs center-c" aria-label="Breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a><span>›</span><b><?php the_title(); ?></b></nav>
	<h1><?php the_title(); ?></h1>
</div></div>
<article class="content page-article">
	<?php if ( $hero && pw_stock( $hero[0] ) ) echo '<div class="sv-hero page-hero">' . pw_stock_img( $hero[0], $hero[1] . get_bloginfo( 'name' ), 1200, true ) . '</div>'; ?>
	<?php if ( in_array( $slug, [ 'gioi-thieu', 'tuyen-dung', 'chinh-sach-bao-mat' ], true ) ) : ?><nav class="sv-toc" data-toc aria-label="Mục lục" hidden><b>Mục lục</b><ol></ol></nav><?php endif; ?>
	<div class="sv-content"><?php the_content(); ?></div>
</article>
<?php if ( in_array( $slug, [ 'lien-he', 'gioi-thieu', 'tuyen-dung' ], true ) ) : ?>
<section class="booking" id="dat-lich"><div class="wrap"><div class="book-card"><h2><?php echo $slug === 'tuyen-dung' ? 'Để lại số điện thoại, bộ phận nhân sự sẽ liên hệ lại với bạn' : 'Để lại số điện thoại để được nhận cuộc gọi tư vấn miễn phí'; ?></h2><?php get_template_part( 'template-parts/booking-form', null, [ 'id' => 'lh' ] ); ?></div></div></section>
<?php endif; endif; get_footer();
