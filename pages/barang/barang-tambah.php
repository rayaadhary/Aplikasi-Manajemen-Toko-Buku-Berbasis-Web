<?php
	session_start();
	if(!isset($_SESSION["id_pegawai"]))
		header("Location: ../index.php?error=4");
?>
<?php include_once("../../functions.php");?>
<!DOCTYPE html>
<html>
	<head>
		<title>Tambah Data Barang</title>
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
					<a class="nav-link text-dark" href="index.php">
						<i class="fa fa-tachometer text-dark" style="font-size:24px; margin-right: 0.3em;" ></i>
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
					<a class="nav-link text-dark" href="../pegawai/pegawai.php">Data Pembeli</a>
				</li>	
			<hr class="bg-light">  
			</ul>
		</div>
		
		<div class="col-10 p-5 pt-3 mt-5">
			<h3>DATA BARANG</h3>
			<hr class="bg-secondary">
<form method="post" name="frm" action="barang-simpan.php" class="was-validated">
  <div class="row mb-3">
   <label for="idbarang" class="col-sm-2 col-form-label">ID Barang</label>
    <div class="col-sm-10">
      <input type="text" name="id_barang" class="form-control" maxlength="5" id="idbarang" required>
	  <div class="invalid-feedback">
		Harap isi ID Barang
	  </div>
    </div>
  </div>
  
  <div class="row mb-3">
    <label for="namabarang" class="col-sm-2 col-form-label">Nama Barang</label>
    <div class="col-sm-10">
      <input type="text" name="nama_barang" class="form-control" maxlength="30" id="namabarang" required>
	  <div class="invalid-feedback">
		Harap isi Nama Barang
	  </div> 
    </div>
  </div>

	<div class="row mb-3">
		 <label for="id_jenis" class="col-sm-2 col-form-label">Jenis</label>
		<div class="col-sm-10">
    <select class="form-select" id="id_jenis" name="id_jenis" required aria-label="select example">
      <option value="">Pilih Jenis</option>
      <?php
			$datajenis=getListJenis();
			foreach($datajenis as $data){
				echo "<option value=\"".$data["id_jenis"]."\">".$data["nama_jenis"]."</option>";
			}
		?>
    </select>
    <div class="invalid-feedback">Harap Pilih Jenis Barang</div>
  </div>
  </div>

  <div class="row mb-3">
    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
    <div class="col-sm-10">
      <input type="text" name="harga" maxlength="11" class="form-control" id="harga" required>
	   <div class="invalid-feedback">
		Harap isi Harga Barang dengan format angka
	  </div> 
    </div>
  </div>
  <div class="row mb-3">
    <label for="stok" class="col-sm-2 col-form-label">Stok</label>
    <div class="col-sm-10">
      <input type="text" name="stok" maxlength="11" class="form-control" id="stok" required>
	   <div class="invalid-feedback">
		Harap isi Stok dengan format angka
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
        <h5 class="modal-title text-center" id="exampleModalLabel">Tambah Data</h5>
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
</body>
</html>