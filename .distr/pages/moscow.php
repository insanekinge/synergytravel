<?php
// Load tour data for Moscow
$tourSlug = 'moscow';
$tours = [];
$tour = null;

// Load tours data
$dataPath = dirname(__DIR__) . '/blocks/tour/tours-data.json';
if (file_exists($dataPath)) {
    $json = file_get_contents($dataPath);
    $tours = json_decode($json, true) ?: [];
    
    // Find tour by slug
    foreach ($tours as $t) {
        if (isset($t['slug']) && $t['slug'] === $tourSlug) {
            $tour = $t;
            break;
        }
    }
}

$title = $tour ? $tour['title'] . ' - Synergy Travel' : 'Тур не найден';
$description = $tour ? $tour['description'] : 'Страница тура не найдена';

// Include base template variables
$ROOT = $_SERVER['DOCUMENT_ROOT'] . '/';
$BASE_HREF = '//' . $_SERVER['HTTP_HOST'] . (!empty($_SERVER['DOCUMENT_URI']) ? str_replace( substr(str_replace('index.php', '', $_SERVER['DOCUMENT_URI']), 1), '', $_SERVER['REQUEST_URI'] ) : '');
$URL = '//' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$version = isset($_GET['version']) ? urldecode( strtolower($_GET['version']) ) : '';
$partner = isset($_GET['partner']) ? urldecode( strtolower($_GET['partner']) ) : '';
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <base href="<?=$BASE_HREF?>">

  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <meta name="description" content="<?= htmlspecialchars($description) ?>">
  <title><?= htmlspecialchars($title) ?></title>
  <meta property="og:title" content="<?= htmlspecialchars($title) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($description) ?>">
  <meta property="og:url" content="//<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>">

	<!-- Raleway 600 font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@600&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://cdn.synergy.ru/libs/bootstrap/bootstrap-4.5.2.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <link rel="stylesheet" href="https://cdn.synergy.ru/libs/fancybox/jquery.fancybox-3.5.7.min.css" />
  <link rel="stylesheet" href="https://cdn.synergy.ru/libs/swiper/swiper-5.4.5.min.css" />

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">

	<link href="https://synergy.ru/img/favicon.ico" type="image/x-icon" rel="icon">
	<link href="https://synergy.ru/img/favicon.ico" type="image/x-icon" rel="shortcut icon">

</head>

<body class="<?= $version ? 'version-' . $version : '' ?>" id="body">
  <div class="wrapper">
  
    <?php include dirname(__DIR__) . '/blocks/header/block.php'; ?>
  
    <main class="cabinet cabinet--product">
      <div class="container">

          <div class="cabinet__top">
              <a href="/" class="cabinet__top-back"><img src="img/register/arrow-back.svg" alt="" class="cabinet__top-back_img">Вернуться на главную</a>

              <h1 class="cabinet__top-title">
                  <?= htmlspecialchars($tour ? $tour['title'] : 'Тур не найден') ?>
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
                      <?php if ($tour): ?>
                          <?php if (!empty($tour['image'])): ?>
                              <div style="width:100%;height:240px;border-radius:30px;background:#f5f5f7;background-image:url('<?= htmlspecialchars($tour['image']) ?>');background-size:cover;background-position:center;margin-bottom:20px;"></div>
                          <?php endif; ?>
                          
                          <?php if (!empty($tour['description'])): ?>
                              <p style="font-size:18px;line-height:150%;margin-bottom:16px;"><?= htmlspecialchars($tour['description']) ?></p>
                          <?php endif; ?>
                          
                          <div style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:16px;">
                              <?php if (!empty($tour['type'])): ?>
                                  <div style="background:#f3f3f6;border-radius:12px;padding:10px 14px;">Тип: <?= htmlspecialchars($tour['type']) ?></div>
                              <?php endif; ?>
                              <?php if (!empty($tour['duration'])): ?>
                                  <div style="background:#f3f3f6;border-radius:12px;padding:10px 14px;">Длительность: <?= htmlspecialchars($tour['duration']) ?></div>
                              <?php endif; ?>
                              <?php if (isset($tour['price'])): ?>
                                  <div style="background:#f3f3f6;border-radius:12px;padding:10px 14px;">Цена: <?= number_format((float)$tour['price'], 0, '.', ' ') ?> ₽</div>
                              <?php endif; ?>
                          </div>
                          
                          <?php if (!empty($tour['details']) && is_array($tour['details'])): ?>
                              <ul style="display:grid;grid-template-columns:repeat(2,1fr);gap:10px;margin:0;padding:0;list-style:none;">
                                  <?php foreach ($tour['details'] as $detail): ?>
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
    
    <?php include dirname(__DIR__) . '/blocks/footer/block.php'; ?>

    <section class="popups" hidden></section>
    <a href="http://sydi.ru" style="display: none">Synergy Digital</a>

  </div>

  <script src="https://cdn.synergy.ru/libs/jquery/jquery-3.4.1.js"></script>
  <script src="https://cdn.synergy.ru/libs/fancybox/jquery.fancybox-3.5.7.min.js"></script>
  <script src="https://cdn.synergy.ru/libs/swiper/swiper-5.4.5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="https://syn.su/js/lander.js?v=2" defer="defer"></script>
  <script src="js/main.js"></script>
  <script src="js/product.js"></script>

</body>
</html>