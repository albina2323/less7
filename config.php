<?php 
 $conn = @mysqli_connect("localhost","root","","db") or die("Ошибка соединения с БД");
 mysqli_set_charset($conn, "utf8") or die('Не установлена кодировка');
?>