<?php
/**
 * Parkway Dental – functions
 */
if ( ! defined( 'ABSPATH' ) ) exit;
define( 'PW_VER', '1.2.0' );
define( 'PW_SEED_VER', 4 ); // tăng số này khi muốn theme tự nạp lại/ cập nhật nội dung mẫu

require_once get_template_directory() . '/inc/helpers.php';
require_once get_template_directory() . '/inc/images.php';
require_once get_template_directory() . '/inc/post-types.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/service-content.php';
require_once get_template_directory() . '/inc/seed-data.php';
require_once get_template_directory() . '/inc/seed-groups.php';
require_once get_template_directory() . '/inc/seed-pages.php';
require_once get_template_directory() . '/inc/seed-news.php';
require_once get_template_directory() . '/inc/teeth.php';
require_once get_template_directory() . '/inc/demo-content.php';

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'gallery', 'caption', 'style', 'script' ] );
	add_theme_support( 'custom-logo', [ 'height' => 80, 'width' => 260, 'flex-width' => true, 'flex-height' => true ] );
	add_theme_support( 'responsive-embeds' );
	add_image_size( 'pw-card', 720, 540, true );
	register_nav_menus( [
		'primary'       => 'Menu chính',
		'top'           => 'Menu nhỏ dưới ô tìm kiếm',
		'footer_about'  => 'Footer – Giới thiệu',
		'footer_clinic' => 'Footer – Hệ thống phòng khám',
	] );
} );

add_action( 'wp_enqueue_scripts', function () {
	// Dùng thời gian sửa file làm số phiên bản => sửa theme xong khách không bị dính cache cũ.
	$css = get_stylesheet_directory() . '/style.css';
	$js  = get_template_directory() . '/assets/js/main.js';
	wp_enqueue_style( 'pw-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap', [], null );
	wp_enqueue_style( 'pw-style', get_stylesheet_uri(), [], file_exists( $css ) ? filemtime( $css ) : PW_VER );
	wp_enqueue_script( 'pw-main', get_template_directory_uri() . '/assets/js/main.js', [], file_exists( $js ) ? filemtime( $js ) : PW_VER, true );
} );

add_filter( 'wp_resource_hints', function ( $urls, $relation ) {
	if ( $relation === 'preconnect' ) {
		$urls[] = 'https://fonts.googleapis.com';
		$urls[] = [ 'href' => 'https://fonts.gstatic.com', 'crossorigin' ];
		$urls[] = 'https://images.unsplash.com';
	}
	return $urls;
}, 10, 2 );

/* ---- Liên hệ / đặt lịch ---- */
add_action( 'admin_post_nopriv_pw_contact', 'pw_handle_contact' );
add_action( 'admin_post_pw_contact', 'pw_handle_contact' );
function pw_handle_contact() {
	$back = wp_get_referer() ? remove_query_arg( 'pw_sent', wp_get_referer() ) : home_url( '/' );
	if ( empty( $_POST['pw_nonce'] ) || ! wp_verify_nonce( $_POST['pw_nonce'], 'pw_contact' ) ) {
		wp_safe_redirect( add_query_arg( 'pw_sent', '0', $back ) ); exit;
	}
	if ( ! empty( $_POST['website'] ) ) { // honeypot
		wp_safe_redirect( add_query_arg( 'pw_sent', '1', $back ) ); exit;
	}
	$name  = sanitize_text_field( wp_unslash( $_POST['pw_name'] ?? '' ) );
	$phone = preg_replace( '/[^0-9+]/', '', wp_unslash( $_POST['pw_phone'] ?? '' ) );
	if ( $name === '' || strlen( $phone ) < 9 || strlen( $phone ) > 14 ) {
		wp_safe_redirect( add_query_arg( 'pw_sent', '0', $back ) ); exit;
	}
	wp_insert_post( [
		'post_type'    => 'lien_he',
		'post_status'  => 'private',
		'post_title'   => $name . ' – ' . $phone,
		'post_content' => "Họ tên: $name\nSĐT: $phone\nTrang: $back",
	] );
	wp_mail( get_option( 'admin_email' ), '[Đặt lịch] ' . $name . ' – ' . $phone, "Họ tên: $name\nSĐT: $phone\nTừ trang: $back" );
	wp_safe_redirect( add_query_arg( 'pw_sent', '1', $back ) ); exit;
}
