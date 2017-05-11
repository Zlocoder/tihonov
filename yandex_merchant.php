<?PHP
######################################
# ������ YandexMoney ������ Fruit Farm
# ����� APTEMOH
# E-mail: ArtIncProject@yandex.ru
# Skype: ArtIncProject
######################################

# ������������� �������
function __autoload($name){ include("classes/_class.".$name.".php");}

# ����� �������
$config = new config;

# �������
$func = new func;

# ���� ������
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);

# ���������� ����
$secret_key = 'Wc1V2noyYEnZ3JpmiRxRIfTU';


$wallet = $_POST['sender'];

$ik_payment_amount = $_POST['amount'];

$operation_id = $_POST['operation_id'];

$secret_hashy = $_POST['notification_type'];

$id_insert = $_POST['label'];

// �������� ��������� �� ����������������� ���������� ��� ����������
// $_POST['operation_id'] - ����� ��������
// $_POST['amount'] - ���������� �����, ������� �������� �� ���� ����������
// $_POST['withdraw_amount'] - ���������� �����, ������� ����� ������� �� ����� ����������
// $_POST['datetime'] - ��� �������, ���� � ����� ������
// $_POST['sender'] - ���� ������ ������������ ����� ������ ������, �� ���� �������� �������� ����� �������� ����������
// $_POST['label'] - �����, ������� �� ��������� � ����� ������
// $_POST['email'] - email ���������� (�������� ������ ��� ������������� https://)

$sha1 = sha1( $_POST['notification_type'] . '&'. $_POST['operation_id']. '&' . $_POST['amount'] . '&643&' . $_POST['datetime'] . '&'. $_POST['sender'] . '&' . $_POST['codepro'] . '&' . $secret_key. '&' . $_POST['label'] );

if ($sha1 != $_POST['sha1_hash'] ) {
	// ��� ���������� ��� �� ������, ���� ����������� �� ��������
	exit();
}

	// ��� ��� �� ������, ���� �������� ������ �������
	//exit();

	$db->Query("SELECT * FROM `db_payeer_insert` WHERE id = '".intval($_POST['label'])."'");
	if($db->NumRows() == 0){ echo $_POST['label']."|error"; exit;}

	$payeer_row = $db->FetchArray();

	if($payeer_row["status"] > 0){ echo $_POST['label']."|success"; exit;}

	$db->Query("UPDATE db_payeer_insert SET status = '1' WHERE id = '".intval($_POST['label'])."'");

	$ik_payment_amount = $_POST['amount']; #$payeer_row["sum"];
	$user_id = $payeer_row["user_id"];


	# ���������
	$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
	$sonfig_site = $db->FetchArray();

    $db->Query("SELECT user, referer_id FROM db_users_a WHERE id = '{$user_id}' LIMIT 1");
    $user_ardata = $db->FetchArray();
    $user_name = $user_ardata["user"];
    $refid = $user_ardata["referer_id"];

    # ��������� ������
    $serebro = sprintf("%.4f", floatval($sonfig_site["ser_per_wmr"] * $ik_payment_amount) );

    $db->Query("SELECT insert_sum FROM db_users_b WHERE id = '{$user_id}' LIMIT 1");
    $ins_sum = $db->FetchRow();

   
    
    $lsb = time();
    $to_referer = ($serebro * 0.10); //����������� 10%
	
	$serebro = intval($ins_sum <= 0.01) ? ($serebro + ($serebro * 0.15) ) : $serebro; // ��� ������ ���������� +15%

	# ��������� �������� ��� )
	$db->Query("UPDATE db_users_b
    			SET money_b = money_b + '$serebro',    			   
    			    to_referer = to_referer + '$to_referer',
    			    last_sbor = '$lsb',
    			    insert_sum = insert_sum + '$ik_payment_amount'
    			WHERE id = '{$user_id}'");

    # ��������� �������� �������� � ������
       $db->Query("UPDATE db_users_b
    			SET money_b = money_b + $to_referer,
    				from_referals = from_referals + '$to_referer' {$add_tree_referer}
    			WHERE id = '$refid'");

    # ���������� ����������
    $da = time();
    $dd = $da + 60*60*24*15;
   	$db->Query("INSERT INTO db_insert_money (user, user_id, money, serebro, date_add, date_del)
  	 VALUES ('$user_name','$user_id','$ik_payment_amount','$serebro','$da','$dd')");
	 



# �������
$competition = new competition($db);
$competition->UpdatePoints($user_id, $ik_payment_amount);
#--------



	# ���������� ���������� �����
	$db->Query("UPDATE db_stats SET all_insert = all_insert + '$ik_payment_amount' WHERE id = '1'");

?>