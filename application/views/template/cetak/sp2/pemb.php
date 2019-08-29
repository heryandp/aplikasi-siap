<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Cetak SP2</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/normalize.min.css') ?>">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/paper.css') ?>">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>

    @page {
      margin: 5mm auto;
      size: 210mm 270mm
    }
  	.page {
        /*page-break-after: always;*/
        font-family: Arial;
        font-size: 11pt;
        /*width: 210mm;*/
        min-height: 270mm;
        margin: 5mm auto;
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
      font-size: 11pt;
      text-indent:10mm;
      text-align: justify;
    }

    p.ttd {
      float: right;
      padding-top: 5px;
      padding-right:70px;
    }

    table.data , tr.data , td.data {
      font-size: 11pt;
      border: 1px solid black;
      border-collapse: collapse;
      padding: 0.2mm;
    }

    table.data.pemeriksa{
      font-weight: bold;
    }

    td.data.pemeriksa{
      text-align: center;
    }
  
    .sheet {
      padding: 5mm 10mm 0mm 20mm;
    }
   
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->

  <!-- PAGE 1 -->
  <section class="sheet">
  	<div class="page">
      <!-- KOP SURAT -->
	     <table class="kop">
          <tbody>
                <img src="<?php echo base_url('assets/upload/assets/logo.JPG') ?>" alt="logo" style="padding-top:2mm;padding-left:4mm;width: 100px;position: absolute;">
                <tr>
                  <td class="kop" style="font-size: 14pt">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</td>
                </tr>
                <tr>
                  <td class="kop" style="font-size: 14pt">DIREKTORAT JENDERAL PAJAK</td>
                </tr>
                <tr>
                  <td class="kop" style="font-size: 12pt">KANTOR WILAYAH DJP JAKARTA BARAT</td>
                </tr>
                <tr>
                  <td class="kop" style="font-size: 12pt">KANTOR PELAYANAN PAJAK JAKARTA GROGOL PETAMBURAN</td>
                </tr>
                <tr>
                  <td class="kop" style="font-size: 6pt;font-weight: lighter;">JL LETJEN S. PARMAN NO 102, RT.2/RW.1, TOMANG, GROGOL PETAMBURAN, JAKARTA BARAT, DKI JAKARTA 11440</td>
                </tr>
                <tr>
                  <td class="kop" style="font-size: 6pt;font-weight: lighter;">TELEPON (021) 5605995; FAKSMILE (021) 5650139; SITUS www.pajak.go.id</td>
                </tr>
                <tr>
                  <td class="kop" style="font-size: 6pt;font-weight: lighter;">LAYANAN INFORMASI DAN KELUHAN KRING PAJAK (021) 500200; EMAIL pengaduan@pajak.go.id</td>
                </tr>
                <tr>
                  <td style="border-bottom: 3px double black"></td>
                </tr>
          </tbody>
       </table>
      <!-- ISI SURAT -->
      <br>
      <div>
        <center><div style="text-decoration: underline;font-weight: bold;">SURAT PERINTAH PEMERIKSAAN</div>
        Nomor :  <?php echo $sp2->no ?>
        </center>
      </div>
      <br>
      <p>Kepada Saudara yang namanya tersebut di bawah ini :</p>
      <table class="data pemeriksa" width="100%">
        <tr class="data" style="text-align: center">
          <td class="data">No.</td>
          <td class="data">Nama/NIP</td>
          <td class="data pemeriksa">Pangkat / Golongan</td>
          <td class="data pemeriksa">Jabatan</td>
        </tr>
         <?php 
            $x = 1;
            $roles = array('supervisor'=>'Ketua Kelompok Pemeriksaan','ketua'=>'Ketua Tim Pemeriksaan','anggota'=>'Anggota Tim Pemeriksaan');
            foreach ($pemeriksa as $u) {
              echo '<tr class="data">
                <td class="data" style="text-align: center;">'.$x.'</td>
                <td class="data">'.$u->nama.'<br>'.$u->nip.'</td>
                <td class="data pemeriksa">'.$u->golongan.'</td>
                <td class="data pemeriksa">'.strtr($u->role,$roles).'</td>
              </tr>';
            $x++;
            }
          ?>
      </table>    
      <p style="text-align: justify;">diperintahkan untuk melakukan pemeriksaan dibidang perpajakan  sesuai dengan Undang-Undang Nomor 6 Tahun 1983 tentang Ketentuan Umum dan Tata Cara Perpajakan sebagaimana telah beberapa kali diubah terakhir dengan Undang-Undang Nomor 16 Tahun 2009 terhadap Wajib Pajak:</p>
       <table width="100%">
      <tr>
        <td width="20%">Nama</td>
        <td>:</td>
        <td><?php echo $sp2->nama ?></td>
      </tr>
      <tr>
        <td>NPWP</td>
        <td>:</td>
        <td><?php echo $sp2->npwp ?></td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td>:</td>
        <td><?php echo $sp2->alamat ?></td>
      </tr>
      <tr>
        <td>Masa & Tahun Pajak</td>
        <td>:</td>
        <td><?php echo $masa ?></td>
      </tr>
      <tr>
        <td>Kode/Kriteria Pemeriksaan</td>
        <td>:</td>
        <td style="text-align: justify;"><?php echo $sp2->kode.' ('.$sp2->ket.')' ?></td>
      </tr>
      <tr>
        <td>Tujuan Pemeriksaan</td>
        <td>:</td>
        <td><?php echo $sp2->tujuan_pem ?></td>
      </tr>
    </table>

      <!-- TTD -->
      <p class="ttd">
        Jakarta, <?php echo $tgl ?><br>
        a.n. Direktur Jenderal Pajak<br>
        Kepala Kantor <br><br><br><br><br><br>
        Ar Ar Aryaman
      </p>
	  </div>
  </section>

  <!-- PAGE 2 -->
  <section class="sheet">
    <div class="page">
    <!-- KOP SURAT -->
    <table class="kop">
      <tbody>
            <img src="https://2.bp.blogspot.com/-v5yvCiKBYzo/T8hUC328YvI/AAAAAAAAAWo/XGziAXqcO9A/s1600/LOGO%2BDepkeu.JPG" alt="logo" style="padding-top:2mm;padding-left:4mm;width: 100px;position: absolute;">
            <tr>
              <td class="kop" style="font-size: 14pt">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</td>
            </tr>
            <tr>
              <td class="kop" style="font-size: 14pt">DIREKTORAT JENDERAL PAJAK</td>
            </tr>
            <tr>
              <td class="kop" style="font-size: 12pt">KANTOR WILAYAH DJP JAKARTA BARAT</td>
            </tr>
            <tr>
              <td class="kop" style="font-size: 12pt">KANTOR PELAYANAN PAJAK JAKARTA GROGOL PETAMBURAN</td>
            </tr>
            <tr>
              <td class="kop" style="font-size: 6pt;font-weight: lighter;">JL LETJEN S. PARMAN NO 102, RT.2/RW.1, TOMANG, GROGOL PETAMBURAN, JAKARTA BARAT, DKI JAKARTA 11440</td>
            </tr>
            <tr>
              <td class="kop" style="font-size: 6pt;font-weight: lighter;">TELEPON (021) 5605995; FAKSMILE (021) 5650139; SITUS www.pajak.go.id</td>
            </tr>
            <tr>
              <td class="kop" style="font-size: 6pt;font-weight: lighter;">LAYANAN INFORMASI DAN KELUHAN KRING PAJAK (021) 500200; EMAIL pengaduan@pajak.go.id</td>
            </tr>
            <tr>
              <td style="border-bottom: 3px double black"></td>
            </tr>
      </tbody>
   </table>
    
    <table width="100%">
      <tr>
        <td>Nomor</td>
        <td>:</td>
        <td><?php echo 'PEMB-'.$explode[1] ?></td>
        <td style="text-align: right;">Jakarta, <?php echo $tgl ?></td>
      </tr>
      <tr>
        <td>Hal</td>
        <td>:</td>
        <td>Pemberitahuan Pemeriksaan Lapangan</td>
        <td></td>
      </tr>
    </table>
    
    <br>
    <table width="50%">
      <tr>
        <td>Yth. <?php echo $sp2->nama; ?></td>
      </tr>
      <tr>
        <td><?php echo $sp2->alamat; ?></td>
      </tr>
    </table>

    <p class="isi">
      Sehubungan dengan Surat Perintah Pemeriksaan Nomor <?php echo $sp2->no.' tanggal '.$tgl ?> bersama ini diberitahukan bahwa:
    </p>
    <table class="data" width="100%">
      <tr class="data" style="text-align: center">
        <td class="data">No.</td>
        <td class="data">Nama/NIP</td>
        <td class="data pemeriksa">Pangkat / Golongan</td>
        <td class="data pemeriksa">Jabatan</td>
      </tr>
     <?php 
          $x = 1;
          $roles = array('supervisor'=>'Ketua Kelompok Pemeriksaan','ketua'=>'Ketua Tim Pemeriksaan','anggota'=>'Anggota Tim Pemeriksaan');
          foreach ($pemeriksa as $u) {
            echo '<tr class="data">
              <td class="data" style="text-align: center;">'.$x.'</td>
              <td class="data">'.$u->nama.'<br>'.$u->nip.'</td>
              <td class="data pemeriksa">'.$u->golongan.'</td>
              <td class="data pemeriksa">'.strtr($u->role,$roles).'</td>
            </tr>';
          $x++;
          }
        ?>
    </table>  

    <p style="text-align: justify;">
      Diperintahkan untuk melakukan Pemeriksaan Lapangan di bidang perpajakan dengan jangka waktu pengujian paling lama 6 (enam) bulan terhadap perusahaan/pekerjaan Saudara di bawah ini :
    </p>
    <table width="100%">
      <tr>
        <td width="20%">Nama</td>
        <td>:</td>
        <td><?php echo $sp2->nama; ?></td>
      </tr>
      <tr>
        <td>NPWP</td>
        <td>:</td>
        <td><?php echo $sp2->npwp; ?></td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td>:</td>
        <td><?php echo $sp2->alamat; ?></td>
      </tr>
      <tr>
        <td>Masa & Tahun Pajak</td>
        <td>:</td>
        <td><?php echo $masa ?></td>
      </tr>
      <tr>
        <td>Kode/Kriteria Pemeriksaan</td>
        <td>:</td>
        <td style="text-align: justify;"><?php echo $sp2->kode.' ('.$sp2->ket.')'; ?></td>
      </tr>
      <tr>
        <td>Tujuan Pemeriksaan</td>
        <td>:</td>
        <td><?php echo $sp2->tujuan_pem; ?></td>
      </tr>
    </table>
    <p class="isi">
      Untuk kelancaran jalannya pemeriksaan, diminta agar Saudara memperlihatkan dan/atau meminjamkan buku atau catatan dan dokumen dan memberikan keterangan yang diperlukan.
    </p>       
    <p class="isi">
      Menolak untuk dilakukan pemeriksaan  atau tidak membantu kelancaran jalannya pemeriksaan,  dapat dikenai sanksi sesuai dengan ketentuan yang diatur dalam Undang-undang Nomor 6 Tahun 1983 tentang Ketentuan Umum dan Tata Cara Perpajakan sebagaimana telah beberapa kali diubah terakhir dengan Undang-undang Nomor 16 Tahun 2009.
    </p>
    <p class="isi">
      Demikian untuk menjadi perhatian Saudara dan atas kejasamanya diucapkan terima kasih.
    </p>

    <!-- TTD -->
    <p class="ttd">
      Kepala Kantor <br><br><br><br><br><br>
      Ar Ar Aryaman
    </p>

    <!-- CAP -->
    <div style="position: absolute;float: left;padding: 90px 0">
      <table style="border:1px dotted;font-size: 8pt" width="240px">
        <tr>
          <td width="30px">Diterima oleh</td>
          <td>:</td>
          <td></td>
        </tr>
        <tr>
          <td>Jabatan</td>
          <td>:</td>
          <td></td>
        </tr>
        <tr>
          <td>Tanggal</td>
          <td>:</td>
          <td></td>
        </tr>
        <tr>
          <td>Tanda Tangan/Cap</td>
          <td>:</td>
          <td></td>
        </tr>
      </table>
    </div>

   </div>
  </section>
 
</body>

</html>

<script type="text/javascript">
	window.print();
</script>