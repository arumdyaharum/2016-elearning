<?php
error_reporting(0);
if(@$_GET['hal'] == 'essay') { ?>
    <div class="row">
    	<div class="panel panel-default">
    	    <div class="panel-heading">
    	        Koreksi Jawaban Essay &nbsp; <a onclick="self.history.back();" class="btn btn-warning btn-sm">Kembali</a>
    	    </div>
            <form action="" method="post">
    	    <div class="panel-body">
                <div class="table-responsive">
                    <table width="100%">
                        <?php
						$urut = 1;
                        $sql_jawaban = mysqli_query($conn, "SELECT * FROM tb_essay_jawaban JOIN tb_soal_essay ON tb_essay_jawaban.id_soal =  tb_soal_essay.id_essay WHERE tb_essay_jawaban.id_tq = '$id_tq' AND tb_essay_jawaban.id_siswa = '$_GET[id_siswa]'") or die ($db->error);
                        $jumlah_soal = mysqli_num_rows($sql_jawaban);
                        while($data_jawaban = mysqli_fetch_array($sql_jawaban)) { ?>
                            <tr>
                                <td width="10%" valign="top">( <?php echo $no++; ?> )</td>
                                <td>
                                    <table class="table">
                                        <tr>
                                            <td><b>Pertanyaan :</b></td>
                                        </tr>
                                        <tr>
                                            <?php if($data_jawaban['pertanyaan'] != ''){?>
											<td><?php echo $data_jawaban['pertanyaan']; ?></td>
											<?php }else{?>
											<td>Tidak ada soal</td>
											<?php }?>
                                        </tr>
										<?php if($data_jawaban['gambarSoal'] != ''){?>
										<tr>
											<td><img src="img/gambar_soal_essay/<?php echo $id_tq.'_'.$data_jawaban['gambarSoal'];?>"></td>
										</tr>
										<?php }?>
                                        <tr>
                                            <td><b>Jawaban :</b></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $data_jawaban['jawaban']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Presentase nilai tiap soal :</b></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="radio-inline">
                                                    <input type="radio" name="nilai_essay[<?php echo $urut;?>]" value="10">10
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="nilai_essay[<?php echo $urut;?>]" value="20">20
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="nilai_essay[<?php echo $urut;?>]" value="30">30
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="nilai_essay[<?php echo $urut;?>]" value="40">40
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="nilai_essay[<?php echo $urut;?>]" value="50">50
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="nilai_essay[<?php echo $urut;?>]" value="60">60
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="nilai_essay[<?php echo $urut;?>]" value="70">70
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="nilai_essay[<?php echo $urut;?>]" value="80">80
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="nilai_essay[<?php echo $urut;?>]" value="90">90
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="nilai_essay[<?php echo $urut++;?>]" value="100">100
                                                </label>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        <?php
                        } ?>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <input type="submit" name="simpan_koreksi" value="Simpan" class="btn btn-primary btn-sm" />
                <input type="reset" value="Reset" class="btn btn-danger btn-sm" />
            </div>
            </form>
            <?php
            $nilai = 0;
			$query_ceknilai = mysqli_query($conn, "SELECT id FROM tb_nilai_essay WHERE id_tq = '$id_tq' && id_siswa = '$_GET[id_siswa]'");
			$ceknilai = mysqli_num_rows($query_ceknilai);
			$data_ceknilai = mysqli_fetch_array($query_ceknilai);
            if(@$_POST['simpan_koreksi']) {
				if($ceknilai > 0){
					foreach(@$_POST['nilai_essay'] as $key => $value) {
						$nilai = $nilai + $value;
					}
					$nilai_total = $nilai / $jumlah_soal;
					mysqli_query($conn, "UPDATE tb_nilai_essay SET nilai = '$nilai_total' WHERE id = '$data_ceknilai[id]'") or die ($db->error);
					echo "<script>window.location='?page=quiz&action=pesertakoreksi&id_tq=".$id_tq."';</script>";
				}else{
                foreach(@$_POST['nilai_essay'] as $key => $value) {
                    $nilai = $nilai + $value;
					//echo 'key='.$key.' value='.$value.' nilai='.$nilai.'<br>';
                }
                $nilai_total = $nilai / $jumlah_soal;
                mysqli_query($conn, "INSERT INTO tb_nilai_essay VALUES('', '$id_tq', '$_GET[id_siswa]', '$nilai_total')") or die ($db->error);
                //echo 'nilai_total='.$nilai_total.' jumlah_soal='.$jumlah_soal.'<br>';
				echo "<script>window.location='?page=quiz&action=pesertakoreksi&id_tq=".$id_tq."';</script>";
				}
            }
            ?>
    	</div>
    </div>
<?php
} else if(@$_GET['hal'] == 'editessay') { ?>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Koreksi Jawaban Essay &nbsp; <a onclick="self.history.back();" class="btn btn-warning btn-sm">Kembali</a>
            </div>
            <form action="" method="post">
            <div class="panel-body">
                <div class="table-responsive">
                    <table width="100%">
                        <?php
                        $urut = 1;
                        $sql_jawaban = mysqli_query($conn, "SELECT * FROM tb_essay_jawaban JOIN tb_soal_essay ON tb_essay_jawaban.id_soal =  tb_soal_essay.id_essay WHERE tb_essay_jawaban.id_tq = '$id_tq' AND tb_essay_jawaban.id_siswa = '$_GET[id_siswa]'") or die ($db->error);
                        $jumlah_soal = mysqli_num_rows($sql_jawaban);
                        while($data_jawaban = mysqli_fetch_array($sql_jawaban)) { ?>
                            <tr>
                                <td width="10%" valign="top">( <?php echo $no++; ?> )</td>
                                <td>
                                    <table class="table">
                                        <tr>
                                            <td><b>Pertanyaan :</b></td>
                                        </tr>
                                        <tr>
                                            <?php if($data_jawaban['pertanyaan'] != ''){?>
											<td><?php echo $data_jawaban['pertanyaan']; ?></td>
											<?php }else{?>
											<td>Tidak ada soal</td>
											<?php }?>
                                        </tr>
										<?php if($data_jawaban['gambarSoal'] != ''){?>
										<tr>
											<td><img src="img/gambar_soal_essay/<?php echo $id_tq.'_'.$data_jawaban['gambarSoal'];?>"></td>
										</tr>
										<?php }?>
                                        <tr>
                                            <td><b>Jawaban :</b></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $data_jawaban['jawaban']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Presentase tiap soal <small>(Untuk mengedit silahkan pilih ulang nilainya)</small> :</b></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="radio-inline">
                                                    <input type="radio" name="nilai_essay[<?php echo $urut++; ?>]" value="10">10
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="nilai_essay[<?php echo $urut++; ?>]" value="20">20
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="nilai_essay[<?php echo $urut++; ?>]" value="30">30
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="nilai_essay[<?php echo $urut++; ?>]" value="40">40
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="nilai_essay[<?php echo $urut++; ?>]" value="50">50
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="nilai_essay[<?php echo $urut++; ?>]" value="60">60
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="nilai_essay[<?php echo $urut++; ?>]" value="70">70
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="nilai_essay[<?php echo $urut++; ?>]" value="80">80
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="nilai_essay[<?php echo $urut++; ?>]" value="90">90
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="nilai_essay[<?php echo $urut++; ?>]" value="100">100
                                                </label>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        <?php
                        } ?>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <input type="submit" name="simpan_koreksi" value="Simpan" class="btn btn-primary btn-sm" />
                <input type="reset" value="Reset" class="btn btn-danger btn-sm" />
            </div>
            </form>
            <?php
            $nilai = 0;
            if(@$_POST['simpan_koreksi']) {
                foreach(@$_POST['nilai_essay'] as $key => $value) {
                    $nilai = $nilai + $value;
                }
                $nilai_total = $nilai / $jumlah_soal;
                mysqli_query($conn, "UPDATE tb_nilai_essay SET nilai = '$nilai_total' WHERE id = '$_GET[id_nilai]'") or die ($db->error);
                echo "<script>window.location='?page=quiz&action=pesertakoreksi&id_tq=".$id_tq."';</script>";
            }
            ?>
        </div>
    </div>
<?php
} ?>