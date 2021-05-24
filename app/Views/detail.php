<?php echo view("parts/header");
// echo view("parts/upup");
//echo view("parts/load");
?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Detail Aktivitas</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="assets/uploads/files/<?= $aktivitas['upload_file']; ?>" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $aktivitas['user']; ?></h5>
                            <p class="card-text"><b>Kegiatan : </b><?= $aktivitas['kegiatan']; ?></p>
                            <p class="card-text"><small class="text-muted"><b>Tempat/Instansi : </b><?= komik['tempat']; ?></small></p>

                            <a href="" class="btn btn-warning">Edit</a>
                            <a href="" class="btn btn-danger">Delete</a>
                            <br><br>
                            <a href="/shareTarget/">Kembali ke daftar Aktivitas</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>