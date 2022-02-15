<?php
include ("+koneksi.php");

$id_tq = $_GET['id_tq'];

$query = mysqli_query($conn, "select * from tb_jawaban where id_tq = '$_GET[id_tq]' group by id_siswa order by id_siswa DESC");
$count = mysqli_num_rows($query);

echo "Jumlah : ".$count."<br>";
$he = 1;
?>

<h3>Jawaban yang masuk ke database</h3>
Berdoa saja nilainya bisa naik. Ada kesalahan teknis. o:)<br>
<table>
	<tr>
		<td>No.</td>
		<td>id_siswa</td>
		<td>Nama Lengkap</td>
		<td>Jumlah jawaban</td>
		<td>Nilai</td>
	</tr>
	<?php
	while($data = mysqli_fetch_array($query)){
	$data2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_siswa WHERE id_siswa = '$data[id_siswa]'"));
	$data3 = mysqli_fetch_array(mysqli_query($conn, "Select count(jawaban) AS jawab from tb_jawaban WHERE id_siswa = '$data[id_siswa]' && id_tq = $id_tq"));
	$data4 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_nilai_pilgan WHERE id_siswa = '$data[id_siswa]' && id_tq = $id_tq"));
?>
	<tr>
		<td><?php echo $he++;?></td>
		<td><?php echo $data['id_siswa'];?></td>
		<td><?php echo $data2['nama_lengkap'];?></td>
		<td><?php echo $data3['jawab'];?></td>
		<td><?php echo $data4['presentase'];?></td?>
	</tr>
	<?php }?>
</table>