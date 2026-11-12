<?php
/**
 * Hình minh hoạ hàm răng (SVG vẽ bằng code – không phụ thuộc ảnh ngoài) cho khối "Trước & sau".
 *  pw_teeth_svg( 'bad',  $v )  → răng hư / lệch lạc / ố vàng (v = 0 chen chúc, 1 thưa hô, 2 ố vàng + sâu + mẻ, 3 chen chúc đảo bên)
 *  pw_teeth_svg( 'good', $v )  → răng đều, trắng sáng, nướu hồng khoẻ
 * Khi có ảnh thật (trường "URL ảnh TRƯỚC/SAU" của ca điều trị) thì dùng ảnh thật, hình này chỉ là mặc định.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pw_teeth_svg( $state = 'good', $variant = 0 ) {
	static $n = 0; $n++;
	$bad = ( $state === 'bad' );
	$v   = abs( (int) $variant ) % 4;
	$rev = ( $v === 3 );              // biến thể 3 = biến thể 0 lật gương
	$vm  = $rev ? 0 : $v;

	$W  = [ 72, 58, 60, 54, 56 ];     // bề rộng răng từ giữa ra ngoài (cửa, bên, nanh, tiền hàm, hàm)
	$H  = [ 134, 120, 134, 110, 100 ];  // chiều cao hàm trên
	$HL = [ 96, 90, 96, 82, 76 ];     // chiều cao hàm dưới
	$ord = [ 4, 3, 2, 1, 0, 0, 1, 2, 3, 4 ];

	$mods = [
		0 => [ 'rot' => [ -6, 8, -16, 12, -7, 9, -12, 18, -8, 6 ], 'dy' => [ 6, -8, 14, -6, 10, -10, 12, -6, 8, -2 ], 'dw' => [ -4, 8, -8, 10, -2, 4, -6, 10, -4, 2 ], 'dh' => [ -6, 4, -12, 6, -8, 10, -10, 4, -4, 0 ], 'gap' => -7 ],
		1 => [ 'rot' => [ 0, 3, -4, 2, -2, 2, -3, 4, -3, 0 ], 'dy' => [ 0, 2, -2, 0, 0, 0, 0, -2, 2, 0 ], 'dw' => [ 0, -4, -6, -4, -8, -8, -4, -6, -4, 0 ], 'dh' => [ 0, -4, 0, -4, -6, -6, -4, 0, -4, 0 ], 'gap' => 11 ],
		2 => [ 'rot' => [ 2, -3, 2, -2, 1, -1, 3, -2, 3, -2 ], 'dy' => [ 0, 2, 0, 2, 0, 0, 2, 0, 2, 0 ], 'dw' => [ 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ], 'dh' => [ 0, -2, 0, -4, 0, 0, -4, 0, -2, 0 ], 'gap' => 1 ],
	];
	$z = [ 'rot' => array_fill( 0, 10, 0 ), 'dy' => [ 12, 7, 3, 1, 0, 0, 1, 3, 7, 12 ], 'dw' => array_fill( 0, 10, 0 ), 'dh' => array_fill( 0, 10, 0 ), 'gap' => 2 ];
	$m = $bad ? $mods[ $vm ] : $z;
	if ( $bad && $rev ) foreach ( [ 'rot', 'dy', 'dw', 'dh' ] as $k ) $m[ $k ] = array_reverse( $m[ $k ] );
	if ( $bad ) { // hàm dưới lệch kiểu khác hàm trên cho tự nhiên
		$lo = [ 'rot' => array_merge( array_slice( $m['rot'], 4 ), array_slice( $m['rot'], 0, 4 ) ), 'dy' => array_merge( array_slice( $m['dy'], 3 ), array_slice( $m['dy'], 0, 3 ) ) ];
	} else {
		$lo = [ 'rot' => array_fill( 0, 10, 0 ), 'dy' => [ 10, 6, 3, 1, 0, 0, 1, 3, 6, 10 ] ];
	}

	$cx = 480; $g1 = 168; $g2 = 384;
	$palette = $bad ? ( [ 0 => [ '#efe2a6', '#e8d58e', '#ecd99a' ], 1 => [ '#ebd98f', '#e3cb7c', '#e7d287' ], 2 => [ '#d8b85a', '#cfa84a', '#c99f40' ] ][ $vm ] ) : [ '#ffffff', '#fbfdff', '#f6f9fc' ];
	$edge = $bad ? '#a98a3d' : '#cdd7e4';

	$teeth = function ( $widths, $heights, $dyBase, $rots, $dys, $dws, $dhs, $gap, $upper ) use ( $n, $ord, $palette, $edge, $bad, $g1, $g2, $cx ) {
		$tw = 0; foreach ( $ord as $i => $o ) $tw += $widths[ $o ] + ( $dws[ $i ] ?? 0 );
		$tw += $gap * 9;
		$x = $cx - $tw / 2; $out = '';
		foreach ( $ord as $i => $o ) {
			$w = $widths[ $o ] + ( $dws[ $i ] ?? 0 );
			$h = $heights[ $o ] + ( $dhs[ $i ] ?? 0 );
			$dy = $dys[ $i ] ?? 0; $rot = $rots[ $i ] ?? 0;
			if ( $upper ) { $top = $g1 - 34 + $dy; $ht = $h + 34; }
			else { $top = $g2 - $h + $dy * 0.6; $ht = $h + 34; }
			$c = $palette[ $i % count( $palette ) ];
			$mx = $x + $w / 2; $my = $top + $ht / 2;
			$rx = $w * 0.34;
			$out .= '<g transform="rotate(' . $rot . ' ' . round( $mx, 1 ) . ' ' . round( $my, 1 ) . ')">';
			$out .= '<rect x="' . round( $x, 1 ) . '" y="' . round( $top, 1 ) . '" width="' . $w . '" height="' . round( $ht, 1 ) . '" rx="' . round( $rx, 1 ) . '" fill="' . $c . '" stroke="' . $edge . '" stroke-width="1.4"/>';
			$out .= '<rect x="' . round( $x, 1 ) . '" y="' . round( $top, 1 ) . '" width="' . $w . '" height="' . round( $ht, 1 ) . '" rx="' . round( $rx, 1 ) . '" fill="url(#pwShade' . $n . ( $upper ? 'U' : 'L' ) . ')"/>';
			$out .= '<ellipse cx="' . round( $x + $w * 0.32, 1 ) . '" cy="' . round( $upper ? $top + $ht * 0.55 : $top + $ht * 0.4, 1 ) . '" rx="' . round( $w * 0.12, 1 ) . '" ry="' . round( $ht * 0.2, 1 ) . '" fill="#fff" opacity="' . ( $bad ? '.22' : '.7' ) . '"/>';
			$out .= '</g>';
			$x += $w + $gap;
		}
		return $out;
	};

	$id = 'pw' . ( $bad ? 'B' : 'G' ) . $n . '_';
	$s  = '<svg class="teeth" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 960 540" preserveAspectRatio="xMidYMid slice" role="img" aria-label="' . ( $bad ? 'Răng trước điều trị' : 'Răng sau điều trị' ) . '">';
	$s .= '<defs>'
		. '<linearGradient id="' . $id . 'bg" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="' . ( $bad ? '#8d867c' : '#d9f1ff' ) . '"/><stop offset="1" stop-color="' . ( $bad ? '#5b564f' : '#f4fbff' ) . '"/></linearGradient>'
		. '<linearGradient id="' . $id . 'lip" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="' . ( $bad ? '#b4636a' : '#e98a98' ) . '"/><stop offset="1" stop-color="' . ( $bad ? '#8e4850' : '#d1626f' ) . '"/></linearGradient>'
		. '<linearGradient id="' . $id . 'gum" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="' . ( $bad ? '#a63536' : '#f3a0ab' ) . '"/><stop offset="1" stop-color="' . ( $bad ? '#c9514f' : '#e47b8a' ) . '"/></linearGradient>'
		. '<radialGradient id="' . $id . 'in" cx=".5" cy=".5" r=".6"><stop offset="0" stop-color="#5a2530"/><stop offset="1" stop-color="#2a0f16"/></radialGradient>'
		. '<linearGradient id="pwShade' . $n . 'U" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#000" stop-opacity="0"/><stop offset=".55" stop-color="#000" stop-opacity="0"/><stop offset="1" stop-color="#5b4a1a" stop-opacity="' . ( $bad ? '.22' : '.1' ) . '"/></linearGradient>'
		. '<linearGradient id="pwShade' . $n . 'L" x1="0" y1="1" x2="0" y2="0"><stop offset="0" stop-color="#000" stop-opacity="0"/><stop offset=".55" stop-color="#000" stop-opacity="0"/><stop offset="1" stop-color="#5b4a1a" stop-opacity="' . ( $bad ? '.2' : '.1' ) . '"/></linearGradient>'
		. '<clipPath id="' . $id . 'clip"><ellipse cx="' . $cx . '" cy="275" rx="340" ry="178"/></clipPath>'
		. '</defs>';
	$s .= '<rect width="960" height="540" fill="url(#' . $id . 'bg)"/>';
	$s .= '<ellipse cx="' . $cx . '" cy="275" rx="388" ry="224" fill="url(#' . $id . 'lip)"/>';
	$s .= '<ellipse cx="' . $cx . '" cy="275" rx="340" ry="178" fill="url(#' . $id . 'in)"/>';
	$s .= '<g clip-path="url(#' . $id . 'clip)">';

	// hàm dưới (vẽ trước), hàm trên đè lên
	$s .= $teeth( array_map( function ( $w ) { return round( $w * 0.8 ); }, $W ), $HL, 0, $lo['rot'], $lo['dy'], array_fill( 0, 10, 0 ), array_fill( 0, 10, 0 ), $bad ? max( $m['gap'], -3 ) : 2, false );
	$s .= $teeth( $W, $H, 0, $m['rot'], $m['dy'], $m['dw'], $m['dh'], $m['gap'], true );

	// dấu hiệu răng hư
	if ( $bad ) {
		$tw = 0; foreach ( $ord as $i => $o ) $tw += $W[ $o ] + $m['dw'][ $i ]; $tw += $m['gap'] * 9;
		$sx = $cx - $tw / 2; $pos = [];
		$x = $sx; foreach ( $ord as $i => $o ) { $w = $W[ $o ] + $m['dw'][ $i ]; $pos[ $i ] = [ $x + $w / 2, $w ]; $x += $w + $m['gap']; }
		for ( $i = 0; $i < 10; $i++ ) { // mảng bám ố vàng sát nướu
			$s .= '<rect x="' . round( $pos[ $i ][0] - $pos[ $i ][1] * 0.45, 1 ) . '" y="' . ( $g1 + $m['dy'][ $i ] - 2 ) . '" width="' . round( $pos[ $i ][1] * 0.9, 1 ) . '" height="26" rx="10" fill="#9a6b1c" opacity="' . ( $vm === 2 ? '.5' : '.28' ) . '"/>';
		}
		$spots = $vm === 2 ? [ 2, 7, 4 ] : ( $vm === 0 ? [ 3 ] : [ 6 ] );
		foreach ( $spots as $i ) {
			$s .= '<ellipse cx="' . round( $pos[ $i ][0], 1 ) . '" cy="' . ( $g1 + 60 + $m['dy'][ $i ] ) . '" rx="9" ry="11" fill="#2f2108" opacity=".88"/>';
			$s .= '<ellipse cx="' . round( $pos[ $i ][0] + 1, 1 ) . '" cy="' . ( $g1 + 60 + $m['dy'][ $i ] ) . '" rx="15" ry="17" fill="#6b4a12" opacity=".28"/>';
		}
		if ( $vm === 2 ) { // răng cửa bị mẻ
			$s .= '<path d="M' . round( $pos[4][0] + 10, 1 ) . ' ' . ( $g1 + 134 + $m['dy'][4] ) . ' l24 -34 l2 36 z" fill="#3a1820"/>';
			$s .= '<path d="M' . round( $pos[6][0] - 6, 1 ) . ' ' . ( $g1 + 118 ) . ' l5 -10 l7 10 z" fill="#3a1820" opacity=".9"/>';
		}
	}

	// nướu
	$gums = function ( $y, $dir, $swell ) use ( $id ) {
		$p = 'M60 ' . ( $dir > 0 ? 80 : 480 ) . ' L60 ' . $y;
		$xs = 60; $step = 60;
		for ( $x = 60; $x < 900; $x += $step ) $p .= ' Q' . ( $x + $step / 2 ) . ' ' . ( $y - $dir * 6 - $swell ) . ' ' . ( $x + $step ) . ' ' . ( $y + $dir * 18 + $dir * $swell );
		$p .= ' L900 ' . ( $dir > 0 ? 80 : 480 ) . ' Z';
		return '<path d="' . $p . '" fill="url(#' . $id . 'gum)"/>';
	};
	$s .= $gums( $g1, 1, $bad ? 6 : 0 ) . $gums( $g2, -1, $bad ? 5 : 0 );
	$s .= '</g>';
	// khoé môi + bóng
	$s .= '<ellipse cx="' . $cx . '" cy="275" rx="340" ry="178" fill="none" stroke="rgba(0,0,0,.18)" stroke-width="3"/>';
	if ( ! $bad ) { // lấp lánh
		foreach ( [ [ 430, 215, 9 ], [ 540, 232, 6 ], [ 372, 250, 5 ] ] as $st ) {
			$s .= '<path d="M' . $st[0] . ' ' . ( $st[1] - $st[2] * 2 ) . ' L' . ( $st[0] + $st[2] * 0.5 ) . ' ' . ( $st[1] - $st[2] * 0.5 ) . ' L' . ( $st[0] + $st[2] * 2 ) . ' ' . $st[1] . ' L' . ( $st[0] + $st[2] * 0.5 ) . ' ' . ( $st[1] + $st[2] * 0.5 ) . ' L' . $st[0] . ' ' . ( $st[1] + $st[2] * 2 ) . ' L' . ( $st[0] - $st[2] * 0.5 ) . ' ' . ( $st[1] + $st[2] * 0.5 ) . ' L' . ( $st[0] - $st[2] * 2 ) . ' ' . $st[1] . ' L' . ( $st[0] - $st[2] * 0.5 ) . ' ' . ( $st[1] - $st[2] * 0.5 ) . ' Z" fill="#fff" opacity=".95"/>';
		}
	}
	return $s . '</svg>';
}

/** Cúp "Red Diamond" vẽ bằng SVG: viên kim cương đỏ nhiều mặt cắt đặt trên trụ kính, đế đá đen viền vàng, bảng tên. */
function pw_trophy_svg() {
	$f = function ( $pts, $fill, $op = 1 ) { return '<polygon points="' . $pts . '" fill="' . $fill . '" fill-opacity="' . $op . '" stroke="#fff" stroke-opacity=".38" stroke-width=".9" stroke-linejoin="round"/>'; };
	$s  = '<svg class="trophy" viewBox="0 0 200 264" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Cúp Red Diamond">';
	$s .= '<defs>'
		. '<radialGradient id="tgGlow" cx=".5" cy=".42" r=".5"><stop offset="0" stop-color="#ff5a5a" stop-opacity=".35"/><stop offset="1" stop-color="#ff5a5a" stop-opacity="0"/></radialGradient>'
		. '<linearGradient id="tgGem1" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#ff9a9a"/><stop offset="1" stop-color="#e5232d"/></linearGradient>'
		. '<linearGradient id="tgGem2" x1="1" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#ff6b6f"/><stop offset="1" stop-color="#a50f1d"/></linearGradient>'
		. '<linearGradient id="tgGem3" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#d4202c"/><stop offset="1" stop-color="#6e0613"/></linearGradient>'
		. '<linearGradient id="tgGem4" x1="0" y1="0" x2="1" y2="0"><stop offset="0" stop-color="#8d0b19"/><stop offset="1" stop-color="#e83a43"/></linearGradient>'
		. '<linearGradient id="tgGlass" x1="0" y1="0" x2="1" y2="0"><stop offset="0" stop-color="#cfe6ff" stop-opacity=".75"/><stop offset=".45" stop-color="#ffffff" stop-opacity=".9"/><stop offset="1" stop-color="#9ec4e8" stop-opacity=".7"/></linearGradient>'
		. '<linearGradient id="tgGold" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#fff0b3"/><stop offset=".45" stop-color="#e2b13c"/><stop offset="1" stop-color="#8a5f12"/></linearGradient>'
		. '<linearGradient id="tgStone" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#3a3f4d"/><stop offset="1" stop-color="#0d1017"/></linearGradient>'
		. '<filter id="tgBlur" x="-20%" y="-50%" width="140%" height="200%"><feGaussianBlur stdDeviation="4"/></filter>'
		. '</defs>';
	$s .= '<circle cx="100" cy="104" r="98" fill="url(#tgGlow)"/>';
	$s .= '<ellipse cx="100" cy="250" rx="78" ry="8" fill="#0b1b3a" opacity=".28" filter="url(#tgBlur)"/>';
	// đế đá + viền vàng + bảng tên
	$s .= '<rect x="38" y="226" width="124" height="20" rx="4" fill="url(#tgStone)"/><rect x="38" y="226" width="124" height="2.4" rx="1.2" fill="#fff" opacity=".28"/>';
	$s .= '<rect x="52" y="208" width="96" height="19" rx="3" fill="url(#tgStone)"/><rect x="52" y="206" width="96" height="4" rx="1.5" fill="url(#tgGold)"/>';
	$s .= '<rect x="62" y="231" width="76" height="11" rx="2" fill="url(#tgGold)"/><text x="100" y="239" text-anchor="middle" font-family="Inter,Arial,sans-serif" font-size="6.4" font-weight="800" letter-spacing=".6" fill="#5a3b05">RED DIAMOND</text>';
	// kim cương
	$s .= '<g>'
		. $f( '26,84 72,44 60,84', 'url(#tgGem1)' )
		. $f( '72,44 60,84 100,84', 'url(#tgGem2)' )
		. $f( '72,44 128,44 100,84', 'url(#tgGem1)', .92 )
		. $f( '128,44 100,84 140,84', 'url(#tgGem2)' )
		. $f( '128,44 140,84 174,84', 'url(#tgGem4)' )
		. $f( '26,84 60,84 100,188', 'url(#tgGem3)' )
		. $f( '60,84 100,84 100,188', 'url(#tgGem2)', .96 )
		. $f( '100,84 140,84 100,188', 'url(#tgGem4)' )
		. $f( '140,84 174,84 100,188', 'url(#tgGem3)' )
		. '<polygon points="72,44 128,44 122,50 78,50" fill="#fff" opacity=".55"/>'
		. '<polygon points="30,84 70,48 62,84" fill="#fff" opacity=".16"/>'
		. '<polygon points="102,90 138,90 102,150" fill="#fff" opacity=".1"/>'
		. '</g>';
	// trụ kính
	$s .= '<path d="M84 176 L116 176 L122 208 L78 208 Z" fill="url(#tgGlass)" stroke="#fff" stroke-opacity=".7" stroke-width="1"/><path d="M90 178 L94 206" stroke="#fff" stroke-opacity=".85" stroke-width="2" stroke-linecap="round"/>';
	// lấp lánh
	foreach ( [ [ 150, 38, 9 ], [ 40, 58, 6 ], [ 164, 110, 5 ] ] as $st ) {
		list( $x, $y, $r ) = $st;
		$s .= '<path d="M' . $x . ' ' . ( $y - $r * 2 ) . ' L' . ( $x + $r * .45 ) . ' ' . ( $y - $r * .45 ) . ' L' . ( $x + $r * 2 ) . ' ' . $y . ' L' . ( $x + $r * .45 ) . ' ' . ( $y + $r * .45 ) . ' L' . $x . ' ' . ( $y + $r * 2 ) . ' L' . ( $x - $r * .45 ) . ' ' . ( $y + $r * .45 ) . ' L' . ( $x - $r * 2 ) . ' ' . $y . ' L' . ( $x - $r * .45 ) . ' ' . ( $y - $r * .45 ) . ' Z" fill="#fff"/>';
	}
	return $s . '</svg>';
}
