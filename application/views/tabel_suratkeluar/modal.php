<!-- Detil -->
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Detil Surat Keluar</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
             <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-2 control-label">No. Surat</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="modal-no" readonly="">
                    </div>
                    <label class="col-md-1 control-label">Tgl. </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="modal-tgl" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Jenis </label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="modal-jenis" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Tujuan </label>
                    <div class="col-md-5">
                        <textarea type="text" class="form-control" id="modal-tujuan" readonly=""></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Hal </label>
                    <div class="col-md-7">
                        <textarea type="text" class="form-control" id="modal-hal" readonly=""></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Keterangan </label>
                    <div class="col-md-7">
                        <textarea type="text" class="form-control" id="modal-keterangan" readonly=""></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Pembuat </label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" id="modal-pembuat" readonly="">
                    </div>
                </div>
            </form>
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Tutup</button>
        </div>
    </div>
   </div>
</div>

<!-- Edit Surat Keluar-->
<div id="myModaledit" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Ubah Surat Keluar</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
             <form id="edit-form" class="form-horizontal" action="#" method="post">
                <div class="form-group">
                    <label class="col-md-2 control-label">No. Surat</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="edit-no" readonly="">
                    </div>
                    <label class="col-md-1 control-label">Tgl. </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="edit-tgl" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Jenis </label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="edit-jenis" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Tujuan </label>
                    <div class="col-md-5">
                        <textarea type="text" class="form-control" name="edit-tujuan" id="edit-tujuan"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Hal </label>
                    <div class="col-md-7">
                        <textarea type="text" class="form-control" name="edit-hal" id="edit-hal"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Keterangan </label>
                    <div class="col-md-7">
                        <textarea type="text" class="form-control" name="edit-keterangan" id="edit-keterangan"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Pembuat </label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" id="edit-pembuat" readonly="">
                    </div>
                </div>
           <button class="btn btn-warning btn-md">Update</button>
           <button type="submit" class="btn btn-default btn-md" data-dismiss="modal">Tutup</button>
          </form>
        </div>
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
            <a href="#!" id="hapus-bro" class="btn btn-danger btn-md">Hapus</a>
            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Tutup</button>
        </div>
    </div>
   </div>
</div>

