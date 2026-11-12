<?php
$rows = pw_price_rows(); if ( ! $rows ) return;
$max = 1; $tiers = [];
foreach ( $rows as $r ) { $max = max( $max, pw_price_num( $r[4] ) ); $tiers[ $r[5] ] = true; }
?>
<div class="pxb" data-pxb>
	<div class="pxb-hd">
		<span class="eyebrow">Bảng giá minh bạch</span>
		<h2><?php echo esc_html( pw_opt( 'pw_price_title' ) ); ?> <em>tại <?php bloginfo( 'name' ); ?></em></h2>
		<p>Giá niêm yết theo từng dòng sứ, bảo hành ghi rõ trong hợp đồng.</p>
		<?php if ( count( $tiers ) > 1 ) : ?>
		<div class="pxb-tabs" role="tablist" aria-label="Lọc theo thời gian bảo hành">
			<button type="button" class="on" data-w="all">Tất cả</button>
			<?php foreach ( array_keys( $tiers ) as $w ) if ( $w !== '' ) echo '<button type="button" data-w="' . esc_attr( $w ) . '">Bảo hành ' . esc_html( $w ) . '</button>'; ?>
		</div>
		<?php endif; ?>
	</div>
	<div class="pxb-wrap">
		<table class="pxb-t">
			<thead><tr><th>Dòng sứ</th><th>Xuất xứ</th><th>Đơn vị</th><th>Giá từ</th><th>Bảo hành</th><th><span class="sr">Báo giá</span></th></tr></thead>
			<tbody>
			<?php foreach ( $rows as $r ) : $yrs = (int) $r[5]; $pct = max( 8, round( pw_price_num( $r[4] ) / $max * 100 ) ); $line = ( $r[1] !== '' && mb_strtolower( $r[1] ) !== mb_strtolower( $r[0] ) ) ? $r[1] : ''; ?>
				<tr class="<?php echo $yrs >= 15 ? 'is-premium' : ''; ?>" data-w="<?php echo esc_attr( $r[5] ); ?>">
					<td data-l="Dòng sứ"><b><?php echo esc_html( $r[0] ); ?></b><?php if ( $line ) echo '<small>' . esc_html( $line ) . '</small>'; ?></td>
					<td data-l="Xuất xứ"><span class="chip"><?php echo esc_html( $r[2] ); ?></span></td>
					<td data-l="Đơn vị"><?php echo esc_html( $r[3] ); ?></td>
					<td data-l="Giá từ" class="pc"><b><?php echo esc_html( $r[4] ); ?></b><i style="--w:<?php echo (int) $pct; ?>%"></i></td>
					<td data-l="Bảo hành"><span class="wr"><?php echo pw_icon( 'shield' ); ?><?php echo esc_html( $r[5] ); ?></span></td>
					<td class="go"><?php if ( $r[6] !== '' && ! preg_match( '/liên hệ/iu', $r[6] ) ) echo '<span class="offer">' . esc_html( $r[6] ) . '</span>'; ?><button type="button" class="btn btn-soft" data-open-contact>Nhận báo giá</button></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<ul class="pxb-ft">
		<li><?php echo pw_icon( 'check' ); ?>Báo giá trước khi điều trị</li>
		<li><?php echo pw_icon( 'card' ); ?>Trả góp 0% lãi suất</li>
		<li><?php echo pw_icon( 'shield' ); ?>Bảo hành ghi trong hợp đồng</li>
	</ul>
	<?php if ( $n = pw_opt( 'pw_price_note' ) ) echo '<p class="price-note">' . esc_html( $n ) . '</p>'; ?>
</div>
