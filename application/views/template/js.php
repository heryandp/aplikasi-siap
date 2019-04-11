</div><!-- /.content-wrapper -->

<!-- Modal Ganti Foto Profil -->
<div id="gantiprofil" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Ganti Profil</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
			<form method="post" action="upload.php" enctype="multipart/form-data" onsubmit="return checkCoords();">
			    <p>Image: <input name="image" id="fileInput" size="30" type="file" /></p>
			    <input type="hidden" id="x" name="x" />
			    <input type="hidden" id="y" name="y" />
			    <input type="hidden" id="w" name="w" />
			    <input type="hidden" id="h" name="h" />
			    <input name="upload" type="submit" value="UPLOAD" />
			</form>
			<p><img id="imagePreview" style="display:none;"/></p>
        </div>
    </div>
   </div>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0 / Pengembangan
    </div>
    <strong>Copyright &copy; 2019 - KPP Pratama Jakarta Grogol Petamburan</strong>
</footer>
</div><!-- ./wrapper -->

<!-- Auto dismiss alert -->
<script type="text/javascript">
	window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 3000);
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
<script src="<?php echo base_url('assets/jquery.imgareaselect/scripts/jquery.imgareaselect.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/jquery.imgareaselect/scripts/effect.js') ?>" type="text/javascript"></script>