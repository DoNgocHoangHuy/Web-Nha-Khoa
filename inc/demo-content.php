<?php
/**
 * Nạp / nâng cấp nội dung mẫu nha khoa – tự chạy 1 lần khi theme được cập nhật (PW_SEED_VER tăng).
 *  1) Đánh dấu bài Dịch vụ CŨ (không thuộc nha khoa) là `pw_legacy` → ẩn khỏi web (không xoá).
 *  2) Tạo/ cập nhật nhóm dịch vụ, dịch vụ, trang (Giới thiệu, Ưu đãi, Tuyển dụng…), chuyên mục, bác sĩ…
 * Bài đã bị bạn sửa tay (nội dung không còn dấu <!--pw-seed-->) sẽ KHÔNG bị ghi đè.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'init', function () {
	if ( (int) get_option( 'pw_seed_ver', 0 ) >= PW_SEED_VER ) return;
	if ( ! add_option( 'pw_seed_lock', time(), '', 'no' ) ) {
		if ( time() - (int) get_option( 'pw_seed_lock' ) < 300 ) return;
		update_option( 'pw_seed_lock', time() );
	}
	pw_upgrade_content();
	update_option( 'pw_seed_ver', PW_SEED_VER );
	delete_option( 'pw_seed_lock' );
}, 30 );

function pw_has_theme_meta( $id ) {
	foreach ( [ 'price_new', 'price_old', 'show_grid', 'is_popular', 'group_label', 'pw_seed' ] as $k ) if ( metadata_exists( 'post', $id, $k ) ) return true;
	$t = wp_get_object_terms( $id, 'nhom_dich_vu', [ 'fields' => 'ids' ] );
	return $t && ! is_wp_error( $t );
}

function pw_upgrade_content( $force = false ) {
	@set_time_limit( 120 );
	if ( function_exists( 'kses_remove_filters' ) ) kses_remove_filters();

	// 1) Đánh dấu dữ liệu cũ (chỉ 1 lần)
	if ( ! get_option( 'pw_legacy_done' ) ) {
		foreach ( get_posts( [ 'post_type' => 'dich_vu', 'post_status' => 'any', 'numberposts' => -1, 'fields' => 'ids', 'pw_all' => true ] ) as $id ) {
			if ( ! pw_has_theme_meta( $id ) ) update_post_meta( $id, 'pw_legacy', '1' );
		}
		update_option( 'pw_legacy_done', 1 );
	}

	// 2) Chuyên mục
	foreach ( [ 'kien-thuc-nha-khoa' => 'Kiến thức nha khoa', 'tin-tuc-su-kien' => 'Tin tức sự kiện', 'bao-chi' => 'Báo chí nói về chúng tôi' ] as $slug => $name ) {
		if ( ! term_exists( $slug, 'category' ) ) wp_insert_term( $name, 'category', [ 'slug' => $slug ] );
	}

	// 3) Nhóm dịch vụ + bài giới thiệu
	foreach ( pw_seed_terms() as $t ) {
		$parent = $t[1] ? get_term_by( 'name', $t[1], 'nhom_dich_vu' ) : null;
		$ex = get_term_by( 'name', $t[0], 'nhom_dich_vu' );
		if ( ! $ex ) {
			$r = wp_insert_term( $t[0], 'nhom_dich_vu', [ 'description' => $t[2], 'parent' => $parent ? (int) $parent->term_id : 0 ] );
			if ( is_wp_error( $r ) ) continue;
			$tid = (int) $r['term_id'];
		} else {
			$tid = (int) $ex->term_id;
			if ( $parent && ! $ex->parent ) wp_update_term( $tid, 'nhom_dich_vu', [ 'parent' => (int) $parent->term_id ] );
			if ( ! $ex->description ) wp_update_term( $tid, 'nhom_dich_vu', [ 'description' => $t[2] ] );
		}
		$cur = (string) get_term_meta( $tid, 'pw_content', true );
		if ( $force || $cur === '' || strpos( $cur, '<!--pw-seed-->' ) !== false || strpos( $cur, 'Parkway' ) !== false ) update_term_meta( $tid, 'pw_content', pw_build_content( $t[4] ) );
	}

	// 4) Dịch vụ
	global $wpdb;
	foreach ( pw_seed_services() as $key => $s ) {
		$id = (int) $wpdb->get_var( $wpdb->prepare( "SELECT p.ID FROM {$wpdb->posts} p JOIN {$wpdb->postmeta} m ON m.post_id=p.ID AND m.meta_key='pw_seed' AND m.meta_value=%s WHERE p.post_type='dich_vu' AND p.post_status<>'trash' LIMIT 1", $key ) );
		if ( ! $id ) {
			$id = (int) $wpdb->get_var( $wpdb->prepare( "SELECT p.ID FROM {$wpdb->posts} p WHERE p.post_type='dich_vu' AND p.post_status IN ('publish','draft','private') AND p.post_title=%s AND NOT EXISTS (SELECT 1 FROM {$wpdb->postmeta} l WHERE l.post_id=p.ID AND l.meta_key='pw_legacy') ORDER BY p.ID LIMIT 1", $s['title'] ) );
		}
		$content = isset( $s['c'] ) ? pw_build_content( $s['c'] ) : '';
		if ( ! $id ) {
			$id = (int) wp_insert_post( [ 'post_type' => 'dich_vu', 'post_status' => 'publish', 'post_title' => $s['title'], 'post_excerpt' => $s['excerpt'] ?? '', 'post_content' => $content, 'menu_order' => $s['order'] ?? 0 ] );
			if ( ! $id ) continue;
			$fresh = true;
		} else {
			$fresh = false;
			$old = (string) get_post_field( 'post_content', $id );
			$upd = [ 'ID' => $id, 'menu_order' => $s['order'] ?? 0 ];
			if ( $force || trim( $old ) === '' || strpos( $old, '<!--pw-seed-->' ) !== false || strpos( $old, 'Parkway' ) !== false ) $upd['post_content'] = $content;
			if ( $force || ! get_post_field( 'post_excerpt', $id ) ) $upd['post_excerpt'] = $s['excerpt'] ?? '';
			wp_update_post( $upd );
		}
		update_post_meta( $id, 'pw_seed', $key );
		$meta = [ 'price_old' => $s['old'], 'price_new' => $s['new'], 'group_label' => $s['group'], 'unit' => $s['unit'], 'perks' => $s['perks'] ?? '', 'img_key' => $s['img'] ?? '', 'show_grid' => ! empty( $s['grid'] ) ? '1' : '', 'is_popular' => ! empty( $s['pop'] ) ? '1' : '' ];
		foreach ( $meta as $k => $v ) {
			// Bài đã có sẵn: chỉ ghi giá trị khi trống, riêng cờ hiển thị luôn đồng bộ để trang chủ đúng 4 dịch vụ yêu thích.
			if ( $fresh || $force || in_array( $k, [ 'show_grid', 'is_popular', 'img_key', 'perks' ], true ) || (string) get_post_meta( $id, $k, true ) === '' ) update_post_meta( $id, $k, $v );
		}
		delete_post_meta( $id, 'pw_legacy' );
		$ids = [];
		foreach ( $s['terms'] as $tn ) { $tm = get_term_by( 'name', $tn, 'nhom_dich_vu' ); if ( $tm ) $ids[] = (int) $tm->term_id; }
		if ( $ids ) wp_set_object_terms( $id, $ids, 'nhom_dich_vu' );
	}

	// 5) Trang
	foreach ( pw_seed_pages() as $slug => $p ) {
		$ex = get_page_by_path( $slug );
		if ( $ex ) {
			if ( $p[1] !== '' && ( $force || trim( $ex->post_content ) === '' || strpos( $ex->post_content, '<!--pw-seed-->' ) !== false ) ) wp_update_post( [ 'ID' => $ex->ID, 'post_content' => $p[1] ] );
			continue;
		}
		wp_insert_post( [ 'post_type' => 'page', 'post_status' => 'publish', 'post_name' => $slug, 'post_title' => $p[0], 'post_content' => $p[1] ] );
	}

	// 6) Bác sĩ / người nổi tiếng / trước-sau / bài viết mẫu – chỉ tạo khi còn trống
	pw_seed_people_and_posts();
	pw_seed_articles_upsert( $force );

	if ( function_exists( 'kses_init' ) ) kses_init();
	update_option( 'pw_flush_rw', 1 );
}
add_action( 'init', function () { if ( get_option( 'pw_flush_rw' ) ) { delete_option( 'pw_flush_rw' ); flush_rewrite_rules(); } }, 99 );
add_action( 'after_switch_theme', function () { update_option( 'pw_seed_ver', 0 ); } );

function pw_seed_people_and_posts() {
	$mk = function ( $type, $title, $meta = [], $extra = [] ) {
		$id = wp_insert_post( array_merge( [ 'post_type' => $type, 'post_title' => $title, 'post_status' => 'publish' ], $extra ) );
		foreach ( $meta as $k => $v ) update_post_meta( $id, $k, $v );
		return $id;
	};
	$empty = function ( $t ) { return ! get_posts( [ 'post_type' => $t, 'numberposts' => 1, 'fields' => 'ids', 'post_status' => 'any' ] ); };
	if ( $empty( 'bac_si' ) ) {
		$mk( 'bac_si', 'Phạm Thị Hà Xuyên', [ 'role' => 'Bác sĩ', 'bullets' => "Bác sĩ điều trị chỉnh nha\nBác sĩ chuyên ngành Răng Hàm Mặt tại Đại học Y Hà Nội\nBác sĩ chuyên khoa 1 Đại học Y Dược TP. Hồ Chí Minh\nChứng chỉ khoá Invisalign Step up 2020" ], [ 'menu_order' => 1 ] );
		$mk( 'bac_si', 'Nguyễn Xuân Nhi', [ 'role' => 'Bác sĩ', 'bullets' => "Giám đốc chuyên môn khu vực\nThạc sĩ MSc, Cert Spec Orthodontist (Đức 2014)\nHơn 15 năm làm việc tại các nha khoa quốc tế\nChuyên gia đào tạo tại Invisalign" ], [ 'menu_order' => 2 ] );
		$mk( 'bac_si', 'Bác sĩ mẫu thứ ba', [ 'role' => 'Bác sĩ', 'bullets' => "Chuyên khoa Răng Hàm Mặt\nHơn 10 năm kinh nghiệm" ], [ 'menu_order' => 3 ] );
	}
	if ( $empty( 'nguoi_noi_tieng' ) ) {
		$desc = 'Chia sẻ trải nghiệm niềng răng, chăm sóc nụ cười cùng đội ngũ bác sĩ. Hãy thay phần mô tả này bằng lời chia sẻ thật của khách hàng.';
		foreach ( [ [ 'Trinh Phạm', 'Beauty blogger' ], [ 'Trần Việt Bảo Hoàng', 'CEO' ], [ 'Salim', 'KOL' ], [ 'Lê Hà Trúc', 'KOL' ], [ 'Hứa Kim Tuyền', 'Nhạc sỹ' ], [ 'An Phương', 'Beauty blogger' ] ] as $i => $c ) $mk( 'nguoi_noi_tieng', $c[0], [ 'role' => $c[1] ], [ 'post_excerpt' => $desc, 'menu_order' => $i ] );
	}
	if ( $empty( 'truoc_sau' ) ) {
		$mk( 'truoc_sau', 'Hoàng Quỳnh Anh', [ 'treatment' => 'Niềng răng mắc cài', 'before_txt' => 'Khớp cắn ngược, cắn chéo, răng khấp khểnh', 'after_txt' => 'Sắp đều răng, khớp cắn chuẩn. Chức năng ăn nhai ổn định' ] );
		$mk( 'truoc_sau', 'Chu Thị Bích Ngọc', [ 'treatment' => 'Niềng răng trong suốt Invisalign', 'before_txt' => 'Răng chen chúc hai hàm, hô và chìa', 'after_txt' => 'Khắc phục hoàn toàn răng khấp khểnh, hô' ] );
		$mk( 'truoc_sau', 'Lý Mỹ Uyên', [ 'treatment' => 'Niềng răng trong suốt Invisalign', 'before_txt' => 'Răng chen chúc hai hàm, hô và chìa', 'after_txt' => 'Răng đều, chức năng ăn nhai ổn định' ] );
	}
}

/* ---- Công cụ: dọn dịch vụ cũ & nạp lại mẫu ---- */
add_action( 'admin_menu', function () {
	add_management_page( 'Dọn dịch vụ cũ & nạp mẫu', 'Dọn dịch vụ cũ & nạp mẫu', 'manage_options', 'pw-reseed', 'pw_reseed_page' );
} );
function pw_reseed_page() {
	if ( ! current_user_can( 'manage_options' ) ) return;
	$msg = '';
	if ( isset( $_POST['pw_trash_legacy'] ) && check_admin_referer( 'pw_reseed' ) ) {
		$n = 0; foreach ( pw_legacy_posts( 'ids' ) as $id ) { wp_trash_post( $id ); $n++; }
		$msg = "Đã chuyển $n dịch vụ cũ vào Thùng rác (có thể khôi phục).";
	}
	if ( isset( $_POST['pw_reseed'] ) && check_admin_referer( 'pw_reseed' ) ) {
		pw_upgrade_content( true ); $msg = 'Đã nạp lại nội dung mẫu nha khoa (ghi đè các bài mẫu).';
	}
	$legacy = pw_legacy_posts();
	echo '<div class="wrap"><h1>Dọn dịch vụ cũ &amp; nạp mẫu</h1>';
	if ( $msg ) echo '<div class="notice notice-success"><p>' . esc_html( $msg ) . '</p></div>';
	echo '<h2>Dịch vụ cũ đang bị ẩn (' . count( $legacy ) . ')</h2>';
	if ( $legacy ) { echo '<ul style="list-style:disc;margin-left:20px">'; foreach ( $legacy as $p ) echo '<li>' . esc_html( $p->post_title ) . '</li>'; echo '</ul>'; } else echo '<p>Không có.</p>';
	echo '<form method="post">'; wp_nonce_field( 'pw_reseed' );
	echo '<p><button class="button" name="pw_trash_legacy" value="1" onclick="return confirm(\'Chuyển các dịch vụ cũ vào thùng rác?\')">Chuyển dịch vụ cũ vào Thùng rác</button></p>';
	echo '<hr><h2>Nạp lại nội dung mẫu</h2><p>Ghi đè nội dung các bài mẫu của theme (dịch vụ, nhóm, trang) bằng bản gốc. Bài bạn tự tạo không bị xoá.</p>';
	echo '<p><button class="button button-primary" name="pw_reseed" value="1" onclick="return confirm(\'Ghi đè nội dung mẫu?\')">Nạp lại mẫu</button></p></form></div>';
}

/** Bài viết mẫu (kiến thức / tin tức / báo chí): tạo mới hoặc cập nhật; bài bạn đã sửa tay không bị ghi đè. */
function pw_seed_articles_upsert( $force = false ) {
	global $wpdb;
	$site = get_bloginfo( 'name' ) ?: 'Novalink';
	foreach ( pw_seed_articles() as $key => $a ) {
		$cat = get_term_by( 'slug', $a['cat'], 'category' );
		if ( ! $cat ) continue;
		$title = str_replace( '{site}', $site, $a['title'] );
		$id = (int) $wpdb->get_var( $wpdb->prepare( "SELECT p.ID FROM {$wpdb->posts} p JOIN {$wpdb->postmeta} m ON m.post_id=p.ID AND m.meta_key='pw_seed_post' AND m.meta_value=%s WHERE p.post_type='post' AND p.post_status<>'trash' LIMIT 1", $key ) );
		if ( ! $id ) $id = (int) $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_type='post' AND post_status IN ('publish','draft','private') AND post_title=%s ORDER BY ID LIMIT 1", $title ) );
		$content = pw_build_content( $a['c'] );
		if ( ! $id ) {
			$ts = strtotime( '-' . (int) $a['days'] . ' days', current_time( 'timestamp' ) );
			$id = (int) wp_insert_post( [ 'post_type' => 'post', 'post_status' => 'publish', 'post_title' => $title, 'post_excerpt' => str_replace( '{site}', $site, $a['excerpt'] ), 'post_content' => $content, 'post_category' => [ (int) $cat->term_id ], 'post_date' => wp_date( 'Y-m-d H:i:s', $ts ) ] );
			if ( ! $id ) continue;
		} else {
			$old = (string) get_post_field( 'post_content', $id );
			$upd = [ 'ID' => $id ];
			if ( $force || strpos( $old, '<!--pw-seed-->' ) !== false || mb_strlen( wp_strip_all_tags( $old ) ) < 300 ) $upd['post_content'] = $content;
			if ( $force || ! get_post_field( 'post_excerpt', $id ) || mb_strlen( (string) get_post_field( 'post_excerpt', $id ) ) < 40 ) $upd['post_excerpt'] = str_replace( '{site}', $site, $a['excerpt'] );
			if ( count( $upd ) > 1 ) wp_update_post( $upd );
			if ( $force || ! has_term( $a['cat'], 'category', $id ) && ! has_term( 'kien-thuc-nha-khoa', 'category', $id ) && ! has_term( 'tin-tuc-su-kien', 'category', $id ) && ! has_term( 'bao-chi', 'category', $id ) ) wp_set_post_categories( $id, [ (int) $cat->term_id ] );
		}
		update_post_meta( $id, 'pw_seed_post', $key );
		if ( ! empty( $a['img'] ) && ( $force || (string) get_post_meta( $id, 'img_key', true ) === '' ) ) update_post_meta( $id, 'img_key', $a['img'] );
		if ( ! empty( $a['src'] ) && ( $force || (string) get_post_meta( $id, 'press_src', true ) === '' ) ) update_post_meta( $id, 'press_src', $a['src'] );
	}
	// Ca trước/sau: gán kiểu hình răng minh hoạ, thêm ca "ố vàng + sâu răng" nếu chưa có
	$types = [ 'Hoàng Quỳnh Anh' => 0, 'Chu Thị Bích Ngọc' => 1, 'Lý Mỹ Uyên' => 3 ];
	foreach ( get_posts( [ 'post_type' => 'truoc_sau', 'numberposts' => -1, 'post_status' => 'any' ] ) as $p ) {
		if ( isset( $types[ $p->post_title ] ) && (string) get_post_meta( $p->ID, 'ba_type', true ) === '' ) update_post_meta( $p->ID, 'ba_type', (string) $types[ $p->post_title ] );
	}
	if ( ! get_posts( [ 'post_type' => 'truoc_sau', 'numberposts' => 1, 'title' => 'Nguyễn Hải Yến', 'post_status' => 'any', 'fields' => 'ids' ] ) ) {
		$cid = wp_insert_post( [ 'post_type' => 'truoc_sau', 'post_status' => 'publish', 'post_title' => 'Nguyễn Hải Yến' ] );
		if ( $cid ) foreach ( [ 'treatment' => 'Bọc răng sứ thẩm mỹ', 'before_txt' => 'Răng ố vàng, sâu và mẻ, nướu viêm', 'after_txt' => 'Răng sứ trắng sáng, đều đẹp, nướu khoẻ', 'ba_type' => '2' ] as $k => $v ) update_post_meta( $cid, $k, $v );
	}
}
