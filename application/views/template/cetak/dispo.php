<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title><?php echo 'Cetak Disposisi - '.$cetak->no ?></title>

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
		<td style="width: 30%;"rowspan="5"><img src="https://4.bp.blogspot.com/-qIjoke_AxpA/UHufovU2bLI/AAAAAAAAAHg/Leqn4WlYV-Y/s1600/Dep.+Perhubungan.JPG" width="70" height="70" style="display:block;margin-left: auto; margin-right: auto;"/></td>
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
		<td style="border: 3px double black;width: 20.2167%; text-align: center;" colspan="2"><strong>DISPOSISI SEKSI PEMERIKSAAN</strong></td>
		</tr>
		<tr>
		<td style="width: 20.2167%" colspan="2">
		<table border="1" style="border-collapse: collapse; width: 100%;">
		<tbody>
		<tr>
		<td style="width: 24%">No. Agenda</td>
		<td style="width: 2.44162%; text-align: center">:</td>
		<td style="width: 76.8047%"><?php echo $cetak->no ?></td>
		</tr>
		<tr>
		<td style="width: 24%">Tgl. Diterima</td>
		<td style="width: 2.44162%; text-align: center">:</td>
		<td style="width: 76.8047%"><?php echo $cetak->waktu ?></td>
		</tr>
		<td style="width: 24%">No. Surat</td>
		<td style="width: 2.44162%; text-align: center">:</td>
		<td style="width: 76.8047%"><?php echo $cetak->no_surat ?></td>
		</tr>
		<tr>
		<td style="width: 24%">Tgl. Surat</td>
		<td style="width: 2.44162%; text-align: center">:</td>
		<td style="width: 76.8047%"><?php echo $cetak->tgl_surat ?></td>
		</tr>
		<tr>
		<td style="width: 24%">Asal Surat</td>
		<td style="width: 2.44162%; text-align: center">:</td>
		<td style="width: 76.8047%">
			<?php 
			if ($cetak->asal_surat) {
				echo $cetak->asal_surat;
			} else {
				echo $cetak->ket;
			};
			?>
		</td>
		</tr>
		<tr>
		<td style="width: 24%">Hal</td>
		<td style="width: 2.44162%; text-align: center">:</td>
		<td style="width: 76.8047%"><p><?php echo $cetak->hal_surat ?></p></td>
		</tr>
		<tr>
		<td style="width: 24%">Sifat</td>
		<td style="width: 2.44162%; text-align: center">:</td>
		<td style="width: 76.8047%">
			<input type="checkbox" class="form-check-input" disabled="disabled"> Biasa<br>
			<input type="checkbox" class="form-check-input" disabled="disabled"> Segera<br>
			<input type="checkbox" class="form-check-input" disabled="disabled"> Sangat Segera<br>
			<input type="checkbox" class="form-check-input" disabled="disabled"> ...<br>
		</td>
		</tr>
		<tr>
		<td style="width: 24%">Diteruskan</td>
		<td style="width: 2.44162%; text-align: center">:</td>
		<td style="width: 76.8047%">
			<?php 
			foreach ($pelaksana as $u) {
				echo "<input type='checkbox' class='form-check-input' disabled='disabled'> ". ucwords(strtolower($u->nama))."<br>";
			};
			?>
			<input type="checkbox" class="form-check-input" disabled="disabled"> ...<br>
		</td>
		</tr>
		<tr>
		<td style="width: 24%">Keterangan</td>
		<td style="width: 2.44162%; text-align: center">:</td>
		<td style="width: 76.8047%">
			<input type="checkbox" class="form-check-input" disabled="disabled"> Dilaksanakan<br>
			<input type="checkbox" class="form-check-input" disabled="disabled"> Dipelajari<br>
			<input type="checkbox" class="form-check-input" disabled="disabled"> Dibicarakan<br>
			<input type="checkbox" class="form-check-input" disabled="disabled"> Diperbaiki<br>
			<input type="checkbox" class="form-check-input" disabled="disabled"> Diedarkan<br>
			<input type="checkbox" class="form-check-input" disabled="disabled"> Diteliti<br>
			<input type="checkbox" class="form-check-input" disabled="disabled"> Diketahui<br>
			<input type="checkbox" class="form-check-input" disabled="disabled"> Jawab<br>
			<input type="checkbox" class="form-check-input" disabled="disabled"> Ingatkan<br>
			<input type="checkbox" class="form-check-input" disabled="disabled"> Simpan<br>
			<input type="checkbox" class="form-check-input" disabled="disabled"> Perbanyak ... kali<br>
			<input type="checkbox" class="form-check-input" disabled="disabled"> ...<br>
		</td>
		</tr>
		<tr>
		<td style="width: 24%">Catatan</td>
		<td style="width: 2.44162%;">:</td>
		<td style="width: 76.8047%;padding-left:5px;">
			<div style="height: 200px; overflow:hidden;">
			      
			</div>
		</td>
		</tr>
		</tbody>
		</table>
		</td>
		</tr>
		</tbody>
		</table>
		<p></p>
		</td>
		</tr>
		</tbody>
	</table>
</div>
  </section>

</body>

</html>

<script type="text/javascript">
	window.print();
</script>