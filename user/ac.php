<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
$db=new DB();
$text = $db->query("SELECT g_text FROM g_news WHERE g_number_alert_show = 1 ORDER BY g_id DESC LIMIT 1 ", 0);
if ($text){
	$n = strip_tags($text[0][0]);
}
?>
<html><head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link type="text/css" rel="stylesheet" href="css/left.css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
</head>
<body onselectstart="return false">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tbody><tr>
    <td width="100%" background="/images/Down_B.jpg" style="line-height:26px;">
    <marquee whdth="100%" onMouseOut="this.start()" onMouseOver="this.stop()" scrolldelay="160" scrollamount="9" style="position: relative; top: 1px"><font style="color:#5d5d5d" id="Affiche"><?php echo trim($n); ?></font></marquee>
    </td>
  </tr>
</tbody></table>


</body></html>