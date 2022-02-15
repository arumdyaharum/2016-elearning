<?php
if(@$_SESSION['admin']) {	?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">
            Captcha page
        </h1>
    </div>
</div>
       <?php if(@$_GET['hal'] == '') { ?>
<div class="row">
    <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">tambah captcha &nbsp; <a href="?page=capta&hal=tambahcapta" class="btn btn-warning btn-sm">tambah</a></div>
                    <div class="panel-body">
		<table class="table table-striped table-bordered table-hover" id="databerita">
	                        <thead>
	                            <tr>
	                                <th>Nomor</th>
	                                <th>gambar</th>
	                                <th>Isi</th>
	                            </tr>
	                        </thead>
	                        <tbody>
							<?php
	                        $no = 1;
		                        $sql_berita = mysqli_query($conn, "SELECT * FROM t_capta") or die($db->error);
	                        
	                        if(mysqli_num_rows($sql_berita) > 0) {
	                        	while($data_berita = mysqli_fetch_array($sql_berita)) { ?>
									<tr>
										<td align="center"><?php echo $no++; ?></td>
										<td><img src="images/capta/<?php echo $data_berita['img'];?>" width="200"></td>
										<td><?php echo $data_berita['text']; ?></td>
									</tr>
								<?php
	                        	}
	                        } else {
	                        	echo '<tr><td colspan="3" align="center">Data tidak ditemukan</td></tr>';
	                        } ?>
	                        </tbody>
	                    </table>
						</div>
                </div>
    </div>
</div><?php
} else if(@$_GET['hal'] == 'tambahcapta') { ?>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Tambah Captcha &nbsp; <a href="./" class="btn btn-warning btn-sm">Kembali</a></div>
                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Gambar</label>
                                <input type="file" name="gambar[]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Isi *</label>
                                <input type="text" name="nama_lengkap" class="form-control" required />
                            </div>
                            <div class="form-group">
                              <input type="submit" name="simpan2" value="Simpan" class="btn btn-success" />
                              <input type="reset" class="btn btn-danger" value="Reset" />
                            </div>
                      </form>
                        <?php
                        if(@$_POST['simpan2']) {
                            $nama_lengkap = @mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
							$sumber = @$_FILES['gambar']['tmp_name'];
							$target_soal = 'images/capta/';
							$nama_gambar = @$_FILES['gambar']['name'];
							$type = $_FILES['gambar']['type'];
							$errror = $_FILES['gambar']['error'];
		                        $nomor_query = mysqli_query($conn, "SELECT * FROM t_capta") or die($db->error);
								$nomor = mysqli_num_rows($nomor_query) + 1;
							move_uploaded_file($sumber[0], $target_soal.$nomor.'_'.$nama_gambar[0]);
                                mysqli_query($conn, "INSERT INTO t_capta VALUES('$nomor', '".$nomor."_".$nama_gambar[0]."', '$nama_lengkap')") or die ($db->error);          
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