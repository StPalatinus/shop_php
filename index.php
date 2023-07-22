<?php
    error_reporting(E_ERROR);
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s")." GMT");
    header("Cache-Control: no-cache, must-revalidate");
    header("Cache-Control: post-check=0,pre-check=0", false);
    header("Cache-Control: max-age=0", false);
    header("Pragma: no-cache");
    
    include "./functions/start_session.php";

    session_start();
    $pdo = require 'assets/db_connect.php';

    // var_dump($_SERVER);
    // var_dump($pdo);

echo "<!-- GENERAL RESOURCES -->";
echo "<!DOCTYPE HTML>";
echo "<html>";

    require "./components/head.php";
    echo "<body>";
        echo "<main id='main' class='main'>";

            require "./components/header.php";

            // APP 
                function loadMainPage() {
                    require "./components/content/main.php";
                };
                function choicePage() {
                    switch ($_GET['page']) {
                        case ".index.php":
                            require "./components/content/main.php";
                            break;
                        case "main":
                            require "./components/content/main.php";
                            break;
                        case "shop":
                            require "./components/content/shop.php";
                            break;
                        case "news":
                            require "./components/content/news.php";
                            break;
                        case "additionally":
                            require "./components/content/additionally.php";
                            break;
                        // USER CONTROLS
                        case "signup":
                            require "./components/usercontrol/signup.php";
                            break;
                        case "login":
                            require "./components/usercontrol/login.php";
                            break;
                        case "profile":
                            require "./components/usercontrol/profile.php";
                            break;
                        case "exit":
                            require "./components/usercontrol/exit.php";
                            break;
                        // GRAPHS
                        case "btc-to-rub":
                            require "./components/graphs/btc-to-rub.php";
                            break;
                        case "btc-to-usd":
                            require "./components/graphs/btc-to-usd.php";
                            break;
                        case "btc-to-xrp":
                            require "./components/graphs/btc-to-xrp.php";
                            break;
                        case "xrp-to-rub":
                            require "./components/graphs/xrp-to-rub.php";
                            break;
                        default:
                        require "./components/404.php";
                      }
                };
                isset($_GET['page']) ? choicePage() : loadMainPage();


            // EOFAPP
            require "./components/footer.php"; 
        echo "</main>";
        echo "<div class='header-menu_modal-substrate'></div>";
        echo "<script type='text/javascript' src='./scripts/menutoggler.js'></script>";
            if(!empty($_GET) && $_GET['page'] === "shop") {
            echo "<script type='text/javascript' src='./scripts/basket.js'></script>";
            }
        echo "</body>";
    
echo "</html>";
?>