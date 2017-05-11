



<?PHP
$db->Query("SET NAMES cp1251");
$_OPTIMIZATION["title"] = "Рекламные материалы, банеры";
$user_id = $_SESSION["user_id"];
$db->Query("SELECT COUNT(*) FROM db_users_a WHERE referer_id = '$user_id'");
$refs = $db->FetchRow();
?>  

<div class="row">
    <div class="col s12">
        <h3>Рекламные материалы</h3>
    </div>
</div>

<div class="row">

    <div class="col s12 center-align">
        <h4>Реф. ссылка</h4>
        <textarea class="materialize-textarea center-align">
        http://<?=$_SERVER['HTTP_HOST']; ?>/?i=<?=$_SESSION["user_id"]; ?>
</textarea>

        <h4>Баннер 468*60</h4>

        <img src="/banner/468.gif">

        <textarea class="materialize-textarea center-align">
            <a href="http://<?=$_SERVER['HTTP_HOST']; ?>/?i=<?=$_SESSION["user_id"]; ?>"><img src="http://<?=$_SERVER['HTTP_HOST']; ?>/banner/468.gif" ></a>
</textarea>



        <h4>Баннер 728*90 </h4>

        <img src="/banner/728.gif" >

        <textarea class="materialize-textarea center-align">
    <a href="http://<?=$_SERVER['HTTP_HOST']; ?>/?i=<?=$_SESSION["user_id"]; ?>"><img src="http://<?=$_SERVER['HTTP_HOST']; ?>/banner/728.gif" /></a>
</textarea>


        <h4>Баннер 200*300</h4>

        <img src="/banner/200.gif">

        <textarea class="materialize-textarea center-align">
    <a href="http://<?=$_SERVER['HTTP_HOST']; ?>/?i=<?=$_SESSION["user_id"]; ?>"><img src="http://<?=$_SERVER['HTTP_HOST']; ?>/banner/200.gif" /></a>
</textarea>
    </div>

</div>


















