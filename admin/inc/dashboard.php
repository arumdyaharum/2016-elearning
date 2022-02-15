<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">
            <?php if(@$_SESSION['admin']){echo "<a href='?page=capta' style='color:#000;'>D</a>";} else {echo "D";}?>ashboard <small>Info Utama</small>
        </h1>
    </div>
</div>
                
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success">
            </strong> Selamat datang <?php echo "<u>".$data_terlogin['nama_lengkap']."</u> di halaman "; cek_session("<b><i>administrator</i></b>", "<b><i>pengajar</i></b>"); ?>
        </div>
    </div>
</div>
<?php
if(@$_SESSION['admin']) {

    if(@$_GET['hal'] == '') { ?>
    <div class="row">
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="panel panel-primary text-center no-boder bg-color-green">
                <div class="panel-body">
                    <i class="fa fa-bar-chart-o fa-5x"></i>
                    <h3>
                        <?php
                        $sql_pengajar = mysqli_query($conn, "SELECT * FROM tb_pengajar") or die ($db->error);
                        echo mysqli_num_rows($sql_pengajar);
                        ?>
                    </h3>
                </div>
                <div class="panel-footer back-footer-green">Data Guru</div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="panel panel-primary text-center no-boder bg-color-brown">
                <div class="panel-body">
                    <i class="fa fa-users fa-5x"></i>
                    <h3>
                        <?php
                        $sql_siswa = mysqli_query($conn, "SELECT * FROM tb_siswa") or die ($db->error);
                        echo mysqli_num_rows($sql_siswa);
                        ?>
                    </h3>
                </div>
                <div class="panel-footer back-footer-brown">Data Siswa</div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12">
            <!--div class="panel panel-primary text-center no-boder bg-color-blue">
                <div class="panel-body">
                    <i class="fa fa fa-comments fa-5x"></i>
                    <h3>&nbsp;</h3>
              </div>
                <div class="panel-footer back-footer-blue"></div>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-primary text-center no-boder bg-color-red">
                <div class="panel-body">
                    <!--i class="fa fa-trash-o fa-5x"></i>
                    <!--h3>One-Action Button</h3>
                </div>
                <!--div class="panel-footer back-footer-red" style="border-top:5px solid #fff;"><a href="?del=cache" style="color:#fff;">Hapus Data <i>Autosave</i><br>(Menghapus data yang tersimpan ketika proses <i>autosave</i> seperti waktu pengerjaan dan jawaban siswa)</a></div>
                <div class="panel-footer back-footer-red" style="border-top:5px solid #fff;"><a href="?usiswa=1" style="color:#fff;">Naik Kelas dan Lulus<br>(Siswa kelas 10 menjadi kelas 11, siswa kelas 11 menjadi kelas 12, dan siswa kelas 12 akan otomatis dihapus dari E-Learning)</a></div-->
            </div>
        </div>
	</div>
    <?php
	if(@$_GET['s'] == '1'){
		echo '<script>alert("One-Action Berhasil.");</script>';
	}
	if(@$_GET['del'] == 'cache'){
		mysqli_query($conn, "DELETE FROM tb_kapan");
		mysqli_query($conn, "DELETE FROM tb_jawaban");
		echo '<script>document.location.href="?s=1";</script>';
	}
	if(@$_GET['usiswa'] == '1'){
		$query_usiswa = mysqli_query($conn, "SELECT * FROM tb_siswa JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas");
		while($usiswa = mysqli_fetch_array($query_usiswa)){
			if($usiswa['ruang'] == 'X'){
				if($usiswa['nama_kelas'] == 'AP1'){
					$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kelas WHERE ruang = 'XI' && nama_kelas = 'AP1'"));
					mysqli_query($conn, "UPDATE tb_siswa SET id_kelas = '$kelas[id_kelas]' WHERE id_siswa = '$usiswa[id_siswa]'");
				} else if($usiswa['nama_kelas'] == 'AP2'){
					$kelas = mysqli_fetch_array(mysql_query($conn, "SELECT * FROM tb_kelas WHERE ruang = 'XI' && nama_kelas = 'AP2'"));
					mysqli_query($conn, "UPDATE tb_siswa SET id_kelas = '$kelas[id_kelas]' WHERE id_siswa = '$usiswa[id_siswa]'");
				} else if($usiswa['nama_kelas'] == 'AK1'){
					$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kelas WHERE ruang = 'XI' && nama_kelas = 'AK1'"));
					mysqli_query($conn, "UPDATE tb_siswa SET id_kelas = '$kelas[id_kelas]' WHERE id_siswa = '$usiswa[id_siswa]'");
				} else if($usiswa['nama_kelas'] == 'AK2'){
					$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kelas WHERE ruang = 'XI' && nama_kelas = 'AK2'"));
					mysqli_query($conn, "UPDATE tb_siswa SET id_kelas = '$kelas[id_kelas]' WHERE id_siswa = '$usiswa[id_siswa]'");
				} else if($usiswa['nama_kelas'] == 'PM1'){
					$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kelas WHERE ruang = 'XI' && nama_kelas = 'PM1'"));
					mysqli_query($conn, "UPDATE tb_siswa SET id_kelas = '$kelas[id_kelas]' WHERE id_siswa = '$usiswa[id_siswa]'");
				} else if($usiswa['nama_kelas'] == 'PM2'){
					$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kelas WHERE ruang = 'XI' && nama_kelas = 'PM2'"));
					mysqli_query($conn, "UPDATE tb_siswa SET id_kelas = '$kelas[id_kelas]' WHERE id_siswa = '$usiswa[id_siswa]'");
				} else if($usiswa['nama_kelas'] == 'MM'){
					$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kelas WHERE ruang = 'XI' && nama_kelas = 'MM'"));
					mysqli_query($conn, "UPDATE tb_siswa SET id_kelas = '$kelas[id_kelas]' WHERE id_siswa = '$usiswa[id_siswa]'");
				} else if($usiswa['nama_kelas'] == 'TP4'){
					$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kelas WHERE ruang = 'XI' && nama_kelas = 'TP4'"));
					mysqli_query($conn, "UPDATE tb_siswa SET id_kelas = '$kelas[id_kelas]' WHERE id_siswa = '$usiswa[id_siswa]'");
				} else { echo "Kelas belum terdaftar di sistem"; }
			} else if($usiswa['ruang'] == 'XI'){
				if($usiswa['nama_kelas'] == 'AP1'){
					$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kelas WHERE ruang = 'XII' && nama_kelas = 'AP1'"));
					mysqli_query($conn, "UPDATE tb_siswa SET id_kelas = '$kelas[id_kelas]' WHERE id_siswa = '$usiswa[id_siswa]'");
				} else if($usiswa['nama_kelas'] == 'AP2'){
					$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kelas WHERE ruang = 'XII' && nama_kelas = 'AP2'"));
					mysqli_query($conn, "UPDATE tb_siswa SET id_kelas = '$kelas[id_kelas]' WHERE id_siswa = '$usiswa[id_siswa]'");
				} else if($usiswa['nama_kelas'] == 'AK1'){
					$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kelas WHERE ruang = 'XII' && nama_kelas = 'AK1'"));
					mysqli_query($conn, "UPDATE tb_siswa SET id_kelas = '$kelas[id_kelas]' WHERE id_siswa = '$usiswa[id_siswa]'");
				} else if($usiswa['nama_kelas'] == 'AK2'){
					$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kelas WHERE ruang = 'XII' && nama_kelas = 'AK2'"));
					mysqli_query($conn, "UPDATE tb_siswa SET id_kelas = '$kelas[id_kelas]' WHERE id_siswa = '$usiswa[id_siswa]'");
				} else if($usiswa['nama_kelas'] == 'PM1'){
					$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kelas WHERE ruang = 'XII' && nama_kelas = 'PM1'"));
					mysqli_query($conn, "UPDATE tb_siswa SET id_kelas = '$kelas[id_kelas]' WHERE id_siswa = '$usiswa[id_siswa]'");
				} else if($usiswa['nama_kelas'] == 'PM2'){
					$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kelas WHERE ruang = 'XII' && nama_kelas = 'PM2'"));
					mysqli_query($conn, "UPDATE tb_siswa SET id_kelas = '$kelas[id_kelas]' WHERE id_siswa = '$usiswa[id_siswa]'");
				} else if($usiswa['nama_kelas'] == 'MM'){
					$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kelas WHERE ruang = 'XII' && nama_kelas = 'MM'"));
					mysqli_query($conn, "UPDATE tb_siswa SET id_kelas = '$kelas[id_kelas]' WHERE id_siswa = '$usiswa[id_siswa]'");
				} else if($usiswa['nama_kelas'] == 'TP4'){
					$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kelas WHERE ruang = 'XII' && nama_kelas = 'TP4'"));
					mysqli_query($conn, "UPDATE tb_siswa SET id_kelas = '$kelas[id_kelas]' WHERE id_siswa = '$usiswa[id_siswa]'");
				} else { echo "Kelas belum terdaftar di sistem"; }
			} else if($usiswa['ruang'] == 'XII'){
				mysqli_query($conn, "DELETE FROM tb_siswa WHERE id_kelas = '".$usiswa['id_kelas']."'");
			} else { echo "Kelas belum terdaftar di sistem"; }
		}
		echo '<script>document.location.href="?s=1";</script>';
	}
    } else if(@$_GET['hal'] == 'editprofil') {
        $sql_admin = mysqli_query($conn, "SELECT * FROM tb_admin WHERE id_admin = '$_SESSION[admin]'") or die ($db->error);
        $data = mysqli_fetch_array($sql_admin);
        ?>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Profil &nbsp; <a href="./" class="btn btn-warning btn-sm">Kembali</a></div>
                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Nama Lengkap *</label>
                                <input type="text" name="nama_lengkap" value="<?php echo $data['nama_lengkap']; ?>" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>Alamat *</label>
                                <textarea name="alamat" class="form-control" rows="3" required><?php echo $data['alamat']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Nomor Telepon *</label>
                                <input type="text" name="no_telp" value="<?php echo $data['no_telp']; ?>" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" value="<?php echo $data['email']; ?>" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Username *</label>
                                <input type="text" name="username2" value="<?php echo $data['username']; ?>" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>Password *</label>
                                <input type="password" name="myInput" class="form-control" id="myInput" value="<?php echo $data['pass']; ?>" required />
                                <input type="checkbox" onclick="myFunction()" />                             
                             Show Password                            </div>
                            <div class="form-group">
                                <input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
                                <input type="reset" class="btn btn-danger" value="Reset" />
                            </div>
                        </form>
                        <?php
                        if(@$_POST['simpan']) {
                            $nama_lengkap = @mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
                            $alamat = @mysqli_real_escape_string($conn, $_POST['alamat']);
                            $no_telp = @mysqli_real_escape_string($conn, $_POST['no_telp']);
                            $email = @mysqli_real_escape_string($conn, $_POST['email']);
                            $username = @mysqli_real_escape_string($conn, $_POST['username']);
                            $password = @mysqli_real_escape_string($conn, $_POST['password']);
                            
	
                            mysqli_query($conn, "UPDATE tb_admin SET nama_lengkap = '$nama_lengkap', alamat = '$alamat', no_telp = '$no_telp', email = '$email', username = '$username', password = md5('$password'), pass = '$password', img = '".$nama_gambar[0]."' WHERE id_admin = '$_SESSION[admin]'") or die ($db->error);          
                            echo '<script>window.location="./";</script>';
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }

} else if(@$_SESSION['pengajar']) {

    $sql_pengajar = mysqli_query($conn, "SELECT * FROM tb_pengajar WHERE id_pengajar = '$_SESSION[pengajar]'") or die ($db->error);
    $data = mysqli_fetch_array($sql_pengajar);
    
    if(@$_GET['hal'] == '') { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Detail Profil Anda &nbsp; <a href="?hal=editprofil" class="btn btn-warning btn-sm">Edit Profil</a></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table width="100%">
                                <tr><td align="center" colspan="3">
			<img src="<?php echo "img/profil/".$data["img"];?>" width="150"></td>
                                </tr>
								<tr>
                                    <td align="right" width="46%"><b>NIP/NIKKI</b></td>
                                    <td align="center">:</td>
                                    <td width="46%"><?php echo $data['nip']; ?></td>
                                </tr>
                                <tr>
                                    <td align="right"><b>Nama Lengkap</b></td>
                                    <td align="center">:</td>
                                    <td><?php echo $data['nama_lengkap']; ?></td>
                                </tr>
                                <tr>
                                    <td align="right"><b>Jenis Kelamin</b></td>
                                    <td align="center">:</td>
                                    <td><?php if($data['jenis_kelamin'] == 'L') { echo "Laki-laki"; } else { echo "Perempuan"; } ?></td>
                                </tr>
                                <tr>
                                    <td align="right"><b>Username</b></td>
                                    <td align="center">:</td>
                                    <td><?php echo $data['username']; ?></td>
                                </tr>
                                <tr>
                                    <td align="right"><b>Password</b></td>
                                    <td align="center">:</td>
                                    <td><?php echo $data['pass']; ?></td>
                                </tr>
                            </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else if(@$_GET['hal'] == 'editprofil') { ?>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Profil &nbsp; <a href="./" class="btn btn-warning btn-sm">Kembali</a></div>
                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>NIP/NIKKI *</label>
                                <input type="text" name="nip" value="<?php echo $data['nip']; ?>" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap *</label>
                                <input type="text" name="nama_lengkap" value="<?php echo $data['nama_lengkap']; ?>" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin *</label>
                                <select name="jenis_kelamin" class="form-control" required>
                                  <option value="L">Laki-laki</option>
                                  <option value="P" <?php if($data['jenis_kelamin'] == 'P') { echo "selected"; } ?>>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Username *</label>
                                <input type="text" name="username" value="<?php echo $data['username']; ?>" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>Password *</label>
                                <input type="password" name="pass" value="<?php echo $data['pass']; ?>" class="form-control" id="myInput"  required /> <p id="tampilkan"></p>
                            </div>
                            <input type="checkbox" onclick="myFunction()"> 
                            Show Password
							
                            <div class="form-group">
                                <label>Foto Profil</label>
                                <input type="file" name="gambar[]" class="form-control" />
                            </div>
                            <div class="form-group">
                              <input type="submit" name="simpan2" value="Simpan" class="btn btn-success" />
                              <input type="reset" class="btn btn-danger" value="Reset" />
                            </div>
                      </form>
                        <?php
                        if(@$_POST['simpan2']) {
                            $nip = @mysqli_real_escape_string($conn, $_POST['nip']);
                            $nama_lengkap = @mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
                            $jenis_kelamin = @mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
                            $username = @mysqli_real_escape_string($conn, $_POST['username']);
                            $password = @mysqli_real_escape_string($conn, $_POST['pass']);
							
							$sumber = @$_FILES['gambar']['tmp_name'];
							$target_soal = 'img/profil/';
							$nama_gambar = @$_FILES['gambar']['name'];
							$type = $_FILES['gambar']['type'];
							$errror = $_FILES['gambar']['error'];
							
							move_uploaded_file($sumber[0], $target_soal.'pengajar'.$_SESSION['pengajar'].'_'.$nama_gambar[0]);
                                mysqli_query($conn, "UPDATE tb_pengajar SET nip = '$nip', nama_lengkap = '$nama_lengkap', jenis_kelamin = '$jenis_kelamin', username = '$username', password = md5('$password'), pass = '$password', img = 'pengajar".$_SESSION["pengajar"]."_".$nama_gambar[0]."' WHERE id_pengajar = '$_SESSION[pengajar]'") or die ($db->error);          
                                echo '<script>window.location="./";</script>';
								///echo $target_soal.'pangajar'.$_SESSION['pengajar'].'_'.$nama_gambar[0];
								///echo $sumber[0];
                        }
						?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
} ?>
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
$("input[name=pass]").autosave({
	url: "../proses_pass.php",
	method: "post",
	success: function(data) {
		$("#tampilkan").html(data);
    },
    dataType: "html"
});	
</script>