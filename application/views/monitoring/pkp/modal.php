<!-- Tambah -->
<div id="tambah" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Permohonan Pencabutan PKP</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
            <form id="proses-form" class="form-horizontal" action="../monitoring/npwp_tambah" method="post">
                <div class="form-group">
                    <label class="col-md-3 control-label">No BPS</label>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-9">
                            <input type="text" class="form-control" name="no-bps" id="no-bps" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Tanggal BPS</label>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-9">
                            <input type="text" class="form-control" name="tgl-bps" id="tgl-bps" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">NPWP</label>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-9">
                            <input type="text" class="form-control" name="npwp" id="npwp" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Nama</label>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-9">
                            <input type="text" class="form-control" name="nama" id="nama" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">HP/Telepon</label>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="telepon" id="telepon" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" class="form-control" name="alasan" value="PKP" autocomplete="off"/>
            <div class="modal-footer">
               <button class="btn btn-success btn-md">Tambah</button>
            </div>
          </form>
        </div>
        <!-- footer modal -->
    </div>
   </div>
</div>

<!-- Hapus -->
<div id="myModaldel" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Hapus</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
                Anda yakin akan menghapus record ini???
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
            <a href="#!" id="hapus" class="btn btn-danger btn-md">Hapus</a>
            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Tutup</button>
        </div>
    </div>
   </div>
</div>