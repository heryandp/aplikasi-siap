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
            <h3 class="box-title">Laporan Hasil Pemeriksaan</h3>
        </div>
        <div class="box-body">
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
                    <th>LHP</th>
                    <th>Tgl LHP</th>
                    <th>Aksi</th>
                 </tr>
            </thead>
        </table>
         <!-- Modals -->
        <?php
        $this->load->view('tabel_dafnom/lhp/modal');
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
                    "ajax": "../grab/jsonlhp",
                    "serverside": true,
                    "responsive": true,
                    "deferRender": true,
                    "columns": [
                        {
                            "data": "id",
                            "orderable": true
                        },{"data" : "nama"},{"data" : "npwp","className" : "dt-head-center"},{"data" : "kode"},{"data" : "masa"},{"data" : "no_lhp"},{"data" : "tgl_lhp"},
                        {   "targets": -1,
                            "data": "status",
                            "orderable": false,
                            render: function(data,type,row,meta) {
                                if (row['no_lhp'] && row['tgl_lhp']) {
                                    return '<button type="button" title="Proses" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#nolhp"><i class="fa fa-check-square" aria-hidden="true"></i> Edit LHP</button>'
                                } else {
                                    return '<button type="button" title="Proses" class="btn btn-success btn-xs" data-toggle="modal" data-target="#nolhp"><i class="fa fa-check-square" aria-hidden="true"></i> Input LHP</button>'
                                }
                            },
                            "className" : "text-center",
                        },
                    ],
                    "order": [[5, 'desc']],
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
                        $('#lhp').val(data['no_lhp']);
                        $('#tgl-lhp').val(data['tgl_lhp']);

                        // Modal Aksi
                        document.getElementById("proses-form").action='lhp_tambah/'+data['idKasus'];
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
    //Mask
    jQuery(function($){
        $("#lhp").mask("LAP-99999/WPJ.05/KP.0205/RIK.SIS/2019");
    });

    //Datepicker
    $('#tgl-lhp').datepicker({
      format: "yyyy-mm-dd",
      todayHighlight: true,
      autoclose: true
    })
</script>

<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>