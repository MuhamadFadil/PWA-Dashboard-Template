<?php
    $ci = & get_instance();
    $csrf_cookie_name = $ci->config->item('csrf_protection') === true ? $ci->config->item('csrf_cookie_name') : '';
?>
<script type="text/javascript">
    var csrf_cookie_name = '<?php echo $csrf_cookie_name; ?>';
</script>