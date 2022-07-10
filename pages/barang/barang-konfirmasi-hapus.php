<?php
	session_start();
	if(!isset($_SESSION["id_pegawai"]))
		header("Location: ../index.php?error=4");
?>
<?php include_once("../../functions.php");?>
<!DOCTYPE html>
<html>
	<head>
		<title>Hapus Data Barang</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	</head>
<body>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- banner -->
<div class="banner">
	<nav class="navbar navbar-expand-lg fixed-top navbar-dark shadow-sm bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="barang.php">Buka Buku</a>
		</div>
	</nav>

</div>
<?php
if(isset($_GET["id_barang"])){
	$db=dbConnect();
	$id_barang=$db->escape_string(base64_decode($_GET["id_barang"]));
	if($databarang=getDataBarang($id_barang)){// cari data barang, kalau ada simpan di $data
		?>
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
	<form method="post" name="frm" action="barang-hapus.php">
		<input type="hidden" name="id_barang" value="<?php echo $databarang["id_barang"];?>">
				<a href="barang.php"><button type="button" class="btn btn-outline-dark rounded">Tampil Barang</button></a>
<table class="table mt-1">
  <thead class="thead-dark table-dark">
    <tr>
      <th scope="col">ID Barang</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Jenis</th>
      <th scope="col">Harga</th>
	  <th scope="col">Stok</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?php echo $databarang["id_barang"];?></td>
      <td><?php echo $databarang["nama_barang"];?></td>
      <td><?php echo $databarang["nama_jenis"];?></td>
	  <td><?php echo $databarang["harga"];?></td>
	  <td><?php echo $databarang["stok"];?></td>
    </tr>
  </tbody>
</table>


<!-- Button trigger modal -->
<div class="d-flex justify-content-center">
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Hapus
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Hapus Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah yakin ingin menghapus data ini?
      </div>
      <div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
		  <button type="submit" name="TblHapus" class="btn btn-danger">Yakin</button>
      </div>
	  </div>
	  </div>
    </div>
  </div>
</div>
</div>
</form>

		<?php
	}
	else
		echo "Barang dengan Id : $id_barang tidak ada. Penghapusan dibatalkan";
?>
<?php
}
else
	echo "ID Barang tidak ada. Penghapusan dibatalkan.";
?>
</body>
</html>