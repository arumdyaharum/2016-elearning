<div class="row">
    <div class="col-md-12">
        <h4 class="page-head-line">Materi Mata Pelajaran</h4>
    </div>
</div>

<?php
//$db = mysql_connect("localhost", "elea3597_smk48", "smkn48jkt..", "elea3597_smkn48jkt_db");
$db = mysql_connect("localhost", "root", "");
$db_connet = mysql_select_db("skripsi");
if(@$_GET['action'] == '') { ?>
	<div class="row">
	    <div class="col-md-12">
	        <div class="panel panel-default">
	            <div class="panel-heading">Data Materi Mata Pelajaran</div>
	            <div class="panel-body">
	                <div class="table-responsive">
	                    <table class="table table-striped table-bordered table-hover" id='table'>
	                        <thead>
	                            <tr>
	                                <th>Nomor</th>
	                                <th width="104">Mata Pelajaran</th>
                                  <th>Aksi</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        <?php
	                        $no = 1;
	                        $sql_mapel = mysql_query("SELECT * FROM tb_mapel ORDER BY mapel") or die ($db->error);
	                        while($data_mapel = mysql_fetch_array($sql_mapel)) { ?>
	                            <tr>
	                                <td width="46" align="center"><?php echo $no++; ?></td>
                                  <td><?php echo $data_mapel['mapel']; ?></td>
	                                <td width="181" align="center">
	                                	<a href="?page=materi&action=lihatmateri&id_mapel=<?php echo $data_mapel['id']; ?>" class="btn btn-primary btn-xs">Lihat Materi</a>	                                </td>
                              </tr>
	                        	<?php
	                        } ?>
	                        </tbody>
	                    </table>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
<?php
} else if(@$_GET['action'] == 'lihatmateri') { ?>
	<div class="row">
	    <div class="col-md-12">
	        <div class="panel panel-default">
	            <div class="panel-heading">Lihat Data Materi Mata Pelajaran</div>
	            <div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
						    <thead>
						        <tr>
						            <th>Nomor</th>
						            <th>Judul Materi</th>
						            <th>Nama File</th>
						            <th>Tanggal Posting</th>
						            <th>Pembuat</th>
						            <th>Opsi</th>
						        </tr>
						    </thead>
						    <tbody id="materi">
						    <?php
						    $sql_siswa = mysql_query("SELECT * FROM tb_siswa WHERE id_siswa = '$_SESSION[siswa]'") or die($db->error);
						    $data_siswa = mysql_fetch_array($sql_siswa);
						    $no = 1;
						    $sql_materi = mysql_query("SELECT * FROM tb_file_materi WHERE id_mapel = '$_GET[id_mapel]' AND id_kelas = '$data_siswa[id_kelas]'") or die ($db->error);
						    if(mysql_num_rows($sql_materi) > 0) {
							    while($data_materi = mysql_fetch_array($sql_materi)) { ?>
							        <tr>
							            <td width="40px" align="center"><?php echo $no++; ?></td>
							            <td id="judul"><?php echo $data_materi['judul']; ?></td>
							            <td><?php echo $data_materi['nama_file']; ?></td>
							            <td><?php echo $data_materi['tgl_posting']; ?></td>
							            <td>
							            	<?php
											if($data_materi['pembuat'] == 'admin') {
												echo "Admin";
											} else {
												$sql_pengajar = mysql_query("SELECT * FROM tb_pengajar WHERE id_pengajar = '$data_materi[pembuat]'") or die($db->error);
												$data_pengajar = mysql_fetch_array($sql_pengajar);
												echo $data_pengajar['nama_lengkap'];
											} ?>
							            </td>
							            <td align="center">
							            	<a href="./admin/file_materi/<?php echo $data_materi['nama_file']; ?>" id="klik" isi="<?php echo $data_materi['id_materi']; ?>" class="btn btn-info btn-xs">Lihat / Download</a>
							            </td>
							        </tr>
							    	<?php
							    } 
							    } else {
							    	echo '<tr><td colspan="7" align="center">Data tidak ditemukan</td></tr>';
						    	} ?>
						    </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}
?>