<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'init', function () {
	$common = [ 'public' => true, 'has_archive' => true, 'show_in_rest' => true, 'menu_position' => 5 ];

	register_post_type( 'dich_vu', $common + [
		'labels'    => [ 'name' => 'Dịch vụ', 'singular_name' => 'Dịch vụ', 'add_new_item' => 'Thêm dịch vụ', 'edit_item' => 'Sửa dịch vụ', 'all_items' => 'Tất cả dịch vụ' ],
		'menu_icon' => 'dashicons-heart', 'rewrite' => [ 'slug' => 'dich-vu' ],
		'supports'  => [ 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ],
	] );
	register_taxonomy( 'nhom_dich_vu', 'dich_vu', [
		'labels' => [ 'name' => 'Nhóm dịch vụ', 'singular_name' => 'Nhóm dịch vụ' ],
		'hierarchical' => true, 'show_in_rest' => true, 'show_admin_column' => true, 'rewrite' => [ 'slug' => 'nhom-dich-vu' ],
	] );
	register_post_type( 'bac_si', $common + [
		'labels'    => [ 'name' => 'Bác sĩ', 'singular_name' => 'Bác sĩ', 'add_new_item' => 'Thêm bác sĩ', 'all_items' => 'Tất cả bác sĩ' ],
		'menu_icon' => 'dashicons-businessperson', 'rewrite' => [ 'slug' => 'bac-si' ],
		'supports'  => [ 'title', 'editor', 'thumbnail', 'page-attributes' ],
	] );
	register_post_type( 'nguoi_noi_tieng', [
		'labels'    => [ 'name' => 'Người nổi tiếng', 'singular_name' => 'Người nổi tiếng', 'add_new_item' => 'Thêm người nổi tiếng', 'all_items' => 'Tất cả' ],
		'menu_icon' => 'dashicons-star-filled', 'public' => false, 'show_ui' => true, 'menu_position' => 5,
		'supports'  => [ 'title', 'excerpt', 'thumbnail', 'page-attributes' ],
	] );
	register_post_type( 'truoc_sau', [
		'labels'    => [ 'name' => 'Trước & Sau', 'singular_name' => 'Ca điều trị', 'add_new_item' => 'Thêm ca điều trị', 'all_items' => 'Tất cả ca' ],
		'menu_icon' => 'dashicons-images-alt2', 'public' => false, 'show_ui' => true, 'menu_position' => 5,
		'supports'  => [ 'title' ],
	] );
	register_post_type( 'lien_he', [
		'labels'       => [ 'name' => 'Khách đặt lịch', 'singular_name' => 'Khách đặt lịch', 'all_items' => 'Tất cả liên hệ' ],
		'public'       => false, 'show_ui' => true, 'menu_icon' => 'dashicons-phone', 'menu_position' => 6,
		'supports'     => [ 'title', 'editor' ], 'capability_type' => 'post',
		'capabilities' => [ 'create_posts' => 'do_not_allow' ], 'map_meta_cap' => true,
	] );
} );

/* ---- Meta boxes ---- */
function pw_fields() {
	return [
		'dich_vu' => [ 'Thông tin dịch vụ', [
			'price_old'   => [ 'Giá gốc (VD: 23000000)', 'text' ],
			'price_new'   => [ 'Giá khuyến mãi (VD: 14900000). BẮT BUỘC có thì dịch vụ mới hiện ở trang Dịch vụ', 'text' ],
			'group_label' => [ 'Nhãn nhóm (VD: Trồng răng Implant)', 'text' ],
			'unit'        => [ 'Đơn vị tính (mặc định: Lần)', 'text' ],
			'price_note'  => [ 'Ghi chú dưới giá (mặc định: *Tuỳ thuộc chỉ định của bác sĩ)', 'text' ],
			'perks'       => [ 'Điểm nổi bật ở thẻ "Dịch vụ yêu thích" – ngăn cách bằng dấu | (VD: Trả góp 0%|Bảo hành 7 năm)', 'text' ],
			'img_key'     => [ 'Khoá ảnh mẫu (tuỳ chọn, VD: implant2) – chỉ dùng khi chưa đặt Ảnh đại diện', 'text' ],
			'show_grid'   => [ 'Hiện trong lưới "Chăm sóc sức khoẻ răng miệng toàn diện"', 'check' ],
			'is_popular'  => [ 'Hiện trong "Dịch vụ đang được yêu thích" (nên chọn đúng 4 dịch vụ)', 'check' ],
		] ],
		'bac_si' => [ 'Thông tin bác sĩ', [
			'role'    => [ 'Chức danh', 'text' ],
			'bullets' => [ 'Chuyên môn / chứng chỉ (mỗi dòng 1 ý)', 'textarea' ],
		] ],
		'nguoi_noi_tieng' => [ 'Thông tin', [
			'role' => [ 'Nghề nghiệp (VD: Beauty blogger)', 'text' ],
		] ],
		'post' => [ 'Thông tin bài viết (ảnh mẫu / báo chí)', [
			'img_key'   => [ 'Khoá ảnh mẫu (tuỳ chọn, VD: implant2) – chỉ dùng khi chưa đặt Ảnh đại diện', 'text' ],
			'press_src' => [ 'Chỉ cho bài BÁO CHÍ – tên báo/kênh (VD: Tên báo điện tử)', 'text' ],
			'press_url' => [ 'Chỉ cho bài BÁO CHÍ – link bài báo gốc (nếu có)', 'text' ],
		] ],
		'truoc_sau' => [ 'Ca điều trị', [
			'treatment'  => [ 'Phương pháp (VD: Niềng răng mắc cài)', 'text' ],
			'before_txt' => [ 'Mô tả trước điều trị', 'textarea' ],
			'after_txt'  => [ 'Mô tả sau điều trị', 'textarea' ],
			'before_img' => [ 'URL ảnh TRƯỚC (upload ở Thư viện media rồi dán link)', 'text' ],
			'after_img'  => [ 'URL ảnh SAU', 'text' ],
			'ba_type'    => [ 'Kiểu hình răng minh hoạ khi chưa có ảnh thật (0 = chen chúc, 1 = thưa/hô, 2 = ố vàng + sâu, 3 = chen chúc đảo bên)', 'text' ],
		] ],
	];
}

add_action( 'add_meta_boxes', function () {
	foreach ( pw_fields() as $pt => $def ) {
		add_meta_box( 'pw_meta', $def[0], function ( $post ) use ( $def ) {
			wp_nonce_field( 'pw_meta_save', 'pw_meta_nonce' );
			foreach ( $def[1] as $key => $f ) {
				$val = get_post_meta( $post->ID, $key, true );
				echo '<p><label><strong>' . esc_html( $f[0] ) . '</strong><br>';
				if ( $f[1] === 'check' ) {
					echo '<input type="checkbox" name="pw_' . esc_attr( $key ) . '" value="1" ' . checked( $val, '1', false ) . '>';
				} elseif ( $f[1] === 'textarea' ) {
					echo '<textarea name="pw_' . esc_attr( $key ) . '" rows="6" style="width:100%">' . esc_textarea( $val ) . '</textarea>';
				} else {
					echo '<input type="text" name="pw_' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" style="width:100%">';
				}
				echo '</label></p>';
			}
		}, $pt, 'normal', 'high' );
	}
} );

add_action( 'save_post', function ( $post_id ) {
	if ( ! isset( $_POST['pw_meta_nonce'] ) || ! wp_verify_nonce( $_POST['pw_meta_nonce'], 'pw_meta_save' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	$fields = pw_fields()[ get_post_type( $post_id ) ] ?? null;
	if ( ! $fields ) return;
	foreach ( $fields[1] as $key => $f ) {
		$raw = $_POST[ 'pw_' . $key ] ?? '';
		if ( $f[1] === 'check' ) { $val = $raw ? '1' : ''; }
		elseif ( $f[1] === 'textarea' ) { $val = sanitize_textarea_field( wp_unslash( $raw ) ); }
		elseif ( substr( $key, -4 ) === '_img' || $key === 'press_url' ) { $val = esc_url_raw( wp_unslash( $raw ) ); }
		else { $val = sanitize_text_field( wp_unslash( $raw ) ); }
		update_post_meta( $post_id, $key, $val );
	}
	// Bài cũ được người dùng nhập giá → coi là dịch vụ nha khoa thật, cho hiện lại.
	if ( get_post_type( $post_id ) === 'dich_vu' && ! empty( $_POST['pw_price_new'] ) ) delete_post_meta( $post_id, 'pw_legacy' );
} );

add_action( 'after_switch_theme', function () { flush_rewrite_rules(); } );

/* ---- Nhóm dịch vụ: nội dung bài giới thiệu (soạn bằng trình soạn thảo) ---- */
add_action( 'nhom_dich_vu_edit_form_fields', function ( $term ) {
	echo '<tr class="form-field"><th scope="row"><label>Bài giới thiệu nhóm</label></th><td>';
	wp_editor( (string) get_term_meta( $term->term_id, 'pw_content', true ), 'pw_content', [ 'textarea_name' => 'pw_content', 'media_buttons' => true, 'textarea_rows' => 18 ] );
	echo '<p class="description">Hiện bên dưới danh sách gói ở trang nhóm dịch vụ.</p></td></tr>';
} );
add_action( 'edited_nhom_dich_vu', function ( $term_id ) {
	if ( isset( $_POST['pw_content'] ) && current_user_can( 'edit_term', $term_id ) ) update_term_meta( $term_id, 'pw_content', wp_kses( wp_unslash( $_POST['pw_content'] ), pw_allowed_html() ) );
} );

/* =====================================================================
 * Lọc dữ liệu cũ (bài "Thiết kế AI", "SEO tổng thể"… của web trước đó)
 * – Mọi bài Dịch vụ bị đánh dấu `pw_legacy` sẽ KHÔNG hiện ở trang web (danh sách, nhóm, tìm kiếm, bài chi tiết).
 * – Dữ liệu vẫn còn trong trang quản trị; dọn ở Công cụ → "Dọn dịch vụ cũ & nạp mẫu".
 * ===================================================================== */
add_action( 'pre_get_posts', function ( $q ) {
	if ( is_admin() || $q->get( 'pw_all' ) || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) return;
	$pt  = $q->get( 'post_type' );
	$svc = ( is_string( $pt ) && $pt === 'dich_vu' ) || ( is_array( $pt ) && in_array( 'dich_vu', $pt, true ) )
		|| $q->is_post_type_archive( 'dich_vu' ) || $q->is_tax( 'nhom_dich_vu' ) || $q->is_search();
	if ( ! $svc ) return;

	$mq = (array) $q->get( 'meta_query' );
	if ( $q->is_main_query() && ( $q->is_post_type_archive( 'dich_vu' ) || $q->is_tax( 'nhom_dich_vu' ) ) ) {
		$q->set( 'posts_per_page', 24 ); $q->set( 'orderby', 'menu_order date' ); $q->set( 'order', 'ASC' );
		// Trang danh sách chỉ hiện dịch vụ có giá (bỏ các ô "chỉ để làm lối tắt" ở trang chủ).
		$mq[] = [ 'key' => 'price_new', 'value' => '', 'compare' => '!=' ];
	}
	$legacy = [ 'key' => 'pw_legacy', 'compare' => 'NOT EXISTS' ];
	$q->set( 'meta_query', $mq ? [ 'relation' => 'AND', $legacy, $mq ] : [ $legacy ] );
} );

/** Ô lối tắt (không có giá) trùng tên với một nhóm → chuyển sang trang nhóm. */
add_action( 'template_redirect', function () {
	if ( ! is_singular( 'dich_vu' ) ) return;
	$id = get_queried_object_id();
	if ( (string) get_post_meta( $id, 'price_new', true ) !== '' ) return;
	$u = pw_group_url( get_the_title( $id ) );
	if ( $u ) { wp_safe_redirect( $u, 301 ); exit; }
} );

/** Các bài cũ cần dọn. */
function pw_legacy_posts( $fields = 'all' ) {
	return get_posts( [ 'post_type' => 'dich_vu', 'post_status' => [ 'publish', 'draft', 'pending', 'private', 'future' ], 'numberposts' => -1, 'fields' => $fields,
		'meta_query' => [ [ 'key' => 'pw_legacy', 'value' => '1' ] ], 'pw_all' => true ] );
}

add_action( 'admin_notices', function () {
	$s = get_current_screen();
	if ( ! $s || $s->post_type !== 'dich_vu' || $s->base !== 'edit' ) return;
	$n = count( pw_legacy_posts( 'ids' ) );
	if ( $n ) echo '<div class="notice notice-warning"><p><b>' . (int) $n . ' dịch vụ cũ</b> (không thuộc nha khoa) đang được ẨN khỏi website. Muốn xoá hẳn: <a href="' . esc_url( admin_url( 'tools.php?page=pw-reseed' ) ) . '">Công cụ → Dọn dịch vụ cũ &amp; nạp mẫu</a>.</p></div>';
} );
