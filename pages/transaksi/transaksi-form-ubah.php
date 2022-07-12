<?php
	session_start();
	if(!isset($_SESSION["id_pegawai"]))
		header("Location: ../index.php?error=4");
?>
<?php include_once("../../functions.php");?>
<!DOCTYPE html>
<html>
	<head>
		<title>Ubah Data Transaksi</title>
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
			<div class="sidebar">
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
					<a class="nav-link text-dark" href="transaksi.php">Data Transaksi</a>
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
		</div>
		
		<div class="col-10 p-5 pt-3 mt-5">
			<h3>DATA TRANSAKSI</h3>
			<hr class="bg-secondary">
<?php
if(isset($_GET["id_transaksi"])){
	$db=dbConnect();
	$id_transaksi=$db->escape_string(base64_decode($_GET["id_transaksi"]));
	if($datatransaksi=getDataTransaksi($id_transaksi)){// cari data barang, kalau ada simpan di $data
		?>
<form method="post" name="frm" action="transaksi-ubah.php" class="was-validated">
<div class="row mb-3">
   <label for="idtrasaksi" class="col-sm-2 col-form-label">ID Transaksi</label>
    <div class="col-sm-10">
      <input type="text" name="id_transaksi" value="<?php echo $datatransaksi["id_transaksi"];?>" readonly
	  class="form-control" maxlength="5" id="idtransaksi">
    </div>
  </div>
  <div class="row mb-3">
    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
    <div class="col-sm-10">
      <input type="date" name="tanggal" class="form-control" id="tanggal" maxlength="30"
	 value="<?php echo $datatransaksi["tanggal"];?>" required>
		<div class="invalid-feedback">
			Tanggal tidak boleh kosong
			</div>
    </div>
  </div>
  <div class="row mb-3">
   <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
    <div class="col-sm-10">
      <input type="text" name="deskripsi" value="<?php echo $datatransaksi["deskripsi"];?>"
	  class="form-control" maxlength="30" id="deskripsi">
    </div>
  </div>
  <div class="row mb-3">
    <label for="barang" class="col-sm-2 col-form-label">Barang</label>
    <div class="col-sm-10">
      <select class="form-select" id="barang" name="id_barang" aria-label="Default select example" required>
		<option value="">Pilih Barang</option>
		<?php
			$databarang=getListBarang();
			foreach($databarang as $data){
				echo "<option value=\"".$data["id_barang"]."\"";
				if($data["id_barang"]==$datatransaksi["id_barang"])
					echo " selected"; // default sesuai kategori sebelumnya
				echo ">".$data["nama_barang"]."</option>";
			}
		?>
	</select>
	<div class="invalid-feedback">Harap Pilih Barang</div>
    </div>
  </div>
  <div class="row mb-3">
    <label for="pembeli" class="col-sm-2 col-form-label">Pembeli</label>
    <div class="col-sm-10">
      <select class="form-select" id="pembeli" name="id_pembeli" aria-label="Default select example" required>
		<option value="">Pilih Pembeli</option>
		<?php
			$datapembeli=getListPembeli();
			foreach($datapembeli as $data){
				echo "<option value=\"".$data["id_pembeli"]."\"";
				if($data["id_pembeli"]==$datatransaksi["id_pembeli"])
					echo " selected"; // default sesuai kategori sebelumnya
				echo ">".$data["nama_pembeli"]."</option>";
			}
		?>
	</select>
	<div class="invalid-feedback">Harap Pilih Pembeli</div>
    </div>
  </div>
  
  <!-- Button trigger modal -->
  <div class="d-flex justify-content-center">
	  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
		  Ubah
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
		<button type="submit" name="TblUpdate" class="btn btn-success">Yakin</button>
	</div>
</div>
</div>
</div>
</div>
		<?php
	}
	else
		echo "Barang dengan Id : $id_barang tidak ada. Pengeditan dibatalkan";
?>
<?php
}
else
	echo "IdProduk tidak ada. Pengeditan dibatalkan.";
?>
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