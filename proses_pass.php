<?php
$pass = mysql_real_escape_string($_POST['pass']);
if(strlen($pass) > 7 ){ echo "password anda kuat";}
else if(strlen($pass) > 3 && strlen($pass) < 8){ echo "password anda sedang";}
else {echo "password anda lemah";}
?>