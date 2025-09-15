(function($){
	$(function(){
		var $sliderRoot = $('.js-partners-slider');

		if (!$sliderRoot.length) return;

		$sliderRoot.each(function(){
			var $root = $(this);
			// Ensure correct classes are present
			if (!$root.hasClass('swiper') && !$root.hasClass('swiper-container')){
				$root.addClass('swiper').addClass('swiper-container');
			}
		});

		$sliderRoot.each(function(){
			var $root = $(this);
			var $progress = $root.closest('.partners').find('.partners__bottom-progress_bar');
			new Swiper(this, {
				loop: false,
				slidesPerView: 'auto',
				spaceBetween: 0,
				centeredSlides: false,
				allowTouchMove: true,
				simulateTouch: true,
				grabCursor: true,
				freeMode: false,
				speed: 400,
				on: {
					progress: function(sw, progress){
						if ($progress.length) $progress.css('width', (progress * 100) + '%');
					},
					resize: function(sw){ sw.update(); }
				}
			});
		});
	});
})(jQuery);

