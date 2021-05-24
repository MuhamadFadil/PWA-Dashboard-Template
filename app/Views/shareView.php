<?php echo view("parts/header");
// echo view("parts/upup");
// echo view("parts/load");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Management Data</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
        }

        .table-responsive {
            margin: 30px 0;
        }

        .table-wrapper {
            min-width: 1000px;
            background: #fff;
            padding: 20px 25px;
            border-radius: 3px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            padding-bottom: 15px;
            background: #299be4;
            color: #fff;
            padding: 16px 30px;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }

        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }

        .table-title .btn {
            color: #566787;
            float: right;
            font-size: 13px;
            background: #fff;
            border: none;
            min-width: 50px;
            border-radius: 2px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }

        .table-title .btn:hover,
        .table-title .btn:focus {
            color: #566787;
            background: #f2f2f2;
        }

        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }

        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }

        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }

        table.table tr th:first-child {
            width: 60px;
        }

        table.table tr th:last-child {
            width: 100px;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table td:last-child i {
            opacity: 0.9;
            font-size: 22px;
            margin: 0 5px;
        }

        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
        }

        table.table td a:hover {
            color: #2196F3;
        }

        table.table td a.settings {
            color: #2196F3;
        }

        table.table td a.delete {
            color: #F44336;
        }

        table.table td i {
            font-size: 19px;
        }

        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }

        .status {
            font-size: 30px;
            margin: 2px 2px 0 0;
            display: inline-block;
            vertical-align: middle;
            line-height: 10px;
        }

        .text-success {
            color: #10c469;
        }

        .text-info {
            color: #62c9e8;
        }

        .text-warning {
            color: #FFC107;
        }

        .text-danger {
            color: #ff5b5b;
        }

        .pagination {
            float: right;
            margin: 0 0 5px;
        }

        .pagination li a {
            border: none;
            font-size: 13px;
            min-width: 30px;
            min-height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 2px !important;
            text-align: center;
            padding: 0 6px;
        }

        .pagination li a:hover {
            color: #666;
        }

        .pagination li.active a,
        .pagination li.active a.page-link {
            background: #03A9F4;
        }

        .pagination li.active a:hover {
            background: #0397d6;
        }

        .pagination li.disabled i {
            color: #ccc;
        }

        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }

        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }

        /* Modal styles */
        /*.modal .modal-dialog {*/
        /*	max-width: 400px;*/
        /*}*/
        /*.modal .modal-header, .modal .modal-body, .modal .modal-footer {*/
        /*	padding: 20px 30px;*/
        /*}*/
        /*.modal .modal-content {*/
        /*	border-radius: 1px;*/
        /*}*/
        /*.modal .modal-footer {*/
        /*	background: #ecf0f1;*/
        /*	border-radius: 0 0 1px 1px;*/
        /*}*/
        /*   .modal .modal-title {*/
        /*       display: inline-block;*/
        /*   }*/
        /*.modal .form-control {*/
        /*	border-radius: 1px;*/
        /*	box-shadow: none;*/
        /*	border-color: #dddddd;*/
        /*}*/
        /*.modal textarea.form-control {*/
        /*	resize: vertical;*/
        /*}*/
        /*.modal .btn {*/
        /*	border-radius: 1px;*/
        /*	min-width: 100px;*/
        /*}	*/
        /*.modal form label {*/
        /*	font-weight: normal;*/
        /*}	*/
    </style>
    <script>
        $(document).ready(function() {
            // Activate tooltip
            $('[data-toggle="tooltip"]').tooltip();

            // Select/Deselect checkboxes
            var checkbox = $('table tbody input[type="checkbox"]');
            $("#selectAll").click(function() {
                if (this.checked) {
                    checkbox.each(function() {
                        this.checked = true;
                    });
                } else {
                    checkbox.each(function() {
                        this.checked = false;
                    });
                }
            });
            checkbox.click(function() {
                if (!this.checked) {
                    $("#selectAll").prop("checked", false);
                }
            });
        });
    </script>

<body>
    <!--<div class="container">-->
    <div class="content-wrapper">
        <section class="content">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-xs-5">
                                <h2>Data <b>Aktivitas Pegawai</b></h2>
                            </div>
                            <div class="col-xs-7">
                                <a class="btn btn-success" onclick="window.location='<?php echo site_url('shareTarget/formtambah/') ?>'"><i class="material-icons">&#xE147;</i> <span>Add Activities</span></a>

                                <a href="#" class="btn btn-primary"><i class="material-icons">&#xE24D;</i> <span>Export to Excel</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id User</th>
                                <th>User</th>
                                <th>Kategori</th>
                                <th>Kegiatan/Judul</th>
                                <th>Tempat/Instansi</th>
                                <th>Tanggal</th>
                                <th>Angka Kredit</th>
                                <th>File</th>
                                <th>Aksi</th>
                                <!--<th>Upload File</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nomor = 0;
                            foreach ($tampil as $row) :
                                $nomor++;
                            ?>
                                <tr>
                                    <th><?= $nomor; ?></th>
                                    <td><?= $row->id_user ?></td>
                                    <td><?= $row->user ?></td>
                                    <td><?= $row->kategori ?></td>
                                    <td><?= $row->kegiatan ?></td>
                                    <td><?= $row->tempat ?></td>
                                    <td><?= $row->tanggal ?></td>
                                    <td><?= $row->angka_kredit ?></td>
                                    <!--<td><?= $row->upload_file ?></td>-->
                                    <td><img src="assets/uploads/files/<?= $row->upload_file ?>" width="100" /></td>
                                    <!--<td><?= $row->upload_file ?></td>-->
                                    <td>
                                        <!--<button type="button" onclick="hapus('<?= $row->id_user ?>')">Hapus</button>-->
                                        <!--<button type="button" onclick="window.location='<?php echo site_url('shareTarget/formedit/') . $row->id_user ?>'">Edit</button>-->
                                        <!--<button type="button" method="post" onclick="window.location='<?php echo site_url('shareTarget/detail/') . $row->id_user ?>'">Detail</button>-->

                                        <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>

                                        <a href="#deleteEmployeeModal" onclick="hapus('<?= $row->id_user ?>')" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                    </td>
                                    <!--<td>-->
                                    <!--    <button type="button" method="post" onclick="window.location='<?php echo site_url('shareTarget/upload/') . $row->upload_file ?>'">Upload</button>-->
                                    <!--</td>-->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <script>
                        function hapus(user_id) {
                            pesan = confirm('Yakin hapus data user ?');

                            if (pesan) {
                                window.location.href = ("<?= site_url('shareTarget/hapus/') ?>") + user_id;
                            } else return false;
                        }
                    </script>

                </div>
            </div>

        </section>
    </div>
</body>

<script>
    addEventListener('fetch', event => {
                // ignore all requests with are not of method POST and which are not the URL we defined in in share_target as action
                if (event.request.method !== 'POST' || event.request.url.startsWith('https://fadil.website/shareTarget/formtambah/#upload') === false) {
                    return;
                }

                function handleFileShare(event) {
                    event.respondwith(Response.redirect('https://fadil.website/shareTarget/formtambah/#upload'));

                    event.waitUntil(async function() {
                        const data = await event.request.fromData();
                        const client = await self.clients.get(event.resultingClintId);
                        const file = data.get('upload');
                        client.postMessage({
                            file,
                            action: 'load-image'
                        });
                    }());
                }
                // navigator.serviceWorkerContainer.onmessage = (event) =>{
                // const upload = event.data.upload;}
</script>

<?php echo view("parts/footer"); ?>