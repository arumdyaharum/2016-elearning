<div class="row">
	<div class="panel panel-default">
	    <div class="panel-heading">
	        <a onclick="self.history.back();" class="btn btn-danger btn-sm">Kembali</a> &nbsp; Buat Jenis Soal : Pilihan Ganda
	    </div>
	</div>
</div>
	<div class="row">
		<div class="panel panel-default">
		    <div class="panel-heading">Buat Soal Pilihan Ganda</div>
		    <div class="panel-body">
		    	<?php $sql_jumlah_pilgan = mysql_query("SELECT * FROM tb_panitia_soal WHERE id_tq = '$id'") or die ($db->error); ?>
			    <form method="post" enctype="multipart/form-data">
					<div class="col-md-2">
						<label>Pertanyaan No. [ <?php echo mysql_num_rows($sql_jumlah_pilgan) + 1; ?> ]</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="pertanyaan" class="form-control" rows="2" required></textarea>
						</div>
					</div>
					
					<div class="col-md-2">
						<label>Gambar Soal <sup>(Optional)</sup></label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="file" name="gambar[]" class="form-control" />
						</div>
					</div>
					
					<div class="col-md-2">
						<label>Pilihan A</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="pilA" class="form-control" rows="1" required></textarea>
						</div>
					</div>
					<div class="col-md-2">
						<label>Gambar A <sup>(Optional)</sup></label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="file" name="gambar[]" class="form-control" />
						</div>
					</div>
					
					<div class="col-md-2">
						<label>Pilihan B</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="pilB" class="form-control" rows="1" required></textarea>
						</div>
					</div>
					<div class="col-md-2">
						<label>Gambar B <sup>(Optional)</sup></label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="file" name="gambar[]" class="form-control" />
						</div>
					</div>
					
					<div class="col-md-2">
						<label>Pilihan C</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="pilC" class="form-control" rows="1" required></textarea>
						</div>
					</div>
					<div class="col-md-2">
						<label>Gambar C <sup>(Optional)</sup></label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="file" name="gambar[]" class="form-control" />
						</div>
					</div>
					
					<div class="col-md-2">
						<label>Pilihan D</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="pilD" class="form-control" rows="1" required></textarea>
						</div>
					</div>
					<div class="col-md-2">
						<label>Gambar D <sup>(Optional)</sup></label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="file" name="gambar[]" class="form-control" />
						</div>
					</div>
					
					<div class="col-md-2">
						<label>Pilihan E</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="pilE" class="form-control" rows="1" required></textarea>
						</div>
	                </div>
					<div class="col-md-2">
						<label>Gambar E <sup>(Optional)</sup></label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="file" name="gambar[]" class="form-control" />
						</div>
					</div>
					
	                <div class="col-md-2">
						<label>Kunci Jawaban</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
                            <label class="radio-inline">
                                <input type="radio" name="kunci" value="A">A
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="kunci" value="B">B
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="kunci" value="C">C
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="kunci" value="D">D
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="kunci" value="E">E
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
                    $target_soal = 'p_img/soal/'.$id.'_';
                    $target_jawab = 'p_img/jawaban/'.$id.'_';
                    $nama_gambar = @$_FILES['gambar']['name'];
					
                    move_uploaded_file($sumber[0], $target_soal.$nama_gambar[0]);
					for($i=1;$i<6;$i++){move_uploaded_file($sumber[$i], $target_jawab.$nama_gambar[$i]);}
					
                    mysql_query("INSERT INTO tb_panitia_soal VALUES('', '$id', '$pertanyaan', '$nama_gambar[0]', '$pilA', '$nama_gambar[1]', '$pilB', '$nama_gambar[2]', '$pilC', '$nama_gambar[3]', '$pilD', '$nama_gambar[4]', '$pilE', '$nama_gambar[5]', '$kunci')") or die ($db->error);          
                    echo '<script>window.location="?page=panitia_soal&action=daftarsoal&hal=pilgan&id='.$id.'"</script>';
	            } ?>
		    </div>
		</div>
	</div>