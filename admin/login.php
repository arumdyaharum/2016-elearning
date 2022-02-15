<?php
@session_start();
if(@$_SESSION['admin'] || @$_SESSION['pengajar']) {
	echo "<script>window.location='./';</script>";
} else {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Admin</title>
	<link href="style/assets/css/bootstrap.css" rel="stylesheet" />
	<style type="text/css">
	body{background: #eee url(style/assets/img/sativa.png);}
	html,body{
	    position: relative;
	    height: 100%;
	}

	.login-container{
	    position: relative;
	    /**width: 300px;**/
	    margin: 80px auto;
	    padding: 20px 40px 40px;
	    text-align: center;
	    background: #fff;
	    border: 1px solid #ccc;
	}

	#output{
	    position: absolute;
	    width: 300px;
	    top: -75px;
	    left: 0;
	    color: #fff;
	}

	#output.alert-success{
	    background: rgb(25, 204, 25);
	}

	#output.alert-danger{
	    background: rgb(228, 105, 105);
	}

	.login-container::before,.login-container::after{
	    content: "";
	    position: absolute;
	    width: 100%;height: 100%;
	    top: 3.5px;left: 0;
	    background: #fff;
	    z-index: -1;
	    -webkit-transform: rotateZ(4deg);
	    -moz-transform: rotateZ(4deg);
	    -ms-transform: rotateZ(4deg);
	    border: 1px solid #ccc;
	}

	.login-container::after{
	    top: 5px;
	    z-index: -2;
	    -webkit-transform: rotateZ(-2deg);
	    -moz-transform: rotateZ(-2deg);
	    -ms-transform: rotateZ(-2deg);
	}

	.avatar{
	    width: 100px;height: 100px;
	    margin: 10px auto 30px;
	    border-radius: 100%;
	    border: 2px solid #aaa;
	    background-size: cover;
	}

	.form-box input{
	    width: 100%;
	    padding: 10px;
	    text-align: center;
	    height:40px;
	    border: 1px solid #ccc;;
	    background: #fafafa;
	    transition:0.2s ease-in-out;
	}

	.form-box input:focus{
	    outline: 0;
	    background: #eee;
	}

	.form-box input[type="text"]{
	    border-radius: 5px 5px 0 0;
	}

	.form-box input[type="password"]{
	    border-radius: 0 0 5px 5px;
	    border-top: 0;
	}

	.form-box button.login, .form-box button.continue{
	    margin-top:15px;
	    padding: 10px 20px;
	}

	.animated {
	  -webkit-animation-duration: 1s;
	  animation-duration: 1s;
	  -webkit-animation-fill-mode: both;
	  animation-fill-mode: both;
	}

	@-webkit-keyframes fadeInUp {
	  0% {
	    opacity: 0;
	    -webkit-transform: translateY(20px);
	    transform: translateY(20px);
	  }
	  100% {
	    opacity: 1;
	    -webkit-transform: translateY(0);
	    transform: translateY(0);
	  }
	}

	@keyframes fadeInUp {
	  0% {
	    opacity: 0;
	    -webkit-transform: translateY(20px);
	    -ms-transform: translateY(20px);
	    transform: translateY(20px);
	  }
	  100% {
	    opacity: 1;
	    -webkit-transform: translateY(0);
	    -ms-transform: translateY(0);
	    transform: translateY(0);
	  }
	}

	.fadeInUp {
	  -webkit-animation-name: fadeInUp;
	  animation-name: fadeInUp;
	}
	
	</style>
</head>
<body>
<div class="container" style="margin-left:200px;">
			<div class="col-md-3">
			<div class="login-container" style="min-width:500px;">
			<!img src="logo2.jpg" width="200"><br>
			<h3>Selamat Datang di Halaman Admin<br>
			  Aplikasi Ujian Berbasis Komputer<br>
			SMK NEGERI 48 JAKARTA</h3>
			</div>
			</div>
			<div class="col-md-9">

	<div class="login-container" style="width:300px;">
        <div id="output"></div>
        <div class="avatar"></div>
        <div class="form-box">
            <input name="user" type="text" placeholder="username">
            <input name="pass" type="password" placeholder="password" id="myInput">
            <span id="ilang"><input type="checkbox" onClick="myFunction()"> Show Password</span>
            <button class="btn btn-info btn-block login" type="submit">Login</button>
            <button class="btn btn-info btn-block continue" style="display:none;">Continue</button>
        </div>
</div></div>
			</div>
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
<script src="style/assets/js/jquery-1.10.2.js"></script>
<script src="style/assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
var user = $("input[name=user]");
var pass = $("input[name=pass]");
function proses_login() {
	if(user.val() == "") {
        $("#output").removeClass('alert alert-success');
        $("#output").addClass("alert alert-danger animated fadeInUp").html("Username tidak boleh kosong");
        user.focus();
    } else if(pass.val() == "") {
        $("#output").removeClass('alert alert-success');
        $("#output").addClass("alert alert-danger animated fadeInUp").html("Password tidak boleh kosong");
        pass.focus();
    } else {
    	$.ajax({
    		url : 'inc/proses_login.php',
    		type : 'post',
    		data : 'user='+user.val()+'&pass='+pass.val(),
    		success : function(msg) {
				msg = $.parseJSON(msg);
        		if(msg.status == 'sukses') {
		            $("#output").addClass("alert alert-success animated fadeInUp").html("Selamat datang " + "<span><b><i>" + user.val() + "</i></u></span>");
		            $("#output").removeClass('alert-danger');
		            $("input").hide();
		            $('button[type="submit"]').hide();
		            $(".continue").fadeIn(1000);
		            $(".avatar").css({
		                "background-image": "url('img/profil/"+msg.add+"')",
		            });
					$("#ilang").hide();
		        } else if(msg.status == 'akun tidak aktif') {
		        	$("#output").removeClass('alert alert-warning');
		            $("#output").addClass("alert alert-danger animated fadeInUp").html("Login gagal, akun Anda tidak aktif");
		        } else if(msg.status == 'gagal') {
		        	$("#output").removeClass('alert alert-success');
		            $("#output").addClass("alert alert-danger animated fadeInUp").html("Login gagal, coba lagi");
		        }
    		}
    	});
    }
}
$('button[type="submit"]').click(function(e) {
    e.preventDefault();
    proses_login();
});
$(pass).keyup(function(e){
	if(e.keyCode == 13) {
		proses_login();
	}
});

$(function(){
	$(".continue").click(function() {
        window.location='./';
    });
});
</script>
</body>
</html>
<?php
}
?>