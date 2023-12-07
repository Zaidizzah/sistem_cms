<?php
// Gabut buat quotes
$api_key = 'NF8sg3s4Ym1kIawKUUFRedOMQnACrGQLynwdTpHx';
$url = 'https://quotes.rest/qod.json?category=inspire&lang=id';

$options = [
    'http' => [
        'header' => "Authorization: Bearer $api_key\r\n"
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);
echo $response;