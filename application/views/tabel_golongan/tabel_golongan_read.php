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
        <h2 style="margin-top:0px">Tabel_golongan Read</h2>
        <table class="table">
	    <tr><td>Pangkat</td><td><?php echo $pangkat; ?></td></tr>
	    <tr><td>Golongan</td><td><?php echo $golongan; ?></td></tr>
	    <tr><td>Ruang</td><td><?php echo $ruang; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tabel_golongan') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>