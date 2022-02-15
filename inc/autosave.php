<?php
include "../+koneksi.php";
$id_tq = $_POST["id_tq"];
$siswa = $_POST["siswa"];
$waktu = $_POST["kapan"];
$tampil = $_POST["tampil"];

$cek_waktu = mysql_num_rows(mysql_query("select null from tb_kapan where id_tq = '".$id_tq."' && id_siswa = '".$siswa."'"));

if($cek_waktu > 0){
	mysql_query('update tb_kapan set waktu = "'.$waktu.'" where id_tq = "'.$id_tq.'" && id_siswa = "'.$siswa.'"');
}else{
	mysql_query('insert into tb_kapan values ("", "'.$id_tq.'", "'.$siswa.'", "'.$waktu.'")');
}
	  
foreach($_POST['soal_pilgan'] as $key => $value){
	$cek = mysql_num_rows(mysql_query('select * from tb_jawaban where id_tq = "'.$id_tq.'" && id_soal = "'.$key.'" && id_siswa = "'.$siswa.'"'));
	if($cek > 0){
		mysql_query('update tb_jawaban set jawaban = "'.$value.'" where id_tq = "'.$id_tq.'" && id_soal = "'.$key.'" && id_siswa = "'.$siswa.'"');
	}else{
		mysql_query('insert into tb_jawaban values ("", "'.$id_tq.'", "'.$key.'", "'.$siswa.'", "0", "'.$value.'")');
		echo $tampil;
	}
}
?>