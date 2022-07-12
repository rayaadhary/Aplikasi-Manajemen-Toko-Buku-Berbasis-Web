<?php
	session_start();
	if(!isset($_SESSION["id_pegawai"]))
		header("Location: ../index.php?error=4");
?>
<?php include_once("../../functions.php");?>
<!DOCTYPE html>
<html>
	<head>
		<title>Tampil Data Pegawai</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link rel="stylesheet" href="style.css">
	</head>
<body>


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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
					<a class="nav-link text-dark" href="../barang/barang.php">Data Barang</a>
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
					<a class="nav-link text-dark" href="pegawai.php">Data Pegawai</a>
				</li>	
			<hr class="bg-light">
			<li class="nav-item">
					<a class="nav-link text-dark" data-bs-toggle="modal" data-bs-target="#modalLogout">Keluar</a>
				</li>	
			<hr class="bg-light"> 
			</ul>
		</div>
		
		<div class="col-10 p-5 pt-3 mt-5">
			<h3>DATA PEGAWAI</h3>
			<hr class="bg-secondary">
<form method="post" name="frm" action="pegawai-simpan.php" class="was-validated">
  <div class="row mb-3">
    <label for="id_pegawai" class="col-sm-2 col-form-label">ID Pegawai</label>
    <div class="col-sm-10">
      <input type="text" name="id_pegawai" maxlength="5" class="form-control" id="id_pegawai" required>
	   <div class="invalid-feedback">
		Harap isi ID Pegawai
	  </div>
    </div>
  </div>
  <div class="row mb-3">
    <label for="pass" class="col-sm-2 col-form-label">Kata Sandi</label>
    <div class="col-sm-10">
      <input type="text" name="pass" maxlength="30" class="form-control" id="pass" required>
	   <div class="invalid-feedback">
		Harap isi Kata Sandi
	   </div>
    </div>
  </div>
  <div class="row mb-3">
    <label for="nama_pegawai" class="col-sm-2 col-form-label">Nama Pegawai</label>
    <div class="col-sm-10">
      <input type="text" name="nama_pegawai" maxlength="30" class="form-control" id="nama_pegawai" required>
	   <div class="invalid-feedback">
		Harap isi Nama Pegawai
	   </div>
    </div>
  </div>
  <div class="row mb-3">
    <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
    <div class="col-sm-10">
      <input type="text" name="telepon" maxlength="13" class="form-control" id="telepon" required>
	   <div class="invalid-feedback">
		Harap isi Nomor Telepon
	   </div>
    </div>
  </div>
  <div class="row mb-3">
    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
    <div class="col-sm-10">
      <input type="text" name="alamat" maxlength="30" class="form-control" id="alamat" required>
	   <div class="invalid-feedback">
		Harap isi Alamat
	   </div>
	</div>
  </div>
  <!-- Button trigger modal -->
  <div class="d-flex justify-content-center">
	  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
		  Simpan
		</button>
		
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Tambah Pembeli</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		Apakah yakin ingin menambah data ini?
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
		<button type="submit" name="TblSimpan" class="btn btn-primary">Yakin</button>
	</div>
</div>
</div>
</div>
</div>
</div>
</div>
</form>
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