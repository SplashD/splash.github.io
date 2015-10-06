<?php
require ('/sys/api');

if($user_id){;
    header('Location: /main.php');
    exit;
}

switch($act)
{   
default:


?>
<div class="bg4">Об игре</div>
<div class="tip">Суровая война между Светлыми и Тёмными силами, происходящая в мире Анкар!</div>


<div class="bg2">Особенности игры</div>
<div class="des_content">
  <p><img src="/theme/icon/e7.png"> Создай персонажа и стань самым сильным воином!</p>
  <p><img src="/theme/icon/e7.png"> Множество видов самого смертоносного снаряжения!</p>
  <p><img src="/theme/icon/e7.png"> Жестокие битвы между двумя враждующими сторонами!</p>
  <p><img src="/theme/icon/e7.png"> Создай свой орден и набери лучших воителей!</p>
  <p><img src="/theme/icon/e7.png"> Выполняй задания и получай награды!</p>
</div>

<div>
  <div class="bg2">Две враждующих стороны</div>
  <div class="des_content center">
    <img src="/img/dark.png" >
    <img src="/img/white.png" >
  </div><!-- center -->
</div>

<div class="bg2">Множество экипировки</div>
<div class="des_content center">
  <img src="/theme/icon/eq1.png">
  <img src="/theme/icon/eq3.png">
  <img src="/theme/icon/eq6.png">
  <img src="/theme/icon/eq4.png">
  <img src="/theme/icon/eq2.png">
</div><!-- center -->

<div class="bg2">Вооружись разнообразным оружием</div>
<div class="des_content center">
  <img src="/theme/icon/wea1.png">
  <img src="/theme/icon/wea2.png">
  <img src="/theme/icon/wea3.png">
  <img src="/theme/icon/wea4.png">
  <img src="/theme/icon/wea5.png">
</div><!-- center -->

<div class="bg2">Изучай магию 6-ти разных стихий</div>
<div class="des_content center">
  <img src="/theme/icon/mag1.png" width="60">
  <img src="/theme/icon/mag2.png" width="60">
  <img src="/theme/icon/mag3.png" width="60">
  <img src="/theme/icon/mag4.png" width="60">
  <img src="/theme/icon/mag5.png" width="60">
  <img src="/theme/icon/mag6.png" width="60">
</div><!-- center -->


<div class="bg2">Создание персонажа</div>
  <div class="des_content center">
  <form action="aboutgame.php?act=go_to" method="post">
  Никнейм:<br />
  <input type="text" name="login" class="inp">
  Пароль:<br />
  <input type="password" name="password" class="inp"><br />
  Сторона:<br />
  <input type="radio" name="storona" value="1" class="swhite" checked> <img src="/img/white.png">
  <input type="radio" name="storona" value="2" class="sdark"> <img src="/img/dark.png">
  <input type="submit" name="submit" value="Создать персонажа" class="but2"></form>
  <span style="float: left;"><a href="index.php">На главную</a></span><br />
  </div></div>

<?

break;

/** ПРОЦЕСС СОЗДАНИЯ ПЕРСОНАЖА **/

case 'go_to':
$login = strip_tags($_POST['login']);
$login = trim($login);
$login = htmlspecialchars($login);
$login = mysql_real_escape_string($login);

$password = strip_tags($_POST['password']);
$password = trim($password);
$password = htmlspecialchars($password);
$password = mysql_real_escape_string($password);

$storona = strip_tags($_POST['storona']);
$storona = trim($storona);
$storona = htmlspecialchars($storona);
$storona = mysql_real_escape_string($storona);

if($login == null or $password == null or $storona == null)
{
    echo "<div class='des_content'><red>Необходимо заполнить все поля!</red><br><a href='/aboutgame.php'>Вернуться</a></div>";
    require ('/theme/foot.php');
    exit;
}

if(strlen($login) < '3' or strlen($login) > '25')
{
    echo "<div class='des_content'><red>Логин должен быть не менее 3-ёх и не более 25-ти символов!</red><br><a href='/aboutgame.php'>Вернуться</a></div>";
    require ('/theme/foot.php');
    exit();
}

if(strlen($password) < '6')
{
    echo "<div class='des_content'><red>Пароль должен быть не менее 6-ти символов!</red><br><a href='/aboutgame.php'>Вернуться</a></div>";
    require ('/theme/foot.php');
    exit();
}

if(preg_match('/'.$login.'/i', 'admin') or preg_match('/'.$login.'/i', 'moder') or preg_match('/'.$login.'/i', 'administrator') or preg_match('/'.$login.'/i', 'moderator') )
{
    echo "<div class='des_content'><red>Правилами игры запрещенно использовать логины: admin/moder, и похожие ники!</red><br><a href='/aboutgame.php'>Вернуться</a></div>";
    require ('/theme/foot.php');
    exit();
}

$q = $db->query("SELECT * FROM `character` WHERE `login`='$login'");

if($q->num_rows == '0'){
    
    $pass = md5(md5($login).md5($password).md5($login));
    
    $db->query("INSERT INTO `character` SET `login`='$login', `password`='$pass', `data_create_char`='".date('d.m.y')."'");
    
    $_SESSION['user_id'] = $db->insert_id;
    
    header('Location: /index.php');
    exit;
    
}
else
{
    echo "<div class='des_content'><red>Никнейм <u>$login</u> уже занят!</red></div><br>";
}


echo "<a href='/aboutgame.php'>Назад</a>";
break;

}
require ('/theme/foot.php');
?>