<?php
@session_start();
include "+koneksi.php";

$id_tq = @$_GET['id_tq'];
$no = 1;
$no2 = 1;
$sql_tq = mysqli_query($conn, "SELECT tb_topik_quiz.judul,tb_mapel.mapel,tb_topik_quiz.waktu_soal FROM tb_topik_quiz JOIN tb_mapel ON tb_topik_quiz.id_mapel = tb_mapel.id WHERE id_tq = '$id_tq'") or die ($conn->error);
$data_tq = mysqli_fetch_array($sql_tq);

$cek_ragu2 = mysqli_query($conn, "SELECT id FROM tb_jawaban WHERE ragu = '1' AND id_tq = '$id_tq' AND id_siswa = $_SESSION[siswa]");
while($data_cek_ragu2 = mysqli_fetch_array($cek_ragu2)){
mysqli_query($conn, "UPDATE tb_jawaban SET ragu = '0' WHERE id = '$data_cek_ragu2[id]'");
//echo "reset selesai";
}
?>
<script src="style/assets/js/jquery-1.11.1.js"></script>
<script src="style/assets/js/jquery.autoSave.min.js"></script>
<script src="style/assets/js/bootstrap.js"></script>
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<!--script>//tinymce.init({ selector:'textarea' });
tinymce.init({
  selector: "textarea",  // change this value according to your HTML
  plugins: "charmap",
  toolbar: "charmap"
});
</script-->
<script>
var waktunya;
<?php
$waktunya = mysqli_query($conn, "Select waktu from tb_kapan where id_tq = $id_tq AND id_siswa = $_SESSION[siswa]");
$cek_waktu = mysqli_num_rows($waktunya);
if($cek_waktu > 0){
$data_waktu = mysqli_fetch_array($waktunya);
echo "waktunya = ".$data_waktu['waktu'];
}else{
echo "waktunya = ".$data_tq['waktu_soal'];
}?>;
var waktu;
var jalan = 0;
var habis = 0;

function init(){
    checkCookie();
    mulai();
}
function keluar(){
    if(habis==0){
        setCookie('waktux',waktu,365);
    }else{
        setCookie('waktux',0,-1);
    }
}
function mulai(){
    jam = Math.floor(waktu/3600);
    sisa = waktu%3600;
    menit = Math.floor(sisa/60);
    sisa2 = sisa%60
    detik = sisa2%60;
    if(detik<10){
        detikx = "0"+detik;
    }else{
        detikx = detik;
    }
    if(menit<10){
        menitx = "0"+menit;
    }else{
        menitx = menit;
    }
    if(jam<10){
        jamx = "0"+jam;
    }else{
        jamx = jam;
    }
    document.getElementById("divwaktu").innerHTML = jamx+" Jam : "+menitx+" Menit : "+detikx +" Detik";
	document.getElementById('woy').value = waktu;
    waktu --;
    if(waktu>0){
        t = setTimeout("mulai()",1000);
        jalan = 1;
    }else{
        if(jalan==1){
            clearTimeout(t);
        }
        habis = 1;
        document.getElementById("kirim").click();
    }
}
function selesai(){    
    if(jalan==1){
        clearTimeout(t);
    }
    habis = 1;
}
function getCookie(c_name){
    if (document.cookie.length>0){
        c_start=document.cookie.indexOf(c_name + "=");
        if (c_start!=-1){
            c_start=c_start + c_name.length+1;
            c_end=document.cookie.indexOf(";",c_start);
            if (c_end==-1) c_end=document.cookie.length;
            return unescape(document.cookie.substring(c_start,c_end));
        }
    }
    return "";
}
function setCookie(c_name,value,expiredays){
    var exdate=new Date();
    exdate.setDate(exdate.getDate()+expiredays);
    document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
}
function checkCookie(){
    waktuy=getCookie('waktux');
    if (waktuy!=null && waktuy!=""){
        waktu = waktuy;
    }else{
        waktu = waktunya;
        setCookie('waktux',waktunya,7);
    }
}
$(function(){
    $("audio").on("play", function() {
        $("audio").not(this).each(function(index, audio) {
            audio.pause();
        });
    });
});
</script>
<script type="text/javascript">
    window.history.forward();
    function noBack(){ window.history.forward(); }
</script>

<?php
if(@$_SESSION['siswa']) { ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Ujian Online E-Learning Broadband Multimedia</title>
    <link href="style/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="style/assets/css/font-awesome.css" rel="stylesheet" />
    <link href="style/assets/css/style.css" rel="stylesheet" />
    <style type="text/css">
    .mrg-del {
        margin: 0;
        padding: 0;
    }
	
.table-responsive .slide {
	display:none;
	}	
	
.table-responsive .selected {
	display:block;
	}
    </style>
</head>
<body onLoad="init(),noBack();" onpageshow="if (event.persisted) noBack();" onUnload="keluar()">

<div class="navbar navbar-inverse set-radius-zero">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./">
                <img src="style/assets/img/logopnj.png" />
            </a>
        </div>

        <div class="left-div">
            <div class="user-settings-wrapper">
                <ul class="nav">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            <span class="glyphicon glyphicon-user" style="font-size: 25px;"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php 
                    
                    $sql_soal_pilgan = mysqli_query($conn, "SELECT id_pilgan,pertanyaan,audio,gambarSoal,pil_a,gambarA,pil_b,gambarB,pil_c,gambarC,pil_d,gambarD,pil_e,gambarE FROM tb_soal_pilgan WHERE id_tq = '$id_tq' order by rand()") or die ($conn->error);
					$sql_soal_row = mysqli_num_rows($sql_soal_pilgan);
					
					$sql_soal_essay = mysqli_query($conn, "SELECT * FROM tb_soal_essay WHERE id_tq = $id_tq order by rand()"); 
					$cekessay=mysqli_num_rows($sql_soal_essay);
					?>
<div class="content-wrapper">
    <div class="container">
		<div class="row">
		    <div class="col-md-12">
		        <h4 class="page-head-line">Test : <u><?php echo $data_tq['judul']; ?></u><br />Mata Kuliah : <u><?php echo $data_tq['mapel']; ?></u></h4>
		    </div>
		</div>

		<div class="row">
			<div class="col-md-4">
		        <div class="panel panel-primary">
		            <div class="panel-heading"><b>Info <small>(Sisa waktu Anda)</small></b></div>
		            <div class="panel-body">
			            <h3 align="center"><span id="divwaktu"></span></h3>
		            </div>
		        </div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed">Nomor Soal <small>(Klik Tulisan Ini)</small></a>
                        </h4>
                    </div>
				<div id="collapseOne" class="panel-collapse collapse" style="height: 0px;">
					<div class="panel-body">
					<b>Pilihan Ganda</b> <br>
						<?php //$o=1;
						
						//$sql_nomornya = mysqli_query($conn, "SELECT * FROM tb_soal_pilgan WHERE id_tq = '$id_tq' ") or die ($conn->error);
						
						//while($nomornya = mysqli_fetch_array($sql_nomornya)) {
						for($o=1;$o<=$sql_soal_row;$o++){
							//$warnanya = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_jawaban WHERE id_tq = '$id_tq' && id_siswa = '$_SESSION[siswa]' && id_soal = '$nomornya[id_pilgan]'"));
							
								echo '<a onClick="nomornya('.$o.')" id="daftar'.$o.'" class="btn btn-danger">';
							if($o<10){echo "0";}
								echo $o.'</a>';}?>
                    </div>
				<?php 
				if($cekessay > 0){?>
					<div class="panel-body"><b>Essay</b><br>
						<?php //$o=1;
						
						//$sql_nomornya = mysqli_query($conn, "SELECT * FROM tb_soal_pilgan WHERE id_tq = '$id_tq' ") or die ($conn->error);
						
						//while($nomornya = mysqli_fetch_array($sql_nomornya)) {
						for($o=1;$o<=$cekessay;$o++){
							//$warnanya = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_jawaban WHERE id_tq = '$id_tq' && id_siswa = '$_SESSION[siswa]' && id_soal = '$nomornya[id_pilgan]'"));
							
								echo '<a onClick="nomornya('.($sql_soal_row + $o).')" id="daftar'.($sql_soal_row + $o).'" class="btn btn-danger">';
							if($o<10){echo "0";}
								echo ($sql_soal_row + $o).'</a>';}?>
						</div><?php }?>
                </div>
                </div>

				<!--div class="alert alert-danger">
				Demi mencegah terjadinya pengiriman jawaban otomatis, harap tidak menekan tombol <i>Enter</i>
				</div-->
				<p id="message"></p>
		    </div>

		    <div class="col-md-8">
		    	<form action="inc/proses_soal.php" method="post">
					<?php
					if($sql_soal_row > 0) {
                    ?>
                        <div class="panel panel-default">
                            <div class="panel-heading"><b>Soal</b></div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <?php
                                    while($data_soal_pilgan = mysqli_fetch_array($sql_soal_pilgan)) {
										$query_jawab = mysqli_query($conn,"Select jawaban from tb_jawaban where $id_tq = '$id_tq' AND id_siswa = $_SESSION[siswa] AND id_soal = $data_soal_pilgan[id_pilgan]");
										$data_jawab = mysqli_fetch_array($query_jawab);
										mysql_query('update tb_jawaban set ragu = "0" where id_tq = "'.$id_tq.'" && id_siswa = "'.$_SESSION['siswa'].'"');?>
        								<table id="soal<?php echo $no;?>" class="table slide<?php if($no == '1'){echo " selected";}?>">
										
											<input type="hidden" name="nomorsoal" value="<?php echo $data_soal_pilgan['id_pilgan'];?>" />
											<input type="hidden" name="tampil" value="<?php echo $no;?>" />
        							    	<tr>
        							    		<td width="10%">( <?php echo $no++; ?> )</td>
        							            <td><b><?php echo $data_soal_pilgan['pertanyaan']; ?></b></td>
         							        </tr>
                                            <?php if($data_soal_pilgan['audio'] != '') { ?>
                                                <tr>
                                                    <td></td>
                                                    <td>
														<audio controls src="admin/audio/<?php echo $data_soal_pilgan['audio'];?>" type="audio/mpeg" preload="metadata">
															Your browser does not support the audio element.
														</audio>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php if($data_soal_pilgan['gambarSoal'] != '') { ?>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <img class="gambar_soal" id="s" src="admin/img/gambar_soal_pilgan/soal/<?php echo $id_tq.'_'.$data_soal_pilgan['gambarSoal']; ?>" />
                                                    </td>
                                                </tr>
                                            <?php } ?>
        							        <tr>
        							        	<td></td>
        							            <td>
                                                    <div class="radio mrg-del">
                                                        <label>
                                                            <input type="radio" onClick="berisi(<?php echo $no;?>)" name="soal_pilgan[<?php echo $data_soal_pilgan['id_pilgan']; ?>]" value="A" <?php if($data_jawab['jawaban'] == "A"){echo "Checked";}?>/> A. <?php echo $data_soal_pilgan['pil_a']; ?>
                                                        </label>
                                                    </div>
                                                </td>
        							        </tr>
                                            <?php if($data_soal_pilgan['gambarA'] != '') { ?>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <img class="gambar_soal" src="admin/img/gambar_soal_pilgan/jawaban/<?php echo $id_tq.'_'.$data_soal_pilgan['gambarA']; ?>" />
                                                    </td>
                                                </tr>
                                            <?php } ?>
        							        <tr>
        							        	<td></td>
        							            <td>
                                                    <div class="radio mrg-del">
                                                        <label>
                                                            <input type="radio" onClick="berisi(<?php echo $no;?>)" name="soal_pilgan[<?php echo $data_soal_pilgan['id_pilgan']; ?>]" value="B" <?php if($data_jawab['jawaban'] == "B"){echo "Checked";}?>/> B. <?php echo $data_soal_pilgan['pil_b']; ?>
                                                        </label>
                                                    </div>
                                                </td>
        							        </tr>
                                            <?php if($data_soal_pilgan['gambarB'] != '') { ?>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <img class="gambar_soal" src="admin/img/gambar_soal_pilgan/jawaban/<?php echo $id_tq.'_'.$data_soal_pilgan['gambarB']; ?>" />
                                                    </td>
                                                </tr>
                                            <?php } ?>
        							        <tr>
        							        	<td></td>
        							            <td>
                                                    <div class="radio mrg-del">
                                                        <label>
                                                            <input type="radio" onClick="berisi(<?php echo $no;?>)" name="soal_pilgan[<?php echo $data_soal_pilgan['id_pilgan']; ?>]" value="C" <?php if($data_jawab['jawaban'] == "C"){echo "Checked";}?>/> C. <?php echo $data_soal_pilgan['pil_c']; ?>
                                                        </label>
                                                    </div>
                                                </td>
        							        </tr>
                                            <?php if($data_soal_pilgan['gambarC'] != '') { ?>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <img class="gambar_soal" src="admin/img/gambar_soal_pilgan/jawaban/<?php echo $id_tq.'_'.$data_soal_pilgan['gambarC']; ?>" />
                                                    </td>
                                                </tr>
                                            <?php } ?>
        							        <tr>
        							        	<td></td>
        							            <td>
                                                    <div class="radio mrg-del">
                                                        <label>
                                                            <input type="radio" onClick="berisi(<?php echo $no;?>)" name="soal_pilgan[<?php echo $data_soal_pilgan['id_pilgan']; ?>]" value="D" <?php if($data_jawab['jawaban'] == "D"){echo "Checked";}?>/> D. <?php echo $data_soal_pilgan['pil_d']; ?>
                                                        </label>
                                                    </div>
                                                </td>
        							        </tr>
                                            <?php if($data_soal_pilgan['gambarD'] != '') { ?>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <img class="gambar_soal" src="admin/img/gambar_soal_pilgan/jawaban/<?php echo $id_tq.'_'.$data_soal_pilgan['gambarD']; ?>" />
                                                    </td>
                                                </tr>
                                            <?php } ?>
        							        <tr>
        							        	<td></td>
        							            <td>
                                                    <div class="radio mrg-del">
                                                        <label>
                                                            <input type="radio" onClick="berisi(<?php echo $no;?>)" name="soal_pilgan[<?php echo $data_soal_pilgan['id_pilgan']; ?>]" value="E" <?php if($data_jawab['jawaban'] == "E"){echo "Checked";}?>/> E. <?php echo $data_soal_pilgan['pil_e']; ?>
                                                        </label>
                                                    </div>
                                                </td>
        							        </tr>
                                            <?php if($data_soal_pilgan['gambarE'] != '') { ?>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <img class="gambar_soal" src="admin/img/gambar_soal_pilgan/jawaban/<?php echo $id_tq.'_'.$data_soal_pilgan['gambarE']; ?>" />
                                                    </td>
                                                </tr>
                                            <?php } ?>
										</table>
                                    <?php
                                    }
									if($cekessay > 0){
                                    while($data_soal_essay = mysqli_fetch_array($sql_soal_essay)) {
										$query_jawab_essay = mysqli_query($conn,"Select jawaban from tb_essay_jawaban where $id_tq = '$id_tq' AND id_siswa = $_SESSION[siswa] AND id_soal = $data_soal_essay[id_essay]");
										$data_jawab_essay = mysqli_fetch_array($query_jawab_essay);
										mysql_query('update tb_jawaban set ragu = "0" where id_tq = "'.$id_tq.'" && id_siswa = "'.$_SESSION['siswa'].'"');?>
        								<table id="soal<?php echo $no;?>" class="table slide<?php if($no == '1'){echo " selected";}?>">
										
											<input type="hidden" name="nomorsoal" value="<?php echo $data_soal_essay['id_essay'];?>" />
											<input type="hidden" name="tampil" value="<?php echo $no;?>" />
        							    	<tr>
        							    		<td width="10%">( <?php echo $no++; ?> )</td>
        							            <td><b><?php echo $data_soal_essay['pertanyaan']; ?></b></td>
         							        </tr>
                                            <?php if($data_soal_essay['gambarSoal'] != '') { ?>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <img width="1500" class="gambar_soal" id="s" src="admin/img/gambar_soal_essay/<?php echo $id_tq.'_'.$data_soal_essay['gambarSoal']; ?>" />
                                                    </td>
                                                </tr>
                                            <?php } ?>
        							        <tr>
        							        	<td></td>
        							            <td>
                                                            <textarea <?php if(isset($data_jawab_essay['jawaban'])){echo 'onClick="berisi('.$no.')"';}?> name="soal_essay[<?php echo $data_soal_essay['id_essay']; ?>]" rows="5" cols="70"><?php if(isset($data_jawab_essay['jawaban'])){echo $data_jawab_essay['jawaban'];}?></textarea>
															<!--input type="radio" onClick="berisi(<?php echo $no;?>)" name="soal_pilgan[<?php echo $data_soal_essay['id_essay']; ?>]" value="A" <?php if($data_jawab_essay['jawaban'] == "A"){echo "Checked";}?>/-->
                                                </td>
        							        </tr>
										</table>
                                    <?php
                                    }} ?>
                                    <input type="hidden" name="jumlahsoalpilgan" value="<?php echo $sql_soal_row; ?>" />
    							</div>
    			            </div>
    			        </div>
                    <?php
                    }?>
                    <input type="hidden" name="siswa" value="<?php echo $_SESSION['siswa']; ?>" />
                    <input type="hidden" name="kapan" id="woy" value=""/><div id="hehe"></div>
                    <input type="hidden" name="id_tq" value="<?php echo $id_tq; ?>" />

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div>
							<a id="prev" class="btn btn-default">Previous</a>
							<a id="ragu" class="btn btn-warning">Ragu - Ragu</a>
                            <a id="selesai" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Selesai</a>
							<a id="next" class="btn btn-default">Next</a>
                            </div>
                            <!--div id="konfirm" style="display:none; margin-top:15px;">
                                Apakah Anda yakin sudah selesai mengerjakan soal dan akan mengirim jawaban? &nbsp; <input onclick="selesai();" type="submit" id="kirim" value="Ya" class="btn btn-info btn-sm" />
                            </div-->
							<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="selesai_judul modal-title" id="myModalLabel"></h4>
                                        </div>
                                        <div class="modal-body" id="selesai_isi"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											<input onClick="selesai();" type="submit" id="kirim" value="Selesai" class="btn btn-info" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
		        </form>
		    </div>
		</div>

	</div>
</div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                &copy; 2021 Ujian Berbasis Komputer SMKN 48 Jakarta
                <p id="sd"></p>
				<!--?php for($t=1;$t<$sql_soal_row;$t++){?>
				<p id="sd< ?php echo $t;?>"></p><br>< ?php }?-->
            </div>

        </div>
    </div>
</footer>

</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
	$('#prev').hide();
	$('#selesai').hide();
	//$('#kirim').hide();
	for(a=1;a<=<?php echo $sql_soal_row;?>;a++){
	//$("input[type=radio]:checked").each(function() {
	if($("#soal"+a+" input:radio:checked").length > 0) {
        $('a[id=daftar'+a+']').removeClass("btn-danger");
        $('a[id=daftar'+a+']').addClass("btn-success");
    };};
	for(d=<?php echo $sql_soal_row + 1;?>;d<=<?php echo $sql_soal_row + $cekessay;?>;d++){
	//$("input[type=radio]:checked").each(function() {
	if($("#soal"+d+" textarea").val() != '') {
        $('a[id=daftar'+d+']').removeClass("btn-danger");
        $('a[id=daftar'+d+']').addClass("btn-success");
    };};
});

$("input[type=radio],input[type=hidden]").autosave({
	url: "inc/autosave.php",
	method: "post",
	data: $(".selected > input[name=tampil]").serialize(),
	grouped: true,
	send: function(){
		$("#message").html("Sending data....");
	},
	success: function(data) {
		$("#message").html("Data updated successfully").show();
		setTimeout('fadeMessage()',1500);
    },
    dataType: "html"
});	
$("textarea,input[type=hidden]").autosave({
	url: "inc/autosave_essay.php",
	method: "post",
	data: $(".selected > input[name=tampil]").serialize(),
	grouped: true,
	send: function(){
		$("#message").html("Sending data....");
	},
	success: function(data) {
		$("#message").html("Data updated successfully<br>" + data).show();
		setTimeout('fadeMessage()',1500);
    },
    dataType: "html"
});	


/*$(function() {
    var $radios = $('input[type=radio]');
    var $idos = $('input[name=tampil]').val();
    var $tekos = $('a[id=daftar]'+$idos);
    if($radios.is(':checked') === true) {
        $tekos.addClass("btn-warning");
		$('#sd').html("test123");
    } else {
		$('#sd').html("321test");
	}
});

$("input[type=radio]:checked").each(function() {
alert($("input[name=tampil]").val());
});

function checkjwbn(idos){
    var $radios = $('input[type=radio]');
    var $tekos = $('a[id=daftar'+$idos+']');
    if($radios.is(':checked') === true) {
        $tekos.addClass("btn-warning");
		$('#sd').html("test123");
    } else {
		$('#sd').html("321test");
	}
}*/

$("#selesai").click(function(){
	var isi = 0;
	var ragu2 = 0;
	for(b=1;b<<?php echo $sql_soal_row;?>;b++){
		//$("input[type=radio]:checked").each(function() {
		if($("#soal"+b+" input:radio:checked").length > 0) {
			isi++;
		};
	};
	for(c=<?php echo $sql_soal_row + 1;?>;c<=<?php echo $cekessay + $sql_soal_row;?>;c++){
		//$("input[type=radio]:checked").each(function() {
		if($("#soal"+c+" textarea").val() != '') {
			isi++;
		};
	};
	$(".selesai_judul").html("Anda yakin ingin menyelesaikan ujian ini?").show();
	//$("#selesai_isi").html("Anda telah mengerjakan "+isi+" dari <?php echo $sql_soal_row + $cekessay;?> soal. Sistem ini tidak bertanggung jawab atas kesalahan kunci ujian maupun jawaban.").show();
	/*$.ajax({
		url : 'inc/cekjwb.php',
		method : 'post',
		data : 'id_tq='+$("input[name=id_tq]").val()+'&siswa='+$("input[name=siswa]").val(),
		send: function(){
			$("#message").html("Sending data....");
		},
		success : function(data){
			$("#message").html(data);
			if(data == 'ragu'){
				$(".selesai_judul").html("Anda Masih Ragu-ragu").show();
				$("#selesai_isi").html("Anda masih memiliki soal yang masih ragu-ragu. Hilangkan tanda ragu-ragu jika Anda sudah memjawab soal tersebut.").show();
			}
			if(data == 'jwbn'){
				$(".selesai_judul").html("Anda Belum Melengkapi Jawaban").show();
				$("#selesai_isi").html("Anda Memiliki soal yang belum dijawab. Lengkapi semua jawaban untuk menyelesaikan ujian.").show();
			}
			if(data == 'ok'){
				$(".selesai_judul").html("Jawaban Akan dikirim").show();
				$("#selesai_isi").html("Apakah Anda yakin dengan jawaban Anda? Hasil akan langsung tampil di halaman nilai. &nbsp;").show();
				$('#kirim').show();
			} 
			$("#konfirm").fadeIn(1000);
		},
	});*/
});

$("#ragu").click(function(){
	$.ajax({
		url : 'inc/ragu.php',
		method : 'post',
		data : 'id_tq='+$("input[name=id_tq]").val()+'&jmlpilgan='+$("input[name=jumlahsoalpilgan]").val()+'&siswa='+$("input[name=siswa]").val()+'&'+$(".selected > input[name=nomorsoal]").serialize()+'&'+$(".selected > input[name=tampil]").serialize(),
		success : function(data){
			var r = data.split(' ');
			$("#message").html("Data updated successfully").show();
			setTimeout('fadeMessage()',1500);
			if(r[1] == '1'){
				if(r[2] == ''){
					$("a[id=daftar" + r[0] + "]").removeClass("btn-danger");
				} else {
					$("a[id=daftar" + r[0] + "]").removeClass("btn-success");
				}
				$("a[id=daftar" + r[0] + "]").addClass("btn-warning");
			} else {
				$("a[id=daftar" + r[0] + "]").removeClass("btn-warning");
				if(r[2] == ''){
					$("a[id=daftar" + r[0] + "]").addClass("btn-danger");
				} else {
					$("a[id=daftar" + r[0] + "]").addClass("btn-success");
				}
			}
		},
		send: function(){
			$("#message").html("Sending data....");
		},
	});
});

function fadeMessage(){
	$('#message').fadeOut('slow');
}

var $first = $('table:first', '.table-responsive'),
     $last = $('table:last', '.table-responsive');

$("#next").click(function () {
    var $next,
        $selected = $(".selected");
    $next = $selected.next('table').length ? $selected.next('table') : $last;
    $selected.removeClass("selected").fadeOut('fast');
    $next.addClass('selected').fadeIn('fast');
	$('#prev').show();
	$selected.next('table').length ? $('#next').show() : ($('#next').hide(), $('#selesai').show());
});

$("#prev").click(function () {
    var $prev,
        $selected = $(".selected");
    $prev = $selected.prev('table').length ? $selected.prev('table') : $first;
    $selected.removeClass("selected").fadeOut('fast');
    $prev.addClass('selected').fadeIn('fast');
	$('#next').show();$('#selesai').hide();
	$selected.prev('table').length ? $('#prev').show() : $('#prev').hide();
});

$("a[id^=nomor]").click(function () {
    var $prev,
        $selected = $(".selected");
    // get the selected item
    // If prev li is empty , get the last
    $prev = $selected.prev('table').length ? $selected.prev('table') : $first;
    $selected.removeClass("selected").fadeOut('fast');
    $prev.addClass('selected').fadeIn('fast');
});

function nomornya(x){
	$(".selected").removeClass("selected").fadeOut('fast');
	$("table[id=soal" + x + "]").addClass('selected').fadeIn('fast');
}
function berisi(x){
	x = x - 1;
	$("a[id=daftar" + x + "]").removeClass("btn-danger");
	$("a[id=daftar" + x + "]").addClass("btn-success");
}
function beragu(x){
	x = x - 1;
	$("a[id=daftar" + x + "]").removeClass("btn-danger");
	$("a[id=daftar" + x + "]").removeClass("btn-success");
	$("a[id=daftar" + x + "]").addClass("btn-warning");
}
</script>
<?php
} else {
	echo "<script>window.location='./';</script>";
} ?>