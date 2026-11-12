</main>

<footer class="site-footer">
	<div class="wrap ft-grid">
		<div class="ft-brand">
			<b><?php bloginfo( 'name' ); ?></b>
			<ul>
				<li>Công ty chủ quản: <?php echo esc_html( pw_opt( 'pw_company' ) ); ?></li>
				<li>Địa chỉ: <?php echo esc_html( pw_opt( 'pw_address' ) ); ?></li>
				<li>Email: <?php echo esc_html( pw_opt( 'pw_email' ) ); ?></li>
				<?php if ( $b = pw_opt( 'pw_biz', null, true ) ) echo '<li>' . esc_html( $b ) . '</li>'; ?>
				<li><?php echo esc_html( pw_opt( 'pw_legal', null, true ) ); ?></li>
			</ul>
			<?php $chat = pw_opt( 'pw_zalo' ) ?: pw_opt( 'pw_messenger' ); ?>
			<div class="ft-cta">
				<?php if ( $chat ) : ?><a class="ft-btn chat" href="<?php echo esc_url( $chat ); ?>" target="_blank" rel="noopener"><?php echo pw_icon( 'message' ); ?>Chat ngay</a>
				<?php else : ?><button type="button" class="ft-btn chat" data-open-contact><?php echo pw_icon( 'message' ); ?>Chat ngay</button><?php endif; ?>
				<a class="ft-btn call" href="tel:<?php echo esc_attr( pw_tel() ); ?>"><?php echo pw_icon( 'phone' ); ?>Gọi ngay</a>
			</div>
		</div>
		<div>
			<h3>Giới thiệu</h3>
			<?php wp_nav_menu( [ 'theme_location' => 'footer_about', 'container' => false, 'fallback_cb' => function () {
				echo '<ul>';
				foreach ( [ 'Về chúng tôi' => pw_page_url( 'gioi-thieu' ), 'Bảng giá dịch vụ' => pw_page_url( 'bang-gia' ), 'Tin tức sự kiện' => pw_cat_url( 'tin-tuc-su-kien' ), 'Kiến thức nha khoa' => pw_cat_url( 'kien-thuc-nha-khoa' ), 'Chính sách bảo mật' => pw_page_url( 'chinh-sach-bao-mat' ), 'Tuyển dụng' => pw_page_url( 'tuyen-dung' ) ] as $l => $u ) {
					echo '<li><a href="' . esc_url( $u ) . '">' . esc_html( $l ) . '</a></li>';
				}
				echo '</ul>';
			} ] ); ?>
		</div>
		<div>
			<h3>Giờ làm việc</h3>
			<p><?php echo esc_html( pw_opt( 'pw_hours' ) ); ?></p>
		</div>
		<div>
			<h3>Liên hệ</h3>
			<p>HOTLINE: <a href="tel:<?php echo esc_attr( pw_tel() ); ?>"><?php echo esc_html( pw_opt( 'pw_hotline' ) ); ?></a></p>
			<div class="ft-social">
				<?php if ( $u = pw_opt( 'pw_youtube' ) ) echo '<a href="' . esc_url( $u ) . '" aria-label="YouTube" target="_blank" rel="noopener">' . pw_icon( 'video' ) . '</a>'; ?>
				<?php if ( $u = pw_opt( 'pw_facebook' ) ) echo '<a href="' . esc_url( $u ) . '" aria-label="Facebook" target="_blank" rel="noopener"><b>f</b></a>'; ?>
				<?php if ( $u = pw_opt( 'pw_zalo' ) ) echo '<a href="' . esc_url( $u ) . '" aria-label="Zalo" target="_blank" rel="noopener"><b style="font-size:11px">Zalo</b></a>'; ?>
				<?php if ( $u = pw_opt( 'pw_messenger' ) ) echo '<a href="' . esc_url( $u ) . '" aria-label="Messenger" target="_blank" rel="noopener">' . pw_icon( 'message' ) . '</a>'; ?>
				<a href="mailto:<?php echo esc_attr( pw_opt( 'pw_email' ) ); ?>" aria-label="Email"><?php echo pw_icon( 'mail' ); ?></a>
			</div>
		</div>
	</div>
	<div class="ft-bar"><?php $r = pw_opt( 'pw_responsible', null, true ); echo esc_html( $r ?: '© ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) . '. Bảo lưu mọi quyền.' ); ?></div>
</footer>

<!-- Nút nổi bên phải (dạng thanh dọc như Parkway) -->
<?php
$zl = pw_opt( 'pw_zalo' ) ?: 'https://zalo.me/' . pw_tel();
$ms = pw_opt( 'pw_messenger' ) ?: pw_opt( 'pw_facebook' );
$zalo_svg = '<svg viewBox="0 0 48 48" width="34" height="34" aria-hidden="true"><rect width="48" height="48" rx="12" fill="#fff"/><rect x="3" y="3" width="42" height="42" rx="10" fill="#0068ff"/><text x="24" y="30" text-anchor="middle" font-family="Arial,sans-serif" font-size="14" font-weight="800" fill="#fff">Zalo</text></svg>';
$ms_svg = '<svg viewBox="0 0 48 48" width="32" height="32" aria-hidden="true"><defs><linearGradient id="pwMs" x1="0" y1="1" x2="1" y2="0"><stop offset="0" stop-color="#0099ff"/><stop offset="1" stop-color="#a033ff"/></linearGradient></defs><circle cx="24" cy="24" r="22" fill="url(#pwMs)"/><path d="M10 30l8-12 6 6 7-6-8 12-6-6z" fill="#fff"/></svg>';
?>
<div class="float" aria-label="Liên hệ nhanh">
	<a class="up" href="#top" data-top aria-label="Lên đầu trang"><?php echo pw_icon( 'up' ); ?></a>
	<button type="button" data-float-toggle aria-expanded="false" aria-controls="float-panel" aria-label="Hotline"><?php echo pw_icon( 'phone' ); ?></button>
	<button type="button" data-open-contact aria-label="Đặt lịch hẹn"><?php echo pw_icon( 'calendar' ); ?></button>
	<a class="zalo" href="<?php echo esc_url( $zl ); ?>" target="_blank" rel="noopener" aria-label="Zalo"><?php echo $zalo_svg; ?></a>
	<?php if ( $ms ) : ?><a class="ms" href="<?php echo esc_url( $ms ); ?>" target="_blank" rel="noopener" aria-label="Messenger"><?php echo $ms_svg; ?></a>
	<?php else : ?><button type="button" class="ms" data-open-contact aria-label="Nhắn tin"><?php echo $ms_svg; ?></button><?php endif; ?>
</div>

<?php if ( $ms || $zl ) : $chat_url = $ms ?: $zl; ?>
<a class="chat-pill" href="<?php echo esc_url( $chat_url ); ?>" target="_blank" rel="noopener"><span class="av"><?php echo esc_html( mb_substr( get_bloginfo( 'name' ), 0, 1 ) ); ?></span>Nhắn tin ngay</a>
<?php endif; ?>

<div class="float-panel" id="float-panel" hidden>
	<b>Hotline tư vấn</b>
	<a class="num" href="tel:<?php echo esc_attr( pw_tel() ); ?>"><?php echo esc_html( pw_opt( 'pw_hotline' ) ); ?></a>
	<p><?php echo esc_html( pw_opt( 'pw_hours' ) ); ?></p>
	<a class="go" href="tel:<?php echo esc_attr( pw_tel() ); ?>"><?php echo pw_icon( 'phone' ); ?>Gọi ngay</a>
	<button type="button" class="cl" data-float-close>Đóng</button>
</div>

<?php if ( $promo = pw_opt( 'pw_promo', null, true ) ) : ?>
<div class="promo" data-promo><button type="button" aria-label="Đóng">×</button><?php echo esc_html( $promo ); ?></div>
<?php endif; ?>

<!-- Popup đặt lịch -->
<div class="modal" id="contact-modal" role="dialog" aria-modal="true" aria-labelledby="cm-t">
	<div class="box">
		<button class="x" type="button" data-close-contact aria-label="Đóng">×</button>
		<h3 id="cm-t">Thông tin liên hệ</h3>
		<p>Giờ làm việc <?php echo esc_html( pw_opt( 'pw_hours' ) ); ?>. Vui lòng để lại thông tin, chúng tôi sẽ liên hệ lại sớm nhất.</p>
		<?php get_template_part( 'template-parts/booking-form', null, [ 'id' => 'm' ] ); ?>
	</div>
</div>

<nav class="mobile-bar" aria-label="Điều hướng nhanh">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo pw_icon( 'home' ); ?>Trang chủ</a>
	<a href="<?php echo esc_url( pw_page_url( 'bang-gia' ) ); ?>"><?php echo pw_icon( 'tag' ); ?>Bảng giá</a>
	<a href="<?php echo esc_url( pw_opt( 'pw_booking_url' ) ); ?>"><?php echo pw_icon( 'calendar' ); ?>Đặt lịch</a>
</nav>

<?php if ( isset( $_GET['pw_sent'] ) ) : $ok = $_GET['pw_sent'] === '1'; ?>
<div class="toast <?php echo $ok ? '' : 'err'; ?>" role="status" data-toast><?php echo $ok ? 'Đã gửi thông tin. Chúng tôi sẽ liên hệ lại sớm!' : 'Vui lòng nhập đúng họ tên và số điện thoại.'; ?></div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
