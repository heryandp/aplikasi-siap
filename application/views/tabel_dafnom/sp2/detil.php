<?php
$this->load->view('template/head');
?>
<link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/select2.css') ?>"/>
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
            <h3 class="box-title">Detil SP2</h3>
        </div>
        <div class="box-body">
          <div class="panel panel-info">
            <div class="panel-heading">Detil Case</div>
            <div class="panel-body">
              <div class="form-group">
                <table class="table table-bordered table-hover table-sm">
                  <tbody>
                    <tr>
                      <td class="col-md-2">NP2</td>
                      <td><?php echo $case->np2; ?></td>
                    </tr>
                    <tr>
                      <td class="col-md-2">NPWP</td>
                      <td><?php echo $case->npwp; ?></td>
                    </tr>
                    <tr>
                      <td class="col-md-2">Wajib Pajak</td>
                      <td><?php echo $case->nama; ?></td>
                    </tr>
                    <tr>
                      <td class="col-md-2">Kode</td>
                      <td><?php echo $case->kode; ?></td>
                    </tr>
                    <tr>
                      <td class="col-md-2">Keterangan Kode</td>
                      <td><?php echo $case->ket; ?></td>
                    </tr>
                    <tr>
                      <td class="col-md-2">Masa</td>
                      <td><?php echo $case->bln1.$case->thn1.'-'.$case->bln2.$case->thn2; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">Detil Pemeriksa</div>
            <div class="panel-body">
              <table class="table table-bordered table-striped table-hover" id="user-manage-table">
                  <thead>
                      <tr>
                          <th class="text-center">No</th>
                          <th class="text-center">Nama</th>
                          <th class="text-center">IP</th>
                          <th class="text-center">NIP</th>
                          <th class="text-center">Pangkat/Golongan</th>
                          <th class="text-center">Role</th>
                      </tr>
                  </thead>
                  <tbody>
                     <?php 
                      $no = 1;
                      foreach($user as $u){ 
                      ?>
                      <tr>
                          <td class="col-md-1 text-center"><?php echo $no++ ?></td>
                          <td class="text-center"><?php echo $u->nama ?></td>
                          <td class="text-center"><?php echo $u->ip ?></td>
                          <td class="text-center"><?php echo $u->nip ?></td>
                          <td class="text-center"><?php echo $u->golongan ?></td>
                          <td><?php echo strtoupper($u->role); ?></td>
                      </tr>
                      <?php } ?>
                  </tbody>
              </table>
            </div>
          </div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section><!-- /.content -->

<?php 
$this->load->view('template/js');
?>

<?php
$this->load->view('template/foot');
?>