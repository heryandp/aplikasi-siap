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
			<form method="post" action="<?php echo site_url('konfigurasi/update_avatar'); ?>" enctype="multipart/form-data" onsubmit="return checkCoords();">
			    <p><input name="image" id="fileInput" size="30" type="file" /></p>
			    <input type="hidden" id="x" name="x" />
			    <input type="hidden" id="y" name="y" />
			    <input type="hidden" id="w" name="w" />
			    <input type="hidden" id="h" name="h" />
			<p><img id="imagePreview" style="max-width: 100%"/></p>
        </div>
        <div class="modal-footer">
			<input name="upload" type="submit" class="btn btn-success" value="Unggah" />
			</form>
        	<button type="button" class="btn btn-default" id="batalprofil" data-dismiss="modal">Close</button>
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

<!-- jQuery 2.1.3 -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jQuery/jQuery-2.1.3.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jQueryUI/jQuery-ui-1.10.3.min.js') ?>"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/bootstrap/js/pace.min.js') ?>"></script>
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
        <script src="<?php echo base_url('assets/datatables/dataTables.fixedHeader.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.responsive.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/bootstrap/js/responsive.bootstrap.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/select2.min.js') ?>"></script>
        <!-- Upload Profil -->
        <script src="<?php echo base_url('assets/jquery.imgareaselect/scripts/jquery.imgareaselect.min.js') ?>" type="text/javascript"></script>
        <!-- Moment JS -->
        <script src="<?php echo base_url('assets/js/moment.js') ?>" type="text/javascript"></script>
        
<!-- Auto dismiss alert -->
<script type="text/javascript">
	window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 3000);
</script>

<script type="text/javascript">

	// Check coordinates
	function checkCoords(){
	    if(parseInt($('#w').val())) return true;
	    alert('Please select a crop region then press upload.');
	    return false;
	}

	// Set image coordinates
	function updateCoords(im,obj){
	    var img = document.getElementById("imagePreview");
	    var orgHeight = img.naturalHeight;
	    var orgWidth = img.naturalWidth;
		
	    var porcX = orgWidth/im.width;
	    var porcY = orgHeight/im.height;
		
	    $('input#x').val(Math.round(obj.x1 * porcX));
	    $('input#y').val(Math.round(obj.y1 * porcY));
	    $('input#w').val(Math.round(obj.width * porcX));
	    $('input#h').val(Math.round(obj.height * porcY));
	}

	$(document).ready(function(){
	    // Prepare instant image preview
	    var p = $("#imagePreview");
	    $("#fileInput").change(function(){
	        //fadeOut or hide preview
	        p.fadeOut();
			
	        //prepare HTML5 FileReader
	        var oFReader = new FileReader();
	        oFReader.readAsDataURL(document.getElementById("fileInput").files[0]);
			
	        oFReader.onload = function(oFREvent){
	            p.attr('src', oFREvent.target.result).fadeIn();
	        };
	    });
		
	    // Implement imgAreaSelect plugin
	    imgPreview = $('#imagePreview').imgAreaSelect(
	    	{ aspectRatio: '1:1', handles: true , instance: true, onSelectEnd: updateCoords
	    });
	});

	$(document).ready(function(){
	    $("#batalprofil").click(function(){
	        // $("img#imagePreview").hide();
	        imgPreview.cancelSelection();
	        $('form')[0].reset();
	    });
	});

</script>