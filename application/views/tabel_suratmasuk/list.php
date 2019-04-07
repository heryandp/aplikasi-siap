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
            <h3 class="box-title">Surat Masuk</h3>
        </div>
        <div class="box-body">
            <div class="panel-group">
              <div class="panel panel-info">
                <div class="panel-heading">Info</div>
                <div class="panel-body">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                         <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="fa fa-inbox" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Unassign</span>
                                <span class="info-box-number"><?php echo $unassign; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                         <div class="info-box">
                            <span class="info-box-icon bg-orange"><i class="fa fa-inbox" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Proses</span>
                                <span class="info-box-number"><?php echo $proses; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                         <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-inbox" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Selesai</span>
                                <span class="info-box-number"><?php echo $selesai; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-6">
                <?php echo anchor(site_url('tabel_suratmasuk/create'), '<i class="fa fa-plus" aria-hidden="true"></i> Tambah', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-6 text-right">
              <?php echo anchor(site_url('excel/suratmasuk'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Ekspor Excel', 'class="btn btn-success" target="_blank"'); ?>
            </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor</th>
                    <th>Tanggal</th>
                    <th>Hal</th>
                    <th>Asal Surat</th>
                    <th>Proses</th>
                    <th>Disposisi</th>
                    <th>Aksi</th>
                        </tr>
                    </thead>
        
        </table>
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

        var t = $("#mytable").DataTable({
            initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                        .off('.DT')
                        .on('keyup.DT', function(e) {
                            if (e.keyCode == 13) {
                                api.search(this.value).draw();
                    }
                });
            },
            oLanguage: {
                sProcessing: "memuat..."
            },
            processing: true,
            serverSide: true,
            ajax: {"url": "tabel_suratmasuk/json", "type": "POST"},
            columns: [
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
                {"data": "pelaksana", 
                  render: function(data) { 
                    if(data == null) {
                      return '<span class="label label-danger">Unassign</span>'
                    }
                    else {
                      return '<span class="label label-success">Assigned</span>'
                    }

                  },
                  "defaultContent": "Unassign",
                  "className" : "text-center"
                },
                {   "targets": -1,
                    "orderable": false,
                    "data":"proses",
                    render: function(data) { 
                        if(data =='1') {
                          return '<button type="button" title="Lihat Detil" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye" aria-hidden="true"></i></button>  <button id="cetak" type="button" title="Cetak Disposisi" class="btn btn-success btn-xs"  data-toggle="modal" data-target="#myModalcetak"><i class="fa fa-print" aria-hidden="true"></i></button> <button type="button" title="Buat/Edit Disposisi" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModaldispo"><i class="fa fa-user" aria-hidden="true"></i></button> <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModaledit"><i class="fa fa-pencil" aria-hidden="true"></i></button> <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModaldel"><i class="fa fa-trash-o" aria-hidden="true"></i></button>'
                        }
                        else {
                          return '<button type="button" title="Lihat Detil" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye" aria-hidden="true"></i></button>'
                        }
                    },
                    "className" : "text-center",
                }
            ],
            order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
        $('#mytable tbody').on( 'click', 'button', function () {
            var data = t.row( $(this).parents('tr') ).data();
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
            document.getElementById("cetak-bro").href='tabel_suratmasuk/dispo_cetak/'+data['id'];
            document.getElementById("hapus-bro").href='tabel_suratmasuk/delete/'+data['id'];
            document.getElementById("dispo-form").action='tabel_suratmasuk/dispo/add/'+data['id'];
            document.getElementById("edit-form").action='tabel_suratmasuk/update/'+data['id'];
        } );
    });

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