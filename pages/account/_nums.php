<?PHP
$_OPTIMIZATION["title"] = "Аккаунт - Партнерская программа";
$user = $_SESSION["user"];
$db->Query("SELECT COUNT(*) FROM db_users_a WHERE referer_id = '$user_id'");
$refs = $db->FetchRow();

$key =  time()*2 + (99*0.8);
$key_y = time()*2 + (99*0.8);
$key_k = md5((1 + $key) * 2 + (99*0.8));
$key_q = md5((2 + $key) * 2 + (99*0.8));
$key_z = md5((3 + $key) * 2 + (99*0.8));
$key_f = md5((4 + $key) * 2 + (99*0.8));
$key_m = md5((5 + $key) * 2 + (99*0.8));


echo md5($key +1) . '<br>' . $key_k;



?>





<h3>Nums</h3>
<?php
$sql = $db->FetchRow($db->Query("SELECT * FROM db_nums_game"));

var_dump($sql);
echo '<br><br><br>';

$timestamp = strtotime($sql['key_y']);

echo  date('U', $timestamp);
?>

<div class="row">
    <div class="col offset-s4"></div>
    <div class="col s4">
        <div class="counter"><h4>00000</h4></div>
        <div class="counter_ask center-align">Попытай свой удачу</div>
        <button class="btn gop" style="width: 100%;">Крутить</button>
    </div>
    <div class="col offset-s4"></div>
</div>

<div class="row">
    <div class="col s12 center-align">
        <div class="block">0000</div>
        <div class="time"></div>
    </div>
</div>

<?= $key_y ?>




<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="/js/game_num.js"></script>

<script>

    var user = '<?= $user ?>',
        key_y = '<?= $key_y ?>',
        key_k = '<?= $key_k ?>',
        key_q = '<?= $key_q ?>',
        key_z = '<?= $key_z ?>',
        key_f = '<?= $key_f ?>',
        key_m = '<?= $key_m ?>',
        time = <?= time(); ?>;

</script>