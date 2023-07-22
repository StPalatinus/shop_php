<head>
    <title>Test</title>
    <meta name="description" content="website description" />
    <meta name="keywords" content="website keywords, website keywords" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,initial-scale=1,maximum-scale=1">
    <link href="favicon.ico" rel="icon">
    <link rel="stylesheet" type="text/css" href="styles/normalize.css" />
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">
    <?php
        function initGraphScrypts() {
            if(
                $_GET['page'] === "btc-to-rub" ||
                $_GET['page'] === "btc-to-usd" ||
                $_GET['page'] === "btc-to-xrp" ||
                $_GET['page'] === "xrp-to-rub"
                ) {
                    echo "<script src=\"https://canvasjs.com/assets/script/canvasjs.min.js\"></script>";
                    echo "<script src=\"https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.0/dist/index.umd.min.js\"></script>";
                    echo "<script src=\"scripts/support.js\"></script>";
            }
        }

        function includeSwiper() {
            if( $_GET['page'] === "shop" ) {
                echo "<link rel=\"stylesheet\" href=\"https://unpkg.com/swiper/swiper-bundle.min.css\" />";
                echo "<script type=\"text/javascript\" src=\"../Public/scripts/slider.js\" defer></script>";
            }
        }
        
        isset($_GET['page']) ? includeSwiper() : false;
        isset($_GET['page']) ? initGraphScrypts() : false;
    ?>
</head>