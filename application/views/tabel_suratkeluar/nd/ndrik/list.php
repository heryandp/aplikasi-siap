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
    <div class="hide" id="notifbro"><div id="notifbro_content"></div></div>
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Nota Dinas - Rencana Pemeriksaan</h3>
        </div>
        <div class="box-body">
            <div class="panel-group">
              <div class="panel panel-info">
                <div class="panel-heading">Info</div>
                <div class="panel-body">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                         <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-inbox" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Selesai</span>
                                <span class="info-box-number"><?php echo $selesai; ?></span>
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
                            <span class="info-box-icon bg-red"><i class="fa fa-inbox" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Batal</span>
                                <span class="info-box-number"><?php echo $batal; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-3 text-left">
              <?php echo anchor(site_url('tabel_suratkeluar/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Ekspor Excel', 'class="btn btn-success"'); ?>
            </div>
        </div>
        <table class="table table-bordered table-striped" id="example">
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
                "ajax": "../tabel_suratkeluar/jsonndrik",
                "serverside": true,
                "responsive": true,
                "deferRender": true,
                "columns": [
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
                            render: function(data, type, row, meta) { 
                                return '<button type="button" title="Lihat Detil" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye" aria-hidden="true"></i></button> <button id="cetak" type="button" title="Cetak Disposisi" class="btn btn-success btn-xs"  data-toggle="modal" data-target="#myModalcetak"><i class="fa fa-print" aria-hidden="true"></i></button> <button type="button" title="Proses" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modalproses"><i class="fa fa-check-square" aria-hidden="true"></i></button>'
                            },
                            "className" : "text-center",
                        },
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
            
            // Add event listener for opening and closing details
            $('#example tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );
         
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );
            $('#example tbody').on( 'click', 'button', function () {
                    var data = table.row( $(this).parents('tr') ).data();
                    console.log(data);
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

                    $('#status').val(data['status']);
                    $('#tgl-kembali').val(data['tgl_kembali']);
                    $('#id-ndrik').val(data['id']);

                    // Modal Aksi
                    document.getElementById("cetak-bro").href='../cetak/rencana/'+data['id'];
                } );
            } );
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

    $('#proses-form').on('submit', (e) => {
        e.preventDefault();
        $('#btnSave').text('menyimpan...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 
        var url;
        // url = window.location.pathname;
        // ajax adding data to database
        $.ajax({
            url : 'ndrik_proses',
            type: "POST",
            data: $('#proses-form').serialize(),
            success: function(data)
            {
                if(data) //if success close modal and reload ajax table
                {
                    $('#modalproses').modal('hide');
                    $('#notifbro').removeClass('hide').addClass('alert alert-warning alert-dismissible').slideDown(500,0).delay(3000).slideUp(500,0);
                    $('#notifbro_content').html('<i class="icon fa fa-check"></i> Sukses mengubah data');
                    $('#example').DataTable().ajax.reload(null,false);
                }
     
                $('#btnSave').text('menyimpan'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error Pak!');
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
     
            }
        });
    })
</script>

<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>