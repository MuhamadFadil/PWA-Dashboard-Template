var push = require("web-push");

let vapidKeys = {
    publicKey: 'BFMVzOHGbIHUuy7gnlMQ57mAr6CMfLBEVzNIC5BeND7wFFOedWOPobebUJb2fh34fclkz_MyYQFJvyat2SHQlnI',
    privateKey: 'jvbrotxyKXfL3rftIHTj9Da8BAATDelcnQbW5vyasNw'
}

push.setVapidDetails('mailto:test@ui.ac.id', vapidKeys.publicKey, vapidKeys.privateKey)

let sub = {};

push.sendNotification(sub, 'test message')