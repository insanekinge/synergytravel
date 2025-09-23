<?php
// Expect $tour and $tours to be provided by the including page (e.g., public/product.php)
// Fallback: load data if not present
if (!isset($tours) || !is_array($tours)) {
    $ROOT = $_SERVER['DOCUMENT_ROOT'] . '/';
    $dataPath = $ROOT . 'data/tours.json';
    $tours = [];
    if (file_exists($dataPath)) {
        $json = file_get_contents($dataPath);
        $tours = json_decode($json, true) ?: [];
    }
}

$currentTour = isset($tour) && is_array($tour) ? $tour : null;
?>

<main class="cabinet cabinet--product">
    <div class="container">

        <div class="cabinet__top">
            <a href="/" class="cabinet__top-back"><img src="img/register/arrow-back.svg" alt="" class="cabinet__top-back_img">Вернуться на главную</a>

            <h1 class="cabinet__top-title">
                <?= htmlspecialchars($currentTour['title'] ?? 'Тур') ?>
            </h1>
        </div>

        <div class="cabinet__main">

            <div class="cabinet__main-side">

                <div class="cabinet__main-side_unique">

                    <div class="cabinet__main-side_unique-top">
                        <h2 class="cabinet__main-side_unique-top_title">Уникальные рекомендации</h2>
                        <div class="cabinet__main-side_unique-top_button">Смотреть подборку<img src="img/cabinet/arrow-back.svg" alt="" class="cabinet__main-side_unique-top_button-img"></div>
                    </div>
                    <div class="cabinet__main-side_unique-bottom">

                        <p class="cabinet__main-side_unique-bottom_description">Спланируйте поездку идеально походящую именно вам</p>
                        <ul class="cabinet__main-side_unique-list">
                            <li class="cabinet__main-side_unique-list_item"><img src="img/cabinet/fisrt.svg" alt="" class="cabinet__main-side_unique-list_item-img"></li>
                            <li class="cabinet__main-side_unique-list_item"><img src="img/cabinet/second.svg" alt="" class="cabinet__main-side_unique-list_item-img"></li>
                            <li class="cabinet__main-side_unique-list_item"><img src="img/cabinet/third.svg" alt="" class="cabinet__main-side_unique-list_item-img"></li>
                        </ul>
                    </div>


                </div>

                <div class="cabinet__main-side_question">

                    <h2 class="cabinet__main-side_question-title">Есть вопросы?</h2>
                    <p class="cabinet__main-side_question-description">Свяжитесь с нашим менеджером</p>

                    <a href="" class="cabinet__main-side_question-button">Оставить заявку</a>

                </div>

            </div>

            <div class="cabinet__main-tour">
                <div class="cabinet__main-tour_top">
                    <h2 class="cabinet__main-tour_top-title">О туре</h2>
                    <div class="cabinet__main-tour_top-option">
                        <p class="cabinet__main-tour_top-option_text">Информация о выбранном путешествии</p>
                    </div>
                </div>

                <div class="cabinet__main-tour_list">
                    <?php if ($currentTour): ?>
                        <?php if (!empty($currentTour['image'])): ?>
                            <div style="width:100%;height:240px;border-radius:30px;background:#f5f5f7;background-image:url('<?= htmlspecialchars($currentTour['image']) ?>');background-size:cover;background-position:center;margin-bottom:20px;"></div>
                        <?php endif; ?>
                        <?php if (!empty($currentTour['description'])): ?>
                            <p style="font-size:18px;line-height:150%;margin-bottom:16px;"><?= htmlspecialchars($currentTour['description']) ?></p>
                        <?php endif; ?>
                        <div style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:16px;">
                            <?php if (!empty($currentTour['type'])): ?>
                                <div style="background:#f3f3f6;border-radius:12px;padding:10px 14px;">Тип: <?= htmlspecialchars($currentTour['type']) ?></div>
                            <?php endif; ?>
                            <?php if (!empty($currentTour['duration'])): ?>
                                <div style="background:#f3f3f6;border-radius:12px;padding:10px 14px;">Длительность: <?= htmlspecialchars($currentTour['duration']) ?></div>
                            <?php endif; ?>
                            <?php if (isset($currentTour['price'])): ?>
                                <div style="background:#f3f3f6;border-radius:12px;padding:10px 14px;">Цена: <?= number_format((float)$currentTour['price'], 0, '.', ' ') ?> ₽</div>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($currentTour['details']) && is_array($currentTour['details'])): ?>
                            <ul style="display:grid;grid-template-columns:repeat(2,1fr);gap:10px;margin:0;padding:0;list-style:none;">
                                <?php foreach ($currentTour['details'] as $detail): ?>
                                    <li style="background:#f8f8fa;border-radius:12px;padding:12px 14px;font-size:16px;"><?= htmlspecialchars($detail) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="cabinet__main-tour_list-title">Тур не найден</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>
</main>

