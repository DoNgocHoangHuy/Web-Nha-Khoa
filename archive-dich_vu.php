<?php
get_header();
get_template_part( 'template-parts/service-list', null, [ 'title' => 'Dịch vụ', 'crumbs' => [ [ 'Dịch vụ' ] ] ] );
?>
<section class="booking" id="dat-lich">
	<div class="wrap"><div class="book-card">
		<h2>Để lại số điện thoại để được nhận cuộc gọi tư vấn miễn phí</h2>
		<?php get_template_part( 'template-parts/booking-form', null, [ 'id' => 'ar' ] ); ?>
	</div></div>
</section>
<?php get_footer();
