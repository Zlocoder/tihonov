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
	<div class="tit">�������</div>
</div>
<div style="padding:20px">
<div class="silver-bk">
<div class="clr"></div>

<center><a href = "index.php?menu=news" class="stn">������ ��������</a> || <a href = "index.php?menu=news&add" class="stn">�������� �������</a></center><BR />
<script type="text/javascript" src="/js/editor/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({

        // �����

        mode : "textareas",

        theme : "advanced", // ����, ���� ������� -simple

language:"ru", // ����

        plugins :  // ���������� �������, ��� ����������� � �������� plugins

"spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // ������ ����������� ����� ������ ������� �� ������

        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",

        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",

        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",

        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",

        theme_advanced_toolbar_location : "top",

        theme_advanced_toolbar_align : "left",

        theme_advanced_statusbar_location : "bottom",

        theme_advanced_resizing : true,

        // ����

        skin : "o2k7",

        skin_variant : "silver",

        //  ��������� CSS �����

        content_css : "css/example.css",

//  � ����� ����� �������� � ������ ���������

});

</script>
<?PHP
$db->Query("SET NAMES cp1251");
if(isset($_POST["del"])){

$ret_id = intval($_POST["del"]);

$db->Query("DELETE FROM db_news WHERE id = '$ret_id'");
	
	echo "<div class='error2'>������� �������</div>";

}

# ���������� �������
if(isset($_GET["add"])){

	if(isset($_POST["title"], $_SESSION["add_news"]) AND $_SESSION["add_news"] == $_POST["add_news"]){
	
	unset($_SESSION["add_news"]);
	
	$title = $func->TextClean($_POST["title"]);
	$text = $_POST["ntext"];
	
		if(strlen($title) >= 3){
		
			$db->Query("INSERT INTO db_news (title, news, date_add) VALUES ('$title','$text','".time()."')");
			echo "<div class='success'>������� ���������</div>";
			
		}else echo "<div class='error2'>�������� �� ����� ���� ����� 3-� ��������</div>";
	
	}

?>

<form action="" method="post">
<b>���������:</b><BR />
<input type="text" name="title" size="45" value="<?=(isset($_POST["title"])) ? $_POST["title"] : false; ?>" /><BR /><BR />
<b>�������:</b><BR />
<textarea name="ntext" cols="82" rows="25"><?=(isset($_POST["ntext"])) ? $_POST["ntext"] : false; ?></textarea><BR />
<center><input type="submit" value="���������" class="button25"/></center>
<?PHP
$_SESSION["add_news"] = rand(1,1000);
?>
<input type="hidden" name="add_news" value="<?=$_SESSION["add_news"]; ?>" />

</form>
 </div> 
</div> 
            
	    </div> </div>
		
		</div>	</div>			
<br /><br />
<?PHP
return;
}


# ��������������
if(isset($_GET["edit"])){

$idr = intval($_GET["edit"]);

$db->Query("SELECT * FROM db_news WHERE id = '$idr' LIMIT 1");

if($db->NumRows() != 1){ echo "<div class='error2'>������� � ����� ID �� �������</div>"; return;}

	if(isset($_POST["title"])){
	
	$title = $func->TextClean($_POST["title"]);
	$title = (strlen($title) > 0) ? $title : "��� ���������";
	$text = $_POST["ntext"];
	
	$db->Query("UPDATE db_news SET title = '$title', news = '$text' WHERE id = '$idr'");
	$db->Query("SELECT * FROM db_news WHERE id = '$idr' LIMIT 1");
	
	 echo "<div class='success'>������� ���������������</div>";
	
	}

$news = $db->FetchArray();




?>

<form action="" method="post">
<b>���������:</b><BR />
<input type="text" name="title" size="45" value="<?=$news["title"]; ?>" /><BR /><BR />
<b>�������:</b><BR />
<textarea name="ntext" cols="78" rows="25"><?=$news["news"]; ?></textarea><BR />
<center><input type="submit" value="���������" class="button25"/></center>
</form>
 </div> 
</div> 
            
	    </div> </div>
		
		</div>	</div>			
<br /><br />
<?PHP

return;
}

$db->Query("SELECT * FROM db_news ORDER BY id DESC");

if($db->NumRows() > 0){

?>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="100%" class="radius_table">
  <tr bgcolor="#efefef">
    <td align="center" width="50" class="title7">ID</td>
    <td align="center" class="title7">��������</td>
	<td align="center" width="70" class="title7">�������</td>
  </tr>


<?PHP

	while($data = $db->FetchArray()){
	
	?>
	<tr class="htt">
    <td align="center" width="50" class="message1"><?=$data["id"]; ?></td>
    <td align="center" class="message1"><a href="/?menu=ambarchik&sel=news&edit=<?=$data["id"]; ?>" class="stn"><?=$data["title"]; ?></a></td>
	<td align="center" width="70" class="message1">
	<form action="" method="post">
	<input type="hidden" name="del" value="<?=$data["id"]; ?>" />
	<input type="submit" value="�������" class="button25"/>
	</form>
	</td>
  	</tr>
	<?PHP
	
	}

?>

</table>
<?PHP

}else echo "<div class='error2'>�������� ���</div>";
?>
 </div> 
</div> 
            
	    </div> </div>
		
		</div>	</div>			
<br /><br />