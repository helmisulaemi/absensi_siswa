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
<?php
include "../config/database.php";
include "../library/controllers.php";
$perintah = new oop();
?>
<title>LAPORAN KEHADIRAN DETAIL</title>
<div class="print">
    	<a href="#" onClick="document.getElementById('print').style.display='none';window.print();">
        	<img src="../images/print-icon.png" id="print" width="25" height="25" border="0" /></a> 
</div>
	<div class="utama">
    	<table width="98%" align="center" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
        	<tr>
            	<td width="7%" rowspan="3" align="center" valign="top">
                	<img src="../images/logo.png" width="55" height="55" />
                </td>
                <td width="93%" valign="top"><strong>&nbsp;Laporan Kehadiran</strong></td>
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
            	<td rowspan="2" width="30">No</td>
                <td rowspan="2" width="100">Nis</td>
                <td rowspan="2" width="150">Nama</td>
                <td rowspan="2" width="100">Rombel</td>
                <td colspan="4">Keterangan</td>
                <td rowspan="2" width="100">Tanggal</td>
            </tr>
            
            <tr align="center" bgcolor="#FFFFFF">
            	<td width="30">H</td>
                <td width="30">S</td>
                <td width="30">I</td>
                <td width="30">A</td>		
            </tr>
            <?php 
			$a = $perintah->tampil("query_absen WHERE nis = '$_GET[nis]'");
			$no = 0;
			if($a == ""){
				echo "<table><tr><td colspan='9'><strong>No Record</strong></td></tr></table>";
			} else {
				foreach($a as $r){
					$no++;
			?>
            <tr>
            	<td align="center"><?php echo $no ?></td>
                <td align="center"><?php echo $r['nis'] ?></td>
                <td align="center"><?php echo $r['nama'] ?></td>
                <td align="center"><?php echo $r['rombel'] ?></td>
                <td align="center"><?php echo $r['hadir'] ?></td>
                <td align="center"><?php echo $r['sakit'] ?></td>
                <td align="center"><?php echo $r['ijin'] ?></td>
                <td align="center"><?php echo $r['alpa'] ?></td>
                <td align="center"><?php echo $r['tgl_absen'] ?></td>
            </tr>
            <?php 
				}
		   } 
		   ?>
        </table>
        <br/>
     </div>
   <center><p>&copy; <?php echo date('Y'); ?> SMK WIKRAMA BOGOR</p></center>
 </body>
</html>
        
