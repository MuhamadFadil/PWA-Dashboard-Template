const webpush = require('web-push');
const express = require('express');
var bodyParser = require('body-parser');
const app = express();
webpush.setVapidDetails(
    'mailto:contact@deanhume.com',
    'BAyb_WgaR0L0pODaR7wWkxJi__tWbM1MPBymyRDFEGjtDCWeRYS9EF7yGoCHLdHJi6hikYdg4MuYaK0XoD0qnoY',
    'p6YVD7t8HkABoez1CvVJ5bl7BnEdKUu5bSyVjyxMBh0'
);
app.post('/setting', function(req, res) {
    var endpoint = req.body.endpoint;
    saveRegistrationDetails(endpoint, key, authSecret);
    const pushSubscription = {
        endpoint: req.body.endpoint,
        keys: {
            auth: req.body.authSecret,
            p256dh: req.body.key
        }
    };
    var body = 'Thank you for registering';
    var iconUrl = './icon.png';
    webpush.sendNotification(pushSubscription,
            JSON.stringify({
                msg: body,
                url: 'http://localhost:80/',
                icon: iconUrl
            }))
        .then(result => res.sendStatus(201))
        .catch(err => { console.log(err); });
});
app.listen(3111, function() {
    console.log('Web push app listening on port 80!')
});