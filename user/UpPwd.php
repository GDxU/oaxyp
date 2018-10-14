<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$aPwd = sha1($_POST['VIP_PWD_old']);
	$bPwd = sha1($_POST['VIP_PWD']);
	$cPwd = $_POST['VIP_PWD1'];
	$db = new DB();
	$sql = "SELECT `g_name` FROM `g_user` WHERE `g_password` = '{$aPwd}' and `g_name` = '{$user[0]['g_name']}' LIMIT 1 ";
	if (!$db->query($sql, 0)) exit(alert_href("原密碼輸入錯誤，請重新輸入！", "uppwd.php"));
	$sql = "UPDATE `g_user` SET `g_password` = '{$bPwd}' , g_pwd=0  WHERE `g_name` = '{$user[0]['g_name']}' ";
	if ($db->query($sql, 2))
	{
		alert_href("密碼更變成功，請從新登陸!!!", "Quit.php");
		exit;
	}
}
markPos("前台-修改密码");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/left.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src=".js/sc.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="./js/Pwd_Safety.js"></script>
<style type="text/css">
.t_list {margin:0px 14px;}
</style>
<title>Welcone!!</title>
<script type="text/javascript">
function SubChk(){
    if(document.all.VIP_PWD_old.value.length == ""){
	    alert("請輸入原密碼！");
	    document.all.VIP_PWD_old.focus();
	    return false;
    }
    if(document.all.VIP_PWD.value.length < 8 || document.all.VIP_PWD.value.length > 20){
	    alert("新密碼 請填寫 8 位或以上（最長20位）！");
	    document.all.VIP_PWD.focus();
	    return false;
    }
    if(document.all.VIP_PWD.value != document.all.VIP_PWD1.value){
	    alert("新密碼 和 新密碼確認 不一樣！(確認大小寫是否相同)");
	    document.all.VIP_PWD.focus();
	    return false;
    }
    if(document.all.VIP_PWD.value == document.all.VIP_PWD_old.value){
	    alert("新密碼 不能使用 原密碼 請脩改");
	    document.all.VIP_PWD.focus();
	    return false;
    }
    if(Pwd_Safety(document.all.VIP_PWD.value)!=true) return false;
}
</script>
<script type="text/javascript">
$(function(){
	$(".t_list input").focus(function(){$(this).addClass("inp1m").removeClass("inp1");});
	$(".t_list input").blur(function(){$(this).addClass("inp1").removeClass("inp1m");});
});

</script>
</head>
<body onselectstart="return false">
<form action="" method="post" onsubmit="return SubChk()">
<table border="0" cellpadding="0" cellspacing="1" class="t_list t_result" width="700" style="margin-top:9px;top:1px;">
        <tr>
            <td class="t_list_caption" colspan="2">變更密碼</td>
        </tr>
        <tr style="height:28px">
            <td style="text-align:right" class="t_td_caption_1" width="28%">原密碼&nbsp;</td>
            <td class="t_td_text" width="530"><input class='inp1' type="password" name="VIP_PWD_old" style="margin-left:3px;width:140px;"/></td>
        </tr>
        <tr style="height:28px">
            <td style="text-align:right" class="t_td_caption_1" width="28%">新密碼&nbsp;</td>
            <td class="t_td_text" width="530"><input class='inp1' type="password" name="VIP_PWD" style="margin-left:3px;width:140px;" /></td>
        </tr>
        <tr style="height:28px">
            <td  style="text-align:right" class="t_td_caption_1" width="28%">確認密碼&nbsp;</td>
            <td class="t_td_text" width="530"><input class='inp1' type="password" style="margin-left:3px;width:140px;" name="VIP_PWD1" /></td>
        </tr>
</table>
        <br>
        <table border="0" cellpadding="0" cellspacing="1" width="700" height="15px">
			<tr>
                <td colspan="2" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input style="color:#004400" type="submit" value="確定脩改" class="inputa_2" /></td>
            </tr>				
        </table>
</form>
</body>
</html>