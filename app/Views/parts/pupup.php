<?php

?>

<!DOCTYPE html>
<html>

<head>
<!-- CODELAB: Add iOS meta tags and icons -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="SmartCity Rank">
<link rel="apple-touch-icon" href="assets/images/icons/apple-icon-180x180-dunplab-manifest-38625.png">
<meta name="theme-color" content="#7e7e7e"/>

<!-- CODELAB: Add description here -->
<meta name="SmartCity" content="SmartCity Rank">

<!-- CODELAB: Add meta theme-color -->
<!--<meta name="theme-color" content="#7e7e7e" />-->

<!-- CODELAB: Add meta background-color -->
<meta name="background-color" content="#ffffff" />

<!-- (<script src="app.js" defer></script>)-->

<!-- <script src="/scripts/closePWA.js"></script>-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/UpUp/1.0.0/upup.min.js"></script>
    <script>
        UpUp.start({
            'cache-version': 'V6.0.10',
            'content-url': 'offline.html', // show this page to offline users,
            'content': 'Cannot reach site. Please check your internet connection.',
            'service-worker-url': '/pwabuilder-sw.js'
            //'service-worker-url': '/upup.sw.min.js'
        });
    </script>
</head>


