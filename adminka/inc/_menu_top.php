<ul class="hd-menu">
    <li><a href="/" <?=(!isset($_GET["menu"]) OR strtolower($_GET["menu"]) == "index") ? 'class="current"' : False; ?>>�������</a></li>
    <li><a href="/news" <?=(isset($_GET["menu"]) AND strtolower($_GET["menu"]) == "news") ? 'class="current"' : False; ?>>�������</a></li>
    <li><a href="/rules" <?=(isset($_GET["menu"]) AND strtolower($_GET["menu"]) == "rules") ? 'class="current"' : False; ?>>�������</a></li>
    <li><a href="/about" <?=(isset($_GET["menu"]) AND strtolower($_GET["menu"]) == "about") ? 'class="current"' : False; ?>>� �������</a></li>
	<li><a href="/contacts" <?=(isset($_GET["menu"]) AND strtolower($_GET["menu"]) == "contacts") ? 'class="current"' : False; ?>>��������</a></li>
	
</ul> 