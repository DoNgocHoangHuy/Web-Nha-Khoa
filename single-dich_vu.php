<?php
/**
 * Trang chi tiết dịch vụ:
 * Tiêu đề → [Ảnh + Nội dung] | [Hộp giá + nút gọi/đặt lịch] → Sản phẩm khác dành cho bạn → Form đặt lịch.
 * (Đã BỎ khối "Tìm Parkway gần nhất".)
 */
get_header();
if ( have_posts() ) : the_post();
	$id    = get_the_ID();
	$old   = get_post_meta( $id, 'price_old', true );
	$new   = get_post_meta( $id, 'price_new', true );
	$group = get_post_meta( $id, 'group_label', true );
	$note  = get_post_meta( $id, 'price_note', true );
	$unit  = get_post_meta( $id, 'unit', true );
	$note  = $note !== '' ? $note : '*Tuỳ thuộc chỉ định của bác sĩ';
	$unit  = $unit !== '' ? $unit : 'Lần';
	$disc  = pw_discount_any( $old, $new );
	$img   = pw_service_img( $id, 'large', 1000, true );
	$perks = array_filter( array_map( 'trim', explode( '|', (string) get_post_meta( $id, 'perks', true ) ) ) );
	$group_url = '';
	$terms = get_the_terms( $id, 'nhom_dich_vu' );
	if ( $terms && ! is_wp_error( $terms ) ) { $group = $group ?: $terms[0]->name; $group_url = get_term_link( $terms[0] ); }
	if ( ! $group_url ) $group_url = pw_group_url( $group, get_post_type_archive_link( 'dich_vu' ) ?: '#' );
?>
<div class="sv-top"><div class="wrap">
	<nav class="crumbs" aria-label="Breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a><span>›</span><a href="<?php echo esc_url( get_post_type_archive_link( 'dich_vu' ) ); ?>">Dịch vụ</a><?php if ( $group ) echo '<span>›</span><a href="' . esc_url( $group_url ) . '">' . esc_html( $group ) . '</a>'; ?></nav>
	<h1><?php the_title(); ?></h1>
</div></div>

<section class="sv">
	<div class="wrap sv-grid">
		<div class="sv-main">
			<div class="sv-hero"><?php echo $img; ?></div>
			<?php if ( $perks ) { echo '<ul class="sv-perks">'; foreach ( $perks as $pk ) echo '<li>' . pw_icon( 'check' ) . esc_html( $pk ) . '</li>'; echo '</ul>'; } ?>
			<h2 class="sv-h">Nội dung</h2>
			<nav class="sv-toc" data-toc aria-label="Mục lục" hidden><b>Mục lục</b><ol></ol></nav>
			<div class="sv-content content-body"><?php the_content(); ?></div>
		</div>

		<aside class="sv-side">
			<div class="sv-box">
				<?php if ( $disc ) echo '<span class="badge">Giảm ' . (int) $disc . '%</span>'; ?>
				<div class="sv-label">Giá dịch vụ</div>
				<div class="sv-price">
					<?php if ( $old ) echo '<del>' . esc_html( pw_money( $old ) ) . '</del>'; ?>
					<?php if ( $new ) echo '<b>' . esc_html( pw_money( $new ) ) . '</b>'; else echo '<b>Liên hệ</b>'; ?>
				</div>
				<p class="sv-note"><?php echo esc_html( $note ); ?></p>
				<dl class="sv-meta">
					<div><dt>Đơn vị:</dt><dd><?php echo esc_html( $unit ); ?></dd></div>
					<?php if ( $group ) : ?><div><dt>Dịch vụ:</dt><dd><a href="<?php echo esc_url( $group_url ); ?>"><?php echo esc_html( $group ); ?></a></dd></div><?php endif; ?>
				</dl>
				<a class="btn btn-navy sv-btn" href="tel:<?php echo esc_attr( pw_tel() ); ?>"><?php echo pw_icon( 'phone' ); ?><span>Gọi ngay <small>(Đặt hẹn, Tư vấn miễn phí)</small></span></a>
				<a class="btn btn-soft sv-btn" href="#dat-lich"><?php echo pw_icon( 'calendar' ); ?><span>Đặt lịch ngay</span></a>
				<ul class="sv-guar">
					<li><?php echo pw_icon( 'shield' ); ?>Báo giá rõ ràng trước điều trị</li>
					<li><?php echo pw_icon( 'card' ); ?>Hỗ trợ trả góp 0% lãi suất</li>
					<li><?php echo pw_icon( 'clock' ); ?>Giờ làm việc: <?php echo esc_html( pw_opt( 'pw_hours' ) ); ?></li>
				</ul>
			</div>
		</aside>
	</div>
</section>

<?php
/* ============ Sản phẩm khác dành cho bạn ============ */
$rel = [];
$args = [ 'post_type' => 'dich_vu', 'posts_per_page' => 8, 'post__not_in' => [ $id ], 'no_found_rows' => true, 'orderby' => 'menu_order date', 'order' => 'ASC' ];
$pass = [];
if ( $group ) $pass[] = [ 'meta_query' => [ [ 'key' => 'group_label', 'value' => $group ] ] ];
$pass[] = [ 'meta_query' => [ [ 'key' => 'price_new', 'compare' => 'EXISTS' ] ] ];   // dịch vụ có giá
foreach ( $pass as $extra ) {
	if ( count( $rel ) >= 4 ) break;
	$q = new WP_Query( $args + $extra );
	while ( $q->have_posts() ) { $q->the_post();
		if ( isset( $rel[ get_the_ID() ] ) ) continue;
		$g = get_post_meta( get_the_ID(), 'group_label', true );
		$rel[ get_the_ID() ] = [ 'title' => get_the_title(), 'url' => get_permalink(), 'old' => get_post_meta( get_the_ID(), 'price_old', true ), 'new' => get_post_meta( get_the_ID(), 'price_new', true ), 'grp' => $g,
			'img' => has_post_thumbnail() ? get_the_post_thumbnail( null, 'pw-card', [ 'loading' => 'lazy' ] ) : pw_stock_img( pw_stock_for( get_the_title() . ' ' . $g ), get_the_title(), 600 ) ];
	}
	wp_reset_postdata();
}
if ( $rel ) : ?>
<section class="section sv-rel">
	<div class="wrap">
		<h2 class="section-title">Sản phẩm khác dành cho bạn</h2>
		<div class="rail" data-rail style="margin-top:24px">
			<button class="rail-btn prev" type="button" aria-label="Trước"><?php echo pw_icon( 'left' ); ?></button>
			<div class="rail-track sv-track">
				<?php foreach ( $rel as $it ) : $d = pw_discount_any( $it['old'], $it['new'] ); ?>
				<article class="pcard">
					<?php if ( $d ) echo '<span class="badge">Giảm ' . (int) $d . '%</span>'; ?>
					<a class="im" href="<?php echo esc_url( $it['url'] ); ?>"><?php echo $it['img']; ?></a>
					<div class="bd">
						<h3><a href="<?php echo esc_url( $it['url'] ); ?>"><?php echo esc_html( $it['title'] ); ?></a></h3>
						<?php if ( $it['grp'] ) echo '<span class="tag">' . esc_html( $it['grp'] ) . '</span>'; ?>
						<div class="price"><?php if ( $it['old'] ) echo '<del>' . esc_html( pw_money( $it['old'] ) ) . '</del>'; if ( $it['new'] ) echo '<b>' . esc_html( pw_money( $it['new'] ) ) . '</b>'; ?></div>
						<a class="btn btn-soft" href="<?php echo esc_url( $it['url'] ); ?>">Xem chi tiết</a>
					</div>
				</article>
				<?php endforeach; ?>
			</div>
			<button class="rail-btn next" type="button" aria-label="Sau"><?php echo pw_icon( 'right' ); ?></button>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- Form đặt lịch -->
<section class="booking" id="dat-lich">
	<div class="wrap">
		<div class="book-card">
			<h2>Để lại số điện thoại để được nhận cuộc gọi tư vấn miễn phí</h2>
			<?php get_template_part( 'template-parts/booking-form', null, [ 'id' => 'sv' ] ); ?>
		</div>
	</div>
</section>
<?php endif; get_footer();
