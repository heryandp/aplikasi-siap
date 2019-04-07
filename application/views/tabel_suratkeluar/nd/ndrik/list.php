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
            <h3 class="box-title">Nota Dinas - Rencana Pemeriksaan</h3>
        </div>
        <div class="box-body">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-3 text-left">
              <?php echo anchor(site_url('tabel_suratkeluar/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Ekspor Excel', 'class="btn btn-success"'); ?>
            </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="10px">No</th>
                    <th>Wajib Pajak</th>
                    <th>NPWP</th>
                    <th>Kode</th>
                    <th>Masa</th>
                    <th>Tujuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                 </tr>
            </thead>
        </table>
         <!-- Modals -->
        <?php
        $this->load->view('tabel_suratkeluar/nd/ndrik/modal');
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
                    ajax: {"url": "../tabel_suratkeluar/jsonndrik", "type": "POST"},
                    columns: [
                        {
                            "data": "id",
                            "orderable": false
                        },{"data" : "nama"},
                        {"data" : "npwp","orderable": false,"className" : "text-center"},
                        {"data" : "kode","className" : "text-center"},{"data" : "masa","className" : "text-center"},
                        {"data" : "tujuan"},
                        {"data": "status", 
                          render: function(data) { 
                            if(data == '1') {
                              return '<span class="label label-warning">Proses</span>'
                            } else if (data == '2') {
                              return '<span class="label label-danger">Batal</span>'
                            } else {
                              return '<span class="label label-success">Selesai</span>'
                            }
                          },
                          "defaultContent": "Proses",
                          "className" : "text-center"
                        },
                        {   "targets": -1,
                            "data": "status",
                            "orderable": false,
                            render: function(data) { 
                                return '<button type="button" title="Lihat Detil" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye" aria-hidden="true"></i></button> <button type="button" title="Proses" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modalproses"><i class="fa fa-check-square" aria-hidden="true"></i></button>'
                            },
                            "className" : "text-center",
                        },
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
                    $('#modal-no').val(data['nomor']);
                    $('#modal-tgl').val(data['tgl']);
                    $('#modal-tujuan').val(data['tujuan']);
                    $('#modal-np2').val(data['np2']);
                    $('#modal-kode').val(data['kode']);
                    $('#modal-masa').val(data['masa']);
                    $('#modal-keterangan').val(data['ketkode']);
                    $('#modal-nama').val(data['nama']);
                    $('#modal-npwp').val(data['npwp']);
                    $('#modal-tglkembali').val(data['tgl_kembali']);
                   
                    // Modal Aksi
                    document.getElementById("proses-form").action='ndrik_proses/'+data['id'];
                } );
            });
        </script>

  </div><!-- /.box-body -->
</div><!-- /.box -->


    </div>
  </div>
</div>

</section><!-- /.content -->

<?php 
$this->load->view('template/js');
?>

<script type="text/javascript">
    //Datepicker
    $('#tgl-kembali').datepicker({
      format: "yyyy-mm-dd",
      todayHighlight: true,
      autoclose: true
    })
</script>

<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>