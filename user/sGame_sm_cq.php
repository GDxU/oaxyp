﻿<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'user/offGamecq.php';
/* include_once ROOT_PATH.'functioned/cheCookie.php';
if ($user[0]['g_look'] == 2) exit(href('repore.php')); */
$ConfigModel = configModel("`g_cq_game_lock`, `g_mix_money`");
if ($ConfigModel['g_cq_game_lock'] !=1)exit(href('right.php'));
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$getResult = 'class="nv_a" '.$onclick;

//获取当前盘口
$name = base64_decode($_COOKIE['g_user']);
$db=new DB();
$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
$result = $db->query($sql, 1);
$pan = explode (',', $result[0]['g_panlus']); 
$_SESSION['gx'] = false;
$_SESSION['gd'] = false;
$_SESSION['cq'] = true;
$_SESSION['pk'] = false;
$_SESSION['sz'] = false;
$_SESSION['kl8'] = false;
$_SESSION['k5'] = false;
$_SESSION['mg'] = false;
$g = $_GET['g'];
$abc = empty($_GET['abc'])?'':$_GET['abc'];
if($abc==null) {
	$abc=$result[0]['g_panlu'];
}else{
$sql = "update g_user set g_panlu='$abc' where g_name='$name'";
$result1 = $db->query($sql, 2);
}

markPos("前台-重庆下注-双面");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/sGame.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="./js/plxz.js"></script>
<script type="text/javascript" src="./js/odds_sm_cq.js?<?=time()?>"></script>
<title></title>
<script type="text/javascript">
var s = window.parent.frames.leftFrame.location.href.split('/');
		s = s[s.length-1];
		if (s !== "left.php")
			window.parent.frames.leftFrame.location.href = "/user/left.php";
			
				function soundset(sod){
if(sod.value=="on"){
sod.src="images/soundoff.png";
sod.value="off";
}
else{
sod.src="images/soundon.png";
sod.value="on";
}
SetCookie("soundbut",sod.value);
}
</script>
<style type="text/css">
div#row1 { float: left;}
div#row2 {}
</style>
</head>
<body style="margin-left: 3px;margin-top:-3px;" onselectstart="return false">
<table class="th" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td width="105" height="20" class="bolds">重庆时时彩</td>
        <td colspan="2" class="bolds" style="color:red">
                     <td colspan="2" class="bolds" style="color:red"> <div  id="row1" style="position: relative;  FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;">
<span>今天輸贏：</span>&nbsp;</div><div><span id="sy"  class="shuyingjieguo2" top:-2px">0.0</span></div></td>
        <td align="right">&nbsp;</td>
  <td class="bolds" width="146">
        	<span id="number" style="position:relative; "></span>期开奖</td>
        <td width="27" class="l" id="a"></td>
        <td width="27" class="l" id="b"></td>
        <td width="27" class="l" id="c"></td>
        <td width="27" class="l" id="d"></td>
        <td width="27" class="l" id="e"></td>
    </tr>
</table>
<table class="th" border="0" cellpadding="0" cellspacing="0" style="margin-top:-3px;">
    <tr>
    	<td height="30" width="123px" ><span id="o" class="oqiqi"></span>期</td>
        <td width="60"><span style="color:#0033FF; font-weight:bold" id="tys">整合盤</span></td>
       <td width="90px">
       <form id="form1" name="form1" method="post" action="">
            <label><span style="color:#0033FF; font-weight:bold" id="tys">
			<script>
			function changepan(sel){
			window.parent.frames.mainFrame.location.href = "sGame_sm_cq.php?g=<?php echo $g?>&abc="+sel.value;
			}
			
			</script>
           </label>
      </form></td>
        <td width="180px">距离封盘：<span style="font-size:104%" id="endTime">加载中...</span></td>
        <td colspan="4">距离开奖：<span style="color:red;font-size:104%" id="endTimes">加载中...</span></td>
        <td colspan="1" align="right"><span id="endTimea"></span>秒</td>
    </tr>
</table>
<!--table border="0" width="700">
	<tr height="30">
	    	<td align="center" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    	<input onclick="Shortcut_SH(false);" id="Shortcut_Switch" name="Shortcut_Switch" value="" type="checkbox"/>
	    	<a class="font_g F_bold" onfocus="this.blur()" title="快捷下註" onclick="Shortcut_SH(true);" href="javascript:void(0)" style="color:#299a26;text-decoration:none; font-weight:bold;">快捷下注</a>
	    	<span id="Shortcut_DIV" class="font_g"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="Shortcut_hidden();reset();" class="inputs ti" value="重&nbsp;填" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" id="submits" class="inputs ti" style="font-weight: bold;" value="下&nbsp;註" /><input type="text" id="submitss"  value="" style="width:0px;height:0px;border:0px;"/></td>
	        <td width="0" class="actiionn"></td>
    </tr>
</table>-->

<form id="dp" action="./inc/DataProcessingcqsm.php" method="post" target="leftFrame" onsubmit = "return submitforms()" style="margin-bottom: 50px; float: left;">
<table border="0" width="700">
	<tr height="30">
	    	<td align="center" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    	<input onclick="Shortcut_SH(false);" id="Shortcut_Switch" name="Shortcut_Switch" value="" type="checkbox"/>
	    	<a class="font_g F_bold" onfocus="this.blur()" title="快捷下註" onclick="Shortcut_SH(true);" href="javascript:void(0)" style="color:#299a26;text-decoration:none; font-weight:bold;">快捷下注</a>
	    	<span id="Shortcut_DIV" class="font_g"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="Shortcut_hidden();reset();" class="inputs ti" value="重&nbsp;填" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" id="submits" class="inputs ti" style="font-weight: bold;" value="下&nbsp;註" /><input type="text" id="submitss"  value="" style="width:0px;height:0px;border:0px;"/></td>
	        <td width="0" class="actiionn"></td>
    </tr>
</table>

<div style="margin-bottom: 50px; float: left;">
<input type="hidden" name="actions" value="fn3" />
<input type="hidden" name="gtypes" value="1" />
<input type="hidden" id="mix" value="<?php echo $ConfigModel['g_mix_money']?>" />
<table class="wq" border="0" cellpadding="0" cellspacing="1" style="margin-top:-3px;">
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="3">第一球</td>
		<td colspan="3">第二球</td>
		<td colspan="3">第三球</td>
		<td colspan="3">第四球</td>
		<td colspan="3">第五球</td>
    </tr>
	
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="1">
 <tr class="t_list_caption" style="color:#000">
    	<td>號</td>
    	<td>赔率</td>
    	<td>金额</td>
		<td>號</td>
    	<td>赔率</td>
    	<td>金额</td>
		<td>號</td>
    	<td>赔率</td>
    	<td>金额</td>
		<td>號</td>
    	<td>赔率</td>
    	<td>金额</td>
		<td>號</td>
    	<td>赔率</td>
    	<td>金额</td>
    </tr>
 <tr class="t_td_text">
    	<td width="8%" class="caption_1">大</td>
    	<td class="o" width="8%" id="ah11"></td>
    	<td class="loads"></td>
		<td width="8%" class="caption_1">大</td>
    	<td class="o" width="8%" id="bh11"></td>
    	<td class="loads"></td>
		<td width="8%" class="caption_1">大</td>
    	<td class="o" width="8%" id="ch11"></td>
    	<td class="loads"></td>
		<td width="8%" class="caption_1">大</td>
    	<td class="o" width="8%" id="dh11"></td>
    	<td class="loads"></td>
		<td width="8%" class="caption_1">大</td>
    	<td class="o" width="8%" id="eh11"></td>
    	<td class="loads"></td>
 </tr>
 <tr class="t_td_text">
    	<td width="8%" class="caption_1">小</td>
    	<td class="o" width="8%" id="ah12"></td>
    	<td class="loads"></td>
		<td width="8%" class="caption_1">小</td>
    	<td class="o" width="8%" id="bh12"></td>
    	<td class="loads"></td>
		<td width="8%" class="caption_1">小</td>
    	<td class="o" width="8%" id="ch12"></td>
    	<td class="loads"></td>
		<td width="8%" class="caption_1">小</td>
    	<td class="o" width="8%" id="dh12"></td>
    	<td class="loads"></td>
		<td width="8%" class="caption_1">小</td>
    	<td class="o" width="8%" id="eh12"></td>
    	<td class="loads"></td>
 </tr>
 <tr class="t_td_text">
    	<td width="8%" class="caption_1">单</td>
    	<td class="o" width="8%" id="ah13"></td>
    	<td class="loads"></td>
		<td width="8%" class="caption_1">单</td>
    	<td class="o" width="8%" id="bh13"></td>
    	<td class="loads"></td>
		<td width="8%" class="caption_1">单</td>
    	<td class="o" width="8%" id="ch13"></td>
    	<td class="loads"></td>
		<td width="8%" class="caption_1">单</td>
    	<td class="o" width="8%" id="dh13"></td>
    	<td class="loads"></td>
		<td width="8%" class="caption_1">单</td>
    	<td class="o" width="8%" id="eh13"></td>
    	<td class="loads"></td>
 </tr>
 <tr class="t_td_text">
    	<td width="8%" class="caption_1">双</td>
    	<td class="o" width="8%" id="ah14"></td>
    	<td class="loads"></td>
		<td width="8%" class="caption_1">双</td>
    	<td class="o" width="8%" id="bh14"></td>
    	<td class="loads"></td>
		<td width="8%" class="caption_1">双</td>
    	<td class="o" width="8%" id="ch14"></td>
    	<td class="loads"></td>
		<td width="8%" class="caption_1">双</td>
    	<td class="o" width="8%" id="dh14"></td>
    	<td class="loads"></td>
		<td width="8%" class="caption_1">双</td>
    	<td class="o" width="8%" id="eh14"></td>
    	<td class="loads"></td>
 </tr>


<tr class="t_td_text">
    	<td  class="No_cq0">
    	<td class="o" width="45" id="ah1"></td>
    	<td class="loads"></td>
		<td  class="No_cq0">
    	<td class="o" width="45" id="bh1"></td>
    	<td class="loads"></td>
		<td  class="No_cq0">
    	<td class="o" width="45" id="ch1"></td>
    	<td class="loads"></td>
		<td  class="No_cq0">
    	<td class="o" width="45" id="dh1"></td>
    	<td class="loads"></td>
		<td  class="No_cq0">
		<td class="o" width="45" id="eh1"></td>
    	<td class="loads"></td>
   	</tr>
    <tr class="t_td_text">
    	<td  class="No_cq1">
    	<td class="o" width="45" id="ah2"></td>
    	<td class="loads"></td>
		<td  class="No_cq1">
    	<td class="o" width="45" id="bh2"></td>
    	<td class="loads"></td>
		<td  class="No_cq1">
    	<td class="o" width="45" id="ch2"></td>
    	<td class="loads"></td>
		<td  class="No_cq1">
    	<td class="o" width="45" id="dh2"></td>
    	<td class="loads"></td>
		<td  class="No_cq1">
		<td class="o" width="45" id="eh2"></td>
    	<td class="loads"></td>
   	</tr>
    <tr class="t_td_text">
    	<td  class="No_cq2"></td>
    	<td class="o" width="45" id="ah3"></td>
    	<td class="loads"></td>
    	<td  class="No_cq2"></td>
		<td class="o" width="45" id="bh3"></td>
    	<td class="loads"></td>   	
		<td  class="No_cq2"></td>
		<td class="o" width="45" id="ch3"></td>
    	<td class="loads"></td>
    	<td  class="No_cq2"></td>
		<td class="o" width="45" id="dh3"></td>
    	<td class="loads"></td>
		<td  class="No_cq2"></td>
		<td class="o" width="45" id="eh3"></td>
    	<td class="loads"></td>
   	</tr>
    <tr class="t_td_text">
    	<td class="No_cq3"></td>
    	<td class="o" width="45" id="ah4"></td>
    	<td class="loads"></td>
    	<td class="No_cq3"></td><td class="o" width="45" id="bh4"></td>
    	<td class="loads"></td>
    	<td class="No_cq3"></td><td class="o" width="45" id="ch4"></td>
    	<td class="loads"></td>
    	<td class="No_cq3"></td><td class="o" width="45" id="dh4"></td>
    	<td class="loads"></td>
		<td class="No_cq3"></td><td class="o" width="45" id="eh4"></td>
    	<td class="loads"></td>
   	</tr>
    <tr class="t_td_text">
    	<td class="No_cq4"></td>
    	<td class="o" width="45" id="ah5"></td>
    	<td class="loads"></td>
    	<td class="No_cq4"></td><td class="o" width="45" id="bh5"></td>
    	<td class="loads"></td>
    	<td class="No_cq4"></td><td class="o" width="45" id="ch5"></td>
    	<td class="loads"></td>
    	<td class="No_cq4"></td><td class="o" width="45" id="dh5"></td>
    	<td class="loads"></td>
		<td class="No_cq4"></td><td class="o" width="45" id="eh5"></td>
    	<td class="loads"></td>
   	</tr>
    <tr class="t_td_text">
    	<td  class="No_cq5"></td>
    	<td class="o" width="45" id="ah6"></td>
    	<td class="loads"></td>
    	<td  class="No_cq5"></td><td class="o" width="45" id="bh6"></td>
    	<td class="loads"></td>
    	<td  class="No_cq5"></td><td class="o" width="45" id="ch6"></td>
    	<td class="loads"></td>
    	<td  class="No_cq5"></td><td class="o" width="45" id="dh6"></td>
    	<td class="loads"></td>
		<td  class="No_cq5"></td><td class="o" width="45" id="eh6"></td>
    	<td class="loads"></td>
   	</tr>
    <tr class="t_td_text">
    	<td class="No_cq6"></td>
    	<td class="o" width="45" id="ah7"></td>
    	<td class="loads"></td>
    	<td class="No_cq6"></td><td class="o" width="45" id="bh7"></td>
    	<td class="loads"></td>
    	<td class="No_cq6"></td><td class="o" width="45" id="ch7"></td>
    	<td class="loads"></td>
    	<td class="No_cq6"></td><td class="o" width="45" id="dh7"></td>
    	<td class="loads"></td>
		<td class="No_cq6"></td><td class="o" width="45" id="eh7"></td>
    	<td class="loads"></td>
   	</tr>
    <tr class="t_td_text">
    	<td class="No_cq7"></td>
    	<td class="o" width="45" id="ah8"></td>
    	<td class="loads"></td>
    	<td class="No_cq7"></td><td class="o" width="45" id="bh8"></td>
    	<td class="loads"></td>
    	<td class="No_cq7"></td><td class="o" width="45" id="ch8"></td>
    	<td class="loads"></td>
    	<td class="No_cq7"></td><td class="o" width="45" id="dh8"></td>
    	<td class="loads"></td>
		<td class="No_cq7"></td><td class="o" width="45" id="eh8"></td>
    	<td class="loads"></td>
   	</tr>
    <tr class="t_td_text">
    	<td  class="No_cq8"></td>
    	<td class="o" width="45" id="ah9"></td>
    	<td class="loads"></td>
    	<td  class="No_cq8"></td><td class="o" width="45" id="bh9"></td>
    	<td class="loads"></td>
    	<td  class="No_cq8"></td><td class="o" width="45" id="ch9"></td>
    	<td class="loads"></td>
    	<td  class="No_cq8"></td><td class="o" width="45" id="dh9"></td>
    	<td class="loads"></td>
		<td  class="No_cq8"></td><td class="o" width="45" id="eh9"></td>
    	<td class="loads"></td>
   	</tr>
	 <tr class="t_td_text">
    	<td  class="No_cq9"></td>
    	<td class="o" width="45" id="ah10"></td>
    	<td class="loads"></td>
    	<td  class="No_cq9"></td><td class="o" width="45" id="bh10"></td>
    	<td class="loads"></td>
    	<td  class="No_cq9"></td><td class="o" width="45" id="ch10"></td>
    	<td class="loads"></td>
    	<td  class="No_cq9"></td><td class="o" width="45" id="dh10"></td>
    	<td class="loads"></td>
		<td  class="No_cq9"></td><td class="o" width="45" id="eh10"></td>
    	<td class="loads"></td>
   	</tr>
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="1">
	<tr class="t_list_caption">
	<td colspan="15">前三</td>
	</tr>
    <tr class="t_td_text">
    	<td class="caption_1 ch1" width="5%">豹子</td>
    	<td class="o" width="6%" id="gh1"></td>
    	<td class="loads"></td>
    	<td  class="caption_1 ch2" width="5%">顺子</td>
    	<td class="o" width="6%" id="gh2"></td>
    	<td class="loads"></td>
    	<td  class="caption_1 ch3" width="5%">对子</td>
    	<td class="o" width="6%" id="gh3"></td>
    	<td class="loads"></td>
    	<td  class="caption_1 ch4" width="5%">半顺</td>
    	<td class="o" width="6%" id="gh4"></td>
    	<td class="loads"></td>
    	<td  class="caption_1 ch5" width="5%">杂六</td>
    	<td class="o" width="6%" id="gh5"></td>
    	<td class="loads"></td>
    </tr>
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="1">
	<tr class="t_list_caption">
	<td colspan="15">中三</td>
	</tr>
    <tr class="t_td_text">
    	<td  class="caption_1 dh1" width="5%">豹子</td>
    	<td class="o" width="6%" id="hh1"></td>
    	<td class="loads"></td>
    	<td  class="caption_1 dh2" width="5%">顺子</td>
    	<td class="o" width="6%" id="hh2"></td>
    	<td class="loads"></td>
    	<td  class="caption_1 dh3" width="5%">对子</td>
    	<td class="o" width="6%" id="hh3"></td>
    	<td class="loads" ></td>
    	<td  class="caption_1 dh4" width="5%">半顺</td>
    	<td class="o" width="6%" id="hh4"></td>
    	<td class="loads"></td>
    	<td  class="caption_1 dh5" width="5%">杂六</td>
    	<td class="o" width="6%" id="hh5"></td>
    	<td class="loads"></td>
    </tr>
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="1">
	<tr class="t_list_caption">
	<td colspan="15">后三</td>
	</tr>
    <tr class="t_td_text">
    	<td  class="caption_1 eh1" width="5%">豹子</td>
    	<td class="o" width="6%" id="ih1"></td>
    	<td class="loads"></td>
    	<td  class="caption_1 eh2" width="5%">顺子</td>
    	<td class="o" width="6%" id="ih2"></td>
    	<td class="loads"></td>
    	<td  class="caption_1 eh3" width="5%">对子</td>
    	<td class="o" width="6%" id="ih3"></td>
    	<td class="loads"></td>
    	<td  class="caption_1 eh4" width="5%">半顺</td>
    	<td class="o" width="6%" id="ih4"></td>
    	<td class="loads"></td>
    	<td  class="caption_1 eh5" width="5%">杂六</td>
    	<td class="o" width="6%" id="ih5"></td>
    	<td class="loads"></td>
    </tr>
</table>

<table class="wq" border="0" cellpadding="0" cellspacing="1">
	<tr class="t_list_caption">
	<td colspan="15">总和</td>
	</tr>
    <tr class="t_td_text">
    	<td  class="caption_1 dh1" width="100px">总和大</td>
    	<td class="o" width="100px" id="fh1"></td>
    	<td class="loads"></td>
    	<td  class="caption_1 dh1" width="100px">总和小</td>
    	<td class="o" width="100px" id="fh2"></td>
		<td class="loads" width="100px"></td>
	</tr>
	<tr class="t_td_text">
		<td  class="caption_1 dh1" width="100px">总和单</td>
    	<td class="o" width="100px" id="fh3"></td>
    	<td class="loads" width="100px"></td>
    	<td  class="caption_1 dh1" width="100px">总和双</td>
    	<td class="o" width="100px" id="fh4"></td>
    	<td class="loads" width="100px"></td>
	</tr>
</table>

<table class="wq" border="0" cellpadding="0" cellspacing="1">
	<tr class="t_list_caption">
	<td colspan="15">龍虎</td>
	</tr>
	<tr class="t_td_text">
    	<td  class="caption_1 dh1" width="100px">龍</td>
    	<td class="o" width="100px" id="fh5"></td>
    	<td class="loads" width="100px"></td>
    	<td  class="caption_1 dh1" width="100px">虎</td>
    	<td class="o" width="100px" id="fh6"></td>
    	<td class="loads" width="100px"></td>
    	<td  class="caption_1 dh1" width="100px">和</td>
    	<td class="o" width="100px" id="fh7"></td>
    	<td class="loads" width="100px"></td>
	</tr>
</table>

<table border="0" width="610" style="margin-top:8px;">
	
		<tr height="30">
	    	<td align="center" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    	
	    	<a class="font_g F_bold" onfocus="this.blur()" title="快捷下注" onclick="Shortcut_SH(true);" href="javascript:void(0)" style="color:#299a26;text-decoration:none; font-weight:bold;">快捷下注</a>
	    	<span id="Shortcut_DIV" class="font_g"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="Shortcut_hidden();reset();" class="inputs ti" value="重&nbsp;填" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" id="submits" class="inputs ti" value="下&nbsp;注" /><input type="text" id="submitss"  value="" style="width:0px;height:0px;border:0px;"/></td>
	        <td width="0" class="actiionn"></td>
    </tr>
</table>
</form>

<input type="hidden" id="mix" value="<?php echo $ConfigModel['g_mix_money']?>" />
<div id="look" ></div>
<?php include_once 'inc/cl_file.php';?>
<?php 
$db = new DB();
$text =$db->query("SELECT g_text FROM g_set_user_news WHERE g_name = '{$user[0]['g_name']}' LIMIT 1", 0);
if ($text){
	alert($text[0][0]);
}
?>
</body>
</html>