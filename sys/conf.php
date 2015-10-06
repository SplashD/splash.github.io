<?php
$host = 'localhost'; // хост
$user = 'splash'; // пользователь
$password = '1q2w3e'; // пароль
$database = 'game'; // имя базы
$port = '3306'; // порт подключения(по-умолчанию 3306)

$db = new mysqli($host, $user, $password, $database, $port);

if ($db->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}

$db->set_charset("utf8"); // кодировка

if(intval($_SESSION['user_id']) > '0')
{
    $user_id = intval($_SESSION['user_id']);
    $char_q = $db->query("SELECT * FROM `character` WHERE `id`='$user_id'");
    $char = $char_q->fetch_assoc();
}
else
{
    $user_id = null;
}

$act = strip_tags($_GET['act']);
$act = htmlspecialchars($act);
$act = mysql_real_escape_string($act);

?>