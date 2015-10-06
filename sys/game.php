<?php

if($char['last_activ'] < time())
{
    $last_a = time()+300;
    $db->query("UPDATE `character` SET `last_active`='$last_a' WHERE `id`='$user_id'");
}

if($char['email'] == null)
{
    echo "<orange>Ваш персонаж не закреплён за E-mail, пройдите по <a href='/character.php?act=set_email'>ссылке</a>, чтобы установить E-mail адресс.</orange><br><br>";
}