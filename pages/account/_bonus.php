<?PHP
$_OPTIMIZATION["title"] = "Аккаунт - Ежедневный бонус";
$usid = $_SESSION["user_id"];
$uname = $_SESSION["user"];

# Настройки бонусов
$bonus_min = 1;
$bonus_max = 20;

$ddel = time() + 60*60*3;
$dadd = time();

$del_bool = $db->FetchRow($db->Query("SELECT COUNT(*) FROM db_bonus_list WHERE user_id = '$usid' AND date_del > '$dadd'"));
$del_time = $db->FetchAssoc($db->Query("SELECT date_add, date_del FROM db_bonus_list WHERE user_id = '$usid' AND date_del > '$dadd'"));

$next_bonus = date('P', $del_time['date_del']) . ' GMT, ' . date('H:i:s', $del_time['date_del']);
$until = $del_time['date_del'] - time();

$hide_form = false;

?>


<div class="row">
    <div class="col s12">
        <h3>Ежедневный бонус</h3>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <p>Бонус выдается каждые 3 часа случайно от <?= $bonus_min / 100 ?> до <?= $bonus_max / 100 ?> EGR</p>
    </div>
</div>

<?PHP
	if($del_bool == 0){
	    # Выдача бонуса
		if(isset($_POST["bonus"])){
		
			$sum = rand($bonus_min, rand($bonus_min, $bonus_max)) / 100;
			
			# Зачилсяем юзверю
			$db->Query("UPDATE db_users_b SET money_b = money_b + '$sum' WHERE id = '$usid'");
			
			# Вносим запись в список бонусов
			
			
			$db->Query("INSERT INTO db_bonus_list (user, user_id, sum, date_add, date_del) VALUES ('$uname','$usid','$sum','$dadd','$ddel')");
			
			# Случайная очистка устаревших записей
            $count_rows = $db->NumRows($db->query("SELECT date_del FROM db_bonus_list"));
            if($count_rows > 50){
                $db->Query("DELETE FROM db_bonus_list WHERE date_del < '$dadd'");
            }

			echo "<div class='account-alert'>Вам начислено {$sum} EGR</div>";
			
			$hide_form = true;
			
		}

			# Показывать или нет форму
			if(!$hide_form){ ?>

                <div class="row">
                    <div class="col offset-s4"></div>
                    <div class="col s4">
                        <form action="" method="post">
                            <input type="submit" name="bonus" value="Получить бонус"  class="btn" style="width: 100%;"/>
                        </form>
                    </div>
                    <div class="col offset-s4"></div>
                </div>

                <?php }
            }else { ?>
                <div class="row">
                    <div class="col s12">
                        <p class="account-alert">Следующий бонус можно будет получить в <?= $next_bonus ?></p>
                        <p class="account-alert">Осталось ждать примерно <span class="counter_time"></span>:<span class="count_seconds"></span> мин. </p>
                    </div>
                </div>
            <?php } ?>


<div class="row">
    <div class="col s12">
        <h4>Последние 50 бонусов</h4>
        <table class="bordered centered">
            <thead>
            <tr>
                <th align="center" class="title7">ID</th>
                <th align="center" class="title7">Пользователь</th>
                <th align="center" class="title7">Сумма</th>
                <th align="center" class="title7">Дата</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $db->Query("SELECT * FROM db_bonus_list ORDER BY id DESC LIMIT 50");

            if($db->NumRows() > 0){

                while($bon = $db->FetchArray()){ ?>
                    <tr class="htt">
                        <td><?=$bon["id"]; ?></td>
                        <td><?=$bon["user"]; ?></td>
                        <td><?=$bon["sum"]; ?></td>
                        <td><?=date("d-M-Y, H:i:s",$bon["date_add"]); ?></td>
                    </tr>
                <?php }

            }else echo '<tr><td align="center" colspan="5">Нет записей</td></tr>'
            ?>
            </tbody>
        </table>
    </div>
</div>



<script>
    var i = <?= round($until / 60) ?>;
    function counter_time(){
        document.querySelector('.counter_time').innerHTML = i;
        i--;//уменьшение счетчика
        if (i < 0) location.href = "/account/bonus";//редирект

    }

    var s = 60;
    function count_seconds(){

        document.querySelector('.count_seconds').innerHTML = s;
        s--;
        if(s < 0){
            s =  60;
            count_seconds();
        }
    }
    counter_time();
    setInterval(counter_time, 60000);

    count_seconds();
    setInterval(count_seconds, 1000);

</script>



