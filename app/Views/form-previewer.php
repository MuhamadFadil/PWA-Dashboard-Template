<?php
$data = array(
	'form_editor' => true,
	'scrollingTabs' => true
);
echo view("parts/header", $data); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Preview - <?php
                        $db = \Config\Database::connect();
                        echo $db->table('kuesioner')->where('id', $kuesionerid)->get()->getRow()->name; ?>
            
        </h1>
      </ol-->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="container noneditable">
                <ul class="nav nav-tabs">
                    <?php
                    $gruppertama = 0;
                    foreach ($db->table('grup')->where('kuesioner', $kuesionerid)->orderBy('urutan', 'ASC')->where('parent_grup', 0)->get()->getResult() as $row) {
                    ?>
                        <li class="<?php if ($gruppertama == 0) {
                                        echo 'active';
                                        $gruppertama = 1;
                                    } ?> "><a data-toggle="tab" href="#<?php echo $row->id ?>"> <span><?php echo $row->name ?> - <?php echo $row->kode ?></span></a></li>
                    <?php } ?>
                </ul>

                <div class="tab-content">
                    <?php
                    $gruppertama = 0;
                    foreach ($db->table('grup')->where('kuesioner', $kuesionerid)->where('parent_grup', 0)->orderBy('urutan', 'ASC')->get()->getResult() as $row) { ?>
                        <div id="<?php echo $row->id ?>" class="tab-pane fade in <?php if ($gruppertama == 0) {
                                                                                        echo 'active';
                                                                                        $gruppertama = 1;
                                                                                    } ?>">
                            
                                <?php foreach ($db->table('pertanyaan')->where('grup', $row->id)->orderBy('urutan', 'ASC')->get()->getResult() as $pertanyaan) { ?>
                                    <div class="panel-area <?php if ($pertanyaan->jenis_jawaban == "Pilih Satu" || $pertanyaan->jenis_jawaban == "Pilih Banyak") {
                                                                echo "pilihan-enum";
                                                            } else if ($pertanyaan->jenis_jawaban == "Angka") {
                                                                echo "pilihan-angka";
                                                            } ?>  <?php if (($pertanyaan->wajib == "ya")) {
                                                                        echo "wajibdiision";
                                                                    } ?>">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-8 form-judul">
                                                        <label class="wajibdiisi" styile="width:10px;">*</label>
                                                        <h3><?php echo $pertanyaan->teks; ?><span style="font-size:16px;color:#888;"><?php echo $pertanyaan->hint; ?></span></h3>
                                                    </div>
                                                    <div class="col-sm-4 form-pertanyaan">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <?php if ($pertanyaan->jenis_jawaban == "Teks Pendek") { ?>
                                                            <input class="form-control input-lg isian-judul" type="text" placeholder="Jawaban.." value="">
                                                        <?php } else if ($pertanyaan->jenis_jawaban == "Teks Panjang") { ?>
                                                            <textarea  class="form-control input-lg isian-judul" type="text" placeholder="Jawaban.." value=""></textarea>
                                                        <?php } else if ($pertanyaan->jenis_jawaban == "Teks Panjang, HTML") { ?>
                                                            <textarea  class="form-control input-lg isian-judul" type="text" placeholder="Jawaban.." value=""></textarea>
                                                        <?php } else if ($pertanyaan->jenis_jawaban == "Pilih Satu") { ?>
                                                            <?php foreach ($db->table('jenis_jawaban_enum')->orderBy('urutan', 'ASC')->where('pertanyaan', $pertanyaan->id)->get()->getResult() as $jawaban) { ?>
                                                                <div class="radio">
                                                                    <input type="radio" name="<?php echo $jawaban->pertanyaan ?>">
                                                                    <label><?php echo $jawaban->teks ?></label>
                                                                </div>

                                                            <?php } ?>
                                                        <?php } else if ($pertanyaan->jenis_jawaban == "Pilih Banyak") { ?>
                                                            <?php foreach ($db->table('jenis_jawaban_enum')->orderBy('urutan', 'ASC')->where('pertanyaan', $pertanyaan->id)->get()->getResult() as $jawaban) { 
                                                           if(isset($jawaban)){ ?>
                                                                <div class="checkbox">
                                                                    <input type="checkbox" name="<?php echo $jawaban->pertanyaan ?>">
                                                                    <label><?php echo $jawaban->teks ?></label>
                                                                </div>

                                                                <?php }} ?>
                                                        <?php } else if ($pertanyaan->jenis_jawaban == "Angka") {
                                                            $jawaban = $db->table('jenis_jawaban_angka')->where('pertanyaan', $pertanyaan->id)->get()->getRow();
                                                           if(isset($jawaban)){ ?>
                                                           <div class="quantity">
                                                            <input type="number" name="points" min="<?php echo $jawaban->min ?>" max="<?php echo $jawaban->max ?>" step="<?php echo $jawaban->decimal_place ?>" value="<?php echo $jawaban->min ?>">
                                                            </div>
                                                            <?php }} ?>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="panel-footer">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" value="" class="wajibdiisitidak" <?php if (($pertanyaan->wajib == "ya")) {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
                                                            Wajib diisi?

                                                        </label>
                                                    </div>
                                                    <div class="col-sm-6" style="text-align:right">
                                                        <a href="#" class="btn btn-info hapus hapus-pertanyaan" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                        </div>
                            <?php } ?>
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
            <div class="container">

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
<script>$('.nav-tabs').scrollingTabs();</script>

<!-- /.content-wrapper -->
<?php echo view("parts/footer"); ?>