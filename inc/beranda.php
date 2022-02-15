<?php
$sql_siswa = mysqli_query($conn, "SELECT * FROM tb_siswa JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas WHERE id_siswa = '$_SESSION[siswa]'") or die ($db->error);
$data = mysqli_fetch_array($sql_siswa);

if(@$_GET['hal'] == '') { ?>
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">Beranda</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success">
                Hai, <?php echo $data_terlogin['nama_lengkap']; ?>. Selamat datang di Sistem Ujian Berbasis Komputer SMKN 48 Jakarta.<br />
                Silahkan pilih menu sesuai kebutuhan Anda, jika ada yang kurang jelas silahkan bertanya kepada administrator atau guru yang bersangkutan.<br /><br />
				Anda dapat melihat profil Anda dan mengubahnya dengan menekan tombol bertuliskan <i>username</i> Anda yang terdapat di pojok kanan atas.
            </div>
        </div>
    </div>
<?php
} else if(@$_GET['hal'] == 'detailprofil') { ?>
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">Detail Profil</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td>NISN</td>
                        <td>:</td>
                        <td><?php echo $data['nis']; ?></td>
                    </tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td><?php echo $data['nama_lengkap']; ?></td>
                    </tr>
                    <tr>
                        <td>Tempat Tanggal Lahir</td>
                        <td>:</td>
                        <td><?php echo $data['tempat_lahir'].", ".tgl_indo($data['tgl_lahir']); ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td><?php echo $data['jenis_kelamin']; ?></td>
                    </tr>
                    <tr>
                        <td>Nomor Telepon</td>
                        <td>:</td>
                        <td><?php echo $data['no_telp']; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?php echo $data['email']; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?php echo $data['alamat']; ?></td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td><?php echo $data['ruang'].' - '.$data['nama_kelas']; ?></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td><?php echo $data['username']; ?></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>:</td>
                        <td><?php echo $data['pass']; ?></td>
                    </tr>
					<tr><td colspan="3"><a href="?hal=editprofil" class="btn btn-info">Edit</a><td></tr>
                </table>
            </div>
        </div>
    </div>
    <?php
} else if(@$_GET['hal'] == 'editprofil') { ?>
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">Edit Profil</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            
            <form method="post" enctype="multipart/form-data">
                NISN* :
                  <input type="text" name="nis" value="<?php echo $data['nis']; ?>" class="form-control" required />
                Nama Lengkap* : <input type="text" name="nama_lengkap" value="<?php echo $data['nama_lengkap']; ?>" class="form-control" required />
                Tempat Lahir* : <input type="text" name="tempat_lahir" value="<?php echo $data['tempat_lahir']; ?>" class="form-control" required />
                Tanggal Lahir* : <input type="date" name="tgl_lahir" value="<?php echo $data['tgl_lahir']; ?>" class="form-control" required />
                Jenis Kelamin* :
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="L">Laki-laki</option>
                    <option value="P" <?php if($data['jenis_kelamin'] == 'P') { echo "selected"; } ?>>Perempuan</option>
                </select>
                Email : <input type="email" name="email" value="<?php echo $data['email']; ?>" class="form-control" />
                Nomor Telepon : <input type="text" name="no_telp" value="<?php echo $data['no_telp']; ?>" class="form-control" />
                Alamat* : <textarea name="alamat" class="form-control" rows="3" required><?php echo $data['alamat']; ?></textarea>
                Kelas* :
                <select name="kelas" class="form-control" required>
                    <option value="<?php echo $data['id_kelas']; ?>"><?php echo $data['ruang'].' - '.$data['nama_kelas']; ?></option>
                    <option value="">- Pilih -</option>
                    <?php
                    $sql_kelas = mysqli_query($conn, "SELECT * from tb_kelas") or die ($db->error);
                    while($data_kelas = mysqli_fetch_array($sql_kelas)) {
                        echo '<option value="'.$data_kelas['id_kelas'].'">'.$data_kelas['ruang'].' - '.$data_kelas['nama_kelas'].'</option>';
                    } ?>
                </select>
                Username* : <input type="text" name="user" value="<?php echo $data['username']; ?>" class="form-control" required />
                Password* : <input type="password" name="pass" class="form-control" id="myInput"  required />
                <hr /><p id="tampilkan"></p>
                <input type="checkbox" onclick="myFunction()"> Show Password
                <input type="submit" name="simpan" value="Simpan" class="btn btn-info" />
                <input type="reset" class="btn btn-danger" />
            </form>
            <?php
            if(@$_POST['simpan']) {
                $nis = @mysqli_real_escape_string($conn, $_POST['nis']);
                $nama_lengkap = @mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
                $tempat_lahir = @mysqli_real_escape_string($conn, $_POST['tempat_lahir']);
                $tgl_lahir = @mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
                $jenis_kelamin = @mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
                $agama = @mysqli_real_escape_string($conn, $_POST['agama']);
                $nama_ayah = @mysqli_real_escape_string($conn, $_POST['nama_ayah']);
                $nama_ibu = @mysqli_real_escape_string($conn, $_POST['nama_ibu']);
                $no_telp = @mysqli_real_escape_string($conn, $_POST['no_telp']);
                $email = @mysqli_real_escape_string($conn, $_POST['email']);
                $alamat = @mysqli_real_escape_string($conn, $_POST['alamat']);
                $kelas = @mysqli_real_escape_string($conn, $_POST['kelas']);
                $thn_masuk = @mysqli_real_escape_string($conn, $_POST['thn_masuk']);
                $user = @mysqli_real_escape_string($conn, $_POST['user']);
                $pass = @mysqli_real_escape_string($conn, $_POST['pass']);

                    mysqli_query($conn, "UPDATE tb_siswa SET nis = '$nis', nama_lengkap = '$nama_lengkap', tempat_lahir = '$tempat_lahir', tgl_lahir = '$tgl_lahir', jenis_kelamin = '$jenis_kelamin', agama = '$agama', nama_ayah = '$nama_ayah', nama_ibu = '$nama_ibu', no_telp = '$no_telp', email = '$email', alamat = '$alamat', id_kelas = '$kelas', thn_masuk = '$thn_masuk', username = '$user', password = md5('$pass'), pass = '$pass' WHERE id_siswa = '$_SESSION[siswa]'") or die ($db->error);         
                    echo '<script>window.location="?hal=detailprofil";</script>';
            }
            ?>
        </div>
    </div>
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
	url: "proses_pass.php",
	method: "post",
	success: function(data) {
		$("#tampilkan").html(data);
    },
    dataType: "html"
});	
</script>
<?php
} ?>