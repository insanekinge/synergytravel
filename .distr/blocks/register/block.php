<main class="register">
    <div class="container">
        <div class="register__wrapper">
            <div class="register__header">
                <h1 class="register__title">Регистрация</h1>
                <p class="register__subtitle">Создайте аккаунт для доступа к личному кабинету</p>
            </div>

            <div class="register__content">
                <form class="register__form" id="registerForm">
                    <div class="register__form-row">
                        <div class="register__form-group">
                            <label class="register__form-label">Имя *</label>
                            <input type="text" class="register__form-input" name="firstName" required>
                            <div class="register__form-error"></div>
                        </div>
                        <div class="register__form-group">
                            <label class="register__form-label">Фамилия *</label>
                            <input type="text" class="register__form-input" name="lastName" required>
                            <div class="register__form-error"></div>
                        </div>
                    </div>

                    <div class="register__form-group">
                        <label class="register__form-label">Email *</label>
                        <input type="email" class="register__form-input" name="email" required>
                        <div class="register__form-error"></div>
                    </div>

                    <div class="register__form-group">
                        <label class="register__form-label">Телефон *</label>
                        <input type="tel" class="register__form-input" name="phone" placeholder="+7 (999) 123-45-67" required>
                        <div class="register__form-error"></div>
                    </div>

                    <div class="register__form-group">
                        <label class="register__form-label">Дата рождения</label>
                        <input type="date" class="register__form-input" name="birthDate">
                    </div>

                    <div class="register__form-group">
                        <label class="register__form-label">Пароль *</label>
                        <input type="password" class="register__form-input" name="password" required>
                        <div class="register__form-error"></div>
                    </div>

                    <div class="register__form-group">
                        <label class="register__form-label">Подтвердите пароль *</label>
                        <input type="password" class="register__form-input" name="confirmPassword" required>
                        <div class="register__form-error"></div>
                    </div>

                    <div class="register__form-group">
                        <label class="register__checkbox">
                            <input type="checkbox" class="register__checkbox-input" name="agreement" required>
                            <span class="register__checkbox-text">
                                Я согласен с <a href="#" class="register__link">пользовательским соглашением</a> 
                                и <a href="#" class="register__link">политикой конфиденциальности</a>
                            </span>
                        </label>
                        <div class="register__form-error"></div>
                    </div>

                    <div class="register__form-group">
                        <label class="register__checkbox">
                            <input type="checkbox" class="register__checkbox-input" name="newsletter">
                            <span class="register__checkbox-text">
                                Подписаться на рассылку новостей и специальных предложений
                            </span>
                        </label>
                    </div>

                    <button type="submit" class="register__form-submit button button--accent">
                        Зарегистрироваться
                    </button>
                </form>

                <div class="register__footer">
                    <p class="register__login-text">
                        Уже есть аккаунт? 
                        <a href="#" class="register__login-link">Войти</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
