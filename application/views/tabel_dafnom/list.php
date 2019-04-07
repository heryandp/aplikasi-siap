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
            <div class="col-md-4">
                <?php echo anchor(site_url('tabel_dafnom/create'), '<i class="fa fa-plus" aria-hidden="true"></i> Tambah', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-8 text-right">
    		  <?php echo anchor(site_url('tabel_dafnom/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Ekspor Excel', 'class="btn btn-success"'); ?>
    	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
        		    <th>NPWP</th>
                    <th>Kode</th>
                    <th>Masa Pajak</th>
        		    <th>SPTLB</th>
        		    <th width="80px">Action</th>
                </tr>
            </thead>
	    
        </table>
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

                //datatables
                table = $('#mytable').DataTable({ 
             
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "ajax": {
                        "url": "tabel_dafnom/json",
                        "type": "POST",
                    },
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
                });
            });
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
<script>
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