<?php

require('vendor/autoload.php');

use \PhpMqtt\Client\MqttClient;
use \PhpMqtt\Client\ConnectionSettings;

// $server   = 'broker.emqx.io';
// $port     = 1883;
// $clientId = rand(5, 15);
// $username = 'emqx_user';
// $password = 'public';
// $clean_session = false;
// $mqtt_version = MqttClient::MQTT_3_1_1;

$server   = 'b640d01b49d941d2b31357719f7ee013.s2.eu.hivemq.cloud';
$port     = 8883;
$clientId = 'clientId-8nzXKeEp7P';
$username = 'supercode';
$password = 'asdasd123';
$clean_session = true;
$mqtt_version = MqttClient::MQTT_3_1;

$connectionSettings = (new ConnectionSettings)
    ->setConnectTimeout(10)
    ->setUsername($username)
    ->setPassword($password)
    ->setUseTls(true)
    ->setTlsSelfSignedAllowed(true)
    ->setKeepAliveInterval(60);


$mqtt = new MqttClient($server, $port, $clientId, $mqtt_version);

$mqtt->connect($connectionSettings, $clean_session);
printf("client connected\n");

$mqtt->subscribe('#', function ($topic, $message) {
    printf("Received message on topic [%s]: %s\n", $topic, $message);
}, 0);

// for ($i = 0; $i < 10; $i++) {
//     $payload = array(
//         'protocol' => 'ssl',
//         'date' => date('Y-m-d H:i:s'),
//         'url' => 'https://github.com/emqx/MQTT-Client-Examples'
//     );
//     $mqtt->publish(
//         // topic
//         'superlog/V12WWL314GHJ',
//         // payload
//         json_encode($payload),
//         // qos
//         0,
//         // retain
//         true
//     );
//     printf("msg $i send\n");
//     sleep(1);
// }

$mqtt->loop(true);
