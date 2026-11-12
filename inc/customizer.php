<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'customize_register', function ( $wp ) {
	$add = function ( $section, $id, $label, $type = 'text', $default = null ) use ( $wp ) {
			if ( $default === null ) { $d = pw_defaults(); $default = $d[ $id ] ?? ''; }
		$cb = $type === 'textarea' ? 'sanitize_textarea_field' : ( $type === 'url' ? 'esc_url_raw' : ( $type === 'checkbox' ? 'absint' : 'sanitize_text_field' ) );
		$wp->add_setting( $id, [ 'default' => $default, 'sanitize_callback' => $cb ] );
		$wp->add_control( $id, [ 'section' => $section, 'label' => $label, 'type' => $type ] );
	};

	$wp->add_panel( 'pw_panel', [ 'title' => 'Parkway – Nội dung trang chủ', 'priority' => 30 ] );

	$wp->add_section( 'pw_info', [ 'title' => 'Thông tin chung', 'panel' => 'pw_panel' ] );
	$add( 'pw_info', 'pw_hotline', 'Hotline', 'text' );
	$add( 'pw_info', 'pw_booking_url', 'Link nút Đặt lịch hẹn', 'text' );
	$add( 'pw_info', 'pw_company', 'Công ty chủ quản', 'text' );
	$add( 'pw_info', 'pw_address', 'Địa chỉ', 'textarea' );
	$add( 'pw_info', 'pw_email', 'Email', 'text' );
	$add( 'pw_info', 'pw_hours', 'Giờ làm việc', 'text' );
	$add( 'pw_info', 'pw_legal', 'Lưu ý (footer)', 'textarea' );
	$add( 'pw_info', 'pw_biz', 'Đăng ký kinh doanh (VD: GCNĐKDN số ..., do Sở KH&ĐT ... cấp ngày ...)', 'textarea' );
	$add( 'pw_info', 'pw_responsible', 'Người chịu trách nhiệm nội dung (VD: Giám đốc Nguyễn Văn A - SĐT ...)', 'text' );
	$add( 'pw_info', 'pw_facebook', 'Facebook', 'url' );
	$add( 'pw_info', 'pw_youtube', 'YouTube', 'url' );
	$add( 'pw_info', 'pw_zalo', 'Link Zalo', 'url' );
	$add( 'pw_info', 'pw_messenger', 'Link Messenger', 'url' );
	$add( 'pw_info', 'pw_promo', 'Nội dung bong bóng khuyến mãi (để trống = ẩn)', 'textarea' );
		$wp->add_setting( 'pw_use_wp_menu', [ 'default' => 0, 'sanitize_callback' => 'absint' ] );
		$wp->add_control( 'pw_use_wp_menu', [ 'section' => 'pw_info', 'label' => 'Dùng menu tự tạo trong Giao diện → Menu (mặc định tắt: dùng menu chuẩn của theme)', 'type' => 'checkbox' ] );

	$wp->add_section( 'pw_hero', [ 'title' => 'Banner trang chủ', 'panel' => 'pw_panel', 'description' => 'Ảnh khuyến nghị 1920×616px. Để trống tất cả = dùng banner mẫu.' ] );
	for ( $i = 1; $i <= 4; $i++ ) {
		$wp->add_setting( "pw_hero_img_$i", [ 'sanitize_callback' => 'absint' ] );
		$wp->add_control( new WP_Customize_Media_Control( $wp, "pw_hero_img_$i", [ 'section' => 'pw_hero', 'label' => "Banner $i", 'mime_type' => 'image' ] ) );
		$add( 'pw_hero', "pw_hero_link_$i", "Link banner $i", 'url' );
	}

	// Video banner (tối đa 2): tải video MP4 lên Thư viện media hoặc dán link MP4. Để trống = dùng 2 video mẫu miễn phí.
	foreach ( [ 1, 2 ] as $v ) {
		$wp->add_setting( "pw_hero_vid_$v", [ 'sanitize_callback' => 'absint' ] );
		$wp->add_control( new WP_Customize_Media_Control( $wp, "pw_hero_vid_$v", [ 'section' => 'pw_hero', 'label' => "Video banner $v (MP4, nên ≤ 15MB, không cần tiếng)", 'mime_type' => 'video' ] ) );
		$add( 'pw_hero', "pw_hero_vidurl_$v", "…hoặc dán link MP4 cho video $v", 'url', '' );
		$add( 'pw_hero', "pw_hero_vidt_$v", "Tiêu đề trên video $v", 'text', '' );
		$add( 'pw_hero', "pw_hero_vidb_$v", "Chữ nút trên video $v", 'text', '' );
		$add( 'pw_hero', "pw_hero_vidl_$v", "Link nút trên video $v", 'url', '' );
	}

	$wp->add_section( 'pw_diamond', [ 'title' => 'Danh hiệu xuất sắc (cúp)', 'panel' => 'pw_panel' ] );
	$wp->add_setting( 'pw_diamond_text', [ 'default' => '', 'sanitize_callback' => 'wp_kses_post' ] );
	$wp->add_control( 'pw_diamond_text', [ 'section' => 'pw_diamond', 'label' => 'Nội dung (cho phép <strong>, <br>)', 'type' => 'textarea' ] );
	$wp->add_setting( 'pw_diamond_img', [ 'sanitize_callback' => 'absint' ] );
	$wp->add_control( new WP_Customize_Media_Control( $wp, 'pw_diamond_img', [ 'section' => 'pw_diamond', 'label' => 'Ảnh cúp / huy hiệu', 'mime_type' => 'image' ] ) );

	$wp->add_section( 'pw_reasons', [ 'title' => 'Lý do chọn phòng khám', 'panel' => 'pw_panel' ] );
	$add( 'pw_reasons', 'pw_reasons_title', 'Tiêu đề', 'text' );
	$add( 'pw_reasons', 'pw_reasons_items', 'Mỗi dòng: URL ảnh|Chú thích (bỏ trống URL nếu chưa có ảnh)', 'textarea' );

	$wp->add_section( 'pw_price', [ 'title' => 'Bảng giá răng sứ', 'panel' => 'pw_panel' ] );
	$add( 'pw_price', 'pw_price_title', 'Tiêu đề', 'text' );
	$add( 'pw_price', 'pw_price_rows', 'Mỗi dòng: Thương hiệu|Dòng sứ|Xuất xứ|Đơn vị|Giá gốc|Bảo hành|Ưu đãi', 'textarea' );
	$add( 'pw_price', 'pw_price_note', 'Ghi chú dưới bảng', 'text' );

	$wp->add_section( 'pw_celeb', [ 'title' => 'Người nổi tiếng', 'panel' => 'pw_panel' ] );
	$add( 'pw_celeb', 'pw_celeb_title', 'Tiêu đề', 'text' );
	$add( 'pw_celeb', 'pw_celeb_sub', 'Mô tả giới thiệu mục', 'textarea' );
} );
