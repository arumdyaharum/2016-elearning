<?php
$sql_pilgan = mysql_query("SELECT * FROM tb_soal_pilgan WHERE id_tq = '$id'") or die ($db->error);
$sql_essay = mysql_query("SELECT * FROM tb_soal_essay WHERE id_tq = '$id'") or die ($db->error);
?>
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="?page=nilai" class="btn btn-danger btn-sm">Kembali</a> &nbsp; 
			Lihat Daftar Jenis Soal : <a href="?page=nilai&action=daftarsoal&hal=pilgan&id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Pilihan Ganda (<?php echo mysql_num_rows($sql_pilgan); ?> soal)</a> 
			<a href="?page=nilai&action=daftarsoal&hal=essay&id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Essay (<?php echo mysql_num_rows($sql_essay); ?> soal)</a>
		</div>
		<?php
		if(@$_GET['hal'] == "pilgan" || @$_GET['hal'] == "essay") { ?>
			<div class="panel-body">
				<fieldset>
					<legend>Info Tugas / Quiz</legend>
					<?php
					$sql_tq = mysql_query("SELECT * FROM tb_topik_quiz JOIN tb_kelas ON tb_topik_quiz.id_kelas = tb_kelas.id_kelas JOIN tb_mapel ON tb_topik_quiz.id_mapel = tb_mapel.id WHERE id_tq = '$id'") or die ($db->error);
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
							<td><?php echo $data_tq['nama_kelas']," - ",$data_tq['ruang']; ?></td>
						</tr>
						<tr>
							<td>Mata Pelajaran</td>
							<td align="center" width="50px">:</td>
							<td><?php echo $data_tq['mapel']; ?></td>
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
			<div class="panel-heading">Soal Pilihan Ganda &nbsp; </div>
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
											<td>Gambar</td>
											<td>:</td>
											<td>
												<?php
												if($data_pilgan['gambar'] != '') {
													echo '<img src="img/gambar_soal_pilgan/'.$data_pilgan['gambar'].'" width="200px" />';
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
											<td>Pilihan B</td>
											<td>:</td>
											<td><?php echo $data_pilgan['pil_b']; ?></td>
										</tr>
										<tr>
											<td>Pilihan C</td>
											<td>:</td>
											<td><?php echo $data_pilgan['pil_c']; ?></td>
										</tr>
										<tr>
											<td>Pilihan D</td>
											<td>:</td>
											<td><?php echo $data_pilgan['pil_d']; ?></td>
										</tr>
										<tr>
											<td>Pilihan E</td>
											<td>:</td>
											<td><?php echo $data_pilgan['pil_e']; ?></td>
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
} else if(@$_GET['hal'] == "essay") { ?>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Soal Essay &nbsp; <a href="?page=nilai&action=buatsoal&hal=soalessay&id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Tambah Soal Essay</a></div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Pertanyaan</th>
								<th>Gambar</th>
								<th>Tanggal Pembuatan</th>
							</tr>
						</thead>
						<tbody>
						<?php
						if(mysql_num_rows($sql_essay) > 0) {
							while($data_essay = mysql_fetch_array($sql_essay)) { ?>
							<tr>
								<td align="center" width="40px"><?php echo $no++; ?></td>
								<td><?php echo $data_essay['pertanyaan']; ?></td>
								<td align="center" width="150px">
									<?php
									if($data_essay['gambarSoal'] != '') {
										echo '<img src="img/gambar_soal_essay/'.$data_essay['gambarSoal'].'" width="100px" />';
									} else {
										echo "<i>Tidak ada gambar</i>";
									} ?>
								</td>
								<td align="center" width="160px"><?php echo tgl_indo($data_essay['tgl_buat']); ?></td>
							<?php
							}
						} else {
							echo '<td colspan="5" align="center">Data soal essay tidak ditemukan</td>';
						} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php
} ?>