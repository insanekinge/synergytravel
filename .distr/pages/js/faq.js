$(function () {

    const initAccordion = () => {
        const titleItem = $('.faq__item-title');

        titleItem.on('click', function () {
            $(this).next().slideToggle('fast');
            $(this).parent().toggleClass('faq__item--open');
        })
    }

    initAccordion();
});