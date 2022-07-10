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
if(isset($_GET["id_pegawai"])){
	$db=dbConnect();
	$id_pegawai=$db->escape_string(base64_decode($_GET["id_pegawai"]));
	if($datapegawai=getDataPegawai($id_pegawai)){// cari data barang, kalau ada simpan di $data
		?>
		<div class="container-fluid">
	<div class="row">
		<div class="col-2 mt-5 pt-3 bg-secondary">
			<div class="sidebar">
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
					<a class="nav-link text-dark" href="../jenis/jenis.php">Data Barang</a>
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
			</ul>
		</div>
		</div>
	<div class="col-10 p-5 pt-3 mt-5">
			<h3>DATA PEGAWAI</h3>
			<hr class="bg-secondary">
	<form method="post" name="frm" action="pegawai-hapus.php">
		<input type="hidden" name="id_pegawai" value="<?php echo $datapegawai["id_pegawai"];?>">
				<a href="pembeli.php"><button type="button" class="btn btn-outline-dark rounded">Tampil Pegawai</button></a>
<table class="table mt-1">
  <thead class="thead-dark table-dark">
    <tr>
      <th scope="col">ID Pegawai</th>
      <th scope="col">Nama Pegawai</th>
      <th scope="col">Telepon</th>
      <th scope="col">Alamat</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?php echo $datapegawai["id_pegawai"];?></td>
      <td><?php echo $datapegawai["nama_pegawai"];?></td>
      <td><?php echo $datapegawai["telepon"];?></td>
	  <td><?php echo $datapegawai["alamat"];?></td>
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
		echo "Pegawai dengan Id : $id_pegawai tidak ada. Penghapusan dibatalkan";
?>
<?php
}
else
	echo "ID Pegawai tidak ada. Penghapusan dibatalkan.";
?>
</body>
</html>