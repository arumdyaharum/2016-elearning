<?php 
include "../+koneksi.php";
$id_tq = $_POST["id_tq"];
$siswa = $_POST["siswa"];

$query_jwb = mysql_query('select * from tb_jawaban where id_tq = "'.$id_tq.'" && id_siswa = "'.$siswa.'"');
$query_soal = mysql_query('select * from tb_soal_pilgan where id_tq = "'.$id_tq.'"');
$query_ragu = mysql_query('select * from tb_jawaban where id_tq = "'.$id_tq.'" && id_siswa = "'.$siswa.'" && ragu = "1"');
$query_jwbn = mysql_query('select * from tb_jawaban where id_tq = "'.$id_tq.'" && id_siswa = "'.$siswa.'" && jawaban = ""');
$cek_jwb = mysql_num_rows($query_jwb);
$cek_soal = mysql_num_rows($query_soal);
$cek_ragu = mysql_num_rows($query_ragu);
$cek_jwbn = mysql_num_rows($query_jwbn);

if($cek_jwb == $cek_soal) {
	if($cek_ragu > 0) {
		echo 'ragu';
	} else if($cek_jwbn > 0) {
		echo 'jwbn';
	} else {
		echo 'ok';
	}
} else {
	echo 'jwbn';
}

?>