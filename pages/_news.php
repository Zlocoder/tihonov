<?PHP
$_OPTIMIZATION["title"] = "�������";
$_OPTIMIZATION["description"] = "������� �������";
$_OPTIMIZATION["keywords"] = "������� ������ �������";
?>

			<div class="wrap" style="display:block; min-height:500px"><div class="s-bk-lf"><br>
	<div class="title">�������</div>
</div>

<div class="silver-bk" style="text-align:left; padding:10px">

<?PHP

$db->Query("SELECT * FROM db_news ORDER BY id DESC");

if($db->NumRows() > 0){

	while($news = $db->FetchArray()){
	
	?>

<div  class="title7"><?=$news["title"]; ?> -- <?=date("d.m.Y",$news["date_add"]); ?></div>
<div class="message"><p><span style="font-size: large;"><?=$news["news"]; ?></span></p></div>
 
<BR />
	<?PHP
	
	}

}else echo "<center><div class='title7'>�������� ���.</div></center>";

?>
</div></div></div>
<div class="clr"></div>	
 


</div>	</div>			
<br /><br />