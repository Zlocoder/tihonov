<?PHP
$tfstats = time() - 60*60*24;
$db->Query("SELECT 
(SELECT COUNT(*) FROM db_users_a) all_users,
(SELECT SUM(insert_sum) FROM db_users_b) all_insert, 
(SELECT SUM(payment_sum) FROM db_users_b) all_payment, 
(SELECT COUNT(*) FROM db_users_a WHERE date_reg > '$tfstats') new_users");
$stats_data = $db->FetchArray();

?>

<div class="stat">
<div class="h-title">Статистика</div>	
	<div class="st-lf">

<b>
	<div class="line">Всего участников: </div>
	<div class="line">Новых за 24 часа: </div>
	<div class="line">Выплачено всего: </div>
	<div class="line">Пополнено всего: </div>
        <div class="line">Проект работает: </div>
</b>
	</div>

	<div class="st-rg">
<br>

<b>
	<div class="line-st"><?=sprintf($stats_data["all_users"]+301) ?> чел.</div>
	<div class="line-st"><?=sprintf($stats_data["new_users"]) ?> чел.</div>
        <div class="line-st"><?=sprintf("%.2f",$stats_data["all_payment"]); ?> <?=$config->VAL; ?></div>
     <div class="line-st"><?=sprintf("%.2f",($stats_data["all_insert"]+15731)*0.90); ?> <?=$config->VAL; ?></div>	
        <div class="line-st"><?=intval(((time() - $config->SYSTEM_START_TIME) / 86400 ) +1); ?> - й день </div>
</b>
</div>
<div class="clr"></div>
</div>
</div>

	




