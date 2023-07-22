<?php

error_reporting(E_ALL); ini_set('display_errors', 'On'); 

if( isset($_SESSION['valid_user']) ){
    echo <<<_HTML_
    <section id="site_content" class="site_content">
        <p>Вы уже авторизованы</p>
    </section>
_HTML_;

header('Refresh: 1; index.php');
} else {
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // d($_POST);
    
        list($errors, $input) = validate_login_form();
    
        if($errors){
            showLoginForm($errors, $input);
        }else{
            process_login_form($input);
        }
    } else {
        showLoginForm();
    }
}

function validate_login_form() {
    $errors = [];
    $input = [];

    $input['email'] = htmlspecialchars(trim($_POST['email']));
    $input['password'] = htmlspecialchars(trim($_POST['password']));

    $error_validate_email = validate_email($input['email']);
    if($error_validate_email){
        $errors['email'] = $error_validate_email;
    }

    $error_validate_password = validate_password($input['password'], $input['email']);
    if($error_validate_password){
        $errors['password'] = $error_validate_password;
    }
    
    return [$errors, $input];
}

function validate_email($email) {
    $reg_exp = "/^.+@.+\..+$/";

    if(strlen($email) === 0){
        return 'Введите адрес электронной почты';
    } elseif (!preg_match($reg_exp, $email)){
        return 'Адрес электронной почты введен в неверном формате';
    }

    $query = "SELECT email FROM users WHERE email = :email";
    $result = $GLOBALS['pdo']->prepare($query);
    $result->bindParam(':email', $email);
    $result->execute();


    $rowCount = $result->rowCount();
    if( $rowCount === 0 ){
        return 'Такой адрес не зарегистрирован';
    }
}

function validate_password($password, $email){

    if(strlen($password) === 0){
        return 'Введите пароль';
    }elseif (mb_strlen($password) < 8){
        return 'Пароль должен быть 8 и более символов';
    }

    $query = "SELECT password FROM users WHERE email = ?";
    $result = $GLOBALS['pdo']->prepare($query);
    $result->execute([$email]);
    
    $pass_db = $result->fetch();

    $hash = password_verify($password, $pass_db['password']);

    if(!$hash){
        return 'Пароль неверен';
    }
}

function process_login_form($input){

    start_session($input);
    header('Location: index.php');
}

function showLoginForm( $errors = [], $input = []  ) {
    
    $fields = [ 
        'email', 
        'password'
    ];

    foreach ($fields as $field){
        if( !isset($errors[$field]) ) $errors[$field] = '';
        if( !isset($input[$field]) ) $input[$field] = '';
    }

    echo <<<_HTML_
        <section id="site_content" class="site_content">
        <form class="formdata" action="" method="POST">
            <div class="formdata-item">
                <input 
                    id="email"
                    class="formdata-field" 
                    type="email" 
                    name="email" 
                    aria-label="Email" 
                    placeholder="Yourmail@example.ru"
                    autocomplete="off" 
                    value="$input[email]"
                    required 
                    autofocus
                /><br/>
                <span class="formdata-error">$errors[email]</span>
            </div>
            <div class="formdata-item">
                <input 
                    id="password"
                    class="formdata-field " 
                    type="password" 
                    name="password" 
                    maxlength="20" 
                    aria-label="Password" 
                    placeholder="Password"
                    value="$input[password]"
                    required
                ><br/>
                <span class="formdata-error">$errors[password]</span>
            </div>
            <div class="formdata-item">
                <input type="submit" id="submit" class="formdata-button" value="Войти" />
            </div>
        </form>
        </section>
    _HTML_;
}
?>