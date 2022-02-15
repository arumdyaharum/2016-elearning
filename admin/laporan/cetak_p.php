<?php
@session_start();
include ("../../+koneksi.php");
include ("fpdf.php");

$pdf = new FPDF('P','mm','A4');
$pdf->SetMargins(15,20,15);
$pdf->AddPage();

$pdf->Image('../../style/assets/img/logo2.png',15,18,16);

$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,5,'SMKN 48 JAKARTA','0','1','C',false);
$pdf->SetFont('Arial','i',8);
$pdf->Cell(0,5,'Alamat : Jl.RADIN INTEN II NO.3 BUARAN KLENDER DUREN SAWIT JAKARTA TIMUR','0','1','C',false);
$pdf->Cell(0,2,'Telp : (021) 8617467,Fax : (021) 86613397 - Web : http://smkn48jkt.sch.id','0','1','C',false);
$pdf->Ln(4);
$pdf->Cell(180,0.6,'','0','1','C',true);
$pdf->Ln(5);

if(@$_GET['data'] == "soal") {
	$id_tq = $_GET['id'];
	$pdf->SetFont('Arial','B',11);
	$sql_tq = mysqli_query($conn, "SELECT * FROM tb_topik_quiz JOIN tb_kelas ON tb_topik_quiz.id_kelas = tb_kelas.id_kelas JOIN tb_mapel ON tb_topik_quiz.id_mapel = tb_mapel.id WHERE id_tq = '$id_tq'") or die ($db->error);
	$data_tq = mysqli_fetch_array($sql_tq);
	$pdf->Cell(125,5,'Judul : '.$data_tq['judul'],0,0,'L');
	$pdf->Cell(0,5,'Kelas : '.$data_tq['ruang'].' - '.$data_tq['nama_kelas'],0,0,'L');
	$pdf->Ln(5);
	$pdf->Cell(125,5,'Mata Pelajaran : '.$data_tq['mapel'],0,0,'L');
	$pdf->Cell(0,5,'Waktu Pengerjaan : '.$data_tq['waktu_soal']/60 .' Menit',0,0,'L');
	$pdf->Ln(15);

	$no = 1;
	$pdf->SetWidths(array(7,120,35));
	$pdf->SetDrawColor(255);
	$pdf->Ln(4);
	$sql = mysql_query("SELECT * FROM tb_soal_pilgan WHERE id_tq = $id_tq ORDER BY id_pilgan ASC") or die ($db->error);
	while($data = mysql_fetch_array($sql)) {
		//if($data['jenis_kelamin'] == 'L') { $jk = "Laki-laki"; } else { $jk = "Perempuan"; }
		$pdf->SetFont('Arial','',8);
		$pdf->Row(array($no++.".",$data['pertanyaan'],''));
		$pdf->Ln(2);
		$pdf->Row(array('','A. '.$data['pil_a'],''));
		$pdf->Row(array('','B. '.$data['pil_b'],''));
		$pdf->Row(array('','C. '.$data['pil_c'],''));
		$pdf->Row(array('','D. '.$data['pil_d'],''));
		$pdf->Row(array('','E. '.$data['pil_e'],''));
		$pdf->Ln(5);
		/*$pdf->Cell(100,5,$no++.". ".$data['pertanyaan'],0,0,'L');
		//$pdf->Image("../img/gambar_soal_pilgan/soal/'.$id_tq.'_'.$data['gambarSoal'].'", , , 200, 150);
		if($data['gambarSoal'] != '') {
		$pdf->Cell(0,5,$pdf->Image('../img/gambar_soal_pilgan/soal/'/*.$id_tq.'_'* /.$data['gambarSoal'], $pdf->GetX(), $pdf->GetY(), 33),0,0,'L');} else { $pdf->Cell(0,5,'Tidak Ada Gambar',0,0,'L');}
		$pdf->Ln(5);
		$pdf->Cell(0,5,"A. ".$data['pil_a']." ".$data['gambarA'],0,0,'L');
		$pdf->Ln(5);
		$pdf->Cell(0,5,"B. ".$data['pil_b']." ".$data['gambarB'],0,0,'L');
		$pdf->Ln(5);
		$pdf->Cell(0,5,"C. ".$data['pil_c']." ".$data['gambarC'],0,0,'L');
		$pdf->Ln(5);
		$pdf->Cell(0,5,"D. ".$data['pil_d']." ".$data['gambarD'],0,0,'L');
		$pdf->Ln(5);
		$pdf->Cell(0,5,"E. ".$data['pil_e']." ".$data['gambarE'],0,0,'L');
		$pdf->Ln(10);*/
	}
} else if(@$_GET['data'] == "siswa") {
	$pdf->SetFont('Arial','B',11);
	if(@$_GET['id'] == "all") {
		$sql = mysql_query("SELECT * FROM tb_siswa JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas WHERE status = 'aktif' ORDER BY id_siswa ASC") or die ($db->error);
		$pdf->Cell(70,5,'Laporan Data Siswa yang Aktif','0','1','L',false);
	} else if(@$_GET['id'] != "all") {
		$sql = mysql_query("SELECT * FROM tb_siswa JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas WHERE status = 'aktif' AND tb_siswa.id_kelas = '$_GET[id]' ORDER BY nis ASC") or die ($db->error);
		$pdf->Cell(70,5,'Laporan Data Siswa per Kelas '.$_GET['kelas'].' yang Aktif','0','1','L',false);
	}
	$pdf->Ln(3);

	$pdf->SetFont('Arial','B',7);
	$pdf->Cell(7,6,'No.',1,0,'C');
	$pdf->Cell(9,6,'NISN',1,0,'C');
	$pdf->Cell(35,6,'Nama Lengkap',1,0,'C');
	$pdf->Cell(10,6,'Kelas',1,0,'C');
	$pdf->Cell(32,6,'TTL',1,0,'C');
	$pdf->Cell(10,6,'Kelamin',1,0,'C');
	$pdf->Cell(11,6,'Agama',1,0,'C');
	$pdf->Cell(25,6,'Nama Ayah',1,0,'C');
	$pdf->Cell(25,6,'Nama Ibu',1,0,'C');
	$pdf->Cell(19,6,'No. Telepon',1,0,'C');
	$pdf->Cell(38,6,'Email',1,0,'C');
	$pdf->Cell(44,6,'Alamat',1,0,'C');
	$pdf->Ln(2);
	$no = 1;
	$pdf->SetWidths(array(7,9,35,10,32,10,11,25,25,19,38,44));
	$pdf->Ln(4);
	while($data = mysql_fetch_array($sql)) {
		$pdf->SetFont('Arial','',7);
		$pdf->Row(array($no++.".",$data['nis'],$data['nama_lengkap'],$data['nama_kelas'],$data['tempat_lahir'].", ".tgl_indo($data['tgl_lahir']),$data['jenis_kelamin'],$data['agama'],$data['nama_ayah'],$data['nama_ibu'],$data['no_telp'],$data['email'],$data['alamat']));
	}
$pdf->Ln(25);
$pdf->SetLeftMargin(150);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,0,"Jakarta, ".tgl_indo(date('Y-m-d')),0,0,'L');
} else if(@$_GET['data'] == "quiz") {
	$id_tq = @$_GET['id_tq'];
	$sql_tq = mysql_query("SELECT * FROM tb_topik_quiz JOIN tb_mapel ON tb_topik_quiz.id_mapel = tb_mapel.id JOIN tb_pengajar ON tb_topik_quiz.pembuat = tb_pengajar.id_pengajar WHERE id_tq = '$id_tq'") or die($db->error);
	$data_tq = mysql_fetch_array($sql_tq);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(0,5,'Laporan Data Nilai Siswa ','0','1','L',false);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(100,5,'Judul : '.$data_tq['judul'],'0','0','L');
	$pdf->Cell(0,5,'Pengajar : '.$data_tq['nama_lengkap'],'0','0','L');
	$pdf->Ln(5);
	$pdf->Cell(0,5,'Mapel : '.$data_tq['mapel'],'0','0','L',false);
	$pdf->Ln(6);

	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(15,6,'No.',1,0,'C');
	$pdf->Cell(80,6,'Nama Siswa',1,0,'C');
	$pdf->Cell(45,6,'Kelas',1,0,'C');
	$pdf->Cell(40,6,'Hasil',1,0,'C');;
	$pdf->Ln(2);
	$no = 1;
	$sql_siswa_mengikuti_tes = mysql_query("SELECT * FROM tb_nilai_pilgan JOIN tb_siswa ON tb_nilai_pilgan.id_siswa = tb_siswa.id_siswa JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas WHERE id_tq = '$id_tq' ORDER BY  nama_kelas, nama_lengkap ASC") or die ($db->error);
	while($data_siswa_mengikuti_tes = mysql_fetch_array($sql_siswa_mengikuti_tes)) {
		$pdf->Ln(4);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(15,4,$no++.".",1,0,'C');
		$pdf->Cell(80,4,$data_siswa_mengikuti_tes['nama_lengkap'],1,0,'L');
		$pdf->Cell(45,4,$data_siswa_mengikuti_tes['ruang'].' - '.$data_siswa_mengikuti_tes['nama_kelas'],1,0,'C');
			// $sql_pilgan = mysql_query("SELECT * FROM tb_nilai_pilgan WHERE id_siswa = '$data_siswa_mengikuti_tes[id_siswa]' AND id_tq = '$id_tq'") or die ($db->error);
	    //	$data_pilgan = mysql_fetch_array($sql_pilgan);
	      //  $sql_jwb = mysql_query("SELECT * FROM tb_jawaban WHERE id_siswa = '$data_siswa_mengikuti_tes[id_siswa]' AND id_tq = '$id_tq'") or die ($db->error);
	    	//$sql_essay = mysql_query("SELECT * FROM tb_nilai_essay WHERE id_siswa = '$data_siswa_mengikuti_tes[id_siswa]' AND id_tq = '$id_tq'") or die ($db->error);
	    	//$data_essay = mysql_fetch_array($sql_essay);
            $total = "";
		$pdf->Cell(40,4,$data_siswa_mengikuti_tes['presentase'],1,0,'C');
	}
$pdf->Ln(25);
$pdf->SetLeftMargin(150);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,0,"Jakarta, ".tgl_indo(date('Y-m-d')),0,0,'L');
}

$pdf->Output(@$_GET['filename'],'');
?>