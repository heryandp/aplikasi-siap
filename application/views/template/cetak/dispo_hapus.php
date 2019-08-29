<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Cetak Disposisi</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/normalize.min.css') ?>">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/paper.css') ?>">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
  	@page { size: 105mm 270mm}
  	.page {
        width: 95mm;
        min-height: 270mm;
        margin: 0.5mm auto;
    }

  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">
  	<div class="page">
	<table style="border: 2px double black;border-collapse: collapse;width:100%">
		<tbody>
		<tr>
		<td style="width: 100%;">
		<table style="width: 100%;">
		<tbody>
		<tr>
		<td style="width: 30%;"rowspan="5"><img src="<?php echo base_url('assets/upload/assets/logo.JPG') ?>" width="70" height="70" style="display:block;margin-left: auto; margin-right: auto;"/></td>
		<td style="font-size:9px;text-align: center;"><strong>KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</strong></td>
		</tr>
		<tr>
		<td style="font-size:9px;text-align: center;"><strong>DIREKTORAT JENDERAL PAJAK</strong></td>
		</tr>
		<tr>
		<td style="font-size:9px;text-align: center;"><strong>KANTOR WILAYAH DJP JAKARTA BARAT</strong></td>
		</tr>
		<tr>
		<td style="font-size:9px;text-align: center;"><strong>KPP PRATAMA JAKARTA GROGOL PETAMBURAN</strong></td>
		</tr>
		<tr>
		<td style="font-size:8px;text-align: center;">Jl. Letjen S. Parman No. 102, Jakarta Barat 11430</td>
		</tr>
		<tr>
		<td style="border: 3px double black;width: 20.2167%; text-align: center;" colspan="2"><strong>DISPOSISI SEKSI PEMERIKSAAN<br>PENGHAPUSAN NPWP / PENCABUTAN PKP</strong></td>
		</tr>
		<tr>
		<td style="width: 20.2167%" colspan="2">
		<table border="1" style="border-collapse: collapse; width: 100%;">
		<tbody>
		<tr>
		<td style="width: 24%">Tgl. Diterima</td>
		<td style="width: 2.44162%; text-align: center">:</td>
		<td style="width: 76.8047%"></td>
		</tr>
		<td style="width: 24%">No. BPS</td>
		<td style="width: 2.44162%; text-align: center">:</td>
		<td style="width: 76.8047%"><?php echo $cetak[0]->usulan;?></td>
		</tr>
		<tr>
		<td style="width: 24%">Tgl. BPS</td>
		<td style="width: 2.44162%; text-align: center">:</td>
		<td style="width: 76.8047%"><?php echo $cetak[0]->tgl_usulan;?></td>
		</tr>
		<tr>
		<td style="width: 24%">Wajib Pajak</td>
		<td style="width: 2.44162%; text-align: center">:</td>
		<td style="width: 76.8047%"><?php echo $cetak[0]->nama;?></td>
		</tr>
		<tr>
		<td style="width: 24%">NPWP</td>
		<td style="width: 2.44162%; text-align: center">:</td>
		<td style="width: 76.8047%"><?php echo $cetak[0]->npwp;?></td>
		</tr>
		<tr>
		<td style="width: 24%">Alamat</td>
		<td style="width: 2.44162%; text-align: center">:</td>
		<td style="width: 76.8047%"><?php echo $cetak[0]->alamat;?></td>
		</tr>
		<tr>
		<td style="width: 24%">Jenis</td>
		<td style="width: 2.44162%; text-align: center">:</td>
		<td style="width: 76.8047%">
			<input type="checkbox" class="form-check-input" disabled="disabled"> Penghapusan NPWP OP<br>
			<input type="checkbox" class="form-check-input" disabled="disabled"> Pencabutan PKP<br>
		</td>
		</tr>
		<tr>
		<tr>
		<td style="width: 24%">Alasan</td>
		<td style="width: 2.44162%; text-align: center">:</td>
		<td style="width: 76.8047%">
			<input type="checkbox" class="form-check-input" disabled="disabled"> Meninggal Dunia<br>
			<input type="checkbox" class="form-check-input" disabled="disabled"> Istri Gabung Suami<br>
			<input type="checkbox" class="form-check-input" disabled="disabled"> NPWP Ganda<br>
			<input type="checkbox" class="form-check-input" disabled="disabled"> Meninggalkan Indonesia<br>
			<input type="checkbox" class="form-check-input" disabled="disabled"> ...<br>
			<div style="height: 50px; overflow:hidden;">
			      
			</div>
		</td>
		</tr>
		<td style="width: 24%">Tim</td>
		<td style="width: 2.44162%; text-align: center">:</td>
		<td style="width: 76.8047%">

			<?php 
			foreach ($pelaksana as $u) {
				echo "<input type='checkbox' class='form-check-input' disabled='disabled'> ". ucwords(strtolower($u->nama))."<br>";
			};
			?>
		</td>
		</tr>
		<tr>
		<td style="width: 24%">Catatan</td>
		<td style="width: 2.44162%;">:</td>
		<td style="width: 76.8047%;padding-left:5px;">
			<div style="height: 350px; overflow:hidden;">
			      
			</div>
		</td>
		</tr>
		</tbody>
		</table>
		</td>
		</tr>
		</tbody>
		</table>
		<p><i><small>*) Centang yang diperlukan</small></i></p>
		</td>
		</tr>
		</tbody>
	</table>
</div>
  </section>

</body>

</html>

<!-- <script type="text/javascript">
	window.print();
</script> -->