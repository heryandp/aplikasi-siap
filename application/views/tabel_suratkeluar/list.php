<?php 
$this->load->view('template/head');
?>
<link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/select2.css') ?>"/>
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
            <h3 class="box-title">Surat Keluar</h3>
        </div>
        <div class="box-body">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-6">
                <button class="btn btn-primary" onclick="tambah_surat()"><i class="fa fa-plus"></i> Tambah</button>
                <button class="btn btn-default" onclick="reload()"><i class="fa fa-refresh"></i> Reload</button>
            </div>
            <div class="col-md-6 text-right">
              <?php echo anchor(site_url('tabel_suratkeluar/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Ekspor Excel', 'class="btn btn-success"'); ?>
            </div>
        </div>
        <table class="table table-bordered table-striped" id="example">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis</th>
                    <th>Nomor</th>
                    <th>Tanggal</th>
                    <th>Hal</th>
                    <th>Tujuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
        <!-- Modals -->
        <?php
        $this->load->view('tabel_suratkeluar/modal');
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
                "ajax": "tabel_suratkeluar/json",
                "serverside": true,
                "responsive": true,
                "deferRender": true,
                "columns": [
                     {"data": "id","orderable": false},
                     {"data": "jenis"},{"data": "nomor"},{"data": "tgl"},{"data": "hal"},{"data": "tujuan"},
                        {   "targets": -1,
                            "orderable": false,
                            "data": "id",
                            render: function(data, type, row, meta) { 
                                return '<button id="edit" type="button" onclick="edit_surat('+row['id']+')" class="btn btn-warning btn-xs""><i class="fa fa-pencil" aria-hidden="true"></i></button> <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModaldel"><i class="fa fa-trash-o" aria-hidden="true"></i></button>'
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
            
            $('#example tbody').on( 'click', 'button', function () {
                var data = table.row( $(this).parents('tr') ).data();
                // Modal Aksi
                document.getElementById("hapus-bro").href='tabel_suratkeluar/delete/'+data['id'];
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
    function tambah_surat()
    {
        save_method = 'tambah';
        var min_input = 3;
        $('#form-input')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('#jenis').prop("disabled", false );
        $('.help-block').empty(); // clear error string
        $('#tambah').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Surat Keluar'); // Set Title to Bootstrap modal title
        $('#btnSave').text('Tambah');
        $('.select2').val(null).trigger('change');
        $("#case-list").hide();
        $('.case-list').select2({
            minimumInputLength: min_input,
            language: {
              inputTooShort: function () {
                return "Masukkan minimal "+min_input+" karakter ...";
              }
            },
            ajax: {
                url: params => {
                    return `tabel_suratkeluar/jsoncase/${params.term}`
                },
                dataType: 'json',
                data: null,
                delay: 300,
                processResults: function (data) {
                  // Tranforms the top-level key of the response object from 'items' to 'results'
                  const results = data.map(d => ({ 
                    id: d.idKasus, text: d.nama+` - `+d.kode+` - `+d.bln1+d.thn1.substr(-2)+`/`+d.bln2+d.thn2.substr(-2)
                  }))

                  return {
                    results
                  };
                }
            }              
        });
        $("#hal").autocomplete({
          source: [ "Jawaban Konfirmasi Pemeriksaan a.n. ","Konfirmasi Tunggakan ","Permintaan Data ","Pengembalian Berkas ","Rencana Penugasan Pemeriksaan","Pengiriman Berkas LHP a.n. " ],
          appendTo: "#form-input"
        });
    }

    function edit_surat(id)
    {
        save_method = 'edit';
        id_surat = id;
        urlx = 'tabel_suratkeluar/json_edit/'+id_surat;
        var min_input = 3;
        $('#form-input')[0].reset(); // reset form on modals
        $('.select2').val(null).trigger('change');
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
                $('#jenis').prop("disabled", true );
                $('#jenis').val(data.data[0].jenis);
                if (data.data[0].jenis == 'NDRIK') {
                    $('#case-list').show();
                    $('.case-list').select2({
                        minimumInputLength: min_input,
                        language: {
                          inputTooShort: function () {
                            return "Masukkan minimal "+min_input+" karakter ...";
                          }
                        },
                        ajax: {
                            url: params => {
                                return `tabel_suratkeluar/jsoncase/${params.term}`
                            },
                            dataType: 'json',
                            data: null,
                            delay: 300,
                            processResults: function (data) {
                              // Tranforms the top-level key of the response object from 'items' to 'results'
                              const results = data.map(d => ({ 
                                id: d.idKasus, text: d.nama+` - `+d.kode+` - `+d.bln1+d.thn1.substr(-2)+`/`+d.bln2+d.thn2.substr(-2)
                              }))

                              return {
                                results
                              };
                            }
                        }              
                    });
                } else {
                    $('#case-list').hide();
                }
                $('#btnSave').text('Ubah');
                $('#id_surat').val(data.data[0].id);
                $('#hal').val(data.data[0].hal);
                $('#tgl').val(data.data[0].tgl);
                $('#ket').val(data.data[0].ket);

                //Split Tujuan
                var string = data.data[0].tujuan;
                var strings = string.replace(/, /g,',');
                var array = strings.split(',');
                $('.select2').val(array).trigger('change');

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error Pak!');
            }
        });
        return id_surat;
    }

    $('#form-input').on('submit', (e) => {
        e.preventDefault();
        $('#btnSave').text('menyimpan...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 
        var url;

        if(save_method == 'tambah') {
            url = "<?php echo site_url('tabel_suratkeluar/create_action')?>";
        } else {
            url = "<?php echo site_url('tabel_suratkeluar/update')?>";
        }
        
        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form-input').serialize(),
            success: function(data)
            {
                // console.log(data);
                if(data) //if success close modal and reload ajax table
                {
                    $('#tambah').modal('hide');
                        if (save_method == 'tambah') {
                            $('#notifbro').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown(500,0).delay(3000).slideUp(500,0);
                            $('#notifbro_content').html('<i class="icon fa fa-check"></i> Sukses menambahkan data');
                        } else {
                            $('#notifbro').removeClass('hide').addClass('alert alert-warning alert-dismissible').slideDown(500,0).delay(3000).slideUp(500,0);
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

<script>
    $(document).ready(function () {
        $(".select2").select2();
        $("#case-list").hide();
    });

    $("#hal").autocomplete({
      source: [ "Jawaban Konfirmasi Pemeriksaan a.n. ","Usulan Pemeriksaan Data Konkret a.n. ","Usulan Pemeriksaan Rutin a.n. ","Usulan Pemeriksaan Khusus a.n. ", "Penyampaian LHP a.n.",
      "STP/SKP a.n. ","Konfirmasi Pemeriksaan a.n. ","STP Tahunan LB a.n. ","Permintaan Dokumen a.n. " ]
    });


    $('#jenis').change(function() {
       if($(this).val() == "NDRIK")
        {
         $("#case-list").show();
        } else {
         $("#case-list").hide();
        }
    });

    //Datepicker
    $('#tgl').datepicker({
      format: "yyyy-mm-dd",
      todayHighlight: true,
      autoclose: true
    })

</script>

<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>