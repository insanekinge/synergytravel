(function($){
	$(function(){
		var $sliderRoot = $('.js-main-bottom-slider');
		var $progress = $('.main__bottom-progress_bar');

		if (!$sliderRoot.length) return;

		// Tear down Slick if present
		if ($sliderRoot.hasClass('slick-initialized')){
			$sliderRoot.slick('unslick');
		}

		// Convert to Swiper compatible markup by wrapping items
		$sliderRoot.each(function(){
			var $root = $(this);
			if ($root.find('.swiper-wrapper').length) return;
			var $items = $root.children('.main__bottom-slider_item');
			var $wrapper = $('<div class="swiper-wrapper"/>');
			$items.each(function(){
				var $slide = $('<div class="swiper-slide"/>');
				$slide.append($(this));
				$wrapper.append($slide);
			});
			$root.append($wrapper);
			$root.addClass('swiper');
		});

		var swipers = [];
		$sliderRoot.each(function(){
			var swiper = new Swiper(this, {
				loop: false,
				slidesPerView: 'auto', // ширина берется из CSS (370px)
				spaceBetween: 0,      // зазоры задаются через margin у ._item
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
                    resize: function(sw){
                        try { if (sw && typeof sw.update === 'function') sw.update(); } catch(e) {}
                    }
                }
			});
			swipers.push(swiper);
		});

		// Partners slider
		var $partners = $('.js-partners-slider');
		$partners.each(function(){
			var $root = $(this);
			if (!$root.find('.swiper-wrapper').length){
				var $items = $root.children('.partners__slide');
				var $wrapper = $('<div class="swiper-wrapper"/>');
				$items.each(function(){
					var $slide = $('<div class="swiper-slide"/>');
					$slide.append($(this));
					$wrapper.append($slide);
				});
				$root.append($wrapper);
				$root.addClass('swiper');
			}

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
						var $progress = $root.closest('.partners').find('.partners__progress_bar');
						if ($progress.length) $progress.css('width', (progress * 100) + '%');
					},
					resize: function(sw){ sw.update(); }
				}
			});
		});
	});
})(jQuery);

$(function () {
  initLazy();
  initHeader();

  function initLazy() {

    let
      lazyArr = [].slice.call(document.querySelectorAll('.lazy')),
      active = false,
      threshold = 200
      ;

    const lazyLoad = function (e) {
      if (active === false) {
        active = true;

        setTimeout(function () {
          lazyArr.forEach(function (lazyObj) {
            if ((lazyObj.getBoundingClientRect().top <= window.innerHeight + threshold && lazyObj.getBoundingClientRect().bottom >= -threshold) && getComputedStyle(lazyObj).display !== 'none') {

              if (lazyObj.dataset.src) {
                let
                  img = new Image(),
                  src = lazyObj.dataset.src
                  ;
                img.src = src;
                img.onload = function () {
                  if (!!lazyObj.parent) {
                    lazyObj.parent.replaceChild(img, lazyObj);
                  } else {
                    lazyObj.src = src;
                  }
                }
                lazyObj.removeAttribute('data-src');
              }

              if (lazyObj.dataset.srcset) {
                lazyObj.srcset = lazyObj.dataset.srcset;
                lazyObj.removeAttribute('data-srcset');
              }

              lazyObj.classList.remove('lazy');
              lazyObj.classList.add('lazy-loaded');

              lazyArr = lazyArr.filter(function (obj) {
                return obj !== lazyObj;
              });

              if (lazyArr.length === 0) {
                document.removeEventListener('scroll', lazyLoad);
                window.removeEventListener('resize', lazyLoad);
                window.removeEventListener('orientationchange', lazyLoad);
              }
            }
          });

          active = false;
        }, 200);
      }
    };

    lazyLoad();

    document.addEventListener('scroll', lazyLoad);
    window.addEventListener('resize', lazyLoad);
    window.addEventListener('orientationchange', lazyLoad);

  }

  function initHeader() {
    let menu = document.querySelector('.ham');
    let navigation = document.querySelector('.header__nav');
    let navigation__links = document.querySelectorAll('.header__nav-link');

    if (!menu || !navigation) {
      return;
    }

    menu.addEventListener('click', function(){
      navigation.classList.toggle('active');
    });

    if (navigation__links && navigation__links.length) {
      for (var i = 0; i < navigation__links.length; i++) {
        var link = navigation__links[i];
        if (link) {
          link.addEventListener('click', function(){
            menu.classList.remove('active');
            navigation.classList.remove('active');
          });
        }
      }
    }
  }

});