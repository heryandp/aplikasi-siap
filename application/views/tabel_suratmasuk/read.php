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
        <h2 style="margin-top:0px">Tabel_suratmasuk Read</h2>
        <table class="table">
	    <tr><td>No Disposisi</td><td><?php echo $no_disposisi; ?></td></tr>
	    <tr><td>Tgl Disposisi</td><td><?php echo $tgl_disposisi; ?></td></tr>
	    <tr><td>No Sekre</td><td><?php echo $no_sekre; ?></td></tr>
	    <tr><td>Tgl Sekre</td><td><?php echo $tgl_sekre; ?></td></tr>
	    <tr><td>No Suratsekre</td><td><?php echo $no_suratsekre; ?></td></tr>
	    <tr><td>Tgl Suratsekre</td><td><?php echo $tgl_suratsekre; ?></td></tr>
	    <tr><td>Asal Suratsekre</td><td><?php echo $asal_suratsekre; ?></td></tr>
	    <tr><td>Hal Suratsekre</td><td><?php echo $hal_suratsekre; ?></td></tr>
	    <tr><td>Sifat Disposisi</td><td><?php echo $sifat_disposisi; ?></td></tr>
	    <tr><td>Pelaksana Disposisi</td><td><?php echo $pelaksana_disposisi; ?></td></tr>
	    <tr><td>Ket Disposisi</td><td><?php echo $ket_disposisi; ?></td></tr>
	    <tr><td>Cat Disposisi</td><td><?php echo $cat_disposisi; ?></td></tr>
	    <tr><td>Proses Disposisi</td><td><?php echo $proses_disposisi; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tabel_suratmasuk') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>