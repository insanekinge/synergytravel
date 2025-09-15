$(function () {

    const initSendSuccess = () => {
        $('body').on('send-success', function() {
            $('.send-success').hide();
            $('.send-success__invite-friend').show();
        });
    }

    const initTogglePatronymic = () => {
        const patronymicCheckbox = $('.invite-friend__form-checkbox-patronymic');
        const patronymicInput = $('.invite-friend__form-input-patronymic');

        patronymicCheckbox.on('click', function () {
            $(this).is(':checked')
                ? patronymicInput.removeAttr('required').prop('disabled', true).parent().hide()
                : patronymicInput.attr('required', 'required').prop('disabled', false).parent().show();
        });
    }

    const initValidateInput = () => {
        $.validator.addMethod( 'valInput', function(value, element) {
            return this.optional(element) || /^[a-zа-яё\s]+$/iu.test(value);
        }, 'Введите корректное имя' );

        $.validator.addClassRules('invite-friend__form-input--val', {
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

    initSendSuccess();
    initTogglePatronymic();
    initPlugin();
});