<?php
$this->load->view('template/head');
?>
<link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/select2.css') ?>"/>
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Daftar Nominatif</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal" action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label class="col-md-2 control-label">Usulan</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="usulan" id="usulan" value="<?php echo $usulan; ?>" autocomplete="off" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Tanggal Usulan</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="tgl_usulan" id="tgl_usulan" value="<?php echo $tgl_usulan; ?>" autocomplete="off" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Kode</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="kode" id="kode" maxlength="4" value="<?php echo $kode; ?>" autocomplete="off" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Kriteria</label>
                    <div class="col-md-8">
                        <textarea class="form-control" rows="3" name="ketkode" id="ketkode" disabled="disabled" autocomplete="off"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">NPWP</label>
                    <div class="row">
                        <div class="col-md-3">
                            <input class="form-control" name="npwp" id="npwp" value="<?php echo $npwp; ?>" autocomplete="off" required></input>
                        </div>
                         <div class="col-md-4">
                            <input class="form-control" id="npwp-result" autocomplete="off"></input>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Masa Pajak</label>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="dropdown">
                                <select class="form-control" id="bln1" name="bln1" required>
                                    <option selected="selected">Bulan 1</option>
                                    <?php 
                                    for ($i=1; $i < 13; $i++) { 
                                        if($i <= 9) {
                                        echo '<option value="0'.$i.'">0'.$i.'</option>';
                                        } else {
                                        echo '<option value="'.$i.'">'.$i.'</option>';    
                                        } 
                                    }
                                    ?>
                                </select>
                            </div>
                         </div>
                         <div class="col-md-2">
                            <div class="dropdown">
                                <select class="form-control" id="thn1" name="thn1" required>
                                    <option selected="selected">Tahun 1</option> 
                                    <?php 
                                    for ($i=date('Y')-10; $i <= date('Y'); $i++) { 
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                         <div class="col-md-2">
                             <div class="dropdown">
                                <select class="form-control" id="bln2" name="bln2" required>
                                    <option selected="selected">Bulan 2</option>
                                    <?php 
                                    for ($i=1; $i < 13; $i++) { 
                                        if($i <= 9) {
                                        echo '<option value="0'.$i.'">0'.$i.'</option>';
                                        } else {
                                        echo '<option value="'.$i.'">'.$i.'</option>';    
                                        } 
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                         <div class="col-md-2">
                             <div class="dropdown">
                                <select class="form-control" id="thn2" name="thn2" required>
                                    <option selected="selected">Tahun 2</option>
                                    <?php 
                                    for ($i=date('Y')-10; $i <= date('Y'); $i++) { 
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Tanggal SPTLB*</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="tglsptlb" id="tglsptlb" value="<?php echo $tglsptlb; ?>" autocomplete="off"/>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-md"><i class="fa fa-plus" aria-hidden="true"></i> Simpan</button>
                <a href="<?php echo site_url('tabel_dafnom') ?>" class="btn btn-danger"><i class="fa fa-ban" aria-hidden="true"></i> Batal</a>
            </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section><!-- /.content -->


<?php 
$this->load->view('template/js');
$this->load->view('template/tabel_dafnom/custom');
?>
<script>
    //Mask
    jQuery(function($){
        $("#npwp").mask("99.999.999.9-999.999");
    });

    //Datepicker
    $('#tglsptlb,#tgl_usulan').datepicker({
      format: "yyyy-mm-dd",
      todayHighlight: true,
      autoclose: true
    })

</script>



<?php
$this->load->view('template/foot');
?>