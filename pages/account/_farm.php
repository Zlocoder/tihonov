
<div class="row">
    <div class="col s12">
        <h3>Покупка энергии</h3>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <p>Здесь продается энергия. Лимит на покупку только у Energy of Sphere. Максимальное их количество, одновременно доступное одному аккаунту ограничено 10 штуками! Остальная энергия доступна в неограниченных количествах! Не забывайте, что Energy of Sphere всегда можно обнулить! Загляните в обмен энергий!</p>
        <p>Каждю последующую Energy of Crystal и Energy of Flame возможно купить при условии, что собрана линия! Т.е. имея по одной из необходимых энергий вы можете купить только одну из бонусных энергий. Схитрить на разнице дат не получится, после окончания 60-дневного срока Energy of Crystal/Flame их количество не уменьшается, а начисления прекращаются!</p>
        <p>Иными словами, если одна из необходимых энергий для покупки EoC/F (минус) количество EoC/F меньше 1, то покупка невозможна, т.е. чтобы купить две и более Energy of Crystal/Flame, вам необходимо иметь в наличии действующие энергии трех / четырех видов, каждая из которых выше EoC/F минимум на 1!</p>
        <p></p>
    </div>
</div>

<?php
$_OPTIMIZATION["title"] = "Аккаунт - купить энергию";
$usid = $_SESSION["user_id"];
$refid = $_SESSION["referer_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

# Подсчет всех купленных айтемов
$item_a = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 1"));
$item_b = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 2"));
$item_c = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 3"));
$item_d = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 4"));
$item_e = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 5"));
$item_f = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 6"));
$item_g = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 7"));
$item_h = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 8"));

# Покупка айтема
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

    # Срок жизни тарифов, последнее число — дни
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

    # Создаем переменные, дабы уменьшить размер кода условия

    $i5_a = $item_a - $user_data['e_t'];
    $i5_b = $item_b - $user_data['e_t'];
    $i5_c = $item_c - $user_data['e_t'];

    $i6_a = $item_a - $user_data['f_t'];
    $i6_b = $item_b - $user_data['f_t'];
    $i6_c = $item_c - $user_data['f_t'];
    $i6_d = $item_d - $user_data['f_t'];

    if (strlen($citem) >= 3) {

        # Количество айтемов
        if ($amount >= 1) {

            $need_money = $sonfig_site["amount_" . $citem] * $amount;

            # Проверяем средства пользователя
            if ($need_money <= $user_data["money_b"]) {
                if ($user_data["last_sbor"] == 0 OR $user_data["last_sbor"] > (time() - 60 * 60)) {

                    # Лимитированный айтем
                    if ($item == 1 && $user_data['a_t'] >= 10) {

                        $return = 'Больше 10 Energy of Sphere одновременно приобрести нельзя, загляните в обменник';

                    # С доп условием
                    } elseif ($item == 5 && ($i5_a < 1 || $i5_b < 1 || $i5_c < 1)){

                        $return = 'Для покупки Energy of Crystal не соблюдены все условия!';

                    }elseif  ($item == 6 && ($i6_a < 1 || $i6_b < 1 || $i6_c < 1 || $i6_d < 1)){

                        $return = 'Для покупки Energy of Flame не соблюдены все условия!';

                    # Снять с продажи
                    }elseif($item == 7 || $item == 8) {
                        $return = 'Eternal Mysteria еще не проявила себя!';

                    }else{

                        # Добавляем пчел и списываем деньги
                        $db->Query("UPDATE db_users_b SET money_b = money_b - $need_money, $citem = $citem + $amount,  
                        last_sbor = IF(last_sbor > 0, last_sbor, '" . time() . "') WHERE id = '$usid'");

                        # Вносим запись о покупке
                        $db->Query("INSERT INTO db_stats_btree (p_id, user_id, user, tree_name, amount, date_add, date_del) 
                        VALUES ('$item','$usid','$usname','" . $array_name[$item] . "','$need_money','" . time() . "','" . $array_time[$item] . "')");

                            $return = "Вы успешно купили энергию";

                    } # выход из успешной покупки

                } else $return = "Перед покупкой энергии соберите элементы";

            } else $return = "Недостаточно средств для покупки";

        } else $return = "Минимум для покупки 1 энергия";
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
        <a href="/account/items/" class="btn center" style="width: 100%;">Ваша энергия</a>
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
                        <a href="#"><?= $sonfig_site["amount_a_t"]; ?> EGR</a> / <a href="#">В час: <?=$sonfig_site["a_in_h"]; ?></a> <br>
                        <a href="#">Куплено: <?= $item_a ?></a>

                        <form action="" method="post">
                            <input type="hidden" name="item" value="1">
                            <input type="number" step="1" min="1" name="amount" value="1"  size="5">
                            <input class="btn"  value="Купить энергию" type="submit">
                    </form>
                    </p>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Energy of Sphere<i class="material-icons right">close</i></span>

                    <ul>
                        <li>Цена: 10 EGR</li>
                        <li>Существует: 400 дней</li>
                        <li>В день: 0,80% / 0,08 EPR</li>
                        <li>Прибыль: 320% / 32,0 EPR</li>
                        <li>Лимит: 10 шт.</li>
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
                        <a href="#"><?= $sonfig_site["amount_b_t"]; ?> EGR</a> / <a href="#">В час: <?=$sonfig_site["b_in_h"]; ?></a> <br>
                        <a href="#">Куплено: <?= $item_b ?></a>

                    <form action="" method="post">
                        <input type="hidden" name="item" value="2">
                        <input type="number" step="1" min="1" name="amount" value="1"  size="5">
                        <input class="btn"  value="Купить энергию" type="submit">
                    </form>
                    </p>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Energy of Circulation<i class="material-icons right">close</i></span>

                    <ul>
                        <li>Цена: 50 EGR</li>
                        <li>Существует: 310 дней</li>
                        <li>В день: 1,00% / 0,50 EPR</li>
                        <li>Прибыль: 310% / 155,0 EPR</li>
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
                        <a href="#"><?= $sonfig_site["amount_c_t"]; ?> EGR</a> / <a href="#">В час: <?=$sonfig_site["c_in_h"]; ?></a> <br>
                        <a href="#">Куплено: <?= $item_c ?></a>

                    <form action="" method="post">
                        <input type="hidden" name="item" value="3">
                        <input type="number" step="1" min="1" name="amount" value="1"  size="5">
                        <input class="btn"  value="Купить энергию" type="submit">
                    </form>
                    </p>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Energy of Purify<i class="material-icons right">close</i></span>

                    <ul>
                        <li>Цена: 200 EGR</li>
                        <li>Существует: 250 дней</li>
                        <li>В день: 1,20% / 2,40 EPR</li>
                        <li>Прибыль: 300% / 600,0 EPR</li>
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
                        <a href="#"><?= $sonfig_site["amount_d_t"]; ?> EGR</a> / <a href="#">В час: <?=$sonfig_site["d_in_h"]; ?></a> <br>
                        <a href="#">Куплено: <?= $item_d ?></a>

                    <form action="" method="post">
                        <input type="hidden" name="item" value="4">
                        <input type="number" step="1" min="1" name="amount" value="1"  size="5">
                        <input class="btn"  value="Купить энергию" type="submit">
                    </form>
                    </p>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Energy of Radiance<i class="material-icons right">close</i></span>

                    <ul>
                        <li>Цена: 2200 EGR</li>
                        <li>Существует: 200 дней</li>
                        <li>В день: 1,40% / 30,80 EPR</li>
                        <li>Прибыль: 280% / 6160,0 EPR</li>
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
                    <a href="#"><?= $sonfig_site["amount_e_t"]; ?> EGR</a> / <a href="#">В час: <?=$sonfig_site["e_in_h"]; ?></a> <br>
                    <a href="#">Активно: <?= $item_e ?> / Всего: <?= $user_data['e_t'] ?></a>

                <form action="" method="post">
                    <input type="hidden" name="item" value="5">
                    <input type="number" step="1" min="1" name="amount" value="1"  size="5">
                    <input class="btn"  value="Купить энергию" type="submit">
                </form>
                </p>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Energy of Crystal<i class="material-icons right">close</i></span>

                <ul>
                    <li>Цена: 500 EGR</li>
                    <li>Существует: 60 дней</li>
                    <li>В день: 2,00% / 10,00 EPR</li>
                    <li>Прибыль: 120% / 600,0 EPR</li>

                    <li><u>Доступна при покупке:</u> Energy of Sphere, Energy of Circulation, Energy of Purify</li>
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
                    <a href="#"><?= $sonfig_site["amount_f_t"]; ?> EGR</a> / <a href="#">В час: <?=$sonfig_site["f_in_h"]; ?></a> <br>
                    <a href="#">Активно: <?= $item_f ?> / Всего: <?= $user_data['f_t'] ?></a>

                <form action="" method="post">
                    <input type="hidden" name="item" value="6">
                    <input type="number" step="1" min="1" name="amount" value="1"  size="5">
                    <input class="btn"  value="Купить энергию" type="submit">
                </form>
                </p>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Energy of Flame<i class="material-icons right">close</i></span>

                <ul>
                    <li>Цена: 4000 EGR</li>
                    <li>Существует: 60 дней</li>
                    <li>В день: 2,50% / 100,0 EPR</li>
                    <li>Прибыль: 150% / 6000,0 EPR</li>

                    <li><u>Доступна при покупке:</u> Energy of Sphere, Energy of Circulation, Energy of Purify, Energy of Radiance</li>
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
                    <a href="#"><?= $sonfig_site["amount_g_t"]; ?> EGR</a> / <a href="#">В час: <?=$sonfig_site["g_in_h"]; ?></a> <br>
                    <a href="#">Куплено: <?= $item_g ?></a>

                <form action="" method="post">
                    <input type="hidden" name="item" value="7">
                    <input type="number" step="1" min="1" name="amount" value="1"  size="5">
                    <input class="btn disabled"  value="Купить энергию" type="submit">
                </form>
                </p>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Eternal Mysteria<i class="material-icons right">close</i></span>
                <p>Неизвестная темная энергия. <br><br> Легенды гласят, что она появляется всего несколько раз в году</p>
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
                    <a href="#"><?= $sonfig_site["amount_h_t"]; ?> EGR</a> / <a href="#">В час: <?=$sonfig_site["h_in_h"]; ?></a> <br>
                    <a href="#">Куплено: <?= $item_h ?></a>

                <form action="" method="post">
                    <input type="hidden" name="item" value="8">
                    <input type="number" step="1" min="1" name="amount" value="1"  size="5">
                    <input class="btn disabled"  value="Купить энергию" type="submit">
                </form>
                </p>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Eternal Mysteria<i class="material-icons right">close</i></span>
                <p>Неизвестная темная энергия. <br><br> Легенды гласят, что она появляется всего несколько раз в году</p>
            </div>
        </div>
    </div>
</div>
