<div class="row">
	<div class="panel panel-default">
	    <div class="panel-heading">
	        <a onclick="self.history.back();" class="btn btn-danger btn-sm">Kembali</a> &nbsp; 
	        Buat Jenis Soal : <a href="?page=quiz&action=buatsoal&hal=soalpilgan&id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Pilihan Ganda</a> <a href="?page=quiz&action=buatsoal&hal=import&id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Import Excel</a>
			<a href="?page=quiz&action=buatsoal&hal=soalessay&id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Essay</a>
		</div>
	    <div class="panel-body" style="padding-bottom:0;">
			<div class="alert alert-warning" id="message"></div>
	    </div>
	</div>
</div>
<script>$("#message").hide();</script>

<?php
if(@$_GET['hal'] == "soalpilgan") { ?>
	<div class="row">
		<div class="panel panel-default">
		    <div class="panel-heading">Buat Soal Pilihan Ganda</div>
		    <div class="panel-body">
		    	<?php $sql_jumlah_pilgan = mysqli_query($conn, "SELECT * FROM tb_soal_pilgan WHERE id_tq = '$id'") or die ($db->error); ?>
			    <form method="post" enctype="multipart/form-data">
					<div class="col-md-2">
						<label>Pertanyaan No. [ <?php echo mysqli_num_rows($sql_jumlah_pilgan) + 1; ?> ]</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="pertanyaan" class="form-control" rows="2" required></textarea>
						</div>
					</div>
					
					<div class="col-md-2">
						<label>Audio MP3 <sup>(Optional)</sup></label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="file" name="gambar[]" class="form-control" />
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
	            	$pertanyaan = @mysqli_real_escape_string($conn, $_POST['pertanyaan']);
	            	$pilA = @mysqli_real_escape_string($conn, $_POST['pilA']);
	            	$pilB = @mysqli_real_escape_string($conn, $_POST['pilB']);
	            	$pilC = @mysqli_real_escape_string($conn, $_POST['pilC']);
	            	$pilD = @mysqli_real_escape_string($conn, $_POST['pilD']);
	            	$pilE = @mysqli_real_escape_string($conn, $_POST['pilE']);
	            	$kunci = @mysqli_real_escape_string($conn, $_POST['kunci']);
					
	            	$sumber = @$_FILES['gambar']['tmp_name'];
                    $target_audio = 'audio/';
                    $target_soal = 'img/gambar_soal_pilgan/soal/';
                    $target_jawab = 'img/gambar_soal_pilgan/jawaban/';
                    $nama_gambar = @$_FILES['gambar']['name'];
					$type = $_FILES['gambar']['type'];
					$errror = $_FILES['gambar']['error'];
					//$permitted = array('audio/mp3', 'audio/x-mp3', 'audio/mpeg', 'audio/x-mpeg', 'audio/mpeg3', 'audio/x-mpeg-3'); //Set array of permittet filetypes
					/**for($a=1;$a<7;$a++){
					if($nama_gambar[$a] == 0){
					${'namagambar'.$a} = '';
					} else {
					${'namagambar'.$a} = $id.'_'.$nama_gambar[$a];}}**/
					
					if($nama_gambar[0] == ''){
						move_uploaded_file($sumber[1], $target_soal.$id.'_'.$nama_gambar[1]);
						for($i=2;$i<7;$i++){move_uploaded_file($sumber[$i], $target_jawab.$id.'_'.$nama_gambar[$i]);}
						mysqli_query($conn, "INSERT INTO tb_soal_pilgan VALUES('', '$id', '$pertanyaan', '', '".$nama_gambar[1]."', '$pilA', '".$nama_gambar[2]."', '$pilB', '".$nama_gambar[3]."', '$pilC', '".$nama_gambar[4]."', '$pilD', '".$nama_gambar[5]."', '$pilE', '".$nama_gambar[6]."', '$kunci', now())") or die ($db->error); //echo "sip";
						//echo "<br><br>".$id.' '.$pertanyaan.' '.$nama_gambar['0'].' '.$nama_gambar['1'].' '.$pilA.' '.$nama_gambar['2'].' '.$pilB.' '.$nama_gambar['3'].' '.$pilC.' '.$nama_gambar['4'].' '.$pilD.' '.$nama_gambar['5'].' '.$pilE.' '.$nama_gambar['6'].' '.$kunci;
						echo '<script>window.location="?page=quiz&action=daftarsoal&hal=pilgan&id='.$id.'"</script>';
					} else {
						echo $type[0].' | '.$nama_gambar[0].' | '.$errror[0];
						if( $type[0] == 'audio/mp3' || $type[0] == 'audio/x-mp3' || $type[0] == 'audio/mpeg' || $type[0] == 'audio/x-mpeg' || $type[0] == 'audio/mpeg3' || $type[0] == 'audio/x-mpeg3' ) //If this filetype is actually permitted
						{
							//echo "sip";
							$filetype = explode("/",$type[0]); //Save the filetype and explode it into an array at /
							$filetype = $filetype[0]; //Take the first part. Image/text etc and stomp it into the filetype variable
							echo $filetype;
					//for($i=0;$i<7;$i++){
					if($filetype == "audio"){
						echo "ok";
						//mysqli_query($conn, "INSERT INTO tb_soal_pilgan VALUES('', '$id', '$pertanyaan', '', '', '$pilA', '', '$pilB', '', '$pilC', '', '$pilD', '', '$pilE', '', '$kunci', now())") or die ($db->error); echo "sip";
						//$new_id = mysqli_insert_id($conn);
						//echo "<br><br>".$id.' '.$pertanyaan.' '.$pilA.' '.$pilB.' '.$pilC.' '.$pilD.' '.$pilE.' '.$kunci.' '.$new_id;
						move_uploaded_file($sumber[0], $target_audio.$id.'_'.$nama_gambar[0]);
						move_uploaded_file($sumber[1], $target_soal.$id.'_'.$nama_gambar[1]);
						for($i=2;$i<7;$i++){move_uploaded_file($sumber[$i], $target_jawab.$id.'_'.$nama_gambar[$i]);}
						mysqli_query($conn, "INSERT INTO tb_soal_pilgan VALUES('', '$id', '$pertanyaan', '".$id."_".$nama_gambar[0]."', '".$nama_gambar[1]."', '$pilA', '".$nama_gambar[2]."', '$pilB', '".$nama_gambar[3]."', '$pilC', '".$nama_gambar[4]."', '$pilD', '".$nama_gambar[5]."', '$pilE', '".$nama_gambar[6]."', '$kunci', now())") or die ($db->error); //echo "sip";
						echo "<br><br>".$id.' '.$pertanyaan.' '.$nama_gambar['0'].' '.$nama_gambar['1'].' '.$pilA.' '.$nama_gambar['2'].' '.$pilB.' '.$nama_gambar['3'].' '.$pilC.' '.$nama_gambar['4'].' '.$pilD.' '.$nama_gambar['5'].' '.$pilE.' '.$nama_gambar['6'].' '.$kunci;
						echo '<script>window.location="?page=quiz&action=daftarsoal&hal=pilgan&id='.$id.'"</script>';
					} else {
						echo '<script>$("#message").html("Jenis audio tidak didukung, yaitu '.$type[0].'".).show();</script>';
						//echo "bukan audio ".$type[0];
					}
						}else{
							echo 'audio error';
						}
					
					//move_uploaded_file($sumber[0], $target_audio.$nama_gambar[0]);
                    //move_uploaded_file($sumber[1], $target_soal.$nama_gambar[1]);
					//for($i=2;$i<7;$i++){move_uploaded_file($sumber[$i], $target_jawab.$nama_gambar[$i]);}
					//mysqli_query($conn, "INSERT INTO tb_soal_pilgan VALUES('', '$id', '$pertanyaan', '$nama_gambar[0]', '$nama_gambar[1]', '$pilA', '$nama_gambar[2]', '$pilB', '$nama_gambar[3]', '$pilC', '$nama_gambar[4]', '$pilD', '$nama_gambar[5]', '$pilE', '$nama_gambar[6]', '$kunci', now())") or die ($db->error); echo "sip";
					//$new_id = mysqli_query($conn, "select last_insert_id()");
					//echo "<br><br>".$id.' '.$pertanyaan.' '.$nama_gambar['0'].' '.$nama_gambar['1'].' '.$pilA.' '.$nama_gambar['2'].' '.$pilB.' '.$nama_gambar['3'].' '.$pilC.' '.$nama_gambar['4'].' '.$pilD.' '.$nama_gambar['5'].' '.$pilE.' '.$nama_gambar['6'].' '.$kunci.' '.$new_id;
					//echo '<script>window.location="?page=quiz&action=daftarsoal&hal=pilgan&id='.$id.'"</script>';
						
					}
				
				} ?>
		    </div>
		</div>
	</div>
<?php
} else if(@$_GET['hal'] == "import") { ?>
	<div class="row">
		<div class="panel panel-default">
		    <div class="panel-heading">Buat Soal Pilihan Ganda dengan Excel</div>
		    <div class="panel-body">
			    <form method="post" enctype="multipart/form-data">

					<div class="col-md-2">
						<label>Pilih File Excel</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="file" name="gambar" class="form-control" />
						</div>
						<div class="form-group">
	                        <input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
	                        <input type="reset" value="Reset" class="btn btn-danger" />
	                    </div>
					</div>
					<div class="col-md-10">
					* semua soal di dalam excel akan diupload.
					</div>
	            </form>
	            <?php
	            if(@$_POST['simpan']) {
	            	$sumber = @$_FILES['gambar']['tmp_name'];
                    $target = 'excel/';
                    $nama_gambar = @$_FILES['gambar']['name'];

                    move_uploaded_file($sumber, $target.$nama_gambar);
					include "inc/phpexcel.php";      
					echo '<script>window.location="?page=quiz&action=daftarsoal&hal=pilgan&id='.$id.'"</script>';
	            }
	            ?>
		    </div>
		</div>
	</div>
	<?php
} else if(@$_GET['hal'] == "soalessay") { ?>
	<div class="row">
		<div class="panel panel-default">
		    <div class="panel-heading">Buat Soal Essay</div>
		    <div class="panel-body">
		    	<?php
		    	$sql_jumlah_essay = mysqli_query($conn, "SELECT * FROM tb_soal_essay WHERE id_tq = '$id'") or die ($db->error); ?>
			    <form method="post" enctype="multipart/form-data">
					<div class="col-md-2">
						<label>Pertanyaan No. [ <?php echo mysqli_num_rows($sql_jumlah_essay) + 1; ?> ]</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="pertanyaan" class="form-control" rows="3" required></textarea>
						</div>
					</div>

					<div class="col-md-2">
						<label>Gambar <sup>(Optional)</sup></label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="file" name="gambar" class="form-control" />
						</div>
						<div class="form-group">
	                        <input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
	                        <input type="reset" value="Reset" class="btn btn-danger" />
	                    </div>
					</div>
					
					<div class="col-md-2">
						<label>Jawaban Pertama</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="jawaban[]" class="form-control" rows="1" required></textarea>
						</div>
					</div>
					
					<div class="col-md-2">
						<label>Jawaban Kedua</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="jawaban[]" class="form-control" rows="1" required></textarea>
						</div>
					</div>
					
					<div class="col-md-2">
						<label>Jawaban Ketiga</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="jawaban[]" class="form-control" rows="1" required></textarea>
						</div>
					</div>
	            </form>
	            <?php
	            if(@$_POST['simpan']) {
					$pertanyaan = @mysqli_real_escape_string($conn, $_POST['pertanyaan']);
					$jawaban = @mysqli_real_escape_string($conn, $_POST['jawaban']);

	            	$sumber = @$_FILES['gambar']['tmp_name'];
                    $target = 'img/gambar_soal_essay/';
                    $nama_gambar = @$_FILES['gambar']['name'];

                    move_uploaded_file($sumber, $target.$id.'_'.$nama_gambar);
                    mysqli_query($conn, "INSERT INTO tb_soal_essay VALUES('', '$id', '$pertanyaan', '$nama_gambar', now())") or die ($db->error);          
                    //echo '<script>window.location="?page=quiz&action=daftarsoal&hal=essay&id='.$id.'"</script>';
	            }
	            ?>
		    </div>
		</div>
	</div>
	<?php
} ?>