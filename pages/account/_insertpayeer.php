
<div class="row">
    <div class="col s12">
        <h3>���������� �����</h3>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <p>� ������ ������� �� ������ �������� ���� ������� ������. �� ������ ������ �� �������� ������ � ��������� �������� PAYEER! ������� ����� � ������ � ������� ��������</p>
        <p>������� ����: 1 EGR = 1 �����! </p>
        <p>�� ����� ������������� �������� +15% � ����� ����������!</p>

    </div>
</div>

<div class="row">
    <div class="col s12">
        <h4>����������� �������� ��� ��������, ����� ��� ���������!</h4>
    </div>
</div>



<?
/// db_payeer_insert
if(isset($_POST["sum"])){

    $sum = round(floatval($_POST["sum"]),2);
    # ��������� 15% � ����������
    $sum1 = ($sum * 0.15) + $sum;


    # ������� � ��
    $db->Query("INSERT INTO db_payeer_insert (user_id, user, sum, date_add) 
    VALUES ('".$_SESSION["user_id"]."','".$_SESSION["user"]."','$sum','".time()."')");

    $desc = base64_encode($_SERVER["HTTP_HOST"]." - USER ".$_SESSION["user"]);
    $m_shop = $config->shopID;
    $m_orderid = $db->LastInsert();
    $m_amount = number_format($sum, 2, ".", "");
    $m_curr = "RUB";
    $m_desc = $desc;
    $m_key = $config->secretW;

    $arHash = array(
     $m_shop,
     $m_orderid,
     $m_amount,
     $m_curr,
     $m_desc,
     $m_key
    );
    $sign = strtoupper(hash('sha256', implode(":", $arHash)));

    ?>

    <form method="GET" action="//payeer.com/api/merchant/m.php">
        <input type="hidden" name="m_shop" value="<?=$config->shopID; ?>">
        <input type="hidden" name="m_orderid" value="<?=$m_orderid; ?>">
        <input type="hidden" name="m_amount" value="<?=number_format($sum, 2, ".", "")?>">
        <input type="hidden" name="m_curr" value="RUB">
        <input type="hidden" name="m_desc" value="<?=$desc; ?>">
        <input type="hidden" name="m_sign" value="<?=$sign; ?>">
        <input type="submit" name="m_process" value="�������� � �������� <?= $sum1 ?> EGR" class="btn center-align"/>
    </form>


    <?php
    return;
    }
?>

<div class="row">
    <div class="col offset-s2"></div>
    <div class="col s8">
        <form method="POST" action="">
            <label for="payer_ins">������� ����� [<?= $config->VAL ?>]: </label>
            <input type="hidden" name="m" id="payer_ins" value="<?= $fk_merchant_id ?>">

            <input type="number" min="1" value="100" name="sum">

            <input type="submit" id="submit" value="���������" class="btn right">
        </form>
    </div>
    <div class="col offset-s2"></div>
</div>




