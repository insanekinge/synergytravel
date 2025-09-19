<main class="register">
    <div class="container">
        <div class="register__wrapper">

            <div class="register__header">
                <a href="/" class="register__header-back"><img src="img/register/arrow-back.svg" alt="" class="register__header-back_img">Вернуться на главную</a>
                <a href="" class="register__header-exit"><img src="img/register/cross.svg" alt="" class="register__header-exit_img"></a>
            </div>

            <div class="register__content">
                <div class="register__content-profile"><img src="img/register/profile.png" alt="" class="register__content-profile_img"></div>
                <h1 class="register__content-title">Присоединяйтесь к Synergy Travel</h1>
                <p class="register__content-subtitle">и открывайте мир с новой стороны!</p>
                <form class="register__form" id="registerForm">
                    <p class="register__content-login">
                        <a href="#" class="register__content-login_reg">Регистрация</a>
                        <a href="#" class="register__content-login_enter">Войти</a>
                    </p>
                    <div class="register__form-row">
                        <div class="register__form-group">
                            <input type="text" class="register__form-input" name="firstName" placeholder="Имя" required>
                            <div class="register__form-error"></div>
                        </div>
                    </div>

                    <div class="register__form-group">
                        <input type="email" class="register__form-input" name="email" placeholder="Email" required>
                        <div class="register__form-error"></div>
                    </div>

                    <div class="register__form-group">
                        <input type="password" class="register__form-input" name="password" placeholder="Пароль" required>
                        <div class="register__form-error"></div>
                    </div>

                    <div class="register__form-group">
                        <input type="password" class="register__form-input" name="confirmPassword" placeholder="Подтвердите пароль" required>
                        <div class="register__form-error"></div>
                    </div>

                    <button type="submit" class="register__form-submit button button--accent">
                        Зарегистрироваться
                    </button>
                    <div class="register__form-group">
                        <label class="register__checkbox">
                            <input type="checkbox" class="register__checkbox-input" name="agreement" required>
                            <span class="register__checkbox-text">
                            Я&nbsp;даю согласие на&nbsp;обработку персональных данных, согласен на&nbsp;получение информационных рассылок от&nbsp;&laquo;Synergy Travel &raquo; и&nbsp;соглашаюсь c&nbsp;политикой конфиденциальности
                            </span>
                        </label>
                        <div class="register__form-error"></div>
                    </div>
                </form>
                    
            </div>

        </div>
    </div>
</main>
