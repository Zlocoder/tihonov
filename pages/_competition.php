<?PHP
$_OPTIMIZATION["title"] = "������� ���������";
$_OPTIMIZATION["description"] = "������� ���������";
$_OPTIMIZATION["keywords"] = "�������, ������� ���������";

include __DIR__ . '/account/_account_menu.php';
?>

<h3>������� ���������</h3>



<?PHP

# ������ ���������
if(isset($_GET["list"])){


	# ������ �������������
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
                        <th align="center" class="m-tb">�����</th>
                        <th align="center" class="m-tb">��������</th>
                        <th align="center" class="m-tb">����</th>
                    </tr>
                </thead>
			<tr class="htt" >
				<td align="center"><?=$data["id"]; ?></td>
				<td align="center"><?=date("d.m.Y", $data["date_add"]); ?></td>
				<td align="center"><?=date("d.m.Y", $data["date_end"]); ?></td>
				<td align="center"><?=$data["1m"]+$data["2m"]+$data["3m"]; ?> RUB</td>
		 	</tr>
			<tr bgcolor="#efefef">
				<td align="center" width="75" class="m-tb">������</td>
				<td align="center" class="m-tb">1 ����� / ����</td>
				<td align="center" class="m-tb">2 ����� / ����</td>
				<td align="center" class="m-tb">3 ����� / ����</td>
			</tr>
			<tr class="htt" >
				<td align="center"><?=($data["status"] > 1) ? "�������" : "��������"; ?></td>
				<td align="center"><?=$data["user_1"]; ?> / <?=$data["1m"]; ?></td>
				<td align="center"><?=$data["user_2"]; ?> / <?=$data["2m"]; ?></td>
				<td align="center"><?=$data["user_3"]; ?> / <?=$data["3m"]; ?></td>
		 	</tr>
			</table>
		<BR /><BR />
		<?PHP
		}

	}else $return = '��� ����������� ���������';


?>

<?PHP

return;
}


$db->Query("SELECT * FROM db_competition WHERE status = 0 LIMIT 1");
if($db->NumRows() == 1){
$comp = $db->FetchArray();	
	?>
<b>������� ��������� � <?=$comp["id"]; ?> � ����� �������� ������ <?=$comp["1m"]+$comp["2m"]+$comp["3m"]; ?> RUB<BR /><BR />
����� ��������: <?=date("d.m.Y � H:i:s", $comp["date_add"]); ?> <BR />����������: <?=date("d.m.Y � H:i:s", $comp["date_end"]); ?>
<BR /><BR />
<u>�������� �����:</u><BR />
1 - <?=$comp["1m"]; ?> RUB <BR />
2 - <?=$comp["2m"]; ?> RUB <BR />
3 - <?=$comp["3m"]; ?> RUB <BR /><BR />

� �������� ����������� ������ �������� ��������, ������� ������������������ ����� ������� ��������. <BR />�� ������ ���������� ������� ����� ��������� ��� ����������� �����, 1 RUB = 1 �����. ��� ������ ������, ��� ������ ���� �������� � ��������. <BR /><BR />
</b>
	<?PHP
	
	# ������ �������������
	$db->Query("SELECT * FROM db_competition_users ORDER BY points DESC LIMIT 100");
	if($db->NumRows() > 0){
	
	?>
	<h4>������� �������</h4>
<table width="99%" border="0" align="center">
  <tr bgcolor="#efefef">
    <td align="center" width="75" class="m-tb">�������</td>
    <td align="center" class="title7">������������</td>
    <td align="center" class="title7">������</td>
	<td align="center" class="title7">����</td>
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
	
	}else echo "��� ���������� � ��������";

}else echo "� ������ ������ ������� �� ����������";

?>
