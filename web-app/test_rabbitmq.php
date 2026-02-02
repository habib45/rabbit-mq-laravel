<?php

require_once __DIR__.'/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exception\AMQPIOException;

$host = 'my-rabbit';
$port = 5672;
$user = 'guest';
$password = 'guest';

try {
    $connection = new AMQPStreamConnection($host, $port, $user, $password);
    echo "Connection successful!\n";
    $connection->close();
} catch (AMQPIOException $e) {
    echo 'Connection failed: '.$e->getMessage()."\n";
}
