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
	<div class="tit">��� �� �������</div>
</div>
<div style="padding:20px">
<div class="silver-bk">
<div class="clr"></div>
<table width="99%" border="0" align="center">
  <tr>
    <td align="center" class="title7"><b>�����</b></td>
    <td align="center" class="title7"><b>���� �����������</b></td>
    <td align="center" class="title7"><b>�����</b></td>
  </tr>
<?php
	$db->Query("SELECT * FROM `db_users_b`,`db_users_a` WHERE db_users_b.id = db_users_a.id ORDER BY `payment_sum` DESC LIMIT 300 ");
	while($data = $db->FetchArray()){
	?>
	<tr class="htt" >
		<td align="center" width="75" class="message1"><?=$data['user']; ?></td>
		<td align="center" class="message1"><b><?=date("d.m.Y � H:i",$data["date_reg"]); ?></b></td>
		<td align="center" class="message1"><b><font color="green"><?=sprintf("%.2f",$data["payment_sum"]); ?></font></b></td>
	</tr>
	<?php
	}
?>
</table>

 </div> 
</div> 
            
	    </div> </div>
		
		</div>	</div>			
<br /><br />