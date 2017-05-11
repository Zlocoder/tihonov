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
	<div class="tit">История выплат</div>
</div>
<div style="padding:20px">
<div class="silver-bk">
<div class="clr"></div>
<center><a href="index.php?menu=viplat">Выплачено</a> || 
<a href="index.php?menu=viplat&list_day">По дням</a> || <a href="index.php?menu=viplat&last_31">График за 30 дней</a></center><BR />
<?PHP
# График
if(isset($_GET["last_31"])){
	
	$dlim = time() - 60*60*24*30;
	$db->Query("SELECT * FROM db_payment WHERE date_add > $dlim ORDER BY id DESC");
	
	$days_money = array();
	$days_insert = array();
	
	if($db->NumRows() > 0){
		
		while($data = $db->FetchArray()){
		$index = date("d.m.Y", $data["date_add"]);
		
			$days_money[$index] = (isset($days_money[$index])) ? $days_money[$index] + $data["sum"] : $data["sum"];
			$days_insert[$index] = (isset($days_insert[$index])) ? $days_insert[$index] + 1 : 1;
			
		}
	
	# Вывод
	if(count($days_money) > 0){
		
		$array_for_chart = array();
		$array_for_chart2 = array();
		$array_for_chart3 = array();
		
			foreach($days_money as $date => $sum){
			
				$array_for_chart[] = "['".$date."', ".round($sum)."]";
				$array_for_chart2[] = "['".$date."', ".$days_insert[$date]."]";
				$array_for_chart3[] = "['".$date."', ".round($sum / $days_insert[$date], 2)."]";
			
			}
			
			$retd = implode(", ", array_reverse($array_for_chart));
			$retd2 = implode(", ", array_reverse($array_for_chart2));
			$retd3 = implode(", ", array_reverse($array_for_chart3));
			
		?>

	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['День', 'Сумма'],
          <?=$retd; ?>
        ]);

        var options = {
          title: 'История Выплат (Сумма)',
          hAxis: {title: 'Last 30 Days',  titleTextStyle: {color: 'green'}}
        };

        var chart = new google.visualization.SteppedAreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
	<div id="chart_div" style="width: 100%; height: 500px;"></div>
	
	<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart2);
      function drawChart2() {
        var data2 = google.visualization.arrayToDataTable([
          ['День', 'Кол-во'],
          <?=$retd2; ?>
        ]);

        var options2 = {
          title: 'История Выплат (Кол-во)',
          hAxis: {title: 'Last 30 Days',  titleTextStyle: {color: 'green'}}
        };

        var chart2 = new google.visualization.SteppedAreaChart(document.getElementById('chart_div2'));
        chart2.draw(data2, options2);
      }
    </script>
	<div id="chart_div2" style="width: 100%; height: 500px;"></div>
	<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart3);
      function drawChart3() {
        var data3 = google.visualization.arrayToDataTable([
          ['День', 'Сумма'],
          <?=$retd3; ?>
        ]);

        var options3 = {
          title: 'AVG (Сумма / Кол-во)',
          hAxis: {title: 'Last 30 Days',  titleTextStyle: {color: 'green'}}
        };

        var chart3 = new google.visualization.SteppedAreaChart(document.getElementById('chart_div3'));
        chart3.draw(data3, options3);
      }
    </script>
	<div id="chart_div3" style="width: 100%; height: 500px;"></div>
	
	
		<?PHP
		
	}
	
	}else echo "<center><b>Записей нет</b></center><BR />";
	
	
	
?> </div> 
</div> 
            
	    </div> </div>
		
		</div>	</div>			
<br /><br />	
<div class="text_pages_bottom"></div>	<?PHP
return;
}


# Вывод статистики по дням
if(isset($_GET["list_day"])){

	$db->Query("SELECT * FROM db_payment ORDER BY id DESC");
	
	$days_money = array();
	$days_insert = array();
	
	if($db->NumRows() > 0){
		
		while($data = $db->FetchArray()){
		$index = date("d.m.Y", $data["date_add"]);
		
			$days_money[$index] = (isset($days_money[$index])) ? $days_money[$index] + $data["sum"] : $data["sum"];
			$days_insert[$index] = (isset($days_insert[$index])) ? $days_insert[$index] + 1 : 1;
			
		}
	
	# Вывод
	if(count($days_money) > 0){
	
		?>
		<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
		  <tr>
			<td align="center" class="title7">Дата</td>
			<td align="center" class="title7">Выплат</td>
			<td align="center" class="title7">На сумму</td>
			<td align="center" class="title7">AVG</td>
		  </tr>
		<?PHP
		
		$array_for_chart = array();
		
			foreach($days_money as $date => $sum){
			
				?>
				<tr class="htt">
					<td align="center" class="message1"><b><?=$date; ?></b></td>
					<td align="center" class="message1"><?=$days_insert[$date]; ?> шт.</td>
					<td align="center" class="message1"><?=$sum; ?> <?=$config->VAL;?></td>
					<td align="center" class="message1"><?=round($sum/$days_insert[$date],2); ?> <?=$config->VAL;?></td>
				</tr>
				<?PHP
				
			}
			
		?>
		</table>
		<?PHP
		
	}
	
	}else echo "<center><b>Записей нет</b></center><BR />";
	
	
	
?> </div> 
</div> 
            
	    </div> </div>
		
		</div>	</div>			
<br /><br />
<div class="text_pages_bottom"></div>
<?PHP
return;
}

# Проверка баланса Payeer
if(isset($_GET["balance"])){

$payeer = new rfs_payeer($config->AccountNumber, $config->apiId, $config->apiKey);
	if ($payeer->isAuth())
	{
		
		$arBalance = $payeer->getBalance();
		echo "<pre>".print_r($arBalance, true)."</pre>";	
	
	}
	
?></div><div class='clr'></div>
</div>	
<div class="text_pages_bottom"></div>
<?PHP

return;			
}	



$num_p = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"]) -1) : 0;
$lim = $num_p * 100;

$db->Query("SELECT * FROM db_payment ORDER BY id DESC LIMIT {$lim}, 100");

function colorSum($sum){

	if($sum >= 100) return "red";
	return "#000000";
}

if($db->NumRows() > 0){

?>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr >
    <td align="center" width="50" class="title7">Пользователь</td>
	<td align="center" width="50" class="title7">Монет</td>
	<td align="center" width="50" class="title7">Руб.</td>
	<td align="center" width="50" class="title7">Кошелек</td>
	<td align="center" width="50" class="title7">Дата</td>
  </tr>


<?PHP

	while($data = $db->FetchArray()){
	
	?>
	<tr class="htt">
	<td align="center" class="message1"><a href="index.php?menu=users&edit=<?=$data["user_id"]; ?>" class="stn"><?=$data["user"]; ?></a></td>
    <td align="center" class="message1"><?=$data["serebro"]; ?></td>
    
	
	
    <td align="center" class="message1"><font color="<?=colorSum($data["sum"]); ?>"><?=sprintf("%.2f",$data["sum"]); ?> <?=$data["valuta"]; ?></font></td>
	<td align="center" class="message1"><?=$data["purse"]; ?></td>
	<td align="center" class="message1"><?=date("d.m H:i:s",$data["date_add"]); ?></td>
  	</tr>
	<?PHP
	
	}

?>

</table>
<BR />
 </div> 
</div> 
            
	    </div> </div>
		
		</div>	</div>			
<br /><br />
<div class="text_pages_bottom"></div>
<?PHP


}else echo "<center><b>На данной странице нет записей</b></center><BR />";

	
$db->Query("SELECT COUNT(*) FROM db_payment");
$all_pages = $db->FetchRow();

	if($all_pages > 100){
	
	$sort_b = (isset($_GET["sort"])) ? intval($_GET["sort"]) : 0;
	
	$nav = new navigator;
	$page = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"])) : 1;
	
	echo "<BR /><center>".$nav->Navigation(10, $page, ceil($all_pages / 100), "index.php?menu=viplat&page="), "</center>";
	
	}
?>
 </div> 
</div> 
            
	    </div> </div>
		
		</div>	</div>			
<br /><br />

