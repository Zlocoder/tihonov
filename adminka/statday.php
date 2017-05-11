<?php
$tmptime=time();
$ip = $func->UserIP;

$db->Query("SELECT * FROM db_statday WHERE ip = '$ip' LIMIT 1");
if($db->NumRows() == 0) {
	$db->Query("INSERT INTO db_statday(ip, time) VALUES ('$ip','$tmptime') ");
}
else
{
	$db->Query("UPDATE db_statday SET time = '$tmptime' WHERE ip = '$ip' ");
}
$uid = $_SESSION["user_id"];
if(!empty($uid)) {
	$db->Query("SELECT * FROM db_statonline WHERE user= '$uid' LIMIT 1");
	if($db->NumRows() == 0) {
		$db->Query("INSERT INTO db_statonline(user, away) VALUES ('$uid','$tmptime') ");
	}
	else
	{
		$db->Query("UPDATE db_statonline SET away= '$tmptime' WHERE user = '$uid' ");
	}
}
$thisday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
$away = time() - 300;
$db->Query("DELETE FROM db_statday WHERE time < $thisday ");
$db->Query("DELETE FROM db_statonline WHERE away< $away ");
$db->Query("SELECT * FROM db_statday ");
$allstat=$db->NumRows();
$db->Query("SELECT * FROM db_statonline ");
$online=$db->NumRows();
?>