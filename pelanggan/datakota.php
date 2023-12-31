<?php
include 'class.php';
$dt_kota = $apiongkir->update_kota($_POST['provinsi']);
?>
<pre><?php print_r($_POST) ?></pre>
<option value="">Pilih Kota</option>
<?php foreach ($dt_kota as $key => $value): ?>
	<option value="<?php echo $value['city_id'] ?>" nama="<?php echo $value['city_name'] ?>" kodepos="<?php echo $value['postal_code'] ?>" tipe="<?php echo $value['type'] ?>">
		<?php echo $value['type'] ?> <?php echo $value['city_name'] ?>
	</option>
<?php endforeach ?>