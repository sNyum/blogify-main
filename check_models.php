<?php
$env = file_get_contents('.env');
preg_match('/GEMINI_API_KEY=(.*)/', $env, $matches);
$key = trim($matches[1]);
echo "Using Key: " . substr($key, 0, 10) . "...\n";
$url = "https://generativelanguage.googleapis.com/v1beta/models?key=" . $key;
$response = @file_get_contents($url);
if ($response === false) {
    echo "Error fetching models.\n";
    print_r(error_get_last());
} else {
    echo $response;
}
