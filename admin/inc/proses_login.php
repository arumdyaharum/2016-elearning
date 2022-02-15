<?php
@session_start();
include "../../+koneksi.php";

$user = @mysqli_real_escape_string($conn, $_POST['user']);
$pass = @mysqli_real_escape_string($conn, $_POST['pass']);

$sql = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '$user' AND password = md5('$pass')") or die ($db->error);
$cek = mysqli_num_rows($sql);
$data = mysqli_fetch_array($sql);
$keluar = array();
if($cek > 0) {
	$keluar['status'] = "sukses";
    $keluar['add'] = "";
	echo json_encode($keluar);
	@$_SESSION['admin'] = $data['id_admin'];
} else {
	$sql1 = mysqli_query($conn, "SELECT * FROM tb_pengajar WHERE username = '$user' AND password = md5('$pass')") or die ($db->error);
	$data1 = mysqli_fetch_array($sql1);
	$cek1 = mysqli_num_rows($sql1);
	if($cek1 > 0) {
		if($data1['status'] == 'aktif') {
			$keluar['status'] = "sukses";
			$keluar['add'] = $data1['img'];
			echo json_encode($keluar);
			@$_SESSION['pengajar'] = $data1['id_pengajar'];
		} else {
			$keluar['status'] = "akun tidak aktif";
			$keluar['add'] = "";
			echo json_encode($keluar);
		}
	} else {
			$keluar['status'] = "gagal";
			$keluar['add'] = "";
			echo json_encode($keluar);
	}
}
?>