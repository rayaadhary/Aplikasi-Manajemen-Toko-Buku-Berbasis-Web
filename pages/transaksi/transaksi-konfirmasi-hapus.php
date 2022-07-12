<?php
	session_start();
	if(!isset($_SESSION["id_pegawai"]))
		header("Location: ../index.php?error=4");
?>
<?php include_once("../../functions.php");?>
<!DOCTYPE html>
<html>
	<head>
		<title>Hapus Data Transaksi</title>
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
if(isset($_GET["id_transaksi"])){
	$db=dbConnect();
	$id_transaksi=$db->escape_string(base64_decode($_GET["id_transaksi"]));
	if($datatransaksi=getDataTransaksi($id_transaksi)){// cari data jenis, kalau ada simpan di $data
		?>
		<div class="container-fluid">
	<div class="row">
		<div class="col-2 mt-5 pt-3 bg-secondary">
			<div class="sidebar">
			<ul class="nav flex-column ml-3 mb-5">
				<li class="nav-item">
					<a class="nav-link text-dark" href="../../index.php">
					Dashboard</a>
						<hr class="bg-light">
					</li>
				<li class="nav-item">
					<a class="nav-link text-dark" href="../barang/barang.php">Data Barang</a>
				</li>	
			<hr class="bg-light">
				<li class="nav-item">
					<a class="nav-link text-dark" href="../jenis/jenis.php">Data Barang</a>
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
	<form method="post" name="frm" action="transaksi-hapus.php">
		<input type="hidden" name="id_transaksi" value="<?php echo $datatransaksi["id_transaksi"];?>">
				<a href="transaksi.php"><button type="button" class="btn btn-outline-dark rounded">Tampil Transaksi</button></a>
<table class="table mt-1">
  <thead class="thead-dark table-dark">
    <tr>
      <th scope="col">ID Transaksi</th>
      <th scope="col">ID Tanggal</th>
      <th scope="col">Deskripsi</th>
      <th scope="col">ID Barang</th>
      <th scope="col">ID Pembeli</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?php echo $datatransaksi["id_transaksi"];?></td>
      <td><?php echo $datatransaksi["tanggal"];?></td>
      <td><?php echo $datatransaksi["deskripsi"];?></td>
      <td><?php echo $datatransaksi["id_barang"];?></td>
      <td><?php echo $datatransaksi["id_pembeli"];?></td>
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
		<?php
	}
	else
		echo "Transaksi dengan Id : $id_transaksi tidak ada. Penghapusan dibatalkan";
?>
<?php
}
else
	echo "ID Transaksi tidak ada. Penghapusan dibatalkan.";
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