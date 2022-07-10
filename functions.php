<?php
define("DEVELOPMENT",TRUE);
function dbConnect(){
	$db=new mysqli("localhost","root","","bukabuku");// Sesuaikan dengan konfigurasi server anda.
	return $db;
}
// getListKategori digunakan untuk mengambil seluruh data dari tabel produk
function getListJenis(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * 
						 FROM jenis
						 ORDER BY id_jenis");
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

// getListKategori digunakan untuk mengambil seluruh data dari tabel produk
function getListBarang(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * 
						 FROM barang
						 ORDER BY id_barang");
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getListPembeli(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * 
						 FROM pembeli
						 ORDER BY id_pembeli");
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}


// digunakan untuk mengambil data sebuah barang
function getDataBarang($id_barang){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT id_barang, nama_barang, harga, stok, barang.id_jenis, nama_jenis 
						FROM barang JOIN jenis ON barang.id_jenis = jenis.id_jenis
						 WHERE id_barang='$id_barang'");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

// digunakan untuk mengambil data sebuah jenis
function getDataJenis($id_jenis){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT id_jenis, nama_jenis 
						FROM jenis WHERE id_jenis='$id_jenis'");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

// digunakan untuk mengambil data sebuah transaksi
function getDataTransaksi($id_transaksi){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT id_transaksi, tanggal, deskripsi, id_barang, transaksi.id_pembeli
						FROM transaksi JOIN pembeli ON transaksi.id_pembeli = pembeli.id_pembeli 
						WHERE id_transaksi='$id_transaksi'");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

// digunakan untuk mengambil data pembeli
function getDataPembeli($id_pembeli){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT id_pembeli, nama_pembeli, telepon, alamat
						FROM pembeli
						WHERE id_pembeli='$id_pembeli'");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

// digunakan untuk mengambil data pembeli
function getDataPegawai($id_pegawai){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT id_pegawai, pass, nama_pegawai, telepon, alamat
						FROM pegawai
						WHERE id_pegawai='$id_pegawai'");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function banner(){
	?>
<div id="banner"><h1>Buka Buku</h1>
</div>
	<?php
}
function navigator(){
	?>
<div id="navigator">
| <a href="barang.php">Barang</a> 
| <a href="kategori.php">Kategori</a> 
| <a href="pelanggan.php">Pelanggan</a> 
| <a href="pegawai.php">Pegawai</a> 
| <a href="kantor.php">Kantor</a> 
| <a href="pesanan.php">Pesanan</a> 
| <a href="pembayaran.php">Pembayaran</a> 
| <a href="logout.php">Log Out</a> 
| 
</div>
	<?php
}

function pagination(){
		// pagination
	$db = dbConnect();
	$perpage = 4;
	$hasil = $db->query("SELECT * FROM barang");
	$total = $hasil->num_rows;
	$banyakHal = $total / $perpage;
	$page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
	$start = ($page > 1) ?  ($page * $perpage) - $perpage:0;
}

function showError($message){
	?>
<div style="background-color:#FAEBD7;padding:10px;border:1px solid red;margin:15px 0px">
<?php echo $message;?>
</div>
	<?php
}
?>