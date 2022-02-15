<?php
$db = mysql_connect("localhost", "root", "", "db_elearning");
mysql_query("UPDATE tb_file_materi SET hits = hits+1 WHERE id_materi = '$_POST[id]'") or die($db->error);
?>