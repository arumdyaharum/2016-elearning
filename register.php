<?php
@session_start();
$db = mysql_connect("localhost", "root", "");
$db_connet = mysql_select_db("skripsi");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>E-Learning SMKN 48 Jakarta</title>
    <link href="style/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="style/assets/css/font-awesome.css" rel="stylesheet" />
    <link href="style/assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    Anda sudah punya akun ? Silahkan <a href="./" class="btn btn-xs btn-danger">Login</a>
                </div>
            </div>
        </div>
    </header>
    <!-- HEADER END-->
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">
                    <img src="style/assets/img/logo.png" />
                </a>

            </div>

            <div class="left-div">
                <div class="user-settings-wrapper">
                    <ul class="nav">
                        <li class="dropdown">
                            <!--a class="dropdown-toggle">
                                <span class="glyphicon glyphicon-user" style="font-size: 25px;"></span>
                            </a-->
                        </li>
                    </ul>
                </div>
            </div>
            <br>
        </div>
    </div>

    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a <?php if(@$_GET['page'] == '') { echo 'class="menu-top-active"'; } ?> href="?hal=daftar">Register</a></li>
                            <li><a <?php if(@$_GET['page'] == 'berita') { echo 'class="menu-top-active"'; } ?> href="?hal=daftar&page=berita">Berita</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="content-wrapper">
        <div class="container">
            <?php
            if(@$_GET['page'] == '') { ?>
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="page-head-line">Halaman pendaftaran akun SISWA</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h4><i>Masukkan data Anda dengan benar !</i></h4>
                        <form method="post" enctype="multipart/form-data">
                            NISN* :
                              <input type="text" name="nis" class="form-control" required />
                            Nama Lengkap* : <input type="text" name="nama_lengkap" class="form-control" required />
                            Tempat Lahir* : <input type="text" name="tempat_lahir" class="form-control" required />
                            Tanggal Lahir* : <input type="date" name="tgl_lahir" class="form-control" required />
                            Jenis Kelamin* :
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="">- Pilih -</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            
                            Email* : <input type="email" name="email" class="form-control" required />
                            Nomor Telepon : 
                      <input type="text" name="no_telp" class="form-control" />
                            Alamat* : <textarea name="alamat" class="form-control" rows="1" required></textarea>
                            Kelas* :
                            <select name="kelas" class="form-control" required>
                                <option value="">- Pilih -</option>
                                <?php
                                $sql_kelas = mysql_query("SELECT * from tb_kelas") or die ($db->error);
                                while($data_kelas = mysql_fetch_array($sql_kelas)) {
                                    echo '<option value="'.$data_kelas['id_kelas'].'">'.$data_kelas['ruang']," - ",$data_kelas['nama_kelas'].'</option>';
                                } ?>
                            </select>
                            
                            Username* : 
                        <input type="text" name="user" class="form-control" required />
                            Password* : <input type="password" name="pass" class="form-control" id="myInput" required /><p id="tampilkan"></p>
                            <input type="checkbox" onClick="myFunction()"> Show Password
                            <br />
							<?php 
							$query_capta = mysql_query("select * from t_capta order by rand()") or die ($db->error);
							$capta = mysql_fetch_array($query_capta);
							?>
							<h4>Captcha</h4>
							<img src="admin/images/capta/<?php echo $capta['img']?>" width="200"><br>
                            Masukkan tulisan yang ada di gambar atas : 
                        <input type="text" name="capta" class="form-control" required />
                            <hr />
                            <input type="submit" name="daftar" value="Daftar" class="btn btn-info" />
                            <input type="reset" class="btn btn-danger" />
                        </form>
                        <?php
                        if(@$_POST['daftar']) {
							$input_capta = @mysql_real_escape_string($_POST['capta']);
							if($input_capta == $capta['text']){
                            $nis = @mysql_real_escape_string($_POST['nis']);
                            $nama_lengkap = @mysql_real_escape_string($_POST['nama_lengkap']);
                            $tempat_lahir = @mysql_real_escape_string($_POST['tempat_lahir']);
                            $tgl_lahir = @mysql_real_escape_string($_POST['tgl_lahir']);
                            $jenis_kelamin = @mysql_real_escape_string($_POST['jenis_kelamin']);
                            $agama = @mysql_real_escape_string($_POST['agama']);
                            $nama_ayah = @mysql_real_escape_string($_POST['nama_ayah']);
                            $nama_ibu = @mysql_real_escape_string($_POST['nama_ibu']);
                            $no_telp = @mysql_real_escape_string($_POST['no_telp']);
                            $email = @mysql_real_escape_string($_POST['email']);
                            $alamat = @mysql_real_escape_string($_POST['alamat']);
                            $kelas = @mysql_real_escape_string($_POST['kelas']);
                            $thn_masuk = @mysql_real_escape_string($_POST['thn_masuk']);
                            $user = @mysql_real_escape_string($_POST['user']);
                            $pass = @mysql_real_escape_string($_POST['pass']);

                            $sql_cek_user = mysql_query("SELECT * FROM tb_siswa WHERE username = '$user'") or die ($db->error);
                            if(mysql_num_rows($sql_cek_user) > 0) {
                                echo "<script>alert('Username yang Anda pilih sudah ada, silahkan ganti yang lain');</script>";
                            } else {
                                    mysql_query("INSERT INTO tb_siswa VALUES('', '$nis', '$nama_lengkap', '$tempat_lahir', '$tgl_lahir', '$jenis_kelamin', '$agama', '$nama_ayah', '$nama_ibu', '$no_telp', '$email', '$alamat', '$kelas', '$thn_masuk', '$user', md5('$pass'), '$pass', 'tidak aktif')") or die ($db->error);          
                                    echo '<script>alert("Pendaftaran berhasil, tunggu akun aktif dan silahkan login"); window.location="./"</script>';
                            }
							} else {echo "<script>alert('Captcha salah');</script>";}
                        }
                        ?>
                    </div>
                    <br>
                    <div class="col-md-6">
                        <div class="alert alert-warning">
                            Untuk menggunakan aplikasi ujian berbasis komputer ini,siswa harus memiliki akun terlebih dahulu, silahkan registrasi dahulu</div>
                    </div>
                </div>
            <?php
            } else if(@$_GET['page'] == 'berita') {
                include ("inc/berita.php");
            } ?>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                &copy; 2021 Ujian Berbasis Komputer SMKN 48 Jakarta</div>

          </div>
        </div>
    </footer>
    <script src="style/assets/js/bootstrap.js"></script>
    <script src="style/assets/js/jquery-1.11.1.js"></script>
	<script src="style/assets/js/jquery.autoSave.min.js"></script>
    <script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

/**function password(isi){
	if(isi.length >= 8){
		document.getElementById("tampilkan").html("kuat").show();
	} else if(isi.length >= 4){
		document.getElementById("tampilkan").html("sedang").show();
	} else { document.getElementById("tampilkan").html("lemah").show();
	}
}**/
$("input[name=pass]").autosave({
	url: "proses_pass.php",
	method: "post",
	success: function(data) {
		$("#tampilkan").html(data);
    },
    dataType: "html"
});	
</script>
</body>
</html>