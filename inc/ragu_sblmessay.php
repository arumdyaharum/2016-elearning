<?php
include "../+koneksi.php";
$id_tq = $_POST["id_tq"];
$siswa = $_POST["siswa"];
$key = $_POST["nomorsoal"];
$tampil = $_POST["tampil"];

$query = mysql_query('select ragu,jawaban from tb_jawaban where id_tq = "'.$id_tq.'" && id_soal = "'.$key.'" && id_siswa = "'.$siswa.'"');
$cek = mysql_num_rows($query);
$array = mysql_fetch_array($query);

	if($cek > 0){
		if($array['ragu'] == '1'){
		mysql_query('update tb_jawaban set ragu = "0" where id_tq = "'.$id_tq.'" && id_soal = "'.$key.'" && id_siswa = "'.$siswa.'"');
		echo $tampil.' 0 '.$array['jawaban'];
		} else {
		mysql_query('update tb_jawaban set ragu = "1" where id_tq = "'.$id_tq.'" && id_soal = "'.$key.'" && id_siswa = "'.$siswa.'"');
		echo $tampil.' 1 '.$array['jawaban'];
		}
	}else{
		mysql_query('insert into tb_jawaban values ("", "'.$id_tq.'", "'.$key.'", "'.$siswa.'", "1", "")');
		echo $tampil.' 1 '.$array['jawaban'];
	}
?>