<?php
@session_start();
$conn = mysqli_connect("localhost", "root", "", "skripsi");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>E-Learning SMKN 48 JAKARTA</title>
    <link href="style/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="style/assets/css/font-awesome.css" rel="stylesheet" />
    <link href="style/assets/css/style.css" rel="stylesheet" /></head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    Anda belum punya akun ? Silahkan <a href="./?hal=daftar" class="btn btn-xs btn-danger">Daftar</a>
                </div>
            </div>
        </div>
    </header>

    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">
                    <img src="style/assets/img/logo.png" />
                </a>
            </div>
            <div class="left-div">
                <div class="user-settings-wrapper">
                    <ul class="nav">
                        <li class="dropdown">
                            <!--a class="dropdown-toggle">
                                <span class="glyphicon glyphicon-user" style="font-size: 25px;"></span>
                            </a-->
                        </li>
                    </ul>
                </div>
            </div>
            <br>
        </div>
    </div>

    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a <?php if(@$_GET['page'] == '') { echo 'class="menu-top-active"'; } ?> href="./">Login</a></li>
                            <li><a <?php if(@$_GET['page'] == 'berita') { echo 'class="menu-top-active"'; } ?> href="?page=berita">Berita</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="content-wrapper">
        <div class="container">
            <?php
            if(@$_GET['page'] == '') { ?>
            <div class="row">
                    <div class="col-md-12">
                        <h4 class="page-head-line">Silahkan login untuk masuk</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        if(@$_POST['login']) {
                            $user = @mysqli_real_escape_string($conn, $_POST['user']);
                            $pass = @mysqli_real_escape_string($conn, $_POST['pass']);
                            $sql = mysqli_query($conn, "SELECT * FROM tb_siswa WHERE username = '$user' AND password = md5('$pass')") or die ($db->error);
                            $data = mysqli_fetch_array($sql);
                            if(mysqli_num_rows($sql) > 0) {
                                if($data['status'] == 'aktif') {
                                    @$_SESSION['siswa'] = $data['id_siswa'];
                                    echo "<script>window.location='./';</script>";
                                } else {
                                    echo '<div class="alert alert-warning">Login gagal, akun Anda sedang tidak aktif</div>';
                                }
                            } else {
                                echo '<div class="alert alert-danger">Login gagal, username / password salah, coba lagi!</div>';
                            }
                        } ?>
                        <h4><i>Masukkan username dan password Anda dengan benar :</i></h4>
                        <form method="post">
                            <label>Username :</label>
                            <input type="text" name="user" class="form-control" required />
                            <label>Password :  </label>
                            <input type="password" name="pass" class="form-control" id="myInput"required />
                            <hr />
                            <input type="checkbox" onClick="myFunction()"> Show Password
                            <input type="submit" name="login" value="Login" class="btn btn-info" />
                            <input type="reset" class="btn btn-danger" />
                        </form>
                        <br>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-danger col-md-12">
                            Selamat datang di <i>Sistem Ujian Berbasis Komputer</i><br>
                        <br>
                            <i>Website ini</i> adalah <i>website</i> yang berfungsi sebagai media Tes / ujian berbasis komputer khusus untuk peserta didik SMKN 48 Jakarta.                        </div>
                  </div>
                </div>
            <?php
            } else if(@$_GET['page'] == 'berita') {
                include ("inc/berita.php");
            } ?>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    &copy; 2021 Ujian Berbasis Komputer SMK Negeri 48 Jakarta</div>

            </div>
        </div>
    </footer>
    <script src="style/assets/js/jquery-1.11.1.js"></script>
    <script src="style/assets/js/bootstrap.js"></script>
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
</body>
</html>