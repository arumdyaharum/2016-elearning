<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Manajemen Mata Pelajaran</h1>
    </div>
</div>

<?php
$id = @$_GET['id'];
$no = 1;

if(@$_SESSION[admin]) {

    echo '<div class="row">';
    if(@$_GET['action'] == '') { ?>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="?page=mapel&action=tambah" class="btn btn-primary btn-sm">Tambah Mata Pelajaran</a> &nbsp; <a href="./laporan/cetak.php?data=mapel&filename=elearning_mapel_<?php echo date("dmY");?>" target="_blank" class="btn btn-default btn-sm">Cetak</a></div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Kode Mata Pelajaran</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_mapel = mysqli_query($conn, "SELECT * FROM tb_mapel ORDER BY mapel") or die ($db->error);
                            if(mysqli_num_rows($sql_mapel) > 0) {
	                            while($data_mapel = mysqli_fetch_array($sql_mapel)) { ?>
	                                <tr>
	                                    <td><?php echo $no++; ?></td>
	                                    <td><?php echo $data_mapel['kode_mapel']; ?></td>
	                                    <td><?php echo $data_mapel['mapel']; ?></td>
	                                    <td align="center" width="150px">
	                                        <a href="?page=mapel&action=edit&id=<?php echo $data_mapel['id']; ?>" class="badge" style="background-color:#f60;">Edit</a>
	                                        <a onclick="return confirm('Yakin akan menghapus data?');" href="?page=mapel&action=hapus&id=<?php echo $data_mapel['id']; ?>" class="badge" style="background-color:#f00;">Hapus</a>
	                                    </td>
	                                </tr>
	                            <?php
	                            }
                            } else {
                            	echo '<td colspan="4" align="center">Tidak ada data</td>';
                        	} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else if(@$_GET['action'] == 'tambah') { ?>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Tambah Data Mata Pelajaran &nbsp; <a href="?page=mapel" class="btn btn-warning btn-sm">Kembali</a></div>
                <div class="panel-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Kode Mata Pelajaran*</label>
                            <input type="text" name="kode_mapel" class="form-control" placeholder="Ex: A1" required />
                        </div>
                        <div class="form-group">
                            <label>Mata Pelajaran*</label>
                            <input type="text" name="mapel" class="form-control" placeholder="Ex: Bahasa Indonesia" required />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
                            <input type="reset" value="Reset" class="btn btn-danger" />
                        </div>
                    </form>
                    <?php
                    if(@$_POST['simpan']) {
                        $kode_mapel = @mysqli_real_escape_string($conn, $_POST['kode_mapel']);
                        $mapel = @mysqli_real_escape_string($conn, $_POST['mapel']);
                        mysqli_query($conn, "INSERT INTO tb_mapel VALUES('', '$kode_mapel', '$mapel')") or die ($db->error);
                        echo "<script>window.location='?page=mapel';</script>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    } else if(@$_GET['action'] == 'edit') { ?>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Data Mata Pelajaran &nbsp; <a href="?page=mapel" class="btn btn-warning btn-sm">Kembali</a></div>
                <div class="panel-body">
                    <form method="post">
                    	<?php
                    	$sql_mapel_id = mysqli_query($conn, "SELECT * FROM tb_mapel WHERE id = '$id'") or die ($db->error);
                    	$data_mapel_id = mysqli_fetch_array($sql_mapel_id);
                    	?>
                        <div class="form-group">
                            <label>Kode Mata Pelajaran*</label>
                            <input type="text" name="kode_mapel" value="<?php echo $data_mapel_id['kode_mapel']; ?>" class="form-control" placeholder="Ex: A1" required />
                        </div>
                        <div class="form-group">
                            <label>Mata Pelajaran*</label>
                            <input type="text" name="mapel" value="<?php echo $data_mapel_id['mapel']; ?>" class="form-control" placeholder="Ex: Bahasa Indonesia" required />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
                            <input type="reset" value="Reset" class="btn btn-danger" />
                        </div>
                    </form>
                    <?php
                    if(@$_POST['simpan']) {
                        $kode_mapel = @mysqli_real_escape_string($conn, $_POST['kode_mapel']);
                        $mapel = @mysqli_real_escape_string($conn, $_POST['mapel']);
                        mysqli_query($conn, "UPDATE tb_mapel SET kode_mapel = '$kode_mapel', mapel = '$mapel' WHERE id = '$id'") or die ($db->error);
                        echo "<script>window.location='?page=mapel';</script>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    } else if(@$_GET['action'] == 'hapus') {
        mysqli_query($conn, "DELETE FROM tb_mapel WHERE id = '$id'") or die ($db->error);  
        echo "<script>window.location='?page=mapel';</script>"; 
    }
    echo "</div>";

} else if(@$_SESSION[pengajar]) {

	echo '<div class="row">';
    if(@$_GET['action'] == '') { ?>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Mata Pelajaran yang Anda Ajar &nbsp; <a href="?page=mapel&action=tambah" class="btn btn-primary btn-sm">Tambah Mata Kuliah</a></div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Mata Pelajaran</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Semester</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_mapel_ajar = mysqli_query($conn, "SELECT * FROM tb_mapel_ajar JOIN tb_mapel ON tb_mapel_ajar.id_mapel = tb_mapel.id WHERE tb_mapel_ajar.id_pengajar = '$_SESSION[pengajar]'") or die ($db->error);
                            if(mysqli_num_rows($sql_mapel_ajar) > 0) {
	                            while($data_mapel_ajar = mysqli_fetch_array($sql_mapel_ajar)) { ?>
	                                <tr>
	                                    <td><?php echo $no++; ?></td>
	                                    <td><?php echo $data_mapel_ajar['kode_mapel']; ?></td>
	                                    <td><?php echo $data_mapel_ajar['mapel']; ?></td>
	                                    <td><?php echo $data_mapel_ajar['keterangan']; ?></td>
	                                    <td align="center" width="150px">
	                                        <a href="?page=mapel&action=edit&id=<?php echo $data_mapel_ajar[0]; ?>" class="badge" style="background-color:#f60;">Edit</a>
	                                        <a onclick="return confirm('Yakin akan menghapus data?');" href="?page=mapel&action=hapus&id=<?php echo $data_mapel_ajar[0]; ?>" class="badge" style="background-color:#f00;">Hapus</a>
                                        </td>
	                                </tr>
	                            <?php
	                            }
                            } else {
                            	echo '<td colspan="6" align="center">Tidak ada data</td>';
                        	} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else if(@$_GET['action'] == 'tambah') { ?>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Tambah Mata Pelajaran yang Anda Ajar &nbsp; <a href="?page=mapel" class="btn btn-warning btn-sm">Kembali</a></div>
                <div class="panel-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Mata Pelajaran *</label>
                            <select name="mapel" class="form-control" required>
                            	<option value="">- Pilih -</option>
                            	<?php
                            	$sql_mapel = mysqli_query($conn, "SELECT * FROM tb_mapel") or die ($db->error);
                            	while($data_mapel = mysqli_fetch_array($sql_mapel)) {
                            		echo '<option value="'.$data_mapel['id'].'">'.$data_mapel['mapel'].'</option>';
                            	} ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Semester *</label>
                            <select name="ket" class="form-control" required>
                                <option value="">- Pilih -</option>
                                <option value="Ganjil">Semester Ganjil</option>
                                <option value="Genap">Semester Genap</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
                            <input type="reset" value="Reset" class="btn btn-danger" />
                        </div>
                    </form>
                    <?php
                    if(@$_POST['simpan']) {
                        $mapel = @mysqli_real_escape_string($conn, $_POST['mapel']);
                        $pengajar = @$_SESSION['pengajar'];
                        $ket = @mysqli_real_escape_string($conn, $_POST['ket']);
                        mysqli_query($conn, "INSERT INTO tb_mapel_ajar VALUES('', '$mapel', '$pengajar', '$ket')") or die ($db->error);
                        echo "<script>window.location='?page=mapel';</script>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    } else if(@$_GET['action'] == 'edit') { ?>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Mata Pelajaran yang Anda Ajar &nbsp; <a href="?page=mapel" class="btn btn-warning btn-sm">Kembali</a></div>
                <div class="panel-body">
                    <form method="post">
	                    <?php
	                    $sql_mapel_ajar_id = mysqli_query($conn, "SELECT * FROM tb_mapel_ajar JOIN tb_mapel ON tb_mapel_ajar.id_mapel = tb_mapel.id WHERE tb_mapel_ajar.id = '$id'") or die ($db->error);
	                    $data_mapel_ajar_id = mysqli_fetch_array($sql_mapel_ajar_id);
	                    ?>
                        <div class="form-group">
                            <label>Mata Pelajaran*</label>
                            <select name="mapel" class="form-control" required>
                            	<option value="<?php echo $data_mapel_ajar_id['id']; ?>"><?php echo $data_mapel_ajar_id['mapel']; ?></option>
                            	<option value="">- Pilih -</option>
                            	<?php
                            	$sql_mapel = mysqli_query($conn, "SELECT * FROM tb_mapel") or die ($db->error);
                            	while($data_mapel = mysqli_fetch_array($sql_mapel)) {
                            		echo '<option value="'.$data_mapel['id'].'">'.$data_mapel['mapel'].'</option>';
                            	} ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Semester *</label>
                            <select name="ket" class="form-control" required>
                                <option value="">- Pilih -</option>
                                <option value="Ganjil"<?php if($data_mapel['ket'] == 'Ganjil') { echo "selected"; } ?>>Semeter Ganjil</option>
                                <option value="Genap"<?php if($data_mapel['ket'] == 'Genap') { echo "selected"; } ?>>Semester Genap</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="edit" value="Simpan" class="btn btn-success" />
                            <input type="reset" value="Reset" class="btn btn-danger" />
                        </div>
                    </form>
                    <?php
                    if(@$_POST['edit']) {
                        $mapel = @mysqli_real_escape_string($conn, $_POST['mapel']);
                        $ket = @mysqli_real_escape_string($conn, $_POST['ket']);
                        mysqli_query($conn, "UPDATE tb_mapel_ajar SET id_mapel = '$mapel', keterangan = '$ket' WHERE id = '$id'") or die ($db->error);
                        echo "<script>window.location='?page=mapel';</script>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    } else if(@$_GET['action'] == 'hapus') {
        mysqli_query($conn, "DELETE FROM tb_mapel_ajar WHERE id = '$id'") or die ($db->error);  
        echo "<script>window.location='?page=mapel';</script>"; 
    }
    
    echo "</div>";

} ?>