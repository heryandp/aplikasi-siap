<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<style>
.autocomplete-input {
  border: none; 
  font-size: 14px;
  width: 300px;
  height: 24px;
  margin-bottom: 5px;
  padding-top: 2px;
  border: 1px solid #DDD !important;
  padding-top: 0px !important;
  z-index: 1511;
  position: relative;
}
</style>
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
            <h3 class="box-title">Surat Masuk</h3>
        </div>
        <div class="box-body">
            <div class="panel-group" id="infobro">
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
                <button class="btn btn-primary" onclick="tambah_surat()"><i class="fa fa-plus"></i> Tambah</button>
                <button class="btn btn-default" onclick="reload()"><i class="fa fa-refresh"></i> Reload</button>
            </div>
            <div class="col-md-6 text-right">
              <?php echo anchor(site_url('excel/suratmasuk'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Ekspor Excel', 'class="btn btn-success" target="_blank"'); ?>
            </div>
        </div>
        <table class="table table-bordered table-striped" id="example">
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
            "ajax": "tabel_suratmasuk/json",
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
                {"data": "pelaksana", 
                  render: function(data, type, row, meta) { 
                    if(data == null) {
                      return '<span class="label label-danger">Unassign</span> <button id="edit" type="button" onclick="edit_dispo('+row['id']+')" class="btn btn-warning btn-xs""><i class="fa fa-pencil" aria-hidden="true"></i></button>'
                    }
                    else {
                      return '<span class="label label-success">Assigned</span> <button id="edit" type="button" onclick="edit_dispo('+row['id']+')" class="btn btn-warning btn-xs""><i class="fa fa-pencil" aria-hidden="true"></i></button>'
                    }

                  },
                  "defaultContent": "Unassign",
                  "className" : "text-center"
                },
                {   "orderable": false,
                    "data":null,
                    render: function(data, type, row, meta) {
                        if (row['proses']=='1') {
                            // return row['id'];
                            return '<button id="cetak" type="button" title="Cetak Disposisi" class="btn btn-success btn-xs"  data-toggle="modal" data-target="#myModalcetak"><i class="fa fa-print" aria-hidden="true"></i></button> <button id="edit" type="button" onclick="edit_surat('+row['id']+')" class="btn btn-warning btn-xs""><i class="fa fa-pencil" aria-hidden="true"></i></button> <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModaldel"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                        } else {
                            return '<button id="cetak" type="button" title="Cetak Disposisi" class="btn btn-success btn-xs"  data-toggle="modal" data-target="#myModalcetak"><i class="fa fa-print" aria-hidden="true"></i></button>'
                        }
                        
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
                document.getElementById("cetak-bro").href='tabel_suratmasuk/dispo_cetak/'+data['id'];
                document.getElementById("hapus-bro").href='tabel_suratmasuk/delete/'+data['id'];
            } );
        } );
</script>
<?php 
$this->load->view('template/js');
?>
<script type="text/javascript">
    //Datepicker
    $('#edittglsurat,#tglsurat').datepicker({
      format: "yyyy-mm-dd",
      todayHighlight: true,
      autoclose: true
    })

    function tambah_surat()
    {
        save_method = 'tambah';
        $('#form-input')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#tambah').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Surat Masuk'); // Set Title to Bootstrap modal title
        $('#btnSave').text('Tambah');
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
          });
        $("#hal").autocomplete({
          source: [ "Jawaban Konfirmasi Pemeriksaan a.n. ","Usulan Pemeriksaan Data Konkret a.n. ","Usulan Pemeriksaan Rutin a.n. ","Usulan Pemeriksaan Khusus a.n. ", "Penyampaian LHP a.n.",
          "SPT/SKP a.n. ","Konfirmasi Pemeriksaan a.n. ","SPT Tahunan LB a.n. ","SPT Masa PPN LB a.n. ","Permintaan Dokumen a.n. " ],
          appendTo: "#form-input"
        });
    }

    function edit_surat(id)
    {
        save_method = 'edit';
        id_surat = id;
        urlx = 'tabel_suratmasuk/json_edit/'+id_surat;
        $('#form-input')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        
        //Ajax Load data from ajax
        $.ajax({
            url : urlx,
            type: "GET",
            success: function(data)
            {
                $('#tambah').modal('show'); // show bootstrap modal
                $('.modal-title').text('Ubah Surat Masuk'); // Set Title to Bootstrap modal title
                $("#form-utama").show();
                $('#btnSave').text('Ubah');

                $('#id_surat').val(data.data[0].id_surat);
                $('#hal').val(data.data[0].hal_surat);
                $('#tglsurat').val(data.data[0].tgl_surat);
                $('#nosurat').val(data.data[0].no_surat);
                $('#nosekre').val(data.data[0].no_sekre);
                $('#asalsuratsekre').val(data.data[0].asal_surat);
                $('[name="asalsuratseksi"]').val(data.data[0].seksi);
                
                if ($('[name="asalsuratsekre"]').val().length != 0) {
                    $('[name="asal-surat"]').val('sekretariat');
                } else {
                    $('[name="asal-surat"]').val('seksilain');
                    $("#form-sub-sekre").hide();
                    $('#nosurat').attr('placeholder','Nomor Surat dari Luar');
                }

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
                }),

                $("#hal").autocomplete({
                  source: [ "Jawaban Konfirmasi Pemeriksaan a.n. ","Usulan Pemeriksaan Data Konkret a.n. ","Usulan Pemeriksaan Rutin a.n. ","Usulan Pemeriksaan Khusus a.n. ", "Penyampaian LHP a.n.",
                  "SPT/SKP a.n. ","Konfirmasi Pemeriksaan a.n. ","SPT Tahunan LB a.n. ","Permintaan Dokumen a.n. " ],
                  appendTo: "#form-input"
                });

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error Pak!');
            }
        });
        return id_surat;
    }

    function edit_dispo(id)
    {
        save_method = 'dispo';
        id_surat = id;
        urlx = 'tabel_suratmasuk/json_edit/'+id_surat;
        $('#form-input')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url : urlx,
            type: "GET",
            success: function(data)
            {
                $('#disposisi').modal('show'); // show bootstrap modal
                $('.modal-title').text('Disposisi'); // Set Title to Bootstrap modal title
                $('#btnSave').text('Ubah');

                $('#dispo-id').val(data.data[0].id_surat);
                $('#dispo-no').val(data.data[0].no);
                $('#dispo-tgl').val(data.data[0].waktu);
                $('#dispo-asal').val(data.data[0].ket);
                $('#dispo-sifat').val(data.data[0].sifat);
                $('#dispo-pelaksana').val(data.data[0].pelaksana);
                $('#dispo-keterangan').val(data.data[0].keterangan);
                $('#dispo-catatan').val(data.data[0].catatan);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error Pak!');
            }
        });
        return id_surat;
    }

    $('#form-input, #form-input2').on('submit', (e) => {
        e.preventDefault();
        $('#btnSave').text('menyimpan...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 
        var url,data;

        if(save_method == 'tambah') {
            url = "<?php echo site_url('tabel_suratmasuk/create_action')?>";
            data = $('#form-input').serialize();
        } else if (save_method == 'edit') {
            url = "<?php echo site_url('tabel_suratmasuk/update')?>";
            data = $('#form-input').serialize();
        } else if (save_method == 'dispo') {
            url = "<?php echo site_url('tabel_suratmasuk/dispo')?>";
            data = $('#form-input2').serialize();
        }

        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: data,
            success: function(data)
            {
                if(data) //if success close modal and reload ajax table
                {
                    
                    $('#tambah,#disposisi').modal('hide');
                        if (save_method == 'tambah') {
                            $('#notifbro').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown(500,0).delay(3000).slideUp(500,0);
                            $('#notifbro_content').html('<i class="icon fa fa-check"></i> Sukses menambahkan data');
                        } else {
                            $('#notifbro').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown(500,0).delay(3000).slideUp(500,0);
                            $('#notifbro_content').html('<i class="icon fa fa-check"></i> Sukses mengubah data');
                        }
                    $('#example').DataTable().ajax.reload(null,false);
                }
     
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error Pak!');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
     
            }
        });
    })

    function reload() {
        $('#example').DataTable().ajax.reload();
    }

    $("#hapus-bro").click(function( event ) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            success: function(response) {
                $('#myModaldel').modal('hide');
                $('#notifbro').removeClass('hide').addClass('alert alert-danger alert-dismissible').slideDown(500,0).delay(3000).slideUp(500,0);
                $('#notifbro_content').html('<i class="icon fa fa-check"></i> Sukses menghapus data');
                $('#example').DataTable().ajax.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error Pak!');
            }
        });
        return false;
    });
</script>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>