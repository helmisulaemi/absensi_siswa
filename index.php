<!doctype html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>SIM ABSENSI</title>
    </head>

<body>
    <?php
        if(isset($_POST['admin'])){
			echo "<script>document.location.href='admin'</script>";
		}
		if(isset($_POST['pd'])){
			echo "<script>document.location.href='pesertadidik'</script>";
		}
	?>
    <form method="post">
        <table align="center">
            <tr>
               <td colspan="2" align="center">Login Sebagai :</td>
            </tr>
            <tr>
               <td><input type="submit" name="admin" value="Administrator"></td>
               <td><input type="submit" name="pd" value="Peserta Didik"></td>
            </tr>
        </table>
    </form>
  </body>
</html>