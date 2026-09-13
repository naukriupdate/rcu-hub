<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$urls = [
    '/' => 200,
    '/resources' => 200,
    '/resources/bca/semester-3/java/bca-java-notes' => 200,
    '/notices' => 200,
    '/courses' => 200,
    '/courses/bca' => 200,
    '/important-links' => 200,
    '/about' => 200,
    '/contact' => 200,
    '/privacy-policy' => 200,
    '/terms-and-conditions' => 200,
    '/disclaimer' => 200,
    '/login' => 200,
    '/register' => 200,
    '/admin/login' => 200,
    '/admin' => 302,
    '/api/academic/programs?department_id=1' => 200,
    '/resources?type=pyq' => 200,
    '/resources?type=notes' => 200,
    '/resources?type=1' => 200,
    '/resources?course=bca' => 200,
    '/resources?course=1' => 200,
    '/resources?semester=3' => 200,
    '/resources?semester=semester-3' => 200,
    '/resources?course=bca&semester=3&type=pyq' => 200,
];

$allPassed = true;
foreach ($urls as $url => $expectedCode) {
    $request = Illuminate\Http\Request::create($url, 'GET');
    $response = $kernel->handle($request);
    $status = $response->getStatusCode();
    
    if ($status === $expectedCode) {
        echo "✓ [PASS] {$url} => {$status}\n";
    } else {
        echo "✗ [FAIL] {$url} => Expected {$expectedCode}, got {$status}\n";
        $allPassed = false;
    }
}

if ($allPassed) {
    echo "\nAll route verification tests passed successfully!\n";
    exit(0);
} else {
    echo "\nSome route verification tests failed.\n";
    exit(1);
}
