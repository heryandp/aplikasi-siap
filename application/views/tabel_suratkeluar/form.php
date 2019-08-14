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
            <h3 class="box-title">Surat Keluar</h3>
        </div>
        <div class="box-body">
                <form class="form-horizontal" action="<?php echo $action; ?>" method="post">
                        <div class="form-group">
                            <label class="col-md-1 control-label">Jenis</label>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="dropdown">
                                            <select class="form-control" id="jenis" name="jenis" required="">
                                                <option value="ND">Nota Dinas</option>
                                                <option value="NDRIK">Nota Dinas RIK</option>
                                                <option value="BA">Berita Acara</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-1 control-label">Tanggal <?php echo form_error('tgl') ?></label>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                    <input type="text" class="form-control" name="tgl" id="tgl" value="<?php echo $tgl; ?>" autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-1 control-label">Tujuan <?php echo form_error('tujuan') ?></label>
                            <div class="col-md-3">
                                <?php
                                    echo form_dropdown('tujuan[]', $dd_seksi, $seksi_selected, 'multiple="multiple" class="form-control select2"');
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-1 control-label">Hal <?php echo form_error('hal') ?></label>
                            <div class="col-md-5">
                                <textarea class="form-control" rows="2" name="hal" id="hal" placeholder="Konfirmasi ... / Pengiriman Berkas ... / Rencana Penugasan Pemeriksaan ..."><?php echo $hal;?></textarea>
                            </div>
                        </div>
                        <div id="case-list">
                            <div class="form-group">
                                 <label class="col-md-1 control-label">Case</label>
                                 <div class="col-md-5">
                                    <?php
                                    echo form_dropdown('case', $dd_case, $case_selected, 'class="form-control select2"');
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-1 control-label">Keterangan <?php echo form_error('ket') ?></label>
                            <div class="col-md-5">
                                <textarea class="form-control" rows="2" name="ket" id="ket" placeholder=""><?php echo $ket;?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-1 control-label">Pembuat </label>
                            <div class="col-md-3">
                                <?php 
                                    $value = $this->session->userdata('fullname');
                                    if ($pembuat == '' ) {
                                        echo '<input style="border: none;background-color: #fff0;" tabindex="-1" type="text" class="form-control" name="pembuat" id="pembuat" value="'.$value.'" readonly/>';
                                    } else {
                                        echo '<input style="border: none;background-color: #fff0;" tabindex="-1" type="text" class="form-control" name="pembuat" id="pembuat" value="'.$pembuat.'" readonly/>';
                                    }
                                ?>
                            </div>
                        </div>

                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo $button ?></button> 
                    <a href="<?php echo site_url('tabel_suratkeluar') ?>" class="btn btn-danger"><i class="fa fa-ban" aria-hidden="true"></i> Batal</a>
                </form>
            </div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section><!-- /.content -->

<?php 
$this->load->view('template/js');
$this->load->view('tabel_suratkeluar/js');
?>

<script>
$("#hal").autocomplete({
  source: [ "Pengiriman Berkas LHP a.n. ","Pengiriman Berkas LHP Tujuan Lain","Permintaan Data Tunggakan dan Alket","Rencana Penugasan Pemeriksaan" ]
});
</script>

<?php
$this->load->view('template/foot');
?>