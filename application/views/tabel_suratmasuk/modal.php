<!-- Tambah / Edit -->
<div id="tambah" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
        </div>
        <!-- body modal -->
       <form id="form-input" class="form-horizontal">
        <div class="modal-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Asal Surat</label>
                    <div class="col-md-9">
                        <div class="dropdown">
                            <select class="form-control" id="asal-surat" name="asal-surat" required>
                                <option value="" disabled selected>Pilih</option>
                                <option value="sekretariat">Luar Kantor</option>
                                <option value="seksilain">Seksi Lain</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="form-utama">
                  <div id="form-sub-sekre">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Pengirim</label>
                        <div class="col-md-9">
                           <input type="text" class="form-control" name="asalsuratsekre" id="asalsuratsekre" placeholder="Misal KPP Pratama ..." />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">No. Sekretariat</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nosekre" id="nosekre" placeholder="Nomor dari Sekretariat"/>
                        </div>
                    </div>
                  </div>
                  <div id="form-sub-asal-seksi">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Seksi</label>
                        <div class="col-md-9">
                          <?php echo form_dropdown('asalsuratseksi', $dd_seksi, $seksi_selected, 'class="form-control select2"');?>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-3 control-label">No. Surat</label>
                      <div class="col-md-9">
                         <input type="text" class="form-control" name="nosurat" id="nosurat" placeholder="Nomor Surat" required/>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-3 control-label">Tanggal Surat</label>
                      <div class="col-md-9">
                         <input type="text" class="form-control" name="tglsurat" id="tglsurat" autocomplete="off" placeholder="Tanggal Surat" required/>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-3 control-label">Perihal</label>
                      <div class="col-md-9">
                         <textarea type="text" class="form-control" name="hal" id="hal" placeholder="Misal Jawaban Konfirmasi .../Permintaan ..." required/></textarea>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-md-9">
                        <input type="hidden" class="form-control" name="id_surat" id="id_surat"/>
                      </div>
                  </div>
                </div>
              </div>
              <!-- footer modal -->
              <div class="modal-footer">
                  <button type="submit" id="btnSave" class="btn btn-primary">Tambah</button>
                  <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Tutup</button>
              </div>
            </form>
    </div>
   </div>
</div>

<!-- Selesai -->
<div id="myModaldone" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Ubah Proses</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
                Apakah tugas ini sudah selesai?
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
            <a href="#!" id="selesai-bro" class="btn btn-success btn-md">Selesai</a>
            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Belum</button>
        </div>
    </div>
   </div>
</div>

<!-- Dispo -->
<div id="disposisi" class="modal fade" role="dialog">
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
            <form id="form-input2" class="form-horizontal">
              <input type="hidden" type="text" class="form-control" name="dispo-id" id="dispo-id" />
              <div class="form-group">
                 <label class="col-md-2 control-label">No. Disposisi</label>
                 <div class="col-md-10">
                    <input type="text" class="form-control" name="dispo-no" id="dispo-no" readonly/>
                 </div>
              </div>
              <div class="form-group">
                 <label class="col-md-2 control-label">Tgl. Disposisi</label>
                 <div class="col-md-10">
                    <input type="text" class="form-control" name="dispo-tgl" id="dispo-tgl" value="" readonly/>
                 </div>
              </div>
              <div class="form-group">
                 <label class="col-md-2 control-label">Asal</label>
                 <div class="col-md-10">
                    <input type="text" class="form-control" name="dispo-asal" id="dispo-asal" value="" readonly/>
                 </div>
              </div>
              <div class="form-group">
                 <label class="col-md-2 control-label">Sifat</label>
                 <div class="col-md-10">
                     <select class="form-control" id="dispo-sifat" name="dispo-sifat">
                        <option selected value="" disabled>Pilih</option>
                        <option value="Biasa">Biasa</option>
                        <option value="Segera">Segera</option>
                        <option value="Sangat Segera">Sangat Segera</option>
                    </select>
                 </div>
              </div>
              <div class="form-group">
                 <label class="col-md-2 control-label">Pelaksana</label>
                 <div class="col-md-10">
                    <select class="form-control" id="dispo-pelaksana" name="dispo-pelaksana">
                        <option selected value="" disabled>Pilih</option>
                        <?php 
                          foreach ($pelaksana as $u) {
                            echo "<option value=".$u->ip.">".$u->nama."</option>";
                          }
                        ?>
                    </select>
                 </div>
              </div>
              <div class="form-group">
                 <label class="col-md-2 control-label">Keterangan</label>
                 <div class="col-md-10">
                    <textarea type="text" class="form-control" name="dispo-keterangan" id="dispo-keterangan"/></textarea>
                 </div>
              </div>
              <div class="form-group">
                 <label class="col-md-2 control-label">Catatan</label>
                 <div class="col-md-10">
                    <textarea type="text" class="form-control" name="dispo-catatan" id="dispo-catatan"/></textarea>
                 </div>
              </div>
              <!-- footer modal -->
              <div class="modal-footer">
                  <button type="submit" id="btnSave" class="btn btn-primary">Simpan</button>
                  <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Tutup</button>
              </div>
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
                Anda yakin akan menghapus record ini??? Record yang bisa dihapus adalah record dengan nomor surat terakhir.
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
            <a href="#!" id="hapus-bro" class="btn btn-danger btn-md">Hapus</a>
            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Tutup</button>
        </div>
    </div>
   </div>
</div>

<!-- Cetak Disposisi-->
<div id="myModalcetak" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Cetak Disposisi</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
                Klik Cetak untuk mencetak disposisi
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
            <a href="#!"  target="_blank" id="cetak-bro" class="btn btn-success btn-md">Cetak</a>
            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Tutup</button>
        </div>
    </div>
   </div>
</div>