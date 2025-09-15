$(function () {
  initLazy();
  initScroll();
  initSelect();
  initMore();
  initBtnToTop();
  initFilterAll();

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
  function initFilterAll() {
      $('.catalog__nav-filter').on('click', function () {
        let txt = $('.catalog__nav-filter-text').text();
        $('.catalog__nav-filter-text').text(txt == 'Показать фильтры'?'Скрыть фильтры':'Показать фильтры');

        $(this).toggleClass('active');
        $('.catalog__nav-row-02').toggleClass('active');
      });
  }
  function initSelect() {

    $('.catalog__select').on('click', function () {
      $(this).toggleClass('active')
      $(this).find('.catalog__select-top').toggleClass('active');
      $(this).find('.catalog__select-bottom').toggleClass('active');      
    });

    $('.catalog__select-item').on('click', function () {
      let txt = $(this).text();
      $(this).closest('.catalog__select').find('.catalog__select-title').html(txt);
      $(this).closest('.catalog__select').find('.сatalog__select-input-hidden').val(txt);
      
      $(".catalog__select-title").text(function(i, text) {
        if (text.length >= 10) {
          text = text.substring(0, 10);
          var lastIndex = text.lastIndexOf(" ");
          text = text.substring(0, lastIndex) + ' ...';
        }        
        $(this).text(text);        
      });

    });

  }

  function initMore() {

    let speakerList = $(".catalog__content"),
        listSizeSpeaker = speakerList.children().length,
        defaultSizeSpeaker,
        step,
        scrollPosition;

    if ( document.body.clientWidth > 900 ) { defaultSizeSpeaker = 16, step = 8 } 
    else if ( document.body.clientWidth > 620 ) { defaultSizeSpeaker = 12, step = 6 } 
    else if ( document.body.clientWidth > 320 ) { defaultSizeSpeaker = step = 4 } 

    speakerList.children().hide();
    speakerList.children().slice(0, defaultSizeSpeaker).fadeIn();

    $('.catalog__more').click(function (e) {
        scrollPosition = window.pageYOffset;
        e.preventDefault();
        var speakerList = $(".catalog__content");

        defaultSizeSpeaker = (defaultSizeSpeaker + step <= listSizeSpeaker) ? 
                                                    defaultSizeSpeaker + step : 
                                                    listSizeSpeaker;
        speakerList.children().slice(0, defaultSizeSpeaker).fadeIn();

        window.scrollTo( 0, scrollPosition );

        if (defaultSizeSpeaker == listSizeSpeaker) {
            $('.catalog__more').hide();
        }
    })
  };

  function initScroll() {
    if (!$('.scroll').length) return;

    $(document).on('click scroll.init', '.scroll', function (event) {
      event.preventDefault();
      $.fancybox.close();

      var
        hrefId = $(this).attr('href') || $(this).data('href'),
        posTop = $(hrefId).offset().top;
      $('html, body').animate({ scrollTop: posTop }, 1500);
    });
  }

  function initBtnToTop(){
    let btn = document.querySelector('.catalog__top');
      function btnTint(){
          if(window.scrollY > 600 ){
            btn.classList.add('active');
          }else{
            btn.classList.remove('active');
          }
      }
      window.addEventListener('scroll', () => {
          btnTint();
      });
      btnTint();
  }

});