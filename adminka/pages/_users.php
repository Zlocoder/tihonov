<div class="wrap">
<br />
<center>
<div class="block3" style="margin-left:-0px">
<div class="b-title">Админка</div>
<div style="height:57px;"></div>
<center>

<a href="/adminka/"  class="button7">Статистика проекта</a>
<br />
<a href="index.php?menu=users" class="button7">Список пользователей</a>
<br />
<a href="index.php?menu=viplat" class="button7">Выплаты</a>
</center>
</div>


<div class="block3" style="margin-left:-0px">
<div class="b-title">Админка</div>
<div style="height:57px;"></div>
<center>

<a href="index.php?menu=story_insert"  class="button7">Пополнения</a>
<br />
<a href="index.php?menu=story_buy" class="button7">Покупки</a>
<br />
<a href="index.php?menu=story_swap" class="button7">Обмены</a>
</center>
</div>


<div class="block3" style="margin-left:-0px">
<div class="b-title">Админка</div>
<div style="height:57px;"></div>
<center>

<a href="index.php?menu=story_sell"  class="button7">Продажи</a>
<br />
<a href="index.php?menu=news" class="button7">Новости</a>
<br />
<a href="index.php?menu=compconfig" class="button7">Конкурс рефералов</a>
</center>
</div>

<div class="block3" style="margin-left:-0px">
<div class="b-title">Админка</div>
<div style="height:57px;"></div>
<center>

<a href="index.php?menu=top"  class="button7">ТОП выплат</a>
<br />
<a href="#" class="button7">Свободное место</a>
<br />
<a href="/account/exit" class="button7">Выход</a>
</center>
</div>
</center>

<br />

<center><div style="padding:0px; ">
<div class="">	
<div class="s-bk-lf">
	<div class="tit">Пользователи</div>
</div>
<div style="padding:20px">
<div class="silver-bk">
<div class="clr"></div>	
<?PHP
# Редактирование пользователя
if(isset($_GET["edit"])){

$eid = intval($_GET["edit"]);

$db->Query("SELECT *, INET_NTOA(db_users_a.ip) uip FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_b.id = '$eid' LIMIT 1");

# Проверяем на существование
if($db->NumRows() != 1){ echo "<center><b>Указанный пользователь не найден</b></center><BR />"; }

# Добавляем дерево
if(isset($_POST["set_tree"])){

$tree = $_POST["set_tree"];
$type = ($_POST["type"] == 1) ? "-1" : "+1";

	$db->Query("UPDATE db_users_b SET {$tree} = {$tree} {$type} WHERE id = '$eid'");
	$db->Query("SELECT *, INET_NTOA(db_users_a.ip) uip FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_b.id = '$eid' LIMIT 1");
	echo "<center><b>Дерево добавлено</b></center><BR />";
	
}


# Пополняем баланс
if(isset($_POST["balance_set"])){

$sum = intval($_POST["sum"]);
$bal = $_POST["schet"];
$type = ($_POST["balance_set"] == 1) ? "-" : "-";

$string = ($type == "-") ? "У пользователя снято {$sum} монет" : "Пользователю добавлено {$sum} монет/баллов";

	$db->Query("UPDATE db_users_b SET {$bal} = {$bal} {$type} {$sum} WHERE id = '$eid'");
	$db->Query("SELECT *, INET_NTOA(db_users_a.ip) uip FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_b.id = '$eid' LIMIT 1");
	echo "<center><b>$string</b></center><BR />";
	
}


# Забанить пользователя
if(isset($_POST["banned"])){

	$db->Query("UPDATE db_users_a SET banned = '".intval($_POST["banned"])."' WHERE id = '$eid'");
	$db->Query("SELECT *, INET_NTOA(db_users_a.ip) uip FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_b.id = '$eid' LIMIT 1");
	echo "<center><b>Пользователь ".($_POST["banned"] > 0 ? "забанен" : "разбанен")."</b></center><BR />";
	
}

# Забанить пользователя
if(isset($_POST["tiket_blok"])){

	$db->Query("UPDATE db_users_a SET tiket_blok = '".intval($_POST["tiket_blok"])."' WHERE id = '$eid'");
	$db->Query("SELECT *, INET_NTOA(db_users_a.ip) uip FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_b.id = '$eid' LIMIT 1");
	echo "<center><b>Пользователь ".($_POST["tiket_blok"] > 0 ? "забанен" : "разбанен")."</b></center><BR />";
	
}

$data = $db->FetchArray();

?>

<table width="100%" border="0">
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">ID:</td>
    <td width="200" align="center"><?=$data["id"]; ?></td>
  </tr>
  <tr>
    <td style="padding-left:10px;">Логин:</td>
    <td width="200" align="center"><?=$data["user"]; ?></td>
  </tr>
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Email:</td>
    <td width="200" align="center"><?=$data["email"]; ?></td>
  </tr>
  <tr>
    <td style="padding-left:10px;">Пароль:</td>
    <td width="200" align="center"><?=$data["p ass"]; ?>*******</td>
  </tr>
  
  
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Монеты (Покупки):</td>
    <td width="200" align="center"><?=sprintf("%.2f",$data["money_b"]); ?></td>
  </tr>
  
  <tr>
    <td style="padding-left:10px;">Монеты (Вывод):</td>
    <td width="200" align="center"><?=sprintf("%.2f",$data["money_p"]); ?></td>
  </tr>
  
  
 
  <tr>
    <td style="padding-left:10px;">Лентяй:</td>
    <td width="200" align="center">
	
		<table width="100%" border="0">
		  <tr>
			<td>
			<form action="" method="post">
				<input type="hidden" name="set_tree" value="a_t" />
				<input type="hidden" name="type" value="1" />
				<input type="submit" value="-1" />
			</form>
			</td>
			<td align="center"><?=$data["a_t"]; ?> шт.</td>
			<td>
			<form action="" method="post">
				<input type="hidden" name="set_tree" value="a_t" />
				<input type="hidden" name="type" value="2" />
				<input type="submit" value="+1" />
			</form>
			</td>
		  </tr>
		</table>

	</td>
  </tr>

  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Обжора:</td>
    <td width="200" align="center">
	
		<table width="100%" border="0">
		  <tr>
			<td>
			<form action="" method="post">
				<input type="hidden" name="set_tree" value="b_t" />
				<input type="hidden" name="type" value="1" />
				<input type="submit" value="-1" />
			</form>
			</td>
			<td align="center"><?=$data["b_t"]; ?> шт.</td>
			</td>
				<td>
			<form action="" method="post">
				<input type="hidden" name="set_tree" value="b_t" />
				<input type="hidden" name="type" value="2" />
				<input type="submit" value="+1" />
			</form>
			</td>
		  </tr>
		</table>

	</td>
  </tr>

  <tr>
    <td style="padding-left:10px;">Остряк:</td>
    <td width="200" align="center">
	
		<table width="100%" border="0">
		  <tr>
			<td>
			<form action="" method="post">
				<input type="hidden" name="set_tree" value="c_t" />
				<input type="hidden" name="type" value="1" />
				<input type="submit" value="-1" />
			</form>
			</td>
			<td align="center"><?=$data["c_t"]; ?> шт.</td>
			<td>
			<form action="" method="post">
				<input type="hidden" name="set_tree" value="c_t" />
				<input type="hidden" name="type" value="2" />
				<input type="submit" value="+1" />
			</form>
			</td>
		  </tr>
		</table>

	</td>
  </tr>

  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Трудяга:</td>
    <td width="200" align="center">
	
		<table width="100%" border="0">
		  <tr>
			<td>
			<form action="" method="post">
				<input type="hidden" name="set_tree" value="d_t" />
				<input type="hidden" name="type" value="1" />
				<input type="submit" value="-1" />
			</form>
			</td>
			<td align="center"><?=$data["d_t"]; ?> шт.</td>
			<td>
			<form action="" method="post">
				<input type="hidden" name="set_tree" value="d_t" />
				<input type="hidden" name="type" value="2" />
				<input type="submit" value="+1" />
			</form>
			</td>
		  </tr>
		</table>
		
	
	</td>
  </tr>

  
  
  
  <tr>
    <td style="padding-left:10px;">Referer:</td>
    <td width="200" align="center">[<?=$data["referer_id"]; ?>]<?=$data["referer"]; ?></td>
  </tr>
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Рефералов:</td>
	
	<?PHP
	$db->Query("SELECT COUNT(*) FROM db_users_a WHERE referer_id = '".$data["id"]."'");
	$counter_res = $db->FetchRow();
	?>
	
  <td width="200" align="center"><?=$data["referals"]; ?> [<?=$counter_res; ?>] чел.</td>
  </tr>
  
  <tr>
    <td style="padding-left:10px;">Заработал на рефералах:</td>
    <td width="200" align="center"><?=sprintf("%.2f",$data["from_referals"]); ?> монет</td>
  </tr>
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Принес рефереру:</td>
    <td width="200" align="center"><?=sprintf("%.2f",$data["to_referer"]); ?> монет</td>
  </tr>
  
  
  
  <tr>
    <td style="padding-left:10px;">Зарегистрирован:</td>
    <td width="200" align="center"><?=date("d.m.Y в H:i:s",$data["date_reg"]); ?></td>
  </tr>
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Последний вход:</td>
    <td width="200" align="center"><?=date("d.m.Y в H:i:s",$data["date_login"]); ?></td>
  </tr>
  <tr>
    <td style="padding-left:10px;">Последний IP:</td>
    <td width="200" align="center"><?=$data["uip"]; ?></td>
  </tr>
  
  
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Пополнено на баланс:</td>
    <td width="200" align="center"><?=sprintf("%.2f",$data["insert_sum"]); ?> <?=$config->VAL; ?></td>
  </tr>
  <tr>
    <td style="padding-left:10px;">Выплачено на кошелек:</td>
    <td width="200" align="center"><?=sprintf("%.2f",$data["payment_sum"]); ?> <?=$config->VAL; ?></td>
  </tr>
  
 
  
  
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Забанен (<?=($data["banned"] > 0) ? '<font color = "black"><b>ДА</b></font>' : '<font color = "green"><b>НЕТ</b></font>'; ?>):</td>
    <td width="200" align="center">
	<form action="" method="post">
	<input type="hidden" name="banned" value="<?=($data["banned"] > 0) ? 0 : 1 ;?>" />
	<input type="submit" value="<?=($data["banned"] > 0) ? 'Разбанить' : 'Забанить'; ?>" class="button25" style="height: 50px; margin-top:10px;"/>
	</form>
	</td>
  </tr>
  
  
</table>
<BR />
<BR />
<form action="" method="post">
<table width="100%" border="0">
  <tr bgcolor="#EFEFEF">
    <td align="center" colspan="4"><b>Операции с балансом:</b></td>
  </tr>
  <tr>
    <td align="center">
		<select name="balance_set">
			<option value="1">Снять с баланса</option>
		</select>
	</td>
	<td align="center">
		<select name="schet">
			<option value="money_b">Для покупок</option>
			<option value="money_p">Для вывода</option>
		</select>
	</td>
    <td align="center"><input type="text" name="sum" value="100" size="7"/></td>
    <td align="center"><input type="submit" value="Выполнить" class="button25" style="height: 50px; margin-top:10px;"/></td>
  </tr>
</table>
</form>
 </div> 
</div> 
            
	    </div> </div>
		
		</div>	</div>			
<br /><br />
<?PHP

return;
}

?>
<form action="index.php?menu=users&search" method="post">
<table width="250" border="0" align="center">
  <tr>
    <td><b>Логин:</b>&nbsp;&nbsp;</td>
    <td> <input type="text" name="sear" /></td>
	
	<td><input type="submit" value="Поиск" class="button25" style="height: 50px; margin-top:10px;"/> </td>
  </tr>
</table>
</form>
<BR />
<?PHP


function sort_b($int_s){
	
	$int_s = intval($int_s);
	
	switch($int_s){
	
		case 1: return "db_users_a.user";
		case 2: return "all_serebro";
		case 3: return "all_trees";
		case 4: return "db_users_a.date_reg";
		
		default: return "db_users_a.id";
	}

}
$sort_b = (isset($_GET["sort"])) ? intval($_GET["sort"]) : 0;

$str_sort = sort_b($sort_b);


$num_p = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"]) -1) : 0;
$lim = $num_p * 100;

if(isset($_GET["search"])){
$search = $_POST["sear"];
$db->Query("SELECT *, (db_users_b.a_t + db_users_b.b_t + db_users_b.c_t + db_users_b.d_t + db_users_b.e_t) all_trees, (db_users_b.money_b + db_users_b.money_p) all_serebro 
FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.user = '$search' ORDER BY {$str_sort} DESC LIMIT {$lim}, 100");

}else $db->Query("SELECT *, (db_users_b.a_t + db_users_b.b_t + db_users_b.c_t + db_users_b.d_t + db_users_b.e_t) all_trees, (db_users_b.money_b + db_users_b.money_p) all_serebro 
FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id ORDER BY {$str_sort} DESC LIMIT {$lim}, 100");



if($db->NumRows() > 0){

?>


	
	
	
  

<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' font-size: 8px; align='center' width="99%">
  <tr bgcolor="#efefef">
    <td align="center" width="50" class="title7"<a href="index.php?menu=users&sort=0" class="stn-sort">ID</a></td>
    <td align="center" class="title7"><a href="index.php?menu=users&sort=1" class="stn-sort">User</a></td>
    <td align="center" width="90" class="title7"><a href="index.php?menu=users&sort=2" class="stn-sort">Монет</a></td>
	<td align="center" width="75" class="title7"><a href="index.php?menu=users&sort=3" class="stn-sort">Пчел</a></td>
	<td align="center" width="100" class="title7"><a href="index.php?menu=users&sort=4" class="stn-sort">Дата</a></td>
	<td align="center" width="100" class="title7"><a href="index.php?menu=users&sort=5" class="stn-sort">Откуда</a></td>
    <td align="center" width="m-tb" class="title7"><a href="index.php?menu=users&sort=6" class="stn-sort">Referer</a></td>
	<td align="center" width="m-tb" class="title7"><a href="index.php?menu=users&sort=8" class="stn-sort">На рефах</a></td>
	<td align="center" width="m-tb" class="title7"><a href="index.php?menu=users&sort=9" class="stn-sort">Пополнил</a></td>
	<td align="center" width="m-tb" class="title7"><a href="index.php?menu=users&sort=10" class="stn-sort">Вывел</a></td>
  </tr>


<?PHP

	while($data = $db->FetchArray()){
		
	
	?>
	
	
	<tr>
    <td align="center" class="message1"><?=$data["id"]; ?></td>
    <td align="center" class="message1"><a href="index.php?menu=users&edit=<?=$data["id"]; ?>" class="stn"><?=$data["user"]; ?></a></td>
    <td align="center" class="message1"><?=sprintf("%.2f",$data["all_serebro"]); ?></td>
	<td align="center" class="message1"><?=$data["all_trees"]; ?></td>
	<td align="center" class="message1"><?=date("d.m",$data["date_reg"]); ?></td>
	<td align="center" class="message1"><?=$data["url"]; ?></td> 
    <td align="center" class="message1"><?=$data["referer"]; ?></td>
	<td align="center" class="message1"><?=round($data["from_referals"],2); ?></td>
	<td align="center" class="message1"><?=round($data["insert_sum"],2); ?></td>
	<td align="center" class="message1"><?=round($data["payment_sum"],2); ?></td>
  	</tr>
	<?PHP
	
	}

?>

</table>
<BR />
<?PHP


}else echo "<center><b>На данной странице нет записей</b></center><BR />";

	if(isset($_GET["search"])){
	
	?>
	</div>
	<div class="clr"></div>	
	<?PHP
	
		return;
	
	}
	
$db->Query("SELECT COUNT(*) FROM db_users_a");
$all_pages = $db->FetchRow();

	if($all_pages > 100){
	
	$sort_b = (isset($_GET["sort"])) ? intval($_GET["sort"]) : 0;
	
	$nav = new navigator;
	$page = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"])) : 1;
	
	echo "<BR /><center>".$nav->Navigation(10, $page, ceil($all_pages / 100), "index.php?menu=users&sort={$sort_b}&page="), "</center>";
	
	}
?>
 </div> 
</div> 
            
	    </div> </div>
		
		</div>	</div>			
<br /><br />