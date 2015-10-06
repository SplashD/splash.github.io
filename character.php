<?php
require ('/sys/api');

switch($act)
{
default:



break;



case 'set_email':

if($char['email'] == null)
{
    if(empty($_POST['email']))
    {
        echo "<form action='?act=set_email' method='post'>
        Введите E-mail:<br>
        <input type='text' name='email' class='inp'><br>
        <input type='submit' value='Сохранить' class='but1'></form>";
    }
    else
    {
        
        $email = trim(strip_tags($_POST['email']));
        
        function this_email($email) {
            return preg_match("/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)*\.([a-zA-Z]{2,6})$/", $email);
        }
        
        if(this_email($email))
        {
            $db->query("UPDATE `character` SET `email`='$email' WHERE `id`='$user_id'");
            
            echo "<green>Вы установили E-mail: </green><u>$email</u><br><a href='/main.php'>Продолжить</a><br>";
            
        }
        else
        {
            echo "<red>Неверный формат E-mail!</red><br><a href='?act=set_email'>Вернуться</a><br>";
        }
        
    }
}
else
{
    echo "<red>E-mail указывается только 1 раз, вручную изменить его нельзя!<br>Напишите в <a href='/support.php'>тех.поддержку</a></red><br>";
}

break;



    
}
require ('/theme/foot.php');
?>