<?php
function d($arr){
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

//переменные для подключения

$login = 'root'; // логин
$password = ''; // пароль
$host = 'localhost'; // имя хоста
$db_name = 'bit_shop'; // названиедб

//создание объекта подключения
// $pdo = new PDO("mysql:host=$host; dbname=$db_name", $login, $password);
try {
	return new PDO("mysql:host=$host; dbname=$db_name", $login, $password);
    echo  'Подключение установлено';
} catch (PDOException $e) {
	die($e->getMessage());
}
// return new PDO("mysql:host=$host; dbname=$db_name", $login, $password);
// echo  'Подключение установлено';


// // дляхостинга
// $login = 'f0686662_user';
// $password = '123456';
// $host = 'localhost';
// $db_name = 'f0686662_test';

// $pdo = new PDO("mysql:host=$host; dbname=$db_name", $login, $password);

// echo ' подключено';

