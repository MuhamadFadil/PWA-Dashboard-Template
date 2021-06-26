<?php
$data = ['form_editor' => true];
echo view("parts/header", $data);
echo view("parts/settingView");
require_once "push/vendor/autoload.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
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
                                <input id="push" name="push" type="checkbox" onclick="statusToggle()" disabled/>
                                <label for="push" class="label-warning"></label>
                            </div>
                        </li>

                        <li class="list-group-item">
                            Suara Aplikasi
                            <div class="material-switch pull-right">
                                <input id="push-send" name="push-send" type="checkbox" />
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


<script>
var tSwitcher = document.getElementById('push');
let element = document.body;
// tSwitcher.disable = true; 

let onpageLoad = localStorage.getItem("currentStatus") || "";
//console.log(localStorage.getItem(onpageLoad));

if(onpageLoad != null && onpageLoad  == 'ON'){
  tSwitcher.checked = true;
}

element.classList.add(onpageLoad);


function statusToggle(){
  if(tSwitcher.checked){
      localStorage.setItem('currentStatus', 'ON');
      console.log(localStorage.getItem('currentStatus'));
        element.classList.add('ON');
        
    } else {
        localStorage.setItem('currentStatus', '');
        element.classList.remove('ON');
    }
}
</script>

</html>
<br>
<?php echo view("parts/footer"); ?>