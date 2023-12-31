<?php 
include "header.php";
//jika ada parameter id kategori di url maka tampilkan
if (isset($_GET["idk"])) 
{
	$id_kategori = $_GET["idk"];
}
//jika ada yang ngetik lewat formulir cari maka akan menampilkan produk berdasarkan keyword yang diketik
if(isset($_GET['cari']))
{
	$cari = $_GET['cari'];
	$ambil_produk = $koneksi -> query("SELECT * FROM produk LEFT JOIN kategori ON kategori.id_kategori = produk.id_kategori WHERE nama_produk LIKE '%".$cari."%' ORDER BY id_produk DESC");
	$produk = array();
	while ($tiap_produk = $ambil_produk -> fetch_assoc()) 
	{
		$produk[] = $tiap_produk;
	}    
}

elseif (isset($_GET["idk"])) 
{
	$produk = array();
	$ambil_produk = $koneksi -> query("SELECT * FROM produk LEFT JOIN kategori ON kategori.id_kategori = produk.id_kategori WHERE kategori.id_kategori = '$id_kategori' ORDER BY id_produk DESC ");
	while ($tiap_produk = $ambil_produk -> fetch_assoc()) 
	{
		$produk [] = $tiap_produk;
	}

	//mengambil data kategori berdasarkan id kategori
	$ak = $koneksi -> query("SELECT * FROM kategori WHERE id_kategori = '$id_kategori'");
	$kt = $ak -> fetch_assoc();
}

//apabila tidak ada yang ngetik di formulir maka menampilkan semua data produk
else
{
	$produk = array();
	$ambil_produk = $koneksi -> query("SELECT * FROM produk LEFT JOIN kategori ON kategori.id_kategori = produk.id_kategori ORDER BY id_produk DESC ");
	while ($tiap_produk = $ambil_produk -> fetch_assoc()) 
	{
		$produk [] = $tiap_produk;
	}
} 
?>
<div class="container">
	<div class="row my-3">
		<?php 
		if (isset($_GET["cari"])) 
		{
			echo "<b class='my-3 text-uppercase'>Hasil pencarian : ".$cari."</b>"; 
		}
		?>
		<?php 
		if (isset($_GET["idk"])) 
		{
			echo "<h3 class='fw-bold my-3'>
			KATEGORI :" .$kt['nama_kategori']."
			</h3>";
		}
		?>
		<hr>
		<?php foreach ($produk as $key => $value): ?>
			<div class="col-md-3 col-6 mb-3">
				<div class="card">
					<img src="assets/file/<?php echo $value["foto_produk"]; ?>" class="img-fluid">
					<div class="card-body">
						<h4><?php echo $value["nama_produk"]; ?></h4>
						<h6>Rp <?php echo number_format($value["harga_produk"]); ?></h6>
						<a href="detail_produk.php?id=<?php echo $value["id_produk"]; ?>" class="btn btn-success text-white"><span class="bi bi-box-arrow-right"></span> Selengkapnya</a>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div>  
	<div class="text-center">
		<a href="produk.php" class="btn btn-success text-decoration-none text-white">SEMUA PRODUK</a>
	</div>
</div>
<?php 
include "footer.php";
?>