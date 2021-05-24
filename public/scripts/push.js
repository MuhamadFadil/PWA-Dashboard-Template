var push = require(web - push)

let vapidKeys = {
    $publickey = 'BOE99lvdjCbHi6nI17XW76tG_X4lzuZYo3cPfwhqdcSSMKcyMNVcpnT3VbNkUBtoZuuul5NX3Xh3S7vTa0eGt0U',
    $privatekey = 'ufRraaod9VVDblESL-oabmV0SsOXFxm03bIr-kK7Aq8'
}

push.setVapidDetails('mailto:tes@code.ui.ac.id', vapidKeys.publickey, vapidKeys.privatekey)

let sub = { "endpoint": "https://fcm.googleapis.com/fcm/send/dHeoq8fIbjg:APA91bFOc4QjanIHoUPPsq_hYp1r0dv8B_VpjtGOgWSo631_Iktdp5eOGiH1wa7rCj03fjR45jYED4-N2W2T82JfcY7PKDvOyu0pqYFW6Ik-x8mJZ2IRwspWD-SOfv_XGmApI1bRts6t", "expirationTime": null, "keys": { "p256dh": "BIWWJgHMrnRkhZhc9wLeNihYseAYCo7gcmBouMXXQohJqbKg0mCi_oTzA7fJO-S_Jh_hg7r6x9vQJlJ1QwDQTLQ", "auth": "Q9RBkzsF_Mm_bOukANcQuw" } };

push.sendNotification(sub, 'Test Message')