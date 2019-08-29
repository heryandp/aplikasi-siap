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
            <h3 class="box-title">Daftar Tugas</h3>
        </div>
        <div class="box-body">
            <div class="panel panel-info">
              <div class="panel-heading">Info</div>
              <div class="panel-body">
                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="ion ion-document-text"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Proses</span>
                            <span class="info-box-number"><?php echo $proses; ?></span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
              <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="ion ion-document-text"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Selesai</span>
                            <span class="info-box-number"><?php echo $selesai; ?></span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
              </div>
            </div>
            <div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading">Daftar</div>
                  <div class="panel-body">
                    <table class="table table-bordered table-striped" id="example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor</th>
                                <th>Tanggal</th>
                                <th>Hal</th>
                                <th>Asal Surat</th>
                                <th>Proses</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                  </div>
                </div>
            </div>
  </div><!-- /.box-body -->
</div><!-- /.box -->


    </div>
  </div>
</div>

</section><!-- /.content -->

<!-- Modals -->
<?php
$this->load->view('tabel_suratmasuk/modal');
?>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    // New Datatables
    $(document).ready(function() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var table = $('#example').DataTable( {
            "ajax": "tabel_suratmasuk/jsontugas",
            "serverside": true,
            "responsive": true,
            "deferRender": true,
            "columns": [
               {
                    "data": "id",
                    "orderable": false,
                    "className" : "text-center",
                },{"data": "no","className" : "text-center"},{"data": "tgl_surat","className" : "text-center"},{"data": "hal_surat","orderable": false},{"data": "ket"},
                {"data": "proses", 
                  render: function(data) { 
                    if(data == '1') {
                      return '<span class="label label-warning">Proses</span>'
                    }
                    else {
                      return '<span class="label label-success">Selesai</span>'
                    }

                  },
                  "defaultContent": "Proses",
                  "className" : "text-center"
                },
                {   "targets": -1,
                    "orderable": false,
                    "data":"proses",
                    render: function(data) { 
                        if(data =='1') {
                          return '<button type="button" title="Lihat Detil" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye" aria-hidden="true"></i></button> <button type="button" title="Selesai" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModaldone"><i class="fa fa-check-square" aria-hidden="true"></i></button>'
                        }
                        else {
                          return '<button type="button" title="Lihat Detil" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye" aria-hidden="true"></i></button>'
                        }
                    },
                    "className" : "text-center",
                }
            ],
            "order": [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
            }
        } );
        
        $('#example tbody').on( 'click', 'button', function () {
            var data = table.row( $(this).parents('tr') ).data();
            // Modal Detil
            $('#dispo-id').val(data['id']);
            $('#modal-no,#dispo-no').val(data['no']);
            $('#modal-tgl,#dispo-tgl,#edittglsurat').val(data['tgl_surat']);
            if (data['proses'] < 1) {
              var status = 'Selesai';
              $('#modal-proses').val(status);
            } else {
              var status = 'Proses';
              $('#modal-proses').val(status);
            };
            $('#modal-asal,#dispo-asal').val(data['ket']);
            $('#modal-hal,#edithal').val(data['hal_surat']);
            $('#modal-sifat,#dispo-sifat').val(data['sifat']);
            $('#dispo-sifat option').removeAttr('selected');
            $('#modal-sifat,#dispo-sifat').val(data['sifat']);
            $('#modal-pelaksana,#dispo-pelaksana').val(data['pelaksana']);
            $('#modal-keterangan,#dispo-keterangan').val(data['keterangan']);
            $('#modal-catatan,#dispo-catatan').val(data['catatan']);

            //Modal Edit Surat Masuk
            $('#editnosekre').val(data['no_sekre']);
            $('#editnosurat').val(data['no_surat']);
            $('#editasalsuratsekre').val(data['asal_surat']);
            $('#editasalsuratseksi').val(data['seksi']);

            // Modal Aksi
            document.getElementById("hapus-bro").href='tabel_suratmasuk/delete/'+data['id'];
            document.getElementById("selesai-bro").href='tabel_suratmasuk/done/'+data['id'];
            document.getElementById("dispo-form").action='tabel_suratmasuk/dispo/add/'+data['id'];
            document.getElementById("edit-form").action='tabel_suratmasuk/update/'+data['id'];
            } );
        } );
</script>
<?php 
$this->load->view('template/js');
?>
<script type="text/javascript">
    //Datepicker
    $('#edittglsurat').datepicker({
      format: "yyyy-mm-dd",
      todayHighlight: true,
      autoclose: true
    })
</script>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>