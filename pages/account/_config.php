<?PHP
$_OPTIMIZATION["title"] = "������� - ���������";
$usid = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a WHERE id = '$usid'");
$user_data = $db->FetchArray();
?>

<h3>��������� ��������</h3>


<?PHP
	if(!empty($_POST["change_pass"])){
	
		$old = @$func->IsPassword($_POST["old"]);
		$new = @$func->IsPassword($_POST["new"]);
		
			if($old AND md5($old) == $user_data["pass"]){
			
				if($new !== false){

					if( $new == $_POST["re_new"]){

                        $new = md5($new);
					
						$db->Query("UPDATE db_users_a SET pass = '$new' WHERE id = '$usid'");
						
						$return = '����� ������ ������� ����������';
					
					}else $return = '������ � ������ ������ �� ���������';
				
				}else $return = '����� ������ ����� �������� ������';
			
			}else $return = '������ ������ �������� �������';
		
	}

?>

<div class="row">
    <div class="col s12">
        <h4>����� ������</h4>
        <p>������ ������ �������� �� �� ����� 6 ��������� ���� � ���� !</p>
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
            <label for="old_psw">������ ������</label>
            <input type="password" id="old_psw" placeholder="������ ������:" name="old" />
            <label for="new_psw">����� ������</label>
            <input type="password" id="new_psw" placeholder="����� ������:" name="new" />
            <label for="renew_psw">��� ��� �����</label>
            <input type="password" id="renew_psw" placeholder="������ ������:" name="re_new" />
            <input type="submit" value="������� ������" class="btn" />
        </form>
    </div>
    <div class="col offset-s2"></div>
</div>






