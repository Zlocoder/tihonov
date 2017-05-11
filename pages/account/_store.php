<?php

    $_OPTIMIZATION["title"] = "Аккаунт - Сбор энергии";
    $usid = $_SESSION["user_id"];
    $usname = $_SESSION["user"];

    $db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
    $user_data = $db->FetchArray();

    $db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
    $sonfig_site = $db->FetchArray();

    # кол-во купленных айтемов
    $item_a = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 1"));
    $item_b = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 2"));
    $item_c = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 3"));
    $item_d = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 4"));
    $item_e = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 5"));
    $item_f = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 6"));
    $item_g = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 7"));
    $item_h = $db->NumRows($db->query("SELECT p_id FROM db_stats_btree WHERE user_id = $usid AND p_id = 8"));

    # Неиспользуемые, но участвующие в зпросах
    $item_i = false;
    $item_j = false;
    $item_k = false;
    $item_l = false;
    $item_m = false;
    $item_n = false;
    $item_o = false;

    # Доступные для сбора айтемы
    $item_a_c = $func->SumCalc($sonfig_site["a_in_h"], $item_a, $user_data["last_sbor"]);
    $item_b_c = $func->SumCalc($sonfig_site["b_in_h"], $item_b, $user_data["last_sbor"]);
    $item_c_c = $func->SumCalc($sonfig_site["c_in_h"], $item_c, $user_data["last_sbor"]);
    $item_d_c = $func->SumCalc($sonfig_site["d_in_h"], $item_d, $user_data["last_sbor"]);
    $item_e_c = $func->SumCalc($sonfig_site["e_in_h"], $item_e, $user_data["last_sbor"]);
    $item_f_c = $func->SumCalc($sonfig_site["f_in_h"], $item_f, $user_data["last_sbor"]);
    $item_g_c = $func->SumCalc($sonfig_site["g_in_h"], $item_g, $user_data["last_sbor"]);
    $item_h_c = $func->SumCalc($sonfig_site["h_in_h"], $item_h, $user_data["last_sbor"]);

    # Неиспользуемые, но рабочие айтемы
    $item_i_c = $func->SumCalc($sonfig_site["i_in_h"], $item_i, $user_data["last_sbor"]);
    $item_j_c = $func->SumCalc($sonfig_site["j_in_h"], $item_j, $user_data["last_sbor"]);
    $item_k_c = $func->SumCalc($sonfig_site["k_in_h"], $item_k, $user_data["last_sbor"]);
    $item_l_c = $func->SumCalc($sonfig_site["l_in_h"], $item_l, $user_data["last_sbor"]);
    $item_m_c = $func->SumCalc($sonfig_site["m_in_h"], $item_m, $user_data["last_sbor"]);
    $item_n_c = $func->SumCalc($sonfig_site["n_in_h"], $item_n, $user_data["last_sbor"]);
    $item_o_c = $func->SumCalc($sonfig_site["o_in_h"], $item_o, $user_data["last_sbor"]);

    # Пересчет собранных, но не проданых айтемов
    $all_items = $user_data["a_b"] + $user_data["b_b"] + $user_data["c_b"] + $user_data["d_b"] + $user_data["e_b"] +
                 $user_data["f_b"] + $user_data["g_b"] + $user_data["h_b"] + $user_data["i_b"] + $user_data["j_b"] +
                 $user_data["k_b"] + $user_data["l_b"] + $user_data["m_b"] + $user_data["n_b"] + $user_data["o_b"];

    # пересчет не собранных айтемов
    $non_ckecked = ($item_a_c + $item_b_c + $item_c_c + $item_d_c + $item_e_c + $item_f_c + $item_g_c + $item_h_c);

?>

<div class="row">
    <div class="col s12">
        <h3>Сбор элементов</h3>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <p>Элементы формируются каждую секунду, но собирать их можно не чаще, чем раз в час! Курс обмена: 100 Элеметов = 1 EPR. Курс продажи элементов составляет 60% EPR / 40% EGR </p>
        <?php if($user_data["last_sbor"] > (time() - 3600) ){ ?>
            <p class="account-alert">Следующий сбор будет доступен в
            <?= date('P', $user_data['last_sbor']) . ' GMT, ' .  date('H:i:s', $user_data['last_sbor'] + 3600) ?></p>
        <?php } ?>
    </div>
</div>


<?PHP

	if(isset($_POST["sbor"])){
	
		if($user_data["last_sbor"] < (time() - 3600) ){

			$db->Query("UPDATE db_users_b SET 
			a_b = a_b + '$item_a_c', 
			b_b = b_b + '$item_b_c', 
			c_b = c_b + '$item_c_c', 
			d_b = d_b + '$item_d_c', 
			e_b = e_b + '$item_e_c',
			f_b = f_b + '$item_f_c',
			g_b = g_b + '$item_g_c',
			h_b = h_b + '$item_h_c',
			i_b = i_b + '$item_i_c',
			j_b = j_b + '$item_j_c',
			k_b = k_b + '$item_k_c',
			l_b = l_b + '$item_l_c',
			m_b = m_b + '$item_m_c',
			n_b = n_b + '$item_n_c',
			o_b = o_b + '$item_o_c',
			
			all_time_a = all_time_a + '$item_a_c',
			all_time_b = all_time_b + '$item_b_c',
			all_time_c = all_time_c + '$item_c_c',
			all_time_d = all_time_d + '$item_d_c',
			all_time_e = all_time_e + '$item_e_c',
			all_time_f = all_time_f + '$item_f_c',
			all_time_g = all_time_g + '$item_g_c',
			all_time_h = all_time_h + '$item_h_c',
			all_time_i = all_time_i + '$item_i_c',
			all_time_j = all_time_j + '$item_j_c',
			all_time_k = all_time_k + '$item_k_c',
			all_time_l = all_time_l + '$item_l_c',
			all_time_m = all_time_m + '$item_m_c',
			all_time_n = all_time_n + '$item_n_c',
			all_time_o = all_time_o + '$item_o_c',
			
			last_sbor = '".time()."' 
			WHERE id = '$usid' LIMIT 1");
			
			$return = 'Все элементы собраны';

            #del oldtime items
            $del = time();
            $db->Query("DELETE FROM db_stats_btree WHERE date_del < $del");

			$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
			$user_data = $db->FetchArray();

		}else $return = 'Еще не прошло 60 минут!';
	}

?>


<?PHP
# Продажа
if(isset($_POST["sell"])){

	if($all_items > 0){

	    # Делим собранные айтемы на курс конвертации в игровые монеты
		$money_add = $func->SellItems($all_items, $sonfig_site["items_per_coin"]);

		# назначаем им переменные
		$item_b_a = $user_data["a_b"];
        $item_b_b = $user_data["b_b"];
        $item_b_c = $user_data["c_b"];
        $item_b_d = $user_data["d_b"];
        $item_b_e = $user_data["e_b"];
        $item_b_f = $user_data["f_b"];
        $item_b_g = $user_data["g_b"];
        $item_b_h = $user_data["h_b"];
        $item_b_i = $user_data["i_b"];
        $item_b_j = $user_data["j_b"];
        $item_b_k = $user_data["k_b"];
        $item_b_l = $user_data["l_b"];
        $item_b_m = $user_data["m_b"];
        $item_b_n = $user_data["n_b"];
        $item_b_o = $user_data["o_b"];
		
		# процент на баланс для выплат
		$money_b = ( (100 - $sonfig_site["percent_sell"]) / 100) * $money_add;
		$money_p = ( ($sonfig_site["percent_sell"]) / 100) * $money_add;
		
		# Обновляем юзверя и очищаем ячеки проданных айтемов
		$db->Query("UPDATE db_users_b SET money_b = money_b + '$money_b', money_p = money_p + '$money_p', a_b = 0, b_b = 0, c_b = 0, d_b = 0, e_b = 0, f_b = 0, g_b = 0, h_b = 0, i_b = 0, j_b = 0, k_b = 0, l_b = 0, m_b = 0, n_b = 0, o_b = 0 WHERE id = '$usid'");
		
		$da = time();
		$dd = $da + 60*60*24*15;
		
		# Вставляем запись в статистику
		$db->Query("INSERT INTO db_sell_items (user, user_id, a_s, b_s, c_s, d_s, e_s, f_s, g_s, h_s, i_s, j_s, k_s, l_s, m_s, n_s, o_s, amount, all_sell, date_add, date_del) 
        VALUES ('$usname','$usid','$item_b_a','$item_b_b','$item_b_c','$item_b_d','$item_b_e','$item_b_f','$item_b_g','$item_b_h','$item_b_i','$item_b_j','$item_b_k','$item_b_l','$item_b_m','$item_b_n','$item_b_o','$money_add','$all_items','$da','$dd')");

		$to_egr = $money_add * 0.4;
        $to_epr = $money_add * 0.6;
		$return = "{$all_items} элементов успешно продано за {$to_egr} EGR и {$to_epr} EPR";
		
		$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
		$user_data = $db->FetchArray();
		
	}else $return = 'Продавать нечего!';

}

# Пересчет собранных, но не проданых айтемов
$all_items = $user_data["a_b"] + $user_data["b_b"] + $user_data["c_b"] + $user_data["d_b"] + $user_data["e_b"] +
    $user_data["f_b"] + $user_data["g_b"] + $user_data["h_b"] + $user_data["i_b"] + $user_data["j_b"] +
    $user_data["k_b"] + $user_data["l_b"] + $user_data["m_b"] + $user_data["n_b"] + $user_data["o_b"];

?>

<form action="" method="post">
    <div class="row">
        <div class="col s6">
            <input class="btn <?= $user_data["last_sbor"] > (time() - 3600) ? 'disabled' : '' ?>" type="submit" name="sbor"  value="Собрать <?= round($non_ckecked, 2) ?> EE" style="width: 100%;"/>
        </div>
        <div class="col s6">
            <input type="submit" name="sell" class="btn" value="Продать <?= round($all_items, 2) ?> EE за <?= round($all_items / $sonfig_site['items_per_coin'], 2) ?> ER" style="width: 100%;">
        </div>
    </div>
</form>

<?php if($return){ ?>

    <div class="row">
        <div class="col s12">
            <div class="account-alert"><?= $return ?></div>
        </div>
    </div>

<?php } ?>

<div class="row">
    <div class="col s3 center-align">
        <h4>Energy of Sphere</h4>
        <img src="/images/pay/1.png" alt="">
        Куплено: <?= $item_a ?><br>
        Доступно: <?= round($item_a_c, 2);?>
    </div>

    <div class="col s3 center-align">
        <h4>Energy of Circulation</h4>
        <img src="/images/pay/2.png" alt="">
        Куплено: <?= $item_b ?><br>
        Доступно: <?= round($item_b_c, 2);?>
    </div>

    <div class="col s3 center-align">
        <h4>Energy of Purify</h4>
        <img src="/images/pay/3.png" alt="">
        Куплено: <?= $item_c ?><br>
        Доступно: <?= round($item_c_c, 2);?>
    </div>

    <div class="col s3 center-align">
        <h4>Energy of Radiance</h4>
        <img src="/images/pay/4.png" alt="">
        Куплено: <?= $item_d ?><br>
        Доступно: <?= round($item_d_c, 2);?>
    </div>

    <div class="col s3 center-align">
        <h4>Energy of Crystal</h4>
        <img src="/images/pay/5.png" alt="">
        Куплено: <?= $item_e ?><br>
        Доступно: <?= round($item_e_c, 2);?>
    </div>

    <div class="col s3 center-align">
        <h4>Energy of Flame</h4>
        <img src="/images/pay/6.png" alt="">
        Куплено: <?= $item_f ?><br>
        Доступно: <?= round($item_f_c, 2);?>
    </div>

    <div class="col s3 center-align">
        <h4>Eternal Mysteria</h4>
        <img src="/images/pay/7.png" alt="">
        Куплено: <?= $item_g ?><br>
        Доступно: <?= round($item_g_c, 2);?>
    </div>

    <div class="col s3 center-align">
        <h4>Eternal Mysteria</h4>
        <img src="/images/pay/7.png" alt="">
        Куплено: <?= $item_h ?><br>
        Доступно: <?= round($item_h_c, 2);?>
    </div>

</div>




