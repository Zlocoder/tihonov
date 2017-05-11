<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="icon" href="/images/favicon.ico">

    <title>Eternally - mysterious economic game</title>

    <meta Character name="description" content="">
    <meta Character name="keywords" content="">



    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="/libs/animate.css" />
    <link type="text/css" rel="stylesheet" href="/libs/fullpage/jquery.fullPage.css" />
    <link type="text/css" rel="stylesheet" href="/css/main.css" />
    <link type="text/css" rel="stylesheet" href="/css/media.css" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width" />
</head>


<body>

<?php
    SetCookie("Preloader","ToOneHour",time()+366);
    // SetCookie("Preloader","ToOneHour",time()+6);

    if(($_COOKIE['Preloader'] != 'ToOneHour'))
        echo"<div id='page-preloader'>
                <div class='contpre'>
                    <span class='spinner'></span>
                        <br>Подождите<br><small>идет загрузка</small>
                </div>
             </div>
            ";

?>

<div data-activates="slide-out" class="button-collapse sidebar-nav" ></div>



<?php

if(isset($_SESSION["user"]) ){ ?>

    <ul id="slide-out" class="side-nav">
        <li><div class="userView">
                <div class="background">
                    <img src="/images/acc_bg.png">
                </div>
                <a href="#!user"><img class="circle" src="/images/favicon.ico"></a>
                <a href="#!modal1" id="modal1"><span class="pink-text  accent-3">Hi, <?= $_SESSION['user'] ?>!</span></a><br>
                <!-- <a href="#!email"><span class="black-text "><b>Game balance:</b> 597.36</span></a><br>
                <a href="#!email"><span class="black-text "><b>Out balance:</b> 597.36</span></a> -->
                <a href="#!email"><span class="black-text "><b>EGR: {!BALANCE_B!}</b> </span></a><br>
                <a href="#!email"><span class="black-text "><b>EPR: {!BALANCE_P!}</b> </span></a><br>
            </div>
        </li>
        <li><a href="/account/" ><i class="material-icons">perm_identity</i>Account</a></li>
        <li><a href="/account/exit" ><i class="material-icons">input</i>Logout</a></li>
        <li><a href="/"><i class="material-icons">stay_current_portrait</i>Главная</a></li>
        <li><div class="divider"></div></li>
        <li><a class="subheader">News</a></li>
        <li class="side-news"><b class="pink-text accent-3">21.05</b> Тестовая новость в несколько строк</li>
        <li class="side-news"><b class="pink-text accent-3">20.05</b> Мы стартовали! Нацелены на долгую и продолжительную работу и желаем всем успешного профита!</li>
        <li><a class="waves-effect" href="#modal5" id="#modal5">Все новости</a></li>
    </ul>


  <?php }else { ?>


    <ul id="slide-out" class="side-nav">
        <li>
            <div class="userView">
                <div class="background">
                    <img src="images/pay/3.png">
                </div>
                <a href="#!user"><img class="circle" src="images/favicon.ico"></a>
                <a href="#!modal1" id="modal1"><span class="pink-text  accent-3">Hi, Гость!</span></a><br>
                <!-- <a href="#!email"><span class="black-text "><b>Game balance:</b> 597.36</span></a><br>
                <a href="#!email"><span class="black-text "><b>Out balance:</b> 597.36</span></a> -->
                <a href="#!email"><span
                            class="black-text "><b>У нас для тебя бонус в 10 рублей — регистрируйся ниже!</b> </span></a><br>

            </div>
        </li>
        <li><a href="#modal1" id="modal1"><i class="material-icons">perm_identity</i>Login</a></li>
        <li><a href="#modal2" id="modal2"><i class="material-icons">play_circle_filled</i>Register</a></li>
        <li><a href="#!">Second Link</a></li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a class="subheader">News</a></li>
        <li class="side-news"><b class="pink-text accent-3">21.05</b> Тестовая новость в несколько строк</li>
        <li class="side-news"><b class="pink-text accent-3">20.05</b> Мы стартовали! Нацелены на долгую и
            продолжительную работу и желаем всем успешного профита!
        </li>
        <li><a class="waves-effect" href="#modal5" id="#modal5">Все новости</a></li>
    </ul>


    <?PHP

    if (isset($_POST["log_email"])) {

        $lmail = $func->IsMail($_POST["log_email"]);

        if ($lmail !== false) {

            $db->Query("SELECT id, user, pass, referer_id, banned FROM db_users_a WHERE email = '$lmail'");
            if ($db->NumRows() == 1) {

                $log_data = $db->FetchArray();

                if ($log_data["pass"] == md5($_POST["pass"])) {

                    if ($log_data["banned"] == 0) {

                        # Считаем рефералов
                        $db->Query("SELECT COUNT(*) FROM db_users_a WHERE referer_id = '" . $log_data["id"] . "'");
                        $refs = $db->FetchRow();

                        $db->Query("UPDATE db_users_a SET referals = '$refs', date_login = '" . time() . "', ip = INET_ATON('" . $func->UserIP . "') WHERE id = '" . $log_data["id"] . "'");

                        $_SESSION["user_id"] = $log_data["id"];
                        $_SESSION["user"] = $log_data["user"];
                        $_SESSION["referer_id"] = $log_data["referer_id"];
                        Header("Location: /account");

                    } else echo "<center><font color = 'black'><b>Аккаунт заблокирован</b></font></center><BR />";

                } else echo "<center><font color = 'black'><b>Email и/или Пароль указан неверно</b></font></center><BR />";

            } else echo "<center><font color = 'black'><b>Указанный Email не зарегистрирован в системе</b></font></center><BR />";

        } else echo "<center><font color = 'black'><b>Email указан неверно</b></font></center><BR />";

    }
}

?>

<div class="container">

