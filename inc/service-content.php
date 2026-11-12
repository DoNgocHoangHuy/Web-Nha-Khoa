<?php
/**
 * Dựng nội dung chi tiết cho dịch vụ / nhóm dịch vụ từ dữ liệu có cấu trúc.
 * Kết quả là HTML 1 dòng, bắt đầu bằng <!--pw-seed--> (theme sẽ không chạy wpautop lên nội dung này)
 * và dùng {site}, {hotline}… (được thay khi hiển thị, đổi tên web là nội dung tự đổi theo).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pw_fig( $key, $cap ) {
	$u = pw_stock( $key, 1000 );
	if ( ! $u ) return '';
	return '<figure class="sv-fig"><img src="' . esc_url( $u ) . '" alt="' . esc_attr( $cap ) . '" loading="lazy" decoding="async" referrerpolicy="no-referrer"><figcaption>' . esc_html( $cap ) . '</figcaption></figure>';
}

/**
 * $s: lead, intro[], facts[[nhãn,giá trị]], what_h, what[], pros_h, pros[[tiêu đề,nội dung]],
 *     who_h, who[], inc_h, inc[], cmp_h, cmp[ 'head'=>[], 'rows'=>[[]] ], steps_h, steps[[tiêu đề,nội dung]],
 *     care_h, care[], tip, faq[[hỏi,đáp]], figs[[khoá ảnh, chú thích]], cta
 */
function pw_build_content( array $s ) {
	$o = '<!--pw-seed-->';
	$n = 0;
	$h2 = function ( $t ) use ( &$n ) { $n++; return '<h2>' . $n . '. ' . esc_html( $t ) . '</h2>'; };
	$figs = $s['figs'] ?? [];

	if ( ! empty( $s['lead'] ) ) $o .= '<h2 class="sv-lead">' . esc_html( $s['lead'] ) . '</h2>';
	foreach ( $s['intro'] ?? [] as $p ) $o .= '<p>' . $p . '</p>';

	if ( ! empty( $s['quote'] ) ) $o .= '<blockquote class="sv-quote"><p>' . $s['quote'][0] . '</p><cite>' . esc_html( $s['quote'][1] ) . '</cite></blockquote>';

	if ( ! empty( $s['facts'] ) ) {
		$o .= '<div class="sv-facts">';
		foreach ( $s['facts'] as $f ) $o .= '<div><small>' . esc_html( $f[0] ) . '</small><b>' . esc_html( $f[1] ) . '</b></div>';
		$o .= '</div>';
	}

	if ( ! empty( $s['what_h'] ) ) {
		$o .= $h2( $s['what_h'] );
		foreach ( $s['what'] ?? [] as $p ) $o .= '<p>' . $p . '</p>';
		if ( ! empty( $figs[0] ) ) $o .= pw_fig( $figs[0][0], $figs[0][1] );
	}

	if ( ! empty( $s['pros'] ) ) {
		$o .= $h2( $s['pros_h'] ?? 'Ưu điểm nổi bật' ) . '<div class="sv-pros">';
		foreach ( $s['pros'] as $p ) $o .= '<div><h3>' . esc_html( $p[0] ) . '</h3><p>' . $p[1] . '</p></div>';
		$o .= '</div>';
	}
	if ( ! empty( $s['after_pros'] ) && is_callable( $s['after_pros'] ) ) $o .= call_user_func( $s['after_pros'], $h2 );

	if ( ! empty( $s['who'] ) ) {
		$o .= $h2( $s['who_h'] ?? 'Ai phù hợp với dịch vụ này?' ) . '<ul class="sv-check">';
		foreach ( $s['who'] as $li ) $o .= '<li>' . $li . '</li>';
		$o .= '</ul>';
	}

	if ( ! empty( $s['inc'] ) ) {
		$o .= $h2( $s['inc_h'] ?? 'Dịch vụ bao gồm những gì?' ) . '<ul class="sv-check">';
		foreach ( $s['inc'] as $li ) $o .= '<li>' . $li . '</li>';
		$o .= '</ul>';
	}

	if ( ! empty( $s['cmp'] ) ) {
		$o .= $h2( $s['cmp_h'] ?? 'Bảng so sánh' ) . '<div class="sv-table"><table><thead><tr>';
		foreach ( $s['cmp']['head'] as $th ) $o .= '<th>' . esc_html( $th ) . '</th>';
		$o .= '</tr></thead><tbody>';
		foreach ( $s['cmp']['rows'] as $r ) {
			$o .= '<tr>';
			foreach ( $r as $i => $td ) $o .= $i === 0 ? '<th scope="row">' . esc_html( $td ) . '</th>' : '<td>' . $td . '</td>';
			$o .= '</tr>';
		}
		$o .= '</tbody></table></div>';
	}

	if ( ! empty( $s['steps'] ) ) {
		$o .= $h2( $s['steps_h'] ?? 'Quy trình thực hiện tại {site}' ) . '<ol class="sv-steps">';
		foreach ( $s['steps'] as $st ) $o .= '<li><b>' . esc_html( $st[0] ) . '</b><span>' . $st[1] . '</span></li>';
		$o .= '</ol>';
		if ( ! empty( $figs[1] ) ) $o .= pw_fig( $figs[1][0], $figs[1][1] );
	}

	if ( ! empty( $s['care'] ) ) {
		$o .= $h2( $s['care_h'] ?? 'Lưu ý và chăm sóc sau điều trị' ) . '<ul class="sv-check">';
		foreach ( $s['care'] as $li ) $o .= '<li>' . $li . '</li>';
		$o .= '</ul>';
	}

	if ( ! empty( $s['tip'] ) ) $o .= '<p class="sv-tip">' . $s['tip'] . '</p>';

	if ( ! empty( $s['faq'] ) ) {
		$o .= '<h2>Câu hỏi thường gặp</h2><div class="sv-faq">';
		foreach ( $s['faq'] as $i => $f ) $o .= '<details' . ( $i === 0 ? ' open' : '' ) . '><summary>' . esc_html( $f[0] ) . '</summary><p>' . $f[1] . '</p></details>';
		$o .= '</div>';
	}

	$cta = $s['cta'] ?? 'Để lại số điện thoại ở form cuối trang hoặc gọi <a href="tel:{tel}">{hotline}</a>. Bác sĩ {site} sẽ khám, tư vấn phương án phù hợp và báo giá rõ ràng ngay buổi hẹn đầu tiên.';
	$o .= '<p class="sv-cta"><strong>ĐẶT LỊCH TƯ VẤN MIỄN PHÍ.</strong> ' . $cta . '</p>';
	return $o;
}
