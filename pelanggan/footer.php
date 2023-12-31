</div>
<footer style="background: ;" class="p-3 mt-5 bg-success">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-6">
        <p class="text-white mt-3 fw-bold">
          &copy; Rindang 84 Juwana 2023
        </p>
      </div>
      <div class="col-md-6 col-6 text-end mt-3">

        <a href="https://wa.me/089665016487" class="text-decoration-none text-white">
          <span class="mx-3 bi bi-whatsapp" style="font-size: 20px;"></span>
        </a>
        <a href="https://instagram.com/rindang84official/" class="text-decoration-none text-white">
          <span class="mx-3 bi bi-instagram" style="font-size: 20px;"></span>
        </a>
        <a href="https://facebook.com/rindangkantor" class="text-decoration-none text-white">
          <span class="mx-3 bi bi-facebook" style="font-size: 20px;"></span>
        </a>
        <a href="https://maps.app.goo.gl/K2yG3TTHRvB2LLhi6" class="text-decoration-none text-white">
          <span class="mx-3 bi bi-geo-alt-fill" style="font-size: 20px;"></span>
        </a>
      </div>
    </div>
  </div>
</footer>
</div>
<script type="text/javascript" src="../assets/js/bootstrap.bundle.js"></script>
<script src="../assets/js/jquery-3.5.1.js"></script>
<script>
    $(document).ready(function(){
      $.ajax({
        url : 'dataprovinsi.php',
        success:function(hasil){
          $("select[name=provinsi]").html(hasil);
        }
      })
    });

    $(document).ready(function(){
      $("select[name=provinsi]").on("change", function(){
        // Mengambil id_provinsi yg dipilih
        var id_provinsi = $(this).val();
        // Mengambil nama_provinsi yg dipilih
        var nama_provinsi = $("option:selected", this).attr("nama");
        // // Lalu taruh nama yg diambil di kotak inputan
        $("input[name=nama_provinsi]").val(nama_provinsi);
        $.ajax({
          url : 'datakota.php',
          type : 'POST',
          data : "provinsi="+id_provinsi,
          success:function(hasil){
            $("select[name=kota]").html(hasil);
          }
        });

        // Jika provinsi diubah setelah data diisi maka semua data harus hilang.
        // Karena itu hilangkan option dr select kota, ekspedisi, dan ongkir
        // Hilangkan juga data dr inputan
        // Gunakan val kosong
        $("select[name=ekspedisi]").val(null);
        $("select[name=ongkir]").val(null);

        $("input[name=nama_kota]").val(null);
        $("input[name=tipe]").val(null);
        $("input[name=kodepos]").val(null);
        $("input[name=nama_ekspedisi]").val(null);
        $("input[name=nama_paket]").val(null);
        $("input[name=biaya_paket]").val(null);
        $("input[name=lama_paket]").val(null);
        $("input[name=total_bayar]").val(null);
      })
    });

    $(document).ready(function(){
      $("select[name=kota]").on("change", function(){
        var id_kota = $(this).val();
        // Saat mengambil data dari option diberi this agar jelas option mana yg diambil
        var nama = $("option:selected", this).attr("nama");
        var kodepos = $("option:selected", this).attr("kodepos");
        var tipe = $("option:selected", this).attr("tipe");
        $("input[name=nama_kota]").val(nama);
        $("input[name=kodepos]").val(kodepos);
        $("input[name=tipe]").val(tipe);
      })
    });

    $(document).ready(function(){
      $.ajax({
        url : 'dataekspedisi.php',
        success:function(hasil){
          $("select[name=ekspedisi]").html(hasil);
        }
      })
    });

    $(document).ready(function(){
      $("select[name=ekspedisi]").on("change", function(){
        var nama = $("option:selected", this).attr("nama");
        $("input[name=nama_ekspedisi]").val(nama);
      })
    });

    $(document).ready(function(){
      $("select[name=ekspedisi]").on("change", function(){
        // Mendapatkan data kota tujuan, berat, dan ekspedisi
        var id_kota = $("select[name=kota]").val();
        var total_berat = $("input[name=total_berat]").val();
        var ekspedisi = $("select[name=ekspedisi]").val();
        $.ajax({
          url : 'dataongkir.php',
          type : 'POST',
          data : 'id_kota='+id_kota+'&total_berat='+total_berat+'&ekspedisi='+ekspedisi,
          success:function(hasil){            
            $("select[name=ongkir]").html(hasil);
          }
        })
      })
    });

    $(document).ready(function(){
      $("select[name=ongkir]").on("change", function(){
        var nama = $("option:selected", this).attr("nama");
        var biaya = $("option:selected", this).attr("biaya");
        var lama = $("option:selected", this).attr("lama");

        // Masukkan data ke dalam input
        $("input[name=nama_paket]").val(nama);
        $("input[name=biaya_paket]").val(biaya);
        $("input[name=lama_paket]").val(lama);

        // Menaruh biaya di th yg idnya total_ongkir
        $("#total_ongkir").html("Rp. "+biaya);

        // Total belanjja ditambah biaya paket
        var total_belanja = $("input[name=total_belanja]").val();
        var biaya_paket = $("input[name=biaya_paket]").val();

        var total_bayar = parseInt(total_belanja) + parseInt(biaya_paket);

        $("#total_bayar").html("Rp. "+total_bayar);

        // Manruh total bayar di input
        $("input[name=total_bayar]").val(total_bayar);
      })
    })
  </script>
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