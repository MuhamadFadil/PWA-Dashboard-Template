<script>
    $(document).ready(function() {
      $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
          $('#show_hide_password input').attr('type', 'password');
          $('#show_hide_password i').addClass("fa-eye-slash");
          $('#show_hide_password i').removeClass("fa-eye");
        } else if ($('#show_hide_password input').attr("type") == "password") {
          $('#show_hide_password input').attr('type', 'text');
          $('#show_hide_password i').removeClass("fa-eye-slash");
          $('#show_hide_password i').addClass("fa-eye");
        }
      });
    });
  </script>


  <!-- jQuery 2.2.3 -->
  <!--script src="<?php echo base_url("assets/plugins/jQuery/jquery-2.2.3.min.js"); ?>"></script-->
  <!-- jQuery UI 1.11.4 -->
  <!--script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js");?>"></script-->
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <!--script>
  $.widget.bridge('uibutton', $.ui.button);
</script-->

  <!-- jQuery 2.1.4 -->
  <!--script src="<?php echo base_url("assets/plugins/jQuery/jquery-2.2.3.min.js"); ?>"></script-->
  <!--script>
	$.widget.bridge('uibutton', $.ui.button);
</script-->

  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url("assets/bootstrap/js/bootstrap.min.js"); ?>"></script>
  <!-- Morris.js charts -->
  <!--script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js");?>"></script-->
  <script src="<?php echo base_url("assets/plugins/morris/morris.min.js"); ?>"></script>
  <!-- Sparkline -->
  <script src="<?php echo base_url("assets/plugins/sparkline/jquery.sparkline.min.js"); ?>"></script>
  <!-- jvectormap -->
  <!--script src="<?php echo base_url("assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"); ?>"></script-->
  <!--script src="<?php echo base_url("assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"); ?>"></script-->
  <!-- jQuery Knob Chart -->
  <script src="<?php echo base_url("assets/plugins/knob/jquery.knob.js"); ?>"></script>
  <!-- daterangepicker -->
  <!--script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js");?>"></script-->
  <script src="<?php echo base_url("assets/plugins/daterangepicker/moment.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/plugins/daterangepicker/daterangepicker.js"); ?>"></script>
  <!-- datepicker -->
  <!--script src="<?php echo base_url("assets/plugins/datepicker/bootstrap-datepicker.js"); ?>"></script-->
  <!-- Bootstrap WYSIHTML5 -->
  <script src="<?php echo base_url("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"); ?>"></script>
  <!-- Slimscroll -->
  <script src="<?php echo base_url("assets/plugins/slimScroll/jquery.slimscroll.min.js"); ?>"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url("assets/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/plugins/datatables/dataTables.bootstrap.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/plugins/fastclick/fastclick.js"); ?>"></script>

  <!-- AdminLTE App -->
  <script src="<?php echo base_url("assets/dist/js/app.min.js"); ?>"></script>
  <!-- AdminLTE for demo purposes -->
  <!--script src="<?php echo base_url("assets/dist/js/demo.js"); ?>"></script-->



  <script>
  </script>

  <script src="<?php echo base_url("assets/plugins/toastr/toastr.min.js"); ?>"></script>
  <script>
    toastr.options = {
      "closeButton": true,
      "progressBar": true,
      "positionClass": "toast-bottom-right",
      "showDuration": "400",
      "hideDuration": "1000",
      "timeOut": "7000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  </script>
</body>

</html>