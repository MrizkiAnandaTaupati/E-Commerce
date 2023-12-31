<?php 
include "header.php";
//menampilkan riwayat pembelian dari pelanggan yang login
$ambil_pembelian = $koneksi -> query("SELECT * FROM pembelian WHERE id_pelanggan = '$id_pelanggan'  ORDER BY id_pembelian DESC");
$pembelian = array();
while ($tiap_pembelian = $ambil_pembelian -> fetch_assoc()) 
{
	$pembelian[] = $tiap_pembelian;
}
?>
<div class="min-vh-100">
	<div class="container mt-5 table-responsive">
		<h3>Riwayat Transaksi</h3>
		<hr>
		<table class="table table-bordered table-hover" id="testing">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal Pembelian</th>
					<th>Batas Pembayaran</th>
					<th>Total Pembelian</th>
					<th>Metode Pembayaran</th>
					<th>Status</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($pembelian as $key => $value): ?>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td><?php echo date("d / M / Y / H:i:s",strtotime($value["tanggal_pembelian"])); ?></td>
						<?php if ($value['metode_pembayaran']=="transfer"): ?>
						<td><?php echo date("d / M / Y / H:i:s",strtotime($value["batas_pembayaran"])); ?></td>
						<?php else: ?>
						<td>Bayarlah ketika barang sudah sampai ke alamat tujuan Anda</td>
						<?php endif ?>
						<td>Rp <?php echo number_format($value["total_pembelian"]); ?></td>
						<td><?php echo $value["metode_pembayaran"]; ?></td>
						<td><?php echo $value["status_pembelian"]; ?></td>
						<td>
							<a href="detail_pembelian.php?id=<?php echo $value["id_pembelian"]; ?>" class="btn-sm btn btn-info text-white">Detail</a>

							<?php 
							$id_pembelian = $value["id_pembelian"];
							// Data Pembayaran
							$ambil_pembayaran = $koneksi -> query("SELECT * FROM pembayaran WHERE id_pembelian = '$id_pembelian'");
							$pembayaran = $ambil_pembayaran -> fetch_assoc();

							// Data Pengiriman
							$ambil_pengiriman = $koneksi -> query("SELECT * FROM pengiriman WHERE id_pembelian= '$id_pembelian'");
							$pengiriman = $ambil_pengiriman->fetch_assoc();

							// Data pembellian produk
							$ambil_detail = $koneksi -> query("SELECT * FROM pembelian_produk LEFT JOIN produk ON produk.id_produk = pembelian_produk.id_produk WHERE id_pembelian = '$id_pembelian'");
							$produk = $ambil_detail->fetch_assoc();
							
							// echo "<pre>";
							// print_r($resi);
							// echo "</pre>";
							?>

							<!-- Jika status pembelian batal atau selesai maka tidak tampilkan pengiriman dan pembayaran -->
							<?php if ($value["status_pembelian"]=="batal" OR $value["status_pembelian"]=="selesai"): ?>
								<!-- Jika selesai maka tampilkan link testimoni -->
								<?php if ($value["status_pembelian"]=="selesai"): ?>
									<a href="testimoni.php?id=<?php echo $value['id_pembelian']; ?>" class="btn-sm btn btn-warning text-white">Ulas Produk</a>
								<?php endif ?>
								<!-- Jika tidak maka tampilkan tombol pembayaran dan pengiriman -->
							<?php else: ?>
								<?php if (!isset($pembayaran)): ?>
									<a href="pembayaran.php?id=<?php echo $value["id_pembelian"]; ?>" class="btn-sm btn btn-success">Menunggu Pembayaran</a>
									<!-- Jika tidak ada data pembayaran / transaksi belum dibayar maka tampilkan tombol menunggu pembayaran -->
								<?php else: ?>
									<a href="pembayaran.php?id=<?php echo $value["id_pembelian"]; ?>" class="btn-sm btn btn-success">Pembayaran</a>
									<a href="pengiriman.php?id=<?php echo $value["id_pembelian"]; ?>" class="btn btn-secondary btn-sm">Pengiriman</a>
								<?php endif ?>
							<?php endif ?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<?php 
include "footer.php";
?>