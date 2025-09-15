$(function () {

    const initSendSuccess = () => {
        $('body').on('send-success', function() {
            $('.send-success').hide();
            $('.send-success-rocket').show();
        });
    }

    const initValidateInput = () => {
        $.validator.addMethod( 'valInput', function(value, element) {
            return this.optional(element) || /^[a-zа-яё\s]+$/iu.test(value);
        }, 'Введите корректное имя' );

        $.validator.addClassRules('get-card__form-input--val', {
            valInput: true,
            minlength: 2,
        });
    }

    const initPlugin = () => {
        let interval = setInterval(function() {
            if (typeof $.fn.validate === 'function') {
                clearInterval(interval);
                initValidateInput();
                return;
            }
        }, 200);
    }

    const initTogglePatronymic = () => {
        const patronymicCheckbox = $('.get-card__form-checkbox-patronymic');
        const patronymicInput = $('.get-card__form-input-patronymic');

        patronymicCheckbox.on('click', function () {
            $(this).is(':checked')
                ? patronymicInput.removeAttr('required').prop('disabled', true).parent().hide()
                : patronymicInput.attr('required', 'required').prop('disabled', false).parent().show();
        });
    }

    initSendSuccess();
    initPlugin();
    initTogglePatronymic();
});