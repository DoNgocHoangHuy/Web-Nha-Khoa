<?php
/**
 * Thư viện ảnh nha khoa mặc định (Unsplash, dùng miễn phí).
 * Chỉ dùng khi mục đó CHƯA có ảnh đại diện/ảnh upload. Khi đăng nội dung thật,
 * ảnh thật sẽ tự thay thế. Muốn tự host: tải ảnh về assets/img/ rồi đổi URL ở đây.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pw_stock( $key, $w = 800 ) {
	static $m = [
		'chair'      => 'images.unsplash.com/photo-1598256989800-fe5f95da9787',
		'office'     => 'images.unsplash.com/photo-1629909613654-28e377c37b09',
		'office2'    => 'images.unsplash.com/photo-1777331903190-341a3dd0441b',
		'exam'       => 'images.unsplash.com/photo-1606811971618-4486d14f3f99',
		'checkup'    => 'plus.unsplash.com/premium_photo-1681966962522-546f370bc98e',
		'veneer'     => 'plus.unsplash.com/premium_photo-1661436629100-ba3c5ea70514',
		'kids'       => 'plus.unsplash.com/premium_photo-1681967039743-37dc3a27f4ce',
		'teen_brace' => 'plus.unsplash.com/premium_photo-1681997203595-e45e06abe034',
		'brace_model'=> 'images.unsplash.com/photo-1777446899714-c26de766dffd',
		'brace_metal'=> 'images.unsplash.com/photo-1598256989809-394fa4f6cd26',
		'brace_smile'=> 'plus.unsplash.com/premium_photo-1689568158814-3b8e9c1a9618',
		'aligner'    => 'images.unsplash.com/photo-1609840114035-3c981b782dfe',
		'aligner2'   => 'images.unsplash.com/photo-1777793636393-a0fec488f3fb',
		'aligner3'   => 'images.unsplash.com/photo-1564420228450-d9a5bc8d6565',
		'implant'    => 'images.unsplash.com/photo-1593022356769-11f762e25ed9',
		'implant2'   => 'images.unsplash.com/photo-1771442873035-474765b40ac6',
		'implant3'   => 'images.unsplash.com/photo-1777445826358-f95518f49b44',
		'tools'      => 'images.unsplash.com/photo-1606811856475-5e6fcdc6e509',
		'scaling'    => 'plus.unsplash.com/premium_photo-1661768526823-8e7941279818',
		'treat'      => 'images.unsplash.com/photo-1588776814546-daab30f310ce',
		'xray'       => 'images.unsplash.com/photo-1588776814546-1ffcf47267a5',
		'smile1'     => 'images.unsplash.com/photo-1677026010083-78ec7f1b84ed',
		'smile2'     => 'images.unsplash.com/photo-1489278353717-f64c6ee8a4d2',
		'smile3'     => 'images.unsplash.com/photo-1758874384842-7e79ce77ed1a',
		'smile4'     => 'images.unsplash.com/photo-1758600433495-99b9e69cf5f6',
		'smile5'     => 'images.unsplash.com/photo-1609840113929-b130355987e1',
		'smile6'     => 'images.unsplash.com/photo-1784460469850-80838868f4d2',
		'mouth'      => 'images.unsplash.com/photo-1670250492416-570b5b7343b1',
		'mouth2'     => 'images.unsplash.com/photo-1663182234283-28941e7612da',
		'doctor'     => 'images.unsplash.com/photo-1758691463582-11aea602cd4a',
		'doctor2'    => 'images.unsplash.com/photo-1606811841689-23dfddce3e95',
		'doctor3'    => 'plus.unsplash.com/premium_photo-1682097288491-7e926a30cd0b',
		'lobby'      => 'images.unsplash.com/photo-1762625570087-6d98fca29531',
		'wisdom'     => 'plus.unsplash.com/premium_photo-1661436618225-f9c72316215e',
		'filling'    => 'plus.unsplash.com/premium_photo-1661438133415-ca0ec60b8f3d',
	];
	if ( ! isset( $m[ $key ] ) ) return '';
	return 'https://' . $m[ $key ] . '?fm=jpg&q=72&w=' . (int) $w . '&auto=format&fit=crop&ixlib=rb-4.1.0';
}

/** Thẻ <img> từ thư viện ảnh. */
function pw_stock_img( $key, $alt = '', $w = 800, $eager = false ) {
	$u = pw_stock( $key, $w );
	if ( ! $u ) return '<span class="ph">' . pw_icon( 'tooth' ) . '</span>';
	return '<img src="' . esc_url( $u ) . '" alt="' . esc_attr( $alt ) . '" loading="' . ( $eager ? 'eager' : 'lazy' ) . '" decoding="async" referrerpolicy="no-referrer">';
}

/** Đoán ảnh theo tiêu đề dịch vụ / bài viết (không dấu, không phân biệt hoa thường). */
function pw_stock_for( $title ) {
	$t = remove_accents( mb_strtolower( (string) $title ) );
	$rules = [
		'invisalign|trong suot|khay' => 'aligner', 'teen' => 'teen_brace', 'mac cai|nieng|chinh nha' => 'brace_metal',
		'tre em|be |nhi' => 'kids', 'implant|trong rang|tru ' => 'implant', 'cao rang|ve sinh' => 'scaling',
		'khon' => 'wisdom', 'su|veneer|tham my|boc' => 'veneer', 'tram|sau rang' => 'filling',
		'tay trang|trang rang' => 'smile1', 'kham|tong quat' => 'checkup', 'x-quang|xquang|chup phim' => 'xray', 'bac si' => 'doctor',
	];
	foreach ( $rules as $re => $k ) if ( preg_match( '/' . $re . '/', $t ) ) return $k;
	return 'exam';
}

/** Danh sách mặc định cho khối "Lý do chọn" (ảnh|chú thích). */
function pw_reason_default() {
	$items = [ [ 'doctor', 'Bác sĩ giàu kinh nghiệm' ], [ 'xray', 'Công nghệ hiện đại' ], [ 'implant', 'Vật liệu chính hãng' ], [ 'smile3', 'Bảo hành dài hạn' ], [ 'chair', 'Không gian sạch, riêng tư' ], [ 'office', 'Trả góp 0% lãi suất' ] ];
	$out = [];
	foreach ( $items as $it ) $out[] = pw_stock( $it[0], 700 ) . '|' . $it[1];
	return implode( "\n", $out );
}
