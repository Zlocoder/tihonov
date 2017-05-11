		<div class="stat">
<div class="h-title"><font color="#ffffff"><b>Пополнения</b></font></div>
		
		<table align="center" border="0" bordercolor="#336633" cellpadding="0" cellspacing="0" width="99%">
<tbody>



 <tr bgcolor="#efefef" >
 <td>
    <?PHP

  $db->Query("SELECT * FROM db_insert_money ORDER BY id DESC LIMIT 5");

  if($db->NumRows() > 0){

      while($last = $db->FetchArray()){

    ?>
   
  <tr class="htt" >
		<td align="center" width="75"><font color="white"><?=$last["user"]; ?></font></td>
		<td align="center"><font color="white"><?=date("d.m.Y",$last["date_add"]); ?></font></td>
		<td align="center"><b><font color="white"><?=$last["money"]; ?> Руб.</font></b></td>
	</tr>

    <?PHP

    }

  }else echo '<tr><td align="center" colspan="5"><font color="white">Нет записей</font></td></tr>'
  ?>
  
  </td>
  </tr>



  <tr>
	<td style="   class="m-tb" colspan="3" align="center" height="25" valign="top"></td>
</tr>
</tbody></table>

<div class="clr"></div>
</div>