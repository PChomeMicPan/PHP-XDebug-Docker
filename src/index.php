<?php

$server = new OpenSwoole\HTTP\Server("0.0.0.0", 9501);

$server->on("start", function ($server) {
    echo "Swoole HTTP Server is started at http://0.0.0.0:9501\n";
});

$server->on("request", function ($request, $response) {
    $response->header("Content-Type", "application/json");
    $response->end(json_encode([
        'message' => 'Hello, OpenSwoole!'
    ]));
});

$server->start();
