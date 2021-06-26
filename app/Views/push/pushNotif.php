<?php
// require APPPATH . 'vendor/autoload.php';
// require_once "/push/vendor/autoload.php";
require_once "vendor/autoload.php";
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

require_once "connected.php";

// $sql = $link->query("SELECT * FROM tb_subscribers");
$sql = "SELECT * FROM tb_subscribers";
$result = mysqli_query($link, $sql);
$subscriptions = [];

while($row = mysqli_fetch_assoc($result))
{
    $endpoints = '{"endpoint":"'. $row['endpoints'] .'","expirationTime":null,"keys":{"auth":"' . $row['auth'] . '","p256dh":"' . $row['p256dh'] . '"}}';
    // $endpoints = '{"endpoint":"'. $row['endpoints'] .'","expirationTime":null,"keys":{"p256dh":"' . $row['p256dh'] . '","auth":"' . $row['auth'] . '"}}';
    $subscriptions[] = Subscription::create(json_decode($endpoints, true));
}

$payload = 'Pasti Bisa Nyook!';

$auth = [
    'VAPID' => [
        'subject' => 'mailto:mufadil98@gmail.com', // can be a mailto: or your website address
        'publicKey' => 'BHugL3rwhWzHwhmHW14GmXLeKesJdVr2mZ7bmm1ZFplknHj8sTjrW3T-cXGYn8zAZJn-HWMN5Aiulwg1PNf_jXE', // (recommended) uncompressed public key P-256 encoded in Base64-URL
        'privateKey' => '-QIJ_6d2Wg50ZJewUD0MjEbmhW85pJj4wYf16uZ9Goo', // (recommended) in fact the secret multiplier of the private key encoded in Base64-URL
    ],
];

$webPush = new WebPush($auth);

// Send to one Endpoint
// $res = $webPush->sendOneNotification($subscription, $payload, ['TTL' => 5000]);

//Send to multiple Endpoints
foreach ($subscriptions as $sub)
{
    $res = $webPush->queueNotification($sub, $payload, ['TTL' => 5000]);
    // $res = $webPush->sendOneNotification($sub, $payload, ['TTL' => 5000]);

}

foreach ($webPush->flush() as $report) {
    $endpoint = $report->getRequest()->getUri()->__toString();

    if ($report->isSuccess()) {
        echo "[v] Pesan sukses terkirim ke subscription {$endpoint}. <br>";
    } else {
        echo "[x] Pesan tidak terkirim ke subscription {$endpoint}: {$report->getReason()}";
    }
}

?>
<!-- <script>window.location.replace("push.html");</script> -->
