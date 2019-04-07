<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Surat Masuk</h3>
    </div>
    <div class="box-body">
      <form class="form-horizontal" action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label class="col-md-1 control-label">Asal</label>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-4">
                        <div class="dropdown">
                            <select class="form-control" id="asal-surat" name="asal-surat" required>
                                <option value="" disabled selected>Pilih</option>
                                <option value="sekretariat">Luar Kantor</option>
                                <option value="seksilain">Seksi Lain</option>
                            </select>
                        </div>
                    </div>
                </div>                                
            </div>
        </div>
        <div class="form-group">
          <label class="col-md-1 control-label">No. Disposisi</label>
          <div class="col-md-6">
              <div class="row">
                  <div class="col-md-5">
                          <?php if ($no == '') {
                              echo '<input type="text" class="form-control" name="no" id="no" readonly required/>
                              ';
                          } else {
                              echo '<input type="text" class="form-control" name="no" id="no" value="'.$no.'"readonly/>';
                          }
                          ?>
                  </div>
                  <div class="col-md-2">
                      <a class="btn btn-info" name="get-nomor" id="get-nomor"><i class="fa fa-download" aria-hidden="true"></i> Ambil Nomor</a>
                  </div>
              </div>
          </div>
        </div>
        <div id="form-utama">
          <!-- Form Surat dari Sekre -->
          <div id="form-sub-sekre">
            <div class="form-group">
              <label class="col-md-1 control-label">No. Sekre</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="nosekre" id="nosekre" placeholder="Nomor dari Sekretariat" value="<?php echo $nosekre; ?>" />
              </div>
            </div>
          </div>
          <!-- Form isian wajib -->
          <div id="form-sub-wajib"> 
            <div class="form-group">
              <label class="col-md-1 control-label">No. Surat</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="nosurat" id="nosurat" placeholder="" value="<?php echo $nosurat; ?>" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-1 control-label">Tgl. Surat</label>
              <div class="col-md-2">
                <input type="text" class="form-control" name="tglsurat" id="tglsurat" autocomplete="off" placeholder="Tgl Surat" value="<?php echo $tglsuratsekre; ?>" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-1 control-label">Hal</label>
            <div class="col-md-4">
              <textarea type="text" class="form-control" name="hal" id="hal" placeholder="Jawaban Konfirmasi .../Permintaan ..." value="<?php echo $hal; ?>" /></textarea>
            </div>
          </div>
          <div id="form-sub-asal-sekre">
            <div class="form-group">
              <label class="col-md-1 control-label">Asal Surat</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="asalsuratsekre" id="asalsuratsekre" placeholder="KPP Pratama ..." value="<?php echo $asalsuratsekre; ?>" />
              </div>
            </div>
          </div>
          <div id="form-sub-asal-seksi">
            <div class="form-group">
              <label class="col-md-1 control-label">Asal Surat</label>
              <div class="col-md-4">
                <?php
                    echo form_dropdown('asalsuratseksi', $dd_seksi, $seksi_selected, 'class="form-control select2"');
                ?>
              </div>
            </div>
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
  	    <button type="submit" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Buat</button> 
  	    <a href="<?php echo site_url('tabel_suratmasuk') ?>" class="btn btn-danger"><i class="fa fa-ban" aria-hidden="true"></i> Batal</a>
  	  </form>
    </div><!-- /.box-body -->
  </div><!-- /.box -->

</section><!-- /.content -->


<?php 
$this->load->view('template/js');
?>

<script>
//Date picker
$('#tglsurat').datepicker({
  format: "yyyy-mm-dd",
  todayHighlight: true,
  autoclose: true
})

//Show Hide Input
$("#form-utama").hide();
$('#asal-surat').change(function() {
   if($(this).val() == "sekretariat")
    {
     $("#form-utama,#form-sub-sekre,#form-sub-asal-sekre").show();
     $("#form-sub-asal-seksi").hide();
     $('#nosurat').attr('placeholder','Nomor Surat dari Luar');
    }
    else
    {
     $("#form-utama,#form-sub-asal-seksi").show();
     $("#form-sub-sekre,#form-sub-asal-sekre").hide();
     $('#nosurat').attr('placeholder','Nomor Surat Seksi Lain');
    }
})

//Get Nomor Surat
$(function(){
    $('#get-nomor').click(function() {
       $.get('<?= base_url()."tabel_suratmasuk/nomorsurat/" ?>', function(data,status){
          $('#no').val(data);
           })
    })
});

</script>

<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>