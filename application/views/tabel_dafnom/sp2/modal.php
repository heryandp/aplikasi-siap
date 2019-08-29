<div id="modal-tambah" class="modal fade" role="dialog" style="overflow:hidden;">
   <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah SP2</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <form id="edit-form" class="form-horizontal" action="#" method="post">
            <div class="form-group">
             <label class="col-md-2 control-label">Case</label>
             <div class="col-md-7">
              <?php
                echo form_dropdown('case', $dd_case, $case_selected, 'id="select2modal" class="form-control select2"');
                ?>
            </div>
            </div>
           <button class="btn btn-success btn-md">Tambah</button>
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
            <h4 class="modal-title">Cetak</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
                Klik cetak untuk mencetak SP2
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
            <a href="#!" id="cetak-bro" target="_blank" class="btn btn-success btn-md">Cetak</a>
            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Tutup</button>
        </div>
    </div>
   </div>
</div>
