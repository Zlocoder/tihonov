<?PHP
$usid = $_SESSION["user_id"];
$refid = $_SESSION["referer_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$balans = $user_data["money_s"];

?>

<div class="field-gr"><font color="#ffffff"><b>������, <?=$_SESSION["user"]; ?><b></font></div>

<br>

<div class="field-gr"><a href="/account"><font color="#ffffff"><b>��� �������<b></font></a></div>
<div class="field-gr"><a href="/account/config"><font color="#ffffff"><b>���������<b></font></a></div>
<div class="field-gr"><a href="/account/referals"><font color="#ffffff"><b>��������<b></font></a></div>
<div class="field-gr"><a href="/competition"><font color="#ffffff"><b>������� ���������<b></font></a></div>
<div class="field-gr"><a href="/account/exit"><font color="#ffffff"><b>�����<b></font></a></div>

<br>

<div class="field-gr"><a href="/account/farm"><font color="#ffffff"><b>���������<b></font></a></div>
<div class="field-gr"><a href="/account/store"><font color="#ffffff"><b>�����<b></font></a></div>
<div class="field-gr"><a href="/account/bonus"><font color="#ffffff"><b>�����<b></font></a></div>
<div class="field-gr"><a href="/account/bonus_lider"><font color="#ffffff"><b>����� ����������<b></font></a></div>



<br>

    <div class="field-gr"><a href="/account/serfing"><font color="#ffffff"><b>�������<b></font></a></div>
	<font style="position: absolute;  font-size: 14px;  line-height: 11px;    color: #000000;border: 1px solid #000000;border-radius: 5px;background: #ffffff;font-weight: bold;padding: 3px 6px 3px 6px;box-shadow: 0px 0px 8px 2px #383838;z-index: 10;margin-left: 325px;  margin-top: -38px;"> New</font>
    <div class="field-gr"><a href="/account/serfing/add"><font color="#ffffff"><b>�������� ������<b></font></a></div>
	<div class="field-gr"><a href="/account/insertps"><font color="#ffffff"><b>��������� �������<b></font></a></div>
	<div class="field-gr"><a href="/account/insertps"><font color="#ffffff"><b>������: <?PHP echo "$balans"; ?><b></font></a></div>
		
<br>

<div class="field-gr"><a href="/account/swap"><font color="#ffffff"><b>��������<b></font></a></div>
<div class="field-gr"><a href="/account/insertp"><font color="#ffffff"><b>��������� ������<b></font></a></div>
<font style="position: absolute;  font-size: 14px;  line-height: 11px;    color: #000000;border: 1px solid #000000;border-radius: 5px;background: #ffffff;font-weight: bold;padding: 3px 6px 3px 6px;box-shadow: 0px 0px 8px 2px #383838;z-index: 10;margin-left: 325px;  margin-top: -38px;"> +20%</font>

<div class="field-gr"><a href="/account/paymentp"><font color="#ffffff"><b>�������� �������<b></font></a></div>
<div class="field-gr"><a href="/account/insertp"><b><font color = 'white'>{!BALANCE_B!} </font></b></a>  <span style="margin:3px 10px 0px 0px;"><b><font color = 'white'>��� �������<b/></span></font></div>
<div class="field-gr"><a href="/account/paymentp"><b><font color = 'white'>{!BALANCE_P!} </font></b></a> <span style="margin:3px 10px 0px 0px;"><font color = 'white'>�� �����</font></span></div>


	

	