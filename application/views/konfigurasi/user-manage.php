<div class="panel panel-success">
<div class="panel-heading"><i class="fa fa-plus" aria-hidden="true"></i> Tambah User</div>
<div class="panel-body">
<?php echo form_open('auth/create_user', 'class="form-horizontal" id="user-manage" name="user-manage"'); ?>
    <div class="form-group">
    	<label class="col-md-3 control-label">Nama Depan</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Masukkan Nama Depan" required/>
        </div>
    </div>
    <div class="form-group">
    	<label class="col-md-3 control-label">Nama Belakang</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Masukkan Nama Belakang" required/>
        </div>             
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Username</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="email" id="email" placeholder="IP SIKKA" required/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Password</label>
        <div class="col-md-6">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password minimal 8 karakter" required/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Konfirmasi Password</label>
        <div class="col-md-6">
            <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Masukkan kembali password" required/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label"></label>
        <div class="col-md-6">
            <input type="submit" class="btn btn-success" value="Tambah User">
        </div>
    </div>
 </form>
</div>
</div>
</div>
<div class="col-md-6">
<div class="panel panel-info">
  <div class="panel-heading"><i class="fa fa-users" aria-hidden="true"></i> Daftar User</div>
    <table class="table table-bordered table-striped table-hover" id="user-manage-table">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Username</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
           <?php 
            $no = 1;
            foreach($user as $u){ 
            ?>
            <tr>
                <td class="text-center"><?php echo $no++ ?></td>
                <td class="text-center"><?php echo $u->email ?></td>
                <td><?php echo $u->first_name.' '.$u->last_name ?></td>
                <td class="text-center"><?php echo '<a href="user_delete/'.$u->email.'" class="btn btn-danger btn-xs" ><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>'?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>