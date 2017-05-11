<?php

# Автоподгрузка классов
function __autoload($name){ include("classes/_class.".$name.".php");}

# Класс конфига
$config = new config;

# Функции
$func = new func;

# База данных
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);



//$db->Query("SELECT * FROM db_stats_btree");
//$sql = $db->FetchRow();

if($_POST['key_y']){
    $user = $_POST['user'];
//    $key_y = time();

    $db->Query("INSERT INTO db_nums_game (username) VALUES ('$user')");


}


$sql = $db->FetchRow($db->Query("SELECT * FROM db_nums_game"));

var_dump($sql);
echo '<br><br><br>';

$timestamp = strtotime($sql['key_y']);

echo  $timestamp;
echo '<br><br><br>';
//echo 'Ajax return';
var_dump($_POST);

//if($_POST['key_y']){
//    $_SESSION['key_y'] = $_POST['key_y'];
//}

//    echo $key_y;

$key_y = time()*2 + (99*0.8);
