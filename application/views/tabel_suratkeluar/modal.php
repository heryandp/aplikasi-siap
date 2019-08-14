<!-- Tambah Edit-->
<div id="tambah" class="modal fade" role="dialog" style="overflow:hidden">
   <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
             <form id="form-input" class="form-horizontal">
                <div class="form-group jenis">
                    <label class="col-md-2 control-label">Jenis</label>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="dropdown">
                                    <select class="form-control" id="jenis" name="jenis" required>
                                        <option value="ND">Nota Dinas</option>
                                        <option value="NDRIK">Nota Dinas RIK</option>
                                        <option value="BA">Berita Acara</option>
                                    </select>
                                </div>
                            </div>
                        </div>                                
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Tujuan</label>
                    <div class="col-md-10">
                        <?php
                            echo form_dropdown('tujuan[]', $dd_seksi, $seksi_selected, 'multiple="multiple" class="form-control select2" style="width: 100%" required');
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Hal</label>
                    <div class="col-md-10">
                        <textarea class="form-control" rows="2" name="hal" id="hal" placeholder="Konfirmasi ... / Pengiriman Berkas ... / Rencana Penugasan Pemeriksaan ..." required></textarea>
                    </div>
                </div>
                <div id="case-list">
                    <div class="form-group">
                         <label class="col-md-2 control-label">Case</label>
                         <div class="col-md-10">
                            <select name="case" class="form-control case-list" style="width: 100%">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Keterangan</label>
                    <div class="col-md-10">
                        <textarea class="form-control" rows="2" name="ket" id="ket" placeholder=""></textarea>
                    </div>
                </div>
                <div class="form-group">
                      <div class="col-md-9">
                        <input type="hidden" class="form-control" name="id_surat" id="id_surat"/>
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnSave" class="btn btn-primary">Tambah</button>
                    <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Tutup</button>
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
            <a href="#!" id="hapus-bro" class="btn btn-danger btn-md">Hapus</a>
            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Tutup</button>
        </div>
    </div>
   </div>
</div>

