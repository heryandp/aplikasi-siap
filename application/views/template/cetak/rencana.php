<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Cetak Rencana</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/normalize.min.css') ?>">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/paper.css') ?>">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>

    @page { size: 210mm 270mm}
  	.page {
        /*page-break-after: always;*/
        font-family: Arial;
        font-size: 12pt;
        /*width: 210mm;*/
        min-height: 270mm;
        /*margin: 0.5mm auto;*/
    }

    td.kop {
      padding-left: 30mm;
      text-align: center;
      font-weight: bold;
    }

    table.kop,table.tujuan {
      width: 100%;
    }

    p.isi {
      text-indent:20mm;
      text-align: justify;
    }

    p.ttd {
      float: right;
      padding-top: 30px;
      padding-right:70px;
    }

    .kp {
      float: left;
      margin: 80mm 0 0 0;
    }

    table.data , tr.data , td.data {
      border: 1px solid black;
      border-collapse: collapse;
      padding: 0.2mm;
    }

    ol {
      margin-top: 0px;
      padding-left: 25px;
    }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->

  <!-- PAGE 1 -->
  <section class="sheet padding-15mm">
  	<div class="page">
      <!-- KOP SURAT -->
	     <table class="kop">
          <tbody>
                <img src="<?php echo base_url('assets/upload/assets/logo.JPG') ?>" alt="logo" style="padding-top:2mm;padding-left:4mm;width: 100px;position: absolute;">
                <tr>
                  <td class="kop">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</td>
                </tr>
                <tr>
                  <td class="kop" style="font-size: 14px">DIREKTORAT JENDERAL PAJAK</td>
                </tr>
                <tr>
                  <td class="kop">KANTOR WILAYAH DJP JAKARTA BARAT</td>
                </tr>
                <tr>
                  <td class="kop">KANTOR PELAYANAN PAJAK JAKARTA GROGOL PETAMBURAN</td>
                </tr>
                <tr>
                  <td class="kop" style="font-size: 10px;font-weight: lighter;">JL LETJEN S. PARMAN NO 102, RT.2/RW.1, TOMANG, GROGOL PETAMBURAN, JAKARTA BARAT, DKI JAKARTA 11440</td>
                </tr>
                <tr>
                  <td class="kop" style="font-size: 10px;font-weight: lighter;">TELEPON (021) 5605995; FAKSMILE (021) 5650139; SITUS www.pajak.go.id</td>
                </tr>
                <tr>
                  <td class="kop" style="font-size: 10px;font-weight: lighter;">LAYANAN INFORMASI DAN KELUHAN KRING PAJAK (021) 500200; EMAIL pengaduan@pajak.go.id</td>
                </tr>
                <tr>
                  <td style="border-bottom: 3px double black"></td>
                </tr>
          </tbody>
       </table>
      <!-- ISI SURAT -->
      <br>
      <div>
        <center>NOTA DINAS
          <br>
        NOMOR <?php echo $surat->nomor; ?>
        </center>
      </div>
      <br>
      <table class="tujuan">
        <tr>
          <td style="width: 80px">Yth.</td>
          <td>:</td>
          <td><?php echo $surat->tujuan; ?></td>
        </tr>
        <tr>
          <td>Dari</td>
          <td>:</td>
          <td>Kepala Kantor</td>
        </tr>
        <tr>
          <td>Sifat</td>
          <td>:</td>
          <td>Segera</td>
        </tr>
        <tr>
          <td>Lampiran</td>
          <td>:</td>
          <td>1 (satu) set</td>
        </tr>
        <tr>
          <td>Hal</td>
          <td>:</td>
          <td>Penyusunan Rencana Pemeriksaan</td>
        </tr>
        <tr>
          <td>Tanggal</td>
          <td>:</td>
          <td><?php echo $tgl; ?></td>
        </tr>
        <tr>
          <td colspan="3" style="border-bottom: 2px solid black"></td>
        </tr>
      </table>
      <br>
      <p class="isi">Sehubungan dengan akan dilakukannya pemeriksaan terhadap Wajib Pajak:</p>
          <table>
            <tr>
              <td style="width: 150px">Nama</td>
              <td>:</td>
              <td><?php echo $surat->nama; ?></td>
            </tr>
            <tr>
              <td>NPWP</td>
              <td>:</td>
              <td><?php echo $surat->npwp; ?></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>:</td>
              <td><?php echo $surat->alamat.', '.$surat->kelurahan.', '.$surat->kota; ?></td>
            </tr>
            <tr>
              <td>Masa & Tahun Pajak</td>
              <td>:</td>
              <td><?php echo $masa; ?></td>
            </tr>
            <tr>
              <td>Kode Pemeriksaan</td>
              <td>:</td>
              <td><?php echo $surat->kode; ?></td>
            </tr>
            <tr>
              <td>Kriteria Pemeriksaan</td>
              <td>:</td>
              <td><?php echo $surat->ket; ?></td>
            </tr>
          </table>
      <p class="isi">Dengan ini diminta kepada Saudara untuk menyusun usulan Rencana Pemeriksaan sesuai dengan SE-15/PJ/2018 tanggal 13 Agustus 2018 berdasarkan data sebagaimana terlampir.</p><p class="isi">Demikian untuk dilaksanakan sebaik-baiknya dengan penuh tanggung jawab.</p>

      <!-- TTD -->
      <p class="ttd">
        Kepala Kantor <br><br><br><br><br><br>
        Ar Ar Aryaman
      </p>
      <div class="kp">
        Kp.:KP.02/KP.0205/2019
      </div>
	  </div>
  </section>

  <!-- PAGE 2 -->
  <section class="sheet padding-10mm">
    <div class="page">
      <div style="float: right;text-align: left">
        Lampiran <?php echo $surat->nomor; ?> <br>
        Tanggal <?php echo $tgl; ?>
      </div>
      <div style="padding-top:12mm;text-align: center;">
        DAFTAR BERKAS WAJIB PAJAK YANG DIPINJAMKAN<br>DALAM RANGKA PEMERIKSAAN
      </div> <br>
      <table>
          <tr>
            <td>Nama Wajib Pajak</td>
            <td>:</td>
            <td><?php echo $surat->nama ?></td>
          </tr>
          <tr>
            <td>NPWP</td>
            <td>:</td>
            <td><?php echo $surat->npwp ?></td>
          </tr>
          <tr>
            <td>Masa & Tahun Pajak</td>
            <td>:</td>
            <td><?php echo $masa ?></td>
          </tr>
      </table>
      <table class="data" width="100%">
          <tr class="data" style="text-align: center;">
            <td class="data">No.</td>
            <td class="data">Jenis Berkas Wajib Pajak</td>
            <td class="data">Ada/Tidak Ada</td>
            <td sclass="data">Keterangan</td>
          </tr>
          <tr>
            <td class="data" style="vertical-align:top;text-align: center;"> 1 </td>
            <td class="data"> Data SPT
              <ol type="a">
                <li>SPT Tahunan PPh Orang Pribadi / Badan </li>
                <li>SPT PPh Pasal 21 Masa</li>
                <li>SPT PPh Pasal 22 Masa</li>
                <li>SPT PPh Pasal 23 Masa</li>
                <li>SPT PPh Pasal 25 Masa</li>
                <li>SPT PPh Final</li>
                  <ol type="1">
                    <li>PPh Final Pasal 4 ayat (2) Masa ...</li>
                    <li>PPh Final Pasal 15 Masa ...</li>
                  </ol>
                <li>SPT PPN & PPnBM</li>
                  <ol type="1">
                    <li>PPN Dalam Negeri Masa ...</li>
                    <li>PPnBM Masa ...</li>
                  </ol>
              </ol>
            </td>
            <td class="data"></td>
            <td class="data"></td>
          </tr>
          <tr>
            <td class="data" style="vertical-align:top;text-align: center;"> 2 </td>
            <td class="data">Data Keuangan
              <ol type="a">
                <li>Laporan Keuangan Tahun ...</li>
                <li>Daftar Harta dan Kewajiban Tahun ...</li>
              </ol>
            </td>
            <td class="data">
            </td>
            <td class="data"></td>
          </tr>
          <tr>
            <td class="data" style="vertical-align:top;text-align: center;"> 3 </td>
            <td class="data">Profil Wajib Pajak
              <ol type="a">
                <li>Gambaran Usaha</li>
                <li>Komparatif laporan keuangan</li>
                <li>Pohon Kepemilikan</li>
                <li>...</li>
              </ol>
            </td>
            <td class="data"></td>
            <td class="data"></td>
          </tr>
          <tr>
            <td class="data" style="vertical-align:top;text-align: center;"> 4 </td>
            <td class="data">Laporan Hasil Pemeriksaan
              <ol type="a">
                <li>Nomor LAP- ........ /WPJ.05/KP.0205/RIK.SIS/20..</li>
                <li>...</li>
              </ol>
            </td>
            <td class="data"></td>
            <td class="data"></td>
          </tr>
          <tr>
            <td class="data" style="vertical-align:top;text-align: center;"> 5 </td>
            <td class="data">Data Lainnya
              <ol type="a">
                <li>Alat Keterangan/KP Data</li>
                <li>Analisis dan pengembanan IDLP</li>
                <li>Hasil Rekonsiliasi/Ekualisasi</li>
                <li>Data Hutang/Tunggakan Pajak</li>
                <li>...</li>
              </ol>
            </td>
            <td class="data"></td>
            <td class="data"></td>
          </tr>
      </table><br>
      Pengiriman Berkas
      <table class="data" width="100%">
        <tr>
          <td class="data" colspan="3" style="text-align: center;">Yang Menyerahkan</td>
          <td class="data" colspan="3" style="text-align: center;">Yang Menerima</td>
        </tr>
        <tr style="text-align: center;">
          <td class="data">Kepala Seksi Pemeriksaan</td>
          <td class="data">Paraf</td>
          <td class="data">Tanggal</td>
          <td class="data">Supervisor</td>
          <td class="data">Paraf</td>
          <td class="data">Tanggal</td>
        </tr>
        <tr>
          <td class="data" style="padding-bottom: 8mm"><?php echo ucwords(strtolower($kasi->nama)); ?></td>
          <td class="data"></td>
          <td class="data"></td>
          <td class="data" style="padding-bottom: 8mm"><?php echo ucwords(strtolower($supervisor->nama)); ?></td>
          <td class="data"></td>
          <td class="data"></td>
        </tr>
      </table>
      <br>
      Pengembalian Berkas
      <table class="data" width="100%">
        <tr>
          <td class="data" colspan="3" style="text-align: center;">Yang Menyerahkan</td>
          <td class="data" colspan="3" style="text-align: center;">Yang Menerima</td>
        </tr>
        <tr style="text-align: center;">
          <td class="data ttd2">Kepala Seksi Pemeriksaan</td>
          <td class="data ttd2">Paraf</td>
          <td class="data ttd2">Tanggal</td>
          <td class="data ttd2">Supervisor</td>
          <td class="data ttd2">Paraf</td>
          <td class="data ttd2">Tanggal</td>
        </tr>
        <tr>
          <td class="data" style="padding-bottom: 8mm"><?php echo ucwords(strtolower($kasi->nama)); ?></td>
          <td class="data"></td>
          <td class="data"></td>
          <td class="data" style="padding-bottom: 8mm"><?php echo ucwords(strtolower($supervisor->nama)); ?></td>
          <td class="data"></td>
          <td class="data"></td>
        </tr>
      </table>
    </div>
  </section>

</body>

</html>

<script type="text/javascript">
	window.print();
</script>