<?php
$this->load->view('template/head');
?>
<link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/chosen.min.css') ?>"/>
<style type="text/css">
.form-horizontal .form-group {
    margin-right: 0px;
    margin-left: 0px;
}
  [data-role="dynamic-fields"] > .form-inline + .form-inline {
    margin-top: 0.5em;
}

[data-role="dynamic-fields"] > .form-inline [data-role="add"] {
    display: none;
}

[data-role="dynamic-fields"] > .form-inline:last-child [data-role="add"] {
    display: inline-block;
}

[data-role="dynamic-fields"] > .form-inline:last-child [data-role="remove"] {
    display: none;
}
</style>
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Surat Perintah Pemeriksaan</h3>
        </div>
        <div class="box-body">
                <form class="form-horizontal" action="<?php echo $action; ?>" method="post">
                  <div class="form-group">
                    <label class="col-md-2 control-label">Case</label>
                    <div class="col-md-4">
                    <?php
                      echo form_dropdown('case', $dd_case, $case_selected, 'class="form-control chosen-case"');
                      ?>
                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-2 control-label">Status</label>
                      <div class="col-md-7">
                          <div class="row">
                              <div class="col-md-4">
                                  <div class="dropdown">
                                      <select class="form-control" id="status" name="status" required>
                                          <option value="" disabled selected>Pilih</option>
                                          <option value="0">Normal</option>
                                          <option value="1">Perubahan</option>
                                      </select>
                                  </div>
                              </div>
                          </div>                                
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label">Nomor SP2</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="nosp2" id="nosp2" value="" autocomplete="off" placeholder="PRIN-00000/WPJ.05/KP.0205/RIK.SIS/2019" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label">Tanggal SP2</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="tglsp2" id="tglsp2" autocomplete="off" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label">Pemeriksa</label>
                      <div class="col-md-7">
                          <div data-role="dynamic-fields">
                            <?php 
                            for($i = 0; $i < 3; $i++){
                                echo '<div class="form-inline form-pemeriksa">
                                <div class="form-group">';
                                echo form_dropdown('pemeriksa[]', $dd_pemeriksa, $pemeriksa_selected, 'class="form-control chosen-pemeriksa" required');
                                echo '</div>
                                  <span>-</span>
                                  <div class="form-group">
                                      <select name="role[]" class="form-control chosen-role" required>
                                        <option value="supervisor">Supervisor</option>
                                        <option value="ketua">Ketua Tim</option>
                                        <option value="anggota">Anggota</option>
                                      </select>
                                  </div>
                                  <button class="btn btn-danger" data-role="remove">
                                      <span class="glyphicon glyphicon-remove"></span>
                                  </button>
                                  <button class="btn btn-primary" id="add" value="1" data-role="add">
                                      <span class="glyphicon glyphicon-plus"></span>
                                  </button>
                              </div>';
                            }
                            ?>
                          </div>
                      </div>
                    </div>
                  <button type="submit" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Simpan</button> 
                  <a href="<?php echo site_url('tabel_dafnom/sp2') ?>" class="btn btn-danger"><i class="fa fa-ban" aria-hidden="true"></i> Batal</a>
                </form>
              </div>
            </div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section><!-- /.content -->

<?php 
$this->load->view('template/js');
$this->load->view('tabel_dafnom/sp2/js');
?>

<?php
$this->load->view('template/foot');
?>