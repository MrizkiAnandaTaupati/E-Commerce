<?php 
include "header.php";
//mengambil id 
$id_detailp = $_GET["id"];

//mengamabil data pembelian produk
$detailp = array();
$ambil_detailp = $koneksi -> query("SELECT * FROM pembelian_produk LEFT JOIN produk ON produk.id_produk = pembelian_produk.id_produk WHERE id_pembelian = '$id_detailp'");
while ($tiap_detailp = $ambil_detailp -> fetch_assoc()) 
{
	$detailp[] = $tiap_detailp;
}

//mengambil data pembelian
$ambil_pembelian = $koneksi -> query("SELECT * FROM pembelian LEFT JOIN pelanggan ON pelanggan.id_pelanggan = pembelian.id_pelanggan WHERE id_pembelian = '$id_detailp'");
$pembelian = $ambil_pembelian -> fetch_assoc();

// echo "<pre>";
// print_r($detailp);
// echo "</pre>";
?>
<h3>Detail Pembelian</h3>
<hr>
<div class="row">
	<div class="col-md-4">
		<div class="table-responsive">
			<table class="table">
				<tr>
					<th>Nama</th>
					<td>: <?php echo $pembelian["nama_pelanggan"]; ?></td>
				</tr>
				<tr>
					<th>Tanggal Transaksi</th>
					<td>: <?php echo date("d M Y, H:i:s",strtotime($pembelian["tanggal_pembelian"])); ?></td>
				</tr>
				<tr>
					<th>Batas Pembayaran</th>
					<td>: <?php echo date("d M Y, H:i:s",strtotime($pembelian["batas_pembayaran"])); ?></td>
				</tr>
				<tr>
					<th>Status Pembelian</th>
					<td>: <?php echo $pembelian["status_pembelian"]; ?></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="col-md-4">
		<form method="post">
			<div class="mb-3">
				<label class="form-label fw-bold">Ubah Status</label>
				<select class="form-control" name="status">
					<option value="pending" <?php if($pembelian["status_pembelian"]=="pending"){echo "selected";} ?> >Pending</option>
					<option value="lunas" <?php if($pembelian["status_pembelian"]=="lunas"){echo "selected";} ?> >Lunas</option>
					<option value="kirim" <?php if($pembelian["status_pembelian"]=="kirim"){echo "selected";} ?> >Kirim</option>
					<option value="selesai" <?php if($pembelian["status_pembelian"]=="selesai"){echo "selected";} ?> >Selesai</option>
					<option value="batal" <?php if($pembelian["status_pembelian"]=="batal"){echo "selected";} ?> >Batal</option>
				</select>
			</div>
			<div class="d-grid gap-2">
				<?php if ($pembelian["status_pembelian"]=="selesai" OR $pembelian["status_pembelian"]=="batal"): ?>
					<button class="btn btn-primary disabled" name="simpan">Simpan</button>
				<?php else: ?>
					<button class="btn btn-primary" name="simpan">Simpan</button>
				<?php endif ?>
			</div>
		</form>
		<?php 
		if (isset($_POST["simpan"])) 
		{
			$status = $_POST["status"];

			$koneksi -> query("UPDATE pembelian SET 
				status_pembelian = '$status' WHERE id_pembelian = '$id_detailp'");

			echo "<script>alert('Berhasil mengubah status')</script>";
			echo "<script>location = 'detail_pembelian.php?id=$id_detailp'</script>";
		}
		 ?>
	</div>
</div>
<div class="table-responsive">
	<table class="table table-bordered table-hover" id="thetable">
		<thead>
			<tr>
				<th>Produk</th>
				<th>Jumlah</th>
				<th>Harga</th>
				<th>Berat</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($detailp as $key => $value): ?>
				<tr>
					<td><?php echo $value["nama_produk"]; ?></td>
					<td><?php echo $value["jumlah_beli"]; ?></td>
					<td>Rp <?php echo number_format($value["harga_produk"]); ?></td>
					<td><?php echo number_format($value["berat_produk"]); ?> Gr</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
<?php 
include "footer.php";
?>