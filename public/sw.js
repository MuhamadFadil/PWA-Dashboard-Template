self.addEventListener('push', function(event) {
    console.log('[Service Worker] Push Received.');
    console.log(`[Service Worker] Push had this data: "${event.data.text()}"`);

    const title = 'PWA DashBoard';
    const options = {
        body: 'Selamat Menikmati Layanan Kami',
        icon: 'images/icon-notif.png',
        badge: 'images/badge.png'
    };

    event.waitUntil(self.registration.showNotification(title, options));
});

self.addEventListener('notificationclick', function(event) {
    console.log('[Service Worker] Notification click Received.');

    event.notification.close();

    event.waitUntil(
        clients.openWindow('https://developers.google.com/web/')
    );
});

// self.addEventListener('pushsubscriptionchange', function(event) {
//     console.log('[Service Worker]: \'pushsubscriptionchange\' event fired.');
//     const applicationServerKey = urlB64ToUint8Array(applicationServerPublicKey);
//     event.waitUntil(
//         self.registration.pushManager.subscribe({
//             userVisibleOnly: true,
//             applicationServerKey: applicationServerKey
//         })
//         .then(function(newSubscription) {
//             // TODO: Send to application server
//             console.log('[Service Worker] New subscription: ', newSubscription);
//         })
//     );
// });