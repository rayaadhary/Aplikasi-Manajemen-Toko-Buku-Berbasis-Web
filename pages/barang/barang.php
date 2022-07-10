<?php
	session_start();
	if(!isset($_SESSION["id_pegawai"]))
		header("Location: ../../index.php?error=4");
?>
<?php include_once("../../functions.php");?>
<!DOCTYPE html>
<html>
	<head>
		<title>Tampil Data Barang</title>
    <!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link rel="stylesheet" href="../../style.css">
	</head>
<body>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- banner -->
<div class="banner">
	<nav class="navbar navbar-expand-lg fixed-top navbar-dark shadow-sm bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Buka Buku</a>
	      
	<form class="d-flex">
		<form method="get" name="frm" action="barang.php">
			<input class="form-control me-2" name="cari" type="text" placeholder="Pencarian" aria-label="Search">
			<button class="btn btn-outline-light mr-sm-2" type="text" name="tblCari" type="submit">Cari</button>
		</form>
      </form>

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
			<?php
$db=dbConnect();
if($db->connect_errno==0){
	
	// pagination
	$perpage = 5;
	$hasil = $db->query("SELECT * FROM barang");
	$total = $hasil->num_rows;
	$banyakHal = ceil($total / $perpage);
	$page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
	$start = ($page > 1) ?  ($page * $perpage) - $perpage:0;
	$sebelumnya = $page - 1;
	$selanjutnya = $page + 1;
	
	if(isset($_GET["tblCari"])){
		$dicari=$db->escape_string($_GET["cari"]);
		$sql="SELECT id_barang, nama_barang, nama_jenis, harga, stok, nama_pegawai
        FROM barang JOIN jenis ON  barang.id_jenis = jenis.id_jenis LEFT JOIN pegawai ON barang.id_pegawai = pegawai.id_pegawai
		WHERE nama_barang LIKE '%$dicari%' 
		OR id_barang LIKE '%$dicari%'
		OR nama_jenis LIKE '%$dicari%'
		OR harga LIKE '%$dicari%'
		OR stok LIKE '%$dicari%'
		OR nama_pegawai LIKE '%$dicari%'
		ORDER BY id_barang
		LIMIT $start, $perpage";
	}   
	else{
	$sql="SELECT id_barang, nama_barang, nama_jenis, harga, stok, nama_pegawai FROM barang
	JOIN jenis ON barang.id_jenis = jenis.id_jenis LEFT JOIN pegawai ON barang.id_pegawai = pegawai.id_pegawai 
	ORDER BY id_barang 
	LIMIT $start,$perpage";
	}
	$res=$db->query($sql);
	if($res){
		?>
		<a href="barang-tambah.php"><button type="button" class="btn btn-outline-primary rounded">Tambah Barang</button></a>

		<table class="table mt-1">
            <thead class="thead-dark table-dark">
                <tr>
                <th scope="col">Id Barang</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Jenis</th>
                <th scope="col">Harga</th>
				<th scope="col">Stok</th>
				<th scope="col">Nama Pegawai</th>
                <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
		<?php
		$data=$res->fetch_all(MYSQLI_ASSOC); // ambil seluruh baris data
		foreach($data as $barisdata){ // telusuri satu per satu
			?>
			<tr>
			<td><?php echo $barisdata["id_barang"];?></td>
			<td><?php echo $barisdata["nama_barang"];?></td>
			<td><?php echo $barisdata["nama_jenis"];?></td>
			<td align="right"><?php echo number_format($barisdata["harga"],0,",",".");?></td>
			<td align="right"><?php echo $barisdata["stok"];?></td>
			<td><?php echo $barisdata["nama_pegawai"];?></td>
			<td class="text-center">
                    <a href="barang-form-ubah.php?id_barang=<?php echo base64_encode($barisdata["id_barang"]); ?>">
                    <button type="button" class="btn btn-success">Ubah</button></a>
                    <a href="barang-konfirmasi-hapus.php?id_barang=<?php echo base64_encode($barisdata["id_barang"]); ?>">
                    <button  type="button" class="btn btn-danger">Hapus</button></a>
				</td>
			</tr>
			<?php
		}
		?>
		</table>
			<nav aria-label="...">
			<ul class="pagination justify-content-center">
				<li class="page-item">
					 <?php if($page > 1){ echo "<a class='page-link' href='?halaman=$sebelumnya'>Sebelumnya</a>"; } ?>
				</li>
				<?php for($i=1; $i<=$banyakHal; $i++){ ?>
				<li class="page-item <?php if($page == $i)echo "active"?>" aria-current="page">
					<a class="page-link"  href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
				</li>
				<?php } ?>
				</li>
				<li class="page-item">
					 <?php if($page < $banyakHal) { echo "<a  class='page-link' href='?halaman=$selanjutnya'>Selanjutnya</a>"; } ?>
				</li>
			</ul>
			</nav>
		<?php
		$res->free();
	}else
		echo "Gagal Eksekusi SQL".(DEVELOPMENT?" : ".$db->error:"")."<br>";
}
else
	echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
?>
</div>
</div>
</div>
</body>
</html>