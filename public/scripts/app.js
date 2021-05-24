// if(!window.top.aspkey){
// 	throw new Error('missing a public key');
// }

// const applicationServerPublicKey = window.top.aspkey;

const applicationServerPublicKey = 'BJlUku8xMes1Nw5E3CRyJJF0pZRP4Gx3kcJ5P5Jb4Yz96cplFuax21181bM6DCHM7iictygXUDZaX9Gb6JjsCyc'

const pushButton = document.querySelector('#push');

let isSubscribed = false;
let swRegistration = null;

var clickButton = document.createElement('button');

//var simpan = simpanData();

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

    navigator.serviceWorker
        .register('/sw.js')
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
                console.log('User is subscribed.');
            } else {
                console.log('User is NOT subscribed.');
            }

            updateBtn();
        });
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
        // console.log(localStorage.getItem("currentStatus"));
        // if (localStorage.getItem("currentStatus") !== 0) {

        // }
    } else {
        pushButton.textContent = 'OFF';
        localStorage.removeItem("currentStatus");
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
            // localStorage.setItem("currentStatus", "ON");
            console.log('User is subscribed.');
            updateSubscriptionOnServer(subscription);
            isSubscribed = true;
            // if (localStorage.getItem("currentStatus") === 1) {
            //     pushButton.disabled = true;
            // }

            updateBtn();
        })
        .catch(function(err) {
            console.log('Failed to subscribe the user: ', err);
            updateBtn();
        });
}

function unsubscribeUser() {
    swRegistration.pushManager.getSubscription()
        .then(function(subscription) {
            if (subscription) {
                // const key = subscription.p256dh;
                // const token = subscription.auth;
                // localStorage.setItem("currentStatus", "");
                const key = subscription.getKey('p256dh');
                const token = subscription.getKey('auth');
                fetch('simpandata', {
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
                    })
                    // .then(function(response) {
                    //     return response.text();
                    // }).then(function(response) {
                    //     console.log(response);
                    // })
                    .catch(function(e) {
                        console.log('remove from db error', e);
                        //throw new error('error removing from db');
                    });
                //return
                //return subscription.unsubscribe();
            }
        })
        // .catch(function(error) {
        //     console.log('Error unsubscribing', error);
        // })
        // .then(function() {
        //     updateSubscriptionOnServer(null);
        //     console.log('User is unsubribed.');
        //     isSubscribed = false;
        //     updateBtn();
        // });

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
    const subscriptionJson = document.querySelector('.js-subscription-json');
    const subscriptionDetails = document.querySelector('.subscription-details');

    if (subscription) {
        //const endpoint = subscription.endpoint;
        const key = subscription.getKey('p256dh');
        const token = subscription.getKey('auth');
        subscriptionJson.textContent = JSON.stringify(subscription);
        subscriptionDetails.classList.remove('is-invisible');

        fetch('simpandata', {
                method: 'post',
                headers: new Headers({
                    'Content-Type': 'application/json'
                }),
                body: JSON.stringify({
                    endpoint: subscription.endpoint,
                    key: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('p256dh')))) : null,
                    token: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('auth')))) : null,
                    axn: 'subscribe'
                })

            })
            // .then(function(response) {
            //     return response.text();
            // }).then(function(response) {
            //     console.log(response);
            // })
            .catch(function(err) {
                // Error :(
                console.log('error', err);
            });
        // } else {
        //     subscriptionDetails.classList.add('is-invisible');
    }
}

// klik langsung muncul notifikasi

// const sendPushButton = document.querySelector('#push-send');
// if (!sendPushButton) {
//     throw new error();
// }

// sendPushButton.addEventListener('click', () =>
//     navigator.serviceWorker.ready
//     .then(serviceWorkerRegistration => serviceWorkerRegistration.pushManager.getSubscription())
//     .then(subscription => {
//         if (!subscription) {
//             alert('Please enable push notifications');
//             return;
//         }

//         var key = subscription.getKey('p256dh');
//         var token = subscription.getKey('auth');
//         console.log('here');
//         fetch('sendAll', {
//             method: 'post',
//             body: JSON.stringify({
//                 endpoint: subscription.endpoint,
//                 key: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('p256dh')))) : null,
//                 token: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('auth')))) : null
//             })
//         })
//     })
// );