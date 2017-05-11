<?PHP
######################################
# ������ Fruit Farm Edition WmRush
# ����� WmRush
# ICQ: 578598778
# Skype: molart111
######################################

function TimerSet(){
	list($seconds, $microSeconds) = explode(' ', microtime());
	return $seconds + (float) $microSeconds;
}

$_timer_a = TimerSet();

# ����� ������
@session_start();

# ����� ������
@ob_start();



# ��������� ��� Include
define("CONST_RUFUS", true);

# ������������� �������
function __autoload($name){ include("../classes/_class.".$name.".php");}

# ����� ������� 
$config = new config;

# �������
$func = new func;


# ���� ������
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);

$pref = $config->BasePrefix;
$admFolder = $config->FolderAdmin;


$_OPTIMIZATION["title"] = "���������������� ������";
$_OPTIMIZATION["description"] = "������� ������������";
$_OPTIMIZATION["keywords"] = "�������, ������ �������, ������������";
//$not_counters = true;



# �����
@include("inc/_header.php");
# ���������� ������
if(!isset($_SESSION["admin"])){ include("pages/_login.php"); return; }

if(isset($_GET["menu"])){
		
	$smenu = strval($_GET["menu"]);
			
	switch($smenu){
		
		
		case "404": include("pages/_404.php"); break; // �������� ������
		case "stats": include("pages/_stats.php"); break; // ����������
		case "config": include("pages/_config.php"); break; // ���������
		case "contacts": include("pages/_contacts.php"); break; // ��������
		case "rules": include("pages/_rules.php"); break; // �������
		case "about": include("pages/_about.php"); break; // � �����
		case "story_buy": include("pages/_story_buy.php"); break; // ������� ������� ��������
		case "story_swap": include("pages/_story_swap.php"); break; // ������� ������ � ���������
        case "compconfig": include("pages/_compconfig.php"); break; // ���������� ����������
		case "story_insert": include("pages/_story_insert.php"); break; // ������� ���������� �������
		case "story_sell": include("pages/_story_sell.php"); break; // ������� �����
		case "knb": include("pages/_knb.php"); break; // ������ ���
		case "news": include("pages/_news_a.php"); break; // �������
		case "users": include("pages/_users.php"); break; // ������ �������������
		case "sender": include("pages/_sender.php"); break; // �������� �������������	
		case "payments": include("pages/_payments.php"); break; // ������� �� ������� WM
		case "pay_systems": include("pages/_pay_systems.php"); break; // ������ ��������� ������
		case "viplat": include("pages/_viplat.php"); break; // �������
		case "tp": include("pages/tp.php"); break; // ������ 
		case "top": include("pages/_top.php"); break; // ���
        case "invcompconfig": include("pages/_invcompconfig.php"); break; // ���
        
        case "multi": include("pages/_multi.php"); break; // ������ ���
		
		
	# �������� ������
	default: @include("pages/_404.php"); break;
			
	}
			
}else @include("pages/_stats.php");

# ������
@include("inc/_footer.php");


# ������� ������� � ����������
$content = ob_get_contents();

# ������� �����
ob_end_clean();
	
	# �������� ������
	$content = str_replace("{!TITLE!}",$_OPTIMIZATION["title"],$content);
	$content = str_replace('{!DESCRIPTION!}',$_OPTIMIZATION["description"],$content);
	$content = str_replace('{!KEYWORDS!}',$_OPTIMIZATION["keywords"],$content);
	$content = str_replace('{!GEN_PAGE!}', sprintf("%.5f", (TimerSet() - $_timer_a)) ,$content);
	

	
// ������� �������
echo $content;

?>