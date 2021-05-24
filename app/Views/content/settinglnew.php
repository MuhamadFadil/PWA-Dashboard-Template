<?php echo view("parts/header");
//echo view("parts/upup");
// echo view("parts/load"); 

$db = db_connect();
//$db = \Config\Database::connect();
// Check connection
if($db === false){
    die("ERROR: Could not connect. " . "Error");
}
else{
    echo 'Succes Connect to Database';
}
?>


<link rel="manifest" href="/manifest.json">
<!--Content Wrapper. Contains page content -->
<div class="content-wrapper">
     <!--Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Push Notification
            <!--<small>Control panel</small-->
        </h1>
    </section>
    <section class="content">
        <!--<p>Welcome to the push messaging codelab. The button below needs to be-->
        <!--    fixed to support subscribing to push.</p>-->
        <p>
            <!--<form action="setting/push" method="post" enctype="multipart/form-data"> -->
            <button class="js-push-btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                Enable Push Messaging
            </button>
           
        </p>
        <p>
              <!--<form action="sendNotif.php">-->
            <form action="setting/pushNotif" method="post" enctype="multipart/form-data"> 
            <button class="send-push-btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                Send Notification
            </button>
            </form>
        </p>

        <!-- <p>Once you've subscribed your user, you'd send their subscription to your-->
        <!--    server to store in a database so that when you want to send a message-->
        <!--    you can lookup the subscription and send a message to it.</p>-->
        <!--<p>To simplify things for this code lab copy the following details-->
        <!--    into the <a href="https://web-push-codelab.glitch.me//">Push Companion-->
        <!--        Site</a> and it'll send a push message for you, using the application-->
        <!--    server keys on the site - so make sure they match.</p> -->
        <pre><code class="subscription-json"></code></pre>
    
    
    <!--<section class="subscription-details js-subscription-details is-invisible"></section>-->
    </section>
    <!-- /.content -->
</div>
<!--<script src="scripts/main.js"></script>-->

<script src="https://code.getmdl.io/1.2.1/material.min.js"></script>

<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "d1725685-906f-4ddc-83b6-522aca45a632",
    });
  });
</script>
<script src="https://code.getmdl.io/1.2.1/material.min.js"></script>


<!--<script>-->
<!--const applicationServerPublicKey = 'BFMVzOHGbIHUuy7gnlMQ57mAr6CMfLBEVzNIC5BeND7wFFOedWOPobebUJb2fh34fclkz_MyYQFJvyat2SHQlnI';-->

<!--const pushButton = document.querySelector('.js-push-btn');-->

<!--let isSubscribed = false;-->
<!--let swRegistration = null;-->

<!--function urlB64ToUint8Array(base64String) {-->
<!--    const padding = '='.repeat((4 - base64String.length % 4) % 4);-->
<!--    const base64 = (base64String + padding)-->
<!--        .replace(/\-/g, '+')-->
<!--        .replace(/_/g, '/');-->

<!--    const rawData = window.atob(base64);-->
<!--    const outputArray = new Uint8Array(rawData.length);-->

<!--    for (let i = 0; i < rawData.length; ++i) {-->
<!--        outputArray[i] = rawData.charCodeAt(i);-->
<!--    }-->
<!--    return outputArray;-->
<!--}-->

<!--if ('serviceWorker' in navigator && 'PushManager' in window) {-->
<!--    console.log('Service Worker and Push is supported');-->

<!--    navigator.serviceWorker.register('pwabuilder-sw.js')-->
<!--        .then(function(swReg) {-->
<!--            console.log('Service Worker is registered', swReg);-->

<!--            swRegistration = swReg;-->
<!--        })-->
<!--        .catch(function(error) {-->
<!--            console.error('Service Worker Error', error);-->
<!--        });-->
<!--} else {-->
<!--    console.warn('Push messaging is not supported');-->
<!--    pushButton.textContent = 'Push Not Supported';-->
<!--}-->

<!--function initializeUI() {-->
<!--    pushButton.addEventListener('click', function() {-->
<!--        pushButton.disabled = true;-->
<!--        if (isSubscribed) {-->
            // TODO: Unsubscribe user
<!--            unsubscribeUser();-->
<!--        } else {-->
<!--            subscribeUser();-->
<!--        }-->
<!--    });-->

    // Set the initial subscription value
<!--    swRegistration.pushManager.getSubscription()-->
<!--        .then(function(subscription) {-->
<!--            isSubscribed = !(subscription === null);-->

<!--            if (isSubscribed) {-->
<!--                console.log('User IS subscribed.');-->
<!--            } else {-->
<!--                console.log('User is NOT subscribed.');-->
<!--            }-->

<!--            updateBtn();-->
<!--        });-->
<!--}-->

<!--function updateBtn() {-->
<!--    if (Notification.permission === 'denied') {-->
<!--        pushButton.textContent = 'Push Messaging Blocked.';-->
<!--        pushButton.disabled = true;-->
<!--        updateSubscriptionOnServer(null);-->
<!--        return;-->
<!--    }-->

<!--    if (isSubscribed) {-->
<!--        pushButton.textContent = 'Disable Push Messaging';-->
<!--    } else {-->
<!--        pushButton.textContent = 'Enable Push Messaging';-->
<!--    }-->

<!--    pushButton.disabled = false;-->
<!--}-->

<!--function subscribeUser() {-->
<!--    const applicationServerKey = urlB64ToUint8Array(applicationServerPublicKey);-->
<!--    swRegistration.pushManager.subscribe({-->
<!--            userVisibleOnly: true,-->
<!--            applicationServerKey: applicationServerKey-->
<!--        })-->
<!--        .then(function(subscription) {-->
<!--            console.log('User is subscribed.');-->

<!--            updateSubscriptionOnServer(subscription);-->

<!--            isSubscribed = true;-->

<!--            updateBtn();-->
<!--        })-->
<!--        .catch(function(err) {-->
<!--            console.log('Failed to subscribe the user: ', err);-->
<!--            updateBtn();-->
<!--        });-->
<!--}-->

<!--function unsubscribeUser()-->
<!--{-->
     //Unsub Server
<!--     swRegisteration.pushManager.getSubscription()-->
<!--     .then(function(subscription){-->
<!--         if(subscription)-->
<!--         {-->
<!--             const key = subscription.getKey('p256dh');-->
<!--             const token = subscription.getKey('auth');-->
<!--             fetch('pushSend.php',{-->
<!--                 method: 'post',-->
<!--                 headers: new Headers({-->
<!--                    'Content-Type': 'application/json'-->
<!--                }),-->
<!--                body: JSON.stringify({-->
<!--                    endpoint: subscription.endpoint,-->
<!--                    key: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('p256dh')))) : null,-->
<!--                    token : token ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('auth')))) : null,-->
<!--                    axn: 'unsubscribe'-->
<!--                })-->
<!--             }).then(function(response){-->
<!--                 return response.text();-->
<!--             }).then(function(response){-->
<!--                 console.log(response);-->
<!--             }).catch(function(e){-->
<!--                 console.log('remove from db error', e);-->
<!--             });-->
<!--         }-->
<!--     })-->

     //Unsub local
<!--    navigator.serviceWorker.ready.then(function(reg)-->
<!--    {-->
<!--        reg.pushManager.getSubscription()-->
<!--        .then(function(subscription){-->
<!--            subscription.unsubscribe()-->
<!--            .then(function(success){-->
<!--                console.log("succussfuly unsubscribed", success)-->
<!--                isSubscribed = false;-->
<!--                updateBtn();-->
<!--            })-->
<!--        })-->
<!--        .catch(function(err){-->
<!--            console.log('error to unsub', err)-->
<!--        })-->
<!--    });-->
<!--}-->

<!--function updateSubscriptionOnServer(subscription) {-->
    // TODO: Send subscription to application server
<!--    const subscriptionJson = document.querySelector('.subscription-json');-->
    //  const subscriptionDetails =
    //     document.querySelector('.js-subscription-details');

<!--    if (subscription) {-->
<!--        const key = subscription.getKey('p256h');-->
<!--        const token = subscription.getKey('auth');-->
<!--         subscriptionJson.textContent = JSON.stringify(subscription);-->
         //subscriptionDetails.classList.remove('is-invisible');

<!--        fetch('pushSend', {-->
<!--                method: 'post',-->
<!--                headers: new Headers({-->
<!--                    'Content-Type': 'application/json'-->
<!--                }),-->
<!--                body: JSON.stringify({-->
<!--                    endpoint: subscription.endpoint,-->
<!--                    key: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('pe56h')))) : null,-->
<!--                    token: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('auth')))) : null,-->
<!--                    axn: 'subscribe'-->
<!--                })-->

<!--            })-->
<!--            .then(function(response) {-->
<!--                return response.text();-->
<!--            }).then(function(response) {-->
<!--                console.log(response);-->
<!--            }).catch(function(err) {-->
                // Error :(
<!--                console.log('error');-->
<!--            });-->
<!--    } else {-->
<!--        subscriptionDetails.classList.add('is-invisible');-->
<!--    }-->
<!--}-->

// const sendPushButton = document.querySelector('.send-push-btn');
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

//         const key = subscription.getKey('p256dh');
//         const token = subscription.getKey('auth');
//         console.log('here');
//         fetch('sendPush.php', {
//             method: 'post',
//             body: JSON.stringify({
//                 endpoint: subscription.endpoint,
//                 key: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('p256dh')))) : null,
//                 token: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('auth')))) : null
//             })
//         })
//     })
// );
<!--</script>-->

<?php echo view("parts/footer"); ?>