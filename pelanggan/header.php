<?php 
//memanggil file koneksi.php agar bisa mengakses semua skrip yang ada di dalam file koneksi.php
include "../koneksi.php";

//Jika tidak ada data login / proses login maka tidak boleh masuk ke halaman ini
if (!isset($_SESSION["pelanggan"])) 
{
	echo "<script>alert('Anda harus login !')</script>";
	echo "<script>location = '../index.php'</script>";
}

//mendapatkan data pelanggan yang sedang login
$id_pelanggan = $_SESSION["pelanggan"] ["id_pelanggan"];
$ambil_pelanggan = $koneksi -> query("SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
$pelanggan = $ambil_pelanggan -> fetch_assoc();

//mengambil data kategori
$ambil_kategori = $koneksi -> query("SELECT * FROM kategori");
$kategori = array();
while ($tiap_kategori = $ambil_kategori -> fetch_assoc()) 
{
	$kategori[] = $tiap_kategori;
}

//mengambil data keranjang dari user yang login
$ambil_keranjang = $koneksi -> query("SELECT * FROM keranjang LEFT JOIN produk ON produk.id_produk = keranjang.id_produk WHERE id_pelanggan = '$id_pelanggan'");
$keranjang = array();
while ($tiap_keranjang = $ambil_keranjang -> fetch_assoc()) 
{
	$keranjang[] = $tiap_keranjang;
}
//menghitung jumlah data keranjang dari user yang login
$jk = count($keranjang);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	<style type="text/css">
		.hv:hover{
			background-color: #FFBD00;
		}
	</style>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg bg-success navbar-dark p-3">
		<div class="container">
			<img src="../assets/file/logo.jpg" width="100"> &nbsp;
			<a href="index.php" class="navbar-brand fw-bold text-white">Rindang 84 Juwana</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#lorem" aria-controls="lorem" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="navbar-collapse collapse" id="lorem">
				<ul class="navbar-nav me-auto">
					<li class="nav-item hv">
						<a href="index.php" class="nav-link text-white fw-bold">Beranda</a>
					</li>
					<li class="nav-item hv">
						<a href="produk.php" class="nav-link text-white fw-bold">Produk</a>
					</li>
					<li class="nav-item dropdown hv">
						<a class="nav-link dropdown-toggle text-white fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Kategori
						</a>
						<ul class="dropdown-menu">
							<?php foreach ($kategori as $kt => $vt): ?>
								<li><a class="dropdown-item" href="produk.php?idk=<?php echo $vt["id_kategori"]; ?>"><?php echo $vt["nama_kategori"]; ?></a></li>
							<?php endforeach ?>
						</ul>
					</li>
					<li class="nav-item hv">
						<a href="riwayat.php" class="nav-link text-white fw-bold">Riwayat Belanja</a>
					</li>
					<form class="d-flex text-center ms-2" role="search">
						<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="cari">
						<button name="tombol" class="btn btn-transparent" style="background: white; border: #7B68EE;" type="submit">
							<span class="bi bi-search fw-bold" style="color: green;"></span>
						</button>
					</form>
					<?php 
					if(isset($_GET['tombol'])){
						$cari = $_GET['cari'];
					}
					?>
				</ul>
				<ul class="navbar-nav">
					<li class="nav-item hv">
						<a href="keranjang.php" class="nav-link text-white display-3 position-relative fw-bold">
							Keranjang
							<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $jk ?></span>
						</a>
					</li>
					<!-- Vertically centered scrollable modal -->
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-success fw-bold hv" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
						Chat
					</button>
					<?php 
					$ambil_chat = $koneksi -> query("SELECT * FROM chat WHERE id_pelanggan = '$id_pelanggan'");
					$chat = array();
					while ($tiap_chat = $ambil_chat->fetch_assoc()) 
					{
						$chat[] = $tiap_chat;
					}
					?>
					<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" id="staticBackdropLabel">Kirim Pesan</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<?php foreach ($chat as $key => $value): ?>
									<div class="row mb-3">
										<?php if ($value["pengirim_chat"]=="pelanggan"): ?>	
										<div class="col-6 bg-secondary text-white shadow p-2 shadow" style="border-radius: 5px;">
											<?php echo $value["isi_chat"]; ?>
										</div>
										<?php endif ?>
										<?php if ($value["pengirim_chat"]=="admin"): ?>	
										<div class="col-6 offset-6 bg-light text-dark shadow p-2" style="border-radius: 5px;">
											<?php echo $value["isi_chat"]; ?>
										</div>
										<?php endif ?>
									</div>
									<?php endforeach ?>
									
								</div>
								<div class="modal-footer">
									<form method="post">
										<div class="row">
											<div class="col-10">		
												<div class="form-group">
													<textarea class="form-control" rows="1" cols="100" name="isi_chat"></textarea>
												</div>
											</div>
											<div class="col-2 text-center">
												<button class="btn btn-primary" name="kirim">Kirim</button>	
											</div>
										</div>
									</form>
									<?php 
									if (isset($_POST["kirim"])) 
									{
										$pelanggan = $id_pelanggan;
										$id_admin = 0;
										$isi_chat = $_POST["isi_chat"];
										$pengirim = "pelanggan";

										$koneksi -> query("INSERT INTO chat(id_pelanggan,id_admin,isi_chat,pengirim_chat) VALUES('$pelanggan','$id_admin','$isi_chat','$pengirim')");
										echo "<script>location = 'index.php'</script>";
									}
									 ?>
								</div>
							</div>
						</div>
					</div>
					<li class="nav-item hv">
						<a href="profile.php" class="nav-link text-white fw-bold">Profile</a>
					</li>
					<li class="nav-item hv">
						<a href="logout.php" class="nav-link text-white fw-bold" onclick="return confirm('Apakah anda yakin ingin keluar?')">Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="min-vh-100">