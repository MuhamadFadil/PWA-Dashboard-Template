<!DOCTYPE html>
<html lang="en">
<?php
$db = \Config\Database::connect();

$builder = $db->table('grup');
$data = [
    [
            'name'  => 'My Name',
    ],
    [
            'name'  => 'Another Name',
    ]
];

$builder->insertBatch($data);

echo $db->insertID();
?>

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        .ui-state-highlight {
            width: 70px;
            background: #eee;
            height: 100%;
        }

        .nav-tabs {
            height: 41px;

        }

        html {
            height: 100%;
        }

        .portlet-placeholder {
            width: 100%;
            border: 3px dashed #ccc;
            height: 100px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .panel-default>.panel-heading {
            color: none;
            background-color: rgba(1, 1, 1, 0);
            border-color: white;
        }

        .panel-body {
            padding-top: 0px;
        }

        .panel-heading {
            cursor: move;
        }

        .panel-footer {
            display: none;
        }

        .active-panel .panel-footer {
            display: block;
        }

        .form-pertanyaan {
            display: none;
        }

        .active-panel .form-pertanyaan {
            display: block;
        }

        .form-judul .form-control {
            border: none;
            margin: none;
            box-shadow: none;
            padding: 0px;
            border-radius: 0px;
            padding: 10px;
        }

        .active-panel .form-judul .form-control {
            display: block;
            border-bottom: 1px solid #ccc;
            padding: 10px 20px;
        }

        .panel-adder {
            color: rgba(1, 1, 1, 0);
            line-height: 30px;
            text-align: center;
        }

        .panel-adder:hover {
            color: rgba(1, 1, 1, 1);
        }

        .panel {
            margin: 0px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $(".nav-tabs").sortable({
                placeholder: "ui-state-highlight"
            });
            $(".nav-tabs").disableSelection();


            $(".tab-pane").sortable({
                connectWith: ".tab-pane",
                handle: ".panel-heading",
                placeholder: "portlet-placeholder ui-corner-all"
            });
        });
        $(document).on('click', '.panel', function() {
            $(".panel").removeClass("active-panel");
            $(this).addClass("active-panel")
        });
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
            <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
            <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="panel-area">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-8 form-judul">
                                    <input class="form-control input-lg" id="inputlg" type="text" placeholder="Judul..">
                                </div>
                                <div class="col-sm-4 form-pertanyaan">
                                    <select class="form-control input-lg" id="sel1">
                                        <option>Pertanyaan Singkat</option>
                                        <option>Dropdown</option>
                                        <option>Checkbox</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="">
                                Wajib diisi?
                            </label>
                        </div>
                    </div>
                    <div class="panel-adder">
                        Tambahkan Pertanyaan Tambahkan Sub Grup
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <input class="form-control input-lg" id="inputlg" type="text">
                        <p>Some content.</p>
                    </div>
                </div>
            </div>
            <div id="menu1" class="tab-pane fade">
                <h3>Menu 1</h3>
                <p>Some content in menu 1.</p>
            </div>
            <div id="menu2" class="tab-pane fade">
                <h3>Menu 2</h3>
                <p>Some content in menu 2.</p>
            </div>
        </div>
    </div>

</body>

</html>