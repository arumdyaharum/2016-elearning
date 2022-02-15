<?php
@session_start();
include "../+koneksi.php";

$id_tq = mysql_real_escape_string($_POST['id_tq']);

//$soal = mysql_query("SELECT * FROM tb_soal_pilgan where id_tq = '$id_tq'") or die ($db->error);
//$pilganda = mysql_num_rows($soal);

//$soal_esay = mysql_query("SELECT * FROM tb_soal_essay WHERE id_tq = '$id_tq'") or die ($db->error);
//$esay = mysql_num_rows($soal_esay);

/** if(!empty($_POST['soal_essay'])){
	 foreach($_POST['soal_essay'] as $key2 => $value){
		 //echo $key2."_value_".$value;
		$cek2 = mysqli_query($conn, "SELECT * FROM tb_soal_essay WHERE id_essay = '$key2'");
		$query_cekjawab = mysqli_query($conn, "SELECT * FROM tb_essay_jawaban WHERE id_soal = '$key2'");
		$num_cekjawab = mysqli_num_rows($query_cekjawab);
		if($num_cekjawab > 0){
						$cekjawab = mysqli_fetch_array($query_cekjawab);
			//echo '<br>idjawab = '.$cekjawab['id'];
			mysqli_query($conn, "UPDATE tb_essay_jawaban SET jawaban='$value' WHERE id='$cekjawab[id]'");
		} else {
			$data2 = mysqli_fetch_array($cek2);
			//echo '<br>syoal = '.$data2['id_essay'];
			mysqli_query($conn, "INSERT INTO tb_essay_jawaban VALUES ('', '$id_tq', '$data2[id_essay]', '$_SESSION[siswa]', '', '$value')");
			
		}
	  }
 }**/
 
 /** if(!empty($_POST['soal_essay'])) {
      $benar_essay = 0;
      $salah_essay = 0;
      foreach($_POST['soal_pilgan'] as $key => $value) {
          $cek = mysql_query("SELECT kunci FROM tb_soal_pilgan WHERE id_pilgan = '$key'") or die ($db->error);
          while($c = mysql_fetch_array($cek)) {
              $jawaban = $c['kunci'];
          }
          if($value == $jawaban) {
              $benar++;
          } else {
              $salah++;
          }
      }
      $jumlah = $_POST['jumlahsoalpilgan'];
      $tidakjawab = $jumlah - $benar - $salah;
      $persen = $benar / $jumlah;
      $hasil = $persen * 100;
      mysql_query("INSERT INTO tb_nilai_pilgan VALUES('', '$id_tq', '$_SESSION[siswa]', '$benar', '$salah', '$tidakjawab', '$hasil')") or die ($db->error);
  } else if(empty($_POST['soal_pilgan'])){
      $jumlah = $_POST['jumlahsoalpilgan'];
      mysql_query("INSERT INTO tb_nilai_pilgan VALUES('', '$id_tq', '$_SESSION[siswa]', '0', '0', '$jumlah', '0')") or die ($db->error);
  }**/
  
  if(!empty($_POST['soal_pilgan'])) {
      $benar = 0;
      $salah = 0;
      foreach($_POST['soal_pilgan'] as $key => $value) {
          $cek = mysql_query("SELECT kunci FROM tb_soal_pilgan WHERE id_pilgan = '$key'") or die ($db->error);
          while($c = mysql_fetch_array($cek)) {
              $jawaban = $c['kunci'];
          }
          if($value == $jawaban) {
              $benar++;
          } else {
              $salah++;
          }
      }
      $jumlah = $_POST['jumlahsoalpilgan'];
      $tidakjawab = $jumlah - $benar - $salah;
      $persen = $benar / $jumlah;
      $hasil = $persen * 100;
      mysql_query("INSERT INTO tb_nilai_pilgan VALUES('', '$id_tq', '$_SESSION[siswa]', '$benar', '$salah', '$tidakjawab', '$hasil')") or die ($db->error);
  } else if(empty($_POST['soal_pilgan'])){
      $jumlah = $_POST['jumlahsoalpilgan'];
      mysql_query("INSERT INTO tb_nilai_pilgan VALUES('', '$id_tq', '$_SESSION[siswa]', '0', '0', '$jumlah', '0')") or die ($db->error);
  }
 echo "<script>window.location='./../?page=quiz&action=infokerjakan&id_tq=".$id_tq."';</script>"; ?>