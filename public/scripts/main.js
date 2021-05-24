/*
 *
 *  Push Notifications codelab
 *  Copyright 2015 Google Inc. All rights reserved.
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *      https://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License
 *
 */

/* eslint-env browser, es6 */
//importScripts('https://cdn.onesignal.com/sdks/OneSignalSDKWorker.js');

'use strict';

if (!window.top.aspkey) {
    throw new Error('missing a public key');
}
const applicationServerPublicKey = window.top.aspkey;

const pushButton = document.querySelector('#push');

let isSubscribed = false;
let swRegistration = null;

function urlB64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');

    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);

    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}

if ('serviceWorker' in navigator && 'PushManager' in window) {
    console.log('Service Worker and Push is supported');

    navigator.serviceWorker.register('pwabuilder-sw.js')
        .then(function(swReg) {
            console.log('Service Worker is registered', swReg);

            swRegistration = swReg;
            initializeUI();
        })
        .catch(function(error) {
            console.error('Service Worker Error', error);
        });
} else {
    console.warn('Push messaging is not supported');
    pushButton.textContent = 'Push Not Supported';
}

function initializeUI() {
    pushButton.addEventListener('click', function() {
        pushButton.disabled = true;
        if (isSubscribed) {
            // TODO: Unsubscribe user
            unsubscribeUser();
        } else {
            subscribeUser();
        }
    });

    // Set the initial subscription value
    swRegistration.pushManager.getSubscription()
        .then(function(subscription) {
            isSubscribed = !(subscription === null);

            if (isSubscribed) {
                console.log('User IS subscribed.');
            } else {
                console.log('User is NOT subscribed.');
            }

            updateBtn();
        });
}

function status() {

}

function updateBtn() {
    if (Notification.permission === 'denied') {
        pushButton.textContent = 'Push Messaging Blocked.';
        pushButton.disabled = true;
        updateSubscriptionOnServer(null);
        return;
    }

    if (isSubscribed) {
        pushButton.textContent = 'ON';
    } else {
        pushButton.textContent = 'OFF';
    }

    pushButton.disabled = false;
}

function subscribeUser() {
    const applicationServerKey = urlB64ToUint8Array(applicationServerPublicKey);
    swRegistration.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: applicationServerKey
        })
        .then(function(subscription) {
            localStorage.setItem("myStatus", 1);
            console.log('User is subscribed.');
            console.log(localStorage.getItem('myStatus'));

            updateSubscriptionOnServer(subscription);

            isSubscribed = true;

            updateBtn();
        })
        .catch(function(err) {
            console.log('Failed to subscribe the user: ', err);
            updateBtn();
        });
}

function unsubscribeUser() {
    //Unsub Server
    swRegisteration.pushManager.getSubscription()
        .then(function(subscription) {
            if (subscription) {
                const key = subscription.getKey('p256dh');
                const token = subscription.getKey('auth');
                fetch('codeigniter/app/Views/setting.php', {
                    method: 'post',
                    headers: new Headers({
                        'Content-Type': 'application/json'
                    }),
                    body: JSON.stringify({
                        endpoint: subscription.endpoint,
                        key: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('p256dh')))) : null,
                        token: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('auth')))) : null,
                        axn: 'unsubscribe'
                    })
                }).then(function(response) {
                    return response.text();
                }).then(function(response) {
                    console.log(response);
                }).catch(function(e) {
                    console.log('remove from db error', e);
                });
            }
        })

    //Unsub local
    navigator.serviceWorker.ready.then(function(reg) {
        reg.pushManager.getSubscription()
            .then(function(subscription) {
                subscription.unsubscribe()
                    .then(function(success) {
                        console.log("succussfuly unsubscribed", success)
                        isSubscribed = false;
                        updateBtn();
                    })
            })
            .catch(function(err) {
                console.log('error to unsub', err)
            })
    });
}

function updateSubscriptionOnServer(subscription) {
    // TODO: Send subscription to application server
    const subscriptionJson = document.querySelector('#subscription-json');
    // const subscriptionDetails =
    //     document.querySelector('.js-subscription-details');

    if (subscription) {
        const key = subscription.getKey('p256h');
        const token = subscription.getKey('auth');
        subscriptionJson.textContent = JSON.stringify(subscription);
        subscriptionDetails.classList.remove('is-invisible');

        fetch('codeigniter/app/Views/setting.php', {
                method: 'post',
                headers: new Headers({
                    'Content-Type': 'application/json'
                }),
                body: JSON.stringify({
                    endpoint: subscription.endpoint,
                    key: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('pe56h')))) : null,
                    token: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('auth')))) : null,
                    axn: 'subscribe'
                })
            })
            .then(function(response) {
                return response.text();
            }).then(function(response) {
                console.log(response);
            }).catch(function(err) {
                // Error :(
                console.log('error');
            });
    } else {
        //subscriptionDetails.classList.add('is-invisible');
    }
}

const sendPushButton = document.querySelector('#send-push');
// if (!sendPushButton) {
//     throw new error();
// }

sendPushButton.addEventListener('click', () =>
    navigator.serviceWorker.ready
    .then(serviceWorkerRegistration => serviceWorkerRegistration.pushManager.getSubscription())
    .then(subscription => {
        if (!subscription) {
            alert('Please enable push notifications');
            return;
        }

        const key = subscription.getKey('p256dh');
        const token = subscription.getKey('auth');
        console.log('here');
        fetch('codeigniter/app/Views/content/pushNotif.php', {
            method: 'post',
            body: JSON.stringify({
                endpoint: subscription.endpoint,
                key: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('p256dh')))) : null,
                token: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('auth')))) : null
            })
        })
    })
);

// function updateSubscriptionOnServer(subscription) {
//     // TODO: Send subscription to application server

//     const subscriptionJson = document.querySelector('.js-subscription-json');
//     const subscriptionDetails =
//         document.querySelector('.js-subscription-details');

//     if (subscription) {
//         subscriptionJson.textContent = JSON.stringify(subscription);
//         subscriptionDetails.classList.remove('is-invisible');
//     } else {
//         subscriptionDetails.classList.add('is-invisible');
//     }
// }


//push notif massage for file
// navigator.serviceWorker.onmessage = (event) => {
//     const file = event.data.file; 
// }

// //sharing file handle
// function handleFileShare(event){
//     event.respondWith(Response.redirect('https://fadil.website/shareTarget/formtambah/#upload'));

//     event.waitUntil(async function ()){
//         const data = await event.request.formData(); 
//         const client = await self.clients.get(event.resultingClientId); 
//         const file = data.get('files'); 
//     }()); 
// }