<?php
	session_start();
	if(!isset($_SESSION["id_pegawai"]))
		header("Location: ../index.php?error=4");
?>
<?php include_once("../../functions.php");?>
<!DOCTYPE html>
<html><head><title>Penyimpanan Data Jenis</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link rel="stylesheet" href="../../style.css">
</head>
<body>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- SVG -->
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
<symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
</symbol>
<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
</symbol>
<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</symbol>
</svg>

<!-- banner -->
<div class="banner">
	<nav class="navbar navbar-expand-lg fixed-top navbar-dark shadow-sm bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Buka Buku</a>
  </div>
</nav>
</div>

<!-- navigator -->
<div class="container-fluid">
	<div class="row">
		<div class="col-2 mt-5 pt-3 bg-secondary">
			<ul class="nav flex-column ml-3 mb-5">
				<li class="nav-item">
					<a class="nav-link text-dark" href="index.php">
						<i class="fa fa-tachometer text-dark" style="font-size:24px; margin-right: 0.3em;" ></i>
						Dashboard</a>
						<hr class="bg-light">
					</li>
				<li class="nav-item">
					<a class="nav-link text-dark" href="../barang/barang.php">Data Barang</a>
				</li>	
			<hr class="bg-light">
              <li class="nav-item">
					<a class="nav-link text-dark" href="jenis.php">Data Jenis</a>
				</li>	
			<hr class="bg-light">
			<li class="nav-item">
					<a class="nav-link text-dark" href="../pembeli/pembeli.php">Data Pembeli</a>
				</li>	
			<hr class="bg-light">    
			<li class="nav-item">
					<a class="nav-link text-dark" href="../transaksi/transaksi.php">Data Transaksi</a>
				</li>	
			<hr class="bg-light">  
			<li class="nav-item">
					<a class="nav-link text-dark" href="../pegawai/pegawai.php">Data Pembeli</a>
				</li>	
			<hr class="bg-light">  
			</ul>
		</div>

<div class="col-10 p-5 pt-3 mt-5">
<h3>Penyimpanan Data Jenis</h3>
<hr class="bg-secondary">
<?php
if(isset($_POST["TblSimpan"])){
	$db=dbConnect();
	if($db->connect_errno==0){
		// Bersihkan data
		$id_jenis 		= $db->escape_string($_POST["id_jenis"]);
		$nama_jenis 	= $db->escape_string($_POST["nama_jenis"]);
		
		// validasi
		$pesansalah="";

		$query = $db->query("SELECT id_jenis FROM jenis WHERE id_jenis = '$id_jenis'"); 

		if($query->num_rows > 0) 
		$pesansalah.="Id Jenis sudah ada.<br>";

		if (strlen($id_jenis)==0)
		$pesansalah.="Id Jenis tidak sah. Id Jenis tidak boleh kosong.<br>";

		if(!is_numeric($id_jenis))
		$pesansalah.="Id Jenis tidak sah. Penulisan Id Jenis harus berupa angka.<br>";

		// validasi nama
		$nama_jenis = trim($nama_jenis);
		if(strlen($nama_jenis)==0){
		$pesansalah.="Nama Jenis tidak sah. Nama Jenis tidak boleh kosong.<br>";
		}
        
		if($pesansalah==""){
			?>
			<div class="alert alert-primary" role="alert">
			Tidak terjadi kesalahan. Semua data valid. Data akan disimpan ke database
			</div>
		<?php
		// script database
		// Susun query insert
		$sql="INSERT INTO jenis(id_jenis,nama_jenis,id_pegawai)
			  VALUES('$id_jenis','$nama_jenis','" . $db->escape_string($_SESSION["id_pegawai"]) . "')";
		// Eksekusi query insert
		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0){ // jika ada penambahan data
				?>
				<div class="alert alert-primary d-flex align-items-center" role="alert">
				<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
				<div>
				Data berhasil disimpan.
				</div>
				</div>
				<br>
				<a href="jenis.php" class="btn btn-dark">Tampil Jenis</a>
				<?php
			}
		}
		else{
		?>
			Data gagal disimpan karena Id Jenis mungkin sudah ada.<br>
			<a href=javascript:history.back(); class="btn btn-dark">Kembali</a>
			<?php
		}
		}
		else{
		?>
		<div class="d-flex justify-content-center">
			<div class="card text-center" style="width: 18rem;">
			<div class="card-body">
				<h5 class="card-title fs-5">Terjadi kesalahan sebagai berikut</h5>
				<p class="card-text"><?=$pesansalah;?></p>
				<a href=javascript:history.back(); class="btn btn-primary">Kembali Ke Form</a>
			</div>
			</div>
			</div>
		<?php
		}
	}
	else
		echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
}
?>
</div>
</body>
</html>