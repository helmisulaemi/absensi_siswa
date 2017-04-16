<?php 
date_default_timezone_set('Asia/Bangkok');
?>

<?php
	include "../config/database.php";
	
	$perintah = new oop();
	
	if(!empty($_GET['rombel'])){
		$isinya = mysql_fetch_array(mysql_query("SELECT * FROM tbl_rombel WHERE id_rombel = '$_GET[rombel]'"));
		$rombel = $isinya['rombel'];
	}
?>

<form method="post">
	<table align="center">
    	<tr>
        	<td>Pilih Rombel</td>
            <td>:</td>
            <td>
            	<select name="rombel">
                	<option value="<?php echo $isinya['rombel'] ?>"><?php echo @$isinya['rombel'] ?></option>
                    <option value=""></option>
                    <?php
                    	$a = $perintah->tampil("tbl_rombel");
						foreach($a as $r){ ?>
                        <option value="<?php echo $r[0]?>"><?php echo $r[1]?></option>
					<?php } ?>
                </select>
            </td>
            <td></td>
            <td><input type="submit" name="cetak" value="Cetak"></td>
        </tr>
    </table>
    <hr>
    <?php
    	if(isset($_POST['cetak'])){
			echo "<script>document.location.href='?menu=absen&rombel=$_POST[rombel]'</script>";
		}
		if(!empty($_GET['rombel'])){
			$tgl_sekarang = date('Y-m-d');
			$cek = mysql_fetch_array(mysql_query("SELECT * FROM query_absen WHERE 
			 									  id_rombel = '$_GET[rombel]' and tgl_absen = '$tgl_sekarang' "));
		    if($cek['tgl_absen'] == $tgl_sekarang and $cek['id_rombel'] == $_GET['rombel']){
				echo "<script>alert('Rombel $rombel sudah di absen hari ini');document.location.href='?menu=absen'</script>";
			} else {
	?>
    <br>
    <table border="1" align="center">
    	<tr>
        	<td rowspan="2">No</td>
            <td rowspan="2">Nis</td>
            <td rowspan="2">Nama</td>
            <td rowspan="2">Rombel</td>
            <td colspan="4" align="center">Keterangan</td>
        </tr>
        
        <tr>
        	<td>Hadir</td>
            <td>Sakit</td>
            <td>Ijin</td>
            <td>Alpa</td>
        </tr>
        	<?php
            	$a = $perintah->tampil("query_siswa WHERE id_rombel = '$_GET[rombel]' ORDER BY nama ASC ");
				$no = 0;
				if($a == ""){
					echo "<tr><td align='center' colspan='8'>No Record</td></tr>";
				}else{
					foreach($a as $r){
						$no++;
			?>
        <tr>
        	<td><?php echo $no ?></td>
            <td><?php echo $r['nis'] ?></td>
            <td><?php echo $r['nama'] ?></td>
            <td><?php echo $r['rombel'] ?></td>
            <td><input type="radio" checked="checked" name="keterangan<?php echo $r['nis']?>" value="hadir"/></td>
            <td><input type="radio" name="keterangan<?php echo $r['nis']?>" value="sakit"/></td>
            <td><input type="radio" name="keterangan<?php echo $r['nis']?>" value="ijin"/></td>
            <td><input type="radio" name="keterangan<?php echo $r['nis']?>" value="alpa"/></td>
        </tr>
        
        <?php 
		@$tgl = date('Y-m-d');
		@$table = "tbl_absen";
		@$redirect = "?menu=absen";
		
		if(@$_POST['keterangan'.@$r['nis']]=='hadir'){
			$field = array('nis'=>$r['nis'],'hadir'=>'1','sakit'=>'0','ijin'=>'0','alpa'=>'0','tgl_absen'=>$tgl);
			
		}elseif(@$_POST['keterangan'.@$r['nis']]=='sakit'){
			$field = array('nis'=>$r['nis'],'hadir'=>'0','sakit'=>'1','ijin'=>'0','alpa'=>'0','tgl_absen'=>$tgl);
			
		}elseif(@$_POST['keterangan'.@$r['nis']]=='ijin'){
			$field = array('nis'=>$r['nis'],'hadir'=>'0','sakit'=>'0','ijin'=>'1','alpa'=>'0','tgl_absen'=>$tgl);
			
		}else{
			$field = array('nis'=>$r['nis'],'hadir'=>'0','sakit'=>'0','ijin'=>'0','alpa'=>'1','tgl_absen'=>$tgl);
		}
			if(isset($_REQUEST['simpan'])){
				if($perintah->simpan($table,$field,$redirect)){
				}
			}
		}
		?>
    <tr>
    	<td colspan="10" align="center"><input type="submit" name="simpan" value="Simpan"></td>
    </tr>
    </table>
    <?php } } } ?>
</form>
<br/>