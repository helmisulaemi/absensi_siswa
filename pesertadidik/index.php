<?php
session_start();

include "../config/database.php";

@$a = mysql_query("SELECT * FROM tbl_siswa WHERE nis = '$_POST[user]'");
$b = mysql_fetch_array($a);
$c = mysql_num_rows($a);
$nama = $b['nama'];

if(isset($_POST['login'])){
	if($c > 0){
		if($_POST['pass'] == $_POST['user']){
			$_SESSION['username'] = $_POST['user'];
			$_SESSION['password'] = $_POST['pass'];
			echo "<script>alert('Selamat Datang $nama');document.location.href='hal_peserta_didik.php?menu=home'</script>"; 
		} else {
			echo "<script>alert('Username atau Password Anda Salah !!');document.location.herf='index.php'</script>";
		}
	}
}

if(isset($_POST['batal'])){
	echo "<script>document.location.href='../'</script>";
}
?>

<title>Login</title>
<form method="post">
	<table align="center">
    	<tr>
        	<td>Username</td>
            <td>:</td>
            <td><input type="text" name="user"></td>
        </tr>
        <tr>
        	<td>Password</td>
            <td>:</td>
            <td><input type="password" name="pass"></td>
        </tr>
        <tr>
        	<td></td>
            <td></td>
            <td><input type="submit" name="login" value="LOGIN">
            	<input type="submit" name="batal" value="BATAL">
            </td>
        </tr>
    </table>
</form>