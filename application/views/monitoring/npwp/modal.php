<!-- Tambah -->
<div id="tambah" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Permohonan Penghapusan NPWP</h4>
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
                    <label class="col-md-3 control-label">Alasan</label>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-9">
                                <select name="alasan" class="form-control chosen-alasan">
                                    <option value="Meninggal Dunia">Meninggal Dunia</option>
                                    <option value="Istri Gabung Suami">Istri Gabung Suami</option>
                                    <option value="Istri Gabung Suami">NPWP Ganda</option>
                                    <option value="Istri Gabung Suami">Meninggalkan Indonesia</option>
                                </select>
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
            <div class="modal-footer">
               <button class="btn btn-success btn-md">Tambah</button>
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
            <h4 class="modal-title">Cetak Disposisi</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
                Klik Cetak untuk cetak disposisi
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
            <a href="#!" id="hapus" class="btn btn-success btn-md">Cetak</a>
            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Tutup</button>
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
            <a href="#!" id="hapus" class="btn btn-danger btn-md">Hapus</a>
            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Tutup</button>
        </div>
    </div>
   </div>
</div>

<!-- Hasil -->
<div id="myModalhasil" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Hasil</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
            <form id="hasil" class="form-horizontal" action="#" method="post">
                <div class="form-group">
                    <label class="col-md-3 control-label">Hasil</label>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-9">
                                <select name="hasil" id="hasil" class="chosen-hasil">
                                    <option value="0">Proses</option>
                                    <option value="1">Diterima</option>
                                    <option value="2">Ditolak</option>
                                    <option value="3">TA</option>
                                </select>
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