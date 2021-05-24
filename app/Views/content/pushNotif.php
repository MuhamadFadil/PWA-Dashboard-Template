<?php
require APPPATH . 'views/vendor/autoload.php';
// require_once "vendor/autoload.php";
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

require_once "connected.php";
// $this-> db = db_connect();

$sql = "SELECT *FROM subscribers";
$result = mysqli_query($link, $sql);
$subscriptions = [];

while($kol = mysqli_fetch_array($result))
{
    // $endpoints = [
    //     "endpoint" => $row['endpoints'],
    //     "expirationTime" => null,
    //     "keys" => [
    //         "p256dh" => $row['p256dh'],
    //         "auth" => $row['auth']
    //         ],
    // ];
    // $endpoints = '{"id_user":"'.$row['id_user'] . '"name_user":"'.$row['name_user'] .'"kota_user":"'.$row['kota_user'] . '"endpoint":"'. $row['endpoints'] .'","expirationTime":null,"keys":{"auth":"' . $row['auth'] . '","p256dh":"' . $row['p256dh'] . '"}}';
    // $endpoints = '{"endpoint":"'. $row['endpoints'] .'","expirationTime":null,"keys":{"auth":"' . $row['auth'] . '","p256dh":"' . $row['p256dh'] . '"}}';
    $endpoints = '{"endpoint":"'. $kol['endpoints'] .'","expirationTime":null,"keys":{"p256dh":"' . $kol['p256dh'] . '","auth":"' . $kol['auth'] . '"}}';
    $subscriptions[] = Subscription::create(json_decode($endpoints, true));
}

$payload = 'Pasti Bisa Nyook!';

// $publickey = 'BOE99lvdjCbHi6nI17XW76tG_X4lzuZYo3cPfwhqdcSSMKcyMNVcpnT3VbNkUBtoZuuul5NX3Xh3S7vTa0eGt0U',
// $privatekey = 'ufRraaod9VVDblESL-oabmV0SsOXFxm03bIr-kK7Aq8'

$auth = [
    'VAPID' => [
        'subject' => 'https://fadil.website', // can be a mailto: or your website address
        'publicKey' => 'BOE99lvdjCbHi6nI17XW76tG_X4lzuZYo3cPfwhqdcSSMKcyMNVcpnT3VbNkUBtoZuuul5NX3Xh3S7vTa0eGt0U', // (recommended) uncompressed public key P-256 encoded in Base64-URL
        'privateKey' => 'ufRraaod9VVDblESL-oabmV0SsOXFxm03bIr-kK7Aq8', // (recommended) in fact the secret multiplier of the private key encoded in Base64-URL
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
