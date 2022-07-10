<?php
	session_start();
	if(!isset($_SESSION["id_pegawai"]))
		header("Location: ../index.php?error=4");
?>
<?php include_once("../../functions.php");?>
<!DOCTYPE html>
<html><head><title>Penyimpanan Data Pembeli</title>
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
					<a class="nav-link text-dark" href="../jenis/jenis.php">Data Jenis</a>
				</li>	
			<hr class="bg-light">
			<li class="nav-item">
					<a class="nav-link text-dark" href="pembeli.php">Data Pembeli</a>
				</li>	
			<hr class="bg-light">    
			<li class="nav-item">
					<a class="nav-link text-dark" href="../transaksi/transaksi.php">Data Transaksi</a>
				</li>	
			<hr class="bg-light">  
			<li class="nav-item">
					<a class="nav-link text-dark" href="../pegawai/pegawai.php">Data Pegawai</a>
				</li>	
			<hr class="bg-light">  
			</ul>
		</div>

<div class="col-10 p-5 pt-3 mt-5">
<h3>Penyimpanan Data Pegawai</h3>
<hr class="bg-secondary">
<?php
if(isset($_POST["TblSimpan"])){
	$db=dbConnect();
	if($db->connect_errno==0){
		// Bersihkan data
		$id_pembeli   	= $db->escape_string($_POST["id_pembeli"]);
		$nama_pembeli	= $db->escape_string($_POST["nama_pembeli"]);
		$telepon 		= $db->escape_string($_POST["telepon"]);
		$alamat 		= $db->escape_string($_POST["alamat"]);
		
		// validasi
		$pesansalah="";

		// validasi id_pembeli	
		$id_pembeli = trim($id_pembeli);
		
		$idPembeliAngka = substr($id_pembeli,1,4);
		$idPembeliAwal = substr($id_pembeli,0,1);

		
		$query = $db->query("SELECT id_pembeli FROM pembeli WHERE id_pembeli = '$id_pembeli'"); 

		if($query->num_rows > 0) 
		$pesansalah.="Id Pembeli sudah ada.<br>";

		if (strlen($id_pembeli)==0)
		$pesansalah.="Id Pembeli tidak sah. Id Pembeli tidak boleh kosong.<br>";

		if($idPembeliAwal!="T")
		$pesansalah.="Input Pertama harus huruf T 
		untuk Id Pembeli.<br>"; 

		if(!is_numeric($idPembeliAngka))
		$pesansalah.="Id Pembeli tidak sah. Penulisan Id Pembeli setelah T harus berupa angka 4 digit.<br>";

		if(strlen($idPembeliAngka)<4) 
		$pesansalah.="Format Id Barang tidak sesuai, Id Barang diawali dengan B dan 
		setelahnya harus berupa 4 digit angka.<br>";

		// validasi nama
		$nama_pembeli = trim($nama_pembeli);
		if(strlen($nama_pembeli)==0)
		$pesansalah.="Nama Pembeli tidak sah. Nama Pembeli tidak boleh kosong.<br>";

		// validasi telepon
		$teleponAwal = substr($telepon,0,1);
		
		if($teleponAwal!="0")
		$pesansalah.="Telepon tidak sah. Telepon harus diawali dengan 0.<br>";

		if (!is_numeric($telepon))
		$pesansalah.="Telepon tidak sah. Telepon harus berupa angka.<br>";

		if(strlen($telepon)<12)
		$pesansalah.="Telepon tidak sah. Telepon harus 12/13 digit.<br>";

		// validasi alamat	
		$alamat = trim($alamat);
		if(strlen($alamat)==0)
		$pesansalah.="Alamat tidak sah. Alamat tidak boleh kosong.<br>";

		if($pesansalah==""){
		echo "Tidak terjadi kesalahan. Semua data valid. Data akan disimpan ke database";
		// script database
		// Susun query insert
		$sql="INSERT INTO pembeli(id_pembeli,nama_pembeli,telepon,alamat,id_pegawai)
			  VALUES('$id_pembeli','$nama_pembeli','$telepon','$alamat',
				'" . $db->escape_string($_SESSION["id_pegawai"]) . "')";
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
				<a href="pembeli.php" class="btn btn-dark">Tampil Pembeli</a>
				<?php
			}
		}
		else{
			?>
			Data gagal disimpan karena Id Pegawai mungkin sudah ada.<br>
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
</body>
</html>