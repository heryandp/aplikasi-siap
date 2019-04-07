<!-- Detil -->
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Detil Dafnom</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
             <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-2 control-label">Usulan</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="usulan" id="usulan" autocomplete="off" disabled="" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Tanggal Usulan</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="tgl_usulan" id="tgl_usulan" autocomplete="off" disabled="" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Kode</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="kode" id="kode" autocomplete="off" disabled="" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Kriteria</label>
                    <div class="col-md-8">
                        <textarea class="form-control" rows="5" name="ketkode" id="ketkode" disabled="disabled" autocomplete="off"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">NPWP</label>
                    <div class="row">
                        <div class="col-md-4">
                            <input class="form-control" name="npwp" id="npwp" autocomplete="off" disabled="" required></input>
                        </div>
                         <div class="col-md-5">
                            <div class="input-group">
                                <input class="form-control" id="npwp-result" readonly="" autocomplete="off"></input>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Masa Pajak</label>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="dropdown">
                                <select class="form-control" id="bln1" name="bln1" disabled="" required>
                                    <?php 
                                    for ($i=1; $i < 13; $i++) { 
                                        if($i <= 9) {
                                        echo '<option value="0'.$i.'">0'.$i.'</option>';
                                        } else {
                                        echo '<option value="'.$i.'">'.$i.'</option>';    
                                        } 
                                    }
                                    ?>
                                </select>
                            </div>
                         </div>
                         <div class="col-md-2">
                            <div class="dropdown">
                                <select class="form-control" id="thn1" name="thn1" disabled="" required>
                                    <?php 
                                    for ($i=date('Y')-10; $i <= date('Y'); $i++) { 
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                         <div class="col-md-2">
                             <div class="dropdown">
                                <select class="form-control" id="bln2" name="bln2" disabled="" required>
                                    <?php 
                                    for ($i=1; $i < 13; $i++) { 
                                        if($i <= 9) {
                                        echo '<option value="0'.$i.'">0'.$i.'</option>';
                                        } else {
                                        echo '<option value="'.$i.'">'.$i.'</option>';    
                                        } 
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                         <div class="col-md-2">
                             <div class="dropdown">
                                <select class="form-control" id="thn2" name="thn2" disabled="" required>
                                    <?php 
                                    for ($i=date('Y')-10; $i <= date('Y'); $i++) { 
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Tanggal SPTLB*</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="tglsptlb" id="tglsptlb" disabled="" autocomplete="off"/>
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
            <h4 class="modal-title">Ubah Dafnom</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
             <form id="edit-form" class="form-horizontal" action="#" method="post">
                <div class="form-group">
                    <label class="col-md-2 control-label">Usulan</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="usulan" id="usulan" autocomplete="off" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Tanggal Usulan</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="tgl_usulan" id="tgl_usulan" autocomplete="off" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Kode</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="kode" id="kode" autocomplete="off" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Kriteria</label>
                    <div class="col-md-8">
                        <textarea class="form-control" rows="5" name="ketkode" id="ketkode" disabled="disabled" autocomplete="off"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">NPWP</label>
                    <div class="row">
                        <div class="col-md-4">
                            <input class="form-control" name="npwp" id="npwp" autocomplete="off" required></input>
                        </div>
                         <div class="col-md-5">
                            <div class="input-group">
                                <input class="form-control" id="npwp-result" autocomplete="off"></input>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Masa Pajak</label>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="dropdown">
                                <select class="form-control" id="bln1" name="bln1" required>
                                    <?php 
                                    for ($i=1; $i < 13; $i++) { 
                                        if($i <= 9) {
                                        echo '<option value="0'.$i.'">0'.$i.'</option>';
                                        } else {
                                        echo '<option value="'.$i.'">'.$i.'</option>';    
                                        } 
                                    }
                                    ?>
                                </select>
                            </div>
                         </div>
                         <div class="col-md-2">
                            <div class="dropdown">
                                <select class="form-control" id="thn1" name="thn1" required>
                                    <?php 
                                    for ($i=date('Y')-10; $i <= date('Y'); $i++) { 
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                         <div class="col-md-2">
                             <div class="dropdown">
                                <select class="form-control" id="bln2" name="bln2" required>
                                    <?php 
                                    for ($i=1; $i < 13; $i++) { 
                                        if($i <= 9) {
                                        echo '<option value="0'.$i.'">0'.$i.'</option>';
                                        } else {
                                        echo '<option value="'.$i.'">'.$i.'</option>';    
                                        } 
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                         <div class="col-md-2">
                             <div class="dropdown">
                                <select class="form-control" id="thn2" name="thn2" required>
                                    <?php 
                                    for ($i=date('Y')-10; $i <= date('Y'); $i++) { 
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Tanggal SPTLB*</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="tglsptlb" id="tglsptlb" autocomplete="off"/>
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
                Menghapus dafnom akan menghapus record di Dafnom dan SP2. Apakah yakin untuk menghapus record ini???
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
            <a href="#!" id="hapus-bro" class="btn btn-danger btn-md">Hapus</a>
            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Tutup</button>
        </div>
    </div>
   </div>
</div>

