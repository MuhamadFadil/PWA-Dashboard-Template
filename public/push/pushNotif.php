<?php
require __DIR__ . '/push/vendor/autoload.php';
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

require_once "connected.php";

$sql = "SELECT * FROM subscriber";
$result = mysqli_query($link, $sql);
$subscriptions = [];

while($row = mysqli_fetch_assoc($result))
{
    $endpoints = '{"endpoint":"'. $row['endpoints'] .'","expirationTime":null,"keys":{"auth":"' . $row['auth'] . '","p256dh":"' . $row['p256dh'] . '"}}';
    $subscriptions[] = Subscription::create(json_decode($endpoints, true));
}

$payload = 'Pasti Bisa Nyook!';

$auth = [
    'VAPID' => [
        'subject' => 'mailto:SCR@ui.ac.id', // can be a mailto: or your website address
        'publicKey' => 'BBQZL_zQJoDYkD3RMzBw6wAPF6jh_x9SmMs9Zryzwc5gkqNDp0IEaTsJi2eKPkHCTeHNckLwiaLqP8SIs49SxGw', // (recommended) uncompressed public key P-256 encoded in Base64-URL
        'privateKey' => 'IMT1lXF5ddFjpee7RRGGiL32QKj4h9RO_tF3--_s7cg', // (recommended) in fact the secret multiplier of the private key encoded in Base64-URL
    ],
];

$webPush = new WebPush($auth);

// Send to one Endpoint
// $res = $webPush->sendOneNotification($subscription, $payload, ['TTL' => 5000]);

//Send to multiple Endpoints
foreach ($subscriptions as $sub)
{
    $res = $webPush->queueNotification($sub, $payload, ['TTL' => 5000]);

}

foreach ($webPush->flush() as $report) {
    $endpoint = $report->getRequest()->getUri()->__toString();

    if ($report->isSuccess()) {
        echo "[v] Message sent successfully for subscription {$endpoint}. <br>";
    } else {
        echo "[x] Message failed to sent for subscription {$endpoint}: {$report->getReason()}";
    }
}

?>
<!-- <script>window.location.replace("push.html");</script> -->
