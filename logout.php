<?php
if(isset($_POST["TblKeluar"])){
session_start();
session_destroy();
header("Location: index.php");
}