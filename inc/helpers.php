<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/* =====================================================================
 * Giá trị mặc định – DÙNG CHUNG cho Customizer và giao diện
 * (trước đây mỗi nơi một kiểu nên mở Customizer bấm Lưu là mất ảnh "Lý do chọn")
 * ===================================================================== */
function pw_defaults() {
	static $d = null;
	if ( $d !== null ) return $d;
	$d = [
		'pw_hotline'       => '1900 8059',
		'pw_booking_url'   => '#dat-lich',
		'pw_company'       => 'CÔNG TY CỔ PHẦN Y TẾ PW',
		'pw_address'       => '215 Nam Kỳ Khởi Nghĩa, Phường Võ Thị Sáu, Q3, TP. Hồ Chí Minh.',
		'pw_email'         => get_option( 'admin_email' ),
		'pw_hours'         => 'Từ 8:30 tới 18:30 tất cả các ngày trong tuần',
		'pw_legal'         => 'Hiệu quả điều trị phụ thuộc vào cơ địa mỗi người (*)',
		'pw_responsible'   => '',
		'pw_biz'           => '',
		'pw_promo'         => 'Invisalign giảm tới 35%. Combo Implant Thuỵ Sĩ chỉ từ 18,9 triệu.',
		'pw_diamond_text'  => 'Tự hào đạt danh hiệu <strong class="red">TECHNOVA NHA KHOA XUẤT SẮC 2026</strong><br>với hơn <strong>1000+ ca</strong> niềng răng và phục hình thành công mỗi năm.',
		'pw_reasons_title' => 'Lý do nên chọn bọc răng sứ tại',
		'pw_reasons_items' => function_exists( 'pw_reason_default' ) ? pw_reason_default() : '',
		'pw_price_title'   => 'Bảng giá răng sứ thẩm mỹ',
		'pw_price_rows'    => "Zirconia|Zirconia|Đức|1 trụ|3.500.000đ|7 năm|Liên hệ tư vấn\nKatana|Katana|Nhật Bản|1 trụ|5.000.000đ|7 năm|Liên hệ tư vấn\nEmax|Emax|Đức|1 trụ|8.000.000đ|7 năm|Liên hệ tư vấn\nLava Plus|Lava Plus|Hoa Kỳ|1 trụ|9.000.000đ|15 năm|Liên hệ tư vấn\n3M Lava|Lava 3M|Hoa Kỳ|1 trụ|10.000.000đ|15 năm|Liên hệ tư vấn\n3M Esthetic|Lava Esthetic|Hoa Kỳ|1 trụ|12.000.000đ|15 năm|Liên hệ tư vấn\nNacera|Nacera|Đức|1 trụ|15.000.000đ|15 năm|Liên hệ tư vấn\nOrodent Gold|Orodent Gold|Italy|1 trụ|18.000.000đ|15 năm|Liên hệ tư vấn",
		'pw_price_note'    => 'Giá có thể thay đổi theo tình trạng răng thực tế. Liên hệ để được tư vấn chi tiết.',
		'pw_celeb_title'   => 'Người nổi tiếng niềng răng tại',
		'pw_celeb_sub'     => 'Nhiều gương mặt được công chúng yêu mến đã chọn đồng hành cùng chúng tôi trong hành trình có nụ cười đẹp và hàm răng khoẻ.',
		'pw_use_wp_menu'   => '',
	];
	return $d;
}

/** Lấy cấu hình. $allow_empty = true: người dùng cố tình xoá trống thì giữ trống (VD: ẩn bong bóng khuyến mãi). */
function pw_opt( $key, $default = null, $allow_empty = false ) {
	if ( $default === null ) { $d = pw_defaults(); $default = $d[ $key ] ?? ''; }
	if ( $allow_empty ) {
		$v = get_theme_mod( $key, null );
		return $v === null ? $default : $v;
	}
	$v = get_theme_mod( $key, $default );
	return ( $v === '' || $v === null ) ? $default : $v;
}

function pw_icon( $name, $class = 'ico' ) {
	static $p = [
		'search'   => '<circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/>',
		'play' => '<path d="M8 5v14l11-7z" fill="currentColor" stroke="none"/>',
		'phone'    => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z"/>',
		'calendar' => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>',
		'down'     => '<path d="m6 9 6 6 6-6"/>',
		'left'     => '<path d="m15 18-6-6 6-6"/>',
		'right'    => '<path d="m9 18 6-6-6-6"/>',
		'up'       => '<path d="m18 15-6-6-6 6"/>',
		'gift'     => '<rect x="3" y="8" width="18" height="4" rx="1"/><path d="M12 8v13M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7M7.5 8a2.5 2.5 0 0 1 0-5C11 3 12 8 12 8s1-5 4.5-5a2.5 2.5 0 0 1 0 5"/>',
		'tag'      => '<path d="M20.6 13.4 13.4 20.6a2 2 0 0 1-2.8 0L2 12V2h10l8.6 8.6a2 2 0 0 1 0 2.8z"/><circle cx="7" cy="7" r="1.5"/>',
		'tooth'    => '<path d="M7 3C4.5 3 3 5 3 7.5c0 2 1 3.5 1.5 5.5.6 2.4.7 8 2.7 8 1.7 0 1.4-5 3.8-5s2.1 5 3.8 5c2 0 2.1-5.6 2.7-8 .5-2 1.5-3.5 1.5-5.5C21 5 19.5 3 17 3c-2 0-2.5 1-5 1S9 3 7 3z"/>',
		'star'     => '<path d="m12 2 3.1 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.8 21l1.2-6.8-5-4.9 6.9-1z"/>',
		'users'    => '<circle cx="9" cy="8" r="3.5"/><path d="M2 21a7 7 0 0 1 14 0M16 4.5a3.5 3.5 0 0 1 0 7M22 21a7 7 0 0 0-4-6.3"/>',
		'pin'      => '<path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/>',
		'book'     => '<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20V3H6.5A2.5 2.5 0 0 0 4 5.5v14z"/>',
		'message'  => '<path d="M21 11.5a8.4 8.4 0 0 1-12.3 7.4L3 21l1.9-5.5A8.4 8.4 0 1 1 21 11.5z"/>',
		'mail'     => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
		'close'    => '<path d="M18 6 6 18M6 6l12 12"/>',
		'menu'     => '<path d="M3 6h18M3 12h18M3 18h18"/>',
		'swap'     => '<path d="m9 7-5 5 5 5M15 7l5 5-5 5"/>',
		'home'     => '<path d="m3 11 9-8 9 8v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1z"/>',
		'video'    => '<rect x="3" y="6" width="13" height="12" rx="2"/><path d="m16 10 5-3v10l-5-3z"/>',
		'shield'   => '<path d="M12 2 4 5v6c0 5 3.4 9.4 8 11 4.6-1.6 8-6 8-11V5z"/><path d="m9 12 2 2 4-4"/>',
		'check'    => '<path d="m5 12 5 5L20 7"/>',
		'clock'    => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		'card'     => '<rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20M6 15h4"/>',
		'sparkle'  => '<path d="M12 3l1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8zM19 16l.8 2.2L22 19l-2.2.8L19 22l-.8-2.2L16 19l2.2-.8z"/>',
	];
	return '<svg class="' . esc_attr( $class ) . '" viewBox="0 0 24 24" aria-hidden="true">' . ( $p[ $name ] ?? '' ) . '</svg>';
}

function pw_money( $v ) {
	$v = trim( (string) $v );
	if ( $v === '' ) return '';
	if ( preg_match( '/^[\d\.\,\s]+$/', $v ) ) {
		return number_format( (int) preg_replace( '/\D/', '', $v ), 0, ',', '.' ) . 'đ';
	}
	return $v;
}

/** % giảm: hỗ trợ giá đơn ("23000000") và khoảng giá ("30.000.000đ - 48.000.000đ"). */
function pw_discount_any( $old, $new ) {
	$first = function ( $v ) { return preg_match( '/\d[\d\.\,]*/', (string) $v, $m ) ? (int) preg_replace( '/\D/', '', $m[0] ) : 0; };
	$o = $first( $old ); $n = $first( $new );
	return ( $o > 0 && $n > 0 && $n < $o ) ? (int) round( ( 1 - $n / $o ) * 100 ) : 0;
}

/** Số đầu tiên trong chuỗi giá (dùng sắp xếp). */
function pw_price_num( $v ) { return preg_match( '/\d[\d\.\,]*/', (string) $v, $m ) ? (int) preg_replace( '/\D/', '', $m[0] ) : 0; }

function pw_tel() { return preg_replace( '/\D/', '', pw_opt( 'pw_hotline' ) ); }

/* =====================================================================
 * Liên kết: trang, chuyên mục, nhóm dịch vụ
 * ===================================================================== */
function pw_page_url( $slug ) {
	$p = get_page_by_path( $slug );
	return $p ? get_permalink( $p ) : home_url( '/' . $slug . '/' );
}
function pw_cat_url( $slug ) {
	$t = get_term_by( 'slug', $slug, 'category' );
	if ( $t && ! is_wp_error( $t ) ) { $l = get_category_link( $t ); if ( ! is_wp_error( $l ) ) return $l; }
	return home_url( '/category/' . $slug . '/' );
}
function pw_term_url( $name, $fallback = '' ) {
	$t = $name ? get_term_by( 'name', $name, 'nhom_dich_vu' ) : false;
	if ( $t && ! is_wp_error( $t ) ) { $l = get_term_link( $t ); if ( ! is_wp_error( $l ) ) return $l; }
	return $fallback !== '' ? $fallback : ( get_post_type_archive_link( 'dich_vu' ) ?: home_url( '/' ) );
}
/** Link trang nhóm dịch vụ theo tên nhóm (nếu có), ngược lại trả về $fallback. */
function pw_group_url( $name, $fallback = '' ) {
	$t = $name ? get_term_by( 'name', $name, 'nhom_dich_vu' ) : false;
	if ( $t && ! is_wp_error( $t ) ) { $l = get_term_link( $t ); if ( ! is_wp_error( $l ) ) return $l; }
	return $fallback;
}

/** Các nhóm dịch vụ cấp 1 – dùng cho menu "Dịch Vụ" và thanh chọn nhóm. */
function pw_top_groups() {
	return [ 'Trồng răng Implant', 'Niềng răng', 'Nha khoa tổng quát', 'Nha khoa thẩm mỹ', 'Nha khoa trẻ em' ];
}

/* =====================================================================
 * Menu chính – giống nhakhoaparkway.com, ĐÃ BỎ "Người nổi tiếng" và "Tìm phòng khám".
 * Mặc định dùng menu của theme (không bị menu cũ trong Giao diện → Menu ghi đè).
 * Muốn tự quản lý menu: Customizer → Thông tin chung → bật "Dùng menu trong Giao diện → Menu".
 * ===================================================================== */
function pw_use_wp_menu() { return (bool) pw_opt( 'pw_use_wp_menu', '', true ); }

function pw_is_current_url( $url ) {
	global $wp;
	$a = untrailingslashit( strtok( (string) $url, '#?' ) );
	$b = untrailingslashit( home_url( $wp->request ?? '' ) );
	return $a !== '' && $a === $b;
}

function pw_menu_items() {
	$svc = get_post_type_archive_link( 'dich_vu' ) ?: home_url( '/dich-vu/' );
	$kids = [];
	foreach ( pw_top_groups() as $g ) {
		$t = get_term_by( 'name', $g, 'nhom_dich_vu' );
		$kids[] = [ mb_convert_case( $g, MB_CASE_TITLE, 'UTF-8' ), pw_term_url( $g ), $t && is_tax( 'nhom_dich_vu', $t->term_id ) ];
	}
	$in_svc = is_post_type_archive( 'dich_vu' ) || is_singular( 'dich_vu' ) || is_tax( 'nhom_dich_vu' );
	return [
		[ 'Trang Chủ', home_url( '/' ), is_front_page(), [] ],
		[ 'Giới Thiệu', pw_page_url( 'gioi-thieu' ), is_page( 'gioi-thieu' ), [] ],
		[ 'Ưu Đãi', pw_page_url( 'uu-dai' ), is_page( 'uu-dai' ), [] ],
		[ 'Bảng Giá', pw_page_url( 'bang-gia' ), is_page( 'bang-gia' ), [] ],
		[ 'Dịch Vụ', $svc, $in_svc, $kids ],
		[ 'Kiến Thức Nha Khoa', pw_cat_url( 'kien-thuc-nha-khoa' ), is_category( 'kien-thuc-nha-khoa' ) || ( is_singular( 'post' ) && has_category( 'kien-thuc-nha-khoa' ) ), [] ],
		[ 'Tuyển Dụng', pw_page_url( 'tuyen-dung' ), is_page( 'tuyen-dung' ), [] ],
	];
}

function pw_builtin_menu() {
	echo '<ul class="menu">';
	foreach ( pw_menu_items() as $it ) {
		$has = ! empty( $it[3] );
		$cls = trim( ( $has ? 'menu-item-has-children ' : '' ) . ( $it[2] ? 'current-menu-item' : '' ) );
		echo '<li class="' . esc_attr( $cls ) . '"><a href="' . esc_url( $it[1] ) . '"' . ( $it[2] ? ' aria-current="page"' : '' ) . ( $has ? ' aria-haspopup="true"' : '' ) . '>' . esc_html( $it[0] ) . ( $has ? pw_icon( 'down' ) : '' ) . '</a>';
		if ( $has ) {
			echo '<ul class="sub-menu">';
			foreach ( $it[3] as $c ) echo '<li><a href="' . esc_url( $c[1] ) . '"' . ( $c[2] ? ' aria-current="page"' : '' ) . '>' . esc_html( $c[0] ) . '</a></li>';
			echo '</ul>';
		}
		echo '</li>';
	}
	echo '</ul>';
}

function pw_render_primary_menu() {
	if ( pw_use_wp_menu() && has_nav_menu( 'primary' ) ) {
		wp_nav_menu( [ 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu', 'fallback_cb' => 'pw_builtin_menu' ] );
	} else {
		pw_builtin_menu();
	}
}

/** Menu nhỏ dưới ô tìm kiếm. */
function pw_render_small_menu() {
	if ( pw_use_wp_menu() && has_nav_menu( 'top' ) ) {
		wp_nav_menu( [ 'theme_location' => 'top', 'container' => false, 'items_wrap' => '%3$s', 'walker' => new PW_Plain_Walker(), 'fallback_cb' => false ] );
		return;
	}
	$links = [ 'Ưu đãi' => pw_page_url( 'uu-dai' ), 'Niềng răng' => pw_term_url( 'Niềng răng' ), 'Kiến thức nha khoa' => pw_cat_url( 'kien-thuc-nha-khoa' ), 'Tin tức sự kiện' => pw_cat_url( 'tin-tuc-su-kien' ) ];
	foreach ( $links as $l => $u ) echo '<a href="' . esc_url( $u ) . '">' . esc_html( $l ) . '</a>';
}

/** Walker xuất link phẳng cho menu nhỏ dưới ô tìm kiếm. */
class PW_Plain_Walker extends Walker_Nav_Menu {
	public function start_lvl( &$output, $depth = 0, $args = null ) {}
	public function end_lvl( &$output, $depth = 0, $args = null ) {}
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$output .= '<a href="' . esc_url( $item->url ) . '">' . esc_html( $item->title ) . '</a>';
	}
	public function end_el( &$output, $item, $depth = 0, $args = null ) {}
}

/** Khi dùng menu WP: vẫn ẩn "Người nổi tiếng" và "Tìm phòng khám" khỏi menu chính. */
add_filter( 'wp_nav_menu_objects', function ( $items, $args ) {
	if ( empty( $args->theme_location ) || $args->theme_location !== 'primary' ) return $items;
	$hide = [ 'người nổi tiếng', 'tìm phòng khám' ];
	return array_values( array_filter( $items, function ( $i ) use ( $hide ) {
		return ! in_array( mb_strtolower( trim( $i->title ) ), $hide, true );
	} ) );
}, 10, 2 );

/* =====================================================================
 * Nội dung: thay {site}, {hotline}… khi hiển thị; bỏ wpautop cho nội dung mẫu của theme
 * ===================================================================== */
function pw_tokens( $s ) {
	if ( strpos( $s, '{' ) === false ) return $s;
	return str_replace(
		[ '{site}', '{hotline}', '{tel}', '{hours}', '{address}', '{email}', '{home}' ],
		[ get_bloginfo( 'name' ), pw_opt( 'pw_hotline' ), pw_tel(), pw_opt( 'pw_hours' ), pw_opt( 'pw_address' ), pw_opt( 'pw_email' ), untrailingslashit( home_url() ) ],
		$s
	);
}
add_filter( 'the_content', function ( $c ) {
	if ( strpos( $c, '<!--pw-seed-->' ) !== false ) { remove_filter( 'the_content', 'wpautop' ); remove_filter( 'the_content', 'shortcode_unautop' ); }
	return $c;
}, 1 );
add_filter( 'the_content', 'pw_tokens', 9 );
add_filter( 'the_content', function ( $c ) {
	if ( ! has_filter( 'the_content', 'wpautop' ) ) add_filter( 'the_content', 'wpautop' );
	if ( ! has_filter( 'the_content', 'shortcode_unautop' ) ) add_filter( 'the_content', 'shortcode_unautop' );
	return $c;
}, 99 );

/** Danh sách thẻ HTML cho phép khi in nội dung nhóm dịch vụ (có <details>, ảnh lazy…). */
function pw_allowed_html() {
	$a = wp_kses_allowed_html( 'post' );
	$a['details'] = [ 'open' => true, 'class' => true ];
	$a['summary'] = [ 'class' => true ];
	$a['img']     = array_merge( $a['img'] ?? [], [ 'src' => true, 'alt' => true, 'class' => true, 'loading' => true, 'decoding' => true, 'referrerpolicy' => true, 'width' => true, 'height' => true ] );
	$a['svg']     = [ 'class' => true, 'viewbox' => true, 'aria-hidden' => true ];
	$a['path']    = [ 'd' => true ];
	$a['blockquote'] = [ 'class' => true ]; $a['cite'] = [ 'class' => true ];
	foreach ( [ 'div', 'p', 'ul', 'ol', 'li', 'h2', 'h3', 'h4', 'span', 'small', 'b', 'strong', 'table', 'figure', 'figcaption', 'a', 'em' ] as $t ) {
		$a[ $t ] = array_merge( $a[ $t ] ?? [], [ 'class' => true ] );
	}
	return $a;
}

/** Mô tả cho Google (meta description) */
add_action( 'wp_head', function () {
	$d = '';
	if ( is_singular( 'dich_vu' ) ) $d = get_the_excerpt();
	elseif ( is_front_page() ) $d = get_bloginfo( 'description' );
	elseif ( is_tax( 'nhom_dich_vu' ) ) $d = wp_strip_all_tags( term_description() );
	$d = trim( wp_strip_all_tags( pw_tokens( $d ) ) );
	if ( $d !== '' ) echo '<meta name="description" content="' . esc_attr( wp_html_excerpt( $d, 160, '…' ) ) . '">' . "\n";
}, 5 );

/* =====================================================================
 * Dịch vụ: ảnh, thẻ, dữ liệu mẫu hiển thị khi web chưa có dịch vụ nào
 * ===================================================================== */
function pw_thumb( $post_id = null, $size = 'pw-card' ) {
	$post_id = $post_id ?: get_the_ID();
	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail( $post_id, $size, [ 'loading' => 'lazy' ] );
	}
	$k = get_post_meta( $post_id, 'img_key', true );
	return pw_stock_img( $k && pw_stock( $k ) ? $k : pw_stock_for( get_the_title( $post_id ) ), get_the_title( $post_id ), 720 );
}

/** Ảnh của 1 dịch vụ: ảnh đại diện → khoá ảnh đã gán (img_key) → đoán theo tên. Mỗi dịch vụ một ảnh khác nhau. */
function pw_service_img( $id = null, $size = 'pw-card', $w = 700, $eager = false ) {
	$id = $id ?: get_the_ID();
	if ( has_post_thumbnail( $id ) ) return get_the_post_thumbnail( $id, $size, [ 'loading' => $eager ? 'eager' : 'lazy' ] );
	$k = get_post_meta( $id, 'img_key', true );
	if ( ! $k ) $k = pw_stock_for( get_the_title( $id ) . ' ' . get_post_meta( $id, 'group_label', true ) );
	return pw_stock_img( $k, get_the_title( $id ), $w, $eager );
}

/** Thẻ sản phẩm dịch vụ (dùng ở trang nhóm / archive). Gọi trong vòng lặp. */
function pw_service_card() {
	$id = get_the_ID(); $old = get_post_meta( $id, 'price_old', true ); $new = get_post_meta( $id, 'price_new', true ); $g = get_post_meta( $id, 'group_label', true );
	$d = pw_discount_any( $old, $new );
	ob_start(); ?>
	<article class="pcard" data-price="<?php echo (int) pw_price_num( $new ); ?>" data-disc="<?php echo (int) $d; ?>" data-pop="<?php echo get_post_meta( $id, 'is_popular', true ) ? 1 : 0; ?>" data-i="<?php echo (int) get_post_field( 'menu_order', $id ); ?>">
		<?php if ( $d ) echo '<span class="badge">Giảm ' . (int) $d . '%</span>'; ?>
		<a class="im" href="<?php the_permalink(); ?>"><?php echo pw_service_img( $id, 'pw-card', 600 ); ?></a>
		<div class="bd">
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php if ( $g ) echo '<span class="tag">' . esc_html( $g ) . '</span>'; ?>
			<div class="price"><?php if ( $old ) echo '<del>' . esc_html( pw_money( $old ) ) . '</del>'; if ( $new ) echo '<b>' . esc_html( pw_money( $new ) ) . '</b>'; ?></div>
			<a class="btn btn-soft" href="<?php the_permalink(); ?>">Xem chi tiết</a>
		</div>
	</article>
	<?php return ob_get_clean();
}

/** Gói mẫu hiển thị khi web CHƯA có dịch vụ nào (để trang không bị trống). */
function pw_demo_services() {
	return [
		[ 'Gói niềng trong suốt Invisalign Comprehensive 3 năm', 'Niềng răng trong suốt Invisalign', '122000000', '85400000', 'aligner2', 1 ],
		[ 'Gói Invisalign Moderate', 'Niềng răng trong suốt Invisalign', '101000000', '70700000', 'aligner', 1 ],
		[ 'Gói Invisalign Lite', 'Niềng răng trong suốt Invisalign', '85000000', '65450000', 'aligner3', 0 ],
		[ 'Hàm duy trì Vivera', 'Niềng răng trong suốt Invisalign', '', '4130000', 'smile5', 0 ],
		[ 'Niềng răng mắc cài kim loại', 'Niềng răng mắc cài', '30.000.000đ - 48.000.000đ', '27.600.000đ - 45.600.000đ', 'brace_metal', 1 ],
		[ 'Gói Combo Implant Eco (Trụ Dentium + Răng sứ Zirconia)', 'Trồng răng Implant', '23000000', '14900000', 'implant2', 1 ],
		[ 'Gói Combo Implant Thuỵ Sĩ (Trụ Neodent + Răng sứ Cercon HT)', 'Trồng răng Implant', '30000000', '18900000', 'implant', 1 ],
		[ 'Răng sứ thẩm mỹ Cercon HT', 'Nha khoa thẩm mỹ', '9000000', '6900000', 'veneer', 0 ],
	];
}
function pw_demo_card( $r, $i ) {
	$d = pw_discount_any( $r[2], $r[3] );
	ob_start(); ?>
	<article class="pcard" data-price="<?php echo (int) pw_price_num( $r[3] ); ?>" data-disc="<?php echo (int) $d; ?>" data-pop="<?php echo (int) $r[5]; ?>" data-i="<?php echo (int) $i; ?>">
		<?php if ( $d ) echo '<span class="badge">Giảm ' . (int) $d . '%</span>'; ?>
		<a class="im" href="#dat-lich"><?php echo pw_stock_img( $r[4], $r[0], 600 ); ?></a>
		<div class="bd">
			<h3><a href="#dat-lich"><?php echo esc_html( $r[0] ); ?></a></h3>
			<span class="tag"><?php echo esc_html( $r[1] ); ?></span>
			<div class="price"><?php if ( $r[2] ) echo '<del>' . esc_html( pw_money( $r[2] ) ) . '</del>'; echo '<b>' . esc_html( pw_money( $r[3] ) ) . '</b>'; ?></div>
			<a class="btn btn-soft" href="#dat-lich">Tư vấn</a>
		</div>
	</article>
	<?php return ob_get_clean();
}

/* =====================================================================
 * Bảng giá răng sứ
 * ===================================================================== */
function pw_price_rows() {
	$rows = [];
	foreach ( preg_split( '/\r\n|\r|\n/', pw_opt( 'pw_price_rows' ) ) as $line ) {
		$c = array_map( 'trim', explode( '|', $line ) );
		if ( count( $c ) >= 5 ) $rows[] = array_pad( $c, 7, '' );
	}
	return $rows;
}

/** Tắt menu cũ trong DB ở mặt trước web (trừ khi bật "Dùng menu trong Giao diện → Menu") → footer/menu dùng bản chuẩn của theme. */
add_filter( 'theme_mod_nav_menu_locations', function ( $locs ) {
	if ( is_admin() || is_customize_preview() ) return $locs;
	return pw_use_wp_menu() ? $locs : [];
} );

/* ---------- Bài viết / tin tức / báo chí ---------- */
add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );

/** Chuyên mục chính (bỏ "Chưa phân loại"). */
function pw_main_cat( $id = null ) {
	foreach ( (array) get_the_category( $id ?: get_the_ID() ) as $c ) if ( $c->slug !== 'uncategorized' ) return $c;
	return null;
}
function pw_read_min( $id = null ) {
	$t = wp_strip_all_tags( (string) get_post_field( 'post_content', $id ?: get_the_ID() ) );
	return max( 1, (int) ceil( count( preg_split( '/\s+/u', trim( $t ) ) ) / 190 ) );
}
/** Ảnh lớn đầu bài: ảnh đại diện → ảnh mẫu theo img_key/tiêu đề. */
function pw_post_hero( $id = null ) {
	$id = $id ?: get_the_ID();
	if ( has_post_thumbnail( $id ) ) return get_the_post_thumbnail( $id, 'large', [ 'loading' => 'eager' ] );
	$k = get_post_meta( $id, 'img_key', true );
	return pw_stock_img( $k && pw_stock( $k ) ? $k : pw_stock_for( get_the_title( $id ) ), get_the_title( $id ), 1100, true );
}
function pw_news_card( $id = null ) {
	$id = $id ?: get_the_ID(); $c = pw_main_cat( $id );
	$u = get_permalink( $id );
	$o  = '<article class="ncard"><a class="im" href="' . esc_url( $u ) . '">' . pw_thumb( $id );
	if ( $c ) $o .= '<span class="cat">' . esc_html( $c->name ) . '</span>';
	$o .= '</a><div class="bd"><div class="meta"><time datetime="' . esc_attr( get_the_date( 'c', $id ) ) . '">' . esc_html( get_the_date( 'd/m/Y', $id ) ) . '</time><span>·</span><span>' . pw_read_min( $id ) . ' phút đọc</span></div>';
	$o .= '<h3><a href="' . esc_url( $u ) . '">' . esc_html( get_the_title( $id ) ) . '</a></h3>';
	$o .= '<p>' . esc_html( wp_trim_words( get_the_excerpt( $id ), 30, '…' ) ) . '</p><a class="more" href="' . esc_url( $u ) . '">XEM CHI TIẾT</a></div></article>';
	return $o;
}
function pw_press_card( $id = null ) {
	$id = $id ?: get_the_ID(); $u = get_permalink( $id );
	$src = get_post_meta( $id, 'press_src', true ) ?: 'Báo chí';
	$o  = '<article class="prc"><a class="im" href="' . esc_url( $u ) . '">' . pw_thumb( $id ) . '<span class="src">' . esc_html( $src ) . '</span></a>';
	$o .= '<div class="bd"><h3><a href="' . esc_url( $u ) . '">' . esc_html( get_the_title( $id ) ) . '</a></h3>';
	$o .= '<p>' . esc_html( wp_trim_words( get_the_excerpt( $id ), 22, '…' ) ) . '</p>';
	$o .= '<div class="ft"><time>' . esc_html( get_the_date( 'd/m/Y', $id ) ) . '</time><a href="' . esc_url( $u ) . '">Xem đầy đủ →</a></div></div></article>';
	return $o;
}

/** Thẻ danh sách ngang (kiểu trang Kiến thức / Tin tức): ảnh trái – ngày, tiêu đề, mô tả, nút Xem chi tiết. */
function pw_list_card( $id = null ) {
	$id = $id ?: get_the_ID(); $u = get_permalink( $id );
	return '<article class="lcard"><a class="im" href="' . esc_url( $u ) . '">' . pw_thumb( $id ) . '</a><div class="bd">'
		. '<time datetime="' . esc_attr( get_the_date( 'c', $id ) ) . '">' . esc_html( get_the_date( 'd/m/Y', $id ) ) . '</time>'
		. '<h3><a href="' . esc_url( $u ) . '">' . esc_html( get_the_title( $id ) ) . '</a></h3>'
		. '<p>' . esc_html( wp_trim_words( get_the_excerpt( $id ), 34, '…' ) ) . '</p>'
		. '<a class="lbtn" href="' . esc_url( $u ) . '">Xem chi tiết ' . pw_icon( 'right' ) . '</a></div></article>';
}
add_action( 'pre_get_posts', function ( $q ) {
	if ( is_admin() || ! $q->is_main_query() || ! $q->is_category() ) return;
	$q->set( 'posts_per_page', $q->is_category( 'bao-chi' ) ? 12 : 8 );
} );

/** Cột "Tin nổi bật": 12 bài kiến thức/tin tức mới nhất (ảnh nhỏ trái – tiêu đề – ngày). */
function pw_hot_news( $exclude = 0 ) {
	$q = new WP_Query( [ 'post_type' => 'post', 'posts_per_page' => 12, 'post__not_in' => $exclude ? [ $exclude ] : [], 'ignore_sticky_posts' => true, 'no_found_rows' => true,
		'tax_query' => [ [ 'taxonomy' => 'category', 'field' => 'slug', 'terms' => [ 'kien-thuc-nha-khoa', 'tin-tuc-su-kien' ] ] ] ] );
	$o = '<aside class="hot"><h2>Tin nổi bật</h2>';
	while ( $q->have_posts() ) { $q->the_post();
		$o .= '<a class="hot-i" href="' . esc_url( get_permalink() ) . '"><span class="im">' . pw_thumb() . '</span><span class="tx"><b>' . esc_html( get_the_title() ) . '</b><small>' . esc_html( get_the_date( 'd/m/Y' ) ) . '</small></span></a>';
	}
	wp_reset_postdata();
	return $o . '</aside>';
}
