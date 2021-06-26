<?php
$data = ['form_editor' => true];
echo view("parts/header", $data); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            List Kuesioner
            <!--small>Control panel</small-->
        </h1>
        <!--ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Account Details</li>
      </ol-->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">Kuesioner:</h3>
                                <div class="box-body">
                                    <table class="table">
                                        <!-- <caption>Optional table caption.</caption> -->
                                        <thead>
                                            <tr>
                                                <th>Judul</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                <?php
                $db = \Config\Database::connect();

                foreach ($db->table('kuesioner')->get()->getResult() as $judul) {
                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $judul->name; ?>
                                                    </td>
                                                    <td>
                            <a class="btn btn-primary" href="/form/preview/<?php echo $judul->id ?>">
                                Preview form
                            </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                Loading... </div>
        </div>
    </div>



</div>


<!-- /.content-wrapper -->
<?php echo view("parts/footer"); ?>