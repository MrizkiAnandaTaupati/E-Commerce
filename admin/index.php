<?php 
include "header.php";
//mengambil data produk
$produk = array();
$ambil_produk = $koneksi -> query("SELECT * FROM produk LEFT JOIN kategori ON kategori.id_kategori = produk.id_kategori");
while ($tiap_produk = $ambil_produk -> fetch_assoc()) 
{
	$produk [] = $tiap_produk;
}

//mengambil data pelanggan
$pelanggan = array();
$ambil_pelanggan = $koneksi -> query("SELECT * FROM pelanggan");
while ($tiap_pelanggan = $ambil_pelanggan -> fetch_assoc()) 
{
	$pelanggan [] = $tiap_pelanggan;
}

//mengambil data pembelian
$ambil_p = $koneksi -> query("SELECT * FROM pembelian LEFT JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan");
$pembelian = array();
while ($tiap_p = $ambil_p -> fetch_assoc()) 
{
	$pembelian[] = $tiap_p;
}

//mengambil total jumlah data dari tabel produk , pelanggan , pembelian
$jp = count($produk);
$jl = count($pelanggan);
$jj = count($pembelian);

$tahun = date("Y");
$bulan['01'] = "Januari";
$bulan['02'] = "Februari";
$bulan['03'] = "Maret";
$bulan['04'] = "April";
$bulan['05'] = "Mei";
$bulan['06'] = "Juni";
$bulan['07'] = "Juli";
$bulan['08'] = "Agustus";
$bulan['09'] = "September";
$bulan['10'] = "Oktober";
$bulan['11'] = "November";
$bulan['12'] = "Desember";

$kat = $koneksi -> query("SELECT * FROM kategori");
$ktg = array();
while ($tiap_ktg = $kat->fetch_assoc())
{
	$id_ktg = $tiap_ktg['id_kategori'];
	foreach ($bulan as $nobul => $nabul) {
		$ambil = $koneksi -> query("SELECT SUM(jumlah_beli) FROM `pembelian_produk` LEFT JOIN pembelian ON pembelian.id_pembelian = pembelian_produk.id_pembelian LEFT JOIN produk ON produk.id_produk = pembelian_produk.id_produk LEFT JOIN kategori ON kategori.id_kategori = produk.id_kategori WHERE kategori.id_kategori = $id_ktg AND MONTH(tanggal_pembelian) = '$nobul' AND YEAR(tanggal_pembelian) = '$tahun'");
		$pecah = $ambil->fetch_assoc();
		$jumlah = $pecah['SUM(jumlah_beli)'];

		if (empty($jumlah)) 
		{
			$jumlah = 0;
		}
		$tiap_ktg['laporan'] [$nabul] = $jumlah;

	}
	$ktg[] = $tiap_ktg;

}

?>
<p>Selamat datang <b><?php echo $admin["nama_admin"]; ?></b></p>
<p>
	Pada panel ini anda dapat mengelola data toko seperti produk , kategori , melihat data penjualan , pembayaran , pengiriman serta melihat laporan
</p>
<figure class="highcharts-figure">
	<div id="container"></div>
</figure>
<div class="row">
	<div class="col-md-4 mb-3">
		<a href="" class="text-decoration-none">
			<div class="card">
				<h3 class="text-center p-2 bg-warning text-white">Data Produk</h3>
				<div class="card-body text-center">
					<span class="bi bi-app-indicator display-3 text-dark fw-bold"> : <?php echo $jp; ?></span>
				</div>
			</div>
		</a>
	</div>
	<div class="col-md-4 mb-3 col-6">
		<a href="" class="text-decoration-none">
			<div class="card">
				<h3 class="text-center p-2 bg-info text-white">Data Pelanggan</h3>
				<div class="card-body text-center">
					<span class="bi bi-people display-3 text-dark fw-bold"> : <?php echo $jl; ?></span>
				</div>
			</div>
		</a>
	</div>
	<div class="col-md-4 mb-3 col-6">
		<a href="" class="text-decoration-none">
			<div class="card">
				<h3 class="text-center p-2 bg-success text-white">Data Penjualan</h3>
				<div class="card-body text-center">
					<span class="bi bi-bag-check display-3 text-dark fw-bold"> : <?php echo $jj; ?></span>
				</div>
			</div>
		</a>
	</div>
</div>
<script type="text/javascript">
	Highcharts.chart('container', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Grafik Penjualan'
		},
		xAxis: {
			categories: [
			'Jan',
			'Feb',
			'Mar',
			'Apr',
			'May',
			'Jun',
			'Jul',
			'Aug',
			'Sep',
			'Oct',
			'Nov',
			'Dec'
			],
			crosshair: true
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Jumlah Produk (buah)'
			}
		},
		tooltip: {
			headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
			'<td style="padding:0"><b>{point.y:.1f} buah</b></td></tr>',
			footerFormat: '</table>',
			shared: true,
			useHTML: true
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
		series: [
		<?php foreach ($ktg as $key => $value): ?>
			{
				name: '<?php echo $value["nama_kategori"]; ?>',
				data: [
				<?php foreach ($value['laporan'] as $nobul => $jumlah): ?>
				<?php echo $jumlah; ?>,
				<?php endforeach ?>

				]

			},
		<?php endforeach ?>

		]
	});
</script>
<?php 
include "footer.php";
?>