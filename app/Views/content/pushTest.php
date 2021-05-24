<?php

require APPPATH . 'views/vendor/autoload.php';
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

// array of notifications
// $notifications = [
    // [
    //     'subscription' => Subscription::create([
    //         'endpoint' => 'https://wns2-sg2p.notify.windows.com/w/?token=BQYAAACGAQxWrmhkOMSZ%2fkLe0WcVHus%2fGYxOOiOU80BeRBwBoa%2bvBN%2b51l0SDTI5fJ2OFzfMJpdekfbCPik5s5tt8i0hB516txMAZwrQVlC9nazM4rN0EZnx8f9W8YiRAmFS7vBHVys1xmTMsXLdmZCm7cuNR1hpORLYq43vo%2fxTOCYRlIaw8EDzIAS0aZR%2bvbFlA7HtJV%2b7gl5jz1JvkEN99pA6lBo9RyzAWdZDLYWFt0DbqtlwcmqNV16VNh8T2xphR9wO7K2SKaavUP3q4kNCqzm6mjJZ1%2f%2bKvkoDL4HQGX0%2fdoVGEQs%2foPMz70qNr6PbS7E%3d', // Firefox 43+,
    //         'publicKey' => 'BLpNIoOvpb9YhFuAXrgtW_kytZGOZVUuPcIcSCiSFR-iREuxVf0tHx0DWlkULmw6itQQP1sG7MKilSZFRJcRIkk', // base 64 encoded, should be 88 chars
    //         'authToken' => '1u6zGW8DLlC7_m1sbmqbYg', // base 64 encoded, should be 24 chars
    //     ]),
    //     'payload' => 'hello !',
    //  ], 
    // [
    //       'subscription' => Subscription::create([ // this is the structure for the working draft from october 2018 (https://www.w3.org/TR/2018/WD-push-api-20181026/) 
    //           "endpoint" => "https://fcm.googleapis.com/fcm/send/cvslYPtjsMI:APA91bEEoUzhvtVPPhgbzYczY_aelVTsTVi8tWIstU2nlxubQ-XODHSoli-Gujc4RjbxbD2bbW0Ygf-xZ-KG-PH75FimKtjhrh6Nr42xN__CjXkDFidrzJCiq1K5g04i8TmBFXloAK9J",
    //           "keys" => [
    //               'p256dh' => 'BGGRDECAmT4h80kJ9Le_uqsNkjaNXW-Wgs8cp7khHDIKVf5otBmMy1wsQ9pjUsHyf2mG2qEG_HSreM1SS8tptEc',
    //               'auth' => 'WD5wdBU6fQk4Rlny-dYHbQ'
    //           ],
    //       ]),
    //       'payload' => '{"msg":"Hello World!"}',
    //   ],
// ];

$payload = 'Tanggal Cuti Bersama Direvisi!';

//Multiple Endpoints
$endpoint_1 = '{"endpoint":"https://wns2-sg2p.notify.windows.com/w/?token=BQYAAACGAQxWrmhkOMSZ%2fkLe0WcVHus%2fGYxOOiOU80BeRBwBoa%2bvBN%2b51l0SDTI5fJ2OFzfMJpdekfbCPik5s5tt8i0hB516txMAZwrQVlC9nazM4rN0EZnx8f9W8YiRAmFS7vBHVys1xmTMsXLdmZCm7cuNR1hpORLYq43vo%2fxTOCYRlIaw8EDzIAS0aZR%2bvbFlA7HtJV%2b7gl5jz1JvkEN99pA6lBo9RyzAWdZDLYWFt0DbqtlwcmqNV16VNh8T2xphR9wO7K2SKaavUP3q4kNCqzm6mjJZ1%2f%2bKvkoDL4HQGX0%2fdoVGEQs%2foPMz70qNr6PbS7E%3d","expirationTime":null,"keys":{"p256dh":"BEObnyrtcgP_mZpjF8yNRJi2oDtxqi27OnSxfYLEBOHVhFUHEDb8Sgvo821YUkbwv3DDJPN_-hHEAIQcUb9NFnQ","auth":"bdjSlPrBmbU26-6vOcbZzA"}}';

$notifications = [
    Subscription::create(json_decode($endpoint_1,true)),
    //Subscription::create(json_decode($endpoint_2,true)),
    //Subscription::create(json_decode($endpoint_3,true))
];

$webPush = new WebPush();

// $webPush = new WebPush();

// send multiple notifications with payload
foreach ($notifications as $notification) {
    // $webPush->queueNotification(
    //     //$notification['subscription'],
    //     $notification['Subscription'] // optional (defaults null)
    // );

    $res = $webPush->queueNotification($notification, $payload, ['TTL' => 5000]);
}

/**
 * Check sent results
 * @var MessageSentReport $report
 */
foreach ($webPush->flush() as $report) {
    $endpoint = $report->getRequest()->getUri()->__toString();

    if ($report->isSuccess()) {
        echo "[v] Message sent successfully for subscription {$endpoint}.";
    } else {
        echo "[x] Message failed to sent for subscription {$endpoint}: {$report->getReason()}";
    }
}

/**
 * send one notification and flush directly
 * @var MessageSentReport $report
 */
// $report = $webPush->sendOneNotification(
//     $notifications[0]['subscription'],
//     $notifications[0]['payload'] // optional (defaults null)
// );