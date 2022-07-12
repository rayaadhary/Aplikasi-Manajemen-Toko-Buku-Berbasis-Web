<?php
	session_start();
	if(!isset($_SESSION["id_pegawai"]))
		header("Location: ../index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Dashboard</title>	
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link rel="stylesheet" href="../../style.css">
		<script src="https://kit.fontawesome.com/81efd83dc2.js" crossorigin="anonymous"></script>
		
		<style>
			.card-body-icon {
			position: absolute;
			z-index: 0;
			top: 25px;
			right: 4px;
			opacity: 0.4;
			font-size: 90px;
			}
		</style>
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

<?php
$db =  dbConnect();
if ($db->connect_errno==0)
{
	$sql = "SELECT count(id_barang) AS jumlah_barang, (SELECT count(id_jenis) FROM jenis) as jenis,
	(SELECT count(id_pegawai) from pegawai) AS pegawai, (SElECT count(id_transaksi) as transaksi FROM transaksi) AS transaksi,
	(SELECT count(id_pembeli) from pembeli) AS pembeli
	FROM barang";
	$res = $db->query($sql);
	if ($res) 
	{
?>

<!-- navigator -->
<div class="container-fluid">
	<div class="row">
		<div class="col-2 mt-5 pt-3 bg-secondary">
			<ul class="nav flex-column ml-3 mb-5">
				<li class="nav-item">
					<a class="nav-link text-dark" href="index-admin.php">
						Dashboard</a>
						<hr class="bg-light">
					</li>
				<li class="nav-item">
					<a class="nav-link text-dark" href="./pages/barang/barang.php">Data Barang</a>
				</li>	
			<hr class="bg-light">
              <li class="nav-item">
					<a class="nav-link text-dark" href="./pages/jenis/jenis.php">Data Jenis</a>
				</li>	
			<hr class="bg-light">
			<li class="nav-item">
					<a class="nav-link text-dark" href="./pages/pembeli/pembeli.php">Data Pembeli</a>
				</li>	
			<hr class="bg-light">    
			<li class="nav-item">
					<a class="nav-link text-dark" href="./pages/transaksi/transaksi.php">Data Transaksi</a>
				</li>	
			<hr class="bg-light">  
			<li class="nav-item">
					<a class="nav-link text-dark" href="./pages/pegawai/pegawai.php">Data Pegawai</a>
				</li>	
			<hr class="bg-light">
			<li class="nav-item">
					<a class="nav-link text-dark" data-bs-toggle="modal" data-bs-target="#modalLogout">Keluar</a>
				</li>	
			<hr class="bg-light">  
			</ul>
		</div>

		<?php
        $data=$res->fetch_all(MYSQLI_ASSOC); // ambil seluruh baris data
         foreach($data as $barisdata){ // telusuri satu per satu
        ?>
		
		<div class="col-10 p-5 pt-3 mt-5">
			<h3>
				DASHBOARD
        </h3>
		<hr class="bg-secondary">
		<div class="alert alert-dark" role="alert">
			Selamat Datang <?php echo $_SESSION["nama_pegawai"];?>
</div>

        <div class="row text-white">
          <div class="card bg-primary" style="width: 18rem; margin-left: 1em;">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-list-alt" style="margin-right: 0.2em;"></i>
              </div>
              <h5 class="card-title fs-5 text-center">JUMLAH BUKU</h5>
              <div class="display-4 fw-bold">
                <?= $barisdata['jumlah_barang']; ?>
              </div>
              <a class="text-decoration-none text-info" href="./pages/barang/barang.php">
                <p class="card-text text-white">Lihat Detail</p>
              </a>
            </div>
          </div>
		  <div class="card bg-info" style="width: 18rem; margin-left: 1em;">
            <div class="card-body">
              <div class="card-body-icon">
				<i class="fa-solid fa-list" style="margin-right: 0.2em;"></i>
              </div>
              <h5 class="card-title fs-5 text-center">JUMLAH JENIS BUKU</h5>
              <div class="display-4 fw-bold">
                <?= $barisdata['jenis']; ?>
              </div>
              <a class="text-decoration-none text-info" href="./pages/jenis/jenis.php">
                <p class="card-text text-white">Lihat Detail</p>
              </a>
            </div>
          </div>
		  <div class="card bg-warning" style="width: 18rem; margin-left: 1em;">
            <div class="card-body">
              <div class="card-body-icon">
				<i class="fa-solid fa-users" style="margin-right: 0.2em;"></i>
              </div>
              <h5 class="card-title fs-5 text-center">JUMLAH PEMBELI</h5>
              <div class="display-4 fw-bold">
                <?= $barisdata['pembeli']; ?>
              </div>
              <a class="text-decoration-none text-info" href="./pages/pembeli/pembeli.php">
                <p class="card-text text-white">Lihat Detail</p>
              </a>
            </div>
          </div>
		  <div class="card bg-success mt-4" style="width: 18rem; margin-left: 1em;">
            <div class="card-body">
              <div class="card-body-icon">
				<i class="fa-solid fa-cart-shopping" style="margin-right: 0.2em;"></i>
              </div>
              <h5 class="card-title fs-5 text-center">JUMLAH TRANSAKSI</h5>
              <div class="display-4 fw-bold">
                <?= $barisdata['transaksi']; ?>
              </div>
              <a class="text-decoration-none text-info" href="./pages/transaksi/transaksi.php">
                <p class="card-text text-white">Lihat Detail</p>
              </a>
            </div>
          </div>
		  <div class="card bg-danger mt-4" style="width: 18rem; margin-left: 1em;">
            <div class="card-body">
              <div class="card-body-icon">
				<i class="fa-solid fa-user" style="margin-right: 0.2em;"></i>
              </div>
              <h5 class="card-title fs-5 text-center">JUMLAH PEGAWAI</h5>
              <div class="display-4 fw-bold">
                <?= $barisdata['pegawai']; ?>
              </div>
              <a class="text-decoration-none text-info" href="./pages/pegawai/pegawai.php">
                <p class="card-text text-white">Lihat Detail</p>
              </a>
            </div>
          </div>
			</div>
			</div>
			
<?php
		 }
	$res->free();
	}else
		echo "Gagal Eksekusi SQL".(DEVELOPMENT?" : ".$db->error:"")."<br>";
}
else
	echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
?>

	<!-- Modal -->
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
		<form method="post" action="logout.php">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
		<button type="submit" name="TblKeluar" class="btn btn-danger">Yakin</button>
		</form>
	</div>
</div>
</div>
</div>
</div>
	</div>
   </body>
</html>