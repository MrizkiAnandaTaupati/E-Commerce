<?php 
include "header.php";
//mengambil id produk dari url
$id_produk = $_GET["id"];
if (isset($_GET["idp"])) {
	$id_pp = $_GET["idp"];
}

//mengambil data produk berdasarkan id produk
$ambil_produk = $koneksi -> query("SELECT * FROM produk LEFT JOIN kategori ON kategori.id_kategori = produk.id_kategori WHERE id_produk = '$id_produk'");
$produk = $ambil_produk -> fetch_assoc();
$ikp = $produk["id_kategori"];


//mengambil 4 data produk terbaru
$produk1 = array();
$ambil_produk1 = $koneksi -> query("SELECT * FROM produk LEFT JOIN kategori ON kategori.id_kategori = produk.id_kategori ORDER BY id_produk DESC limit 4");
while ($tiap_produk1 = $ambil_produk1 -> fetch_assoc()) 
{
	$produk1 [] = $tiap_produk1;
}

//mengambil data keranjang dari user yang login
$ambil_k = $koneksi -> query("SELECT * FROM keranjang WHERE id_produk = '$id_produk' AND id_pelanggan = '$id_pelanggan'");
$kk = $ambil_k -> fetch_assoc();

//mengambil data pembelian produk berdasarkan id pembelian produk 
if (isset($id_pp)) {
	$ambil_pp = $koneksi -> query("SELECT * FROM pembelian_produk WHERE id_pembelian_produk = '$id_pp'");
	$app = $ambil_pp->fetch_assoc();
}

//mengambil data produk terkait
$ambil_rp = $koneksi -> query("SELECT * FROM produk WHERE id_kategori = '$ikp'");
$rp = array();
while ($tiap_rp = $ambil_rp -> fetch_assoc()) 
{
	$rp[] = $tiap_rp;
}

$ambil_keranjang = $koneksi -> query("SELECT * FROM keranjang WHERE id_pelanggan = '$id_pelanggan' AND id_produk = '$id_produk'");
$keranjang = $ambil_keranjang ->fetch_assoc();
// echo "<pre>";
// print_r($keranjang);
// echo "</pre>";


// Mengambil rating produk ini
$jumlah_r = 0;
$banyak_r = 0;
$ambil_rate = $koneksi -> query("SELECT * FROM `pembelian_produk` WHERE id_produk = '$id_produk'");
while ($tiap_r = $ambil_rate -> fetch_assoc()) 
{
	if ($tiap_r['rating_produk'] > 0) 
	{
		$jumlah_r += $tiap_r['rating_produk'];
		$banyak_r+=1;

	}
}
if (!empty($jumlah_r) AND !empty($banyak_r)) {
	$total = $jumlah_r/$banyak_r;
}
else
{
	$total = "";
}

// echo "<pre>";
// print_r($jumlah_r/$banyak_r);
// echo "</pre>";
?>
<div class="container">
	<div class="card shadow my-5">
		<div class="card-body">
			<div class="row">
				<div class="col-md-4 text-center">
					<img src="../assets/file/<?php echo $produk["foto_produk"]; ?>" class="img-fluid">
				</div>
				<div class="col-md-8">
					<h3 class="fw-bold"><?php echo $produk["nama_produk"]; ?></h3>
					<hr>
					<p><b>KATEGORI</b> : <?php echo $produk["nama_kategori"]; ?></p>
					<p><b>Harga</b> : Rp <?php echo number_format($produk["harga_produk"]); ?></p>
					<p><b>Stok</b> : <?php echo number_format($produk["stok_produk"]); ?></p>
					<p><b>Berat</b> : <?php echo number_format($produk["berat_produk"]); ?> Gr</p>
					<?php foreach (range(1, $total) as $k => $v): ?>
						<span class="bi bi-star-fill text-warning fw-bold"> </span>
						<?php endforeach ?>
					<span class="bi bi-star-fill text-warning"> | <?php echo $total; ?></span>
					<p class="text-center"><b>Deskripsi</b></p>
					<p style="text-align: justify;">
						<?php echo $produk["deskripsi_produk"]; ?>
					</p>
					<br>
					<hr>
					<form action="" method="post" class="text-center pt-2">
						<label class="form-label" for="">Masukan Jumlah</label>
						<input class="form-control" type="number" min="1" value="1" max="" name="masukan">
						<div class="d grid gap-2 pt-2">
							<?php if ($produk["stok_produk"]==0): ?>
								<button class="btn btn-warning text-white disabled" name="beli"><i class="bi bi-cart"></i> Maaf Stok Kosong</button>
							<?php else: ?>
								<button class="btn btn-warning text-white" name="beli"><i class="bi bi-cart"></i> Masukan Keranjang</button>
							<?php endif ?>
							<?php if (isset($id_pp)): ?>
								<?php if (empty($app["ulasan_produk"]) AND $app["rating_produk"]==0): ?>
									<!-- Button trigger modal -->
									<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ulasan">
										<span class="bi bi-award"></span> Ulas Produk
									</button>

									<!-- Modal -->
									<div class="modal fade" id="ulasan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h1 class="modal-title fs-5" id="staticBackdropLabel">Ulasan dan Rating</h1>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													<form method="post">
														<div class="mb-3">
															<label class="form-label fw-bold">Ulasan Anda</label>
															<textarea class="form-control" name="ulasan_produk"></textarea>
														</div>
														<div class="mb-3">
															<label class="form-label fw-bold">Rating</label>
															<input type="number" class="form-control" name="rating_produk">
															<i class="text-muted small">
																*Silahkan masukkan angka 1 - 5 untuk memberikan rating pada produk
															</i>
														</div>
														<div class="mb-3">
															<button class="btn btn-primary" name="ulas">Simpan</button>
														</div>
													</form>
													<?php 
													if (isset($_POST["ulas"])) 
													{
														$ulasan = $_POST["ulasan_produk"];
														$rating = $_POST["rating_produk"];

														$koneksi -> query("UPDATE pembelian_produk SET 
															ulasan_produk = '$ulasan',
															rating_produk = '$rating' WHERE id_pembelian_produk = '$id_pp'");
														echo "<script>alert('Terima kasih atas ulasan anda')</script>";
														echo "<script>location = 'riwayat.php'</script>";
													}
													?>
												</div>
											</div>
										</div>
									</div>
								<?php endif ?>
							<?php endif ?>
							<a href="semua_ulasan.php?idp=<?php echo $id_produk; ?>" class="btn btn-success"><span class="bi bi-star text-white"></span> Semua Ulasan</a>
						</div>

						<?php 
						if (isset($_POST["beli"])) 
						{
							if ($_POST["masukan"] > $produk["stok_produk"]) 
							{
								echo "<script>alert('Maaf anda tidak bisa menambahkan produk ke keranjang karna sudah melebihi jumlah stok')</script>";
								echo "<script>location = 'detail_produk.php?id=$id_produk'</script>";
							}

							elseif ( empty($kk)) 
							{
								$koneksi -> query("INSERT INTO keranjang (id_produk,id_pelanggan,jumlah) VALUES('$id_produk','$id_pelanggan','$_POST[masukan]')");
								
							}

							elseif ($keranjang["jumlah"] == $produk["stok_produk"]) {
								echo "<script>alert('Maaf anda tidak bisa menambahkan produk ke keranjang karna sudah melebihi jumlah stok')</script>";
								echo "<script>location = 'detail_produk.php?id=$id_produk'</script>";
							}

							else
							{
								$jml = $kk["jumlah"]+$_POST["masukan"];
								$koneksi -> query("UPDATE keranjang SET jumlah = '$jml' WHERE id_pelanggan = '$id_pelanggan' AND id_produk = '$id_produk'");
							}
							echo "<script>location = 'keranjang.php'</script>";
						} 

						?>
					</form>
				</div>
			</div>
		</div>
		<?php 
		//mengambil data ulasan produk dari table pembelian produk berdasarkan produk
		$ambil_pembelian_produk = $koneksi -> query("SELECT * FROM pembelian_produk WHERE id_produk = '$id_produk'");
		$pp = array();
		while ($tiap_pembelian_produk = $ambil_pembelian_produk -> fetch_assoc()) {
			$pp[] = $tiap_pembelian_produk;
		}
		// echo "<pre>";
		// print_r($pp);
		// echo "</pre>";
		?>
		<?php foreach ($pp as $kp => $vp): ?>
			<div class="row">
				<div class="col-md-4">
					
				</div>
				<div class="col-md-8">
					
				</div>
			</div>
		<?php endforeach ?>
	</div>
	<div class="card mb-5">
		<div class="card-body">
			<h3 class="fw-bold text-center">Produk Terkait</h3>
			<hr>
			<div class="row">
				<?php foreach ($rp as $rk => $vr): ?>
					<div class="col-md-3">
						<div class="card">
							<img src="../assets/file/<?php echo $vr["foto_produk"]; ?>" class="card-img-top img-fluid">
							<div class="card-body">
								<h5 class="card-title"><?php echo $vr["nama_produk"]; ?></h5>
								<p class="card-text">Rp <?php echo number_format($vr["harga_produk"]); ?></p>
								<div class="d-grid gap-2">
									<a href="detail_produk.php?id=<?php echo $vr["id_produk"]; ?>" class="btn btn-success text-white"><span class="bi bi-box-arrow-right"></span> Selengkapnya</a>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
	<div class="card mb-5">
		<div class="card-body">
			<h3 class="fw-bold text-center">Produk Terbaru</h3>
			<hr>
			<div class="row">
				<?php foreach ($produk1 as $key => $value): ?>
					<div class="col-md-3">
						<div class="card">
							<img src="../assets/file/<?php echo $value["foto_produk"]; ?>" class="card-img-top img-fluid">
							<div class="card-body">
								<h5 class="card-title"><?php echo $value["nama_produk"]; ?></h5>
								<p class="card-text">Rp <?php echo number_format($value["harga_produk"]); ?></p>
								<div class="d-grid gap-2">
									<a href="detail_produk.php?id=<?php echo $value["id_produk"]; ?>" class="btn btn-success text-white"><span class="bi bi-box-arrow-right"></span> Selengkapnya</a>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</div>
<?php 
include "footer.php";
?>