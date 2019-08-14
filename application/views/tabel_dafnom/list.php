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
            <h3 class="box-title">Daftar Nominatif</h3>
        </div>
        <div class="box-body">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-6">
                <button class="btn btn-primary" onclick="tambah_dafnom()"><i class="fa fa-plus"></i> Tambah</button>
                <button class="btn btn-default" onclick="reload()"><i class="fa fa-refresh"></i> Reload</button>
            </div>
            <div class="col-md-6 text-right">
    		  <?php echo anchor(site_url('tabel_dafnom/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Ekspor Excel', 'class="btn btn-success"'); ?>
    	    </div>
        </div>
        <table class="table table-bordered table-striped" id="example">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
        		    <th>NPWP</th>
                    <th>Kode</th>
                    <th>Masa Pajak</th>
        		    <th>SPTLB</th>
        		    <th>Action</th>
                </tr>
            </thead>
	    
        </table>
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
                    "ajax": "tabel_dafnom/json",
                    "serverside": true,
                    "responsive": true,
                    "deferRender": true,
                    "columns": [
                       {
                            "data": "idKasus",
                            "orderable": false
                        },{"data": "nama"},{"data": "npwp","className" : "text-center"},{"data": "kode","className" : "text-center"},{"data": "masa","className" : "text-center"},{"data": "tglsptlb","className" : "text-center"},
                        {   "targets": -1,
                            "orderable": false,
                            "data": "idKasus",
                            render: function(data) {
                                return '<button type="button" title="Lihat Detil" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye" aria-hidden="true"></i></button> <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModaledit"><i class="fa fa-pencil" aria-hidden="true"></i></button> <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModaldel"><i class="fa fa-trash-o" aria-hidden="true"></i></button>'
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
                    } );
                } );
        </script>

  </div><!-- /.box-body -->
</div><!-- /.box -->

<?php 
$this->load->view('tabel_dafnom/modal');
?>

</section><!-- /.content -->

<?php 
$this->load->view('template/js');
$this->load->view('template/tabel_dafnom/custom');
?>
<script type="text/javascript">
    function tambah_dafnom()
    {
        save_method = 'tambah';
        var min_input = 3;
        $('#form-input')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#tambah').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Daftar Nominatif'); // Set Title to Bootstrap modal title
        $('#btnSave').text('Tambah');
        $('.tglsptlb-input').css('display','none'); // Hide the text input box in default
    }

    function sptlbcek() {
       if($('#sptlb').prop('checked')) {
             $('.tglsptlb-input').css('display','block');
           } else {
             $('.tglsptlb-input').css('display','none');
           }
    }

    function edit_dafnom(id)
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
            url = "<?php echo site_url('tabel_dafnom/create_action')?>";
        } else {
            url = "<?php echo site_url('tabel_dafnom/update')?>";
        }
        
        console.log($('#form-input').serialize());
        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form-input').serialize(),
            success: function(data)
            {
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
    $(function(){
        $('#npwp').focusout(function(){
            var npwp = $('#npwp').val();
            $.get('<?= base_url()."grab/namawp/" ?>'+npwp, function(data){
                if (data == null) {
                    $('#npwp-result').val('NPWP TIDAK DITEMUKAN');
                } else {
                    $('#npwp-result').val(data.nama);
                }
            }, 'json')
        })
    });

    $(function(){
        $('#kode').focusout(function() {
            var kode = $('#kode').val();
            $.get('<?= base_url()."grab/getkode/" ?>'+kode,function(data){
                if(data == null){
                    $('#ketkode').val('KODE TIDAK DITEMUKAN');
                } else {
                    $('#ketkode').val(data.ket);
                }
            },'json');
        })
    })
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