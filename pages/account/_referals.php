

<?PHP
$_OPTIMIZATION["title"] = "Аккаунт - Партнерская программа";
$user_id = $_SESSION["user_id"];
$db->Query("SELECT COUNT(*) FROM db_users_a WHERE referer_id = '$user_id'");
$refs = $db->FetchRow();
?>

<div class="row">
    <div class="col s12">
        <h3>Ваши рефералы</h3>
    </div>
</div>

<div class="row">
    <div class="col">
        <p>У вас <?=$refs; ?> рефералов. С каждого пополнения вы будете получать 10% на ваш баланс </p>
        <p>Ссылка: https://<?=$_SERVER['HTTP_HOST']; ?>/?i=<?=$_SESSION["user_id"]; ?></p>
    </div>
</div>

<?php
    $all_money = 0;
    $db->Query("
          SELECT db_users_a.user, db_users_a.date_reg, db_users_b.to_referer 
          FROM db_users_a, db_users_b 
          WHERE db_users_a.id = db_users_b.id 
          AND db_users_a.referer_id = '$user_id' 
          ORDER BY to_referer
          DESC
        ");
?>


<div class="row">
    <div class="col s12">
        <table class="bordered centered">
            <thead>
            <tr>
                <th class=""><b> Логин</b> </th>
                <th class=""><b> Дата регистрации </b></th>
                <th class=""><b> Доход от партнера </b></th>
            </tr>
            </thead>
            <tbody>

            <?php if($db->NumRows() > 0){
                while($ref = $db->FetchArray()){
                    $all_money += $ref["to_referer"]; ?>
                    <tr>
                        <td> <?= $ref["user"]; ?> </td>
                        <td> <?= date("d.m.Y в H:i:s",$ref["date_reg"]); ?> </td>
                        <td> <?= round($ref["to_referer"], 2); ?> </td>
                    </tr>
                <?php }
            }else echo '<tr><td colspan="3">У вас нет рефералов</td></tr>'; ?>

            </tbody>
        </table>
    </div>
</div>







  





