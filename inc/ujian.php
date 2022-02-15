<?php
$id = @$_GET['id'];
$no = 1;

if(@$_GET['action'] != 'kerjakansoal') { ?>
<div class="row">
    <div class="col-md-12">
        <h4 class="page-head-line">Ujian yang Aktif</h4>
    </div>
</div>
<?php
}

if(@$_GET['action'] == '') { ?>
<?php
$sql_tq = mysql_query("SELECT * FROM tb_panitia_tq JOIN tb_pengajar ON tb_panitia_tq.pembuat = tb_pengajar.id_pengajar JOIN tb_mapel ON tb_panitia_tq.id_mapel = tb_mapel.id WHERE FIND_IN_SET($data_terlogin[id_kelas], id_kelas) AND tb_panitia_tq.status = 'aktif'") or die ($db->error);
if(mysql_num_rows($sql_tq) > 0) {
while($data_tq = mysql_fetch_array($sql_tq)){ ?>
	<div class="row">
	    <div class="col-md-12">
	        <div class="panel panel-default">
	            <div class="panel-heading"><?php echo $data_tq['judul'];?></div>
	            <div class="panel-body">
					<table width="100%" align="center">
						<tr>
							<td width="20%">Mata Pelajaran</td>
							<td width="5%">:</td>
							<td width="60%"><?php echo $data_tq['mapel'];?></td>
							<td valign="center" rowspan="5"><a href="?page=ujian&action=infokerjakan&id_tq=<?php echo $data_tq['id_tq']; ?>" class="btn btn-primary">Kerjakan Soal</a>
							</td>
						</tr>
						<tr>
							<td>Waktu Pengerjaan</td>
							<td>:</td>
							<td><?php echo $data_tq['waktu_soal'] / 60;?> menit</td>
						</tr>
						<tr>
							<td>Pembuat</td>
							<td>:</td>
							<td><?php echo $data_tq['nama_lengkap'];?></td>
						</tr>
						<tr>
							<td>Tanggal Pembuatan</td>
							<td>:</td>
							<td><?php echo tgl_indo($data_tq['tgl_buat']);?></td>
						</tr>
						<tr>
							<td>Info</td>
							<td>:</td>
							<td><?php echo $data_tq['info'];?></td>
						</tr>
					</table>
	            </div>
	        </div>
	    </div>
	</div>
<?php
}} else {?>
<div class="alert alert-danger">Tidak ada ujian yang aktif</div>
<?php
}} else if(@$_GET['action'] == 'infokerjakan') { ?>
	<div class="row">
	    <div class="col-md-12">
	        <div class="panel panel-default">
	            <div class="panel-heading">Informasi dan Instruksi Ujian</div>
	            <div class="panel-body">
	            <?php
	            $sql_nilai = mysql_query("SELECT * FROM tb_panitia_nilai WHERE id_tq = '$_GET[id_tq]' AND id_siswa = '$_SESSION[siswa]'") or die ($db->error);
				$ngecek_jawab = mysql_query("SELECT * FROM tb_panitia_jawab WHERE id_tq = '$_GET[id_tq]' AND id_siswa = '$_SESSION[siswa]'");
				$ngecek_jawaban = mysql_num_rows(mysql_query("SELECT * FROM tb_panitia_jawab WHERE id_tq = '$_GET[id_tq]' AND id_siswa = '$_SESSION[siswa]' AND NOT (jawaban = '')"));
				$ngecek_ragu = mysql_num_rows(mysql_query("SELECT * FROM tb_panitia_jawab WHERE id_tq = '$_GET[id_tq]' AND id_siswa = '$_SESSION[siswa]' AND ragu = '1'"));
				$ngecek_kapan = mysql_query("SELECT * FROM tb_panitia_kapan WHERE id_tq = '$_GET[id_tq]' AND id_siswa = '$_SESSION[siswa]'");
				$data_ngecek_kapan = mysql_fetch_array($ngecek_kapan);
				$ngecek_tq = mysql_fetch_array(mysql_query("SELECT * FROM tb_panitia_tq WHERE id_tq = '$_GET[id_tq]'"));
	            if(mysql_num_rows($sql_nilai) > 0) {
	            	echo "Anda sudah mengerjakan ujian ini, silahkan lihat nilai Anda di halaman nilai.";
	            } else { 
				if(mysql_num_rows($ngecek_jawab) > 0){?>
				Status pengerjaan : Masih mengerjakan<br>
				Soal Terjawab : <?php echo $ngecek_jawaban;?><br>
				Ragu : <?php echo $ngecek_ragu;?>
				<?php } else {?>
				Status pengerjaan : Soal Baru<br>
				Soal Terjawab : 0<br>
				Ragu : 0
				<?php }?>
				<hr>
					1. &nbsp; Baca dengan seksama dan teliti sebelum mengerjakan Ujian.<br />
					2. &nbsp; Pastikan koneksi anda terjamin dan bagus.<br />
					3. &nbsp; Pilih browser yang versi terbaru.<br />
					4. &nbsp; Hubungi panitia jika terjadi masalah selama mengerjakan ujian ini.
					<?php
				} ?>
	            </div>
	            <div class="panel-footer">
					<?php
					if(mysql_num_rows($sql_nilai) > 0) { ?>
						<a href="?page=quiz" class="btn btn-primary">Kembali</a>
						<?php
					} else {
						$sql_cek_soal_pilgan = mysql_query("SELECT * FROM tb_panitia_soal WHERE id_tq = '$_GET[id_tq]'") or die ($db->error);
						if(mysql_num_rows($sql_cek_soal_pilgan) > 0) { ?>
							<a onclick="setCookie(<?php if(mysql_num_rows($ngecek_kapan)>0){echo "'waktux',$data_ngecek_kapan[waktu],365";}else{echo "'waktux',$ngecek_tq[waktu_soal],365";}?>);" href="ujian.php?id_tq=<?php echo @$_GET['id_tq']; ?>" class="btn btn-primary">Mulai Mengerjakan</a>
						<?php
						} else { ?>
							<a onclick="alert('Data soal tidak ditemukan, mungkin karena belum dibuat. Silahkan hubungi guru yang bersangkutan');" class="btn btn-primary">Mulai Mengerjakan</a>
						<?php
						} ?>
						<a href="?page=quiz" class="btn btn-primary">Kembali</a>
					<?php
					} ?>
				</div>
	        </div>
	    </div>
	</div>
	<?php
} ?>
<script>
function setCookie(c_name,value,expiredays){
    var exdate=new Date();
    exdate.setDate(exdate.getDate()+expiredays);
    document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
}
</script>