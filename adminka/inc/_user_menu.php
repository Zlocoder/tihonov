<?PHP
$usid = $_SESSION["user_id"];
$refid = $_SESSION["referer_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();



?>

<div class="acc-title"><b><?=$_SESSION["user"]; ?><b></div>
<div class="field-gr"><a href="/account"><font color="#3a1900"><b>��� �������<b></font></a></div>
<div class="field-gr"><a href="/account/config"><font color="#3a1900"><b>���������<b></font></a></div>
<div class="field-gr"><a href="/account/referals"><font color="#3a1900"><b>��������<b></font></a></div>
<div class="field-gr"><a href="/invcompetition"><font color="#3a1900"><b>������� ����������<b></font></a></div>
<div class="field-gr"><a href="/competition"><font color="#3a1900"><b>������� ���������<b></font></a></div>
<div class="field-gr"><a href="/account/back"><font color="#3a1900"><b>������������� ����<b></font></a></div>
<div class="field-gr"><a href="/account/exit"><font color="#3a1900"><b>�����<b></font></a></div>

<div class="acc-title"><b>����������<b></div>
<div class="field-gr"><a href="/account/farm"><font color="#3a1900"><b>������ �������<b></font></a></div>
<div class="field-gr"><a href="/account/store"><font color="#3a1900"><b>������� ������<b></font></a></div>

<div class="acc-title"><b>�������<b></div>
<div class="field-gr"><a href="/account/serfing"><font color="#3a1900"><b>�������<b></font></a></div>
<div class="field-gr"><a href="/account/insertps"><font color="#3a1900"><b>��������� �������<b></font></a></div>
<div class="field-gr"><a><b><b> ������: <?PHP echo "$balans"; ?></b></a></div>

<div class="acc-title"><b>������<b></div>
<div class="field-gr"><a href="/account/bonus"><font color="#3a1900"><b>����� ��� � �����<b></font></a></div>
<div class="field-gr"><a href="/account/bonus3"><font color="#3a1900"><b>����� ��� � 12 �����<b></font></a></div>
<div class="field-gr"><a href="/account/bonus4"><font color="#3a1900"><b>����� ��� � 6 �����<b></font></a></div>
<div class="field-gr"><a href="/account/bonus5"><font color="#3a1900"><b>����� ��� � ���<b></font></a></div>
<div class="field-gr"><a href="/account/bonus2"><font color="#3a1900"><b>����� � ������<b></font></a></div>
<div class="field-gr"><a href="/account/bonus6"><font color="#3a1900"><b>����� �� �����<b></font></a></div>
<div class="field-gr"><a href="/account/bonuspayeer"><font color="#3a1900"><b>Payeer �����<b></font></a></div>
<div class="field-gr"><a href="/account/mmgpbonus"><font color="#3a1900"><b>MMGP �����<b></font></a></div>
<div class="field-gr"><a href="/account/pin"><font color="#3a1900"><b>��� ����<b></font></a></div>

<div class="acc-title"><b>�����������<b></div>
<div class="field-gr"><a href="/chat"><font color="#3a1900"><b>���<b></font></a></div>
<div class="field-gr"><a href="/account/lottery"><font color="#3a1900"><b>�������<b></font></a></div>
<div class="field-gr"><a href="/account/knb"><font color="#3a1900"><b>�.�.�.<b></font></a></div>
<div class="field-gr"><a href="/account/bux4ik"><font color="#3a1900"><b>������� �����<b></font></a></div>

<div class="acc-title"><b>�������� � ��������<b></div>
<div class="field-gr"><a href="/account/swap"><font color="#3a1900"><b>��������<b></font></a></div>
<div class="field-gr"><a href="/account/insertp"><font color="#3a1900"><b>��������� ������<b></font></a></div>
<div class="field-gr"><a href="/account/paymentp"><font color="#3a1900"><b>�������� �������<b></font></a></div>


<div style="margin-top:20px;">
<div class="acc-title">��������� �����</div>	
<div class="field-gr"><a href="/account/insertp"><b><font color = 'black'>{!BALANCE_B!} </font></b></a>  <span style="margin:3px 10px 0px 0px;"><b><font color = 'black'>��� �������<b/></span></font></div>
<div class="field-gr"><a href="/account/paymentp"><b><font color = 'black'>{!BALANCE_P!} </font></b></a> <span style="margin:3px 10px 0px 0px;"><font color = 'black'>�� �����</font></span></div>


	

	