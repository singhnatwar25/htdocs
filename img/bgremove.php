<?php
$client = new GuzzleHttp\Client();
$res = $client->post('https://api.remove.bg/v1.0/removebg', [
    'multipart' => [
        [
            'name'     => 'image_file',
            'contents' => fopen('img/', 'r')
        ],
        [
            'name'     => 'size',
            'contents' => 'auto'
        ]
    ],
    'headers' => [
        'X-Api-Key' => '1aYjLrZoZTQPbjmCeeapeFWN'
    ]
]);

$fp = fopen("no-bg.png", "wb");
fwrite($fp, $res->getBody());
fclose($fp);
?>