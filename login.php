<?php include_once("functions.php");?>
<?php
$db=dbConnect();
if($db->connect_errno==0){
	if(isset($_POST["TblLogin"])){
		$id_pegawai=$db->escape_string($_POST["id_pegawai"]);
		$password=$db->escape_string($_POST["password"]);
		$sql="SELECT id_pegawai,nama_pegawai,telepon FROM pegawai
			  WHERE id_pegawai='$id_pegawai' and pass=password('$password')";
		$res=$db->query($sql);
		if($res){
			if($res->num_rows==1){
				$data=$res->fetch_assoc();
				session_start();
				$_SESSION["id_pegawai"]=$data["id_pegawai"];
				$_SESSION["nama_pegawai"]=$data["nama_pegawai"];
				$_SESSION["telepon"]=$data["telepon"];
				header("Location: index-admin.php");
			}
			else
				header("Location: index.php?error=1");
		}
	}
	else
		header("Location: index.php?error=2");
}
else
	header("Location: index.php?error=3");
?>