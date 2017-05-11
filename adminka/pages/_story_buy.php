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
	<div class="tit">История покупок</div>
</div>
<div style="padding:20px">
<div class="silver-bk">
<div class="clr"></div>
<?PHP
$tdadd = time() - 5*60;
	if(isset($_POST["clean"])){
	
		$db->Query("DELETE FROM db_stats_btree WHERE date_add < '$tdadd'");
		echo "<center><font color = 'green'><b>Очищено</b></font></center><BR />";
	}

$db->Query("SELECT * FROM db_stats_btree ORDER BY id DESC");

if($db->NumRows() > 0){

?>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr>
    <td align="center" width="50" class="title7">ID</td>
    <td align="center" class="title7">Пользователь</td>
    <td align="center" width="75" class="title7">Дерево</td>
	<td align="center" width="75" class="title7">Цена</td>
	<td align="center" width="150" class="title7">Дата</td>
  </tr>


<?PHP

	while($data = $db->FetchArray()){
	
	?>
	<tr>
    <td align="center" width="50" class="message1"><?=$data["id"]; ?></td>
    <td align="center" class="message1"><?=$data["user"]; ?></td>
    <td align="center" width="75" class="message1"><?=$data["tree_name"]; ?></td>
	<td align="center" width="75" class="message1"><?=$data["amount"]; ?></td>
	<td align="center" width="150" class="message1"><?=date("d.m.Y в H:i:s",$data["date_add"]); ?></td>
  	</tr>
	<?PHP
	
	}

?>

</table>
<BR />
<form action="" method="post">
<center><input type="submit" name="clean" value="Очистить" class="button25"/></center>
</form>
<?PHP

}else echo "<center><b>Записей нет</b></center><BR />";
?>
 </div> 
</div> 
            
	    </div> </div>
		
		</div>	</div>			
<br /><br />