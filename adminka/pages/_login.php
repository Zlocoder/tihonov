<div class="wrap">
<br />
<center>
<div class="block3" style="margin-left:-0px">
<div class="b-title">Вход в админку</div>
<div style="height:57px;"></div>
<center>
<?PHP

if(isset($_SESSION["admin"])){ Header("Location: /".$admFolder.""); return; }

if(isset($_POST["admlogin"])){

	$db->Query("SELECT * FROM netdostupa_admin_log WHERE id = 1 LIMIT 1");
	$data_log = $db->FetchArray();
	$pass = $_POST["admpass"];
	$pass = md5($pass);
	$login = $db->RealEscape($_POST['admlogin']);
	
	if(strtolower($login) == strtolower($data_log["username"]) AND $pass == $data_log["passwordd"] ){
	
		$_SESSION["admin"] = true;
		Header("Location: /".$admFolder."");
		return;
	}else echo "<center><font color = 'black'><b>Неверно введен логин и/или пароль</b></font></center><BR />";
	
}

?>
<form action="" method="post">
<table width="99%" border="0" align="center">
  <tr>
   
	<td align="center"><input type="text" name="admlogin" value="" placeholder="Ваш логин"/></td>
  </tr>
  <tr>
    <td><br> </td>
  </tr>
  <tr>
    
	<td align="center"><input type="password" name="admpass" value="" placeholder="Пароль"/></td>
  </tr>
   <tr>
    <td><br> </td>
  </tr>
  <tr>
  <tr>
	<td style="padding-top:5px;" align="center" ><input type="submit" value="Войти" class="button25" /></td>
  </tr>
</table>
</form>
 </div> 
</div> 
            
	    </div> </div>
		
		</div>	</div>			
<br /><br />
