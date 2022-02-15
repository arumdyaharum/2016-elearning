<?php
if(@$_SESSION['admin']) { ?>

<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Manajemen Guru</h1>
    </div>
</div>

<div class="row">
	<?php
	$id = @$_GET['id'];
	$sql_per_id = mysqli_query($conn, "SELECT * FROM tb_pengajar WHERE id_pengajar = '$id'") or die ($db->error);
	$data = mysqli_fetch_array($sql_per_id);

	if(@$_GET['action'] == '') { ?>

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><a href="?page=pengajar&action=tambah" class="btn btn-primary btn-sm">Tambah Guru</a> <a href="./laporan/cetak.php?data=pengajar&filename=elearning_guru_<?php //echo date("dmY");?>.pdf" target="_blank" class="btn btn-default btn-sm">Cetak Data Guru</a></div>
      <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="datapengajar">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>NIP/NIKKI</th>
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat Pengajar</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        $sql_pengajar = mysqli_query($conn, "SELECT * FROM tb_pengajar") or die ($db->error);
                        if(mysqli_num_rows($sql_pengajar) > 0) {
	                        while($data_pengajar = mysqli_fetch_array($sql_pengajar)) {
	                        ?>
	                            <tr>
	                                <td><?php echo $no++; ?></td>
	                                <td><?php echo $data_pengajar['nip']; ?></td>
	                                <td><?php echo $data_pengajar['nama_lengkap']; ?></td>
	                                <td><?php echo $data_pengajar['jenis_kelamin']; ?></td>
                                    <td><?php echo $data_pengajar['alamat']; ?></td>
	                                <td><?php echo ucfirst($data_pengajar['status']); ?></td>
	                                <td align="center" width="170px">
	                                    <a href="?page=pengajar&action=edit&id=<?php echo $data_pengajar['id_pengajar']; ?>" class="badge" style="background-color:#f60;">Edit</a>
	                                    <a onclick="return confirm('Yakin akan menghapus data?');" href="?page=pengajar&action=hapus&id=<?php echo $data_pengajar['id_pengajar']; ?>" class="badge" style="background-color:#f00;">Hapus</a>
	                                    <a href="?page=pengajar&action=detail&id=<?php echo $data_pengajar['id_pengajar']; ?>" class="badge">Detail</a>
	                                </td>
	                            </tr>
	                        <?php
		                    }
		                } else {
		                	?>
							<tr>
                                <td colspan="6" align="center">Data tidak ditemukan</td>
							</tr>
		                	<?php
		                }
	                    ?>
                        </tbody>
                    </table>
                    <script>
                    $(document).ready(function () {
                        $('#datapengajar').dataTable();
                    });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <?php
	} else if(@$_GET['action'] == 'detail') {
		?>
		<div class="col-md-12">
	        <div class="panel panel-default">
	            <div class="panel-heading">Detail Data Pengajar &nbsp; <a href="?page=pengajar" class="btn btn-warning btn-sm">Kembali</a></div>
	            <div class="panel-body">
	            	<div class="table-responsive">
                        <table width="100%">
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
                            <td align="right"><b>Alamat Pengajar</b></td>
                        		<td align="center">:</td>
                        		<td><?php echo $data['alamat']; ?></td>
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
                        	<tr>
                        		<td align="right"><b>Status</b></td>
                        		<td align="center">:</td>
                        		<td><?php echo ucfirst($data['status']); ?></td>
                        	</tr>
                        </table>
                  </div>
	            </div>
		    </div>
		</div>
		<?php
	} else if(@$_GET['action'] == 'tambah') {
		?>
		<div class="col-md-6">
	        <div class="panel panel-default">
	            <div class="panel-heading">Tambah Data Guru &nbsp; <a href="?page=pengajar" class="btn btn-warning btn-sm">Kembali</a></div>
	            <div class="panel-body">
					<form method="post" action="?page=pengajar&action=prosestambah" enctype="multipart/form-data">
      					<div class="form-group">
                            <label>NIP/NIKKI *</label>
                            <input type="text" name="nip" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap *</label>
                            <input type="text" name="nama_lengkap" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin *</label>
                            <select name="jenis_kelamin" class="form-control" required>
								<option value="">- Pilih -</option>
								<option value="L">Laki-laki</option>
								<option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Alamat Pengajar*</label>
                            <input type="text" name="alamat" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Username *</label>
                            <input type="text" name="username" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Password *</label>
                            <input type="password" name="pass" class="form-control" id="myInput"  required /><p id="tampilkan"></p>
                          <input type="checkbox" onclick="myFunction()" /> Show Password
                      </div>
                        <div class="form-group">
                            <label>Status Akun</label>
                            <select name="status" class="form-control">
								<option value="aktif">Aktif</option>
								<option value="tidak aktif">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="form-group">
	                        <button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
	                        <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Reset</button>
                        </div>
                    </form>
	            </div>
		    </div>
		</div>
		<?php
	} else if(@$_GET['action'] == 'prosestambah') {
		$nip = @mysqli_real_escape_string($conn, $_POST['nip']);
		$nama_lengkap = @mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
		//$tempat_lahir = @mysql_real_escape_string($_POST['tempat_lahir']);////////
		//$tgl_lahir = @mysql_real_escape_string($_POST['tgl_lahir']);/////^^///
		$jenis_kelamin = @mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
		//$agama = @mysql_real_escape_string($_POST['agama']);////////////
		//$no_telp = @mysql_real_escape_string($_POST['no_telp']);//////
		//$email = @mysql_real_escape_string($_POST['email']);//////////
		$alamat = @mysqli_real_escape_string($conn, $_POST['alamat']);
		//$jabatan = @mysql_real_escape_string($_POST['jabatan']);/////////
		$username = @mysqli_real_escape_string($conn, $_POST['username']);
		$password = @mysqli_real_escape_string($conn, $_POST['pass']);
		$status = @mysqli_real_escape_string($conn, $_POST['status']);

			//mysql_query("INSERT INTO tb_pengajar VALUES('', '$nip', '$nama_lengkap', '$tempat_lahir', '$tgl_lahir', '$jenis_kelamin', '$agama', '$no_telp', '$email', '$alamat', '$jabatan', '$username', md5('$password'), '$password', '$status')") or die ($db->error);
			mysqli_query($conn, "INSERT INTO tb_pengajar(id_pengajar, nip, nama_lengkap, jenis_kelamin, alamat, username, password, pass, status) VALUES ('', '$nip', '$nama_lengkap', '$jenis_kelamin', '$alamat', '$username', md5('$password'), '$password', '$status')") or die ($db->error);
			echo '<script>window.location="?page=pengajar";</script>';
	} else if(@$_GET['action'] == 'edit') {
		?>
		<div class="col-md-6">
	        <div class="panel panel-default">
	            <div class="panel-heading">Edit Data Pengajar &nbsp; <a href="?page=pengajar" class="btn btn-warning btn-sm">Kembali</a></div>
	            <div class="panel-body">
					<form method="post" action="?page=pengajar&action=prosesedit&id=<?php echo $data['id_pengajar']; ?>" enctype="multipart/form-data">
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
                            <label>Alamat Pengajar*</label>
                            <input type="text" name="alamat" value="<?php echo $data['alamat']; ?>" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label></label>
                        </div>
                        <div class="form-group">
                            <label>Username *</label>
                            <input type="text" name="username2" value="<?php echo $data['username']; ?>" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Password *</label>
                            <input type="text" name="password" value="<?php echo $data['pass']; ?>" class="form-control" id="myInput" required />
                            <input type="checkbox" onclick="myFunction()" /> Show Password
                      </div>
                        <div class="form-group">
                            <label>Status Akun</label>
                            <select name="status" class="form-control">
								<option value="aktif">Aktif</option>
								<option value="tidak aktif" <?php if($data['status'] == 'tidak aktif') { echo "selected"; } ?>>Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="form-group">
	                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
	                        <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Reset</button>
                        </div>
                    </form>
	            </div>
		    </div>
		</div>
		<?php
	} else if(@$_GET['action'] == 'prosesedit') {
		$nip = @mysqli_real_escape_string($conn, $_POST['nip']);
		$nama_lengkap = @mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
		$tempat_lahir = @mysqli_real_escape_string($conn, $_POST['tempat_lahir']);
		$tgl_lahir = @mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
		$jenis_kelamin = @mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
		$agama = @mysqli_real_escape_string($conn, $_POST['agama']);
		$no_telp = @mysqli_real_escape_string($conn, $_POST['no_telp']);
		$email = @mysqli_real_escape_string($conn, $_POST['email']);
		$alamat = @mysqli_real_escape_string($conn, $_POST['alamat']);
		$jabatan = @mysqli_real_escape_string($conn, $_POST['jabatan']);
		$username = @mysqli_real_escape_string($conn, $_POST['username2']);
		$password = @mysqli_real_escape_string($conn, $_POST['password']);
		$status = @mysqli_real_escape_string($conn, $_POST['status']);

			mysqli_query($conn, "UPDATE tb_pengajar SET nip = '$nip', nama_lengkap = '$nama_lengkap', tempat_lahir = '$tempat_lahir', tgl_lahir = '$tgl_lahir', jenis_kelamin = '$jenis_kelamin', agama = '$agama', no_telp = '$no_telp', email = '$email', alamat = '$alamat', jabatan = '$jabatan', username = '$username', password = md5('$password'), pass = '$password', status = '$status' WHERE id_pengajar = '$id'") or die ($db->error);			
			echo '<script>window.location="?page=pengajar";</script>';
	} else if(@$_GET['action'] == 'hapus') {
		mysqli_query($conn, "DELETE FROM tb_pengajar WHERE id_pengajar = '$id'") or die ($db->error);
		echo '<script>window.location="?page=pengajar";</script>';
	}
	?>
</div>

<?php
} else { ?>
	<div class="row">
	    <div class="col-xs-12">
	        <div class="alert alert-danger">Maaf Anda tidak punya hak akses masuk halaman ini!</div>
	    </div>
	</div>
	<?php
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