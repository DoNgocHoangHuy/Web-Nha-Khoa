<?php get_header(); ?>
<div class="page-hd"><div class="wrap"><h1>Đội ngũ bác sĩ</h1></div></div>
<section class="section"><div class="wrap"><div class="grid4">
<?php while ( have_posts() ) : the_post(); $role = get_post_meta( get_the_ID(), 'role', true ) ?: 'Bác sĩ'; ?>
	<article class="pcard"><a class="im" href="<?php the_permalink(); ?>"><?php echo has_post_thumbnail() ? get_the_post_thumbnail( null, 'pw-card' ) : pw_stock_img( 'doctor', get_the_title(), 600 ); ?></a>
	<div class="bd"><span class="tag"><?php echo esc_html( $role ); ?></span><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><a class="btn btn-soft" href="<?php the_permalink(); ?>">Xem chi tiết</a></div></article>
<?php endwhile; ?>
</div><div class="pager"><?php echo paginate_links( [ 'prev_text' => '‹', 'next_text' => '›' ] ); ?></div></div></section>
<?php get_footer();
