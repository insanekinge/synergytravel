$(function () {
  initLazy();
  intitAccordeon();
  initSwiper();

  
  let btn = document.querySelector('.invitation__top-item-title-btn'),
  btnInfo = document.querySelector('.invitation__top-item-info-content'),
  btnCopy = document.querySelector('.invitation__top-item-info-copy'),
  btnForCopy = document.querySelector('.invitation__top-item-info-forcopy');

  btn.addEventListener('click', function(){
    btnInfo.classList.toggle('active')
  })


  /* копирование текста ссылки, через создание элемента */
  btnCopy.addEventListener('click', function(evt){
    evt.preventDefault();

    var area = document.createElement('textarea');

    document.body.appendChild(area);  
      area.value = btnForCopy.innerText;
      area.select();
      document.execCommand("copy");
    document.body.removeChild(area);  
  })

function intitAccordeon(){
  let target = document.querySelector('.invitation__history-top-title'),
  currentInfo = document.querySelector('.invitation__history-list');


  target.addEventListener('click', function() {
    this.classList.toggle('active');
    this.classList.contains('active') ?
    currentInfo.style.height =
    currentInfo.scrollHeight + 'px' :
    currentInfo.style.height = '0px';
  }) 
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




});