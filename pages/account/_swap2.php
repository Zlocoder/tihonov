<?PHP
    $_OPTIMIZATION["title"] = "����� ���� ";
    $usid = $_SESSION["user_id"];
    $refid = $_SESSION["referer_id"];
    $usname = $_SESSION["user"];

    $user_data = $db->FetchArray($db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1"));

    # ���-�� ��������� �������
    $item_a = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 1"));
    $item_b = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 2"));
    $item_c = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 3"));
    $item_d = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 4"));

//    $all_a =


    if(isset($_POST["item_a_b"])){
        if ($user_data["a_t"] >= 11) {
            $db->Query("UPDATE db_users_b SET a_t = a_t - 11, b_t = b_t +1   WHERE id = '$usid'");

            $return = '����� ������� ����������';
        } else $return = '������������ ���� ��� ������';
    }

    if(isset($_POST["item_b_c"])){
        if ($user_data["b_t"] >= 11) {
            $db->Query("UPDATE db_users_b SET b_t = b_t - 11, c_t = c_t +1   WHERE id = '$usid'");

            $return = '����� ������� ����������';
        }else $return = '������������ ���� ��� ������';
    }

    if(isset($_POST["item_c_d"])){
        if ($user_data["c_t"] >= 3) {
            $db->Query("UPDATE db_users_b SET c_t = c_t - 3, d_t = d_t +1   WHERE id = '$usid'");

            $return = '����� ������� ����������';
        }else $return = '������������ ���� ��� ������';
    }



?>

<div class="row">
    <div class="col s12">
        <h3>����� �������</h3>
    </div>
</div>


<div class="row">
    <div class="col s12">
        <p>����� �� ������ �������� ������ ������� �� ������. � ������� ������� ������� ���� ������ ��������� ���� ������� � �� ������ ������� ������� ������ ������� �������� ������ ������, � � ������������ ������ � ����� �������������! �� �������� ���� ������������� ������������ ��� ���������! </p>
        <p>��� ������ ������� � ��� ����������� ������ ������� � ����������� ������ �� ������ ����!</p>
    </div>
</div>



<?php

$db->query("SELECT SUM(date_add) AS sum_add, SUM(date_del) AS sum_del FROM db_stats_btree WHERE  user_id = $usid AND p_id = 1");

while ($item = $db->FetchAssoc()){
    $item_days_a = (($item['sum_del'] - $item['sum_add']) / $item_a) / (3600 * 24);
//    echo (($item['sum_del'] - $item['sum_add']) / $item_a) / (3600 * 24);
}

$db->query("SELECT SUM(date_add) AS sum_add, SUM(date_del) AS sum_del FROM db_stats_btree WHERE  user_id = $usid AND p_id = 2");

while ($item = $db->FetchAssoc()){
    $item_days_b = (($item['sum_del'] - $item['sum_add']) / $item_b) / (3600 * 24);
//    echo (($item['sum_del'] - $item['sum_add']) / $item_a) / (3600 * 24);
}

$db->query("SELECT SUM(date_add) AS sum_add, SUM(date_del) AS sum_del FROM db_stats_btree WHERE  user_id = $usid AND p_id = 3");

while ($item = $db->FetchAssoc()){
    $item_days_c = (($item['sum_del'] - $item['sum_add']) / $item_c) / (3600 * 24);
//    echo (($item['sum_del'] - $item['sum_add']) / $item_a) / (3600 * 24);
}



?>

<?php
if($return){ ?>

    <div class="row">
        <div class="col s12">
            <div class="account-alert">
                <?= $return ?>
            </div>
        </div>
    </div>

<?php } ?>


<div class="row">
    <div class="col s12">
        <h4>����� Energy of Sphere �� Energy of Circulation</h4>
    </div>
</div>

<div class="row valign-wrapper">

    <div class="col s4 center-align">

        <img src="/images/pay/1.png" alt="">

    </div>
    <div class="col s4 center-align">

        <br>�������: <?= $item_a ?> Energy of Sphere <br>
        ������� �������: <?= $item_days_a ?> ����<br><br>

        <form action="" method="post" >
            <input type="hidden" name="item_a_b" value="1" />
            <input type="submit" value="��������"  class="btn" style="width: 100%;">
        </form>

    </div>
    <div class="col s4 center-align">

        <img src="/images/pay/2.png" alt="">

    </div>

</div>

<div class="row">
    <div class="col s12">
        <h4>����� Energy of Circulation �� Energy of Purify</h4>
    </div>
</div>

<div class="row valign-wrapper">

    <div class="col s4 center-align">
        <img src="/images/pay/2.png" alt="">
    </div>
    <div class="col s4 center-align">

        ������� ���� ������� �������:
        <?= $item_days_b ?> ����

        <form action="" method="post" >
            <input type="hidden" name="item_b_c" value="1" />
            <input type="submit" value="��������"  class="btn" style="width: 100%;">
        </form>
    </div>
    <div class="col s4 center-align">
        <img src="/images/pay/3.png" alt="">
    </div>

</div>

<div class="row">
    <div class="col s12">
        <h4>����� Energy of Purify �� Energy of Radiance</h4>
    </div>
</div>

<div class="row valign-wrapper">

    <div class="col s4 center-align">
        <img src="/images/pay/3.png" alt="">
    </div>
    <div class="col s4 center-align">

        ������� ���� ������� �������:
        <?= $item_days_c ?> ����

        <form action="" method="post" >
            <input type="hidden" name="item_c_d" value="1" />
            <input type="submit" value="��������"  class="btn" style="width: 100%;">
        </form>
    </div>
    <div class="col s4 center-align">
        <img src="/images/pay/4.png" alt="">
    </div>

</div>

