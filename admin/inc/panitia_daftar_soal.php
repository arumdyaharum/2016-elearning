<?php
$sql_pilgan = mysql_query("SELECT * FROM tb_panitia_soal WHERE id_tq = '$id'") or die ($db->error);
?>
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="?page=panitia_soal" class="btn btn-danger btn-sm">Kembali</a> &nbsp; 
			Lihat Daftar Jenis Soal : <a href="?page=panitia_soal&action=daftarsoal&hal=pilgan&id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Pilihan Ganda (<?php echo mysql_num_rows($sql_pilgan); ?> soal)</a> 
		</div>
		<?php
		if(@$_GET['hal'] == "pilgan" || @$_GET['hal'] == "essay") { ?>
			<div class="panel-body">
				<fieldset>
					<legend>Info Tugas / Quiz</legend>
					<?php
					$sql_tq = mysql_query("SELECT * FROM tb_panitia_tq JOIN tb_kelas ON tb_panitia_tq.id_kelas = tb_kelas.id_kelas JOIN tb_mapel ON tb_panitia_tq.id_mapel = tb_mapel.id JOIN tb_pengajar ON tb_panitia_tq.pembuat = tb_pengajar.id_pengajar WHERE id_tq = '$id'") or die ($db->error);
					$data_tq = mysql_fetch_array($sql_tq);
					?>
					<table align="center">
						<tr>
							<td>Judul</td>
							<td align="center" width="50px">:</td>
							<td><?php echo $data_tq['judul']; ?></td>
						</tr>
						<tr>
							<td>Kelas</td>
							<td align="center" width="50px">:</td>
							<td><?php echo $data_tq['ruang'].' - '.$data_tq['nama_kelas']; ?></td>
						</tr>
						<tr>
							<td>Mata Pelajaran</td>
							<td align="center" width="50px">:</td>
							<td><?php echo $data_tq['mapel']; ?></td>
						</tr>
						<tr>
							<td>Guru</td>
							<td align="center" width="50px">:</td>
							<td><?php echo $data_tq['nama_lengkap']; ?></td>
						</tr>
						<tr>
							<td>Waktu Pengerjaan</td>
							<td align="center" width="50px">:</td>
							<td><?php echo $data_tq['waktu_soal'] / 60 ." menit"; ?></td>
						</tr>
					</table>
				</fieldset>
			</div>
		<?php
		} ?>
	</div>
</div>
<?php
$idsoal = @$_GET['idsoal'];
$k = 1;
$ke = @$_GET['ke'];

if(@$_GET['hal'] == "pilgan") { ?>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Soal Pilihan Ganda &nbsp; <a href="?page=panitia_soal&action=buatsoal&id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Tambah Soal</a></div>
			<div class="panel-body">
				<div class="table-responsive">
				<?php
				if(mysql_num_rows($sql_pilgan) > 0) {
					while($data_pilgan = mysql_fetch_array($sql_pilgan)) { ?>
					<table width="100%">
						<tr>
							<td valign="top">Soal no. ( <?php echo $no++; ?> )</td>
							<td>
								<table class="table">
									<thead>
										<tr>
											<td width="20%"><b>Pertanyaan</b></td>
											<td>:</td>
											<td width="65%"><?php echo $data_pilgan['pertanyaan']; ?></td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Gambar Soal</td>
											<td>:</td>
											<td>
												<?php
												if($data_pilgan['gambarSoal'] != '') {
													echo '<img src="p_img/soal/'.$id.'_'.$data_pilgan['gambarSoal'].'" width="200px" />';
												} else {
													echo "<i>Tidak ada gambar</i>";
												} ?>
											</td>
										</tr>
										<tr>
											<td>Pilihan A</td>
											<td>:</td>
											<td><?php echo $data_pilgan['pil_a']; ?></td>
										</tr>
										<tr>
											<td>Gambar A</td>
											<td>:</td>
											<td>
												<?php
												if($data_pilgan['gambarA'] != '') {
													echo '<img src="p_img/jawaban/'.$id.'_'.$data_pilgan['gambarA'].'" width="200px" />';
												} else {
													echo "<i>Tidak ada gambar</i>";
												} ?>
											</td>
										</tr>
										<tr>
											<td>Pilihan B</td>
											<td>:</td>
											<td><?php echo $data_pilgan['pil_b']; ?></td>
										</tr>
										<tr>
											<td>Gambar B</td>
											<td>:</td>
											<td>
												<?php
												if($data_pilgan['gambarB'] != '') {
													echo '<img src="p_img/jawaban/'.$id.'_'.$data_pilgan['gambarB'].'" width="200px" />';
												} else {
													echo "<i>Tidak ada gambar</i>";
												} ?>
											</td>
										</tr>
										<tr>
											<td>Pilihan C</td>
											<td>:</td>
											<td><?php echo $data_pilgan['pil_c']; ?></td>
										</tr>
										<tr>
											<td>Gambar C</td>
											<td>:</td>
											<td>
												<?php
												if($data_pilgan['gambarC'] != '') {
													echo '<img src="p_img/jawaban/'.$id.'_'.$data_pilgan['gambarC'].'" width="200px" />';
												} else {
													echo "<i>Tidak ada gambar</i>";
												} ?>
											</td>
										</tr>
										<tr>
											<td>Pilihan D</td>
											<td>:</td>
											<td><?php echo $data_pilgan['pil_d']; ?></td>
										</tr>
										<tr>
											<td>Gambar D</td>
											<td>:</td>
											<td>
												<?php
												if($data_pilgan['gambarD'] != '') {
													echo '<img src="p_img/jawaban/'.$id.'_'.$data_pilgan['gambarD'].'" width="200px" />';
												} else {
													echo "<i>Tidak ada gambar</i>";
												} ?>
											</td>
										</tr>
										<tr>
											<td>Pilihan E</td>
											<td>:</td>
											<td><?php echo $data_pilgan['pil_e']; ?></td>
										</tr>
										<tr>
											<td>Gambar E</td>
											<td>:</td>
											<td>
												<?php
												if($data_pilgan['gambarE'] != '') {
													echo '<img src="p_img/jawaban/'.$id.'_'.$data_pilgan['gambarE'].'" width="200px" />';
												} else {
													echo "<i>Tidak ada gambar</i>";
												} ?>
											</td>
										</tr>
										<tr>
											<td>Kunci</td>
											<td>:</td>
											<td><?php echo $data_pilgan['kunci']; ?></td>
										</tr>
										<tr>
											<td>Opsi</td>
											<td>:</td>
											<td>
												<a href="?page=panitia_soal&action=daftarsoal&hal=editsoalpilgan&id=<?php echo $id; ?>&idsoal=<?php echo $data_pilgan['id_pilgan']; ?>&ke=<?php echo $k++; ?>" class="badge" style="background-color:#f60;">Edit</a>
												<a onclick="return confirm('Yakin akan menghapus data?');" href="?page=panitia_soal&action=daftarsoal&hal=hapussoalpilgan&id=<?php echo $id; ?>&idsoal=<?php echo $data_pilgan['id_pilgan']; ?>" class="badge" style="background-color:#f00;">Hapus</a>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</table>
					
					<?php
					}
				} else { ?>
					<div class="alert alert-danger">Data soal pilihan ganda tidak ditemukan</div>
					<?php
				} ?>
				</div>
			</div>
		</div>
	</div>
	<?php
} else if(@$_GET['hal'] == "editsoalpilgan") { ?>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Edit Soal Pilihan Ganda</div>
			<div class="panel-body">
			<?php
			$sql_pilgan_id = mysql_query("SELECT * FROM tb_panitia_soal WHERE id_pilgan = '$idsoal'") or die ($db->error);
			$data_pilgan_id = mysql_fetch_array($sql_pilgan_id);
			?>
				<form method="post" enctype="multipart/form-data">
					<div class="col-md-2">
						<label>Pertanyaan No. [ <?php echo $ke; ?> ]</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="pertanyaan" class="form-control" rows="2" required><?php echo $data_pilgan_id['pertanyaan']; ?></textarea>
						</div>
					</div>
					<div class="col-md-2">
						<label>Gambar Soal <sup>(Optional)</sup></label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="file" name="gambar" class="form-control" />
							<?php
							if($data_pilgan_id['gambarSoal'] != '') {
								if(@$_GET['gbr'] != 'del') { ?>
									<div style="margin-top:5px;">
										<img width="150px" src="../admin/p_img/soal/<?php echo $data_pilgan_id['gambar']; ?>" />
									</div>
								<?php }
							} ?>
						</div>
					</div>
					
					<div class="col-md-2">
						<label>Pilihan A</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="pilA" class="form-control" rows="1" required><?php echo $data_pilgan_id['pil_a']; ?></textarea>
						</div>
					</div>
					<div class="col-md-2">
						<label>Gambar A <sup>(Optional)</sup></label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="file" name="gambar[]" class="form-control" />
							<?php
							if($data_pilgan_id['gambarA'] != '') {
								if(@$_GET['gbr'] != 'del') { ?>
									<div style="margin-top:5px;">
										<img width="150px" src="../admin/p_img/jawaban/<?php echo $data_pilgan_id['gambarA']; ?>" />
									</div>
								<?php }
							} ?>
						</div>
					</div>
					<div class="col-md-2">
						<label>Pilihan B</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="pilB" class="form-control" rows="1" required><?php echo $data_pilgan_id['pil_b']; ?></textarea>
						</div>
					</div>
					<div class="col-md-2">
						<label>Gambar B <sup>(Optional)</sup></label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="file" name="gambar[]" class="form-control" />
							<?php
							if($data_pilgan_id['gambarB'] != '') {
								if(@$_GET['gbr'] != 'del1') { ?>
									<div style="margin-top:5px;">
										<img width="150px" src="../admin/p_img/jawaban/<?php echo $data_pilgan_id['gambarB']; ?>" />
									</div>
								<?php }
							} ?>
						</div>
					</div>
					<div class="col-md-2">
						<label>Pilihan C</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="pilC" class="form-control" rows="1" required><?php echo $data_pilgan_id['pil_c']; ?></textarea>
						</div>
					</div>
					<div class="col-md-2">
						<label>Gambar C <sup>(Optional)</sup></label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="file" name="gambar[]" class="form-control" />
							<?php
							if($data_pilgan_id['gambarC'] != '') {
								if(@$_GET['gbr'] != 'del') { ?>
									<div style="margin-top:5px;">
										<img width="150px" src="../admin/p_img/jawaban/<?php echo $data_pilgan_id['gambarC']; ?>" />
									</div>
								<?php }
							} ?>
						</div>
					</div>
					<div class="col-md-2">
						<label>Pilihan D</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="pilD" class="form-control" rows="1" required><?php echo $data_pilgan_id['pil_d']; ?></textarea>
						</div>
					</div>
					<div class="col-md-2">
						<label>Gambar D <sup>(Optional)</sup></label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="file" name="gambar[]" class="form-control" />
							<?php
							if($data_pilgan_id['gambarD'] != '') {
								if(@$_GET['gbr'] != 'del') { ?>
									<div style="margin-top:5px;">
										<img width="150px" src="../admin/p_img/jawaban/<?php echo $data_pilgan_id['gambarD']; ?>" />
									</div>
								<?php }
							} ?>
						</div>
					</div>
					<div class="col-md-2">
						<label>Pilihan E</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="pilE" class="form-control" rows="1" required><?php echo $data_pilgan_id['pil_e']; ?></textarea>
						</div>
					</div>
					<div class="col-md-2">
						<label>Gambar E <sup>(Optional)</sup></label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="file" name="gambar[]" class="form-control" />
							<?php
							if($data_pilgan_id['gambarE'] != '') {
								if(@$_GET['gbr'] != 'del') { ?>
									<div style="margin-top:5px;">
										<img width="150px" src="../admin/p_img/jawaban/<?php echo $data_pilgan_id['gambarE']; ?>" />
									</div>
								<?php }
							} ?>
						</div>
					</div>
					<div class="col-md-2">
						<label>Kunci Jawaban</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<label class="radio-inline">
								<input type="radio" name="kunci" value="A" <?php if($data_pilgan_id['kunci'] == 'A') { echo "checked"; } ?>>A
							</label>
							<label class="radio-inline">
								<input type="radio" name="kunci" value="B" <?php if($data_pilgan_id['kunci'] == 'B') { echo "checked"; } ?>>B
							</label>
							<label class="radio-inline">
								<input type="radio" name="kunci" value="C" <?php if($data_pilgan_id['kunci'] == 'C') { echo "checked"; } ?>>C
							</label>
							<label class="radio-inline">
								<input type="radio" name="kunci" value="D" <?php if($data_pilgan_id['kunci'] == 'D') { echo "checked"; } ?>>D
							</label>
							<label class="radio-inline">
								<input type="radio" name="kunci" value="E" <?php if($data_pilgan_id['kunci'] == 'E') { echo "checked"; } ?>>E
							</label>
						</div>
						<div class="form-group">
							<input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
							<input type="reset" value="Reset" class="btn btn-danger" />
						</div>
					</div>
				</form>
				<?php
				if(@$_POST['simpan']) {
					$pertanyaan = @mysql_real_escape_string($_POST['pertanyaan']);
					$pilA = @mysql_real_escape_string($_POST['pilA']);
					$pilB = @mysql_real_escape_string($_POST['pilB']);
					$pilC = @mysql_real_escape_string($_POST['pilC']);
					$pilD = @mysql_real_escape_string($_POST['pilD']);
					$pilE = @mysql_real_escape_string($_POST['pilE']);
					$kunci = @mysql_real_escape_string($_POST['kunci']);

					$sumber = @$_FILES['gambar']['tmp_name'];
                    $target_soal = 'p_img/soal/';
                    $target_jawab = 'p_img/jawaban/';
                    $nama_gambar = @$_FILES['gambar']['name'];

					for($i=0;$i<7;$i++){
						if($nama_gambar[$i] == '') {
							mysql_query("UPDATE tb_panitia_soal SET pertanyaan = '$pertanyaan', pil_a = '$pilA', pil_b = '$pilB', pil_c = '$pilC', pil_d = '$pilD', pil_e = '$pilE', kunci = '$kunci' WHERE id_pilgan = '$idsoal'") or die ($db->error);          
							// echo "gambar tidak dihapus dan tidak diperbarui (tetap)";
						} else {
							move_uploaded_file($sumber[0], $target_soal.$nama_gambar[0]);
							for($i=1;$i<6;$i++){move_uploaded_file($sumber[$i], $target_jawab.$nama_gambar[$i]);}
							mysql_query("UPDATE tb_panitia_soal SET pertanyaan = '$pertanyaan', gambarSoal = '$nama_gambar[0]', pil_a = '$pilA', gambarA = '$nama_gambar[1]', pil_b = '$pilB', gambarB = '$nama_gambar[2]', pil_c = '$pilC', gambarC = '$nama_gambar[3]', pil_d = '$pilD', gambarD = '$nama_gambar[4]', pil_e = '$pilE', gambarE = '$nama_gambar[5]', kunci = '$kunci' WHERE id_pilgan = '$idsoal'") or die ($db->error);
							// echo "gambar diperbarui dari sebelumnya";
						}
					}
					echo "<script>window.location='?page=panitia_soal&action=daftarsoal&hal=pilgan&id=".$id."';</script>";
				} ?>

			</div>
		</div>
	</div>
	<?php
} else if(@$_GET['hal'] == "hapussoalpilgan") {
	mysql_query("DELETE FROM tb_panitia_soal WHERE id_pilgan = '$idsoal'") or die ($db->error);
	echo "<script>window.location='?page=panitia_soal&action=daftarsoal&hal=pilgan&id=".$id."';</script>";
	} ?>