<?php

if($user_id)
{
    
    echo "<img src='/theme/icon/e7.png'> <a href='/character.php'>Персонаж</a><br />";
    echo "<img src='/theme/icon/e7.png'> <a href='/main.php'>Главная</a><br />";
        
    
}


echo '</div><div class="footer">
Время Войны © 2015<br>
<span class="nobr vert_bot"><img src="/theme/icon/clock.png" alt="" width="18"> '.date('H:i').'</span>
</div>';


echo "</body></html>";
$db->close();
?>