
<div class="row">
    <div class="col s12">
        <h3>������� �������</h3>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <p>����� ��������� �������. ����� �� ������� ������ � Energy of Sphere. ������������ �� ����������, ������������ ��������� ������ �������� ���������� 10 �������! ��������� ������� �������� � �������������� �����������! �� ���������, ��� Energy of Sphere ������ ����� ��������! ��������� � ����� �������!</p>
        <p>����� ����������� Energy of Crystal � Energy of Flame �������� ������ ��� �������, ��� ������� �����! �.�. ���� �� ����� �� ����������� ������� �� ������ ������ ������ ���� �� �������� �������. �������� �� ������� ��� �� ���������, ����� ��������� 60-�������� ����� Energy of Crystal/Flame �� ���������� �� �����������, � ���������� ������������!</p>
        <p>����� �������, ���� ���� �� ����������� ������� ��� ������� EoC/F (�����) ���������� EoC/F ������ 1, �� ������� ����������, �.�. ����� ������ ��� � ����� Energy of Crystal/Flame, ��� ���������� ����� � ������� ����������� ������� ���� / ������� �����, ������ �� ������� ���� EoC/F ������� �� 1!</p>
        <p></p>
    </div>
</div>

<?php
$_OPTIMIZATION["title"] = "������� - ������ �������";
$usid = $_SESSION["user_id"];
$refid = $_SESSION["referer_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

# ������� ���� ��������� �������
$item_a = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 1"));
$item_b = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 2"));
$item_c = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 3"));
$item_d = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 4"));
$item_e = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 5"));
$item_f = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 6"));
$item_g = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 7"));
$item_h = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 8"));

# ������� ������
if(isset($_POST["item"])) {

    $array_items = [
        1 => "a_t",
        2 => "b_t",
        3 => "c_t",
        4 => "d_t",
        5 => "e_t",
        6 => "f_t",
        7 => "g_t",
        8 => "h_t"
    ];

    $array_name = [
        1 => "Energy of Sphere",
        2 => "Energy of Circulation",
        3 => "Energy of Purify",
        4 => "Energy of Radiance",
        5 => "Energy of Crystal",
        6 => "Energy of Flame",
        7 => "Eternal Mysteria_1",
        8 => "Eternal Mysteria_2"
    ];

    # ���� ����� �������, ��������� ����� � ���
    $array_time = [
        1 => (time() + 60 * 60 * 24 * 400),
        2 => (time() + 60 * 60 * 24 * 310),
        3 => (time() + 60 * 60 * 24 * 250),
        4 => (time() + 60 * 60 * 24 * 200),
        5 => (time() + 60 * 60 * 24 * 60),
        6 => (time() + 60 * 60 * 24 * 60),
        7 => (time() + 60 * 60 * 24 * 0),
        8 => (time() + 60 * 60 * 24 * 0)
    ];



    $item = intval($_POST["item"]);
    $citem = $array_items[$item];
    $amount = intval($_POST['amount']);

    # ������� ����������, ���� ��������� ������ ���� �������

    $i5_a = $item_a - $user_data['e_t'];
    $i5_b = $item_b - $user_data['e_t'];
    $i5_c = $item_c - $user_data['e_t'];

    $i6_a = $item_a - $user_data['f_t'];
    $i6_b = $item_b - $user_data['f_t'];
    $i6_c = $item_c - $user_data['f_t'];
    $i6_d = $item_d - $user_data['f_t'];

    if (strlen($citem) >= 3) {

        # ���������� �������
        if ($amount >= 1) {

            $need_money = $sonfig_site["amount_" . $citem] * $amount;

            # ��������� �������� ������������
            if ($need_money <= $user_data["money_b"]) {
                if ($user_data["last_sbor"] == 0 OR $user_data["last_sbor"] > (time() - 60 * 60)) {

                    # �������������� �����
                    if ($item == 1 && $user_data['a_t'] >= 10) {

                        $return = '������ 10 Energy of Sphere ������������ ���������� ������, ��������� � ��������';

                    # � ��� ��������
                    } elseif ($item == 5 && ($i5_a < 1 || $i5_b < 1 || $i5_c < 1)){

                        $return = '��� ������� Energy of Crystal �� ��������� ��� �������!';

                    }elseif  ($item == 6 && ($i6_a < 1 || $i6_b < 1 || $i6_c < 1 || $i6_d < 1)){

                        $return = '��� ������� Energy of Flame �� ��������� ��� �������!';

                    # ����� � �������
                    }elseif($item == 7 || $item == 8) {
                        $return = 'Eternal Mysteria ��� �� �������� ����!';

                    }else{

                        # ��������� ���� � ��������� ������
                        $db->Query("UPDATE db_users_b SET money_b = money_b - $need_money, $citem = $citem + $amount,  
                        last_sbor = IF(last_sbor > 0, last_sbor, '" . time() . "') WHERE id = '$usid'");

                        # ������ ������ � �������
                        $db->Query("INSERT INTO db_stats_btree (p_id, user_id, user, tree_name, amount, date_add, date_del) 
                        VALUES ('$item','$usid','$usname','" . $array_name[$item] . "','$need_money','" . time() . "','" . $array_time[$item] . "')");

                            $return = "�� ������� ������ �������";

                    } # ����� �� �������� �������

                } else $return = "����� �������� ������� �������� ��������";

            } else $return = "������������ ������� ��� �������";

        } else $return = "������� ��� ������� 1 �������";
    }
}



if($return){ ?>

<div class="row">
    <div class="col s12">
        <div class="account-alert"><?= $return ?></div>
    </div>
</div>

<?php } ?>

<div class="row">
    <div class="col offset-s4"></div>
    <div class="col s4">
        <a href="/account/items/" class="btn center" style="width: 100%;">���� �������</a>
    </div>
    <div class="col offset-s4"></div>
</div>


<div class="row">
        <div class="col xl3 l6 m6 s12">
            <div class="card ">
                <div class="card-image waves-effect waves-block waves-light" >
                    <img class="activator" src="/images/pay/1.png">
                </div>
                <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4">Energy of Sphere<i class="material-icons right">more_vert</i></span>
                    <p>
                        <a href="#"><?= $sonfig_site["amount_a_t"]; ?> EGR</a> / <a href="#">� ���: <?=$sonfig_site["a_in_h"]; ?></a> <br>
                        <a href="#">�������: <?= $item_a ?></a>

                        <form action="" method="post">
                            <input type="hidden" name="item" value="1">
                            <input type="number" step="1" min="1" name="amount" value="1"  size="5">
                            <input class="btn"  value="������ �������" type="submit">
                    </form>
                    </p>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Energy of Sphere<i class="material-icons right">close</i></span>

                    <ul>
                        <li>����: 10 EGR</li>
                        <li>����������: 400 ����</li>
                        <li>� ����: 0,80% / 0,08 EPR</li>
                        <li>�������: 320% / 32,0 EPR</li>
                        <li>�����: 10 ��.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col xl3 l6 m6 s12">
            <div class="card ">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="/images/pay/2.png">
                </div>
                <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4">Energy of Circulation<i class="material-icons right">more_vert</i></span>
                    <p>
                        <a href="#"><?= $sonfig_site["amount_b_t"]; ?> EGR</a> / <a href="#">� ���: <?=$sonfig_site["b_in_h"]; ?></a> <br>
                        <a href="#">�������: <?= $item_b ?></a>

                    <form action="" method="post">
                        <input type="hidden" name="item" value="2">
                        <input type="number" step="1" min="1" name="amount" value="1"  size="5">
                        <input class="btn"  value="������ �������" type="submit">
                    </form>
                    </p>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Energy of Circulation<i class="material-icons right">close</i></span>

                    <ul>
                        <li>����: 50 EGR</li>
                        <li>����������: 310 ����</li>
                        <li>� ����: 1,00% / 0,50 EPR</li>
                        <li>�������: 310% / 155,0 EPR</li>
                    </ul>

                </div>
            </div>
        </div>

        <div class="col xl3 l6 m6 s12">
            <div class="card  ">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="/images/pay/3.png">
                </div>
                <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4">Energy of Purify<i class="material-icons right">more_vert</i></span>
                    <p>
                        <a href="#"><?= $sonfig_site["amount_c_t"]; ?> EGR</a> / <a href="#">� ���: <?=$sonfig_site["c_in_h"]; ?></a> <br>
                        <a href="#">�������: <?= $item_c ?></a>

                    <form action="" method="post">
                        <input type="hidden" name="item" value="3">
                        <input type="number" step="1" min="1" name="amount" value="1"  size="5">
                        <input class="btn"  value="������ �������" type="submit">
                    </form>
                    </p>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Energy of Purify<i class="material-icons right">close</i></span>

                    <ul>
                        <li>����: 200 EGR</li>
                        <li>����������: 250 ����</li>
                        <li>� ����: 1,20% / 2,40 EPR</li>
                        <li>�������: 300% / 600,0 EPR</li>
                    </ul>

                </div>
            </div>
        </div>

        <div class="col xl3 l6 m6 s12">
            <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="/images/pay/4.png">
                </div>
                <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4">Energy of Radiance<i class="material-icons right">more_vert</i></span>
                    <p>
                        <a href="#"><?= $sonfig_site["amount_d_t"]; ?> EGR</a> / <a href="#">� ���: <?=$sonfig_site["d_in_h"]; ?></a> <br>
                        <a href="#">�������: <?= $item_d ?></a>

                    <form action="" method="post">
                        <input type="hidden" name="item" value="4">
                        <input type="number" step="1" min="1" name="amount" value="1"  size="5">
                        <input class="btn"  value="������ �������" type="submit">
                    </form>
                    </p>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Energy of Radiance<i class="material-icons right">close</i></span>

                    <ul>
                        <li>����: 2200 EGR</li>
                        <li>����������: 200 ����</li>
                        <li>� ����: 1,40% / 30,80 EPR</li>
                        <li>�������: 280% / 6160,0 EPR</li>
                    </ul>

                </div>
            </div>
        </div>

    <div class="col xl3 l6 m6 s12">
        <div class="card">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="/images/pay/5.png">
            </div>
            <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">Energy of Crystal<i class="material-icons right">more_vert</i></span>
                <p>
                    <a href="#"><?= $sonfig_site["amount_e_t"]; ?> EGR</a> / <a href="#">� ���: <?=$sonfig_site["e_in_h"]; ?></a> <br>
                    <a href="#">�������: <?= $item_e ?> / �����: <?= $user_data['e_t'] ?></a>

                <form action="" method="post">
                    <input type="hidden" name="item" value="5">
                    <input type="number" step="1" min="1" name="amount" value="1"  size="5">
                    <input class="btn"  value="������ �������" type="submit">
                </form>
                </p>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Energy of Crystal<i class="material-icons right">close</i></span>

                <ul>
                    <li>����: 500 EGR</li>
                    <li>����������: 60 ����</li>
                    <li>� ����: 2,00% / 10,00 EPR</li>
                    <li>�������: 120% / 600,0 EPR</li>

                    <li><u>�������� ��� �������:</u> Energy of Sphere, Energy of Circulation, Energy of Purify</li>
                </ul>

            </div>
        </div>
    </div>

    <div class="col xl3 l6 m6 s12">
        <div class="card">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="/images/pay/6.png">
            </div>
            <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">Energy of Flame<i class="material-icons right">more_vert</i></span>
                <p>
                    <a href="#"><?= $sonfig_site["amount_f_t"]; ?> EGR</a> / <a href="#">� ���: <?=$sonfig_site["f_in_h"]; ?></a> <br>
                    <a href="#">�������: <?= $item_f ?> / �����: <?= $user_data['f_t'] ?></a>

                <form action="" method="post">
                    <input type="hidden" name="item" value="6">
                    <input type="number" step="1" min="1" name="amount" value="1"  size="5">
                    <input class="btn"  value="������ �������" type="submit">
                </form>
                </p>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Energy of Flame<i class="material-icons right">close</i></span>

                <ul>
                    <li>����: 4000 EGR</li>
                    <li>����������: 60 ����</li>
                    <li>� ����: 2,50% / 100,0 EPR</li>
                    <li>�������: 150% / 6000,0 EPR</li>

                    <li><u>�������� ��� �������:</u> Energy of Sphere, Energy of Circulation, Energy of Purify, Energy of Radiance</li>
                </ul>

            </div>
        </div>
    </div>

    <div class="col xl3 l6 m6 s12">
        <div class="card">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="/images/pay/7.png">
            </div>
            <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">Eternal Mysteria<i class="material-icons right">more_vert</i></span>
                <p>
                    <a href="#"><?= $sonfig_site["amount_g_t"]; ?> EGR</a> / <a href="#">� ���: <?=$sonfig_site["g_in_h"]; ?></a> <br>
                    <a href="#">�������: <?= $item_g ?></a>

                <form action="" method="post">
                    <input type="hidden" name="item" value="7">
                    <input type="number" step="1" min="1" name="amount" value="1"  size="5">
                    <input class="btn disabled"  value="������ �������" type="submit">
                </form>
                </p>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Eternal Mysteria<i class="material-icons right">close</i></span>
                <p>����������� ������ �������. <br><br> ������� ������, ��� ��� ���������� ����� ��������� ��� � ����</p>
            </div>
        </div>
    </div>

    <div class="col xl3 l6 m6 s12">
        <div class="card">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="/images/pay/7.png">
            </div>
            <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">Eternal Mysteria<i class="material-icons right">more_vert</i></span>
                <p>
                    <a href="#"><?= $sonfig_site["amount_h_t"]; ?> EGR</a> / <a href="#">� ���: <?=$sonfig_site["h_in_h"]; ?></a> <br>
                    <a href="#">�������: <?= $item_h ?></a>

                <form action="" method="post">
                    <input type="hidden" name="item" value="8">
                    <input type="number" step="1" min="1" name="amount" value="1"  size="5">
                    <input class="btn disabled"  value="������ �������" type="submit">
                </form>
                </p>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Eternal Mysteria<i class="material-icons right">close</i></span>
                <p>����������� ������ �������. <br><br> ������� ������, ��� ��� ���������� ����� ��������� ��� � ����</p>
            </div>
        </div>
    </div>
</div>
