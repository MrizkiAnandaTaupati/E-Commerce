<?php
include 'class.php';
$dt_prov = $apiongkir->update_provinsi();
?>
<option value="">Pilih Provinsi</option>
<?php foreach ($dt_prov as $key => $value): ?>
	<option value="<?php echo $value['province_id'] ?>" nama="<?php echo $value['province'] ?>"><?php echo $value['province'] ?></option>
<?php endforeach ?>