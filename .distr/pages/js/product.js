$(function () {
  initLazy();
  initProductText();
  initSwiper();

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

  function initProductText(){
    $('.product__item-container-btn').on('click', function () {
      var text = $(this).text();
      $(this).text(text == "Еще..." ? "Скрыть" : "Еще...");
      $('.product__item-container').toggleClass('active');
    });
  }

  function initSwiper() {

    var swiper = new Swiper('.product__same-swiper', {
			slidesPerView: 4,
			spaceBetween: 10,
			grabCursor: true,
      loop: true,
      autoHeight: true,
      watchSlidesProgress: true,
      watchSlidesVisibility: true,
      watchOverflow: true,
			navigation: {
				nextEl: '.product__navigation-next',
				prevEl: '.product__navigation-prev',
			  },
      pagination: {
        el: '.product__pagination',
        clickable: true,
      },
      breakpoints: {
        320: {
          slidesPerView: 1.1,
        },
        577: {
          slidesPerView: 2,
        },
        767: {
          slidesPerView: 3,
        },
        992: {
          slidesPerView: 4,
        }
      }
			
    });
  };


});