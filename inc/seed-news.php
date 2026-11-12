<?php
/**
 * Bài viết mẫu: Kiến thức nha khoa, Tin tức sự kiện, Báo chí nói về chúng tôi.
 * Tất cả là NỘI DUNG MẪU do theme soạn – hãy thay bằng bài thật (đặc biệt phần Báo chí: dán link bài báo gốc ở khung "Thông tin bài viết").
 * Khoá = slug nhận diện bài mẫu (meta pw_seed_post). 'days' = số ngày trước hôm nay để xếp thứ tự.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pw_seed_articles() {
	$cta_default = null;
	return [

/* ================= KIẾN THỨC NHA KHOA ================= */
'k-invisalign' => [ 'cat' => 'kien-thuc-nha-khoa', 'days' => 3, 'img' => 'aligner', 'title' => 'Niềng răng Invisalign: ai nên và không nên niềng?',
	'excerpt' => 'Invisalign phù hợp với nhiều tình trạng lệch lạc nhưng không dành cho mọi ca. Tìm hiểu điều kiện, thời gian, chi phí và cách đeo khay đúng để đạt kết quả như mô phỏng.',
	'c' => [
		'lead' => 'Invisalign là khay niềng trong suốt tháo lắp được – nhưng hiệu quả phụ thuộc rất nhiều vào việc bạn có phải là ứng viên phù hợp hay không.',
		'intro' => [ 'Nhiều người chọn Invisalign vì thẩm mỹ: khay trong suốt, gần như không ai nhận ra bạn đang niềng, ăn uống và vệ sinh răng miệng dễ hơn mắc cài. Tuy vậy, không phải ca nào cũng nên niềng bằng khay. Việc chọn đúng ca ngay từ đầu quyết định thời gian điều trị, chi phí và kết quả cuối cùng.', 'Bài viết này tổng hợp những điều bác sĩ {site} thường giải thích cho khách trong buổi tư vấn đầu tiên, để bạn tự đánh giá sơ bộ trước khi đến khám.' ],
		'facts' => [ [ 'Thời gian', '6 – 24 tháng tuỳ ca' ], [ 'Thời gian đeo', '20 – 22 giờ mỗi ngày' ], [ 'Thay khay', '1 – 2 tuần/lần' ], [ 'Tái khám', '6 – 8 tuần/lần' ] ],
		'what_h' => 'Invisalign hoạt động như thế nào?',
		'what' => [ 'Sau khi chụp phim và scan 3D hàm răng, phần mềm mô phỏng toàn bộ quá trình di chuyển răng từ vị trí hiện tại đến vị trí mong muốn. Từ mô phỏng đó, hãng sản xuất một bộ khay riêng cho bạn. Mỗi khay chỉ di chuyển răng một đoạn rất nhỏ (khoảng 0,25 mm), bạn đeo đủ thời gian rồi chuyển sang khay kế tiếp.', 'Các điểm gắn nhỏ màu răng (attachment) được dán lên một số răng để khay bám tốt hơn, giúp thực hiện những chuyển động khó như xoay răng hay kéo răng xuống.' ],
		'figs' => [ [ 'aligner', 'Khay niềng Invisalign trong suốt' ], [ 'aligner2', 'Bác sĩ kiểm tra khay niềng cho khách' ] ],
		'pros_h' => 'Ưu điểm của niềng răng trong suốt',
		'pros' => [ [ 'Thẩm mỹ cao', 'Khay trong suốt, ít bị nhận ra khi giao tiếp.' ], [ 'Tháo lắp linh hoạt', 'Tháo khi ăn và đánh răng, vệ sinh dễ như bình thường.' ], [ 'Xem trước kết quả', 'Mô phỏng 3D cho thấy răng sau niềng trước khi bắt đầu.' ], [ 'Ít loét má', 'Không có mắc cài kim loại cọ vào niêm mạc.' ] ],
		'who_h' => 'Ai nên chọn Invisalign?',
		'who' => [ 'Răng chen chúc, thưa, hô hoặc móm mức độ nhẹ đến trung bình.', 'Người trưởng thành đi làm, cần thẩm mỹ khi giao tiếp.', 'Người đã niềng trước đây nhưng răng bị xô lệch trở lại.', 'Người có thói quen vệ sinh răng miệng tốt và <strong>kỷ luật đeo khay</strong> đủ giờ.' ],
		'inc_h' => 'Những trường hợp cần cân nhắc kỹ',
		'inc' => [ 'Lệch lạc nặng, cần nhổ nhiều răng hoặc phẫu thuật hàm – bác sĩ có thể đề xuất mắc cài.', 'Răng đang bị viêm nha chu hoặc sâu răng chưa điều trị: cần xử lý trước khi niềng.', 'Người khó duy trì thói quen đeo khay đủ 20–22 giờ mỗi ngày.', 'Trẻ đang trong giai đoạn thay răng: nên khám để chọn dòng khay phù hợp (Teen, First).' ],
		'steps_h' => 'Quy trình niềng Invisalign tại {site}',
		'steps' => [ [ 'Khám và chụp phim', 'Bác sĩ khám tổng quát, chụp phim X-quang, đánh giá khớp cắn và tình trạng nướu.' ], [ 'Scan 3D và lập kế hoạch', 'Scan răng bằng máy quét trong miệng, mô phỏng kết quả để bạn xem trước.' ], [ 'Điều trị răng trước niềng', 'Lấy cao răng, trám sâu răng hoặc điều trị nướu nếu cần.' ], [ 'Nhận khay và gắn attachment', 'Hướng dẫn đeo, tháo, vệ sinh khay và lịch thay khay.' ], [ 'Tái khám theo dõi', 'Kiểm tra tiến độ, điều chỉnh kế hoạch nếu cần.' ], [ 'Đeo hàm duy trì', 'Giữ răng ổn định sau khi hoàn tất niềng.' ] ],
		'care_h' => 'Mẹo đeo khay để đạt kết quả như mô phỏng',
		'care' => [ 'Chỉ tháo khay khi ăn và đánh răng; uống nước lọc khi đang đeo.', 'Đánh răng và dùng chỉ nha khoa trước khi đeo lại khay.', 'Vệ sinh khay bằng nước mát và bàn chải mềm, không dùng nước nóng.', 'Luôn mang hộp đựng khay, tránh gói khay vào khăn giấy dễ bị vứt nhầm.' ],
		'tip' => '<strong>Lưu ý:</strong> hiệu quả điều trị phụ thuộc cơ địa và sự hợp tác của mỗi người. Bác sĩ sẽ cho bạn biết rõ ca của mình phù hợp với khay hay mắc cài ngay sau buổi khám.',
		'faq' => [ [ 'Niềng Invisalign có đau không?', 'Bạn có thể thấy ê nhẹ trong 2–3 ngày đầu mỗi khi đổi khay mới. Cảm giác này giảm dần và thường không cần dùng thuốc giảm đau.' ], [ 'Invisalign giá bao nhiêu?', 'Chi phí tuỳ gói (Lite, Moderate, Comprehensive…) và mức độ lệch lạc. Xem bảng giá tại trang <a href="{home}/bang-gia/">Bảng giá</a> hoặc để lại số điện thoại để được báo giá chính xác.' ], [ 'Đeo khay ít giờ hơn có sao không?', 'Có. Răng sẽ di chuyển chậm hoặc không theo kế hoạch, kéo dài thời gian niềng và có thể phải làm lại khay.' ], [ 'Niềng xong có cần đeo hàm duy trì không?', 'Có. Hàm duy trì giữ răng ổn định ở vị trí mới và là bước bắt buộc để kết quả bền lâu.' ] ],
	] ],

'k-rang-su' => [ 'cat' => 'kien-thuc-nha-khoa', 'days' => 8, 'img' => 'veneer', 'title' => 'Bọc răng sứ là gì? Các loại răng sứ phổ biến hiện nay',
	'excerpt' => 'So sánh răng sứ kim loại, Zirconia và Cercon HT: độ bền, thẩm mỹ, bảo hành và cách chọn loại phù hợp với răng cũng như ngân sách của bạn.',
	'c' => [
		'lead' => 'Bọc răng sứ là phương pháp mài một lớp mô răng và phủ lên bằng mão sứ để phục hồi hình dáng, màu sắc và chức năng ăn nhai.',
		'intro' => [ 'Răng sứ được chỉ định cho răng sâu lớn, mẻ vỡ, nhiễm màu nặng, răng đã điều trị tuỷ hoặc răng thưa, nhỏ lệch cần cải thiện thẩm mỹ. Mỗi dòng sứ có độ bền, độ trong và mức bảo hành khác nhau, vì vậy lựa chọn đúng sẽ giúp bạn vừa đẹp vừa tiết kiệm về lâu dài.' ],
		'facts' => [ [ 'Thời gian', '3 – 7 ngày' ], [ 'Số lần hẹn', '2 – 3 lần' ], [ 'Độ bền', '10 – 20 năm' ], [ 'Bảo hành', '7 – 15 năm' ] ],
		'what_h' => 'Các loại răng sứ phổ biến',
		'what' => [ '<strong>Sứ kim loại</strong> có lớp sườn kim loại bên trong, chi phí thấp nhưng sau thời gian có thể xuất hiện viền đen ở cổ răng và dễ gây kích ứng với người cơ địa nhạy cảm.', '<strong>Sứ toàn sứ (Zirconia, Cercon HT)</strong> không chứa kim loại, độ cứng cao, màu sắc tự nhiên và tương thích tốt với nướu. Đây là nhóm được nhiều bác sĩ khuyên dùng hiện nay.' ],
		'figs' => [ [ 'veneer', 'Mão răng sứ thẩm mỹ' ], [ 'smile3', 'Nụ cười sau khi bọc sứ' ] ],
		'cmp_h' => 'Bảng so sánh nhanh',
		'cmp' => [ 'head' => [ 'Loại sứ', 'Thẩm mỹ', 'Độ bền', 'Phù hợp với' ], 'rows' => [ [ 'Sứ kim loại', 'Trung bình', 'Tốt', 'Răng hàm, ngân sách hạn chế' ], [ 'Zirconia', 'Tốt', 'Rất tốt', 'Đa số vị trí, nhu cầu ăn nhai mạnh' ], [ 'Cercon HT', 'Rất tự nhiên', 'Rất tốt', 'Răng cửa, yêu cầu thẩm mỹ cao' ] ] ],
		'steps_h' => 'Quy trình bọc răng sứ tại {site}',
		'steps' => [ [ 'Thăm khám, chụp phim', 'Kiểm tra tuỷ, nướu, khớp cắn; điều trị bệnh lý (nếu có) trước khi bọc.' ], [ 'Tư vấn màu và hình dáng', 'Chọn màu răng, dáng răng hài hoà khuôn mặt.' ], [ 'Mài răng và lấy dấu', 'Mài tối thiểu, lấy dấu hoặc scan 3D, gắn răng tạm.' ], [ 'Chế tác mão sứ', 'Gia công theo dữ liệu số, kiểm soát chất lượng.' ], [ 'Gắn sứ và hẹn tái khám', 'Chỉnh khớp cắn, gắn cố định và kiểm tra lại sau 1–2 tuần.' ] ],
		'care_h' => 'Chăm sóc để răng sứ bền đẹp',
		'care' => [ 'Đánh răng 2–3 lần/ngày, dùng chỉ nha khoa hoặc tăm nước.', 'Không cắn vật cứng (đá, xương, nắp chai).', 'Tái khám 6 tháng/lần để kiểm tra viền sứ và nướu.', 'Đeo máng bảo vệ khi ngủ nếu bạn nghiến răng.' ],
		'faq' => [ [ 'Bọc răng sứ có đau không?', 'Quá trình mài răng được thực hiện dưới gây tê nên bạn không đau. Sau khi hết tê có thể ê nhẹ vài ngày.' ], [ 'Răng sứ dùng được bao lâu?', 'Trung bình 10–20 năm nếu chăm sóc đúng cách. Thời gian bảo hành tuỳ dòng sứ, ghi rõ trong phiếu bảo hành.' ], [ 'Khác gì dán veneer?', 'Veneer chỉ mài một lớp mỏng mặt ngoài, phù hợp răng còn tốt nhưng cần chỉnh màu, dáng. Bọc sứ bao phủ toàn bộ răng, dùng khi răng đã hư tổn nhiều.' ] ],
	] ],

'k-implant' => [ 'cat' => 'kien-thuc-nha-khoa', 'days' => 13, 'img' => 'implant', 'title' => 'Trồng răng Implant: quy trình và chăm sóc sau cấy ghép',
	'excerpt' => 'Các bước từ thăm khám, chụp phim CT, cấy trụ đến gắn răng sứ; lưu ý giúp Implant bền vững lâu dài và cách chăm sóc trong từng giai đoạn.',
	'c' => [
		'lead' => 'Implant thay thế cả chân răng và thân răng, là giải pháp phục hình răng mất bền vững nhất hiện nay.',
		'intro' => [ 'Khi mất răng, xương hàm tại vị trí đó dần tiêu đi, các răng bên cạnh nghiêng về khoảng trống và khớp cắn thay đổi. Trụ Implant được cấy vào xương như một chân răng nhân tạo, giúp giữ xương, ăn nhai chắc chắn và có thể sử dụng nhiều năm nếu được chăm sóc đúng.' ],
		'facts' => [ [ 'Thời gian lành thương', '2 – 4 tháng' ], [ 'Thời gian phẫu thuật', '30 – 60 phút/trụ' ], [ 'Vật liệu trụ', 'Titanium' ], [ 'Bảo hành', 'Theo từng dòng trụ' ] ],
		'what_h' => 'Implant gồm những phần nào?',
		'what' => [ 'Một răng Implant gồm ba phần: <strong>trụ Titanium</strong> cấy trong xương hàm, <strong>abutment</strong> là khớp nối và <strong>mão sứ</strong> là phần thân răng nhìn thấy trong miệng. Trụ tích hợp với xương theo thời gian (osseointegration) tạo nên độ chắc chắn như răng thật.' ],
		'figs' => [ [ 'implant', 'Trụ Implant và mão sứ' ], [ 'xray', 'Phim X-quang đánh giá xương hàm' ] ],
		'pros_h' => 'Vì sao nhiều người chọn Implant?',
		'pros' => [ [ 'Giữ xương hàm', 'Ngăn tiêu xương, giữ khuôn mặt không bị lão hoá sớm.' ], [ 'Không mài răng bên cạnh', 'Khác cầu răng sứ, các răng kế bên được bảo tồn.' ], [ 'Ăn nhai chắc', 'Lực nhai gần như răng thật.' ], [ 'Độ bền cao', 'Có thể dùng rất lâu khi vệ sinh tốt và tái khám đều.' ] ],
		'steps_h' => 'Quy trình cấy Implant tại {site}',
		'steps' => [ [ 'Khám, chụp CT Cone Beam', 'Đánh giá chiều cao, độ dày xương và vị trí dây thần kinh.' ], [ 'Lập kế hoạch', 'Chọn loại trụ, số lượng trụ và thời điểm làm răng.' ], [ 'Cấy trụ', 'Thực hiện dưới gây tê, quy trình vô trùng.' ], [ 'Chờ tích hợp xương', 'Đeo răng tạm (nếu cần), tái khám theo hẹn.' ], [ 'Gắn mão sứ', 'Lấy dấu, chế tác và gắn răng sứ lên trụ.' ] ],
		'care_h' => 'Chăm sóc sau cấy ghép',
		'care' => [ '48 giờ đầu: chườm lạnh ngoài má, ăn đồ mềm nguội, tránh súc miệng mạnh.', 'Uống thuốc đúng đơn, không hút thuốc lá trong thời gian lành thương.', 'Vệ sinh quanh trụ nhẹ nhàng bằng bàn chải mềm, tăm nước.', 'Tái khám định kỳ 6 tháng/lần để kiểm tra nướu và khớp cắn.' ],
		'tip' => '<strong>Điều cần biết:</strong> người bị tiểu đường chưa kiểm soát, hút thuốc nhiều hoặc loãng xương nặng cần được bác sĩ đánh giá kỹ trước khi cấy Implant.',
		'faq' => [ [ 'Cấy Implant có đau không?', 'Quá trình cấy được gây tê tại chỗ nên bạn không đau. Sau đó có thể sưng nhẹ vài ngày, giảm dần khi dùng thuốc theo chỉ định.' ], [ 'Bao lâu thì có răng mới?', 'Tuỳ tình trạng xương, thường từ 2–4 tháng. Một số ca đủ điều kiện có thể gắn răng tạm sớm hơn.' ], [ 'Implant có bị đào thải không?', 'Titanium rất tương thích sinh học nên tỉ lệ đào thải thấp. Vệ sinh tốt và tái khám đều giúp hạn chế viêm quanh trụ.' ] ],
	] ],

'k-tay-trang' => [ 'cat' => 'kien-thuc-nha-khoa', 'days' => 19, 'img' => 'smile1', 'title' => 'Tẩy trắng răng: có hại men răng không? Cách tẩy trắng an toàn',
	'excerpt' => 'Tẩy trắng răng đúng chỉ định và đúng quy trình không làm mỏng men răng. Cùng tìm hiểu nguyên nhân răng ố vàng, các phương pháp và cách duy trì độ trắng.',
	'c' => [
		'lead' => 'Tẩy trắng an toàn khi được bác sĩ khám, chỉ định đúng và thực hiện bằng hoạt chất, nồng độ phù hợp.',
		'intro' => [ 'Răng ố vàng có thể do thức ăn, đồ uống có màu (cà phê, trà, nước ngọt), thuốc lá, kháng sinh nhóm tetracycline hoặc do men răng mỏng dần theo tuổi. Tẩy trắng giúp làm sáng màu răng thật mà không cần mài, nhưng chỉ hiệu quả với răng nhiễm màu ngoại sinh hoặc nhiễm màu nhẹ.' ],
		'facts' => [ [ 'Thời gian', '45 – 90 phút' ], [ 'Số lần', '1 buổi' ], [ 'Độ sáng', 'Sáng hơn 2–8 tông' ], [ 'Duy trì', '1 – 2 năm' ] ],
		'what_h' => 'Các phương pháp tẩy trắng',
		'what' => [ '<strong>Tẩy trắng tại phòng khám:</strong> bác sĩ bôi gel nồng độ phù hợp kết hợp đèn hoặc ánh sáng hỗ trợ, bảo vệ nướu và cho kết quả nhanh trong một buổi.', '<strong>Tẩy trắng tại nhà:</strong> dùng khay đúc riêng và gel nồng độ thấp theo hướng dẫn, thời gian kéo dài vài ngày đến vài tuần, phù hợp người ê buốt.' ],
		'figs' => [ [ 'smile1', 'Nụ cười sáng sau tẩy trắng' ] ],
		'who_h' => 'Ai không nên tẩy trắng?',
		'who' => [ 'Phụ nữ đang mang thai hoặc cho con bú.', 'Người đang có sâu răng, viêm nướu, tụt nướu chưa điều trị.', 'Răng nhiễm màu nặng do kháng sinh, nhiễm Fluor – nên cân nhắc veneer hoặc bọc sứ.', 'Trẻ em dưới 16 tuổi.' ],
		'steps_h' => 'Quy trình tại {site}',
		'steps' => [ [ 'Khám và lấy cao răng', 'Làm sạch mảng bám để gel tác dụng đều.' ], [ 'Đo màu răng', 'Ghi nhận màu ban đầu để so sánh sau tẩy.' ], [ 'Bảo vệ nướu', 'Phủ lớp bảo vệ nướu và môi.' ], [ 'Bôi gel và chiếu sáng', 'Thực hiện theo từng chu kỳ, theo dõi độ ê buốt.' ], [ 'Bôi Fluor, dặn dò', 'Giảm ê buốt và hướng dẫn chế độ ăn uống.' ] ],
		'care_h' => 'Giữ răng trắng lâu hơn',
		'care' => [ '48 giờ đầu hạn chế cà phê, trà, rượu vang đỏ, nước sốt màu đậm.', 'Dùng ống hút khi uống nước có màu, súc miệng bằng nước lọc sau khi dùng.', 'Đánh răng bằng kem chứa Fluor, lấy cao răng 6 tháng/lần.', 'Có thể làm lại sau 1–2 năm tuỳ thói quen ăn uống.' ],
		'faq' => [ [ 'Tẩy trắng có làm mỏng men răng không?', 'Gel đúng nồng độ, thực hiện đúng chỉ định không làm mỏng men. Nên tránh tự tẩy bằng các mẹo như chanh, baking soda vì có thể mài mòn men.' ], [ 'Sau tẩy trắng bị ê buốt thì sao?', 'Ê buốt nhẹ thường hết sau 24–48 giờ. Bạn có thể dùng kem đánh răng giảm ê buốt và tránh đồ quá nóng hoặc lạnh.' ] ],
	] ],

'k-rang-khon' => [ 'cat' => 'kien-thuc-nha-khoa', 'days' => 25, 'img' => 'wisdom', 'title' => 'Nhổ răng khôn: khi nào cần nhổ và chăm sóc sau nhổ',
	'excerpt' => 'Không phải răng khôn nào cũng phải nhổ. Hướng dẫn nhận biết răng khôn mọc lệch, mọc ngầm, dấu hiệu viêm và cách chăm sóc để vết thương nhanh lành.',
	'c' => [
		'lead' => 'Răng khôn (răng số 8) mọc muộn, thường ở tuổi 17–25 và hay mọc lệch vì thiếu chỗ trên cung hàm.',
		'intro' => [ 'Răng khôn mọc đúng, sạch và khớp cắn tốt thì có thể giữ lại. Ngược lại, răng mọc lệch, mọc ngầm hoặc khó vệ sinh dễ gây viêm lợi trùm, sâu răng số 7, đau lan lên tai và sưng má. Phim X-quang toàn cảnh giúp bác sĩ đánh giá chính xác hướng mọc và vị trí chân răng.' ],
		'facts' => [ [ 'Thời gian nhổ', '15 – 45 phút' ], [ 'Gây tê', 'Tại chỗ' ], [ 'Lành thương', '7 – 14 ngày' ], [ 'Tái khám', 'Sau 7 ngày' ] ],
		'what_h' => 'Khi nào nên nhổ răng khôn?',
		'what' => [ 'Bạn nên nhổ khi răng khôn gây đau tái đi tái lại, viêm lợi trùm, sâu răng, làm đau hoặc hỏng răng kế bên, hoặc có nguy cơ tạo u nang quanh thân răng ngầm.' ],
		'figs' => [ [ 'wisdom', 'Kiểm tra răng khôn bằng phim X-quang' ] ],
		'who_h' => 'Dấu hiệu cần đi khám sớm',
		'who' => [ 'Đau nhức vùng góc hàm, lan lên tai hoặc đau khi há miệng.', 'Lợi quanh răng khôn sưng đỏ, chảy mủ, hôi miệng kéo dài.', 'Răng số 7 bên cạnh bị sâu hoặc ê buốt.', 'Răng khôn mọc nghiêng, chỉ trồi một phần.' ],
		'steps_h' => 'Quy trình nhổ răng khôn tại {site}',
		'steps' => [ [ 'Khám và chụp phim', 'Xác định hướng mọc, độ sâu, liên quan với dây thần kinh.' ], [ 'Gây tê', 'Tê tại chỗ, bạn tỉnh táo và không đau.' ], [ 'Nhổ răng', 'Dùng dụng cụ tiệt trùng, thao tác nhẹ nhàng, hạn chế tổn thương mô.' ], [ 'Khâu và cầm máu', 'Khâu vết thương khi cần, cắn gạc cầm máu 30–40 phút.' ], [ 'Dặn dò và kê đơn', 'Thuốc giảm đau, kháng sinh (nếu cần), hẹn tái khám.' ] ],
		'care_h' => 'Chăm sóc sau nhổ',
		'care' => [ 'Cắn gạc theo hướng dẫn, không khạc nhổ mạnh trong 24 giờ đầu.', 'Chườm lạnh bên ngoài má 10–15 phút/lần trong ngày đầu để giảm sưng.', 'Ăn thức ăn mềm nguội, tránh ống hút, rượu bia và thuốc lá.', 'Súc miệng nước muối loãng sau 24 giờ, đánh răng nhẹ nhàng vùng xung quanh.' ],
		'faq' => [ [ 'Nhổ răng khôn có nguy hiểm không?', 'Khi được chụp phim và nhổ bởi bác sĩ có kinh nghiệm, quy trình an toàn. Ca mọc ngầm sát dây thần kinh sẽ được tư vấn kỹ trước khi thực hiện.' ], [ 'Sau nhổ bao lâu thì ăn uống bình thường?', 'Thường 7–10 ngày. Bạn nên ăn đồ mềm trong 2–3 ngày đầu rồi chuyển dần sang thức ăn thường.' ] ],
	] ],

/* ================= TIN TỨC SỰ KIỆN ================= */
't-invisalign' => [ 'cat' => 'tin-tuc-su-kien', 'days' => 1, 'img' => 'aligner2', 'title' => 'Ưu đãi niềng răng Invisalign giảm đến 35% trong tháng này',
	'excerpt' => 'Chương trình ưu đãi dành cho khách hàng đăng ký niềng răng trong suốt Invisalign: giảm đến 35%, tặng kèm hàm duy trì và hỗ trợ trả góp 0%.',
	'c' => [
		'lead' => 'Tháng này {site} áp dụng ưu đãi niềng răng trong suốt Invisalign với mức giảm đến 35% cho các gói điều trị.',
		'intro' => [ 'Nhằm giúp nhiều khách hàng sớm sở hữu hàm răng đều đẹp, {site} triển khai chương trình ưu đãi đặc biệt cho dịch vụ niềng răng trong suốt. Ưu đãi áp dụng cho khách hàng đăng ký khám và chốt kế hoạch điều trị trong thời gian chương trình.', 'Đây là cơ hội phù hợp cho những ai đã cân nhắc niềng răng nhưng còn băn khoăn về chi phí.' ],
		'facts' => [ [ 'Mức giảm', 'Đến 35%' ], [ 'Trả góp', '0% lãi suất' ], [ 'Quà tặng', 'Hàm duy trì Vivera*' ], [ 'Đặt lịch', '{hotline}' ] ],
		'pros_h' => 'Quyền lợi khi tham gia chương trình',
		'pros' => [ [ 'Giảm trực tiếp trên gói', 'Áp dụng cho các gói Invisalign được niêm yết.' ], [ 'Khám và tư vấn miễn phí', 'Bác sĩ chụp phim, đánh giá và mô phỏng kết quả.' ], [ 'Trả góp 0%', 'Chia nhỏ chi phí theo từng tháng với thẻ tín dụng.' ], [ 'Theo dõi sát sao', 'Lịch tái khám rõ ràng, hỗ trợ qua hotline.' ] ],
		'steps_h' => 'Cách nhận ưu đãi',
		'steps' => [ [ 'Đặt lịch hẹn', 'Gọi hotline hoặc để lại số điện thoại trên website.' ], [ 'Khám và tư vấn', 'Bác sĩ đánh giá ca và đề xuất gói phù hợp.' ], [ 'Chốt kế hoạch', 'Đăng ký gói trong thời gian chương trình để giữ mức giá ưu đãi.' ] ],
		'care_h' => 'Điều kiện áp dụng',
		'care' => [ 'Ưu đãi không cộng gộp với chương trình khác.', 'Hiệu quả điều trị phụ thuộc cơ địa và sự hợp tác của từng khách hàng.', 'Quà tặng và mức giảm theo từng gói được tư vấn cụ thể tại phòng khám.' ],
		'tip' => '<em>Nội dung mẫu – hãy sửa lại mức giảm, thời hạn và điều kiện cho đúng chương trình thật của bạn.</em>',
	] ],

't-implant' => [ 'cat' => 'tin-tuc-su-kien', 'days' => 6, 'img' => 'implant2', 'title' => 'Combo Implant Thụy Sĩ chỉ từ 18,9 triệu: những điều cần biết',
	'excerpt' => 'Gói Implant Thụy Sĩ gồm trụ chính hãng, mão sứ và bảo hành dài hạn. Tìm hiểu quyền lợi, điều kiện và quy trình để nhận ưu đãi.',
	'c' => [
		'lead' => 'Combo Implant Thụy Sĩ giúp bạn phục hình răng mất với chi phí rõ ràng, trụ chính hãng và quy trình chuẩn.',
		'intro' => [ 'Trụ Implant Thụy Sĩ được đánh giá cao nhờ bề mặt xử lý giúp tích hợp xương nhanh và ổn định. Gói combo tại {site} gồm trụ, abutment và mão sứ, có phiếu bảo hành rõ ràng và quy trình tái khám định kỳ.' ],
		'facts' => [ [ 'Giá từ', '18,9 triệu' ], [ 'Bảo hành', 'Theo phiếu bảo hành' ], [ 'Thời gian', '2 – 4 tháng' ], [ 'Trả góp', '0%' ] ],
		'what_h' => 'Gói combo bao gồm gì?',
		'what' => [ 'Gói bao gồm khám, chụp phim CT Cone Beam, trụ Implant, abutment, mão sứ và các lần tái khám theo kế hoạch. Các trường hợp cần ghép xương, nâng xoang sẽ được bác sĩ tư vấn chi phí riêng trước khi thực hiện.' ],
		'figs' => [ [ 'implant2', 'Trụ Implant chính hãng' ] ],
		'steps_h' => 'Quy trình thực hiện',
		'steps' => [ [ 'Khám, chụp CT', 'Đánh giá xương hàm và lên kế hoạch.' ], [ 'Cấy trụ', 'Thực hiện dưới gây tê, vô trùng.' ], [ 'Chờ lành thương', 'Tái khám theo lịch hẹn.' ], [ 'Gắn mão sứ', 'Hoàn thiện răng và dặn dò chăm sóc.' ] ],
		'tip' => '<em>Nội dung mẫu – hãy cập nhật giá, thời hạn và điều kiện chương trình theo thực tế.</em>',
	] ],

't-tre-em' => [ 'cat' => 'tin-tuc-su-kien', 'days' => 12, 'img' => 'kids', 'title' => 'Tuần lễ khám răng miễn phí cho trẻ em tại {site}',
	'excerpt' => 'Chương trình khám sàng lọc sâu răng, hướng dẫn chải răng đúng cách và bôi Fluor phòng ngừa cho trẻ từ 3 đến 12 tuổi.',
	'c' => [
		'lead' => 'Chăm sóc răng từ sớm giúp trẻ có hàm răng khoẻ và hình thành thói quen vệ sinh tốt suốt đời.',
		'intro' => [ 'Trong tuần lễ chăm sóc răng miệng, {site} tổ chức chương trình khám sàng lọc miễn phí dành cho trẻ từ 3 đến 12 tuổi. Bác sĩ nhi khoa giao tiếp nhẹ nhàng, giúp các bé làm quen với phòng khám một cách vui vẻ.' ],
		'pros_h' => 'Chương trình có gì?',
		'pros' => [ [ 'Khám sàng lọc', 'Kiểm tra sâu răng, nướu và khớp cắn.' ], [ 'Hướng dẫn chải răng', 'Thực hành cùng mô hình, dễ nhớ cho bé.' ], [ 'Bôi Fluor', 'Tăng cường men răng, phòng ngừa sâu răng.' ], [ 'Tư vấn cho phụ huynh', 'Chế độ ăn, thói quen bú bình, mút tay.' ] ],
		'steps_h' => 'Cách đăng ký',
		'steps' => [ [ 'Gọi hotline hoặc để lại số điện thoại', 'Chọn khung giờ phù hợp với gia đình.' ], [ 'Đến khám', 'Mang theo sổ khám cũ (nếu có).' ], [ 'Nhận tư vấn', 'Bác sĩ trao đổi kế hoạch chăm sóc cho bé.' ] ],
		'tip' => '<em>Nội dung mẫu – hãy sửa thời gian, địa điểm và số suất theo chương trình thật.</em>',
	] ],

't-vo-trung' => [ 'cat' => 'tin-tuc-su-kien', 'days' => 18, 'img' => 'tools', 'title' => '{site} áp dụng quy trình kiểm soát nhiễm khuẩn một chiều',
	'excerpt' => 'Dụng cụ được tiệt trùng riêng cho từng khách, đóng gói kín, khui trước mặt khách hàng. Cùng tìm hiểu quy trình an toàn tại phòng khám.',
	'c' => [
		'lead' => 'An toàn là điều kiện đầu tiên của mọi điều trị nha khoa.',
		'intro' => [ 'Mỗi dụng cụ tại {site} đi theo một chiều: rửa, đóng gói, tiệt trùng, bảo quản và khui trước mặt khách. Quy trình này giúp hạn chế nguy cơ lây nhiễm chéo và mang lại sự yên tâm cho khách hàng.' ],
		'steps_h' => 'Quy trình kiểm soát nhiễm khuẩn',
		'steps' => [ [ 'Làm sạch', 'Ngâm, rửa siêu âm để loại bỏ chất bẩn hữu cơ.' ], [ 'Đóng gói', 'Dụng cụ được đóng túi riêng cho từng khách.' ], [ 'Tiệt trùng', 'Hấp áp suất cao, có chỉ thị kiểm tra.' ], [ 'Bảo quản', 'Lưu giữ trong khu vực sạch, có hạn sử dụng.' ], [ 'Khui trước khách', 'Túi dụng cụ được mở ngay trước mặt khách hàng.' ] ],
		'care_h' => 'Những điều khách hàng có thể quan sát',
		'care' => [ 'Nhân viên đeo găng tay, khẩu trang, kính chắn; thay mới cho mỗi khách.', 'Ghế và bề mặt tiếp xúc được lau khử khuẩn sau từng lượt khám.', 'Kim tiêm, ống hút nước bọt dùng một lần.' ],
		'tip' => '<em>Nội dung mẫu – hãy điều chỉnh theo quy trình thực tế của phòng khám.</em>',
	] ],

/* ================= BÁO CHÍ NÓI VỀ CHÚNG TÔI ================= */
'p-1' => [ 'cat' => 'bao-chi', 'days' => 4, 'img' => 'office', 'src' => 'Báo điện tử', 'title' => '{site} – địa chỉ nha khoa được nhiều khách hàng tin chọn',
	'excerpt' => 'Phòng khám đặt sự an tâm của khách hàng lên hàng đầu với quy trình vô trùng, báo giá minh bạch và đội ngũ bác sĩ tận tâm.',
	'c' => [
		'lead' => 'Giữa nhiều lựa chọn nha khoa, điều khách hàng quan tâm nhất vẫn là sự an tâm: bác sĩ giỏi, vật liệu rõ nguồn gốc và chi phí minh bạch.',
		'intro' => [ 'Theo chia sẻ từ đại diện {site}, phòng khám xây dựng quy trình điều trị theo nguyên tắc “khám kỹ – tư vấn thật – điều trị đúng”. Mỗi khách hàng được thăm khám, chụp phim đầy đủ và nhận kế hoạch điều trị bằng văn bản trước khi bắt đầu.', 'Phòng khám cũng áp dụng quy trình kiểm soát nhiễm khuẩn một chiều, dụng cụ tiệt trùng riêng cho từng khách và khui trước mặt khách hàng.' ],
		'quote' => [ 'Chúng tôi muốn khách hàng hiểu rõ mình đang điều trị gì, vì sao chọn phương án đó và chi phí ra sao. Sự minh bạch tạo nên lòng tin.', 'Đại diện {site}' ],
		'what_h' => 'Điều làm nên khác biệt',
		'what' => [ 'Ngoài chuyên môn, {site} chú trọng trải nghiệm của khách hàng: đặt lịch dễ dàng, thời gian chờ ngắn, hỗ trợ trả góp 0% lãi suất và chăm sóc sau điều trị qua hotline.' ],
		'pros_h' => 'Những cam kết nổi bật',
		'pros' => [ [ 'Minh bạch chi phí', 'Báo giá trước điều trị, hợp đồng rõ ràng.' ], [ 'Vật liệu chính hãng', 'Trụ Implant, khay niềng, răng sứ có truy xuất nguồn gốc.' ], [ 'Bảo hành dài hạn', 'Thời gian bảo hành ghi rõ theo từng dịch vụ.' ] ],
		'cta' => '<em>Nội dung mẫu để minh hoạ giao diện. Hãy thay bằng bài báo thật và dán link bài gốc vào khung “Thông tin bài viết”.</em> Đặt lịch tư vấn qua hotline <a href="tel:{tel}">{hotline}</a>.',
	] ],

'p-2' => [ 'cat' => 'bao-chi', 'days' => 9, 'img' => 'aligner3', 'src' => 'Truyền hình', 'title' => 'Chuyên gia chia sẻ: niềng răng trong suốt có thực sự hiệu quả?',
	'excerpt' => 'Bác sĩ giải đáp thắc mắc thường gặp về niềng răng trong suốt: thời gian, chi phí, đối tượng phù hợp và những lưu ý để đạt kết quả tốt nhất.',
	'c' => [
		'lead' => 'Niềng răng trong suốt ngày càng phổ biến, nhưng hiệu quả phụ thuộc vào việc chọn đúng ca và tuân thủ điều trị.',
		'intro' => [ 'Trong chương trình tư vấn sức khoẻ, bác sĩ {site} giải đáp những thắc mắc thường gặp của khán giả về niềng răng trong suốt: có phù hợp mọi lứa tuổi không, bao lâu thì thấy kết quả và cần chú ý gì khi đeo khay.' ],
		'quote' => [ 'Khay niềng chỉ phát huy tác dụng khi được đeo đủ thời gian. Bác sĩ lập kế hoạch, nhưng người bệnh mới là người quyết định kết quả.', 'Bác sĩ chỉnh nha, {site}' ],
		'what_h' => 'Những điểm chính được chia sẻ',
		'what' => [ '<strong>Đối tượng phù hợp:</strong> răng lệch lạc mức nhẹ đến trung bình, người trưởng thành cần thẩm mỹ.', '<strong>Thời gian đeo:</strong> 20–22 giờ mỗi ngày, chỉ tháo khi ăn và vệ sinh răng miệng.', '<strong>Chi phí:</strong> phụ thuộc mức độ ca và gói điều trị; cần được bác sĩ khám và báo giá cụ thể.' ],
		'faq' => [ [ 'Niềng trong suốt có đau không?', 'Bạn có thể ê nhẹ vài ngày mỗi khi đổi khay mới, sau đó giảm dần.' ], [ 'Có cần nhổ răng không?', 'Tuỳ ca. Nhiều trường hợp nhẹ có thể niềng mà không nhổ răng; bác sĩ sẽ tư vấn sau khi khám.' ] ],
		'cta' => '<em>Nội dung mẫu để minh hoạ giao diện – hãy thay bằng bài/clip thật và dán link nguồn.</em>',
	] ],

'p-3' => [ 'cat' => 'bao-chi', 'days' => 15, 'img' => 'implant3', 'src' => 'Tạp chí sức khoẻ', 'title' => 'Trồng răng Implant – giải pháp phục hình răng mất bền vững',
	'excerpt' => 'Mất răng lâu ngày gây tiêu xương và xô lệch khớp cắn. Implant giúp phục hồi chức năng ăn nhai và giữ thẩm mỹ khuôn mặt.',
	'c' => [
		'lead' => 'Mất răng không chỉ ảnh hưởng thẩm mỹ mà còn làm xương hàm tiêu dần và các răng còn lại xô lệch.',
		'intro' => [ 'Các chuyên gia nha khoa khuyến cáo nên phục hình sớm sau khi mất răng. Trong các phương pháp hiện nay, Implant được đánh giá cao vì tái tạo cả chân và thân răng, giúp giữ xương hàm và không cần mài các răng bên cạnh.' ],
		'quote' => [ 'Đánh giá xương hàm bằng phim CT trước khi cấy là bước then chốt để chọn đúng loại trụ và vị trí đặt trụ.', 'Bác sĩ Implant, {site}' ],
		'what_h' => 'Điều cần lưu ý khi cấy Implant',
		'what' => [ 'Người bệnh cần kiểm soát tốt các bệnh nền như tiểu đường, huyết áp; hạn chế hút thuốc và vệ sinh răng miệng kỹ để đảm bảo quá trình lành thương.' ],
		'cta' => '<em>Nội dung mẫu để minh hoạ giao diện – hãy thay bằng bài báo thật và dán link nguồn.</em>',
	] ],

'p-4' => [ 'cat' => 'bao-chi', 'days' => 22, 'img' => 'kids', 'src' => 'Báo điện tử', 'title' => 'Bác sĩ nha khoa tư vấn cách chăm sóc răng miệng cho trẻ nhỏ',
	'excerpt' => 'Từ khi răng sữa mọc, cha mẹ đã cần chú ý vệ sinh, chế độ ăn và lịch khám định kỳ để bé có hàm răng khoẻ.',
	'c' => [
		'lead' => 'Răng sữa khoẻ mạnh là nền tảng cho răng vĩnh viễn đều đẹp sau này.',
		'intro' => [ 'Nhiều phụ huynh cho rằng răng sữa sẽ rụng nên không cần quan tâm. Thực tế, sâu răng sữa có thể gây đau, nhiễm trùng và ảnh hưởng mầm răng vĩnh viễn. Bác sĩ khuyến cáo đưa trẻ đi khám lần đầu khi răng đầu tiên mọc hoặc khoảng 1 tuổi.' ],
		'quote' => [ 'Thói quen vệ sinh răng miệng hình thành từ nhỏ sẽ theo trẻ suốt đời. Cha mẹ nên là người làm gương và đồng hành cùng bé.', 'Bác sĩ nhi nha, {site}' ],
		'care_h' => 'Lời khuyên cho cha mẹ',
		'care' => [ 'Vệ sinh nướu cho bé bằng gạc ẩm trước khi răng mọc, đánh răng ngay khi có răng.', 'Hạn chế đồ ngọt và nước có gas, không cho bé ngậm bình sữa khi ngủ.', 'Khám răng định kỳ 3–6 tháng/lần, bôi Fluor phòng ngừa khi bác sĩ chỉ định.' ],
		'cta' => '<em>Nội dung mẫu để minh hoạ giao diện – hãy thay bằng bài báo thật và dán link nguồn.</em>',
	] ],

'p-5' => [ 'cat' => 'bao-chi', 'days' => 30, 'img' => 'veneer', 'src' => 'Tạp chí sức khoẻ', 'title' => 'Xu hướng bọc răng sứ thẩm mỹ: chọn sao cho tự nhiên?',
	'excerpt' => 'Nụ cười đẹp là nụ cười hài hoà với khuôn mặt, không phải hàm răng trắng đồng đều. Bác sĩ chia sẻ cách chọn dòng sứ và dáng răng.',
	'c' => [
		'lead' => 'Xu hướng hiện nay là răng sứ có độ trong và màu sắc tự nhiên, thay vì trắng đồng đều như nhau.',
		'intro' => [ 'Để có nụ cười tự nhiên, bác sĩ cần xem xét hình dáng khuôn mặt, đường cười, màu da và cả tính cách của khách hàng. Thiết kế nụ cười kỹ thuật số giúp khách xem trước kết quả và cùng bác sĩ điều chỉnh trước khi làm răng thật.' ],
		'quote' => [ 'Răng đẹp là răng nhìn không ai nhận ra là răng sứ. Màu, độ trong và dáng răng cần được cá nhân hoá.', 'Bác sĩ phục hình, {site}' ],
		'pros_h' => 'Tiêu chí chọn răng sứ',
		'pros' => [ [ 'Độ trong tự nhiên', 'Ánh sáng xuyên qua mão sứ giống men răng thật.' ], [ 'Tương thích nướu', 'Không kim loại, hạn chế viền đen cổ răng.' ], [ 'Bảo hành rõ ràng', 'Thời gian bảo hành ghi trong phiếu.' ] ],
		'cta' => '<em>Nội dung mẫu để minh hoạ giao diện – hãy thay bằng bài báo thật và dán link nguồn.</em>',
	] ],
	];
}
