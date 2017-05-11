                                                            <html>
	<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
		<title>Swarm of Bees - Игра с выводом средств</title>
		
		

		<meta name="description" content=" экономический проект с выводом средств  Автоматические выплаты денег! Без баллов!">
		<meta name="keywords" content=" без баллов, игры с выводом реальных денег, игры на деньги с выводом, игра ферма с выводом денег, игры с возможностью вывода денег, игры с выводом средств, ферма игра с выводом средств.">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<link href="/style/style.css" rel="stylesheet" type="text/css" />
		<link href="/style/bootstrap.css" rel="stylesheet" type="text/css" />
		<link rel="icon" href="/img/fav.png" type="image/x-icon" />
		<link rel="shortcut icon" href="/img/fav.png" type="image/x-icon" />
		<script type="text/javascript" src="/js/jquery.js"></script>
		<script type='text/javascript'> 
		var aaSnowConfig = {snowflakes: '200'}; 
		</script>
		
		<script type="text/javascript" src="/js/bootstrap.min.js"></script>	
		<script type="text/javascript" src="/js/functions.js"></script>
	</head>
	<body>
	
<div class="bg"></div><!-- BG -->


		<header>
<center>
<div class="fon_hed">
<div class="bg-cap">

</div>
</div>
<div class="wrap" style="margin-top:-150px;">

    
<script>$(document).ready(function() {$('#nav li ul').hover(function(){$(this).prev().toggleClass('hovered')});});</script>     


<?PHP

if(isset($_SESSION["user"]) ){

			
?>
<div class="menu_h">	    	

<div class="cell"><a href="/" class="mainmenu">Главная</a></div>
<div class="cell"><font style="position: absolute;  font-size: 12px;  line-height: 11px;    color: #b01c13;border: 0px solid #c58b41;border-radius: 20px;background: #ffea60;font-weight: bold;padding: 2px 8px;box-shadow: 0px 0px 8px 2px #231812;z-index: 10;margin-left: 71px;  margin-top: -11px;">New</font><a href="/news" class="mainmenu">Новости</a></div>
<div class="cell"><a href="/faq" class="mainmenu">Помощь</a></div>
<div class="cell"><a href="/support" class="mainmenu">Контакты</a></div>
		
<div class="cell"><a href="/account" class="mainmenu">Кабинет</a></div>         
<div class="cell"><a href="/account/exit" class="mainmenu">Выход</a></div>   
                    
                
    
	
		
</div>


  <?}else{?>

	<div class="menu_h">	    	

<div class="cell"><a href="/" class="mainmenu">Главная</a></div>
<div class="cell"><font style="position: absolute;  font-size: 12px;  line-height: 11px;    color: #b01c13;border: 0px solid #c58b41;border-radius: 20px;background: #ffea60;font-weight: bold;padding: 2px 8px;box-shadow: 0px 0px 8px 2px #231812;z-index: 10;margin-left: 71px;  margin-top: -11px;">New</font><a href="/news" class="mainmenu">Новости</a></div>
<div class="cell"><a href="/faq" class="mainmenu">Помощь</a></div>
<div class="cell"><a href="/support" class="mainmenu">Контакты</a></div>
		
	
	<div class="cell"><a href="/signup" class="mainmenu">Регистрация</a></div>  
<div class="cell"><a href="#win1" class="mainmenu">Кабинет</a></div>

<a href="#x" class="overlay" id="win1"></a>
        <div class="popup">



 
<div class="col-md-4">
<center>
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'ru', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="../translate.google.com/translate_a/element.js@cb=googleTranslateElementInit"></script>
</center>

<?PHP

	if(isset($_POST["log_email"])){
	
	$lmail = $func->IsMail($_POST["log_email"]);
	
		if($lmail !== false){
		
			$db->Query("SELECT id, user, pass, referer_id, banned FROM db_users_a WHERE email = '$lmail'");
			if($db->NumRows() == 1){
			
			$log_data = $db->FetchArray();
			
				if($log_data["pass"] == md5($_POST["pass"])){
				
					if($log_data["banned"] == 0){
						
						# Считаем рефералов
						$db->Query("SELECT COUNT(*) FROM db_users_a WHERE referer_id = '".$log_data["id"]."'");
						$refs = $db->FetchRow();
						
						$db->Query("UPDATE db_users_a SET referals = '$refs', date_login = '".time()."', ip = INET_ATON('".$func->UserIP."') WHERE id = '".$log_data["id"]."'");
						
						$_SESSION["user_id"] = $log_data["id"];
						$_SESSION["user"] = $log_data["user"];
						$_SESSION["referer_id"] = $log_data["referer_id"];
						Header("Location: /account");
						
					}else echo "<center><font color = 'black'><b>Аккаунт заблокирован</b></font></center><BR />";
				
				}else echo "<center><font color = 'black'><b>Email и/или Пароль указан неверно</b></font></center><BR />";
			
			}else echo "<center><font color = 'black'><b>Указанный Email не зарегистрирован в системе</b></font></center><BR />";
			
		}else echo "<center><font color = 'black'><b>Email указан неверно</b></font></center><BR />";
	
	}

?>



<center><div style="width:400px">
	<form action="" method="post">
	
	
			<input name="log_email" type="text" size="23" maxlength="35" placeholder="Ваш email" class="backlight" />
		
         <br /><br /> 
			<input name="pass" type="password" size="23" maxlength="35" placeholder="Пароль" class="backlight" />
           <br /><br /> 
		<button type="submit" class="button25">Войти в личный кабинет</button>
	</form>
<center>
<a href="/recovery"  style="color:#000">Забыли пароль ?</a></center>
	</div><br />

</center>
			<a class="close" title="Close" href="#close"></a>         
        </div>
               
		
</div>
 <?}?>
</center>
<br>
<div class="wrap">							
<div class="cont">
 
							

</body></html>