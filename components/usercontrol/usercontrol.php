<div class="header-menu">
<?php
    session_start();
    if( isset($_SESSION['valid_user']) ){// если авторизованный пользователь
        echo "<h2 class='header-menu_item header-menu_user-welcome'>Добро пожаловать, $_SESSION[valid_user]</h2>";
        echo '<h2><a class="header-menu_item header-menu_personal-account" href="./index.php?page=profile"><span class="header-menu_item-text">Личный кабинет</span></a></h2>';
        echo '<h2><a class="header-menu_item header-menu_logout" href="./index.php?page=exit"">Выход</a></h2>';
    }else{
        echo '<h2><a class="header-menu_item header-menu_personal-account" href="./index.php?page=login"><span class="header-menu_item-text">Вход</span></a></h2>';
        echo '<h2><a class="header-menu_item header-menu_registration" href="./index.php?page=signup"><span class="header-menu_item-text">Регистрация</span></a></h2>';
    }
?>
    <!-- <h2><a class="header-menu_item header-menu_registration" href="./index.php?page=signup"><span class="header-menu_item-text">Регистрация</span></a></h2>
    <h2><a class="header-menu_item header-menu_personal-account" href="./index.php?page=login"><span class="header-menu_item-text">Личный кабинет</span></a></h2> -->
</div>