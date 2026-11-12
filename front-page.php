<?php
/**
 * Trang chủ – thứ tự khối (theo feedback):
 * Banner → Icon nhanh → Lý do chọn (ảnh ghép) → Chăm sóc toàn diện → Dịch vụ yêu thích
 * → Bảng giá → Cúp danh hiệu → Bác sĩ → Người nổi tiếng → Trước/Sau → Bản tin → Form đặt lịch
 * Khối nào chưa có dữ liệu thì tự dùng nội dung mẫu để không bị mất.
 */
get_header();
$site    = get_bloginfo( 'name' );
$svc_url = get_post_type_archive_link( 'dich_vu' ) ?: '#';
$ph      = '<span class="ph">' . pw_icon( 'tooth' ) . '</span>';

/* ============ Banner ============ */
$slides = [];
for ( $i = 1; $i <= 4; $i++ ) {
	if ( $img = (int) get_theme_mod( "pw_hero_img_$i" ) ) $slides[] = [ 'img' => $img, 'link' => get_theme_mod( "pw_hero_link_$i" ) ];
}

/* Video banner: ưu tiên video bạn tải lên / dán link; để trống thì dùng 2 video mẫu (Mixkit – miễn phí bản quyền) */
$vid_def = [
	1 => [ 'src' => [ 'https://assets.mixkit.co/videos/6586/6586-720.mp4', 'https://assets.mixkit.co/videos/6586/6586-360.mp4' ], 'poster' => 'chair',   'title' => 'Thăm khám tận tâm – điều trị nhẹ nhàng', 'text' => 'Quy trình vô trùng một chiều, bác sĩ giải thích rõ từng bước trước khi điều trị.', 'btn' => 'Đặt lịch khám', 'link' => '#dat-lich' ],
	2 => [ 'src' => [ 'https://assets.mixkit.co/videos/6605/6605-720.mp4', 'https://assets.mixkit.co/videos/6605/6605-360.mp4' ], 'poster' => 'implant3', 'title' => 'Công nghệ hiện đại, kết quả bền lâu', 'text' => 'Máy móc chuẩn quốc tế, vật liệu chính hãng, bảo hành rõ ràng.', 'btn' => 'Xem bảng giá', 'link' => pw_page_url( 'bang-gia' ) ],
];
$vids = [];
foreach ( [ 1, 2 ] as $v ) {
	$own = wp_get_attachment_url( (int) get_theme_mod( "pw_hero_vid_$v" ) ) ?: get_theme_mod( "pw_hero_vidurl_$v" );
	if ( ! $own && $slides ) continue; // đã tự cài banner ảnh riêng → chỉ hiện video khi bạn tự thêm
	$d = $vid_def[ $v ];
	$vids[] = [ 'src' => $own ? [ $own ] : $d['src'], 'poster' => $d['poster'],
		'title' => get_theme_mod( "pw_hero_vidt_$v" ) ?: $d['title'], 'text' => $d['text'],
		'btn' => get_theme_mod( "pw_hero_vidb_$v" ) ?: $d['btn'], 'link' => get_theme_mod( "pw_hero_vidl_$v" ) ?: $d['link'] ];
}
?>
<section class="hero" data-hero aria-roledescription="carousel" aria-label="Banner">
	<div class="hero-track">
		<?php ob_start(); $pw_si = []; if ( $slides ) : foreach ( $slides as $s ) : ob_start(); ?>
			<div class="hero-slide">
				<?php $im = wp_get_attachment_image( $s['img'], 'full', false, [ 'loading' => 'eager' ] );
				echo $s['link'] ? '<a href="' . esc_url( $s['link'] ) . '">' . $im . '</a>' : $im; ?>
			</div>
		<?php $pw_si[] = ob_get_clean(); endforeach; else :
			$demo = [
				[ 'chair',    'Nụ cười khoẻ đẹp – tự tin mỗi ngày', 'Thăm khám, chỉnh nha, trồng răng Implant cùng đội ngũ bác sĩ giàu kinh nghiệm tại ' . $site . '.', 'Đặt lịch ngay', '#dat-lich' ],
				[ 'aligner',  'Niềng răng trong suốt Invisalign', 'Giảm tới 35% – trả góp 0% lãi suất. Kế hoạch điều trị cá nhân hoá.', 'Xem ưu đãi', pw_page_url( 'uu-dai' ) ],
				[ 'implant3', 'Trồng răng Implant chuẩn quốc tế', 'Trụ Implant chính hãng, bảo hành dài hạn, quy trình vô trùng một chiều.', 'Tư vấn miễn phí', '#dat-lich' ],
				[ 'veneer',   'Răng sứ thẩm mỹ & Veneer', 'Thiết kế nụ cười theo khuôn mặt, màu răng tự nhiên, bền đẹp lâu dài.', 'Xem bảng giá', '#bang-gia' ],
			];
			foreach ( $demo as $k => $d ) : ob_start(); ?>
			<div class="hero-slide demo">
				<img class="bg" src="<?php echo esc_url( pw_stock( $d[0], 1920 ) ); ?>" alt="<?php echo esc_attr( $d[1] ); ?>" loading="<?php echo $k ? 'lazy' : 'eager'; ?>" decoding="async" referrerpolicy="no-referrer">
				<div class="in"><span class="kicker"><?php echo esc_html( $site ); ?></span><h2><?php echo esc_html( $d[1] ); ?></h2><p><?php echo esc_html( $d[2] ); ?></p><a class="btn btn-hero" href="<?php echo esc_url( $d[4] ); ?>"><?php echo esc_html( $d[3] ); ?></a></div>
			</div>
			<?php $pw_si[] = ob_get_clean(); endforeach; ?>
		<?php endif; ob_end_clean(); $pw_sv = [];
		foreach ( $vids as $vd ) : ob_start(); ?>
			<div class="hero-slide demo vid">
				<video class="bg" muted loop playsinline preload="none" poster="<?php echo esc_url( pw_stock( $vd['poster'], 1600 ) ); ?>" aria-hidden="true">
					<?php foreach ( $vd['src'] as $src ) echo '<source src="' . esc_url( $src ) . '" type="video/mp4">'; ?>
				</video>
				<div class="in"><span class="kicker"><?php echo esc_html( $site ); ?></span><h2><?php echo esc_html( $vd['title'] ); ?></h2><p><?php echo esc_html( $vd['text'] ); ?></p><a class="btn btn-hero" href="<?php echo esc_url( $vd['link'] ); ?>"><?php echo esc_html( $vd['btn'] ); ?></a></div>
				<span class="vid-badge"><?php echo pw_icon( 'play' ); ?> Video</span>
			</div>
		<?php $pw_sv[] = ob_get_clean(); endforeach;
		/* Xếp xen kẽ: 2 ảnh → 1 video → 2 ảnh → 1 video */
		$vi = 0;
		foreach ( $pw_si as $k => $h ) {
			echo $h;
			if ( ( $k + 1 ) % 2 === 0 && isset( $pw_sv[ $vi ] ) ) echo $pw_sv[ $vi++ ];
		}
		while ( isset( $pw_sv[ $vi ] ) ) echo $pw_sv[ $vi++ ]; ?>
	</div>
	<button class="hero-arrow prev" type="button" aria-label="Trước"><?php echo pw_icon( 'left' ); ?></button>
	<button class="hero-arrow next" type="button" aria-label="Sau"><?php echo pw_icon( 'right' ); ?></button>
	<div class="hero-dots"></div>
</section>

<!-- ============ Icon nhanh ============ -->
<section class="quick" aria-label="Lối tắt">
	<div class="wrap"><ul>
		<?php foreach ( [
			[ 'gift', 'Ưu đãi mới nhất', pw_page_url( 'uu-dai' ) ],
			[ 'tag', 'Giá tốt cho bạn', '#bang-gia' ],
			[ 'calendar', 'Đặt lịch hẹn', pw_opt( 'pw_booking_url' ) ],
			[ 'tooth', 'Niềng răng', pw_term_url( 'Niềng răng' ) ],
			[ 'star', 'Lý do chọn', '#ly-do' ],
			[ 'users', 'Tìm bác sỹ', '#bac-si' ],
			[ 'book', 'Kiến thức', pw_cat_url( 'kien-thuc-nha-khoa' ) ],
		] as $q ) : ?>
			<li><a href="<?php echo esc_url( $q[2] ); ?>"><span class="bub"><?php echo pw_icon( $q[0] ); ?></span><?php echo esc_html( $q[1] ); ?></a></li>
		<?php endforeach; ?>
	</ul></div>
</section>

<!-- ============ 1. Lý do chọn (ảnh ghép) – đặt TRƯỚC "Chăm sóc toàn diện" ============ -->
<section class="section reasons" id="ly-do">
	<div class="wrap">
		<div class="rs-grid" data-spot data-reveal-group>
			<h2 class="rs-title" data-reveal style="--i:0"><?php echo esc_html( pw_opt( 'pw_reasons_title' ) ); ?> <b><?php echo esc_html( $site ); ?></b></h2>
			<?php $n = 0; foreach ( preg_split( '/\r\n|\r|\n/', pw_opt( 'pw_reasons_items' ) ) as $line ) :
				if ( trim( $line ) === '' || $n >= 6 ) continue; $n++; $p = array_map( 'trim', explode( '|', $line, 2 ) ); ?>
				<figure class="rs-i rs-<?php echo $n; ?>" data-reveal style="--i:<?php echo $n; ?>">
					<?php if ( ! empty( $p[0] ) ) echo '<img loading="lazy" decoding="async" referrerpolicy="no-referrer" src="' . esc_url( $p[0] ) . '" alt="' . esc_attr( $p[1] ?? '' ) . '">'; else echo '<span class="ph">' . pw_icon( 'tooth' ) . '</span>'; ?>
					<?php if ( ! empty( $p[1] ) ) echo '<figcaption>' . esc_html( $p[1] ) . '</figcaption>'; ?>
				</figure>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
/* ============ Dữ liệu dịch vụ ============ */
$grid_items = [];
$q = new WP_Query( [ 'post_type' => 'dich_vu', 'posts_per_page' => 10, 'meta_key' => 'show_grid', 'meta_value' => '1', 'orderby' => 'menu_order date', 'order' => 'ASC', 'no_found_rows' => true ] );
while ( $q->have_posts() ) { $q->the_post();
	$grid_items[] = [ 'title' => get_the_title(), 'url' => pw_group_url( get_the_title(), get_permalink() ), 'img' => pw_service_img( get_the_ID(), 'pw-card', 600 ) ];
}
wp_reset_postdata();
if ( ! $grid_items ) {
	foreach ( [ 'Niềng răng trong suốt Invisalign', 'Niềng răng mắc cài tiết kiệm', 'Nha khoa trẻ em', 'Trồng răng Implant', 'Lấy cao răng', 'Niềng răng trong suốt cho Teen', 'Niềng răng mắc cài', 'Nhổ răng khôn', 'Răng sứ thẩm mỹ & veneer', 'Trám răng' ] as $t ) {
		$grid_items[] = [ 'title' => $t, 'url' => pw_group_url( $t, $svc_url ), 'img' => pw_stock_img( pw_stock_for( $t ), $t, 600 ) ];
	}
}
$pop_items = [];
$q = new WP_Query( [ 'post_type' => 'dich_vu', 'posts_per_page' => 4, 'meta_key' => 'is_popular', 'meta_value' => '1', 'orderby' => 'menu_order date', 'order' => 'ASC', 'no_found_rows' => true ] );
while ( $q->have_posts() ) { $q->the_post();
	$pop_items[] = [ 'title' => get_the_title(), 'url' => get_permalink(), 'img' => pw_service_img( get_the_ID(), 'large', 800 ), 'ex' => get_the_excerpt(),
		'perks' => array_filter( array_map( 'trim', explode( '|', (string) get_post_meta( get_the_ID(), 'perks', true ) ) ) ),
		'old' => get_post_meta( get_the_ID(), 'price_old', true ), 'new' => get_post_meta( get_the_ID(), 'price_new', true ), 'grp' => get_post_meta( get_the_ID(), 'group_label', true ) ];
}
wp_reset_postdata();
if ( ! $pop_items ) {
	foreach ( array_slice( pw_demo_services(), 0, 4 ) as $r ) $pop_items[] = [ 'title' => $r[0], 'url' => $svc_url, 'img' => pw_stock_img( $r[4], $r[0], 800 ), 'ex' => '', 'perks' => [], 'old' => $r[2], 'new' => $r[3], 'grp' => $r[1] ];
}
?>

<!-- ============ 2. Chăm sóc sức khoẻ răng miệng toàn diện ============ -->
<section class="section" id="dich-vu">
	<div class="wrap">
		<h2 class="section-title">Chăm sóc sức khoẻ răng miệng toàn diện</h2>
		<div class="grid5" style="margin-top:28px">
			<?php foreach ( $grid_items as $it ) : ?>
				<a class="svc" href="<?php echo esc_url( $it['url'] ); ?>"><span class="im"><?php echo $it['img'] ?: $ph; ?></span><span class="t"><?php echo esc_html( $it['title'] ); ?></span></a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ============ 3. Dịch vụ đang được yêu thích (bento – mỗi thẻ một kiểu trình bày) ============ -->
<section class="section fav-sec" id="uu-dai" style="padding-top:8px">
	<div class="wrap">
		<span class="eyebrow">Được chọn nhiều nhất</span>
		<h2 class="section-title">Dịch vụ đang được yêu thích</h2>
		<?php $accs = [ '#ff6a00', '#0f9d8a', '#2f5bd6', '#c9971c' ]; $bento = count( $pop_items ) === 4; ?>
		<div class="fav <?php echo $bento ? 'fav--bento' : 'fav--plain'; ?>">
			<?php foreach ( $pop_items as $k => $it ) : $d = pw_discount_any( $it['old'], $it['new'] ); ?>
				<article class="fav-i fav-<?php echo $k + 1; ?>" style="--acc:<?php echo $accs[ $k % 4 ]; ?>" data-reveal>
					<a class="im" href="<?php echo esc_url( $it['url'] ); ?>" tabindex="-1" aria-hidden="true"><?php echo $it['img']; ?></a>
					<?php if ( $d ) echo '<span class="fav-off">-' . (int) $d . '%</span>'; ?>
					<div class="bd">
						<?php if ( $k === 0 ) echo '<span class="fav-rib">' . pw_icon( 'star' ) . ' Bán chạy nhất</span>'; elseif ( $it['grp'] ) echo '<span class="tag">' . esc_html( $it['grp'] ) . '</span>'; ?>
						<h3><a href="<?php echo esc_url( $it['url'] ); ?>"><?php echo esc_html( $it['title'] ); ?></a></h3>
						<?php if ( $it['ex'] && $k < 2 ) echo '<p class="ex">' . esc_html( wp_trim_words( $it['ex'], 24, '…' ) ) . '</p>'; ?>
						<?php if ( $it['perks'] ) { echo '<ul class="perks">'; foreach ( array_slice( $it['perks'], 0, 3 ) as $pk ) echo '<li>' . pw_icon( 'check' ) . esc_html( $pk ) . '</li>'; echo '</ul>'; } ?>
						<div class="foot">
							<div class="price"><?php if ( $it['old'] ) echo '<del>' . esc_html( pw_money( $it['old'] ) ) . '</del>'; if ( $it['new'] ) echo '<b>' . esc_html( pw_money( $it['new'] ) ) . '</b>'; ?></div>
							<a class="btn fav-btn" href="<?php echo esc_url( $it['url'] ); ?>">Xem chi tiết <?php echo pw_icon( 'right' ); ?></a>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ============ 4. Bảng giá răng sứ – ngay SAU "Dịch vụ yêu thích" ============ -->
<section class="section price-sec" id="bang-gia">
	<div class="wrap"><?php get_template_part( 'template-parts/price-table' ); ?></div>
</section>

<!-- ============ 5. Cúp / chứng nhận Red Diamond (layout mới) ============ -->
<?php $dimg = (int) get_theme_mod( 'pw_diamond_img' ); ?>
<section class="honor" aria-label="Danh hiệu xuất sắc">
	<div class="wrap">
		<div class="honor-card">
			<div class="honor-trophy">
				<?php echo $dimg ? wp_get_attachment_image( $dimg, 'medium', false, [ 'loading' => 'lazy', 'alt' => 'Danh hiệu xuất sắc' ] ) : '<img src="' . esc_url( get_template_directory_uri() . '/assets/img/trophy.png' ) . '" alt="Cúp danh hiệu xuất sắc" width="362" height="353" loading="lazy">'; ?>
			</div>
			<p class="honor-text"><?php echo wp_kses_post( pw_opt( 'pw_diamond_text' ) ); ?></p>
		</div>
	</div>
</section>

<?php
/* ============ Dữ liệu bác sĩ ============ */
$doc_items = [];
$q = new WP_Query( [ 'post_type' => 'bac_si', 'posts_per_page' => 8, 'no_found_rows' => true, 'orderby' => 'menu_order date', 'order' => 'ASC' ] );
while ( $q->have_posts() ) { $q->the_post();
	$doc_items[] = [ 'name' => get_the_title(), 'url' => get_permalink(), 'role' => get_post_meta( get_the_ID(), 'role', true ) ?: 'Bác sĩ',
		'bul' => array_filter( array_map( 'trim', explode( "\n", (string) get_post_meta( get_the_ID(), 'bullets', true ) ) ) ),
		'img' => has_post_thumbnail() ? get_the_post_thumbnail( null, 'large' ) : pw_stock_img( [ 'doctor', 'doctor3', 'doctor2' ][ count( $doc_items ) % 3 ], get_the_title(), 700 ) ];
}
wp_reset_postdata();
if ( ! $doc_items ) {
	$doc_items = [
		[ 'name' => 'Phạm Thị Hà Xuyên', 'url' => $svc_url, 'role' => 'Bác sĩ', 'img' => pw_stock_img( 'doctor', 'Phạm Thị Hà Xuyên', 700 ), 'bul' => [ 'Bác sĩ điều trị chỉnh nha', 'Bác sĩ chuyên ngành Răng Hàm Mặt tại Đại học Y Hà Nội', 'Bác sĩ chuyên khoa 1 Đại học Y Dược TP. Hồ Chí Minh', 'Chứng chỉ các khoá đào tạo chỉnh nha chuyên sâu', 'Chứng chỉ chỉnh nha ứng dụng lâm sàng NOW 2022', 'Chứng chỉ chỉnh nha khoá MEAW 2019', 'Chứng chỉ khoá học Invisalign: Step up 2020' ] ],
		[ 'name' => 'Nguyễn Xuân Nhi', 'url' => $svc_url, 'role' => 'Bác sĩ', 'img' => pw_stock_img( 'doctor3', 'Nguyễn Xuân Nhi', 700 ), 'bul' => [ 'Giám đốc chuyên môn khu vực, phụ trách kiểm soát chất lượng và đào tạo đội ngũ bác sĩ', 'Thạc sĩ MSc, Cert Spec Orthodontist (Đức 2014)', 'Bác sĩ chuyên ngành Răng Hàm Mặt tại Đại học Y Dược TP.HCM', 'Hơn 15 năm làm việc tại các nha khoa quốc tế', 'Chuyên gia đào tạo tại Invisalign' ] ],
		[ 'name' => 'Bác sĩ mẫu thứ ba', 'url' => $svc_url, 'role' => 'Bác sĩ', 'img' => pw_stock_img( 'doctor2', 'Bác sĩ mẫu thứ ba', 700 ), 'bul' => [ 'Chuyên khoa Răng Hàm Mặt', 'Hơn 10 năm kinh nghiệm' ] ],
	];
}
?>
<!-- ============ 6. Gặp gỡ đội ngũ bác sĩ ============ -->
<section class="section docs" id="bac-si">
	<div class="wrap">
		<h2 class="section-title">Gặp gỡ đội ngũ bác sĩ răng hàm mặt giàu kinh nghiệm</h2>
		<p class="section-sub">Đội ngũ bác sĩ tâm đức chính trực, tận tâm với nghề và tận tụy với khách hàng.<br>Đội ngũ chuyên môn <?php echo esc_html( $site ); ?> đặc biệt đề cao việc tuân thủ quy trình hội chẩn chuyên môn, và lắng nghe khách hàng (bệnh nhân).</p>
		<div class="rail" data-rail>
			<button class="rail-btn prev" type="button" aria-label="Trước"><?php echo pw_icon( 'left' ); ?></button>
			<div class="rail-track">
				<?php foreach ( $doc_items as $d ) : ?>
					<article class="doc">
						<div class="tx">
							<small><?php echo esc_html( $d['role'] ); ?></small>
							<h3><?php echo esc_html( $d['name'] ); ?></h3>
							<?php if ( $d['bul'] ) { echo '<ul>'; foreach ( $d['bul'] as $b ) echo '<li>' . esc_html( $b ) . '</li>'; echo '</ul>'; } ?>
							<a class="btn btn-soft" href="<?php echo esc_url( $d['url'] ); ?>">Xem chi tiết</a>
						</div>
						<div class="pic"><?php echo $d['img'] ?: '<span class="ph">' . pw_icon( 'users' ) . '</span>'; ?></div>
					</article>
				<?php endforeach; ?>
			</div>
			<button class="rail-btn next" type="button" aria-label="Sau"><?php echo pw_icon( 'right' ); ?></button>
		</div>
		<div class="center"><a class="btn btn-line" href="<?php echo esc_url( get_post_type_archive_link( 'bac_si' ) ?: '#' ); ?>">Xem tất cả bác sĩ</a></div>
	</div>
</section>

<?php
/* ============ Dữ liệu người nổi tiếng ============ */
$cel = [];
$q = new WP_Query( [ 'post_type' => 'nguoi_noi_tieng', 'posts_per_page' => 12, 'no_found_rows' => true, 'orderby' => 'menu_order date', 'order' => 'ASC' ] );
while ( $q->have_posts() ) { $q->the_post();
	$cel[] = [ 'name' => get_the_title(), 'role' => get_post_meta( get_the_ID(), 'role', true ), 'desc' => has_excerpt() ? get_the_excerpt() : '',
		'big' => has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'large' ) : pw_stock( [ 'smile2', 'smile3', 'smile4', 'smile5', 'smile6', 'smile1' ][ count( $cel ) % 6 ], 900 ),
		'thumb' => has_post_thumbnail() ? get_the_post_thumbnail( null, 'medium', [ 'loading' => 'lazy' ] ) : pw_stock_img( [ 'smile2', 'smile3', 'smile4', 'smile5', 'smile6', 'smile1' ][ count( $cel ) % 6 ], get_the_title(), 300 ) ];
}
wp_reset_postdata();
if ( ! $cel ) {
	$ck = [ 'smile2', 'smile3', 'smile4', 'smile5', 'smile6', 'smile1' ];
	foreach ( [ [ 'Trinh Phạm', 'Beauty blogger' ], [ 'Trần Việt Bảo Hoàng', 'CEO' ], [ 'Salim', 'KOL' ], [ 'Lê Hà Trúc', 'KOL' ], [ 'Hứa Kim Tuyền', 'Nhạc sỹ' ], [ 'An Phương', 'Beauty blogger' ] ] as $i => $c ) {
		$cel[] = [ 'name' => $c[0], 'role' => $c[1], 'desc' => $c[0] . ' chia sẻ hành trình niềng răng và nụ cười tự tin sau điều trị tại ' . $site . '. (Thay bằng mô tả thật trong mục Người nổi tiếng.)', 'big' => pw_stock( $ck[ $i % 6 ], 900 ), 'thumb' => pw_stock_img( $ck[ $i % 6 ], $c[0], 300 ) ];
	}
}
?>
<!-- ============ 7. Người nổi tiếng (có mô tả) ============ -->
<section class="section" id="nguoi-noi-tieng">
	<div class="wrap">
		<h2 class="section-title"><?php echo esc_html( pw_opt( 'pw_celeb_title' ) ); ?> <?php echo esc_html( $site ); ?></h2>
		<p class="section-sub"><?php echo esc_html( pw_opt( 'pw_celeb_sub' ) ); ?></p>
		<div class="celeb" data-celeb>
			<?php $f = $cel[0]; ?>
			<div class="celeb-main">
				<div class="im">
					<img data-c-img src="<?php echo esc_url( $f['big'] ); ?>" alt="<?php echo esc_attr( $f['name'] ); ?>" <?php echo $f['big'] ? '' : 'hidden'; ?>>
					<span class="ph" data-c-ph <?php echo $f['big'] ? 'hidden' : ''; ?>><?php echo pw_icon( 'users' ); ?></span>
				</div>
				<div class="info"><small data-c-role><?php echo esc_html( $f['role'] ); ?></small><h3 data-c-name><?php echo esc_html( $f['name'] ); ?></h3><p data-c-desc><?php echo esc_html( $f['desc'] ); ?></p></div>
			</div>
			<div class="celeb-list">
				<?php foreach ( $cel as $k => $c ) : ?>
					<button type="button" class="<?php echo $k === 0 ? 'on' : ''; ?>" data-name="<?php echo esc_attr( $c['name'] ); ?>" data-role="<?php echo esc_attr( $c['role'] ); ?>" data-desc="<?php echo esc_attr( $c['desc'] ); ?>" data-img="<?php echo esc_url( $c['big'] ); ?>">
						<span class="im" style="display:block"><?php echo $c['thumb'] ?: '<span class="ph">' . pw_icon( 'users' ) . '</span>'; ?></span>
						<span class="cap"><small><?php echo esc_html( $c['role'] ); ?></small><b><?php echo esc_html( $c['name'] ); ?></b></span>
					</button>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<?php
/* ============ Dữ liệu trước/sau ============ */
$cases = [];
$q = new WP_Query( [ 'post_type' => 'truoc_sau', 'posts_per_page' => 8, 'orderby' => 'ID', 'order' => 'ASC', 'no_found_rows' => true ] );
while ( $q->have_posts() ) { $q->the_post();
	$cases[] = [ 'name' => get_the_title(), 'tr' => get_post_meta( get_the_ID(), 'treatment', true ), 'bt' => get_post_meta( get_the_ID(), 'before_txt', true ), 'at' => get_post_meta( get_the_ID(), 'after_txt', true ),
		'b' => get_post_meta( get_the_ID(), 'before_img', true ), 'a' => get_post_meta( get_the_ID(), 'after_img', true ), 'v' => (int) get_post_meta( get_the_ID(), 'ba_type', true ) ];
}
wp_reset_postdata();
if ( ! $cases ) {
	$cases = [
		[ 'name' => 'Hoàng Quỳnh Anh', 'tr' => 'Niềng răng mắc cài', 'bt' => 'Khớp cắn ngược, cắn chéo, răng khấp khểnh', 'at' => 'Sắp đều răng, khớp cắn chuẩn. Chức năng ăn nhai ổn định', 'b' => '', 'a' => '', 'v' => 0 ],
		[ 'name' => 'Chu Thị Bích Ngọc', 'tr' => 'Niềng răng trong suốt Invisalign', 'bt' => 'Răng thưa, hô và chìa', 'at' => 'Khắc phục hoàn toàn răng thưa, hô', 'b' => '', 'a' => '', 'v' => 1 ],
		[ 'name' => 'Nguyễn Hải Yến', 'tr' => 'Bọc răng sứ thẩm mỹ', 'bt' => 'Răng ố vàng, sâu và mẻ, nướu viêm', 'at' => 'Răng sứ trắng sáng, đều đẹp, nướu khoẻ', 'b' => '', 'a' => '', 'v' => 2 ],
	];
}
?>
<!-- ============ 8. Trước & sau (slider kéo) ============ -->
<section class="section docs">
	<div class="wrap">
		<h2 class="section-title">Hiệu quả trước và sau điều trị tại <?php echo esc_html( $site ); ?></h2>
		<div class="ba-wrap" data-ba-group style="margin-top:28px">
			<?php $tabs = ''; foreach ( $cases as $i => $c ) :
				$tabs .= '<button type="button" class="' . ( $i === 0 ? 'on' : '' ) . '" data-ba-tab="' . $i . '">' . esc_html( $c['name'] ) . '</button>'; ?>
				<div class="ba-item <?php echo $i === 0 ? 'on' : ''; ?>" data-ba-item="<?php echo $i; ?>">
					<div class="ba" data-ba>
						<div class="layer after"><?php echo $c['a'] ? '<img loading="lazy" referrerpolicy="no-referrer" src="' . esc_url( $c['a'] ) . '" alt="Sau điều trị">' : pw_teeth_svg( 'good', $c['v'] ); ?></div>
						<div class="layer before"><?php echo $c['b'] ? '<img loading="lazy" referrerpolicy="no-referrer" src="' . esc_url( $c['b'] ) . '" alt="Trước điều trị">' : pw_teeth_svg( 'bad', $c['v'] ); ?></div>
						<span class="lbl l">Trước điều trị</span><span class="lbl r">Sau điều trị</span>
						<div class="txt"><b><?php echo esc_html( $c['name'] . ( $c['tr'] ? ' – ' . $c['tr'] : '' ) ); ?></b>
							<?php if ( $c['bt'] ) echo '<div><strong>Trước:</strong> ' . esc_html( $c['bt'] ) . '</div>'; if ( $c['at'] ) echo '<div><strong>Sau:</strong> ' . esc_html( $c['at'] ) . '</div>'; ?></div>
						<div class="handle"><i><?php echo pw_icon( 'swap' ); ?></i></div>
						<input type="range" min="0" max="100" value="50" aria-label="Kéo để so sánh trước và sau">
					</div>
				</div>
			<?php endforeach; echo '<div class="ba-tabs">' . $tabs . '</div>'; ?>
		</div>
	</div>
</section>

<?php
/* ============ Dữ liệu bản tin ============
 * CHỈ lấy bài thuộc chuyên mục nha khoa (slug: kien-thuc-nha-khoa, tin-tuc-su-kien, nieng-rang…),
 * tránh hiện bài không liên quan (VD: bất động sản). Không có bài phù hợp → dùng 3 bài mẫu nha khoa. */
$news = [];
$news_cats = apply_filters( 'pw_news_categories', [ 'kien-thuc-nha-khoa', 'tin-tuc-su-kien', 'tin-tuc', 'nieng-rang', 'nha-khoa' ] );
$news_cats = array_values( array_filter( $news_cats, function ( $slug ) { return term_exists( $slug, 'category' ); } ) );
if ( $news_cats ) {
	$q = new WP_Query( [ 'post_type' => 'post', 'posts_per_page' => 3, 'ignore_sticky_posts' => true, 'no_found_rows' => true, 'tax_query' => [ [ 'taxonomy' => 'category', 'field' => 'slug', 'terms' => $news_cats ] ] ] );
	while ( $q->have_posts() ) { $q->the_post();
		$news[] = [ 'title' => get_the_title(), 'url' => get_permalink(), 'ex' => wp_trim_words( get_the_excerpt(), 22, '…' ), 'html' => pw_news_card() ];
	}
	wp_reset_postdata();
}
if ( count( $news ) < 3 ) {
	$kb = pw_cat_url( 'kien-thuc-nha-khoa' );
	$demo_news = [
		[ 'Niềng răng Invisalign: ai nên và không nên niềng?', 'Invisalign phù hợp với nhiều tình trạng lệch lạc, nhưng không dành cho mọi ca. Cùng tìm hiểu điều kiện, thời gian và chi phí…', 'aligner' ],
		[ 'Bọc răng sứ là gì? Các loại răng sứ phổ biến hiện nay', 'So sánh răng sứ kim loại, Zirconia và Cercon HT: độ bền, thẩm mỹ, bảo hành và cách chọn phù hợp với nhu cầu…', 'veneer' ],
		[ 'Trồng răng Implant: quy trình và chăm sóc sau cấy ghép', 'Các bước từ thăm khám, chụp phim CT, cấy trụ đến gắn răng sứ; lưu ý giúp Implant bền vững lâu dài…', 'implant' ],
	];
	foreach ( $demo_news as $i => $d ) {
		if ( count( $news ) >= 3 ) break;
		if ( $i < count( $news ) ) continue;
		$news[] = [ 'title' => $d[0], 'url' => $kb, 'ex' => $d[1], 'html' => '', 'img' => pw_stock_img( $d[2], $d[0], 720 ) ];
	}
}
?>
<?php $pq = new WP_Query( [ 'post_type' => 'post', 'posts_per_page' => 8, 'ignore_sticky_posts' => true, 'no_found_rows' => true, 'tax_query' => [ [ 'taxonomy' => 'category', 'field' => 'slug', 'terms' => 'bao-chi' ] ] ] );
if ( $pq->have_posts() ) : ?>
<!-- ============ 9a. Báo chí nói về chúng tôi ============ -->
<section class="section press">
	<div class="wrap">
		<h2 class="section-title">Báo chí nói về chúng tôi</h2>
		<div class="rail press-rail" data-rail style="margin-top:28px">
			<button class="rail-btn prev" type="button" aria-label="Trước"><?php echo pw_icon( 'left' ); ?></button>
			<div class="rail-track press-track"><?php while ( $pq->have_posts() ) { $pq->the_post(); echo pw_press_card(); } wp_reset_postdata(); ?></div>
			<button class="rail-btn next" type="button" aria-label="Sau"><?php echo pw_icon( 'right' ); ?></button>
		</div>
		<p class="center"><a class="btn btn-soft" href="<?php echo esc_url( pw_cat_url( 'bao-chi' ) ); ?>">Xem tất cả bài báo</a></p>
	</div>
</section>
<?php endif; ?>

<!-- ============ 9. Bản tin ============ -->
<section class="section news">
	<div class="wrap">
		<h2 class="section-title">BẢN TIN</h2>
		<div class="hub-tabs" style="margin-top:14px">
			<a href="<?php echo esc_url( pw_cat_url( 'kien-thuc-nha-khoa' ) ); ?>">Kiến thức nha khoa</a>
			<a href="<?php echo esc_url( pw_cat_url( 'tin-tuc-su-kien' ) ); ?>">Tin tức sự kiện</a>
		</div>
		<div class="news-grid" style="margin-top:28px">
			<?php foreach ( $news as $n ) echo $n['html'] ?: '<article class="ncard"><a class="im" href="' . esc_url( $n['url'] ) . '">' . $n['img'] . '</a><div class="bd"><h3><a href="' . esc_url( $n['url'] ) . '">' . esc_html( $n['title'] ) . '</a></h3><p>' . esc_html( $n['ex'] ) . '</p></div></article>'; ?>
		</div>
		<p class="center"><a class="btn btn-soft" href="<?php echo esc_url( pw_cat_url( 'kien-thuc-nha-khoa' ) ); ?>">Xem tất cả bản tin</a></p>
	</div>
</section>

<!-- ============ 10. Form đặt lịch ============ -->
<section class="booking" id="dat-lich">
	<div class="wrap">
		<div class="book-card">
			<h2>Để lại số điện thoại để được nhận cuộc gọi tư vấn miễn phí</h2>
			<?php get_template_part( 'template-parts/booking-form', null, [ 'id' => 'h' ] ); ?>
		</div>
	</div>
</section>

<?php get_footer();
