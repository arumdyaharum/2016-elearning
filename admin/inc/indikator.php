<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Manajemen Pokok Bahasan</h1>
    </div>
</div>

<?php
$id = @$_GET['id'];
$no = 1;

if(@$_SESSION[pengajar]) {

	echo '<div class="row">';
    if(@$_GET['action'] == '') { ?>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Pokok Bahasan &nbsp; <a href="?page=indikator&action=tambah" class="btn btn-primary btn-sm">Tambah Pokok Bahasan</a></div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Mapel</th>
                                    <th>Mapel</th>
                                    <th>Pokok Bahasan</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_indikator = mysqli_query($conn, "SELECT * FROM tb_indikator JOIN tb_mapel ON tb_indikator.id_mapel = tb_mapel.id WHERE tb_indikator.id_pengajar = '$_SESSION[pengajar]'") or die ($db->error);
                            #$sql_mapel_ajar = mysql_query("SELECT tb_mapel.kode_mapel, tb_mapel.mapel, tb_kelas.nama_kelas, tb_mapel_ajar.keterangan FROM tb_mapel, tb_kelas, tb_mapel_ajar WHERE tb_indikator.id_pengajar ='$_SESSION[pengajar]'") or die ($db->error);
                        
							if(mysqli_num_rows($sql_indikator) > 0) {
	                            while($data_indikator = mysqli_fetch_array($sql_indikator)) { ?>
	                                <tr>
	                                    <td><?php echo $no++; ?></td>
	                                    <td><?php echo $data_indikator['kode_mapel']; ?></td>
	                                    <td><?php echo $data_indikator['mapel']; ?></td>
	                                    <td><?php echo $data_indikator['indikator']; ?></td>
	                                    <td align="center" width="150px">
	                                        <a href="?page=indikator&action=edit&id=<?php echo $data_indikator[0]; ?>" class="badge" style="background-color:#f60;">Edit</a>
	                                        <a onclick="return confirm('Yakin akan menghapus data?');" href="?page=indikator&action=hapus&id=<?php echo $data_indikator[0]; ?>" class="badge" style="background-color:#f00;">Hapus</a>
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
                <div class="panel-heading">Tambah Pokok Bahasan &nbsp; <a href="?page=mapel" class="btn btn-warning btn-sm">Kembali</a></div>
				<div class="panel-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Mapel *</label>
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
                            <label>Pokok Bahasan *</label>
                            <input type="text" name="indikator" class="form-control" placeholder="masukan pokok bahasan" required />
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
						$indikator = @mysqli_real_escape_string($conn, $_POST['indikator']);
                        mysqli_query($conn, "INSERT INTO tb_indikator VALUES('', '$mapel', '$indikator', '$pengajar')") or die ($db->error);
                        echo "<script>window.location='?page=indikator';</script>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    } else if(@$_GET['action'] == 'edit') { ?>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Pokok Bahasan &nbsp; <a href="?page=indikator" class="btn btn-warning btn-sm">Kembali</a></div>
                <div class="panel-body">
                    <form method="post">
	                    <?php
	                    #$sql_mapel_ajar_id = mysql_query("SELECT * FROM tb_mapel_ajar JOIN tb_mapel ON tb_mapel_ajar.id_mapel = tb_mapel.id JOIN tb_kelas ON tb_mapel_ajar.id_kelas = tb_kelas.id_kelas WHERE tb_mapel_ajar.id = '$id'") or die ($db->error);
	                    $sql_indikator = mysqli_query($conn, "SELECT * FROM tb_indikator JOIN tb_mapel ON tb_indikator.id_mapel = tb_mapel.id WHERE tb_indikator.id_indikator = '$id'") or die ($db->error);
						$data_indikator = mysqli_fetch_array($sql_indikator);
	                    ?>
                        <div class="form-group">
                            <label>Mapel *</label>
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
                            <label>Pokok Bahasan *</label>
                            <input type="text" name="indikator" value="<?php echo $data_indikator['indikator']; ?>" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="edit" value="Simpan" class="btn btn-success" />
                            <input type="reset" value="Reset" class="btn btn-danger" />
                        </div>
                    </form>
                    <?php
                    if(@$_POST['edit']) {
                        $mapel = @mysqli_real_escape_string($conn, $_POST['mapel']);
                        $indikator = @mysqli_real_escape_string($conn, $_POST['indikator']);
                        mysqli_query($conn, "UPDATE tb_indikator SET id_mapel = '$mapel', indikator = '$indikator' WHERE id_indikator = '$id'") or die ($db->error);
                        echo "<script>window.location='?page=indikator';</script>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    } else if(@$_GET['action'] == 'hapus') {
        mysqli_query($conn, "DELETE FROM tb_indikator WHERE id_indikator = '$id'") or die ($db->error);  
        echo "<script>window.location='?page=indikator';</script>"; 
    } else if(@$_GET['action'] == 'buatindikator') {
    include "buat_indikator.php";
    } 
    
    echo "</div>";

} ?>