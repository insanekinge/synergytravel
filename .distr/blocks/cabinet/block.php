<main class="cabinet">
    <div class="container">
        <div class="cabinet__header">
            <h1 class="cabinet__title">Личный кабинет</h1>
            <div class="cabinet__user-info">
                <div class="cabinet__user-avatar">
                    <img src="img/header/profile-icon.svg" alt="Аватар" class="cabinet__user-avatar-img">
                </div>
                <div class="cabinet__user-details">
                    <div class="cabinet__user-name">Юлия К.</div>
                    <div class="cabinet__user-email">yulia@example.com</div>
                </div>
            </div>
        </div>

        <div class="cabinet__content">
            <div class="cabinet__sidebar">
                <nav class="cabinet__nav">
                    <a href="#profile" class="cabinet__nav-link cabinet__nav-link--active">Профиль</a>
                    <a href="#tours" class="cabinet__nav-link">Мои туры</a>
                    <a href="#bookings" class="cabinet__nav-link">Бронирования</a>
                    <a href="#favorites" class="cabinet__nav-link">Избранное</a>
                    <a href="#settings" class="cabinet__nav-link">Настройки</a>
                </nav>
            </div>

            <div class="cabinet__main">
                <div class="cabinet__section" id="profile">
                    <h2 class="cabinet__section-title">Личная информация</h2>
                    <form class="cabinet__form">
                        <div class="cabinet__form-row">
                            <div class="cabinet__form-group">
                                <label class="cabinet__form-label">Имя</label>
                                <input type="text" class="cabinet__form-input" value="Юлия" required>
                            </div>
                            <div class="cabinet__form-group">
                                <label class="cabinet__form-label">Фамилия</label>
                                <input type="text" class="cabinet__form-input" value="К." required>
                            </div>
                        </div>
                        <div class="cabinet__form-group">
                            <label class="cabinet__form-label">Email</label>
                            <input type="email" class="cabinet__form-input" value="yulia@example.com" required>
                        </div>
                        <div class="cabinet__form-group">
                            <label class="cabinet__form-label">Телефон</label>
                            <input type="tel" class="cabinet__form-input" value="+7 (999) 123-45-67" required>
                        </div>
                        <div class="cabinet__form-group">
                            <label class="cabinet__form-label">Дата рождения</label>
                            <input type="date" class="cabinet__form-input" value="1990-01-01">
                        </div>
                        <button type="submit" class="cabinet__form-submit button button--accent">Сохранить изменения</button>
                    </form>
                </div>

                <div class="cabinet__section" id="tours" style="display: none;">
                    <h2 class="cabinet__section-title">Мои туры</h2>
                    <div class="cabinet__tours">
                        <div class="cabinet__tour-card">
                            <div class="cabinet__tour-image">
                                <img src="img/main/background.png" alt="Тур" class="cabinet__tour-img">
                            </div>
                            <div class="cabinet__tour-info">
                                <h3 class="cabinet__tour-title">Образовательный тур в Париж</h3>
                                <div class="cabinet__tour-date">15-22 марта 2024</div>
                                <div class="cabinet__tour-status cabinet__tour-status--confirmed">Подтвержден</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cabinet__section" id="bookings" style="display: none;">
                    <h2 class="cabinet__section-title">Бронирования</h2>
                    <div class="cabinet__bookings">
                        <p class="cabinet__empty">У вас пока нет активных бронирований</p>
                    </div>
                </div>

                <div class="cabinet__section" id="favorites" style="display: none;">
                    <h2 class="cabinet__section-title">Избранное</h2>
                    <div class="cabinet__favorites">
                        <p class="cabinet__empty">В избранном пока ничего нет</p>
                    </div>
                </div>

                <div class="cabinet__section" id="settings" style="display: none;">
                    <h2 class="cabinet__section-title">Настройки</h2>
                    <form class="cabinet__form">
                        <div class="cabinet__form-group">
                            <label class="cabinet__form-label">Изменить пароль</label>
                            <input type="password" class="cabinet__form-input" placeholder="Текущий пароль">
                            <input type="password" class="cabinet__form-input" placeholder="Новый пароль">
                            <input type="password" class="cabinet__form-input" placeholder="Подтвердите пароль">
                        </div>
                        <div class="cabinet__form-group">
                            <label class="cabinet__checkbox">
                                <input type="checkbox" class="cabinet__checkbox-input">
                                <span class="cabinet__checkbox-text">Получать уведомления по email</span>
                            </label>
                        </div>
                        <button type="submit" class="cabinet__form-submit button button--accent">Сохранить настройки</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
