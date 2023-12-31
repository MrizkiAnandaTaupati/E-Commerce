</div>
<footer style="background: ;" class="p-3 mt-5 bg-success">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-6">
        <p class="text-white mt-3 fw-bold">
          &copy; Rindang 84 Juwana 2023
        </p>
      </div>
</footer>
<script type="text/javascript" src="assets/js/bootstrap.bundle.js"></script>
</body>
</html>
<?php 
if (isset($_POST["masuk"])) 
{
	//mendapatkan data inputan dari formulir
	$username = $_POST["username_login"];
	$password = sha1($_POST["password_login"]);

	//mendapatkan data username dan password admin dari database
	$ambil_admin = $koneksi -> query("SELECT * FROM admin WHERE username_admin = '$username' AND password_admin = '$password'");

	//memeriksa jumlah data yang di input di formulir dengan data yang ada di database
	$hitung_admin = $ambil_admin->num_rows;

	//jika $hitung_admin nilainya sama dengan 1 maka lanjut login
	if ($hitung_admin==1) 
	{
		//Data login
		$login = $ambil_admin -> fetch_assoc();

		//menyimpan data login ke dalam sebuah session
		$_SESSION["admin"] = $login;

		echo "<script>alert('Login berhasil,selamat datang!')</script>";
		echo "<script>location = 'admin/index.php'</script>";
	}

	else
	{
		$ambil_pelanggan = $koneksi ->query("SELECT * FROM pelanggan WHERE username_pelanggan = '$username' AND password_pelanggan = '$password'");

		$hitung_pelanggan = $ambil_pelanggan->num_rows;

		if ($hitung_pelanggan==1) 
		{
			$login_p = $ambil_pelanggan -> fetch_assoc();

			$_SESSION["pelanggan"] = $login_p;

			echo "<script>alert('Login berhasil,selamat datang!')</script>";
			echo "<script>location = 'pelanggan/index.php'</script>";
		}

		else
		{
			echo "<script>alert('Username atau password salah!')</script>";
			echo "<script>location = 'index.php'</script>";
		}
	}

}
?>