<?php
@session_start();
include ("../../+koneksi.php");
include ("fpdf.php");

$pdf = new FPDF('L','mm','A4');
$pdf->SetMargins(15,20,15);
$pdf->AddPage();

$pdf->Image('../../style/assets/img/logo2.png',15,18,16);

$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,5,'SMKN 48 JAKARTA','0','1','C',false);
$pdf->SetFont('Arial','i',8);
$pdf->Cell(0,5,'Alamat : Jl.RADIN INTEN II NO.3 BUARAN KLENDER DUREN SAWIT JAKARTA TIMUR','0','1','C',false);
$pdf->Cell(0,2,'Telp : (021) 8617467,Fax : (021) 86613397 - Web : http://smkn48jkt.sch.id','0','1','C',false);
$pdf->Ln(3);
$pdf->Cell(265,0.6,'','0','1','C',true);
$pdf->Ln(5);

if(@$_GET['data'] == "pengajar") {
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(50,5,'Laporan Data Tenaga Pengajar','0','1','L',false);
	$pdf->Ln(3);

	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(17,6,'No.',1,0,'C');
	$pdf->Cell(35,6,'NIP/NIKKI',1,0,'C');
	$pdf->Cell(75,6,'Nama Lengkap',1,0,'C');
	$pdf->Cell(27,6,'Jenis Kelamin',1,0,'C');
	$pdf->Cell(90,6,'Alamat Pengajar',1,0,'C');
	$pdf->Cell(20,6,'Status',1,0,'C');
	$pdf->Ln(2);
	$no = 1;
	$pdf->SetWidths(array(17,35,75,27,90,20));
	$pdf->Ln(4);
	$sql = mysql_query("SELECT * FROM tb_pengajar ORDER BY id_pengajar ASC") or die ($db->error);
	while($data = mysql_fetch_array($sql)) {
		if($data['jenis_kelamin'] == 'L') { $jk = "Laki-laki"; } else { $jk = "Perempuan"; }
		$pdf->SetFont('Arial','',8);
		$pdf->Row(array($no++.".",$data['nip'],$data['nama_lengkap'],$jk,$data['alamat'],ucfirst($data['status'])));
	}
} else if(@$_GET['data'] == "siswa") {
	$pdf->SetFont('Arial','B',11);
	if(@$_GET['id'] == "all") {
		$sql = mysql_query("SELECT * FROM tb_siswa JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas WHERE status = 'aktif' ORDER BY id_siswa ASC") or die ($db->error);
		$pdf->Cell(70,5,'Laporan Data Siswa yang Aktif','0','1','L',false);
	} else if(@$_GET['id'] != "all") {
		$sql = mysql_query("SELECT * FROM tb_siswa JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas WHERE status = 'aktif' AND tb_siswa.id_kelas = '$_GET[id]' ORDER BY nis ASC") or die ($db->error);
		$pdf->Cell(70,5,'Laporan Data Siswa per kelas '.$_GET['kelas'].' yang Aktif','0','1','L',false);
	}
	$pdf->Ln(3);

	$pdf->SetFont('Arial','B',7);
	$pdf->Cell(7,6,'No.',1,0,'C');
	$pdf->Cell(20,6,'NISN',1,0,'C');
	$pdf->Cell(40,6,'Nama Lengkap',1,0,'C');
	$pdf->Cell(15,6,'Kelas',1,0,'C');
	$pdf->Cell(35,6,'TTL',1,0,'C');
	$pdf->Cell(13,6,'Kelamin',1,0,'C');
	$pdf->Cell(25,6,'Email',1,0,'C');
	$pdf->Cell(25,6,'No. Telepon',1,0,'C');
	$pdf->Cell(100,6,'Alamat',1,0,'C');
	$pdf->Ln(2);
	$no = 1;
	$pdf->SetWidths(array(7,20,40,15,35,13,25,25,100));
	$pdf->Ln(4);
	while($data = mysql_fetch_array($sql)) {
		$pdf->SetFont('Arial','',7);
		$pdf->Row(array($no++.".",$data['nis'],$data['nama_lengkap'],$data['nama_kelas'],$data['tempat_lahir'].", ".tgl_indo($data['tgl_lahir']),$data['jenis_kelamin'],$data['email'],$data['no_telp'],$data['alamat']));
	}
} else if(@$_GET['data'] == "siswaregistrasi") {
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(50,5,'Laporan Data Siswa yang Mendaftar dan Belum Dikonfirmasi','0','1','L',false);
	$pdf->Ln(3);

	$pdf->SetFont('Arial','B',7);
	$pdf->Cell(7,6,'No.',1,0,'C');
	$pdf->Cell(20,6,'NISN',1,0,'C');
	$pdf->Cell(35,6,'Nama Lengkap',1,0,'C');
	$pdf->Cell(23,6,'Kelas',1,0,'C');
	$pdf->Cell(35,6,'TTL',1,0,'C');
	$pdf->Cell(13,6,'Kelamin',1,0,'C');
	$pdf->Cell(25,6,'No. Telepon',1,0,'C');
	$pdf->Cell(105,6,'Alamat',1,0,'C');
	$pdf->Ln(2);
	$no = 1;
	$pdf->SetWidths(array(7,20,35,23,35,13,25,105));
	$pdf->Ln(4);
	$sql = mysql_query("SELECT * FROM tb_siswa JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas WHERE status = 'tidak aktif' ORDER BY id_siswa ASC") or die ($db->error);
	while($data = mysql_fetch_array($sql)) {
		$pdf->SetFont('Arial','',7);
		$pdf->Row(array($no++.".",$data['nis'],$data['nama_lengkap'],$data['nama_kelas'],$data['tempat_lahir'].", ".tgl_indo($data['tgl_lahir']),$data['jenis_kelamin'],$data['no_telp'],$data['alamat']));
	}
} else if(@$_GET['data'] == "mapel") {
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(50,5,'Laporan Data Mata Pelajaran','0','1','L',false);
	$pdf->Ln(3);

	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(10,6,'No.',1,0,'C');
	$pdf->Cell(40,6,'Kode Mata Pelajaran',1,0,'C');
	$pdf->Cell(60,6,'Nama Mata Pelajaran',1,0,'C');
	$pdf->Ln(2);
	$no = 1;
	$sql = mysql_query("SELECT * FROM tb_mapel") or die ($db->error);
	while($data = mysql_fetch_array($sql)) {
		$pdf->Ln(4);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(10,4,$no++.".",1,0,'C');
		$pdf->Cell(40,4,$data['kode_mapel'],1,0,'C');
		$pdf->Cell(60,4,$data['mapel'],1,0,'L');
	}
} else if(@$_GET['data'] == "kelas") {
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(50,5,'Laporan Daftar Kelas, Ruang, Wali dan Ketua Masing-masing Kelas','0','1','L',false);
	$pdf->Ln(3);

	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(10,6,'No.',1,0,'C');
	$pdf->Cell(30,6,'Nama Kelas',1,0,'C');
	$pdf->Cell(25,6,'Ruang',1,0,'C');
	$pdf->Cell(60,6,'Wali Kelas',1,0,'C');
	$pdf->Cell(60,6,'Ketua Kelas',1,0,'C');
	$pdf->Ln(2);
	$no = 1;
	$sql = mysql_query("SELECT * FROM tb_kelas") or die ($db->error);
	while($data = mysql_fetch_array($sql)) {
		$pdf->Ln(4);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(10,4,$no++.".",1,0,'C');
		$pdf->Cell(30,4,$data['nama_kelas'],1,0,'C');
		$pdf->Cell(25,4,$data['ruang'],1,0,'C');
		$sql_tampil_guru = tampil_per_id("tb_pengajar", "id_pengajar = '$data[wali_kelas]'");
        $data_tampil_guru = mysql_fetch_array($sql_tampil_guru);
        $cek_tampil_guru = mysql_num_rows($sql_tampil_guru);
        if($cek_tampil_guru > 0) {
        	$pdf->Cell(60,4,$data_tampil_guru['nama_lengkap'],1,0,'L');
        } else {
            $pdf->Cell(60,4,"Belum diatur",1,0,'L');
        }
		
		$sql_tampil_siswa = tampil_per_id("tb_siswa", "id_siswa = '$data[ketua_kelas]'");
	    $data_tampil_siswa = mysql_fetch_array($sql_tampil_siswa);
	    $cek_tampil_siswa = mysql_num_rows($sql_tampil_siswa);
	    if($cek_tampil_siswa > 0) {
	    	$pdf->Cell(60,4,$data_tampil_siswa['nama_lengkap'],1,0,'L');
	    } else {
	        $pdf->Cell(60,4,"Belum diatur",1,0,'L');
	    }
	}
} else if(@$_GET['data'] == "materi") {
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(50,5,'Laporan Data Materi','0','1','L',false);
	$pdf->Ln(3);

	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(10,6,'No.',1,0,'C');
	$pdf->Cell(45,6,'Judul',1,0,'C');
	$pdf->Cell(20,6,'Kelas',1,0,'C');
	$pdf->Cell(40,6,'Mapel',1,0,'C');
	$pdf->Cell(75,6,'Nama File',1,0,'C');
	$pdf->Cell(30,6,'Tanggal Posting',1,0,'C');
	$pdf->Cell(30,6,'Pembuat',1,0,'C');
	$pdf->Cell(15,6,'Dilihat',1,0,'C');
	$pdf->Ln(2);
	$no = 1;
	if(@$_SESSION[admin]) {
        $sql_materi = mysql_query("SELECT * FROM tb_file_materi JOIN tb_kelas ON tb_file_materi.id_kelas = tb_kelas.id_kelas JOIN tb_mapel ON tb_file_materi.id_mapel = tb_mapel.id") or die($db->error);
    } else if(@$_SESSION[pengajar]) {
    	$sql_materi = mysql_query("SELECT * FROM tb_file_materi JOIN tb_kelas ON tb_file_materi.id_kelas = tb_kelas.id_kelas JOIN tb_mapel ON tb_file_materi.id_mapel = tb_mapel.id WHERE pembuat = '$_SESSION[pengajar]'") or die($db->error);
    }
	while($data = mysql_fetch_array($sql_materi)) {
		$pdf->Ln(4);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(10,4,$no++.".",1,0,'C');
		$pdf->Cell(45,4,$data['judul'],1,0,'C');
		$pdf->Cell(20,4,$data['nama_kelas'],1,0,'C');
		$pdf->Cell(40,4,$data['mapel'],1,0,'L');
		$pdf->Cell(75,4,$data['nama_file'],1,0,'L');
		$pdf->Cell(30,4,tgl_indo($data['tgl_posting']),1,0,'C');
		if($data['pembuat'] == 'admin') {
			$pdf->Cell(30,4,"Admin",1,0,'L');
		} else {
			$sql_pengajar = mysql_query("SELECT * FROM tb_pengajar WHERE id_pengajar = '$data[pembuat]'") or die($db->error);
			$data_pengajar = mysql_fetch_array($sql_pengajar);
			$pdf->Cell(30,4,$data_pengajar['nama_lengkap'],1,0,'L');
		}
		$pdf->Cell(15,4,$data['hits']." kali",1,0,'C');
	}
} else if(@$_GET['data'] == "topikquiz") {
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(50,5,'Laporan Data Topik Quiz / Tugas','0','1','L',false);
	$pdf->Ln(3);

	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(10,6,'No.',1,0,'C');
	$pdf->Cell(50,6,'Judul',1,0,'C');
	$pdf->Cell(15,6,'Kelas',1,0,'C');
	$pdf->Cell(40,6,'Mapel',1,0,'C');
	$pdf->Cell(27,6,'Tanggal Buat',1,0,'C');
	if(@$_SESSION['admin']) {
		$pdf->Cell(25,6,'Pembuat',1,0,'C');
	}
	$pdf->Cell(20,6,'Waktu Soal',1,0,'C');
	$pdf->Cell(60,6,'Info',1,0,'C');
	$pdf->Cell(18,6,'Status',1,0,'C');
	$pdf->Ln(2);
	$no = 1;
	if(@$_SESSION[admin]) {
	    $sql_topik = mysql_query("SELECT * FROM tb_topik_quiz JOIN tb_kelas ON tb_topik_quiz.id_kelas = tb_kelas.id_kelas JOIN tb_mapel ON tb_topik_quiz.id_mapel = tb_mapel.id ORDER BY tgl_buat ASC") or die ($db->error);
	} else if(@$_SESSION[pengajar]) {
	    $sql_topik = mysql_query("SELECT * FROM tb_topik_quiz JOIN tb_kelas ON tb_topik_quiz.id_kelas = tb_kelas.id_kelas JOIN tb_mapel ON tb_topik_quiz.id_mapel = tb_mapel.id WHERE pembuat != 'admin' AND pembuat = '$_SESSION[pengajar]' ORDER BY tgl_buat ASC") or die ($db->error);
	} 
	while($data = mysql_fetch_array($sql_topik)) {
		$pdf->Ln(4);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(10,4,$no++.".",1,0,'C');
		$pdf->Cell(50,4,$data['judul'],1,0,'L');
		$pdf->Cell(15,4,$data['nama_kelas'],1,0,'C');
		$pdf->Cell(40,4,$data['mapel'],1,0,'L');
		$pdf->Cell(27,4,tgl_indo($data['tgl_buat']),1,0,'C');
		if(@$_SESSION['admin']) {
            if($data['pembuat'] == 'admin') {
                $pdf->Cell(25,4,"Admin",1,0,'L');
            } else {
                $sql1 = mysql_query("SELECT * FROM tb_pengajar WHERE id_pengajar = '$data[pembuat]'") or die($db->error);
                $data1 = mysql_fetch_array($sql1);
                $pdf->Cell(25,4,$data1['nama_lengkap'],1,0,'L');
            }
        }
		$pdf->Cell(20,4,$data['waktu_soal'] / 60 ." menit",1,0,'L');
		$pdf->Cell(60,4,$data['info'],1,0,'L');
		$pdf->Cell(18,4,ucfirst($data['status']),1,0,'C');
	}
} else if(@$_GET['data'] == "berita") {
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(50,5,'Laporan Data Berita','0','1','L',false);
	$pdf->Ln(3);

	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(10,6,'No.',1,0,'C');
	$pdf->Cell(25,6,'Judul',1,0,'C');
	$pdf->Cell(150,6,'Isi',1,0,'C');
	$pdf->Cell(27,6,'Tanggal Posting',1,0,'C');
	$pdf->Cell(35,6,'Penerbit',1,0,'C');
	$pdf->Cell(15,6,'Status',1,0,'C');
	$pdf->Ln(2);
	$no = 1;
	if(@$_SESSION['admin']) {
        $sql_berita = mysql_query("SELECT * FROM tb_berita") or die($db->error);
    } else if(@$_SESSION['pengajar']) {
    	$sql_berita = mysql_query("SELECT * FROM tb_berita WHERE penerbit = '$_SESSION[pengajar]'") or die($db->error);
    }
	while($data = mysql_fetch_array($sql_berita)) {
		$pdf->Ln(4);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(10,4,$no++.".",1,0,'C');
		$pdf->Cell(25,4,$data['judul'],1,0,'L');
		$pdf->Cell(150,4,substr($data['isi'], 0, 100)." ...",1,0,'L');
		$pdf->Cell(27,4,tgl_indo($data['tgl_posting']),1,0,'C');
		if($data['penerbit'] == 'admin') {
			$pdf->Cell(35,4,'Admin',1,0,'L');
		} else {
			$sql_pengajar = mysql_query("SELECT * FROM tb_pengajar WHERE id_pengajar = '$data[penerbit]'") or die($db->error);
			$data_pengajar = mysql_fetch_array($sql_pengajar);
			$pdf->Cell(35,4,$data_pengajar['nama_lengkap'],1,0,'L');
		}
		$pdf->Cell(15,4,ucfirst($data['status']),1,0,'C');
	}
} else if(@$_GET['data'] == "quiz") {
	$id_tq = @$_GET['id_tq'];
	$sql_tq = mysql_query("SELECT * FROM tb_topik_quiz JOIN tb_mapel ON tb_topik_quiz.id_mapel = tb_mapel.id WHERE id_tq = '$id_tq'") or die($db->error);
	$data_tq = mysql_fetch_array($sql_tq);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(50,5,'Laporan Data Siswa Beserta Nilainya yang Mengikuti Ujian','0','1','L',false);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(50,5,'Judul : '.$data_tq['judul'],'0','1','L',false);
	$pdf->Cell(50,5,'Mapel : '.$data_tq['mapel'],'0','1','L',false);
	$pdf->Ln(3);

	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(10,6,'No.',1,0,'C');
	$pdf->Cell(80,6,'Nama Siswa',1,0,'C');
	$pdf->Cell(15,6,'Kelas',1,0,'C');
	$pdf->Cell(20,6,'Hasil',1,0,'C');;
	$pdf->Ln(2);
	$no = 1;
	$sql_siswa_mengikuti_tes = mysql_query("SELECT * FROM tb_nilai_pilgan JOIN tb_siswa ON tb_nilai_pilgan.id_siswa = tb_siswa.id_siswa JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas WHERE id_tq = '$id_tq' ORDER BY  nama_kelas, nama_lengkap ASC") or die ($db->error);
	while($data_siswa_mengikuti_tes = mysql_fetch_array($sql_siswa_mengikuti_tes)) {
		$pdf->Ln(4);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(10,4,$no++.".",1,0,'C');
		$pdf->Cell(80,4,ucwords(strtolower($data_siswa_mengikuti_tes['nama_lengkap'])),1,0,'L');
		$pdf->Cell(15,4,$data_siswa_mengikuti_tes['nama_kelas'],1,0,'C');
			$sql_pilgan = mysql_query("SELECT * FROM tb_nilai_pilgan WHERE id_siswa = '$data_siswa_mengikuti_tes[id_siswa]' AND id_tq = '$id_tq'") or die ($db->error);
	    	$data_pilgan = mysql_fetch_array($sql_pilgan);
	        $sql_jwb = mysql_query("SELECT * FROM tb_jawaban WHERE id_siswa = '$data_siswa_mengikuti_tes[id_siswa]' AND id_tq = '$id_tq'") or die ($db->error);
	    	//$sql_essay = mysql_query("SELECT * FROM tb_nilai_essay WHERE id_siswa = '$data_siswa_mengikuti_tes[id_siswa]' AND id_tq = '$id_tq'") or die ($db->error);
	    	//$data_essay = mysql_fetch_array($sql_essay);
            $total = "";
		$pdf->Cell(20,4,$data_pilgan['presentase'],1,0,'C');
	}
}

$pdf->Ln(30);
$pdf->SetLeftMargin(230);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,0,"Jakarta, ".tgl_indo(date('Y-m-d')),0,0,'L');

$pdf->Output(@$_GET['filename'],'');
?>