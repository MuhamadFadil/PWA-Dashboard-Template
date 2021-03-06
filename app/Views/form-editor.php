<?php
$data = ['form_editor' => true];
echo view("parts/header", $data); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit form <?php
                        $db = \Config\Database::connect();
                        echo $db->table('kuesioner')->where('id', $kuesionerid)->get()->getRow()->name; ?>
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
                <ul class="nav nav-tabs">
                    <?php
                    $gruppertama = 0;
                    foreach ($db->table('grup')->where('kuesioner', $kuesionerid)->where('parent_grup', 0)->get()->getResult() as $row) {
                    ?>
                        <li class="<?php if ($gruppertama == 0) {
                                        echo 'active';
                                        $gruppertama = 1;
                                    } ?> "><a data-toggle="tab" href="#<?php echo $row->id ?>"> <span contenteditable="true"><?php echo $row->name ?></span></a></li>
                    <?php } ?>
                    <li class="tambahkan-grup"><a>+</a></li>
                </ul>

                <div class="tab-content">
                    <?php
                    $gruppertama = 0;
                    foreach ($db->table('grup')->where('kuesioner', $kuesionerid)->where('parent_grup', 0)->get()->getResult() as $row) { ?>
                        <div id="<?php echo $row->id ?>" class="tab-pane fade in <?php if ($gruppertama == 0) {
                                                                                        echo 'active';
                                                                                        $gruppertama = 1;
                                                                                    } ?>">
                            <?php $subcnt = 0;
                            foreach ($db->table('grup')->where('parent_grup', $row->id)->get()->getResult() as $subgrup) { ?>
                                <div class="panel-area subgrup <?php if ($subcnt == 0) {
                                                                    echo 'subgrupfix';
                                                                    $subcnt++;
                                                                } ?>">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12 form-judul">
                                                    <input class="form-control input-lg isian-judul" id="inputlg" type="text" placeholder="Judul Subgrup.." value="<?php echo $subgrup->name; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer">
                                            <div class="row">
                                                <div class="col-sm-6" style="text-align:right">
                                                    <a href="#" class="btn btn-info hapus hapus-grup" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-adder">
                                        <i class="fa fa-plus-circle tambahkan-pertanyaan" aria-hidden="true"></i>
                                        <i class="fa fa-minus tambahkan-subgrup" aria-hidden="true"></i>

                                    </div>
                                </div>
                                <?php foreach ($db->table('pertanyaan')->where('grup', $subgrup->id)->get()->getResult() as $pertanyaan) { ?>
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
                                                    <div class="col-sm-7 form-judul">
                                                        <label class="wajibdiisi" styile="width:10px;">*</label>
                                                        <input class="form-control input-lg isian-judul" id="inputlg" type="text" placeholder="Judul.." value="<?php echo $pertanyaan->teks; ?>">
                                                    </div>
                                                    <div class="col-sm-3 form-judul">
                                                        <input class="form-control input-lg isian-formula" id="inputformula" type="text" placeholder="Formula" value="<?php echo $pertanyaan->formula; ?>">
                                                    </div>
                                                    <div class="col-sm-2 form-pertanyaan">
                                                        <select class="form-control input-lg jenis-pertanyaan">
                                                            <option <?php if ($pertanyaan->jenis_jawaban == "Pendek") {
                                                                        echo 'selected="selected"';
                                                                    } ?>>Pendek</option>
                                                            <option <?php if ($pertanyaan->jenis_jawaban == "Panjang") {
                                                                        echo 'selected="selected"';
                                                                    } ?>>Panjang</option>
                                                            <option <?php if ($pertanyaan->jenis_jawaban == "Panjang, HTML") {
                                                                        echo 'selected="selected"';
                                                                    } ?>>Panjang, HTML</option>
                                                            <option <?php if ($pertanyaan->jenis_jawaban == "Pilih Banyak") {
                                                                        echo 'selected="selected"';
                                                                    } ?>>Pilih Banyak</option>
                                                            <option <?php if ($pertanyaan->jenis_jawaban == "Pilih Satu") {
                                                                        echo 'selected="selected"';
                                                                    } ?>>Pilih Satu</option>
                                                            <option <?php if ($pertanyaan->jenis_jawaban == "Angka") {
                                                                        echo 'selected="selected"';
                                                                    } ?>>Angka</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <?php $cnt = 0;
                                                if ($pertanyaan->jenis_jawaban == "Pilih Satu" || $pertanyaan->jenis_jawaban == "Pilih Banyak") {
                                                    foreach ($db->table('jenis_jawaban_enum')->where('pertanyaan', $pertanyaan->id)->get()->getResult() as $jawaban) { ?>
                                                        <div class="row jenis-enum">
                                                            <div class="col-sm-1 form-judul" style="text-align:center;">
                                                                <?php if ($cnt != 0) { ?>
                                                                    <a><i class="fa fa-close hapus-jawaban" aria-hidden="true" style="font-size:30px;"></i></a>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="col-sm-11 form-judul">
                                                                <input class="form-control input-lg isian-jawaban" id="inputlg" type="text" placeholder="Judul Jawaban" value="<?php echo $jawaban->teks ?>">
                                                            </div>
                                                        </div>

                                                    <?php $cnt++;
                                                    }
                                                } else { ?>
                                                    <div class="row jenis-enum">
                                                        <div class="col-sm-1 form-judul" style="text-align:center;">

                                                        </div>
                                                        <div class="col-sm-11 form-judul">
                                                            <input class="form-control input-lg isian-jawaban" id="inputlg" type="text" placeholder="Judul Jawaban">
                                                        </div>
                                                    </div>
                                                <?php   } ?>

                                                <?php $cnt = 0;
                                                if ($pertanyaan->jenis_jawaban == "Angka") {
                                                    $resultangka = $db->table('jenis_jawaban_angka')->where('pertanyaan', $pertanyaan->id)->get()->getRow();
                                                } ?>
                                                <div class="row jenis-enum tambahkan-jawaban">
                                                    <div class="col-sm-1 form-judul" style="text-align:center;">
                                                        <a><i class="fa fa-close hapus-jawaban" aria-hidden="true" style="font-size:30px;"></i></a>
                                                    </div>
                                                    <div class="col-sm-11 form-judul">
                                                        <input class="form-control input-lg isian-jawaban" id="inputlg" type="text" placeholder="Judul Jawaban">
                                                    </div>
                                                </div>
                                                <div class="row jenis-angka">
                                                    <div class="col-sm-4 form-judul">
                                                        <input class="form-control input-lg isian-judul isian-min" id="inputlg" type="number" placeholder="Min" value="<?php if (isset($resultangka)) {
                                                                                                                                                                            echo $resultangka->min;
                                                                                                                                                                        } ?>">
                                                    </div>
                                                    <div class="col-sm-4 form-judul">
                                                        <input class="form-control input-lg isian-judul isian-max" id="inputlg" type="number" placeholder="Max" value="<?php if (isset($resultangka)) {
                                                                                                                                                                            echo $resultangka->max;
                                                                                                                                                                        } ?>">
                                                    </div>
                                                    <div class="col-sm-4 form-judul">
                                                        <input class="form-control input-lg isian-judul isian-decimal" id="inputlg" type="number" placeholder="Decimal place" value="<?php if (isset($resultangka)) {
                                                                                                                                                                                            echo $resultangka->decimal_place;
                                                                                                                                                                                        } ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="checkbox" value="" class="wajibdiisitidak" <?php if (($pertanyaan->wajib == "ya")) {
                                                                                                                    echo "checked";
                                                                                                                } ?>><label style="font-weight:400;">

                                                            Wajib diisi?

                                                        </label>
                                                    </div>
                                                    <div class="col-sm-6" style="text-align:right">
                                                        <a href="#" class="btn btn-info hapus hapus-pertanyaan" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-adder">
                                            <i class="fa fa-plus-circle tambahkan-pertanyaan" aria-hidden="true"></i>
                                            <i class="fa fa-minus tambahkan-subgrup" aria-hidden="true"></i>

                                        </div>
                                    </div>
                                <?php } ?>
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

                <div class="btn btn-success wow">
                    Simpan form
                </div>
                <div class="btn btn-danger  wow2">
                    Preview form
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

    <script type="text/javascript">
        $(".cloneQuarterSchedule").click(function(e) {
            e.stopPropagation();
        });

        var myModalContent = '';
        $('button.close').on('click', function(e) {
            $('#myModal').modal('hide');
        })
        // $("#myModal .close").click(function(){$("#myModal").hide();});
        $('[data-load-remote]').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var remote = $this.data('load-remote');
            if (remote) {
                if (myModalContent != remote) { //update only when the URL is different
                    $($this.data('remote-target')).html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title" id="myModalLabel">Loading...</h4></div>');
                    myModalContent = remote;
                    $($this.data('remote-target')).load(remote);
                    if ($this.data('manual-toggle')) {
                        setTimeout(function() {
                            $('#myModal').modal('show');
                        }, 100);
                        // alert('a');
                        // setTimeout(function(){alert('a');},2000);
                        //
                    }
                }
            }
        });
    </script>



</div>

<script>
    var data;
    $("body").on('DOMSubtreeModified', "#field_kota_chosen span", function() {

        $.getJSON("<?php echo base_url("assets/provinsi.json"); ?>", function(result) {
            $("#field-provinsi").html(result[$("#field_kota_chosen span").html()]);
        });
    });
</script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        $(".nav-tabs").sortable({
            placeholder: "ui-state-highlight",
            items: "> li:not(.tambahkan-grup)",
            handle: "*:not(input)"
        });



        $(".tab-pane").sortable({
            connectWith: ".tab-pane",
            items: "> div:not(.subgrupfix)",
            handle: ".panel-heading",
            placeholder: "portlet-placeholder ui-corner-all"
        });
        // Test with an element.
    });

    jQuery.fn.selectText = function() {
        var doc = document;
        var element = this[0];
        console.log(this, element);
        if (doc.body.createTextRange) {
            var range = document.body.createTextRange();
            range.moveToElementText(element);
            range.select();
        } else if (window.getSelection) {
            var selection = window.getSelection();
            var range = document.createRange();
            range.selectNodeContents(element);
            selection.removeAllRanges();
            selection.addRange(range);
        }
    };

    $(document).on('click', '.nav-tabs span', function() {
        $(this).selectText();
    });
    $(document).on('click', '.panel', function() {
        $(".panel").removeClass("active-panel");
        $(this).addClass("active-panel");
    });
    $(document).on('click', '.hapus-pertanyaan', function() {
        $(this).closest(".panel-area").remove();
    });

    function getsubgrup(id) {
        var subgrup = [];
        var gurutan = 0;
        var purutan = 0;
        $(id + " .panel-area").each(function(index) {
            if ($(this).hasClass("subgrup")) {
                subgrup.push({
                    "judul": $(this).find(".isian-judul").eq(0).val(),
                    "urutan": gurutan,
                    "pertanyaan": []
                });
                gurutan++;
            } else {
                var jawaban = []
                if ($(this).find(".jenis-pertanyaan").eq(0).find(":selected").text() == "Angka") {
                    jawaban.push({
                        "max": $(this).find(".isian-max").eq(0).val(),
                        "min": $(this).find(".isian-min").eq(0).val(),
                        "decimal": $(this).find(".isian-decimal").eq(0).val()
                    });
                } else if ($(this).find(".jenis-pertanyaan").eq(0).find(":selected").text() == "Pilih Satu" || $(this).find(".jenis-pertanyaan").eq(0).find(":selected").text() == "Pilih Banyak") {
                    var jurutan = 0;
                    $(this).find(" .jenis-enum:not(.tambahkan-jawaban)").each(function(index) {
                        jawaban.push({
                            "jawaban": $(this).find(".isian-jawaban").eq(0).val(),
                            "bobot": 0,
                            "urutan": jurutan
                        });
                        jurutan++;
                    });
                }
                subgrup[subgrup.length - 1]["pertanyaan"].push({
                    "judul": $(this).find(".isian-judul").eq(0).val(),
                    "wajib": ($(this).find(".wajibdiisitidak").eq(0).is(':checked')) ? "ya" : "tidak",
                    "jenis": $(this).find(".jenis-pertanyaan").eq(0).find(":selected").text(),
                    "hint": "",
                    "formula": $(this).find(".isian-formula").eq(0).val(),
                    "jawaban": jawaban,
                    "urutan": purutan
                });
                purutan++;
            }
        });
        return subgrup;
    }
    $(document).on('click', '.wow', function() {
        var data = {}
        data["session"] = "<?php echo $_SESSION['DATA_SESSION']['session']; ?>";
        data["kuesionerid"] = <?php echo $kuesionerid ?>;
        data["grup"] = [];
        $(".nav-tabs li:not(.tambahkan-grup)").each(function(index) {
            var id = $(this).find("a").eq(0).attr("href");
            data["grup"].push({
                "judul": $(this).find("span").eq(0).text(),
                "urutan": index,
                "subgrup": getsubgrup(id)
                // [{
                //   "judul": "wow",
                //   "pertanyaan":[{
                //     "judul": "wow",
                //     'jenis': 'dropdown',
                //     "jawaban": [{
                //       "judul":"wow",
                //       "bobot":1
                //     }]
                //   }]
            });
            //data[index]['urutan'] = index;
            // $($(this).find("a").eq(0).attr("href") + " .panel-area").each(function(index2) {
            //   data["grup"]['judul'] = $(this).find(".isian-judul").eq(0).val();
            //   data["grup"]['wajib'] = $(this).find(".wajibdiisitidak").eq(0).is(':checked');
            // });
        });
        //alert(JSON.stringify(data));


        $.ajax({
            type: "POST",
            data: {
                data: JSON.stringify(data)
            },
            url: "<?php echo base_url('/form/update'); ?>",
            success: function(data) {
                alert("success")
            }
        });
    });

    $(document).on('click', '.wow2', function() {
        var data = {}
        data["session"] = "<?php echo $_SESSION['DATA_SESSION']['session']; ?>";
        data["kuesionerid"] = <?php echo $kuesionerid ?>;
        data["grup"] = [];
        $(".nav-tabs li:not(.tambahkan-grup)").each(function(index) {
            var id = $(this).find("a").eq(0).attr("href");
            data["grup"].push({
                "judul": $(this).find("span").eq(0).text(),
                "urutan": index,
                "subgrup": getsubgrup(id)
                // [{
                //   "judul": "wow",
                //   "pertanyaan":[{
                //     "judul": "wow",
                //     'jenis': 'dropdown',
                //     "jawaban": [{
                //       "judul":"wow",
                //       "bobot":1
                //     }]
                //   }]
            });
            //data[index]['urutan'] = index;
            // $($(this).find("a").eq(0).attr("href") + " .panel-area").each(function(index2) {
            //   data["grup"]['judul'] = $(this).find(".isian-judul").eq(0).val();
            //   data["grup"]['wajib'] = $(this).find(".wajibdiisitidak").eq(0).is(':checked');
            // });
        });
        //alert(JSON.stringify(data));


        $.ajax({
            type: "POST",
            data: {
                data: JSON.stringify(data)
            },
            url: "<?php echo base_url('/form/update'); ?>",
            success: function(data) {
                window.location.href = "<?php echo base_url('/form/preview/' . $kuesionerid); ?>";
            }
        });
    });


    $(document).on('click', '.wajibdiisitidak', function() {
        if ($(this).is(':checked'))
            $(this).closest(".panel-area").addClass("wajibdiision");
        else
            $(this).closest(".panel-area").removeClass("wajibdiision");
    });

    $(document).on('change', '.jenis-pertanyaan', function() {
        $(this).find("option:selected").each(function() {
            if ($(this).val() == "Pilih Satu" || $(this).val() == "Pilih Banyak") {
                $(this).closest(".panel-area").removeClass("pilihan-angka");
                $(this).closest(".panel-area").addClass("pilihan-enum");
            } else if ($(this).val() == "Angka") {
                $(this).closest(".panel-area").removeClass("pilihan-enum");
                $(this).closest(".panel-area").addClass("pilihan-angka");
            } else {
                $(this).closest(".panel-area").removeClass("pilihan-angka");
                $(this).closest(".panel-area").removeClass("pilihan-enum");
            }
        });
    });

    var jawaban = `
                                    <div class="row jenis-enum tambahkan-jawaban">
                                        <div class="col-sm-1 form-judul" style="text-align:center;">
                                            <a><i class="fa fa-close hapus-jawaban" aria-hidden="true" style="font-size:30px;"></i></a>
                                        </div>
                                        <div class="col-sm-11 form-judul">
                                            <input class="form-control input-lg isian-jawaban" id="inputlg" type="text" placeholder="Judul Jawaban">
                                        </div>
                                    </div>`;

    $(document).on('focus', '.tambahkan-jawaban', function() {
        $(this).removeClass("tambahkan-jawaban");
        $(this).after(jawaban);
    });
    $(document).on('click', '.hapus-jawaban', function() {
        $(this).closest(".jenis-enum").remove(); //("tambahkan-jawaban");
    });

    jQuery('span.ui-sortable-handle').bind('dragover drop', function(event) {
        event.preventDefault();
        return false;
    });


    var pertanyaan = `<div class="panel-area">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                </div>
                                <div class="panel-body">
                                <div class="row">
                                                    <div class="col-sm-7 form-judul">
                                                        <label class="wajibdiisi" styile="width:10px;">*</label>
                                                        <input class="form-control input-lg isian-judul" id="inputlg" type="text" placeholder="Judul..">
                                                    </div>
                                                    <div class="col-sm-3 form-judul">
                                                        <input class="form-control input-lg isian-formula" id="inputformula" type="text" placeholder="Formula" value="">
                                                    </div>
                                                    <div class="col-sm-2 form-pertanyaan">
                                                        <select class="form-control input-lg jenis-pertanyaan">
                                                            <option selected="selected">Pendek</option>
                                                            <option>Panjang</option>
                                                            <option>Panjang, HTML</option>
                                                            <option>Pilih Banyak</option>
                                                            <option>Pilih Satu</option>
                                                            <option>Angka</option>
                                                        </select>
                                                    </div>
                                                </div>
                                    <div class="row jenis-enum">
                                        <div class="col-sm-1 form-judul" style="text-align:center;">
                                           
                                        </div>
                                        <div class="col-sm-11 form-judul">
                                            <input class="form-control input-lg isian-jawaban" id="inputlg" type="text" placeholder="Judul Jawaban">
                                        </div>
                                    </div>
                                    <div class="row jenis-enum tambahkan-jawaban">
                                        <div class="col-sm-1 form-judul" style="text-align:center;">
                                            <a><i class="fa fa-close hapus-jawaban" aria-hidden="true" style="font-size:30px;"></i></a>
                                        </div>
                                        <div class="col-sm-11 form-judul">
                                            <input class="form-control input-lg isian-jawaban" id="inputlg" type="text" placeholder="Judul Jawaban">
                                        </div>
                                    </div>
                                    <div class="row jenis-angka">
                                        <div class="col-sm-4 form-judul">
                                            <input class="form-control input-lg isian-judul isian-min" id="inputlg" type="number" placeholder="Min">
                                        </div>
                                        <div class="col-sm-4 form-judul">
                                            <input class="form-control input-lg isian-judul isian-max" id="inputlg" type="number" placeholder="Max">
                                        </div>
                                        <div class="col-sm-4 form-judul">
                                            <input class="form-control input-lg isian-judul isian-decimal" id="inputlg" type="number" placeholder="Decimal place">
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="row">
                                    <div class="col-sm-6">
                                                        <input type="checkbox" value="" class="wajibdiisitidak"><label style="font-weight:400;">

                                                            Wajib diisi?

                                                        </label>
                                                    </div>
                                        <div class="col-sm-6" style="text-align:right">
                                            <a href="#" class="btn btn-info hapus hapus-pertanyaan" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-adder">
                                <i class="fa fa-plus-circle tambahkan-pertanyaan" aria-hidden="true"></i>
                                <i class="fa fa-minus tambahkan-subgrup" aria-hidden="true"></i>

                            </div>
                        </div>`;
    $(document).on('click', '.tambahkan-pertanyaan', function() {
        $(this).closest(".panel-area").after(pertanyaan);
    });

    var subgrup = `
                        <div class="panel-area subgrup">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12 form-judul">
                                            <input class="form-control input-lg isian-judul" id="inputlg" type="text" placeholder="Judul Subgrup..">
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-sm-6" style="text-align:right">
                                            <a href="#" class="btn btn-info hapus hapus-pertanyaan" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-adder">
                                <i class="fa fa-plus-circle tambahkan-pertanyaan" aria-hidden="true"></i>
                                <i class="fa fa-minus tambahkan-subgrup" aria-hidden="true"></i>

                            </div>
                        </div>`;

    $(document).on('click', '.tambahkan-subgrup', function() {
        $(this).closest(".panel-area").after(subgrup);
    });
    var grup1 = `<li><a data-toggle="tab" href="#`;
    var grup2 = `">    <span contenteditable="true">Judul Grup</span></a></li>`;

    var kontengrup1 = `<div id="`;
    var kontengrup2 = `" class="tab-pane fade">
                        <div class="panel-area subgrup subgrupfix">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12 form-judul">
                                            <input class="form-control input-lg isian-judul" id="inputlg" type="text" placeholder="Judul Subgrup..">
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-sm-6" style="text-align:right">
                                            <a href="#" class="btn btn-info hapus hapus-grup" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-adder">
                                <i class="fa fa-plus-circle tambahkan-pertanyaan" aria-hidden="true"></i>
                                <i class="fa fa-minus tambahkan-subgrup" aria-hidden="true"></i>

                            </div>
                        </div>
                    </div>`;
    $(document).on('click', '.tambahkan-grup', function() {
        var waktusekarang = $.now();
        $(this).before(grup1 + waktusekarang + grup2);
        $(".tab-content").eq(0).append(kontengrup1 + waktusekarang + kontengrup2);
    });
    $(document).on('click', '.hapus-grup', function() {
        var id = $(this).closest(".tab-pane").attr("id");
        $('a[href$="' + id + '"]').closest('li').remove();
        $(this).closest(".tab-pane").remove();
    });
</script>
<!-- /.content-wrapper -->
<?php echo view("parts/footer"); ?>