<?php
/** Bảng giá theo nhóm dịch vụ (kiểu Parkway): mỗi nhóm một bảng – Tên | Giá | Đơn vị tính | Chi tiết. */
$groups = [];
foreach ( pw_top_groups() as $gname ) {
	$term = get_term_by( 'name', $gname, 'nhom_dich_vu' );
	if ( ! $term ) continue;
	$q = new WP_Query( [ 'post_type' => 'dich_vu', 'posts_per_page' => 60, 'no_found_rows' => true, 'orderby' => 'menu_order date', 'order' => 'ASC',
		'tax_query' => [ [ 'taxonomy' => 'nhom_dich_vu', 'field' => 'term_id', 'terms' => $term->term_id ] ],
		'meta_query' => [ [ 'key' => 'price_new', 'value' => '', 'compare' => '!=' ] ] ] );
	if ( $q->have_posts() ) $groups[ $term->slug ] = [ $gname, $q ];
}
if ( ! $groups ) return;
?>
<div class="pv" data-pv>
	<p class="pv-sub">Bảng giá dịch vụ làm răng mới nhất <?php echo esc_html( wp_date( 'Y' ) ); ?></p>
	<div class="pv-pick"><b>Chọn dịch vụ</b>
		<div class="pv-chips"><button type="button" class="on" data-g="all">Tất cả</button>
		<?php foreach ( $groups as $slug => $g ) echo '<button type="button" data-g="' . esc_attr( $slug ) . '">' . esc_html( $g[0] ) . '</button>'; ?></div>
	</div>
	<?php foreach ( $groups as $slug => $g ) : ?>
	<div class="pv-group" data-group="<?php echo esc_attr( $slug ); ?>" id="gia-<?php echo esc_attr( $slug ); ?>">
		<table class="pv-t">
			<thead><tr><th><?php echo esc_html( $g[0] ); ?></th><th>Giá</th><th>Đơn vị tính</th><th><span class="sr">Chi tiết</span></th></tr></thead>
			<tbody>
			<?php while ( $g[1]->have_posts() ) : $g[1]->the_post();
				$old = get_post_meta( get_the_ID(), 'price_old', true ); $new = get_post_meta( get_the_ID(), 'price_new', true );
				$unit = get_post_meta( get_the_ID(), 'unit', true ) ?: 'Lần'; $d = pw_discount_any( $old, $new ); ?>
				<tr>
					<td data-l="Dịch vụ"><a class="nm" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php if ( $d ) echo ' <span class="off">-' . (int) $d . '%</span>'; ?></td>
					<td data-l="Giá" class="pr"><?php if ( $old ) echo '<del>' . esc_html( pw_money( $old ) ) . '</del>'; echo '<b>' . esc_html( pw_money( $new ) ) . '</b>'; ?></td>
					<td data-l="Đơn vị tính" class="un"><?php echo esc_html( $unit ); ?></td>
					<td class="go"><a class="btn btn-soft" href="<?php the_permalink(); ?>">Chi tiết</a></td>
				</tr>
			<?php endwhile; wp_reset_postdata(); ?>
			</tbody>
		</table>
	</div>
	<?php endforeach; ?>
	<ul class="pv-notes">
		<li>Dịch vụ không chịu thuế GTGT.</li>
		<li>Bảng giá mang tính tham khảo. Chi phí thực tế được xác định sau khi bác sĩ thăm khám và chỉ định.</li>
		<li>Hiệu quả điều trị phụ thuộc vào cơ địa mỗi người (*).</li>
	</ul>
</div>
