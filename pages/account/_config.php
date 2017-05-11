<?PHP
$_OPTIMIZATION["title"] = "Аккаунт - Настройки";
$usid = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a WHERE id = '$usid'");
$user_data = $db->FetchArray();
?>

<h3>Настройки аккаунта</h3>


<?PHP
	if(!empty($_POST["change_pass"])){
	
		$old = @$func->IsPassword($_POST["old"]);
		$new = @$func->IsPassword($_POST["new"]);
		
			if($old AND md5($old) == $user_data["pass"]){
			
				if($new !== false){

					if( $new == $_POST["re_new"]){

                        $new = md5($new);
					
						$db->Query("UPDATE db_users_a SET pass = '$new' WHERE id = '$usid'");
						
						$return = 'Новый пароль успешно установлен';
					
					}else $return = 'Пароль и повтор пароля не совпадают';
				
				}else $return = 'Новый пароль имеет неверный формат';
			
			}else $return = 'Старый паполь заполнен неверно';
		
	}

?>

<div class="row">
    <div class="col s12">
        <h4>Смена пароля</h4>
        <p>Пароль должен состоять из не менее 6 латинских букв и цифр !</p>
    </div>
</div>

<?php
if($return){ ?>
    <div class="row">
        <div class="col s12">
            <div class="account-alert"><?= $return ?></div>
        </div>
    </div>
<?php } ?>

<div class="row">
    <div class="col offset-s2"></div>
    <div class="col s8">
        <form action="" method="post">
            <input type="hidden" name="change_pass" value="1">
            <label for="old_psw">Старый пароль</label>
            <input type="password" id="old_psw" placeholder="Старый пароль:" name="old" />
            <label for="new_psw">Новый пароль</label>
            <input type="password" id="new_psw" placeholder="Новый пароль:" name="new" />
            <label for="renew_psw">Еще раз новый</label>
            <input type="password" id="renew_psw" placeholder="Повтор пароля:" name="re_new" />
            <input type="submit" value="Сменить пароль" class="btn" />
        </form>
    </div>
    <div class="col offset-s2"></div>
</div>






