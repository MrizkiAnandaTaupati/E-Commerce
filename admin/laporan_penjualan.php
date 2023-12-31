<?php 
include "header.php";
//jika ada inputan mulai dan inputan selesai maka
if (isset($_POST["dari_tanggal"]) AND isset($_POST["sampai_tanggal"])) 
{
	$mulai = $_POST["dari_tanggal"];
	$selesai = $_POST["sampai_tanggal"];
}
else
{
	$mulai = "";
	$selesai = "";
}

$ambil_produk = $koneksi -> query("SELECT * FROM produk");
$produk = array();
while($data_detail = $ambil_produk->fetch_assoc())
{
	$produk[] = $data_detail;
}

?>
<h4>LAPORAN PENJUALAN</h4>
<hr>
<form method="post">
	<div class="row">
		<div class="col-2">
			<label class="form-label">Dari</label>
			<input type="date" name="dari_tanggal" class="form-control" value="<?php echo $mulai ?>">
		</div>
		<div class="col-2">
			<label class="form-label">Sampai</label>
			<input type="date" name="sampai_tanggal" class="form-control" value="<?php echo $selesai ?>">	
		</div>
		<div class="col-1 mt-2">
			<br>
			<button class="btn btn-primary" name="lihat">Lihat</button>
		</div>
	</div>
</form>
<div class="mt-3">
	<div class="table-responsive">
		<table id="thetable" class="table table-bordered table-hover">
			<thead class="text-center">
				<tr>
					<th>No</th>
					<th>Produk</th>
					<th>Jumlah Penjualan</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>
				<?php $grandtotal = 0; ?>
				<?php foreach ($produk as $key => $value): ?>
					<?php
					$id_produk = $value['id_produk'];
					$detail = $koneksi->query("SELECT SUM(pembelian_produk.jumlah_beli) as jml, SUM(harga_beli) as total FROM pembelian_produk LEFT JOIN pembelian ON pembelian.id_pembelian = pembelian_produk.id_pembelian WHERE id_produk='$id_produk' AND tanggal_pembelian BETWEEN DATE('$mulai') AND DATE('$selesai')")->fetch_assoc();
					$grandtotal+=$detail['total'];
					?>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td><?php echo $value["nama_produk"]; ?></td>
						<td><?php echo $detail['jml']; ?></td>
						<td><?php echo number_format($detail['total']); ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="3">Grant Total</th>
					<th>Rp. <?php echo number_format($grandtotal); ?></th>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
