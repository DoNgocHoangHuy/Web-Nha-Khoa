<?php $id = $args['id'] ?? 'f'; ?>
<form class="pw-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
	<input type="hidden" name="action" value="pw_contact">
	<?php wp_nonce_field( 'pw_contact', 'pw_nonce', true ); ?>
	<input class="hp" type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">
	<label for="n-<?php echo esc_attr( $id ); ?>">Họ và tên *
		<input id="n-<?php echo esc_attr( $id ); ?>" type="text" name="pw_name" placeholder="Nhập tên của bạn" required maxlength="80" autocomplete="name">
	</label>
	<label for="p-<?php echo esc_attr( $id ); ?>">Số điện thoại *
		<input id="p-<?php echo esc_attr( $id ); ?>" type="tel" name="pw_phone" placeholder="Nhập số điện thoại" required inputmode="tel" pattern="[0-9+\s\.\-]{9,16}" autocomplete="tel">
	</label>
	<div class="act"><button class="btn btn-cta" type="submit"><?php echo pw_icon( 'phone' ); ?> ĐẶT LỊCH NGAY</button></div>
</form>
