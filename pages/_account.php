<?PHP
$_OPTIMIZATION["title"] = "�������";
$_OPTIMIZATION["description"] = "������� ������������";
$_OPTIMIZATION["keywords"] = "�������, ������ �������, ������������";

# ���������� ������
if(!isset($_SESSION["user_id"])){ Header("Location: /"); return; }

if($_GET["sel"]){


	$smenu = strval($_GET["sel"]);
			include __DIR__ . '/account/_account_menu.php';

	switch($smenu){

		case "404":
		    include("pages/_404.php");
		    break; // �������� ������
		case "referals":
		    include("pages/account/_referals.php");
		    break; // ��������
		case "farm":
		    include("pages/account/_farm.php");
		    break; // ��� �����
		case "store":
		    include("pages/account/_store.php");
		    break; // �����
		case "swap":
		    include("pages/account/_swap.php");
		    break; // �������� �����
        case "swap2":
            include("pages/account/_nums.php");
            break; // �������� �����

		case "donations":
		    include("pages/account/_donations.php");
		    break; // �������������
		case "payment":
		    include("pages/account/_payment.php");
		    break; // ������� ����
		case "insertpayeer":
		    include("pages/account/_insertpayeer.php");
		    break; // ���������� �������

		case "config":
		    include("pages/account/_config.php");
		    break; // ���������
		case "bonus":
		    include("pages/account/_bonus.php");
		    break; // ���������� �����
		case "baners":
		    include("pages/account/_baners.php");
		    break; // ������

		case "serfing":
		    include("pages/account/_serfing.php");
		    break; // �������
      	case "bonus_lider":
      	    include("pages/account/_bonus_lider.php");
      	    break; // ����� �����
        case "items":
            include("pages/account/_items.php");
            break; // ��� �����
		case "exit":
		    @session_destroy(); Header("Location: /");
		    return;
		    break; // �����
       	    # �������� ������
	    default:
	        include("pages/_404.php");
	        break;

	}

}else {

    include __DIR__ . '/account/_account_menu.php';
    @include __DIR__ . "/account/_user_account.php";

}



