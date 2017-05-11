<?PHP
$_OPTIMIZATION["title"] = "Регистрация";
$_OPTIMIZATION["description"] = "Регистрация пользователя в системе";
$_OPTIMIZATION["keywords"] = "Регистрация нового участника в системе";

if(isset($_SESSION["user_id"])){ Header("Location: /account"); return; }

$came=$_SERVER['HTTP_REFERER'];

                $url=$came;
		if (!preg_match('/(?:[^:]*:\/\/)?(?:www)?\.?([^\/]+\.[^\/]+.*)/i',$url)) {
                $cam = "Nothing";
                } else {
                preg_match('/(?:[^:]*:\/\/)?(?:www)?\.?([^\/]+\.[^\/]+.*)/i',$url,$match);
                $site = explode("/", $match[1]);
                $hostb=$_SERVER['HTTP_HOST'];
			if ($site[0] == $hostb) {
                $cam = "Nothing";
                } else {
                $cam = $site[0];
                }
                if ($_SESSION['sessy']!='')
				{
				$cam=$_SESSION['sessy'];
				}
            }
			if ($cam!='Nothing')
			{
			if ($cam!='')
			{
			$_SESSION['sessy']=$cam;
			}
			}
			$rescamee=$cam;	
			

?>


<?PHP
	
	# Регистрация

	if(isset($_POST["login"])){
	
	$login = $func->IsLogin($_POST["login"]);
	$pass = $func->IsPassword($_POST["pass"]);
	$rules = isset($_POST["rules"]) ? true : false;
	$time = time();
	$ip = $func->UserIP;
    $ipregs = $db->Query("SELECT * FROM `db_users_a` WHERE INET_NTOA(db_users_a.ip) = '$ip' ");
	$ipregs = $db->NumRows();
	$email = $func->IsMail($_POST["email"]);
	$referer_id = (isset($_COOKIE["i"]) AND intval($_COOKIE["i"]) > 0 AND intval($_COOKIE["i"]) < 1000000) ? intval($_COOKIE["i"]) : 1;
	$referer_name = "";
	if($referer_id != 1){
		$db->Query("SELECT user FROM db_users_a WHERE id = '$referer_id' LIMIT 1");
		if($db->NumRows() > 0){$referer_name = $db->FetchRow();}
		else{ $referer_id = 1; $referer_name = "First"; }
	}else{ $referer_id = 1; $referer_name = "First"; }
	
	if($ipregs == 0) {
	
	
		if($emailregs == 0) {

			if($rules){

				if($email !== false){
		
					if($login !== false){
			
						if($pass !== false){
			
							if($pass == $_POST["repass"]){
						
								$db->Query("SELECT COUNT(*) FROM db_users_a WHERE user = '$login'");
								if($db->FetchRow() == 0){
						
						         $pass = md5($pass);
								 
								 
								# Регаем пользователя
						$db->Query("INSERT INTO db_users_a (user, url, email, pass, paypass, referer, referer_id, date_reg, ip)
                        VALUES ('$login', '$cam', '{$email}','$pass', '$paypass','$referer_name','$referer_id','$time',INET_ATON('$ip'))");
						
						$lid = $db->LastInsert();
						
						$db->Query("INSERT INTO db_users_b (id, user, money_b, last_sbor) VALUES ('$lid','$login','100', '".time()."')");
						
						
						
						
								# Вставляем статистику
								$db->Query("UPDATE db_stats SET all_users = all_users +1 WHERE id = '1'");
						
								echo "<center><div class='alert'>Вы успешно зарегистрировались. Используйте форму слева для входа в аккаунт</div></center>";
								?></div>
								<div class="clr"></div>	
								<?PHP
								return;
								}else echo "<center><div class='alert'>Указанный логин уже используется</div></center>";
						
							}else echo "<center><div class='alert'>Пароль и повтор пароля не совпадают</div></center>";
			
						}else echo "<center><div class='alert'>Пароль заполнен неверно</div></center>";
			
					}else echo "<center><div class='alert'>Логин заполнен неверно</div></center>";

				}else echo "<center><div class='alert'>Email имеет неверный формат</div></center>";

			}else echo "<center><div class='alert'>Вы не подтвердили правила</div></center>";
	
		}else echo "<center><div class='alert'>Указанный Email уже есть в нашей базе!</div></center>";
		
	
}else echo "<center><div class='alert'>Регистрация с этого IP уже производилась</div></center>";
		
	}
	
	
?>

<div class="wrap">								<div class="s-bk-lf"><br>
									<center><div class="tit">РЕГИСТРАЦИЯ</div>
								</div>
								<div class="silver-bk">
<h4>
<div class=""><center>
Логин должен иметь от 4 до 10 символов (только англ. символы). <BR />
Пароль должно иметь от 6 до 20 символов (только англ. символы). <BR />
</center></div>


<BR />
<form action="" method="post">
<table class="table" align="center" border="0" cellpadding="3" cellspacing="0" width="99%">
  <tr>
    <td align="center" style="padding:3px;"><input name="login" type="text"  class="backlight" maxlength="15" value="" placeholder="Ваш логин"/></td>
  </tr>
<tr>
    <td align="center" style="padding:3px;"><input name="email" type="text" class="backlight" maxlength="50" value="" placeholder="Ваш Email"/></td>
  </tr>
  
  <tr>
    <td align="center" style="padding:3px;"><input name="pass" type="password" class="backlight" maxlength="20" placeholder="Пароль"/></td>
  </tr>
  <tr>
    <td align="center" style="padding:3px;"><input name="repass" type="password" class="backlight" maxlength="20" placeholder="Пароль ещё раз"/></td>
  </tr>
 
  

  
   <tr>
    <td colspan="2" align="center" style="padding:3px;">
	<br>С <a href="/rules" target="_blank" class="stn">правилами</a> проекта ознакомлен(а) и принимаю: <input name="rules" type="checkbox" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center" style="padding:3px;"><input name="registr" type="submit" value="Зарегистрироваться" class="button25" style="border:0"></td>
  </tr>
</table>
</form>
<br />
<center>
<a href="recovery" class="rega" style="color:#999">Забыли пароль ?</a></center>
</div>
	
</div>	</div>			
<br /><br />



