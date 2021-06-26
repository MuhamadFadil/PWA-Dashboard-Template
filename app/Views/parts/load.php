<?php

?>
<!DOCTYPE html>
<html>

<head>
    <style type="text/css">
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #fff;
        }

        .preloader .loading {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font: 14px arial;
        }
    </style>

    <script>
        $(document).ready(function() {
            $(".preloader").fadeOut();
        })
    </script>
</head>

<body>
    <div class="preloader">
        <div class="loading">
            <img src="load.gif" width="80">
            <p></p>
        </div>
    </div>
</body>