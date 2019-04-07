</div><!-- /.content-wrapper -->

<!-- Auto dismiss alert -->
<script type="text/javascript">
	window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);
</script>

<!-- jQuery 2.1.3 -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jQuery/jQuery-2.1.3.min.js') ?>"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<!-- Input Mask -->
<script src="<?php echo base_url('assets/js/jquery.inputmask.bundle.js') ?>" type="text/javascript"></script>
<!-- Datepicker JS -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js') ?>" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/slimScroll/jquery.slimScroll.min.js') ?>" type="text/javascript"></script>
<!-- FastClick -->
<script src='<?php echo base_url('assets/AdminLTE-2.0.5/plugins/fastclick/fastclick.min.js') ?>'></script>
<!-- iCheck -->
<script src='<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/icheck.min.js') ?>'></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/app.min.js') ?>" type="text/javascript"></script>
<!-- Datatables -->
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>" type="text/javascript"></script>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0 / Pengembangan
    </div>
    <strong>Copyright &copy; 2019 - KPP Pratama Jakarta Grogol Petamburan</strong>
</footer>
</div><!-- ./wrapper -->