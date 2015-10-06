<?php
require ('/sys/api');

if($user_id){;
    header('Location: /main.php');
    exit;
}

if($_GET['login'] == null and $_GET['password'] == null)
{
    $method_auth = 'post';
    $login = strip_tags($_POST['login']);
    $login = trim($login);
    $login = htmlspecialchars($login);
    $login = mysql_real_escape_string($login);

    $password = strip_tags($_POST['password']);
    $password = trim($password);
    $password = htmlspecialchars($password);
    $password = mysql_real_escape_string($password);
}
else
{
    $method_auth = 'get';
    $login = strip_tags($_GET['login']);
    $login = trim($login);
    $login = htmlspecialchars($login);
    $login = mysql_real_escape_string($login);

    $password = strip_tags($_GET['password']);
    $password = trim($password);
    $password = htmlspecialchars($password);
    $password = mysql_real_escape_string($password);
}

if($login == null or $password == null)
{
    echo "<div class='des_content'><red>Необходимо ввести логин и пароль!</red><br><a href='/index.php'>Вернуться</a></div>";
    require ('/theme/foot.php');
    exit;
}

$q = $db->query("SELECT * FROM `character` WHERE `login`='$login'");

if($q->num_rows > '0')
{
    $w = $q->fetch_assoc();
    
    $pass = md5(md5($login).md5($password).md5($login));
    
    if($pass !== $w['password'])
    {
        echo "<div class='des_content'><red>Пароль неверен!</red><br><a href='/index.php'>Вернуться</a></div>";
        require ('/theme/foot.php');
        exit;  
    }
    
    $_SESSION['user_id'] = $w['id'];
    
    setcookie('user_id', $pass, time()+86400);
    
    header('Location: /main.php');
    exit;
    
}
else
{
    echo "<div class='des_content'><red>Игрок с ником <u>$login</u> не найден!</red><br><a href='/index.php'>Вернуться</a></div>";
    require ('/theme/foot.php');
    exit;  
}


?>