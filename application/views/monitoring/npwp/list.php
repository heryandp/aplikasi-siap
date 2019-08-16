<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/chosen.min.css') ?>"/>
<style type="text/css">
    td.details-control {
    background: url('../assets/datatables/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('../assets/datatables/images/details_close.png') no-repeat center center;
}
</style>
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Main content -->
<section class="content">
    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    <!-- Default box -->
    <div class="box">
        <div class="box-body">
        <div class="box-header with-border">
            <h3 class="box-title">Monitoring - Penghapusan NPWP</h3>
        </div>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <button type="button" title="Lihat Detil" class="btn btn-primary btn-md" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button>
            </div>
            <div class="col-md-8 text-right">
    		  <?php echo anchor(site_url('tabel_dafnom/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Ekspor Excel', 'class="btn btn-success"'); ?>
    	    </div>
        </div>
        <!-- Tab -->
        <div class="panel-group">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" href="#collapse1">Summary</a>
              </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse">
              <div class="panel-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tahun</th>
                        <th>Tunggakan</th>
                        <th>Selesai</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>2018</td>
                        <td>9999999</td>
                        <td>9999999</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>2019</td>
                        <td>9999999</td>
                        <td>9999999</td>
                      </tr>
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
        <table id="example" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NPWP</th>
                    <th>BPS</th>
                    <th>Alasan</th>
                    <th>Telepon</th>
                    <th>Status</th>
                    <th>Jatuh Tempo</th>
                    <th>Hasil</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
  </div><!-- /.box-body -->
</div><!-- /.box -->

<?php 
$this->load->view('monitoring/npwp/modal');
?>

</section><!-- /.content -->

<?php 
$this->load->view('template/js');
?>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/chosen.jquery.min.js') ?>"></script>
<script type="text/javascript">
    /* Formatting function for row details - modify as you need */
    function format ( d ) {
        // `d` is the original data object for the row
        return '<div class="panel-group">'+
          '<div class="panel panel-info">'+
            '<div class="panel-heading">Detail</div>'+
        '<table class="table table-bordered table-striped" >'+
            '<tr>'+
                '<td width="15%">Wajib Pajak</td>'+
                '<td width="2%">:</td>'+
                '<td>'+d.nama+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>NPWP</td>'+
                '<td>:</td>'+
                '<td>'+d.npwp+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Alasan</td>'+
                '<td>:</td>'+
                '<td>'+d.alasan+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>BPS</td>'+
                '<td>:</td>'+
                '<td>'+d.usulan+' / '+d.tgl_usulan+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>SP2</td>'+
                '<td>:</td>'+
                '<td>'+d.sp2+' - '+d.tgl_sp2+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>LAP</td>'+
                '<td>:</td>'+
                '<td>'+d.lhp+' - '+d.tgl_lhp+'</td>'+
            '</tr>'+
        '</table>'+
        '</div>'+
        '</div>';
    }
     
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
            "ajax": "../monitoring/json_npwp/5321",
            "serverside": true,
            "responsive": true,
            "columns": [
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                { "data": null,"className" : "text-center"}, 
                { "data": "nama" },
                { "data": "npwp" },
                { "data": "tgl_usulan" },
                { "data": "alasan" },
                {"data": "telepon"},
                { "data": null,
                    render: function(data, type, row, meta) {
                        if (row['idKasus']) {
                            if (row['sp2']) {
                                if (row['lhp']) {
                                    return 'LHP';
                                } else {
                                    return 'SP2';
                                }
                            } else {
                                return 'Dafnom';
                            }
                        } else {
                            return 'Berkas diterima';
                        }
                    },
                    "defaultContent": 'Berkas diterima'
                },
                { "data": null,
                    render:function(data,type,row,meta) {
                        moment.locale('id');
                        var jt = moment(row["tgl_usulan"]).add(6, 'month').fromNow();
                        return jt;
                    },
                "defaultContent": '' },
                {"data": "hasil", 
                  render: function(data,type,row,meta) {
                    if (row['lhp']) {
                        var edit = '<button type="button" class="btn btn-xs" data-toggle="modal" data-target="#myModalhasil"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    } else {
                        var edit = '';
                    }
                       
                    if(data == '1') {
                        return '<span class="label label-success">Diterima</span>'+edit
                    }
                    else if(data == '2') {
                      return '<span class="label label-danger">Ditolak</span>'+edit
                    } else if(data == '3'){
                      return '<span class="label label-danger">TA</span>'+edit
                    } else {
                      return '<span class="label label-warning">Proses</span>'+edit
                    }
                  },
                  "defaultContent": "",
                  "className" : "text-center"
                },
                {   "targets": -1,
                    "data": "id",
                    "orderable": false,
                    render: function(data) {
                        return '<button id="cetak" type="button" title="Cetak Disposisi" class="btn btn-success btn-xs"  data-toggle="modal" data-target="#myModalcetak"><i class="fa fa-print" aria-hidden="true"></i></button> <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModaldel"><i class="fa fa-trash-o" aria-hidden="true"></i></button>'
                    },
                    "className" : "text-center",
                },
            ],
            "order": [[4, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(1)', row).html(index);
            }
        } );
        
        // new $.fn.dataTable.FixedHeader('example');

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
                // Modal Aksi
                document.getElementById("hapus").href='../monitoring/npwp_hapus/'+data['idKasus2'];
                document.getElementById("hasil").action='../monitoring/npwp_hasil/'+data['idKasus2'];
            } );
        } );
</script>
<script>
    //Get WP
    $(function(){
        $('#npwp').focusout(function(){
            var npwp = $('#npwp').val();
            $.get('<?= base_url()."grab/namawp/" ?>'+npwp, function(data){
                if (data == null) {
                    $('#nama').val('NPWP TIDAK DITEMUKAN');
                } else {
                    $('#nama').val(data.nama);
                }
            }, 'json')
        })
    });

    //Select2
    $(document).ready(function () {
        $(".chosen-alasan,.chosen-hasil").chosen({width: "inherit", placeholder: "Pilih Alasan"}) 
    });
    //Mask
    jQuery(function($){
        $("#npwp").mask("99.999.999.9-999.999");
    });

    //Datepicker
    $('#tgl-bps').datepicker({
      format: "yyyy-mm-dd",
      todayHighlight: true,
      autoclose: true
    })


</script>



<?php
$this->load->view('template/foot');
?>