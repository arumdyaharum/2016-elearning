<div class="row">
	<div class="panel panel-default">
	    <div class="panel-heading">
			<?php 
			$nilai_cetak = mysql_fetch_array(mysql_query("SELECT * FROM tb_topik_quiz WHERE id_tq = $_GET[id_tq]"));?>
	        Data Siswa yang Mengikuti Ujian &nbsp; <a href="?page=quiz" class="btn btn-danger btn-sm">Kembali</a> &nbsp; <a href="./laporan/cetak_p.php?data=quiz&id_tq=<?php echo $_GET['id_tq'];?>&filename=elearning_nilai_<?php echo $nilai_cetak['judul'].'_'.date("dmY");?>.pdf" target="_blank" class="btn btn-default btn-sm">Cetak</a>
	    </div>
	    <div class="panel-body">
            <div class="table-responsive">
				<table class="table table-striped table-bordered table-hover" id="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Status Hasil</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
					<?php
					$sql_siswa_mengikuti_tes = mysql_query("SELECT * FROM tb_nilai_pilgan JOIN tb_siswa ON tb_nilai_pilgan.id_siswa = tb_siswa.id_siswa JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas WHERE id_tq = '$id_tq'") or die ($db->error);
                    if(mysql_num_rows($sql_siswa_mengikuti_tes) > 0) {
    					while($data_siswa_mengikuti_tes = mysql_fetch_array($sql_siswa_mengikuti_tes)) {
    						?>
                            <tr>
                                <td align="center" width="40px"><?php echo $no++; ?></td>
                                <td><?php echo $data_siswa_mengikuti_tes['nama_lengkap']; ?></td>
                                <td><?php echo $data_siswa_mengikuti_tes['ruang'].' - '.$data_siswa_mengikuti_tes['nama_kelas']; ?></td>
                            	<!--?php
                            	$sql_pilgan = mysql_query("SELECT * FROM tb_nilai_pilgan WHERE id_siswa = '$data_siswa_mengikuti_tes[id_siswa]' AND id_tq = '$id_tq'") or die ($db->error);
                            	$data_pilgan = mysql_fetch_array($sql_pilgan);
                                $sql_jwb = mysql_query("SELECT * FROM tb_jawaban WHERE id_siswa = '$data_siswa_mengikuti_tes[id_siswa]' AND id_tq = '$id_tq'") or die ($db->error);
                            	?-->
                            	<td>
                            		Nilai soal pilihan ganda : <?php echo $data_siswa_mengikuti_tes['presentase']; ?><br />
                            	</td>
                                <td align="center" width="220px">
                                    <a onclick="return confirm('Yakin akan menghapus siswa ini dari daftar peserta ujian?');" href="?page=quiz&action=lanjutujian&id_tq=<?php echo $id_tq; ?>&id_siswa=<?php echo $data_siswa_mengikuti_tes['id_siswa']; ?>" class="badge" style="background-color:#f00;">Lanjutkan Ujian</a> &nbsp; 
                                    <a onclick="return confirm('Yakin akan menghapus siswa ini dari daftar peserta ujian?');" href="?page=quiz&action=resetpeserta&id_tq=<?php echo $id_tq; ?>&id_siswa=<?php echo $data_siswa_mengikuti_tes['id_siswa']; ?>" class="badge" style="background-color:#f00;">Reset Peserta</a>
                                </td>
                            </tr>
    					<?php
    					}
                    } else {
                        echo '<tr><td colspan="5" align="center">Data tidak ditemukan</td></tr>';
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
	</div>
</div>
<script>
  $(document).ready(function () {
                $('#table').dataTable();
            });
</script>