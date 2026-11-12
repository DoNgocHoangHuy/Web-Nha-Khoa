<?php
/** Danh sách dịch vụ có bộ lọc. $args: title, crumbs[], intro_html */
$title  = $args['title'] ?? 'Dịch vụ';
$crumbs = $args['crumbs'] ?? [];
?>
<div class="sl-top"><div class="wrap">
	<nav class="crumbs" aria-label="Breadcrumb">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a>
		<?php foreach ( $crumbs as $c ) echo '<span>›</span>' . ( ! empty( $c[1] ) ? '<a href="' . esc_url( $c[1] ) . '">' . esc_html( $c[0] ) . '</a>' : '<b>' . esc_html( $c[0] ) . '</b>' ); ?>
	</nav>
	<h1><?php echo esc_html( $title ); ?></h1>
</div></div>

<section class="sl">
	<div class="wrap">
		<div class="sl-groups" aria-label="Nhóm dịch vụ">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'dich_vu' ) ); ?>" class="<?php echo is_post_type_archive( 'dich_vu' ) ? 'on' : ''; ?>">Tất cả dịch vụ</a>
			<?php foreach ( pw_top_groups() as $g ) { $t = get_term_by( 'name', $g, 'nhom_dich_vu' ); $cur = $t && is_tax( 'nhom_dich_vu' ) && ( get_queried_object_id() === (int) $t->term_id || term_is_ancestor_of( $t, get_queried_object(), 'nhom_dich_vu' ) ); echo '<a class="' . ( $cur ? 'on' : '' ) . '" href="' . esc_url( pw_term_url( $g ) ) . '">' . esc_html( $g ) . '</a>'; } ?>
		</div>
		<div class="sl-filter" data-filter role="tablist" aria-label="Lọc dịch vụ">
			<button type="button" class="on" data-f="all">Tất cả</button>
			<button type="button" data-f="sale">Khuyến mãi</button>
			<button type="button" data-f="hot">Bán chạy</button>
			<button type="button" data-f="desc">Giá từ cao xuống thấp</button>
			<button type="button" data-f="asc">Giá từ thấp đến cao</button>
		</div>
		<?php if ( have_posts() ) : ?>
			<div class="grid4 sl-grid" data-grid>
				<?php while ( have_posts() ) { the_post(); echo pw_service_card(); } ?>
			</div>
			<p class="center sl-empty" data-empty hidden>Chưa có dịch vụ phù hợp bộ lọc này.</p>
			<div class="pager"><?php echo paginate_links( [ 'prev_text' => '‹', 'next_text' => '›' ] ); ?></div>
		<?php elseif ( is_post_type_archive( 'dich_vu' ) || ! is_tax() ) : ?>
			<div class="grid4 sl-grid" data-grid>
				<?php foreach ( pw_demo_services() as $i => $r ) echo pw_demo_card( $r, $i ); ?>
			</div>
			<p class="center sl-empty" data-empty hidden>Chưa có dịch vụ phù hợp bộ lọc này.</p>
			<?php if ( current_user_can( 'edit_posts' ) ) echo '<p class="center sl-empty">(Chỉ quản trị viên thấy dòng này) Đây là gói mẫu. Vào <b>Dịch vụ → Thêm mới</b> để đăng gói thật, gói mẫu sẽ tự biến mất.</p>'; ?>
		<?php else : ?>
			<p class="center sl-empty">Chưa có dịch vụ trong nhóm này. Vào <b>Dịch vụ</b>, sửa gói và chọn nhóm "<?php echo esc_html( single_term_title( '', false ) ); ?>".</p>
		<?php endif; ?>
	</div>
</section>
