<!-- Detil -->
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Detil Surat Masuk</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
             <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-2 control-label">No. Disposisi</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="modal-no" readonly="">
                    </div>
                    <label class="col-md-2 control-label">Tgl. Disposisi </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="modal-tgl" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Status </label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="modal-proses" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Asal Surat </label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="modal-asal" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Hal </label>
                    <div class="col-md-7">
                        <textarea type="text" class="form-control" id="modal-hal" readonly=""></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Sifat </label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="modal-sifat" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Pelaksana </label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="modal-pelaksana" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Keterangan </label>
                    <div class="col-md-7">
                        <textarea type="text" class="form-control" id="modal-keterangan" readonly=""></textarea>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-md-2 control-label">Catatan </label>
                    <div class="col-md-7">
                        <textarea type="text" class="form-control" id="modal-catatan" readonly=""></textarea>
                    </div>
                </div>
            </form>
        </div>
        <!-- footer modal -->
       <!--  <div class="modal-footer">
            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Tutup</button>
        </div> -->
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
<div id="myModaldispo" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Disposisi</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
            <form id="dispo-form" class="form-horizontal" action="#" method="post">
            <input type="hidden" type="text" class="form-control" name="dispo-id" id="dispo-id" />
            <div class="form-group">
               <label class="col-md-2 control-label">No. Disposisi</label>
               <div class="col-md-8">
                  <div class="row">
                     <div class="col-md-5">
                        <input type="text" class="form-control" name="dispo-no" id="dispo-no" readonly/>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label class="col-md-2 control-label">Tgl. Disposisi</label>
               <div class="col-md-3">
                  <input type="text" class="form-control" name="dispo-tgl" id="dispo-tgl" value="" readonly/>
               </div>
            </div>
            <div class="form-group">
               <label class="col-md-2 control-label">Asal</label>
               <div class="col-md-5">
                  <input type="text" class="form-control" name="dispo-asal" id="dispo-asal" value="" readonly/>
               </div>
            </div>
            <div class="form-group">
               <label class="col-md-2 control-label">Sifat</label>
               <div class="col-md-4">
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
               <div class="col-md-5">
                  <select class="form-control" id="dispo-pelaksana" name="dispo-pelaksana">
                      <option selected value="" disabled>Pilih</option>
                      <?php 
                        foreach ($pelaksana as $u) {
                          echo "<option selected value=".$u->ip.">".$u->nama."</option>";
                        }
                      ?>
                  </select>
               </div>
            </div>
            <div class="form-group">
               <label class="col-md-2 control-label">Keterangan</label>
               <div class="col-md-9">
                  <textarea type="text" class="form-control" name="dispo-keterangan" id="dispo-keterangan"/></textarea>
               </div>
            </div>
             <div class="form-group">
               <label class="col-md-2 control-label">Catatan</label>
               <div class="col-md-9">
                  <textarea type="text" class="form-control" name="dispo-catatan" id="dispo-catatan"/></textarea>
               </div>
            </div>
            <button class="btn btn-success btn-md">Buat</button>
            <button type="submit" class="btn btn-default btn-md" data-dismiss="modal">Tutup</button>
          </form>
        </div>
    </div>
   </div>
</div>

<!-- Edit Surat Masuk-->
<div id="myModaledit" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Ubah Surat Masuk</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
            <form id="edit-form" class="form-horizontal" action="#" method="post">
            <input type="hidden" type="text" class="form-control" name="dispo-id" id="dispo-id" />
            <div class="form-group">
               <label class="col-md-2 control-label">No. Disposisi</label>
               <div class="col-md-8">
                  <div class="row">
                     <div class="col-md-5">
                        <input type="text" class="form-control" name="dispo-no" id="dispo-no" readonly/>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Form Surat dari Sekre -->
            <div id="form-sub-sekre">
                <div class="form-group">
                  <label class="col-md-2 control-label">No. Sekre</label>
                  <div class="col-md-7">
                    <input type="text" class="form-control" name="editnosekre" id="editnosekre" placeholder="Nomor dari Sekretariat" value="" />
                  </div>
                </div>
            </div>
            <!-- Form isian wajib -->
            <div id="form-sub-wajib"> 
                <div class="form-group">
                  <label class="col-md-2 control-label">No. Surat</label>
                  <div class="col-md-7">
                    <input type="text" class="form-control" name="editnosurat" id="editnosurat" placeholder="Nomor dari Seksi Lain" value="" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label">Tgl. Surat</label>
                  <div class="col-md-3">
                    <input type="text" class="form-control" name="edittglsurat" id="edittglsurat" placeholder="Tgl Surat" value="" />
                  </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Hal</label>
                <div class="col-md-7">
                  <textarea type="text" class="form-control" name="edithal" id="edithal" placeholder="Jawaban Konfirmasi .../Permintaan ..." value="" /></textarea>
                </div>
            </div>
            <div id="modal-form-sub-asal-sekre">
                <div class="form-group">
                  <label class="col-md-2 control-label">Asal Surat</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="editasalsuratsekre" id="editasalsuratsekre" placeholder="KPP Pratama ..." value="" />
                  </div>
                </div>
           </div>
           <div id="modal-form-sub-asal-seksi">
            <div class="form-group">
              <label class="col-md-2 control-label">Asal Surat</label>
              <div class="col-md-6">
                <select class="form-control" id="editasalsuratseksi" name="editasalsuratseksi">
                  <option value="" disabled selected>Pilih Seksi</option>
                  <?php 
                    foreach ($seksi as $u) {
                      echo "<option value=".$u->kode." disabled selected>".$u->ket."</option>";
                    }
                  ?>
                </select>
              </div>
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

<!-- Cetak -->
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