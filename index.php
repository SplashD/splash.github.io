<?php
require ('/sys/api');

if($user_id){;
    header('Location: /main.php');
    exit;
}

$num_reg = $db->query("SELECT * FROM `character`");
$num_online = $db->query("SELECT * FROM `character` WHERE `last_active`>'".time()."'");

echo "<div class='main_menu'><img src='/theme/logo.png' width='300'></div>";

function GetEnding($count)
{
$count = strval($count);
$last = $count{ strlen($count) - 1 } ;
if ($last == '1'){return 'игрок';}
if ($last == '2' or $last == '3' or $last == '4'){return 'игрока';}
if ($last !== '1' or $last !== '2' or $last !== '3' or $last !== '4'){return 'игроков';}
// и в том же духе пропишите остальные условия для последней цифры в числе
}

echo '<div class="bg-box1">
<p class="center"><b>Нас уже<span class="lime"> '.number_format($num_reg->num_rows).'</span> '.GetEnding($num_reg->num_rows).'!</b></p>
<p class="center"><b>Сейчас онлайн: <span class="lime"> '.number_format($num_online->num_rows).'</span> '.GetEnding($num_online->num_rows).'!</b></p>
</div>';

echo "<div class='tip p1'><div class='center p1'><a href='aboutgame.php'>Начать играть</a></div></div>";


echo '<div class="bg-box4"><form action="autorize.php" method="post">
<input name="action" value="enter" type="hidden"/>
<div class="p2">
<p class="center"><span class="b">Имя персонажа:</span></p>
<p class="center"><input type="text" class="inp" name="login" /></p>
</div>
<div class="p2">
<p class="center"><span class="b">Пароль:</span></p>
<p class="center"><input type="password" class="inp" name="password" /></p>
</div>
<div class="p3"><input name="submit" type="submit" value="" class="but shadow"/></div>
</form></div>';


echo '<ul class="navi">';
echo '<li><a href="forgott.php"><img src="/theme/icon/forgot.png" width="18">Забыл пароль</a></li>';
echo '<li><a href="aboutgame.php"><img src="/theme/icon/info.png" width="18">Об игре</a></li>';
echo '</ul></div>';

require ('/theme/foot.php');
?>