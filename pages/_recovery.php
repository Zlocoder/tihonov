
<div class="wrap">	<center>							<div class="s-bk-lf"><br>
									<center><div class="tit">�������������� ������</div><br>
								</div>
								<div class="silver-bk">


<BR />
	
<?PHP

$_OPTIMIZATION["title"] = "�������������� ������";
$_OPTIMIZATION["description"] = "�������������� �������� ������";
$_OPTIMIZATION["keywords"] = "�������������� �������� ������";

if(isset($_SESSION["user_id"])){ Header("Location: /account"); return; }

?>
<?PHP

	if(isset($_POST["email"])){

				
		$email = $func->IsMail($_POST["email"]);
		$time = time();
		$tdel = $time + 60*15;
		
			if($email !== false){
				
				$db->Query("DELETE FROM db_recovery WHERE date_del < '$time'");
				$db->Query("SELECT COUNT(*) FROM db_recovery WHERE ip = INET_ATON('".$func->UserIP."') OR email = '$email'");
				if($db->FetchRow() == 0){
				
					$db->Query("SELECT id, user, email, pass FROM db_users_a WHERE email = '$email'");
					if($db->NumRows() == 1){
					$db_q = $db->FetchArray();
					$rn = rand(515165115, 999999999999);
					$new_pass = md5($rn);
					
					
					
					# ������ ������ � ��
					$db->Query("INSERT INTO db_recovery (email, ip, date_add, date_del) VALUES ('$email',INET_ATON('".$func->UserIP."'),'$time','$tdel')");
					$db->Query("UPDATE db_users_a SET pass = '$new_pass' WHERE email = '".$db_q["email"]."'");
					# ���������� ������
					$sender = new isender;
					$sender -> RecoveryPassword($db_q["email"], $rn, $db_q["email"]);
					
					echo "<center><div class='alert'>������ ��� ����� ���������� �� Email</div></center>";
					?>
					</div>
					<div class="clr"></div>	
					</div>
<div class="text_pages_bottom"></div>
					<?PHP
					return; 
					
					}else echo "<center><div class='alert'>������������ � ����� Email �� ���������������</div></center>";
				
				}else echo "<center><div class='alert'>�� ��� Email ��� IP ��� ��� ��������� ������ �� ��������� 15 �����</div></center>";
				
			}else echo "<center><div class='alert'>Email ������ �������</div></center>";
		
		
	
	}

?>


<form action="" method="post">
<table width="99%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    
    <td align="center" width="250"><input name="email" type="text" size="25" maxlength="50" class="backlight" placeholder="Email (�� ���� ����� ������ ������):" value=""/><br /><br /></td>
  </tr>
  
  
   
  <tr>
    <td align="center"><BR /><input type="submit" value="������������"  class="button25" ></td>
  </tr>
</table>
</form><br /><br />
</div>
<div class="clr"></div>	</div>	
</div>	</div>			
<br /><br />
