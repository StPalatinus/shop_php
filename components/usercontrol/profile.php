<section id="site_content" class="site_content">
<?php


if($_SERVER['REQUEST_METHOD'] === 'POST'){// если форма отправлена
    d($_POST);

    // list($errors, $input) = validate_form();

    // if($errors){// если есть ошибки
    // show_form($errors, $input); // показываем форму
    // }else{ // если ош нет
    // process_form($input);// регистрируем пользователя
    // }
    // }else{// если стр загружена впервые
    // show_form(); // показываем форму
    // header('Location: ./index.php?page=main');
}

    echo <<<_HTML_
    <form class="formdata" action="" method="POST">
        <div class="formdata-item">
            <input 
                id="email"
                class="formdata-field formdata-field--required" 
                type="email" 
                name="email" 
                aria-label="Email" 
                placeholder="Email"
                autocomplete="off" 
                value=""
                required 
                autofocus
            />
            <span>$errors[email]VVV</span>
        </div>
        <div class="formdata-item">
            <input 
                id="phone"
                class="formdata-field formdata-field--required" 
                type="tel" maxlength="20" 
                name="phone" 
                aria-label="Phone" 
                placeholder="Phone"
                autocomplete="off" 
                required
            />
            <span>$errors[phone]</span>
        </div>
        <div class="formdata-item">
            <input 
                id="login"
                class="formdata-field" 
                type="text" 
                name="login" 
                aria-label="Login" 
                placeholder="Login"
                autocomplete="off" 
            />
            <span>$errors[login]</span>
        </div>
        <div class="formdata-item">
            <input 
                id="firstName"
                class="formdata-field" 
                type="text" 
                name="First name" 
                aria-label="First name" 
                placeholder="First name"
                autocomplete="off" 
            />
            <span>$errors[fName]</span>
        </div>
        <div class="formdata-item">
            <input 
                id="lastName"
                class="formdata-field" 
                type="text" 
                name="Last name" 
                aria-label="Last name" 
                placeholder="Last name"
                autocomplete="off" 
            />
            <span>$errors[lName]</span>
        </div>
        <div class="formdata-item">
            <input 
                id="password"
                class="formdata-field formdata-field--required" 
                type="password" 
                name="password" 
                maxlength="20" 
                aria-label="Password" 
                placeholder="Password" 
                required
            >
            <span>$errors[password]</span>
        </div>
        <div class="formdata-item">
            <input type="submit" id="submit" class="formdata-button" value="Sign Up" />
        </div>
    </form>
_HTML_;
    ?>
</section>

           