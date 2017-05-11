
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

<div class="modal-content">
    <h4>Login</h4>
    <form action="" method="post">
        <input name="log_email" type="email" placeholder="E-Mail" />
        <input name="pass" type="password" placeholder="Password" />

</div>
<div class="modal-footer">
         <a href="/recovery" class="modal-action modal-close waves-effect waves-green btn-flat ">Восстановить</a>
         <button type="submit" class="waves-effect waves-green btn-flat">Enter</button>
    </form>
</div>

