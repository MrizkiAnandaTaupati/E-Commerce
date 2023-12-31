<?php
include 'class.php';

// Akses fungsi update_ongkir
$dt_ongkir = $apiongkir->update_ongkir(419,$_POST['id_kota'],$_POST['total_berat'],$_POST['ekspedisi']);
?>
<pre><?php print_r($_POST) ?></pre>
<option value="">Pilih Ongkir</option>
<?php foreach ($dt_ongkir as $key => $value): ?>
	<option value="" nama="<?php echo $value['service'] ?>" biaya="<?php echo $value['cost'][0]['value'] ?>" lama="<?php echo $value['cost'][0]['etd'] ?>"><?php echo $value['service'] ?> Rp. <?php echo number_format($value['cost'][0]['value']) ?> (<?php echo $value['cost'][0]['etd'] ?> hari)</option>
<?php endforeach ?>