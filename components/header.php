<header id="header" class="header">
    <div id="logo" class="logo">
        <div id="logo_text" class="header-logo_with-menu">
            <a class="header-logo-link" href="./index.php?page=main"><img class="header-logo-image" src="./pictures/videocard.jpg" alt="Логотип компании"></a>
            <?php
                require "./components/usercontrol/usercontrol.php";
            ?>
            <button class="header-menu_mobile-version-menu-trigger"></button>
        </div>
    </div>
    <input class="menu-toggler" type="checkbox" name="menu-toggler">
    <nav id="menubar" class="menubar">
<?php
    $menuArr = [
        ['URL' => "./index.php?page=main", "NAME" => "ГЛАВНАЯ", "SELECTED" => $_GET['page'] === "main"],
        ['URL' => "./index.php?page=shop", "NAME" => "МАГАЗИН", "SELECTED" => $_GET['page'] === "shop"],
        ['URL' => "#", "NAME" => "ГРАФИКИ", "SELECTED" => (
            $_GET['page'] === "btc-to-rub"||$_GET['page'] === "btc-to-usd"||$_GET['page'] === "btc-to-xrp"||$_GET['page'] === "xrp-to-rub"
        ), "SUBMENU" => [
            ['URL' => "./index.php?page=btc-to-rub&sub=1", "NAME" => "Bitcoin к Рублю", "SELECTED" => $_GET['page'] === "btc-to-rub"],
            ['URL' => "./index.php?page=btc-to-usd&sub=1", "NAME" => "Bitcoin к Доллару", "SELECTED" => $_GET['page'] === "btc-to-usd"],
            ['URL' => "./index.php?page=btc-to-xrp&sub=1", "NAME" => "Bitcoin к Ripple", "SELECTED" => $_GET['page'] === "btc-to-xrp"],
            ['URL' => "./index.php?page=xrp-to-rub&sub=1", "NAME" => "Ripple к Рублю", "SELECTED" => $_GET['page'] === "xrp-to-rub"],
        ]],
        ['URL' => "./index.php?page=news", "NAME" => "НОВОСТИ", "SELECTED" => $_GET['page'] === "news"],
        ['URL' => "./index.php?page=additionally", "NAME" => "ДОПОЛНИТЕЛЬНО", "SELECTED" => $_GET['page'] === "additionally"],
    ];

    $markLinkSelections = function($sMarker, $flag){
        $resultClass = "menu-link";

        if ($flag > 0) { $resultClass .= " submenu-link"; }
        if ($sMarker['SELECTED']) { $resultClass .= " menu-link--selected"; }
        
        return $resultClass;
    };
    $markSubMenu = function($sMarker, $flag){
        $resultClass = "menu-item";
        if ($flag > 0) { $resultClass .= " submenu-item"; }
        if (isset($sMarker['SUBMENU'])) { $resultClass .= " menu-item--with-submenu"; }
        return $resultClass;
        // return isset($sMarker['SUBMENU']) ? 'menu-item menu-item--with-submenu' : 'menu-item';
    };

    $createMenu = function($mr, $menuLvl){
        if ($menuLvl === 0) {echo "<ul id='menu' class='menu'>";}
        foreach($mr as $kay => $value){
            echo "<li class='{$GLOBALS["markSubMenu"]($value, $menuLvl)}'><a class='{$GLOBALS["markLinkSelections"]($value, $menuLvl)}' href='".$value['URL']."'>".$value['NAME']."</a>";
            if (isset($value["SUBMENU"])) {
                echo "<ul class='submenu'>";
                $GLOBALS["createMenu"]($value["SUBMENU"], 1);
                echo "</ul>";
            }
            echo "</li>";
        };
        if ($menuLvl === 0) {echo "</ul>";}
    };
    
    // header('./index.php');
    $createMenu($menuArr, 0);   
?>
    </nav>
</header>