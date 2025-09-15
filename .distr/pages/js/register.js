// Registration page functionality
$(document).ready(function() {
    const form = $('#registerForm');
    
    // Real-time validation
    form.find('input').on('blur', function() {
        validateField($(this));
    });
    
    // Form submission
    form.on('submit', function(e) {
        e.preventDefault();
        
        let isValid = true;
        const formData = {};
        
        // Validate all fields
        form.find('input').each(function() {
            const field = $(this);
            if (!validateField(field)) {
                isValid = false;
            }
            formData[field.attr('name')] = field.val();
        });
        
        // Check agreement
        if (!form.find('input[name="agreement"]').is(':checked')) {
            isValid = false;
            showFieldError(form.find('input[name="agreement"]').closest('.register__form-group'), 'Необходимо согласиться с условиями');
        }
        
        if (isValid) {
            submitForm(formData);
        } else {
            showNotification('Пожалуйста, исправьте ошибки в форме', 'error');
        }
    });
    
    // Phone number formatting
    $('input[name="phone"]').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        if (value.length > 0) {
            if (value[0] === '8') {
                value = '7' + value.slice(1);
            }
            if (value[0] === '7') {
                value = value.replace(/(\d{1})(\d{3})(\d{3})(\d{2})(\d{2})/, '+$1 ($2) $3-$4-$5');
            }
        }
        $(this).val(value);
    });
    
    // Password confirmation
    $('input[name="confirmPassword"]').on('input', function() {
        const password = $('input[name="password"]').val();
        const confirmPassword = $(this).val();
        
        if (confirmPassword && password !== confirmPassword) {
            showFieldError($(this).closest('.register__form-group'), 'Пароли не совпадают');
        } else {
            clearFieldError($(this).closest('.register__form-group'));
        }
    });
    
    function validateField(field) {
        const value = field.val().trim();
        const fieldName = field.attr('name');
        const fieldGroup = field.closest('.register__form-group');
        
        clearFieldError(fieldGroup);
        
        // Required field validation
        if (field.prop('required') && !value) {
            showFieldError(fieldGroup, 'Это поле обязательно для заполнения');
            return false;
        }
        
        // Email validation
        if (fieldName === 'email' && value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                showFieldError(fieldGroup, 'Введите корректный email адрес');
                return false;
            }
        }
        
        // Phone validation
        if (fieldName === 'phone' && value) {
            const phoneRegex = /^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/;
            if (!phoneRegex.test(value)) {
                showFieldError(fieldGroup, 'Введите корректный номер телефона');
                return false;
            }
        }
        
        // Password validation
        if (fieldName === 'password' && value) {
            if (value.length < 6) {
                showFieldError(fieldGroup, 'Пароль должен содержать минимум 6 символов');
                return false;
            }
        }
        
        // Name validation
        if ((fieldName === 'firstName' || fieldName === 'lastName') && value) {
            if (value.length < 2) {
                showFieldError(fieldGroup, 'Имя должно содержать минимум 2 символа');
                return false;
            }
        }
        
        return true;
    }
    
    function showFieldError(fieldGroup, message) {
        const errorElement = fieldGroup.find('.register__form-error');
        errorElement.text(message).addClass('show');
        fieldGroup.find('.register__form-input').addClass('error');
    }
    
    function clearFieldError(fieldGroup) {
        const errorElement = fieldGroup.find('.register__form-error');
        errorElement.removeClass('show').text('');
        fieldGroup.find('.register__form-input').removeClass('error');
    }
    
    function submitForm(formData) {
        const submitBtn = form.find('.register__form-submit');
        
        // Show loading state
        submitBtn.addClass('loading').prop('disabled', true);
        
        // Simulate API call
        setTimeout(function() {
            submitBtn.removeClass('loading').prop('disabled', false);
            
            // Simulate successful registration
            showNotification('Регистрация прошла успешно! Добро пожаловать!', 'success');
            
            // Redirect to cabinet after 2 seconds
            setTimeout(function() {
                window.location.href = 'cabinet.php';
            }, 2000);
            
        }, 3000);
    }
    
    // Notification system
    function showNotification(message, type) {
        const notification = $(`
            <div class="notification notification--${type}">
                <div class="notification__content">
                    <span class="notification__message">${message}</span>
                    <button class="notification__close">&times;</button>
                </div>
            </div>
        `);
        
        $('body').append(notification);
        
        // Auto remove after 5 seconds
        setTimeout(function() {
            notification.fadeOut(300, function() {
                $(this).remove();
            });
        }, 5000);
        
        // Manual close
        notification.find('.notification__close').on('click', function() {
            notification.fadeOut(300, function() {
                $(this).remove();
            });
        });
    }
});

// Add notification styles
const notificationStyles = `
<style>
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    max-width: 400px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    animation: slideIn 0.3s ease;
}

.notification--success {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

.notification--error {
    background: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

.notification__content {
    padding: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.notification__message {
    flex: 1;
    font-size: 14px;
    font-weight: 500;
}

.notification__close {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
    margin-left: 10px;
    opacity: 0.7;
    transition: opacity 0.3s ease;
}

.notification__close:hover {
    opacity: 1;
}

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}
</style>
`;

$('head').append(notificationStyles);
