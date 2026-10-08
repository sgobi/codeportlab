<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

$project = App\Models\Project::first();
$user = App\Models\User::first();
$request = Illuminate\Http\Request::create('/admin/projects/' . $project->id . '/edit', 'GET');
$app->instance('request', $request);
auth()->guard('web')->setUser($user);

$response = $kernel->handle($request);
$content = $response->getContent();

preg_match_all('/<form\b[^>]*>/is', $content, $formMatches);
foreach ($formMatches[0] as $form) {
    echo "Form: " . $form . "\n";
}

// Also let's inspect the entire Save button HTML:
if (preg_match('/<button[^>]*>.*?Save changes.*?<\/button>/is', $content, $btn)) {
    echo "Full Save button:\n" . $btn[0] . "\n";
}
