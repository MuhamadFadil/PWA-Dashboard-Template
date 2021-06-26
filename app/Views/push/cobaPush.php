<?php
$data = ['form_editor' => true];
echo view("parts/header", $data);
require APPPATH . 'Views/push/vendor/autoload.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style type="text/css">
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        /* toggle */
        .material-switch>input[type="checkbox"] {
            display: none;
        }

        .material-switch>label {
            cursor: pointer;
            height: 0px;
            position: relative;
            width: 40px;
        }

        .material-switch>label::before {
            background: rgb(0, 0, 0);
            box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            content: '';
            height: 16px;
            margin-top: 0px;
            position: absolute;
            opacity: 0.3;
            transition: all 0.4s ease-in-out;
            width: 40px;
        }

        .material-switch>label::after {
            background: rgb(255, 255, 255);
            border-radius: 30px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
            content: 'ON';
            height: 24px;
            left: -4px;
            margin-top: 0px;
            position: absolute;
            top: -4px;
            transition: all 0.3s ease-in-out;
            width: 24px;
        }

        .material-switch>input[type="checkbox"]:checked+label::before {
            background: inherit;
            opacity: 0.5;
        }

        .material-switch>input[type="checkbox"]:checked+label::after {
            background: inherit;
            left: 20px;
        }
    </style>

</head>

<body>
    <!-- <section class="content-header">
        <h1>Setting</h1>
    </section> -->
    <section class="content-header">
        <!-- <div class="container"> -->
            <div class="row">
                <!-- <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4"> -->
                <div class="panel panel-default">
                    <!-- List group -->
                    <ul class="list-group">
                        <!-- Default panel contents -->
                    <div class="panel-heading">
                        <h1>Pengaturan</h1>
                    </div>
                    <form action="/setting/simpandata" method="post" enctype="multipart/form-data">
                        <li class="list-group-item">
                            Terima Pemberitahuan
                            <div class="material-switch pull-right">
                                <input id="push" name="push" type="checkbox" disabled/>
                                <label for="push" class="label-warning"></label>
                            </div>
                        </li>

                        <li class="list-group-item">
                            Suara Aplikasi
                            <div class="material-switch pull-right">
                                <input onclick="window.location='<?php echo site_url('setting/senduser')?>'" id="push-send" name="push-send" type="checkbox" />
                                <label for="push-send" class="label-danger"></label>
                            </div>
                        </li>
                        </form>
                    </ul>
                    <!-- </div> -->
                </div>
            </div>
    <!-- </div> -->
    </section>
    
    <br>
    <section class="content-header subscription-details js-subscription-details is-invisible">
        <p><a href="https://web-push-codelab.glitch.me//">Push Companion
                Site</a></p>
        <p>Subscribe:</p>
        <pre><code class="js-subscription-json"></code></pre>
    </section>
</body>
<script src="/scripts/main.js"></script>

</html>
<br>
<?php echo view("parts/footer"); ?>