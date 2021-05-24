<?php
$data = ['form_editor' => true];
echo view("parts/header", $data); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Menampilkan reviewer
            <!--small>Control panel</small-->
        </h1>
        <!--ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol-->
    </section>
    <section class="content">
        <?php if (in_array($_SESSION['DATA_SESSION']['role'], array('Admin'))) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Reviewer:</h3>
                            <div class="box-body">
                                <form action="<?php echo base_url("hasil/edit2");?>">
                                    <div>Pilih Reviewer:</div>
                                    <select name="reviewer" id="reviewer">
                                        <?php
                                        $db = \Config\Database::connect();
                                        $reviewers = $db->table("users")->where("role", "reviewer")->get()->getResult();
                                        foreach ($reviewers as $reviewer) {
                                            echo "<option value='$reviewer->id'>";
                                            echo $reviewer->name;
                                            echo "</option>";
                                        }
                                        ?>
                                    </select>
                                    <input type="submit" value="Submit" class="btn btn-success">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php } ?>


    </section>
    <!-- /.content -->


</div>
<?php echo view("parts/footer"); ?>