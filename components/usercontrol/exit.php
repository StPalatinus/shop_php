<?php

session_start();

session_unset();

echo <<<_HTML_
    <section id="site_content" class="site_content">
        <p>Вы вышли из системы</p>
    </section>
_HTML_;


header('Refresh: 1; index.php');
?>

