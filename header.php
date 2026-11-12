<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>document.documentElement.classList.add('js')</script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="sr" href="#main">Bỏ qua điều hướng</a>

<header class="site-header" id="top">
	<div class="wrap hd">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php bloginfo( 'name' ); ?>">
			<?php if ( has_custom_logo() ) { echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full' ); } else { ?>
				<b><?php bloginfo( 'name' ); ?></b><small><?php echo esc_html( get_bloginfo( 'description' ) ?: 'Người bạn trọn đời' ); ?></small>
			<?php } ?>
		</a>

		<div class="hd-top">
			<div class="hd-search">
				<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php echo pw_icon( 'search' ); ?>
					<label class="sr" for="hs">Tìm kiếm</label>
					<input id="hs" type="search" name="s" placeholder="Tìm kiếm dịch vụ, bài viết..." value="<?php echo esc_attr( get_search_query() ); ?>">
				</form>
				<div class="hd-links"><?php pw_render_small_menu(); ?></div>
			</div>
			<div class="hd-actions">
				<a class="btn btn-line" href="tel:<?php echo esc_attr( pw_tel() ); ?>"><?php echo pw_icon( 'phone' ); ?><span><?php echo esc_html( pw_opt( 'pw_hotline' ) ); ?></span></a>
				<a class="btn btn-navy" href="<?php echo esc_url( pw_opt( 'pw_booking_url' ) ); ?>"><?php echo pw_icon( 'calendar' ); ?><span>Đặt lịch hẹn</span></a>
			</div>
			<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="main-nav" aria-label="Mở menu"><?php echo pw_icon( 'menu', 'ico' ); ?></button>
		</div>

		<nav class="main-nav" id="main-nav" aria-label="Menu chính"><?php pw_render_primary_menu(); ?></nav>
	</div>
</header>
<main id="main">
