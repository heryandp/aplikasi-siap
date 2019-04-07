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
            <h3 class="box-title">Pemeriksa Pajak</h3>
        </div>
        <div class="box-body">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-6">
                <?php echo anchor(site_url('tabel_suratkeluar/create'), '<i class="fa fa-plus" aria-hidden="true"></i> Tambah', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-6 text-right">
              <?php echo anchor(site_url('tabel_suratkeluar/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Ekspor Excel', 'class="btn btn-success"'); ?>
            </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>IP</th>
                    <th>Role</th>
                    <th width="80px">Aksi</th>
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
                    ajax: {"url": "tabel_pemeriksa/json", "type": "POST"},
                    columns: [
                        {
                            "data": "id",
                            "orderable": false
                        },{"data": "nama"},{"data": "nip"},{"data": "pemeriksa_ip"},{"data": "pemeriksa_role"},
                        {   "targets": -1,
                            "orderable": false,
                            "data": "id",
                            render: function(data) { 
                                return '<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModaledit"><i class="fa fa-pencil" aria-hidden="true"></i></button> <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModaldel"><i class="fa fa-trash-o" aria-hidden="true"></i></button>'
                            },
                            "className" : "text-center",
                        },
                    ],
                    order: [[1, 'asc']],
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

                    // Modal Aksi
                   
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

<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>