// Cabinet page functionality
$(document).ready(function() {
    // Navigation switching
    $('.cabinet__nav-link').on('click', function(e) {
        e.preventDefault();
        
        const target = $(this).attr('href');
        
        // Update active nav link
        $('.cabinet__nav-link').removeClass('cabinet__nav-link--active');
        $(this).addClass('cabinet__nav-link--active');
        
        // Show/hide sections
        $('.cabinet__section').hide();
        $(target).show();
    });

    // Form validation and submission
    $('.cabinet__form').on('submit', function(e) {
        e.preventDefault();
        
        const form = $(this);
        const submitBtn = form.find('.cabinet__form-submit');
        
        // Basic validation
        let isValid = true;
        form.find('input[required]').each(function() {
            if (!$(this).val().trim()) {
                isValid = false;
                $(this).addClass('error');
            } else {
                $(this).removeClass('error');
            }
        });
        
        if (isValid) {
            // Show loading state
            submitBtn.addClass('loading').prop('disabled', true);
            
            // Simulate API call
            setTimeout(function() {
                submitBtn.removeClass('loading').prop('disabled', false);
                showNotification('Данные успешно сохранены!', 'success');
            }, 2000);
        } else {
            showNotification('Пожалуйста, заполните все обязательные поля', 'error');
        }
    });

    // Password change form
    $('#settings form').on('submit', function(e) {
        e.preventDefault();
        
        const form = $(this);
        const currentPassword = form.find('input[type="password"]').eq(0).val();
        const newPassword = form.find('input[type="password"]').eq(1).val();
        const confirmPassword = form.find('input[type="password"]').eq(2).val();
        
        if (newPassword !== confirmPassword) {
            showNotification('Пароли не совпадают', 'error');
            return;
        }
        
        if (newPassword.length < 6) {
            showNotification('Пароль должен содержать минимум 6 символов', 'error');
            return;
        }
        
        // Simulate password change
        const submitBtn = form.find('.cabinet__form-submit');
        submitBtn.addClass('loading').prop('disabled', true);
        
        setTimeout(function() {
            submitBtn.removeClass('loading').prop('disabled', false);
            form[0].reset();
            showNotification('Пароль успешно изменен!', 'success');
        }, 2000);
    });

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
