<?php
/** Nội dung chi tiết cho trang Giới thiệu và Tuyển dụng (dựng bằng pw_build_content). */
if ( ! defined( 'ABSPATH' ) ) exit;

function pw_page_about() {
	return pw_build_content( [
		'lead' => '{site} – nha khoa đặt sự an tâm của khách hàng lên hàng đầu.',
		'intro' => [
			'Chúng tôi tin rằng một nụ cười khoẻ đẹp bắt đầu từ sự thấu hiểu. Tại {site}, mỗi khách hàng được thăm khám kỹ, tư vấn minh bạch và điều trị theo kế hoạch rõ ràng, không phát sinh chi phí ngoài thoả thuận.',
			'{site} ra đời với mong muốn mang đến dịch vụ nha khoa chuẩn quốc tế nhưng gần gũi: bác sĩ giỏi chuyên môn, vật liệu chính hãng, quy trình vô trùng một chiều và mức giá được công khai trước khi điều trị. Từ một lần khám răng đơn giản đến niềng răng Invisalign hay cấy ghép Implant, mọi bước đều được giải thích dễ hiểu để bạn chủ động quyết định.',
			'Bạn có thể <a href="{home}/bac-si/">gặp đội ngũ bác sĩ</a>, xem <a href="{home}/bang-gia/">bảng giá dịch vụ</a> hoặc <a href="{home}/dich-vu/">toàn bộ dịch vụ</a> của chúng tôi ngay bên dưới.',
		],
		'facts' => [ [ 'Hotline', '{hotline}' ], [ 'Giờ làm việc', '{hours}' ], [ 'Bảo hành', 'Đến 15 năm theo dịch vụ' ], [ 'Thanh toán', 'Trả góp 0% lãi suất' ] ],
		'what_h' => 'Sứ mệnh, tầm nhìn và giá trị cốt lõi',
		'what' => [
			'<strong>Sứ mệnh.</strong> Giúp mọi người sở hữu hàm răng khoẻ và nụ cười tự tin thông qua dịch vụ nha khoa an toàn, minh bạch và hiệu quả lâu dài.',
			'<strong>Tầm nhìn.</strong> Trở thành hệ thống nha khoa được khách hàng tin cậy nhờ chất lượng điều trị ổn định, đội ngũ tận tâm và trải nghiệm không còn nỗi sợ nha sĩ.',
			'<strong>Giá trị cốt lõi.</strong> Tận tâm – Trung thực – Chuyên nghiệp – Đổi mới. Chúng tôi chỉ đề xuất điều trị thật sự cần thiết và luôn cho khách hàng biết rõ các lựa chọn, ưu nhược điểm và chi phí đi kèm.',
		],
		'figs' => [ [ 'lobby', 'Không gian đón tiếp tại {site}' ], [ 'chair', 'Phòng điều trị sạch sẽ, riêng tư' ] ],
		'pros_h' => 'Điểm khác biệt của {site}',
		'pros' => [
			[ 'Bác sĩ giàu kinh nghiệm', 'Đội ngũ bác sĩ Răng Hàm Mặt được đào tạo bài bản, thường xuyên cập nhật kỹ thuật và công nghệ mới.' ],
			[ 'Công nghệ hiện đại', 'Scan 3D trong miệng, phim CT Cone Beam, phần mềm mô phỏng kế hoạch niềng răng và cấy ghép.' ],
			[ 'Vật liệu chính hãng', 'Trụ Implant, khay niềng, răng sứ có nguồn gốc và tem truy xuất rõ ràng.' ],
			[ 'Minh bạch chi phí', 'Báo giá trước điều trị, hợp đồng rõ ràng, hỗ trợ trả góp 0% lãi suất.' ],
			[ 'Vô trùng một chiều', 'Dụng cụ tiệt trùng riêng cho từng khách, khui trước mặt khách hàng.' ],
			[ 'Chăm sóc sau điều trị', 'Hỗ trợ qua hotline, nhắc lịch tái khám và bảo hành theo phiếu.' ],
		],
		'who_h' => 'Dịch vụ tại {site}',
		'who' => [
			'<strong><a href="{home}/dich-vu/">Trồng răng Implant</a></strong> – trụ chính hãng, quy trình chuẩn, bảo hành rõ ràng.',
			'<strong>Niềng răng</strong> – mắc cài kim loại, sứ, tự đóng và khay trong suốt Invisalign.',
			'<strong>Nha khoa tổng quát</strong> – khám, lấy cao răng, trám răng, nhổ răng khôn.',
			'<strong>Nha khoa thẩm mỹ</strong> – bọc răng sứ, dán veneer, tẩy trắng răng.',
			'<strong>Nha khoa trẻ em</strong> – khám, trám răng sữa, bôi Fluor phòng ngừa.',
		],
		'inc_h' => 'Công nghệ và trang thiết bị',
		'inc' => [
			'Máy scan trong miệng 3D thay thế lấy dấu bằng khay thạch cao.',
			'Phim X-quang kỹ thuật số và CT Cone Beam, liều tia thấp, cho hình ảnh rõ.',
			'Ghế nha khoa đời mới, kính hiển vi hỗ trợ điều trị tuỷ chính xác.',
			'Máy lấy cao răng siêu âm, đèn quang trùng hợp, máy tiệt trùng áp suất cao.',
			'Phần mềm mô phỏng nụ cười và kế hoạch điều trị để khách xem trước kết quả.',
		],
		'cmp_h' => 'Cam kết dịch vụ của {site}',
		'cmp' => [ 'head' => [ 'Hạng mục', 'Cam kết' ], 'rows' => [
			[ 'Tư vấn', 'Trung thực, chỉ đề xuất điều trị thật sự cần thiết' ],
			[ 'Chi phí', 'Báo giá trước điều trị, không phát sinh ngoài thoả thuận' ],
			[ 'Vật liệu', 'Chính hãng, có phiếu bảo hành và truy xuất nguồn gốc' ],
			[ 'Vô trùng', 'Quy trình một chiều, dụng cụ riêng cho từng khách' ],
			[ 'Sau điều trị', 'Hỗ trợ qua hotline, nhắc lịch tái khám định kỳ' ],
		] ],
		'steps_h' => 'Hành trình của bạn tại {site}',
		'steps' => [
			[ 'Đặt lịch hẹn', 'Gọi hotline hoặc để lại số điện thoại trên website, nhân viên sẽ liên hệ xác nhận.' ],
			[ 'Thăm khám và chụp phim', 'Bác sĩ khám tổng quát, chụp phim cần thiết để đánh giá chính xác tình trạng răng.' ],
			[ 'Tư vấn và báo giá', 'Trình bày các phương án, ưu nhược điểm và chi phí bằng văn bản.' ],
			[ 'Điều trị', 'Thực hiện theo kế hoạch đã thống nhất, giải thích từng bước.' ],
			[ 'Tái khám và bảo hành', 'Theo dõi định kỳ, hỗ trợ khi có vấn đề phát sinh.' ],
		],
		'care_h' => 'Tiêu chuẩn vô trùng và an toàn',
		'care' => [
			'Nhân viên đeo găng, khẩu trang, kính chắn và thay mới cho mỗi khách.',
			'Dụng cụ được rửa siêu âm, đóng gói, hấp tiệt trùng và khui trước mặt khách.',
			'Ghế và bề mặt tiếp xúc được khử khuẩn sau mỗi lượt khám.',
			'Kim tiêm, ống hút nước bọt và vật tư dùng một lần được huỷ theo quy định.',
		],
		'tip' => '<strong>Lần đầu đến {site}?</strong> Hãy mang theo phim X-quang hoặc hồ sơ điều trị cũ (nếu có) để bác sĩ tư vấn chính xác hơn.',
		'faq' => [
			[ 'Tôi có cần đặt lịch trước không?', 'Nên đặt lịch để được bố trí bác sĩ và khung giờ phù hợp, giảm thời gian chờ. Khách đến trực tiếp vẫn được tiếp nhận tuỳ tình hình thực tế.' ],
			[ 'Phòng khám có hỗ trợ trả góp không?', 'Có. {site} hỗ trợ trả góp 0% lãi suất cho các dịch vụ phù hợp qua thẻ tín dụng. Nhân viên sẽ hướng dẫn chi tiết khi tư vấn.' ],
			[ 'Chi phí có thể phát sinh không?', 'Chi phí được báo trước khi điều trị. Nếu cần thêm hạng mục ngoài kế hoạch, bác sĩ sẽ giải thích và chỉ thực hiện khi bạn đồng ý.' ],
			[ 'Tôi sợ đau thì sao?', 'Bác sĩ sử dụng gây tê và thao tác nhẹ nhàng; bạn có thể báo bất cứ lúc nào để dừng và nghỉ giữa chừng.' ],
		],
		'cta' => 'Địa chỉ: {address}. Giờ làm việc: {hours}. Gọi <a href="tel:{tel}">{hotline}</a> hoặc để lại số điện thoại ở form bên dưới để được tư vấn.',
	] );
}

function pw_page_jobs() {
	$job = function ( $title, $tags, $desc, $req, $open = false ) {
		$li = function ( $a ) { $o = '<ul>'; foreach ( $a as $x ) $o .= '<li>' . $x . '</li>'; return $o . '</ul>'; };
		$sub = rawurlencode( 'Ứng tuyển: ' . $title );
		return '<details class="sv-job"' . ( $open ? ' open' : '' ) . '><summary><span class="t">' . esc_html( $title ) . '</span><span class="tags">' . esc_html( $tags ) . '</span></summary>'
			. '<div class="cols"><div><h4>Mô tả công việc</h4>' . $li( $desc ) . '</div><div><h4>Yêu cầu</h4>' . $li( $req ) . '</div></div>'
			. '<a class="btn btn-cta" href="mailto:{email}?subject=' . $sub . '">Ứng tuyển ngay</a></details>';
	};
	return pw_build_content( [
		'lead' => 'Cùng {site} chăm sóc nụ cười cho cộng đồng.',
		'intro' => [
			'{site} luôn chào đón những đồng nghiệp tận tâm, cầu tiến và yêu nghề. Chúng tôi tin rằng đội ngũ hạnh phúc sẽ mang lại trải nghiệm tốt nhất cho khách hàng, vì vậy {site} đầu tư vào môi trường làm việc, đào tạo và lộ trình phát triển rõ ràng cho từng vị trí.',
			'Dù bạn là bác sĩ nhiều kinh nghiệm hay sinh viên mới ra trường, nếu bạn thích học hỏi và muốn làm việc trong môi trường chuyên nghiệp, hãy gửi hồ sơ cho chúng tôi.',
		],
		'facts' => [ [ 'Vị trí đang tuyển', '6 vị trí' ], [ 'Địa điểm', 'TP. Hồ Chí Minh' ], [ 'Hình thức', 'Toàn thời gian' ], [ 'Nhận hồ sơ', 'Quanh năm' ] ],
		'what_h' => 'Vì sao nên làm việc tại {site}?',
		'what' => [
			'Tại {site}, mỗi nhân viên đều được lắng nghe và có cơ hội phát triển. Bác sĩ được hỗ trợ trang thiết bị hiện đại và tham gia các khoá đào tạo chuyên sâu; nhân viên hỗ trợ được hướng dẫn kỹ năng nghề từ ngày đầu.',
			'Chúng tôi đề cao tinh thần làm việc nhóm, tôn trọng chuyên môn và đánh giá năng lực bằng kết quả công việc, không phải thời gian gắn bó.',
		],
		'figs' => [ [ 'office2', 'Môi trường làm việc thân thiện tại {site}' ] ],
		'pros_h' => 'Quyền lợi và văn hoá',
		'pros' => [
			[ 'Thu nhập cạnh tranh', 'Lương cơ bản thoả thuận theo năng lực, thưởng theo hiệu quả và doanh thu.' ],
			[ 'Đào tạo liên tục', 'Được hỗ trợ tham gia khoá học, hội thảo chuyên môn trong và ngoài nước.' ],
			[ 'Lộ trình thăng tiến', 'Lộ trình rõ ràng từ nhân viên đến quản lý, trưởng nhóm chuyên môn.' ],
			[ 'Bảo hiểm đầy đủ', 'BHXH, BHYT, BHTN theo quy định và chế độ chăm sóc sức khoẻ định kỳ.' ],
			[ 'Ưu đãi nội bộ', 'Ưu đãi dịch vụ nha khoa cho nhân viên và người thân.' ],
			[ 'Môi trường thân thiện', 'Đồng nghiệp hỗ trợ nhau, tổ chức team building, sinh nhật, du lịch hằng năm.' ],
		],
		'after_pros' => function ( $h2 ) use ( $job ) {
			return $h2( 'Vị trí đang tuyển' ) . '<div class="sv-jobs">'
				. $job( 'Bác sĩ Răng Hàm Mặt', 'Toàn thời gian · TP. Hồ Chí Minh · Thoả thuận', [ 'Thăm khám, chẩn đoán và điều trị các bệnh lý răng miệng theo phân công.', 'Tư vấn kế hoạch điều trị, giải thích rõ phương án và chi phí cho khách hàng.', 'Thực hiện các thủ thuật nha khoa tổng quát: trám, lấy cao răng, nhổ răng, điều trị tuỷ.', 'Tuân thủ quy trình kiểm soát nhiễm khuẩn và hồ sơ bệnh án.' ], [ 'Tốt nghiệp Răng Hàm Mặt, có chứng chỉ hành nghề còn hiệu lực.', 'Ưu tiên có kinh nghiệm từ 1 năm; sẵn sàng đào tạo bác sĩ mới ra trường.', 'Giao tiếp tốt, tận tâm, làm việc nhóm.' ], true )
				. $job( 'Bác sĩ chỉnh nha', 'Toàn thời gian · TP. Hồ Chí Minh · Thoả thuận', [ 'Khám, lập kế hoạch và theo dõi các ca niềng răng mắc cài và khay trong suốt.', 'Làm việc cùng phần mềm mô phỏng và scan 3D để thiết kế kế hoạch điều trị.', 'Tái khám, điều chỉnh và theo dõi tiến độ điều trị.' ], [ 'Có chứng chỉ chỉnh nha; ưu tiên chứng chỉ Invisalign.', 'Từ 2 năm kinh nghiệm chỉnh nha.', 'Tư duy thẩm mỹ, cẩn thận, kiên nhẫn.' ] )
				. $job( 'Trợ thủ nha khoa', 'Toàn thời gian · TP. Hồ Chí Minh · Có đào tạo nghề', [ 'Hỗ trợ bác sĩ tại ghế: chuẩn bị dụng cụ, vật liệu, hút nước bọt.', 'Vệ sinh, tiệt trùng dụng cụ và giữ ghế điều trị đúng chuẩn kiểm soát nhiễm khuẩn.', 'Hướng dẫn khách chăm sóc răng sau điều trị.' ], [ 'Tốt nghiệp trung cấp/cao đẳng Y, Điều dưỡng hoặc liên quan; sinh viên mới ra trường được đào tạo.', 'Nhanh nhẹn, trung thực, có tinh thần học hỏi.' ] )
				. $job( 'Lễ tân – Chăm sóc khách hàng', 'Toàn thời gian · TP. Hồ Chí Minh · Ca xoay', [ 'Tiếp đón khách, xác nhận lịch hẹn và hướng dẫn thủ tục.', 'Tư vấn thông tin dịch vụ, bảng giá và chương trình ưu đãi.', 'Chăm sóc khách hàng sau điều trị, nhắc lịch tái khám.' ], [ 'Ngoại hình ưa nhìn, giao tiếp tốt, giọng nói dễ nghe.', 'Sử dụng thành thạo tin học văn phòng.', 'Ưu tiên có kinh nghiệm ngành dịch vụ, y tế hoặc thẩm mỹ.' ] )
				. $job( 'Chuyên viên Marketing', 'Toàn thời gian · TP. Hồ Chí Minh · Thoả thuận', [ 'Xây dựng nội dung website, mạng xã hội và email marketing.', 'Triển khai chương trình ưu đãi, sự kiện và hợp tác truyền thông.', 'Theo dõi, báo cáo hiệu quả các kênh quảng bá.' ], [ 'Từ 1 năm kinh nghiệm marketing, ưu tiên lĩnh vực y tế hoặc làm đẹp.', 'Viết tốt, có khiếu thẩm mỹ, biết thiết kế cơ bản.', 'Chủ động, sáng tạo, tư duy dữ liệu.' ] )
				. $job( 'Kế toán', 'Toàn thời gian · TP. Hồ Chí Minh · Thoả thuận', [ 'Theo dõi thu chi, công nợ, thanh toán trả góp.', 'Lập báo cáo tài chính, hoàn thiện chứng từ theo quy định.', 'Phối hợp các bộ phận để đối chiếu doanh thu và vật tư.' ], [ 'Tốt nghiệp Kế toán – Tài chính, từ 2 năm kinh nghiệm.', 'Thành thạo phần mềm kế toán và Excel.', 'Cẩn thận, trung thực, bảo mật thông tin.' ] )
				. '</div>';
		},
		'steps_h' => 'Quy trình tuyển dụng',
		'steps' => [
			[ 'Gửi hồ sơ', 'Gửi CV về <a href="mailto:{email}">{email}</a> hoặc gọi <a href="tel:{tel}">{hotline}</a> để được hướng dẫn.' ],
			[ 'Sàng lọc hồ sơ', 'Bộ phận nhân sự xem xét và liên hệ ứng viên phù hợp trong 3–5 ngày làm việc.' ],
			[ 'Phỏng vấn', 'Trao đổi với quản lý trực tiếp; vị trí chuyên môn có thể kèm bài thực hành.' ],
			[ 'Thương lượng và nhận việc', 'Thống nhất thu nhập, ngày nhận việc và chương trình đào tạo hội nhập.' ],
		],
		'tip' => '<strong>Mẹo ứng tuyển:</strong> ghi rõ vị trí ứng tuyển ở tiêu đề email và đính kèm CV cùng chứng chỉ hành nghề (nếu có).',
		'faq' => [
			[ 'Sinh viên mới ra trường có được ứng tuyển không?', 'Có. Các vị trí trợ thủ, lễ tân và bác sĩ mới ra trường đều được đào tạo và kèm cặp trong giai đoạn đầu.' ],
			[ 'Lịch làm việc như thế nào?', 'Làm việc 6 ngày/tuần theo ca, giờ làm việc từ {hours}. Chi tiết được trao đổi khi phỏng vấn.' ],
			[ 'Tôi chưa thấy vị trí phù hợp, có thể gửi CV không?', 'Được. Bạn vẫn có thể gửi CV, chúng tôi sẽ lưu hồ sơ và liên hệ khi có vị trí phù hợp.' ],
		],
		'cta' => 'Gửi CV về <a href="mailto:{email}">{email}</a> hoặc gọi <a href="tel:{tel}">{hotline}</a>. {site} rất mong được gặp bạn.',
	] );
}
