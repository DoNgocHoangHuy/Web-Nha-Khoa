<?php
get_header();
$is_cat   = is_category();
$cur      = $is_cat ? get_queried_object() : null;
$is_press = $cur && $cur->slug === 'bao-chi';
$title    = is_search() ? sprintf( 'Kết quả cho: %s', get_search_query() ) : ( $is_cat ? single_cat_title( '', false ) : ( is_home() ? 'Bản tin' : get_the_archive_title() ) );
$desc     = $cur && $cur->description ? $cur->description : '';
if ( ! $desc && $cur ) {
	$desc = [ 'kien-thuc-nha-khoa' => 'Giải đáp các thắc mắc thường gặp về niềng răng, trồng răng, bọc sứ, tẩy trắng… từ đội ngũ bác sĩ.', 'tin-tuc-su-kien' => 'Chương trình ưu đãi, hoạt động và sự kiện mới nhất tại phòng khám.', 'bao-chi' => 'Những bài viết, chương trình truyền thông nói về phòng khám và chia sẻ của đội ngũ bác sĩ.' ][ $cur->slug ] ?? '';
}
$tabs = [];
foreach ( [ 'kien-thuc-nha-khoa' => 'Kiến thức nha khoa', 'tin-tuc-su-kien' => 'Tin tức sự kiện', 'bao-chi' => 'Báo chí nói về chúng tôi' ] as $sl => $nm ) $tabs[] = [ $nm, pw_cat_url( $sl ), $cur && $cur->slug === $sl ];
?>
<?php if ( $is_press ) : ?>
<div class="page-hd hub-hd"><div class="wrap">
	<nav class="crumbs center-c" aria-label="Breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a><span>›</span><b><?php echo esc_html( $title ); ?></b></nav>
	<h1><?php echo esc_html( $title ); ?></h1>
	<?php if ( $desc ) echo '<p class="hub-d">' . esc_html( $desc ) . '</p>'; ?>
</div></div>
<?php endif; ?>
<section class="section lst-sec"><div class="wrap">
<?php if ( $is_press ) : ?>
	<?php if ( have_posts() ) : ?>
		<div class="press-grid"><?php while ( have_posts() ) { the_post(); echo pw_press_card(); } ?></div>
		<div class="pager"><?php echo paginate_links( [ 'prev_text' => '‹', 'next_text' => '›' ] ); ?></div>
	<?php else : ?><p class="center">Chưa có nội dung phù hợp.</p><?php endif; ?>
<?php else : ?>
	<div class="lst-grid">
		<div class="lst-main">
			<h1 class="lst-title"><?php echo esc_html( $title ); ?></h1>
			<?php if ( have_posts() ) : while ( have_posts() ) { the_post(); echo pw_list_card(); } ?>
				<div class="pager"><?php echo paginate_links( [ 'prev_text' => '‹', 'next_text' => '›', 'mid_size' => 1, 'end_size' => 1 ] ); ?></div>
			<?php else : ?><p class="center">Chưa có nội dung phù hợp.</p><?php endif; ?>
		</div>
		<?php echo pw_hot_news(); ?>
	</div>
<?php endif; ?>
</div></section>
<?php get_footer();
