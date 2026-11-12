<?php
/** Dữ liệu mẫu: NHÓM dịch vụ (có bài giới thiệu) và các TRANG (Giới thiệu, Ưu đãi…). */
if ( ! defined( 'ABSPATH' ) ) exit;

function pw_seed_terms() {
	$std_cta = null;
	return [
		[ 'Trồng răng Implant', '', 'Giải pháp phục hồi răng mất bền vững: trụ Implant chính hãng, chụp phim CT 3D, trả góp 0%.', 'implant3', [
			'lead' => 'Trồng răng Implant: phục hồi răng mất bền vững, ăn nhai như răng thật.',
			'intro' => [ 'Implant là trụ nhỏ cấy vào xương hàm thay thế chân răng, bên trên gắn răng sứ. Đây là giải pháp phục hình được nhiều bác sĩ khuyến nghị vì không phải mài răng kế cận và giúp hạn chế tiêu xương hàm.' ],
			'what_h' => 'Trồng răng Implant gồm những phần nào?',
			'what' => [ 'Một răng Implant hoàn chỉnh có 3 phần: <strong>trụ Implant</strong> (chân răng nhân tạo cấy vào xương), <strong>khớp nối Abutment</strong> và <strong>răng sứ</strong> bên trên. {site} cung cấp các gói trọn gói để bạn dễ so sánh và biết trước chi phí.' ],
			'pros' => [ [ 'Ăn nhai chắc chắn', 'Trụ liên kết trực tiếp với xương hàm nên lực nhai tương đương răng thật.' ], [ 'Chống tiêu xương', 'Trụ kích thích xương hàm, hạn chế xương tiêu dần sau khi mất răng.' ], [ 'Không mài răng kế cận', 'Khác với cầu răng sứ, các răng bên cạnh được giữ nguyên.' ], [ 'Bền lâu', 'Nếu chăm sóc tốt, trụ Implant có thể dùng nhiều chục năm.' ] ],
			'who' => [ 'Mất một hoặc nhiều răng, muốn phục hình bền vững.', 'Người đang đeo hàm tháo lắp, muốn chuyển sang răng cố định.' ],
			'steps' => [ [ 'Khám và chụp CT 3D', 'Đánh giá xương hàm, lập kế hoạch cấy ghép.' ], [ 'Cấy trụ Implant', 'Thực hiện dưới gây tê tại chỗ.' ], [ 'Chờ tích hợp xương', 'Trụ liên kết chắc với xương hàm.' ], [ 'Gắn răng sứ', 'Hoàn thiện phục hình, chỉnh khớp cắn.' ] ],
			'faq' => [ [ 'Chọn gói Eco hay Thuỵ Sĩ?', 'Nếu xương tốt, gói Eco đáp ứng tốt. Nếu xương yếu, mất răng lâu năm hoặc muốn rút ngắn thời gian, gói Thuỵ Sĩ là lựa chọn đáng cân nhắc. Bác sĩ sẽ tư vấn sau khi xem phim CT.' ], [ 'Trồng Implant có phải ghép xương không?', 'Một số ca xương mỏng cần ghép xương hoặc nâng xoang. Bác sĩ sẽ cho biết trước trên phim CT.' ] ],
			'figs' => [ [ 'implant3', 'Trụ Implant thay thế chân răng đã mất' ], [ 'xray', 'Phim CT 3D giúp cấy ghép chính xác' ] ],
		] ],
		[ 'Niềng răng', '', 'Chỉnh nha bằng khay trong suốt Invisalign hoặc mắc cài kim loại, sứ, tự đóng.', 'brace_smile', [
			'lead' => 'Niềng răng: chọn phương pháp phù hợp với răng, lối sống và ngân sách.',
			'intro' => [ 'Niềng răng giúp sắp đều răng, cải thiện khớp cắn và khuôn mặt. Tại {site} có hai nhóm phương pháp chính: <strong>khay trong suốt Invisalign</strong> và <strong>mắc cài cố định</strong> (kim loại, sứ, tự đóng).' ],
			'cmp_h' => 'So sánh nhanh các phương pháp niềng',
			'cmp' => [ 'head' => [ 'Tiêu chí', 'Invisalign', 'Mắc cài' ], 'rows' => [ [ 'Thẩm mỹ', 'Gần như vô hình', 'Nhìn thấy mắc cài (sứ kín đáo hơn)' ], [ 'Tháo lắp', 'Tháo được khi ăn', 'Cố định' ], [ 'Vệ sinh', 'Dễ như bình thường', 'Cần dụng cụ chuyên dụng' ], [ 'Chi phí', 'Cao hơn', 'Thấp – trung bình' ], [ 'Phù hợp', 'Người ưu tiên thẩm mỹ, kỷ luật đeo khay', 'Hầu hết các ca, kể cả phức tạp' ] ] ],
			'steps' => [ [ 'Khám và chụp phim', 'Chẩn đoán tình trạng răng và khớp cắn.' ], [ 'Tư vấn phương án', 'So sánh phương pháp, thời gian, chi phí.' ], [ 'Điều trị', 'Gắn mắc cài hoặc nhận khay, tái khám định kỳ.' ], [ 'Duy trì', 'Đeo hàm duy trì để giữ kết quả.' ] ],
			'faq' => [ [ 'Nên niềng ở độ tuổi nào?', 'Niềng răng được thực hiện cho cả thiếu niên và người lớn. Bác sĩ sẽ đánh giá tình trạng răng và xương để chỉ định.' ], [ 'Niềng răng có cần nhổ răng không?', 'Tuỳ trường hợp. Bác sĩ ưu tiên bảo tồn răng và chỉ nhổ khi thực sự cần.' ] ],
			'figs' => [ [ 'brace_smile', 'Nụ cười đều đẹp sau niềng răng' ], [ 'aligner', 'Khay trong suốt Invisalign' ] ],
		] ],
		[ 'Niềng răng trong suốt Invisalign', 'Niềng răng', 'Invisalign của Align Technology (Hoa Kỳ): khay trong suốt, tháo lắp, mô phỏng 3D trước điều trị.', 'aligner2', [
			'lead' => 'Niềng răng trong suốt Invisalign: thẩm mỹ, thoải mái, thấy trước kết quả.',
			'intro' => [ 'Invisalign là hệ thống chỉnh nha bằng chuỗi khay trong suốt không cần mắc cài và dây cung. {site} cung cấp nhiều gói từ Lite đến Comprehensive để phù hợp mức độ lệch lạc và ngân sách.' ],
			'pros' => [ [ 'Thẩm mỹ', 'Khay trong suốt, hầu như không bị nhận ra.' ], [ 'Tháo lắp dễ', 'Ăn uống, đánh răng như bình thường.' ], [ 'Mô phỏng 3D', 'Xem trước kết quả với ClinCheck.' ], [ 'Thoải mái', 'Không mắc cài nên ít loét miệng.' ] ],
			'steps' => [ [ 'Khám và scan 3D', 'Scan răng bằng iTero, không lấy dấu truyền thống.' ], [ 'Lập kế hoạch ClinCheck', 'Mô phỏng di chuyển răng và duyệt kế hoạch.' ], [ 'Nhận khay', 'Gắn attachment, hướng dẫn đeo khay.' ], [ 'Tái khám và duy trì', 'Thay khay theo lịch, đeo hàm duy trì sau cùng.' ] ],
			'faq' => [ [ 'Chọn gói nào cho phù hợp?', 'Lệch nhẹ: Lite hoặc Essentials; trung bình: Moderate; phức tạp: Comprehensive 3 hoặc 5 năm. Bác sĩ xác định chính xác sau khi scan răng.' ], [ 'Đeo khay bao nhiêu giờ mỗi ngày?', 'Khoảng 20–22 giờ mỗi ngày, chỉ tháo khi ăn uống và vệ sinh.' ] ],
			'figs' => [ [ 'aligner2', 'Bộ khay Invisalign trong suốt' ], [ 'smile3', 'Kết quả nụ cười sau điều trị' ] ],
		] ],
		[ 'Niềng răng mắc cài', 'Niềng răng', 'Mắc cài kim loại, mắc cài sứ và mắc cài tự đóng – hiệu quả với hầu hết ca niềng.', 'brace_metal', [
			'lead' => 'Niềng răng mắc cài: phương pháp ổn định, chi phí hợp lý, xử lý được ca phức tạp.',
			'intro' => [ 'Mắc cài là phương pháp chỉnh nha cố định lâu đời. {site} có 4 lựa chọn: gói tiết kiệm, mắc cài kim loại, mắc cài sứ và mắc cài tự đóng, để bạn cân đối giữa thẩm mỹ, thoải mái và chi phí.' ],
			'cmp_h' => 'Chọn loại mắc cài nào?',
			'cmp' => [ 'head' => [ 'Loại', 'Ưu điểm', 'Lưu ý' ], 'rows' => [ [ 'Kim loại', 'Chi phí thấp, hiệu quả cao', 'Dễ nhìn thấy' ], [ 'Sứ', 'Màu gần răng, thẩm mỹ', 'Cần tránh thực phẩm có màu' ], [ 'Tự đóng', 'Ít ma sát, tái khám thưa', 'Chi phí cao hơn' ] ] ],
			'steps' => [ [ 'Khám và chụp phim', 'Chẩn đoán, lập kế hoạch.' ], [ 'Gắn mắc cài', 'Gắn mắc cài và dây cung.' ], [ 'Điều chỉnh định kỳ', 'Tái khám 4–8 tuần/lần.' ], [ 'Tháo niềng và duy trì', 'Đeo hàm duy trì.' ] ],
			'faq' => [ [ 'Niềng mắc cài mất bao lâu?', 'Thường 18–30 tháng tuỳ mức độ lệch lạc.' ], [ 'Có được trả góp không?', 'Có, {site} hỗ trợ trả góp 0% lãi suất.' ] ],
			'figs' => [ [ 'brace_metal', 'Mắc cài kim loại' ], [ 'brace_model', 'Mô hình hàm răng niềng mắc cài' ] ],
		] ],
		[ 'Nha khoa tổng quát', '', 'Khám, lấy cao răng, trám răng, nhổ răng khôn – chăm sóc răng miệng toàn diện.', 'checkup', [
			'lead' => 'Nha khoa tổng quát: chăm sóc nền tảng cho hàm răng khoẻ mạnh.',
			'intro' => [ 'Khám định kỳ, lấy cao răng, trám sâu răng, nhổ răng khôn… là những dịch vụ cơ bản nhưng quan trọng nhất để giữ răng chắc khoẻ và phòng ngừa bệnh lý nặng hơn.' ],
			'pros' => [ [ 'Phát hiện sớm', 'Điều trị ngay khi bệnh còn nhẹ, tiết kiệm chi phí.' ], [ 'Quy trình vô trùng', 'Dụng cụ tiệt trùng riêng, quy trình một chiều.' ], [ 'Tư vấn rõ ràng', 'Báo giá trước khi điều trị.' ], [ 'Nhẹ nhàng', 'Gây tê khi cần, hạn chế đau.' ] ],
			'steps' => [ [ 'Khám và chụp phim', 'Đánh giá tình trạng tổng quát.' ], [ 'Tư vấn', 'Phương án và chi phí.' ], [ 'Điều trị', 'Thực hiện theo kế hoạch.' ], [ 'Tái khám', 'Hẹn khám định kỳ 6 tháng/lần.' ] ],
			'faq' => [ [ 'Bao lâu nên khám răng một lần?', 'Khoảng 6 tháng/lần, hoặc sớm hơn khi có triệu chứng đau, chảy máu nướu, ê buốt.' ] ],
			'figs' => [ [ 'checkup', 'Khám răng tổng quát' ], [ 'scaling', 'Lấy cao răng bằng sóng siêu âm' ] ],
		] ],
		[ 'Nha khoa thẩm mỹ', '', 'Bọc răng sứ, dán veneer và tẩy trắng để có nụ cười đều, sáng, tự nhiên.', 'veneer', [
			'lead' => 'Nha khoa thẩm mỹ: nụ cười đẹp, tự nhiên, hài hoà với khuôn mặt.',
			'intro' => [ 'Từ tẩy trắng đến bọc răng sứ và dán veneer, {site} thiết kế nụ cười theo khuôn mặt và mong muốn của bạn, sử dụng nhiều dòng sứ với thời gian bảo hành rõ ràng.' ],
			'pros' => [ [ 'Thiết kế cá nhân hoá', 'Chọn màu, hình dáng răng phù hợp từng người.' ], [ 'Nhiều dòng sứ', 'Từ Zirconia đến Orodent Gold.' ], [ 'Bảo hành rõ ràng', '7–15 năm theo dòng sứ.' ], [ 'Bảo tồn răng', 'Ưu tiên mài ít nhất có thể.' ] ],
			'steps' => [ [ 'Tư vấn thiết kế nụ cười', 'Chụp ảnh, scan răng, chọn màu.' ], [ 'Chuẩn bị răng', 'Mài tối thiểu, gắn răng tạm.' ], [ 'Chế tác', 'Gia công răng sứ theo dữ liệu số.' ], [ 'Gắn răng', 'Kiểm tra, chỉnh khớp cắn và gắn cố định.' ] ],
			'faq' => [ [ 'Nên tẩy trắng hay bọc sứ?', 'Răng chỉ ố vàng nhẹ có thể tẩy trắng. Răng nhiễm màu nặng, mẻ, thưa hoặc đã điều trị tuỷ nên cân nhắc bọc sứ hoặc veneer.' ] ],
			'figs' => [ [ 'veneer', 'Răng sứ thẩm mỹ' ], [ 'smile1', 'Nụ cười sáng đẹp' ] ],
		] ],
		[ 'Nha khoa trẻ em', '', 'Khám, trám răng sữa, bôi Fluor cho bé trong không gian thân thiện.', 'kids', [
			'lead' => 'Nha khoa trẻ em: để bé yêu việc đi nha sĩ ngay từ nhỏ.',
			'intro' => [ 'Chăm sóc răng từ sớm giúp bé có hàm răng khoẻ và thói quen vệ sinh tốt. Bác sĩ {site} giao tiếp nhẹ nhàng, giải thích dễ hiểu và để bé làm quen từng bước.' ],
			'pros' => [ [ 'Bác sĩ kiên nhẫn', 'Làm việc thường xuyên với trẻ nhỏ.' ], [ 'Không gian thân thiện', 'Giảm lo lắng cho bé.' ], [ 'Phòng ngừa là chính', 'Fluor, trám bít hố rãnh, hướng dẫn chải răng.' ], [ 'Đồng hành cùng cha mẹ', 'Tư vấn chế độ ăn, thói quen tốt.' ] ],
			'steps' => [ [ 'Làm quen', 'Bé được làm quen bác sĩ và dụng cụ.' ], [ 'Khám', 'Kiểm tra răng, nướu, khớp cắn.' ], [ 'Điều trị / phòng ngừa', 'Trám răng, Fluor khi cần.' ], [ 'Hẹn tái khám', 'Khám 3–6 tháng/lần.' ] ],
			'faq' => [ [ 'Bé mấy tuổi nên đi khám răng?', 'Từ khi răng đầu tiên mọc hoặc khoảng 1 tuổi, sau đó khám định kỳ.' ] ],
			'figs' => [ [ 'kids', 'Bé thoải mái khi khám răng' ], [ 'office2', 'Không gian thân thiện với trẻ' ] ],
		] ],
	];
}

function pw_seed_pages() {
	$cards = function ( $a ) { $o = '<div class="sv-pros">'; foreach ( $a as $c ) $o .= '<div><h3>' . $c[0] . '</h3><p>' . $c[1] . '</p></div>'; return $o . '</div>'; };
	$ul = function ( $a ) { $o = '<ul class="sv-check">'; foreach ( $a as $c ) $o .= '<li>' . $c . '</li>'; return $o . '</ul>'; };
	$m = '<!--pw-seed-->';
	return [
		'gioi-thieu' => [ 'Giới thiệu', pw_page_about() ],
		'uu-dai' => [ 'Ưu đãi', $m . '<p>Các chương trình ưu đãi đang áp dụng tại {site}. Hãy để lại số điện thoại để nhận tư vấn và giữ ưu đãi.</p>' ],
		'bang-gia' => [ 'Bảng giá dịch vụ', '' ],
		'tuyen-dung' => [ 'Tuyển dụng', pw_page_jobs() ],
		'chinh-sach-bao-mat' => [ 'Chính sách bảo mật', $m . '<h2>1. Thông tin chúng tôi thu thập</h2><p>Khi bạn đặt lịch hoặc để lại thông tin, {site} thu thập họ tên và số điện thoại để liên hệ tư vấn.</p><h2>2. Mục đích sử dụng</h2><p>Thông tin chỉ dùng để xác nhận lịch hẹn, tư vấn dịch vụ và chăm sóc khách hàng.</p><h2>3. Chia sẻ thông tin</h2><p>Chúng tôi không bán hoặc chia sẻ thông tin cá nhân của bạn cho bên thứ ba, trừ khi có yêu cầu của cơ quan có thẩm quyền.</p><h2>4. Bảo mật</h2><p>Dữ liệu được lưu trữ và chỉ nhân sự được phân quyền mới có thể truy cập.</p><h2>5. Quyền của bạn</h2><p>Bạn có quyền yêu cầu xem, chỉnh sửa hoặc xoá thông tin của mình bằng cách liên hệ <a href="mailto:{email}">{email}</a>.</p>' ],
		'lien-he' => [ 'Liên hệ', $m . '<p><strong>Địa chỉ:</strong> {address}</p><p><strong>Hotline:</strong> <a href="tel:{tel}">{hotline}</a></p><p><strong>Email:</strong> <a href="mailto:{email}">{email}</a></p><p><strong>Giờ làm việc:</strong> {hours}</p><p class="sv-tip">Để lại họ tên và số điện thoại ở form bên dưới, {site} sẽ gọi lại sớm nhất.</p>' ],
	];
}
