<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Main content -->
<section class="content">
	<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Konfigurasi User</h3>
        </div>
        <div class="box-body">
        	<div class="row">
			    <div class="col-md-6">
			    <div class="panel panel-warning">
				  <div class="panel-heading"><i class="fa fa-repeat" aria-hidden="true"></i> Ubah Password</div>
				  <div class="panel-body">
				    <?php echo form_open('auth/change_password', 'class="form-horizontal" id="user-change" name="user-change"'); ?>
					    <div class="form-group">
					    	<label class="col-md-3 control-label">Password Lama</label>
					        <div class="col-md-9">
					            <div class="row">
					                <div class="col-md-8">
					                <input type="password" class="form-control" name="old" id="old" placeholder="Masukkan password lama" required>
					                </div>
					            </div>
					        </div>
					    </div>
					    <div class="form-group">
					    	<label class="col-md-3 control-label">Password Baru</label>
					         <div class="col-md-9">
					            <div class="row">
					                <div class="col-md-8">
					                <input type="password" data-minlength="8" class="form-control" name="new" id="new" placeholder="Password Baru, minimal 8 karakter" required>
					                </div>
					            </div>
					        </div>
					    </div>
					    <div class="form-group">
					        <label class="col-md-3 control-label">Konfirmasi Password</label>
					         <div class="col-md-9">
					            <div class="row">
					                <div class="col-md-8">
					               <input type="password" class="form-control" id="new_confirm" name="new_confirm" placeholder="Masukkan kembali password baru" required>
					                <div class="help-block with-errors"></div>
					                </div>
					            </div>
					        </div>
					    </div>
					    <div class="form-group">
					        <label class="col-md-3 control-label"></label>
					         <div class="col-md-9">
					            <input type="submit" class="btn btn-warning" value="Ubah Password">
					        </div>
					    </div>
					</form>
				  </div>
				</div>
				<?php if ($this->ion_auth->is_admin()) {
					$this->load->view('konfigurasi/user-manage');
				};?>
			</div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

</section><!-- /.content -->

<?php 
$this->load->view('template/js');
?>

<!-- Validator JS -->
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.validate.min.js') ?>" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#user-change').validate();
});

$('#user-change').validate({
	rules: {
		old : {},
		new : {
			minlength:8,
		},
		new_confirm : {
			equalTo: "#new",
		},
		first_name : {},
		last_name : {},
	},
	messages : {
		old : {
			required : 'Password lama tidak boleh kosong',
		},
		new : {
			required : 'Password baru tidak boleh kosong',
		},
		new_confirm : {
			required : 'Konfirmasi password tidak boleh kosong',
			equalTo : 'Password baru tidak sama',
		},
	}
});
</script>
<?php
$this->load->view('template/foot');
?>