<?PHP
######################################
# Модуль YandexMoney Скрипт Fruit Farm
# Автор APTEMOH
# E-mail: ArtIncProject@yandex.ru
# Skype: ArtIncProject
######################################

# Автоподгрузка классов
function __autoload($name){ include("classes/_class.".$name.".php");}

# Класс конфига
$config = new config;

# Функции
$func = new func;

# База данных
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);

# Серкретный ключ
$secret_key = 'Wc1V2noyYEnZ3JpmiRxRIfTU';


$wallet = $_POST['sender'];

$ik_payment_amount = $_POST['amount'];

$operation_id = $_POST['operation_id'];

$secret_hashy = $_POST['notification_type'];

$id_insert = $_POST['label'];

// возможно некоторые из нижеперечисленных параметров вам пригодятся
// $_POST['operation_id'] - номер операция
// $_POST['amount'] - количество денег, которые поступят на счет получателя
// $_POST['withdraw_amount'] - количество денег, которые будут списаны со счета покупателя
// $_POST['datetime'] - тут понятно, дата и время оплаты
// $_POST['sender'] - если оплата производится через Яндекс Деньги, то этот параметр содержит номер кошелька покупателя
// $_POST['label'] - лейбл, который мы указывали в форме оплаты
// $_POST['email'] - email покупателя (доступен только при использовании https://)

$sha1 = sha1( $_POST['notification_type'] . '&'. $_POST['operation_id']. '&' . $_POST['amount'] . '&643&' . $_POST['datetime'] . '&'. $_POST['sender'] . '&' . $_POST['codepro'] . '&' . $secret_key. '&' . $_POST['label'] );

if ($sha1 != $_POST['sha1_hash'] ) {
	// тут содержится код на случай, если верификация не пройдена
	exit();
}

	// тут код на случай, если проверка прошла успешно
	//exit();

	$db->Query("SELECT * FROM `db_payeer_insert` WHERE id = '".intval($_POST['label'])."'");
	if($db->NumRows() == 0){ echo $_POST['label']."|error"; exit;}

	$payeer_row = $db->FetchArray();

	if($payeer_row["status"] > 0){ echo $_POST['label']."|success"; exit;}

	$db->Query("UPDATE db_payeer_insert SET status = '1' WHERE id = '".intval($_POST['label'])."'");

	$ik_payment_amount = $_POST['amount']; #$payeer_row["sum"];
	$user_id = $payeer_row["user_id"];


	# Настройки
	$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
	$sonfig_site = $db->FetchArray();

    $db->Query("SELECT user, referer_id FROM db_users_a WHERE id = '{$user_id}' LIMIT 1");
    $user_ardata = $db->FetchArray();
    $user_name = $user_ardata["user"];
    $refid = $user_ardata["referer_id"];

    # Зачисляем баланс
    $serebro = sprintf("%.4f", floatval($sonfig_site["ser_per_wmr"] * $ik_payment_amount) );

    $db->Query("SELECT insert_sum FROM db_users_b WHERE id = '{$user_id}' LIMIT 1");
    $ins_sum = $db->FetchRow();

   
    
    $lsb = time();
    $to_referer = ($serebro * 0.10); //реферальные 10%
	
	$serebro = intval($ins_sum <= 0.01) ? ($serebro + ($serebro * 0.15) ) : $serebro; // при первом пополнений +15%

	# Зачисляем средства НАМ )
	$db->Query("UPDATE db_users_b
    			SET money_b = money_b + '$serebro',    			   
    			    to_referer = to_referer + '$to_referer',
    			    last_sbor = '$lsb',
    			    insert_sum = insert_sum + '$ik_payment_amount'
    			WHERE id = '{$user_id}'");

    # Зачисляем средства рефереру и дерево
       $db->Query("UPDATE db_users_b
    			SET money_b = money_b + $to_referer,
    				from_referals = from_referals + '$to_referer' {$add_tree_referer}
    			WHERE id = '$refid'");

    # Статистика пополнений
    $da = time();
    $dd = $da + 60*60*24*15;
   	$db->Query("INSERT INTO db_insert_money (user, user_id, money, serebro, date_add, date_del)
  	 VALUES ('$user_name','$user_id','$ik_payment_amount','$serebro','$da','$dd')");
	 



# Конкурс
$competition = new competition($db);
$competition->UpdatePoints($user_id, $ik_payment_amount);
#--------



	# Обновление статистики сайта
	$db->Query("UPDATE db_stats SET all_insert = all_insert + '$ik_payment_amount' WHERE id = '1'");

?>