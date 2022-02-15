<?php
include "../+koneksi.php";

$id_tq = $_POST["id_tq"];
$siswa = $_POST["siswa"];

$soal = mysqli_query($conn, "SELECT * FROM tb_soal_pilgan where id_tq = '$id_tq'") or die ($db->error);
$pilganda = mysqli_num_rows($soal);

      $benar = 0;
      $salah = 0;
	  $sql_soal_pilgan = mysqli_query($conn, "SELECT * FROM tb_soal_pilgan WHERE id_tq = '$id_tq'") or die ($db->error);
		  $jawabnye = mysqli_query($conn, "SELECT * FROM tb_jawaban WHERE id_siswa = '$siswa' && id_tq = '$id_tq'") or die ($db->error);
          while($jawab = mysqli_fetch_array($jawabnye)){
		  $c = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_soal_pilgan WHERE id_pilgan = '$jawab[id_soal]'"));
              $jawaban = $c['kunci'];
          if($jawab['jawaban'] == $jawaban) {
              $benar++;
          } else {
              $salah++;
          }}
      $jumlah = mysqli_num_rows($sql_soal_pilgan);
      $tidakjawab = $jumlah - $benar - $salah;
      $persen = $benar / $jumlah;
      $hasil = $persen * 100;
	  $sql_nilai = mysqli_query($conn, "SELECT * FROM tb_nilai_pilgan WHERE id_siswa = '$siswa' AND id_tq = '$id_tq'");
	  $num_nilai = mysqli_num_rows($sql_nilai);
	  
	  If($num_nilai > 0){
	  mysqli_query($conn, "UPDATE tb_nilai_pilgan SET benar = '$benar', salah = '$salah', tidak_dikerjakan = '$tidakjawab', presentase = '$hasil' where id_siswa = '$siswa' AND id_tq = '$id_tq'");
	  echo "UPDATE COMPLETE<br>";
	  } else {
	  mysqli_query($conn, "INSERT INTO tb_nilai_pilgan VALUES ('', '$id_tq', '$siswa', '$benar', '$salah', '$tidakjawab', '$hasil')");
	  echo "INSERT COMPLETE<br>";
	  }
	  echo $id_tq.' | '.$siswa.' | '.$jumlah.' | '.$tidakjawab.' | '.$persen.' | '.$hasil.' | '.$benar.' | '.$salah;
  echo "<script>window.location='./../?page=quiz&action=infokerjakan&id_tq=".$id_tq."';</script>";
  ?>