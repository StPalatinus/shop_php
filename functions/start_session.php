<?php
    function start_session ($input) {
        $query = "SELECT display_name FROM users WHERE email = :email";
        $sth = $GLOBALS['pdo']->prepare($query);
        $sth->execute(['email' => $input['email']]);
        $result = $sth->fetch();
        $display_name = $result['display_name'];
        
        session_start();
        $result['display_name'] ? 
            $_SESSION['valid_user'] = $display_name :
            $_SESSION['valid_user'] = $input['email'];
    }
?>