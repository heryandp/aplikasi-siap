<?php 
$this->load->view('template/head');
?>
<link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/select2.css') ?>"/>
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
            <h3 class="box-title">Surat Perintah Pemeriksaan</h3>
        </div>
        <div class="box-body">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-6">
                <?php echo anchor(site_url('tabel_dafnom/sp2_tambah'), '<i class="fa fa-plus" aria-hidden="true"></i> Tambah', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-6 text-right">
              <?php echo anchor(site_url('tabel_dafnom/sp2_excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Ekspor Excel', 'class="btn btn-success"'); ?>
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
                    <th>SP2</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                 </tr>
            </thead>
        </table>
        <!-- Modals -->
        <?php
        $this->load->view('tabel_dafnom/sp2/modal');
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
                    "ajax": "../grab/jsonsp2",
                    "serverside": true,
                    "responsive": true,
                    "deferRender": true,
                    "columns": [
                       {
                            "data": "id",
                            "orderable": false
                        },{"data" : "nama"},{"data" : "npwp","className" : "dt-head-center"},{"data" : "kode"},{"data" : "masa"},{"data" : "no"},{"data" : "tgl"},
                        {   "targets": -1,
                            "data": "id",
                            "orderable": false,
                            render: function(data,type,row,meta) {
                                return '<a href="../tabel_dafnom/sp2_detil/'+row["idKasus"]+'" id="detil-bro"><button type="button" title="Lihat Detil" class="btn btn-default btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></button></a> <button id="cetak" type="button" title="Cetak Disposisi" class="btn btn-success btn-xs"  data-toggle="modal" data-target="#myModalcetak"><i class="fa fa-print" aria-hidden="true"></i></button> <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModaldel"><i class="fa fa-trash-o" aria-hidden="true"></i></button>'
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
                    // Modal Detil
                   
                    // Modal Aksi
                    document.getElementById("cetak-bro").href='../cetak/sp2/'+data['idKasus'];
                    document.getElementById("hapus-bro").href='../tabel_dafnom/sp2_hapus/'+data['idKasus'];
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
$this->load->view('tabel_dafnom/sp2/js');
$this->load->view('template/js');
?>

<?php
$this->load->view('template/foot');
?>