<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Manajemen Ujian</h1>
    </div>
</div>

<?php
$id = @$_GET['id'];
$id_tq = @$_GET['id_tq'];
$no = 1;
    $sql_topik = mysql_query("SELECT * FROM tb_panitia_tq JOIN tb_pengajar ON tb_panitia_tq.pembuat = tb_pengajar.id_pengajar JOIN tb_kelas ON tb_panitia_tq.id_kelas = tb_kelas.id_kelas JOIN tb_mapel ON tb_panitia_tq.id_mapel = tb_mapel.id ORDER BY tgl_buat ASC") or die ($db->error);

if(@$_SESSION['panitia']) {

	echo '<div class="row">';
    if(@$_GET['action'] == '') { ?>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Daftar Soal Ujian &nbsp; <a href="?page=panitia_soal&action=tambah" class="btn btn-primary btn-sm">Tambah Paket Soal</a></div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataquiz">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Kelas</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Guru</th>
                                    <th>Tanggal<br>Pembuatan</th>
                                    <th>Waktu</th>
                                    <th>Info</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(mysql_num_rows($sql_topik) > 0) {
                                while($data_topik = mysql_fetch_array($sql_topik)) { ?>
                                    <tr>
                                        <td align="center"><?php echo $no++; ?></td>
                                        <td><?php echo $data_topik['judul']; ?></td>
                                        <?php 
										$kelas_exqu = mysql_fetch_assoc(mysql_query("SELECT * FROM tb_panitia_tq WHERE id_tq = '$data_topik[id_tq]'"));
										$kelas_ex = explode(',',$kelas_exqu['id_kelas']);
										$kelas_query = mysql_query("SELECT * FROM tb_kelas WHERE id_kelas IN ($kelas_exqu[id_kelas])");
										?>
                                        <td align="center"><?php
										while($kelas_data_ex = mysql_fetch_array($kelas_query)){
										echo $kelas_data_ex['ruang'].' - '.$kelas_data_ex['nama_kelas']."<BR>";
										}?></td>
                                        <td><?php echo $data_topik['mapel']; ?></td>
                                        <td><?php echo $data_topik['nama_lengkap']; ?></td>
                                        <td><?php echo tgl_indo($data_topik['tgl_buat']); ?></td>
                                        <?php
                                        if(@$_SESSION['admin']) {
                                            if($data_topik['pembuat'] == 'admin') {
                                                echo "<td>Admin</td>";
                                            } else {
                                                $sql1 = mysql_query("SELECT * FROM tb_pengajar WHERE id_pengajar = '$data_topik[pembuat]'") or die($db->error);
                                                $data1 = mysql_fetch_array($sql1);
                                                echo "<td>".$data1['nama_lengkap']."</td>";
                                            }
                                        } ?>
                                        <td><?php echo $data_topik['waktu_soal'] / 60 ." menit"; ?></td>
                                        <td><?php echo $data_topik['info']; ?></td>
                                        <td align="center"><?php echo ucfirst($data_topik['status']); ?></td>
                                        <td align="center">
                                            <a href="?page=panitia_soal&action=edit&id=<?php echo $data_topik['id_tq']; ?>" class="badge" style="background-color:#f60;">Edit</a>
                                            <a onclick="return confirm('Hati-hati saat menghapus paket soal karena Anda akan menghapus semua data yang berhubungan dengan topik ini, termasuk data soal dan nilai. Apakah Anda tetap yakin akan menghapus topik ini?');" href="?page=panitia_soal&action=hapus&id_tq=<?php echo $data_topik['id_tq']; ?>" class="badge" style="background-color:#f00;">Hapus</a>
                                            <a href="?page=panitia_soal&action=peserta&id_tq=<?php echo $data_topik['id_tq']; ?>" class="badge">Peserta</a>
                                            <br /><a href="?page=panitia_soal&action=buatsoal&id=<?php echo $data_topik['id_tq']; ?>" class="badge">Buat Soal</a>
                                            <a href="?page=panitia_soal&action=daftarsoal&id=<?php echo $data_topik['id_tq']; ?>" class="badge">Daftar Soal</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                            	echo '<td colspan="9" align="center">Tidak ada data</td>';
                        	} ?>
                            </tbody>
                        </table>
                        <script>
                        $(document).ready(function () {
                            $('#dataquiz').dataTable();
                        });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else if(@$_GET['action'] == 'tambah') { ?>
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">Tambah Paket Soal &nbsp; <a href="?page=panitia_soal" class="btn btn-warning btn-sm">Kembali</a></div>
				<div class="panel-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Judul *</label>
                            <input type="text" name="judul" class="form-control" placeholder="Ex: UTS Semester 2" required />
                        </div>
                        <div class="form-group">
                            <label>Kelas *</label><br>
                                <?php
                            	$sql_kelas = mysql_query("SELECT * FROM tb_kelas") or die ($db->error);
                            	while($data_kelas = mysql_fetch_array($sql_kelas)) {
								echo '<input type="checkbox" name="kelas_list[]" id="kelas_'.$data_kelas['id_kelas'].'" value="'.$data_kelas['id_kelas'].'"> <label for="kelas_'.$data_kelas['id_kelas'].'">'.$data_kelas['ruang'].'-'.$data_kelas['nama_kelas'].'</label> ';
								}?>
                        </div>
                        <div class="form-group">
                            <label>Mata Pelajaran *</label>
                            <select name="mapel" class="form-control" required>
                                <option value="">- Pilih -</option>
                                <?php
                                $sql_mapel = mysql_query("SELECT * FROM tb_mapel") or die ($db->error);
                                while($data_mapel = mysql_fetch_array($sql_mapel)) {
                                    echo '<option value="'.$data_mapel['id'].'">'.$data_mapel['mapel'].'</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Guru *</label>
                            <select name="guru" class="form-control" required>
                                <option value="">- Pilih -</option>
                                <?php
                                $sql_guru = mysql_query("SELECT * FROM tb_pengajar") or die ($db->error);
                                while($data_guru = mysql_fetch_array($sql_guru)) {
                                    echo '<option value="'.$data_guru['id_pengajar'].'">'.$data_guru['nama_lengkap'].'</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pembuatan *</label>
                            <input type="date" name="tgl_buat" value="<?php echo date('Y-m-d'); ?>" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Waktu Soal * <sub>(dalam menit)</sub></label>
                            <input type="text" name="waktu_soal" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Info</label>
                            <textarea name="info" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="aktif">Aktif</option>
                                <option value="tidak aktif">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
                            <input type="reset" value="Reset" class="btn btn-danger" />
                        </div>
                    </form>

                    <?php
                    if(@$_POST['simpan']) {
                        $judul = @mysql_real_escape_string($_POST['judul']);
                        $kelas = implode(",",$_POST['kelas_list']);
                        $mapel = @mysql_real_escape_string($_POST['mapel']);
                        $pembuat = @mysql_real_escape_string($_POST['guru']);
                        $tgl_buat = @mysql_real_escape_string($_POST['tgl_buat']);
                        $waktu_soal = @mysql_real_escape_string($_POST['waktu_soal']) * 60;
                        $info = @mysql_real_escape_string($_POST['info']);
                        $status = @mysql_real_escape_string($_POST['status']);
                        mysql_query("INSERT INTO tb_panitia_tq VALUES('', '$judul', '$kelas', '$mapel', '$tgl_buat', '$pembuat', '$waktu_soal', '$info', '$status')") or die ($db->error);
                        echo "<script>window.location='?page=panitia_soal';</script>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    } else if(@$_GET['action'] == 'edit') { ?>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Paket Soal &nbsp; <a href="?page=panitia_soal" class="btn btn-warning btn-sm">Kembali</a></div>
                <div class="panel-body"><?php
                $sql_topik_id = mysql_query("SELECT * FROM tb_panitia_tq JOIN tb_kelas ON tb_panitia_tq.id_kelas = tb_kelas.id_kelas JOIN tb_mapel ON tb_panitia_tq.id_mapel = tb_mapel.id JOIN tb_pengajar ON tb_panitia_tq.pembuat = tb_pengajar.id_pengajar WHERE id_tq = '$id'") or die ($db->error);
                $data_topik_id = mysql_fetch_array($sql_topik_id);
                ?>
                    <form method="post">
                        <div class="form-group">
                            <label>Judul *</label>
                            <input type="text" name="judul" value="<?php echo $data_topik_id['judul']; ?>" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Kelas *</label><br>
                            <?php
                            	$sql_kelas = mysql_query("SELECT * FROM tb_kelas") or die ($db->error);
                            	$kelas_exqu = mysql_fetch_assoc(mysql_query("SELECT * FROM tb_panitia_tq WHERE id_tq = '$id'"));
				$kelas_ex = explode(',',$kelas_exqu['id_kelas']);
                            	while($data_kelas = mysql_fetch_array($sql_kelas)) {?>
                            		<input type="checkbox" name="kelas_list[]" id="kelas_<?php echo $data_kelas['id_kelas'];?>" value="<?php echo $data_kelas['id_kelas'];?>" <?php if(in_array($data_kelas['id_kelas'],$kelas_ex)){ echo "checked";}?>> <label for="kelas_<?php echo $data_kelas['id_kelas'];?>"><?php echo $data_kelas['ruang'].'-'.$data_kelas['nama_kelas'];?></label>
									<?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mata Pelajaran*</label>
                            <select name="mapel" class="form-control" required>
                                <?php
                                $sql_mapel = mysql_query("SELECT * FROM tb_mapel") or die ($db->error);
                                while($data_mapel = mysql_fetch_array($sql_mapel)) {
                                    echo '<option value="'.$data_mapel['id'].'"';
									if($data_mapel['id'] == $data_topik_id['id_mapel']){echo 'selected';}
									echo '>'.$data_mapel['mapel'].'</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Guru *</label>
                            <select name="guru" class="form-control" required>
                                <?php
                                $sql_guru = mysql_query("SELECT * FROM tb_pengajar") or die ($db->error);
                                while($data_guru = mysql_fetch_array($sql_guru)) {
                                    echo '<option value="'.$data_guru['id_pengajar'].'"';
									if($data_guru['id_pengajar'] == $data_topik_id['pembuat']){echo 'selected';}
									echo '>'.$data_guru['nama_lengkap'].'</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pembuatan *</label>
                            <input type="date" name="tgl_buat" value="<?php echo $data_topik_id['tgl_buat']; ?>" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Waktu Soal * <sub>(dalam menit)</sub></label>
                            <input type="text" name="waktu_soal" value="<?php echo $data_topik_id['waktu_soal'] / 60; ?>" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Info</label>
                            <textarea name="info" class="form-control" rows="3"><?php echo $data_topik_id['info']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="aktif">Aktif</option>
                                <option value="tidak aktif" <?php if($data_topik_id['status'] == 'tidak aktif') { echo "selected"; } ?>>Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
                            <input type="reset" value="Reset" class="btn btn-danger" />
                        </div>
                    </form>
                    <?php
                    if(@$_POST['simpan']) {
                        $judul = @mysql_real_escape_string($_POST['judul']);
                        $kelas = implode(",",$_POST['kelas_list']);
                        $mapel = @mysql_real_escape_string($_POST['mapel']);
                        $pembuat = @mysql_real_escape_string($_POST['guru']);
                        $tgl_buat = @mysql_real_escape_string($_POST['tgl_buat']);
                        $waktu_soal = @mysql_real_escape_string($_POST['waktu_soal']) * 60;
                        $info = @mysql_real_escape_string($_POST['info']);
                        $status = @mysql_real_escape_string($_POST['status']);
						
                        mysql_query("UPDATE tb_panitia_tq SET judul = '$judul', id_kelas = '$kelas', id_mapel = '$mapel', pembuat = '$pembuat', tgl_buat = '$tgl_buat', waktu_soal = '$waktu_soal', info = '$info', status = '$status' WHERE id_tq = '$id'") or die ($db->error);
                        echo "<script>window.location='?page=panitia_soal';</script>";
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
} else if(@$_GET['action'] == 'hapus') {
    mysql_query("DELETE FROM tb_panitia_tq WHERE id_tq = '$_GET[id_tq]'") or die ($db->error);
    mysql_query("DELETE FROM tb_panitia_soal WHERE id_tq = '$_GET[id_tq]'") or die ($db->error);
    mysql_query("DELETE FROM tb_panitia_jawab WHERE id_tq = '$_GET[id_tq]'") or die ($db->error);
    mysql_query("DELETE FROM tb_panitia_nilai WHERE id_tq = '$_GET[id_tq]'") or die ($db->error);
    echo "<script>window.location='?page=panitia_soal';</script>";
} else if(@$_GET['action'] == 'buatsoal') {
    include "panitia_buat_soal.php";
} else if(@$_GET['action'] == 'daftarsoal') {
    include "panitia_daftar_soal.php";
} else if(@$_GET['action'] == 'peserta') {
    include "panitia_peserta.php";
//} else if(@$_GET['action'] == 'koreksi') {
  //  include "koreksi.php";
} else if(@$_GET['action'] == 'hapuspeserta') {
    mysql_query("DELETE FROM tb_panitia_jawab WHERE id_tq = '$_GET[id_tq]' AND id_siswa = '$_GET[id_siswa]'") or die ($db->error);
    mysql_query("DELETE FROM tb_panitia_nilai WHERE id_tq = '$_GET[id_tq]' AND id_siswa = '$_GET[id_siswa]'") or die ($db->error);
    echo "<script>window.location='?page=panitia_soal&action=pesertakoreksi&id_tq=".@$_GET['id_tq']."';</script>";
} }?>