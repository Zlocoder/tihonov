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
	<div class="tit">������� ������</div>
</div>
<div style="padding:20px">
<div class="silver-bk">
<div class="clr"></div>
<?PHP
$tdadd = time() - 5*60;
	if(isset($_POST["clean"])){
	
		$db->Query("DELETE FROM db_sell_items WHERE date_add < '$tdadd'");
		echo "<center><font color = 'green'><b>�������</b></font></center><BR />";
	}

$db->Query("SELECT * FROM db_sell_items ORDER BY id DESC");

if($db->NumRows() > 0){

?>
<table cellpadding='3' cellspacing='0' border='0' align='center' width="99%">
  <tr>
    <td align="center" width="50" class="title7">ID</td>
    <td align="center" class="title7">������������</td>
    <td align="center" width="80" class="title7">������</td>
	<td align="center" width="80" class="title7">�������</td>
	<td align="center" width="150" class="title7">���� ��������</td>
  </tr>


<?PHP

	while($data = $db->FetchArray()){
	
	?>
	<tr class="htt">
    <td align="center" width="50" class="message1"><?=$data["id"]; ?></td>
    <td align="center" class="message1"><?=$data["user"]; ?></td>
    <td align="center" width="80" class="message1"><?=$data["all_sell"]; ?></td>
	<td align="center" width="80" class="message1"><?=sprintf("%.2f",$data["amount"]); ?></td>
	<td align="center" width="150" class="message1"><?=date("d.m.Y � H:i:s",$data["date_add"]); ?></td>
  	</tr>
	<?PHP
	
	}

?>

</table>
<BR />
<form action="" method="post">
<center><input type="submit" name="clean" value="��������" class="button25" /></center>
</form>
<?PHP

}else echo "<center><b>������� ���</b></center><BR />";
?>
 </div> 
</div> 
            
	    </div> </div>
		
		</div>	</div>			
<br /><br />