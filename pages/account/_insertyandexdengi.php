<div class="wrap">
<br />
<center>
<div class="block3" style="margin-left:-0px">
<div class="b-title">������</div>
<br />
<br />
<center>
<div class="summa2">��� �������<span class="sum2">{!BALANCE_B!}<img src="/img/p3.png"></span></div>
<div class="summa2">��� ������<span class="sum2">{!BALANCE_P!}<img src="/img/p3.png"></span></div>
<br />
<font style="position: absolute;  font-size: 12px;  line-height: 11px;    color: #b01c13;border: 0px solid #c58b41;border-radius: 20px;background: #ffea60;font-weight: bold;padding: 2px 8px;box-shadow: 0px 0px 8px 2px #231812;z-index: 10;margin-left: 71px;  margin-top: -11px;">+15%</font><a href="/account/magazin"  class="button7">��������� ����</a>
<br />
<a href="/account/payment"  class="button7">�������� �������</a>
</center>
</div>


<div class="block3" style="margin-left:-0px">
<div class="b-title">������</div>
<div style="height:57px;"></div>
<center>

<a href="/account/farm"  class="button7">������ ����</a>
<br />
<a href="/account/store" class="button7">������� ���</a>
<br />
<a href="/account/swap2" class="button7">����� ����</a>
</center>
</div>


<div class="block3" style="margin-left:-0px">
<div class="b-title">��������</div>
<div style="height:57px;"></div>
<center>

<a href="/account/referals"  class="button7">��� ��������</a>
<br />
<a href="/competition" class="button7">������� ���������</a>
<br />
<a href="/account/baners" class="button7">�������</a>
</center>
</div>

<div class="block3" style="margin-left:-0px">
<div class="b-title">������</div>
<div style="height:57px;"></div>
<center>

<a href="/account/swap"  class="button7">��������</a>
<br />
<a href="/account/bonus" class="button7">�����</a>
<br />
<a href="/account/exit" class="button7">�����</a>
</center>
</div>
</center>

<br />

<center><div style="padding:0px; ">
<div class="" style="padding:10px">								<div class=""><br>
									<div class="tit">���������� �����</div>


<h4>
<div class="silver-bk">
<h4>

<h4>���� ������� ������: 1 ����� (���.) = 100 �����
<p>���� ������� ��������� ������������� ���������� ������� ������ � ������� ��������� 
������: Yandex ������ � ���������� ����.</p>
<p>������ � ���������� ������ �� ������ ������������ � �������������� ������.</p> 
<p>������� ����� � ������, ������� �� ������ ��������� �� ������. <BR />
����� ���������� ��� ����� ��������� ������.<br /></p>

<BR />
<BR />
<div class="title"><span style="font: 20px sans serif; color: #c33d2b;"><center>����� ����������� ����������� �������� ���� ���, ����� ��� ���������!</center></span></div>
<BR />
<BR />


<?PHP

$wallet_yad = 410013599960828;

$_OPTIMIZATION["title"] = "������� - ���������� �������";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();


?>

<?PHP

/*
if($_SESSION["user_id"] != 1){
echo "<center><b><font color = red>����������� ������</font></b></center>";
return;
}
*/

?>

<div class="silver-bk">

<?php

if(isset($_POST["sum"])){

$sum = round(floatval($_POST["sum"]),2);


# ������� � ��
$db->Query("INSERT INTO db_payeer_insert (user_id, user, sum, date_add) VALUES ('".$_SESSION["user_id"]."','".$_SESSION["user"]."','$sum','".time()."')");

$orderid = $db->LastInsert();

?>
	<div align="center">
       
		<form action="https://money.yandex.ru/quickpay/confirm.xml" method="POST">

		 <table>

		  <tbody>

		<input type="hidden" name="receiver" value="<?=$wallet_yad;?>">
		<input type="hidden" name="label" value="<?=$orderid;?>">
		<input type="hidden" name="formcomment" value="<?=$usname; ?> : <?=$usid; ?>">
		<input type="hidden" name="short-dest" value="<?=$usname; ?> : <?=$usid; ?>">
        <input type="hidden" name="quickpay-form" value="donate">
		<input type="hidden" name="targets" value="���������� �����!">
		<input type="hidden" name="successURL" value="<?=$_SERVER['SERVER_NAME'];?>/success.html">

		    <tr style="padding-bottom:15px;">

			     <td colspan="2"><center><font color = "#b06100">����� ����������: <b> <?=$sum;?> <?=$config->VAL; ?> </b></font></center><br> </td>

				 <td><input type="hidden" name="sum" value="<?=number_format($sum, 2, ".", "")?>" placeholder="������� ����� ����������"></td>
		    </tr>

			<tr><td><label><input type="radio" name="paymentType" value="PC"> ������.�������� </label>&nbsp;&nbsp;&nbsp;</td>
			                               <td><label><input type="radio" name="paymentType" value="AC"> ���������� ������</label><br></td>
			</tr>

			

		   </tbody>

		 </table>
	<br>	 
<center><input type="submit" value="�������� � �������� ������" class="button25"></center>
		 </form>

<br /><br /></div></div></div></div></div></div>

</div>	</div>			
<br /><br />

<?PHP

return;

}
?>
<script type="text/javascript">
	var min = 0.01;
	var ser_pr = 100;
	function calculate(st_q) {

		var sum_insert = parseFloat(st_q);
		$('#res_sum').html( (sum_insert * ser_pr).toFixed(0) );
}
</script>

<div id="error3"></div>


<form method="POST" action="">
    <input type="hidden" name="m" value="<?=$fk_merchant_id?>">
������� ����� [<?=$config->VAL; ?>]:
<input type="text" value="100" name="sum" size="7" id="psevdo" onchange="calculate(this.value)" onkeyup="calculate(this.value)" onfocusout="calculate(this.value)" onactivate="calculate(this.value)" ondeactivate="calculate(this.value)">


	<BR /><BR />
    <div align="center"><input type="submit" id="submit" value="��������� ������ ����� ������ ������" class="button25"></div>
</form>

<script type="text/javascript">
	calculate(100);
</script>

<BR />

<br /><br /></div></div></div></div></div>

</div>	</div>			
<br /><br />
