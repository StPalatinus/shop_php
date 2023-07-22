<?php
error_reporting(E_ALL); ini_set('display_errors', 'On'); 
echo "<section id='site_content' class='site_content'>";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // d($_POST);

    list($errors, $input) = validate_signup_form();

    if($errors){
        showSugnupForm($errors, $input);
    }else{
        process_form($input);
    }
} else {
    showSugnupForm();
}

function validate_signup_form() {
    $errors = [];
    $input = [];

    $input['email'] = htmlspecialchars(trim($_POST['email']));
    $input['phone'] = htmlspecialchars(trim($_POST['phone']));
    $input['display_name'] = htmlspecialchars(trim($_POST['display_name']));
    $input['first_name'] = htmlspecialchars(trim($_POST['first_name']));
    $input['last_name'] = htmlspecialchars(trim($_POST['last_name']));
    $input['password'] = htmlspecialchars(trim($_POST['password']));

    $error_validate_email = validate_email($input['email']);
    if($error_validate_email){
        $errors['email'] = $error_validate_email;
    }

    $error_validate_phone = validate_phone($input['phone']);
    if($error_validate_phone){
        $errors['phone'] = $error_validate_phone;
    }

    $error_validate_display_name = validate_display_name($input['display_name']);
    if( $error_validate_display_name ){
        $errors['display_name'] = $error_validate_display_name;
    }

    $error_validate_first_name = validate_first_name($input['first_name']);
    if( $error_validate_first_name ){
        $errors['first_name'] = $error_validate_first_name;
    }

    $error_validate_last_name = validate_last_name($input['last_name']);
    if( $error_validate_last_name ){
        $errors['last_name'] = $error_validate_last_name;
    }

    $error_validate_password = validate_password($input['password']);
    if($error_validate_password){
        $errors['password'] = $error_validate_password;
    }
    
    return [$errors, $input];
}

// VALIDATE FUNCTIONS

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
    if( $rowCount > 0 ){
        return 'Такой адрес уже существует';
    }
}

function validate_phone($phone) {
    $reg_exp = "/\+\d\([0-9]{3}\)[0-9]{7}/";

    if(strlen($phone) === 0){
        return 'Введите номер телефона';
    } elseif (!preg_match($reg_exp, $phone)){
        return 'Номер телефона введен в неверном формате';
    }


    $phone = stretch_phone($phone);


    $query = "SELECT phone FROM users WHERE phone = :phone";
    $result = $GLOBALS['pdo']->prepare($query);
    $result->bindParam(':phone', $phone);
    $result->execute();


    $rowCount = $result->rowCount();
    if( $rowCount > 0 ){
        return 'Такой номер уже зарегистрирован';
    }
}

function validate_display_name($display_name) {
    $reg_exp = "/^[a-zа-яё][a-z0-9а-яё_-]{2,}$|^\s*$/iu";

    if( !preg_match($reg_exp, $display_name) ){
        return 'Русские или латинские буквы и цифры не менее 3 шт, должен начинаться с буквы';
    }

    $query = "SELECT display_name FROM users WHERE display_name = :display_name";
    $result = $GLOBALS['pdo']->prepare($query);
    $result->bindParam(':display_name', $display_name);
    $result->execute();

    $rowCount = $result->rowCount();
    if( $rowCount > 0 ){
        return 'Такой никнейм уже существует';
    }
}

function  validate_first_name($first_name) {
    $reg_exp = "/^[а-яё]+[0-9а-яё_-]?+|^[a-z]+[a-z0-9_-]?+$|^\s*$/iu";

    if( !preg_match($reg_exp, $first_name) ){
        return 'Русские или латинские буквы';
    }

    $query = "SELECT first_name FROM users WHERE first_name = :first_name";
    $result = $GLOBALS['pdo']->prepare($query);
    $result->bindParam(':first_name', $first_name);
    $result->execute();
}

function  validate_last_name($last_name) {
    $reg_exp = "/^[а-яё]+[0-9а-яё_-]?+|^[a-z]+[a-z0-9_-]?+$|^\s*$/iu";

    if( !preg_match($reg_exp, $last_name) ){
        return 'Русские или латинские буквы';
    }

    $query = "SELECT last_name FROM users WHERE last_name = :last_name";
    $result = $GLOBALS['pdo']->prepare($query);
    $result->bindParam(':last_name', $last_name);
    $result->execute();
}

function validate_password($password){

    if(strlen($password) === 0){
        return 'Введите пароль';
    }elseif (mb_strlen($password) < 8){
        return 'Пароль должен быть 8 и более символов';
    }
}

function stretch_phone($phone) {
    return ( int )(preg_replace("/^\+7\(|\)|\+/i", "", $phone));
}

// EOF VALIDATE FUNCTIONS

function process_form($input) {
    $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users ( email, phone, display_name, first_name, last_name, password, avatar)
                        VALUES (?,?,?,?,?,?,?);";
    $result = $GLOBALS['pdo']->prepare($query);
    var_dump($input['display_name']);
    $result->execute( [ 
        $input['email'], 
        stretch_phone($input['phone']), 
        strlen($input['display_name']) > 0 ? $input['display_name'] : NULL, 
        strlen($input['first_name']) > 0 ? $input['first_name'] : NULL, 
        strlen($input['last_name']) > 0 ? $input['last_name'] : NULL, 
        $input['password'],
        NULL
        ] );

    // session_start();
    // $_SESSION['valid_user'] = $input['email'];
    start_session($input);
    
    // echo "<script>window.location.href='index.php';</script>";
    header('Location: index.php');
}

function showSugnupForm( $errors = [], $input = []  ) {
    
    $fields = [ 
        'email', 
        'phone', 
        'display_name', 
        'first_name', 
        'last_name', 
        'password'
    ];

    foreach ($fields as $field){
        if( !isset($errors[$field]) ) $errors[$field] = '';
        if( !isset($input[$field]) ) $input[$field] = '';
    }

    echo <<<_HTML_
    <form class="formdata" action="" method="POST">
        <div class="formdata-item formdata-item--required">
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
        <div class="formdata-item formdata-item--required">
            <input 
                id="phone"
                class="formdata-field " 
                type="tel" maxlength="20" 
                name="phone" 
                aria-label="Phone" 
                placeholder="Phone"
                value="$input[phone]"
                autocomplete="off" 
                required
            /><br/>
            <span class="formdata-error">$errors[phone]</span>
        </div>
        <div class="formdata-item">
            <input 
                id="displayName"
                class="formdata-field" 
                type="text" 
                name="display name" 
                aria-label="Display name" 
                placeholder="display name"
                value="$input[display_name]"
                autocomplete="off" 
            /><br/>
            <span class="formdata-error">$errors[display_name]</span>
        </div>
        <div class="formdata-item">
            <input 
                id="first_name"
                class="formdata-field" 
                type="text" 
                name="first_name" 
                aria-label="First name" 
                placeholder="First name"
                value="$input[first_name]"
                autocomplete="off" 
            /><br/>
            <span class="formdata-error">$errors[first_name]</span>
        </div>
        <div class="formdata-item">
            <input 
                id="last_name"
                class="formdata-field" 
                type="text" 
                name="last_name" 
                aria-label="Last name" 
                placeholder="Last name"
                value="$input[last_name]"
                autocomplete="off" 
            /><br/>
            <span class="formdata-error">$errors[last_name]</span>
        </div>
        <div class="formdata-item formdata-item--required">
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
            <input type="submit" id="submit" class="formdata-button" value="Регистрация" />
        </div>
    </form>
_HTML_;
}
echo "</section>";
?>