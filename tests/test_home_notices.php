<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$html = file_get_contents('http://127.0.0.1:8000/');

echo "=== CHECKING HOMEPAGE NOTICES ===" . PHP_EOL;
echo "HTTP response length: " . strlen($html) . " bytes" . PHP_EOL;

// Check for official notices from rcu.edu.in
$expectedTitles = [
    'Central Facilities in University',
    'Advertisement for Admission to Ph.D.',
    'Ph.D. Application Form for Session 2025-26',
    '2nd Convocation held on 23th July, 2025',
    'Report on activities conducted for constitution day in RCU',
];

$allPassed = true;
foreach ($expectedTitles as $title) {
    if (str_contains($html, $title)) {
        echo "[PASS] Found live notice: '{$title}'" . PHP_EOL;
    } else {
        echo "[FAIL] Missing notice: '{$title}'" . PHP_EOL;
        $allPassed = false;
    }
}

// Check Column 3 RCU Official Updates
if (str_contains($html, 'RCU Official Updates') && str_contains($html, 'Source: rcu.edu.in')) {
    echo "[PASS] Column 3 'RCU Official Updates' widget and source link to rcu.edu.in present." . PHP_EOL;
} else {
    echo "[FAIL] Column 3 widget missing." . PHP_EOL;
    $allPassed = false;
}

// Check that mock notices do NOT exist on the homepage
$fakeTitles = [
    'Examination Form Submission Notice',
    'Semester Examination Schedule',
    'Admit Card Notice',
    'Result Declaration Notice',
    'Revaluation Form Notice',
    'College Attendance Notice',
];

$noFakes = true;
foreach ($fakeTitles as $fake) {
    if (str_contains($html, $fake)) {
        echo "[FAIL] Detected fake mock notice on homepage: '{$fake}'" . PHP_EOL;
        $noFakes = false;
    }
}

if ($noFakes) {
    echo "[PASS] No fake/mock seeded notices found on homepage." . PHP_EOL;
}

echo PHP_EOL . "=== CHECKING /notices PAGE ===" . PHP_EOL;
$noticesHtml = file_get_contents('http://127.0.0.1:8000/notices');
if (str_contains($noticesHtml, 'Central Facilities in University') && str_contains($noticesHtml, 'rcu.edu.in')) {
    echo "[PASS] /notices page successfully lists live circulars from rcu.edu.in" . PHP_EOL;
} else {
    echo "[FAIL] /notices page missing live circulars." . PHP_EOL;
    $allPassed = false;
}

echo PHP_EOL . "=== CHECKING /notices/{slug} PAGE ===" . PHP_EOL;
$noticeDetailHtml = file_get_contents('http://127.0.0.1:8000/notices/central-facilities-in-university');
if (str_contains($noticeDetailHtml, 'Central Facilities in University') && str_contains($noticeDetailHtml, 'https://www.rcu.edu.in/central-facilities/')) {
    echo "[PASS] Notice detail page loads with original university portal link" . PHP_EOL;
} else {
    echo "[FAIL] Notice detail page verification failed." . PHP_EOL;
    $allPassed = false;
}

echo PHP_EOL . "=== ALL TESTS: " . ($allPassed && $noFakes ? "SUCCESSFUL" : "FAILED") . " ===" . PHP_EOL;
