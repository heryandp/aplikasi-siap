<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Tabel_golongan <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Pangkat <?php echo form_error('pangkat') ?></label>
            <input type="text" class="form-control" name="pangkat" id="pangkat" placeholder="Pangkat" value="<?php echo $pangkat; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Golongan <?php echo form_error('golongan') ?></label>
            <input type="text" class="form-control" name="golongan" id="golongan" placeholder="Golongan" value="<?php echo $golongan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ruang <?php echo form_error('ruang') ?></label>
            <input type="text" class="form-control" name="ruang" id="ruang" placeholder="Ruang" value="<?php echo $ruang; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('tabel_golongan') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>