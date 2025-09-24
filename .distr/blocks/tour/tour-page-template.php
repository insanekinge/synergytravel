<?php
// Universal tour page template
// Usage: include this file with $tourSlug variable set

if (!isset($tourSlug)) {
    die('Tour slug not specified');
}

// Load tour data
$tours = [];
$tour = null;

// Load tours data
$dataPath = __DIR__ . '/tours-data.json';
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

// Function to render tour content
function renderTourContent($tour) {
    if (!$tour) {
        return '<p class="cabinet__main-tour_list-title">Тур не найден</p>';
    }
    
    $content = '';
    
    // Image
    if (!empty($tour['image'])) {
        $content .= '<div style="width:100%;height:240px;border-radius:30px;background:#f5f5f7;background-image:url(\'' . htmlspecialchars($tour['image']) . '\');background-size:cover;background-position:center;margin-bottom:20px;"></div>';
    }
    
    // Description
    if (!empty($tour['description'])) {
        $content .= '<p style="font-size:18px;line-height:150%;margin-bottom:16px;">' . htmlspecialchars($tour['description']) . '</p>';
    }
    
    // Info badges
    $content .= '<div style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:16px;">';
    if (!empty($tour['type'])) {
        $content .= '<div style="background:#f3f3f6;border-radius:12px;padding:10px 14px;">Тип: ' . htmlspecialchars($tour['type']) . '</div>';
    }
    if (!empty($tour['duration'])) {
        $content .= '<div style="background:#f3f3f6;border-radius:12px;padding:10px 14px;">Длительность: ' . htmlspecialchars($tour['duration']) . '</div>';
    }
    if (isset($tour['price'])) {
        $content .= '<div style="background:#f3f3f6;border-radius:12px;padding:10px 14px;">Цена: ' . number_format((float)$tour['price'], 0, '.', ' ') . ' ₽</div>';
    }
    $content .= '</div>';
    
    // Details
    if (!empty($tour['details']) && is_array($tour['details'])) {
        $content .= '<ul style="display:grid;grid-template-columns:repeat(2,1fr);gap:10px;margin:0;padding:0;list-style:none;">';
        foreach ($tour['details'] as $detail) {
            $content .= '<li style="background:#f8f8fa;border-radius:12px;padding:12px 14px;font-size:16px;">' . htmlspecialchars($detail) . '</li>';
        }
        $content .= '</ul>';
    }
    
    return $content;
}
?>