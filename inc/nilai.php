<div class="row">
    <div class="col-md-12">
        <h4 class="page-head-line">Nilai Siswa</h4>
    </div>
</div>

<?php
$id = @$_GET['id'];
$id_tq = @$_GET['id_tq'];
$no = 1;
if(@$_SESSION['admin']) {
    $sql_topik = mysqli_query($conn, "SELECT * FROM tb_topik_quiz JOIN tb_kelas ON tb_topik_quiz.id_kelas = tb_kelas.id_kelas JOIN tb_mapel ON tb_topik_quiz.id_mapel = tb_mapel.id ORDER BY tgl_buat ASC") or die ($db->error);
} 

if(@$_GET['action'] == '') { ?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Data Nilai Ujian Anda</div>
            <div class="panel-body">
                <div class="table-responsive">
                	<table class="table table-striped table-bordered table-hover" id='table'>
                		<tr>
                			<th>No</th>
                			<th>Mata Pelajaran</th>
                			<th>Judul Ujian</th>
                			<th>Presentase Nilai</th>
                			<!--th>Presentase Nilai Essay</th>
                            <!--th>Nilai Total</th>
                			<!--th>Detail</th-->
                		</tr>
                		<?php
                		$no = 1;
                		$sql_cek_nilai_pilgan = mysqli_query($conn, "SELECT * FROM tb_nilai_pilgan JOIN tb_topik_quiz ON tb_nilai_pilgan.id_tq = tb_topik_quiz.id_tq JOIN tb_mapel ON tb_topik_quiz.id_mapel = tb_mapel.id WHERE id_siswa = '$_SESSION[siswa]'") or die ($db->error);
                		if(mysqli_num_rows($sql_cek_nilai_pilgan) > 0) {
                			while($data_nilai_pilgan = mysqli_fetch_array($sql_cek_nilai_pilgan)) { ?>
                				<tr>
	                				<td><?php echo $no++; ?></td>
                					<td><?php echo $data_nilai_pilgan['mapel']; ?></td>
                					<td><?php echo $data_nilai_pilgan['judul']; ?></td>
                					<td>
                                        Benar : <?php echo $data_nilai_pilgan['benar']; ?> soal<br />
                                        Salah : <?php echo $data_nilai_pilgan['salah']; ?> soal<br />
                                        Tidak dikerjakan : <?php echo $data_nilai_pilgan['tidak_dikerjakan']; ?> soal<br />
                                        Presentase : <?php echo $data_nilai_pilgan['presentase']; ?>
                                    </td>
                					<?php
                					$sql_cek_jawaban = mysqli_query($conn, "SELECT * FROM tb_essay_jawaban WHERE id_tq = '$data_nilai_pilgan[id_tq]' AND id_siswa = '$_SESSION[siswa]'") or die ($db->error);
                					$data_jawaban = mysqli_fetch_array($sql_cek_jawaban);
                					if(mysqli_num_rows($sql_cek_jawaban) > 0) {
                						$sql_cek_nilai_essay = mysqli_query($conn, "SELECT * FROM tb_nilai_essay WHERE id_tq = '$data_nilai_pilgan[id_tq]' AND id_siswa = '$_SESSION[siswa]'") or die ($db->error);
                						$data_nilai_essay = mysqli_fetch_array($sql_cek_nilai_essay);
                						if(mysqli_num_rows($sql_cek_nilai_essay) > 0) { 
                							$count = ($data_nilai_pilgan['presentase']+$data_nilai_essay['nilai'])/2;?>
                							<!--td><?php echo $data_nilai_essay['nilai']; ?></td>
                							<!--td><?php echo $count; ?></td>
                							<?php
                						} else {
                							echo "<!--td>Soal essay belum dikoreksi</td>";
                							echo "<td>Menunggu soal essay dikoreksi</td>";
                						}
                					} else { ?>
										<!--td>Ujian ini tidak ada soal essay</td>
										<td><?php echo $data_nilai_pilgan['presentase']; ?></td>
                					<?php
                					} ?>
                                    <!--td><a href="?page=nilai&action=daftarsoal&id=<?php //echo $data_nilai_pilgan['id_tq']; ?>" class="badge">Detail Soal</a></td-->
                				</tr>
                			<?php
	                		}
                		} else {
                            echo '<tr><td colspan="6" align="center">Tidak ada data nilai, mungkin Anda belum mengikuti ujian</td></tr>';
                        } ?>
                	</table>
               	</div>
            </div>
        </div>
    </div>
</div>
<?php
} else if(@$_GET['action'] == 'daftarsoal') {
    include "daftar_soal.php";
}?>