<!-- Detil -->
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Detil Rencana Penugasan Pemeriksaan</h4>
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
                    <label class="col-md-2 control-label">Kode</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="modal-tujuan" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">NP2 </label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="modal-np2" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Kode</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="modal-kode" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Masa</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="modal-masa" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Keterangan </label>
                    <div class="col-md-9">
                        <textarea type="text" class="form-control" id="modal-keterangan" readonly=""></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Nama </label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" id="modal-nama" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">NPWP </label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" id="modal-npwp" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Tgl. Kembali </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="modal-tglkembali" readonly="">
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

<!-- Proses -->
<div id="modalproses" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Proses ND Rencana Pemeriksaan</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
            <form id="proses-form" class="form-horizontal" action="#" method="post">
                <div class="form-group">
                    <label class="col-md-3 control-label">Status</label>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="dropdown">
                                    <select class="form-control" id="status" name="status-nd">
                                        <option value=1>Proses</option>
                                        <option value=2>Batal</option>
                                        <option value=0>Selesai</option>
                                    </select>
                                </div>
                            </div>
                        </div>                                
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Tanggal</label>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-8">
                            <input type="text" class="form-control" name="tgl-kembali" id="tgl-kembali" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
               <button class="btn btn-success btn-md">Simpan</button>
            </div>
          </form>
        </div>
        <!-- footer modal -->
    </div>
   </div>
</div>