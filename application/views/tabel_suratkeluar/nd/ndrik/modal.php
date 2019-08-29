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
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="modal-tujuan" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">NP2 </label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="modal-np2" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Kode</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="modal-kode" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Masa</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="modal-masa" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Keterangan </label>
                    <div class="col-md-10">
                        <textarea type="text" class="form-control" id="modal-keterangan" readonly=""></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Nama </label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="modal-nama" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">NPWP </label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="modal-npwp" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Tgl. Kembali </label>
                    <div class="col-md-10">
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
            <form id="proses-form" class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-3 control-label">Status</label>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-9">
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
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-9">
                            <input type="text" class="form-control" name="tgl-kembali" id="tgl-kembali" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                </div>
                <input class="form-control" name="id-ndrik" id="id-ndrik" type="hidden" /></div>
             <div class="modal-footer">
                    <button type="submit" id="btnSave" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Tutup</button>
            </div>
          </form>
        </div>
        <!-- footer modal -->
    </div>
   </div>
</div>

<!-- Cetak -->
<div id="myModalcetak" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Cetak Nota Dinas</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
                Klik Cetak untuk mencetak.
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
            <a href="#!"  target="_blank" id="cetak-bro" class="btn btn-success btn-md">Cetak</a>
            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Tutup</button>
        </div>
    </div>
   </div>
</div>