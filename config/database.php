<?php
  $server      = "localhost";
  $username    = "root";
  $password    = "";
  $database    = "db_absensi";
  
  mysql_connect($server,$username,$password);
  mysql_select_db($database) or die ("Database tidak ditemukan");
?>