<?php
include_once("functions.php");
if($db=dbConnect()){
	echo "Koneksi Database OK<br>";
	echo "Server : ".$db->server_info."<br>";
	echo "Host   : ".$db->host_info."<br>";
}
else
	echo "Gagal Koneksi. Check function dbConnect() di file functions.php";
