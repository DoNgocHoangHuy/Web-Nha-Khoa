<?php
/**
 * Trang nhóm dịch vụ (VD: Niềng răng trong suốt Invisalign) – hiện khi bấm vào một dịch vụ ở trang chủ.
 * Breadcrumb → H1 → Bộ lọc + lưới gói → Bài giới thiệu → Form đặt lịch.  (Đã bỏ "Tìm Parkway gần nhất".)
 */
get_header();
$term    = get_queried_object();
$content = $term ? get_term_meta( $term->term_id, 'pw_content', true ) : '';
if ( ! $content && $term ) $content = term_description( $term->term_id );
get_template_part( 'template-parts/service-list', null, [
	'title'  => $term->name,
	'crumbs' => [ [ 'Dịch vụ', get_post_type_archive_link( 'dich_vu' ) ], [ $term->name ] ],
] );
if ( $content ) : ?>
<section class="sv sl-article">
	<div class="wrap sl-narrow">
		<?php $content = pw_tokens( $content ); $seed = strpos( $content, '<!--pw-seed-->' ) !== false; ?>
		<div class="sv-hero"><?php echo pw_stock_img( pw_stock_for( $term->name ), $term->name, 1200, true ); ?></div>
		<div class="sv-content"><?php echo wp_kses( $seed ? $content : wpautop( $content ), pw_allowed_html() ); ?></div>
	</div>
</section>
<?php endif; ?>
<section class="booking" id="dat-lich">
	<div class="wrap"><div class="book-card">
		<h2>Để lại số điện thoại để được nhận cuộc gọi tư vấn miễn phí</h2>
		<?php get_template_part( 'template-parts/booking-form', null, [ 'id' => 'tx' ] ); ?>
	</div></div>
</section>
<?php get_footer();
