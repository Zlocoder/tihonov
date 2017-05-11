

<?PHP
$_OPTIMIZATION["title"] = "Аккаунт - Заказ выплаты";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

$status_array = array( 0 => "Проверяется", 1 => "Выплачивается", 2 => "Отменена", 3 => "Выплачено");

# Минималка монетами!
$minPay = 1;
$min_insert = 30;

?>

<div class="row">
    <div class="col s12">
        <h3>заказ выплаты</h3>
    </div>
</div>

<div class="row">
    <div class="col offset-s2"></div>
    <div class="col s8">
        <p>
            Выплаты осуществляются в автоматическом режиме на платежную систему PAYEER! Минимальная сумма для выплаты составляет 1 EPR = 1 рублю!

        </p>
    </div>
    <div class="col offset-s2"></div>
</div>


<?PHP
	
	function ViewPurse($purse){
		
		if( substr($purse,0,1) != "P" ) return false;
		if( @!ereg("^[0-9]{7,8}$", substr($purse,1)) ) return false;
		return $purse;
	}
	
	# Заносим выплату
	if(isset($_POST["purse"])){
		
		$purse = ViewPurse($_POST["purse"]);
		$sum = intval($_POST["sum"]);
		$val = "RUB";
		
		if($purse !== false){
			
				if($sum >= $minPay){
				
					if($sum <= $user_data["money_p"]){
						
						# Проверяем на существующие заявки
						$db->Query("SELECT COUNT(*) FROM db_payment WHERE user_id = '$usid' AND (status = '0' OR status = '1')");
						if($db->FetchRow() == 0){
								
								
							### Делаем выплату ###	
							$payeer = new rfs_payeer($config->AccountNumber, $config->apiId, $config->apiKey);
							if ($payeer->isAuth()){
								
								$arBalance = $payeer->getBalance();
								if($arBalance["auth_error"] == 0){
									
									$sum_pay = round( ($sum / $sonfig_site["ser_per_wmr"]), 2);
									
									$balance = $arBalance["balance"]["RUB"]["DOSTUPNO"];
									if( ($balance) >= ($sum_pay)){
									
									
									
									$arTransfer = $payeer->transfer(array(
									'curIn' => 'RUB', // счет списания
									'sum' => $sum_pay, // сумма получения
									'curOut' => 'RUB', // валюта получения
									'to' => $purse, // получатель (email)
									//'to' => '+71112223344',  // получатель (телефон)
									//'to' => 'P1000000',  // получатель (номер счета)
									'comment' => iconv('windows-1251', 'utf-8', "Выплата пользователю {$usname} с проекта Etenally")
									//'anonim' => 'Y', // анонимный перевод
									//'protect' => 'Y', // протекция сделки
									//'protectPeriod' => '3', // период протекции (от 1 до 30 дней)
									//'protectCode' => '12345', // код протекции
									));
									
										if (!empty($arTransfer["historyId"])){
										
										
											# Снимаем с пользователя
											$db->Query("UPDATE db_users_b SET money_p = money_p - '$sum' WHERE id = '$usid'");
											
											# Вставляем запись в выплаты
											$da = time();
											$dd = $da + 60*60*24*15;
											
											$ppid = $arTransfer["historyId"];
											
											$db->Query("INSERT INTO db_payment (user, user_id, purse, sum, valuta, serebro, payment_id, date_add, status) 
											VALUES ('$usname','$usid','$purse','$sum_pay','RUB', '$sum','$ppid','".time()."', '3')");
											
											$db->Query("UPDATE db_users_b SET payment_sum = payment_sum + '$sum_pay' WHERE id = '$usid'");
											$db->Query("UPDATE db_stats SET all_payments = all_payments + '$sum_pay' WHERE id = '1'");
											
											$return = 'Выплачено!';
											
										}else{

                                            $return = 'Ошибка вывода - сообщите администратору!';
										
										}
									
									}else $return = 'Ошибка вывода - сообщите администратору!';
									
								}else $return = 'Ошибка вывода - сообщите администратору!';
								
							}else $return = 'Ошибка вывода - сообщите администратору!';
							
								
						}else $return = 'Ошибка вывода - сообщите администратору!';
							
						
					}else $return = 'Вы указали больше ERP, чем имеется на вашем счету для вывода!';
				
				}else $return = "Минимальная сумма для выплаты составляет {$minPay} ERP!";
		
		}else $return = 'Кошелек PAYEER указан неверно! Смотрите пример!';
		
	}

	if($user_data['insert_sum'] < 30){
	    echo '<h4>Выплаты откроются после пополнения баланса минимум на 30 рублей!</h4>';
    }else{ ?>

        <div class="row">
            <div class="col s12 center-align">
                <div class="account-alert">
                    <?= $return ?>
                </div>
            </div>
        </div>

<div class="row">
    <div class="col offset-s2"></div>
    <div class="col s8">
        <form action="" method="post">
            <label for="payeer">Кошелек Payeer (P12345678)</label>
            <input type='text'  placeholder='Введите кошелек Payeer ' name='purse' id="payeer">
            <label for="sum">Кол-во EPR (min 1)</label>
            <input type="text" name="sum" id="sum" />

            <button class="btn right">Заказать</button>
        </form>
    </div>
    <div class="col offset-s2"></div>
</div>





<div class="row">
    <div class="col s12 ">
        <h4>Последние 10 выплат</h4>
    </div>
</div>

<div class="row">

    <div class="col s12">
        <table class="bordered">
            <thead>
            <tr>
                <th align="center" class="title7">Монеты</th>
                <th align="center" class="title7">Получили</th>
                <th align="center" class="title7">Кошелек</th>
                <th align="center" class="title7">Дата</th>
                <th align="center" class="title7">Статус</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $db->Query("SELECT * FROM db_payment WHERE user_id = '$usid' ORDER BY id DESC LIMIT 20");

            if($db->NumRows() > 0){

                while($ref = $db->FetchArray()){

                    ?>
                    <tr class="htt">
                        <td><?=$ref["serebro"]; ?></td>
                        <td><?=sprintf("%.2f",$ref["sum"] - $ref["comission"]); ?> <?=$ref["valuta"]; ?></td>
                        <td><?=$ref["purse"]; ?></td>
                        <td><?=date("d.m.Y",$ref["date_add"]); ?></td>
                        <td><?=$status_array[$ref["status"]]; ?></td>
                    </tr>
                    <?PHP

                }

            }else echo '<tr><td colspan="5">Нет записей</td></tr>'

            ?>
            </tbody>
        </table>
    </div>

</div>

    <?php } ?>

