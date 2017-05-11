<?PHP
$_OPTIMIZATION["title"] = "Конкурс рефералов";
$_OPTIMIZATION["description"] = "Конкурс рефералов";
$_OPTIMIZATION["keywords"] = "Конкурс, конкурс рефералов";

include __DIR__ . '/account/_account_menu.php';
?>

<h3>КОНКУРС РЕФЕРАЛОВ</h3>



<?PHP

# Список конкурсов
if(isset($_GET["list"])){


	# Список пользователей
	$db->Query("SELECT * FROM db_competition WHERE status > 0");
	if($db->NumRows() > 0){
	
	?>
	
	
	<?PHP
		while($data = $db->FetchArray()){
		
		?>
			<table class="bordered centered">
                <thead>
			        <tr>
                        <th align="center" width="75" class="m-tb">ID</th>
                        <th align="center" class="m-tb">Начат</th>
                        <th align="center" class="m-tb">Завершен</th>
                        <th align="center" class="m-tb">Фонд</th>
                    </tr>
                </thead>
			<tr class="htt" >
				<td align="center"><?=$data["id"]; ?></td>
				<td align="center"><?=date("d.m.Y", $data["date_add"]); ?></td>
				<td align="center"><?=date("d.m.Y", $data["date_end"]); ?></td>
				<td align="center"><?=$data["1m"]+$data["2m"]+$data["3m"]; ?> RUB</td>
		 	</tr>
			<tr bgcolor="#efefef">
				<td align="center" width="75" class="m-tb">Статус</td>
				<td align="center" class="m-tb">1 место / приз</td>
				<td align="center" class="m-tb">2 место / приз</td>
				<td align="center" class="m-tb">3 место / приз</td>
			</tr>
			<tr class="htt" >
				<td align="center"><?=($data["status"] > 1) ? "Отменен" : "Завершен"; ?></td>
				<td align="center"><?=$data["user_1"]; ?> / <?=$data["1m"]; ?></td>
				<td align="center"><?=$data["user_2"]; ?> / <?=$data["2m"]; ?></td>
				<td align="center"><?=$data["user_3"]; ?> / <?=$data["3m"]; ?></td>
		 	</tr>
			</table>
		<BR /><BR />
		<?PHP
		}

	}else $return = 'Нет завершенных конкурсов';


?>

<?PHP

return;
}


$db->Query("SELECT * FROM db_competition WHERE status = 0 LIMIT 1");
if($db->NumRows() == 1){
$comp = $db->FetchArray();	
	?>
<b>Конкурс рефералов № <?=$comp["id"]; ?> с общим призовым фондом <?=$comp["1m"]+$comp["2m"]+$comp["3m"]; ?> RUB<BR /><BR />
Старт конкурса: <?=date("d.m.Y в H:i:s", $comp["date_add"]); ?> <BR />Завершение: <?=date("d.m.Y в H:i:s", $comp["date_end"]); ?>
<BR /><BR />
<u>Призовые места:</u><BR />
1 - <?=$comp["1m"]; ?> RUB <BR />
2 - <?=$comp["2m"]; ?> RUB <BR />
3 - <?=$comp["3m"]; ?> RUB <BR /><BR />

В конкурсе учитываются только активные рефералы, которые зарегистрировались после запуска конкурса. <BR />За каждое пополнение баланса Вашим рефералом Вам начисляются баллы, 1 RUB = 1 баллу. Чем больше баллов, тем больше шанс победить в конкурсе. <BR /><BR />
</b>
	<?PHP
	
	# Список пользователей
	$db->Query("SELECT * FROM db_competition_users ORDER BY points DESC LIMIT 100");
	if($db->NumRows() > 0){
	
	?>
	<h4>Таблица лидеров</h4>
<table width="99%" border="0" align="center">
  <tr bgcolor="#efefef">
    <td align="center" width="75" class="m-tb">Позиция</td>
    <td align="center" class="title7">Пользователь</td>
    <td align="center" class="title7">Баллов</td>
	<td align="center" class="title7">Приз</td>
  </tr>
	<?PHP
		$position = 1;
		while($data = $db->FetchArray()){
		
		?>
			<tr class="htt" >
				<td align="center" width="75" class="message1"><?=$position; ?></td>
				<td align="center" class="message1"><?=$data["user"]; ?></td>
				<td align="center" class="message1"><?=sprintf("%.0f",$data["points"]); ?></td>
				<td align="center" class="message1"><?=(intval($comp["{$position}m"]) > 0) ? $comp["{$position}m"]." RUB" : "-" ?></td>
		 	</tr>
		<?PHP
		$position++;
		}
	
	?>
</table>
<BR />
	<?PHP
	
	}else echo "Нет участников в конкурсе";

}else echo "В данный момент конкурс не проводится";

?>
