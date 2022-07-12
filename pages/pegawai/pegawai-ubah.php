<?php
	session_start();
	if(!isset($_SESSION["id_pegawai"]))
		header("Location: ../index.php?error=4");
?>
<?php include_once("../../functions.php");?>
<!DOCTYPE html>
<html><head><title>Pembaruan Data Pegawai</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
					<a class="nav-link text-dark" href="../../index-admin.php">
						Dashboard</a>
						<hr class="bg-light">
					</li>
				<li class="nav-item">
					<a class="nav-link text-dark" href="barang.php">Data Barang</a>
				</li>	
			<hr class="bg-light">
              <li class="nav-item">
					<a class="nav-link text-dark" href="../jenis/jenis.php">Data Jenis</a>
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
					<a class="nav-link text-dark" href="../pegawai/pegawai.php">Data Pegawai</a>
				</li>	
			<hr class="bg-light">  
			<li class="nav-item">
					<a class="nav-link text-dark" data-bs-toggle="modal" data-bs-target="#modalLogout">Keluar</a>
				</li>	
			<hr class="bg-light"> 
			</ul>
		</div>

<div class="col-10 p-5 pt-3 mt-5">
<h3>Pembaruan Data Pegawai</h3>
<?php
if(isset($_POST["TblUpdate"])){
	$db=dbConnect();
	if($db->connect_errno==0){
		// Bersihkan data
		$id_pegawai  =$db->escape_string($_POST["id_pegawai"]);
		$nama_pegawai =$db->escape_string($_POST["nama_pegawai"]);
		$telepon  =$db->escape_string($_POST["telepon"]);
		$alamat	   =$db->escape_string($_POST["alamat"]);

		// validasi
		$pesansalah="";

		// validasi nama
		if(strlen($nama_pegawai)==0)
		$pesansalah.="Nama Pegawai tidak sah. Nama Pegawai tidak boleh kosong.<br>";

        // validasi alamat
        if(strlen($alamat)==0)
        $pesansalah.="Alamat Pegawai tidak sah. Alamat Pegawai tidak boleh kosong.<br>";
	
		// validasi telepon
		$teleponAwal = substr($telepon,0,1);
		
		if($teleponAwal!="0")
		$pesansalah.="Telepon tidak sah. Telepon harus diawali dengan 0.<br>";

		if (!is_numeric($telepon))
		$pesansalah.="Telepon tidak sah. Telepon harus berupa angka.<br>";

		if(strlen($telepon)<12)
		$pesansalah.="Telepon tidak sah. Telepon harus 12/13 digit.<br>";

		if($pesansalah==""){
		echo "Tidak terjadi kesalahan. Semua data valid. Data akan disimpan ke database";
		// Susun query update
		$sql="UPDATE Pegawai SET 
			  nama_pegawai='$nama_pegawai',telepon='$telepon', alamat='$alamat'
			  WHERE id_pegawai='$id_pegawai'";
		// Eksekusi query update
		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0){ // jika ada update data
				?>
				<div class="alert alert-success d-flex align-items-center" role="alert">
				<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
				<div>
				Data berhasil diubah.
				</div>
				</div>
				<a href="pegawai.php" class="btn btn-dark">Tampil Pegawai</a>
				<?php
			}
			else{ // Jika sql sukses tapi tidak ada data yang berubah
				?>
				<div class="alert alert-success" role="alert">
					Data berhasil diubah tetapi tanpa ada perubahan data.<br>
				</div>
				<a href="javascript:history.back()" class="btn btn-success">Ubah Kembali</a>
				<a href="pegawai.php" class="btn btn-dark">Tampil Pegawai</a>
				<?php
			}
		}
		else{ // gagal query
			?>
			Data gagal diubah.<br>
			<a href=javascript:history.back(); class="btn btn-success">Kembali</a>
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
				<a href=javascript:history.back(); class="btn btn-success">Kembali Ke Form</a>
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
<div class="modal fade" id="modalLogout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Keluar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		Apakah yakin ingin keluar?
	</div>
	<div class="modal-footer">
		<form method="post" action="../../logout.php">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
		<button type="submit" name="TblKeluar" class="btn btn-danger">Yakin</button>
		</form>
	</div>
</div>
</div>
</div>
</body>
</html>