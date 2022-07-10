<?php include_once("functions.php");?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" href="style.css">
		
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

		<style>
			body{
			background: url(https://source.unsplash.com/random/) no-repeat;
			background-size: cover;
			}

			.login-layout {
				opacity: 0.9;
			}


		</style>
	</head>
<body>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<form method="post" name="f" action="login.php">
<?php
if(isset($_GET["error"])){
$error=$_GET["error"];
if($error==1)
showError("IdPegawai dan password tidak sesuai.");
else if($error==2)
showError("Error database. Silahkan hubungi administrator");
else if($error==3)
showError("Koneksi ke Database gagal. Autentikasi gagal.");
else if($error==4)
showError("Anda tidak boleh mengakses halaman sebelumnya karena belum login. Silahkan
login terlebih dahulu.");
else
showError("Unknown Error.");
}
?>

<div class="container py-5 h-100">
	 <div class="row d-flex justify-content-center align-items-center h-100 g-0">
		<div class="card" style="opacity: 0.9;">
			<div class="row g-0">
			<div class="col-lg-5 bg-dark">
				  <img src="jaredd-craig-HH4WBGNyltc-unsplash.jpg" class="img-fluid" style="height: 400px; width: 600px;" alt="bukabuku">
			</div>
			   <div class="col-lg-7">
				   <div class="login-layout text-center mt-4">
							<h3>Selamat Datang</h3>
							<h4>Sistem Informasi Buka Buku</h4>
							<form>
			<div class="mb-3 text-start mx-5">
			<label for="id_pegawai" class="form-label">ID Pegawai</label>
			<input type="text" class="form-control" 
			value="<?= ($_SERVER["REMOTE_ADDR"]=="5.189.147.47"?"admin":"");?>"
			id="id_pegawai" name="id_pegawai" placeholder="Masukkan ID Pegawai" maxlength="5" size="5">
			</div>
			<div class="mb-3 text-start mx-5">
			<label for="pass"  class="form-label">Kata Sandi</label>
			<input type="password" class="form-control" value="<?= ($_SERVER["REMOTE_ADDR"]=="5.189.147.47"?"password_admin":"");?>" 
			name="password" id="pass"  placeholder="Masukkan Kata Sandi" maxlength="20">
			</div>
			<div class="mb-3 text-start mx-5 form-check">
			<label class="form-check-label">Lihat Kata Sandi</label>
			<input type="checkbox" onclick="lihatpassword()" class="form-check-input" >
			</div>
			<div class="d-flex justify-content-center">
			<button type="submit" name="TblLogin" class="btn btn-primary">Masuk</button>
			</div>
			</form>
			</div>
			</div>
			</div>
			</div>
			</div>
</div>
</form>
<script type="text/javascript">
	function lihatpassword(){
		var pass = document.getElementById('pass');
		if(pass.type=='password'){
			pass.type="text";
		}
		else{
			pass.type='password';
		}
	}
</script>
</body>
</html>