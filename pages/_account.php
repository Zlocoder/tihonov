<?PHP
$_OPTIMIZATION["title"] = "Аккаунт";
$_OPTIMIZATION["description"] = "Аккаунт пользователя";
$_OPTIMIZATION["keywords"] = "Аккаунт, личный кабинет, пользователь";

# Блокировка сессии
if(!isset($_SESSION["user_id"])){ Header("Location: /"); return; }

if($_GET["sel"]){


	$smenu = strval($_GET["sel"]);
			include __DIR__ . '/account/_account_menu.php';

	switch($smenu){

		case "404":
		    include("pages/_404.php");
		    break; // Страница ошибки
		case "referals":
		    include("pages/account/_referals.php");
		    break; // Рефералы
		case "farm":
		    include("pages/account/_farm.php");
		    break; // Моя ферма
		case "store":
		    include("pages/account/_store.php");
		    break; // Склад
		case "swap":
		    include("pages/account/_swap.php");
		    break; // Обменный пункт
        case "swap2":
            include("pages/account/_nums.php");
            break; // Обменный пункт

		case "donations":
		    include("pages/account/_donations.php");
		    break; // Пожертвования
		case "payment":
		    include("pages/account/_payment.php");
		    break; // Выплата авто
		case "insertpayeer":
		    include("pages/account/_insertpayeer.php");
		    break; // Пополнение баланса

		case "config":
		    include("pages/account/_config.php");
		    break; // Настройки
		case "bonus":
		    include("pages/account/_bonus.php");
		    break; // Ежедневный бонус
		case "baners":
		    include("pages/account/_baners.php");
		    break; // Банеры

		case "serfing":
		    include("pages/account/_serfing.php");
		    break; // серфинг
      	case "bonus_lider":
      	    include("pages/account/_bonus_lider.php");
      	    break; // Бонус Лидер
        case "items":
            include("pages/account/_items.php");
            break; // Все пчелы
		case "exit":
		    @session_destroy(); Header("Location: /");
		    return;
		    break; // Выход
       	    # Страница ошибки
	    default:
	        include("pages/_404.php");
	        break;

	}

}else {

    include __DIR__ . '/account/_account_menu.php';
    @include __DIR__ . "/account/_user_account.php";

}



