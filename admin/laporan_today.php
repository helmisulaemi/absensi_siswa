<?php
include "../config/database.php";
?>
<!DOCTYPE html>
<html>
	<head>
    	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>LAPORAN ABSEN</title>
    </head>
    
    <body>
    	<style>
        	.utama{
				margin:0 auto;
				border:thin solid #000;
				width:700px;
			}
			.print{
				margin:0 auto;
				width:700px;
			}
			a{
				text-decoration:none;
			}
        </style>
    <div class="print">
        <a href="#" onClick="document.getElementById('print').style.display='none';window.print();">
        	<img src="../images/print-icon.png" id="print" width="25" height="25" border="0" /></a>
            
    </div>
    <div class="utama">
    	<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:10px;">
        	<tr>
            	<td width="7%" rowspan="3" align="center" valign="top">
                	<img src="../images/logo.png" width="55" height="55" />
                </td>
                <td width="93%"><strong>&nbsp;Laporan Kehadiran</strong></td>
            </tr>
            <tr>
            	<td valign="top">&nbsp;SMK Wikrama Kota Bogor </td>
            </tr>
            <tr>
            	<td valign="top">&nbsp;Ilmu yang Amaliah, Amal yang Ilmiah, Akhlakul Karimah </td>
            </tr>
        </table> 
        <table width="100%">
        	<tr><td><hr></td></tr>
        </table>
        
	<table cellspacing="1" align="center" border="1">
    	<tr align="center">
        	<td rowspan="2">No</td>
            <td rowspan="2" width="100">Nis</td>
            <td rowspan="2" width="150">Nama</td>
            <td rowspan="2" width="100">Rombel</td>
            <td colspan="4">Keterangan</td>
            <td rowspan="2" width="50">Bulan</td>
            <td rowspan="2">Lihat</td>
        </tr>
        
        <tr align="center">
        	<td width="25">H</td>
            <td width="25">S</td>
            <td width="25">I</td>
            <td width="25">A</td>
        </tr>
	<?php
    $data = mysql_fetch_array(mysql_query("SELECT * FROM query_absen"));
	$bulan_sekarang_db = $data['tgl_absen'];
	$ambil_bulan = substr($bulan_sekarang_db, 5 , 2);
	$bulan_sekarang = date('Y-m-d');
	$bulan = substr($bulan_sekarang, 5 , 2);
	
	if($bulan == $ambil_bulan){
		
		$sql = mysql_query("SELECT SUM(hadir) AS hadir, SUM(sakit) AS sakit, SUM(ijin) AS ijin, SUM(alpa) AS alpa, nis, nama, rombel, tgl_absen,
							id_rombel FROM query_absen WHERE id_rombel='$_GET[rombel]' GROUP By nis ORDER BY nama ASC");
		$no = 0 ;
		while($r = mysql_fetch_array($sql)){
			$no++;
	?>
    <tr align="center">
    	<td><?php echo $no ?></td>
        <td><?php echo $r['nis'] ?></td>
        <td align="left"><?php echo $r['nama'] ?></td>
        <td><?php echo $r['rombel'] ?></td>
        <td><?php echo $r['hadir'] ?></td>
        <td><?php echo $r['sakit'] ?></td>
        <td><?php echo $r['ijin'] ?></td>
        <td><?php echo $r['alpa'] ?></td>
        <td><?php echo date('M') ?></td>
        <td><a target="_blank" href="laporan_rombel_detail.php?rombel=<?php echo $r['id_rombel'] ?>&nis=<?php echo $r['nis']?>&tgl=<?php echo 						  			$r['tgl_absen']?>">Detail</a>
        </td>
    </tr>
    <?php } } ?>
    </table>
    <br>
   </div>
  </body>
  <center><p>&copy; <?php echo date('Y'); ?> SMK WIKRAMA BOGOR</p></center>
 </html>