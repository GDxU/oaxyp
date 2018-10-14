<?php
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
include_once ROOT_PATH.'classed/AutoShipmentsc.php';
if ($user[0]['g_look'] == 2) 
	exit(back($UserOut));

if ($_SERVER["REQUEST_METHOD"] != "POST") 
	exit("PostError");
	
$gtypesid=$_POST['gtypes'];
if($gtypesid==3){
	$gtypes = '极速时时彩';
	global $user, $UserOut, $stratGamejxssc, $endGamejxssc;
	$dateTime = date('Y-m-d H:i:s');
	$a = date('Y-m-d ').'23:20:00';
	if ( strtotime($dateTime) < strtotime($stratGamejxssc) || strtotime($dateTime) > strtotime($endGamejxssc))
	{
		back('開盤時間為：'.$stratGamejxssc.'--'.$endGamejxssc);exit;
	}
	$ConfigModel =configModel("`g_web_lock`, `g_jxssc_game_lock`,`g_odds_ratio_cq_b1`,`g_odds_ratio_cq_b2`,`g_odds_ratio_cq_b3`,`g_odds_ratio_cq_c1`,`g_odds_ratio_cq_c2`,`g_odds_ratio_cq_c3`");

if ($ConfigModel['g_jxssc_game_lock'] !=1 || $ConfigModel['g_web_lock'] !=1)
	exit(alert_href('抱歉！盤口未開放。', '../left.php'));
}elseif($gtypesid==10){
	$gtypes = '新疆时时彩';
	global $user, $UserOut, $stratGamexjssc, $endGamexjssc;
	$dateTime = date('Y-m-d H:i:s');
	$a = date('Y-m-d ').'23:20:00';
	if ( strtotime($dateTime) < strtotime($stratGamexjssc) || strtotime($dateTime) > strtotime($endGamexjssc))
	{
		back('開盤時間為：'.$stratGamexjssc.'--'.$endGamexjssc);exit;
	}
	$ConfigModel =configModel("`g_web_lock`, `g_xjssc_game_lock`,`g_odds_ratio_cq_b1`,`g_odds_ratio_cq_b2`,`g_odds_ratio_cq_b3`,`g_odds_ratio_cq_c1`,`g_odds_ratio_cq_c2`,`g_odds_ratio_cq_c3`");

if ($ConfigModel['g_xjssc_game_lock'] !=1 || $ConfigModel['g_web_lock'] !=1)
	exit(alert_href('抱歉！盤口未開放。', '../left.php'));
}elseif($gtypesid==11){
	$gtypes = '天津时时彩';
	global $user, $UserOut, $stratGametjssc, $endGametjssc;
	$dateTime = date('Y-m-d H:i:s');
	$a = date('Y-m-d ').'23:20:00';
	if ( strtotime($dateTime) < strtotime($stratGametjssc) || strtotime($dateTime) > strtotime($endGametjssc))
	{
		back('開盤時間為：'.$stratGametjssc.'--'.$endGametjssc);exit;
	}
	$ConfigModel =configModel("`g_web_lock`, `g_tjssc_game_lock`,`g_odds_ratio_cq_b1`,`g_odds_ratio_cq_b2`,`g_odds_ratio_cq_b3`,`g_odds_ratio_cq_c1`,`g_odds_ratio_cq_c2`,`g_odds_ratio_cq_c3`");

if ($ConfigModel['g_tjssc_game_lock'] !=1 || $ConfigModel['g_web_lock'] !=1)
	exit(alert_href('抱歉！盤口未開放。', '../left.php'));
}
//=================================start================================
$action = $_POST['actions'];
if (!isset($_SESSION['guid_code']))
	exit(alert_href('系統繁忙中，請稍後5秒后在進行下注。', '../left.php'));

unset($_SESSION['guid_code']);
$ListArr = array();
$odds = 0; 					//賠率
$countBiShu = 0; 			//總筆數
$countZhuEr = 0; 			//總注額
$countKeYinEr = 0; 		//可贏額
$gMoney = 0;				//剩餘可用金額
$s_number = $_POST['s_number'];
$s_cq = explode('|', $_POST['s_cq'], -1);

for ($i=0; $i<count($s_cq); $i++)
{
	$s_cq[$i] = explode(',', $s_cq[$i]);
}

for ($i=0; $i<count($s_cq); $i++)
{
	if (!Matchs::isNumber($s_cq[$i][2]))
		exit(alert_href('抱歉！您的下注金額錯誤。', '../left.php'));
	isNumbercq($s_cq[$i][0], $s_number,$gtypesid);
	$countZhuEr += $s_cq[$i][2];
	$countBiShu ++;
}

$max = null;
for ($i=0; $i<count($s_cq); $i++)
{
	$c =t($s_cq[$i]);
	$result = GetUserXianErcq($c, $user[0]['g_name'],$gtypesid);
	$ccd=isBallType($s_cq[$i][0],$s_cq[$i][1]);
	$max = GetUser_s_ot($result, $user, $ccd[0],$ccd[1], $gtypesid);
	for ($k=0; $k<count($s_cq); $k++)
	{
	isUserMoney($s_cq[$k][2], $max,$countZhuEr);
	}
}

for ($i=0; $i<count($s_cq); $i++)
{
	$a = mb_substr($s_cq[$i][1], 1, mb_strlen($s_cq[$i][1]));
	$odds = GetOddscq($s_cq[$i][0], $a,$gtypesid);
	if ($s_cq[$i][0] == 'Ball_1' || $s_cq[$i][0] == 'Ball_2' || $s_cq[$i][0] == 'Ball_3' || $s_cq[$i][0] == 'Ball_4' || $s_cq[$i][0] == 'Ball_5')
	{
		if ($a != 'h11' &&$a != 'h12' &&$a != 'h13' &&$a != 'h14' && Copyright)
			$odds = setoddscq($a, $odds, $ConfigModel, $user, 0,$s_cq[$i][0], $gtypesid);
		else 
			$odds = setoddscq($a, $odds, $ConfigModel, $user, 1,0, $gtypesid);
	}
	else if ($s_cq[$i][0] == 'Ball_6')
	{
		$odds = setoddscq($a, $odds, $ConfigModel, $user, 1,$s_cq[$i][0], $gtypesid);
	}
	else if ($s_cq[$i][0] == 'Ball_7' || $s_cq[$i][0] == 'Ball_8' || $s_cq[$i][0] == 'Ball_9')
	{
		$odds = setoddscq($a, $odds, $ConfigModel, $user, 2,$s_cq[$i][0], $gtypesid);
	}
	$ListArr[$i]['g_s_nid'] = $user[0]['g_nid'];
	$ListArr[$i]['g_mumber_type'] = $user[0]['g_mumber_type'];
	$ListArr[$i]['g_nid'] = $user[0]['g_name'];
	$ListArr[$i]['g_date'] = date('Y-m-d H:i:s');
	$ListArr[$i]['g_type'] = $gtypes;
	$ListArr[$i]['g_qishu'] = $s_number;
	$s = isBallType($s_cq[$i][0], $s_cq[$i][1]);
	$ListArr[$i]['g_mingxi_1'] = $s[0];
	$ListArr[$i]['g_mingxi_1_str'] = null;
	$ListArr[$i]['g_mingxi_2'] = $s[1];
	$ListArr[$i]['g_mingxi_2_str'] = null;
	$ListArr[$i]['g_odds'] = $odds;
	$ListArr[$i]['g_jiner'] = $s_cq[$i][2];
	$c =t($s_cq[$i]);
	$result = GetUserXianErcq($c, $user[0]['g_name'], $gtypesid);
	$g_pan=$user[0]['g_panlu'];
		if($g_pan=="A"){
		$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu_a']; 		//會員退水
		}
		if($g_pan=="B"){
		$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu_b']; 		//會員退水
		}
		if($g_pan=="C"){
		$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu_c']; 		//會員退水
		}
	//$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu'];
	$DtnArray = SumRankDistribution ($user, $s_cq[$i][2], null, $c,$gtypesid);
	$ListArr[$i]['g_tueishui_1'] = $DtnArray['tueishui_1'];
	$ListArr[$i]['g_tueishui_2'] = $DtnArray['tueishui_2'];
	$ListArr[$i]['g_tueishui_3'] = $DtnArray['tueishui_3'];
	$ListArr[$i]['g_tueishui_4'] = $DtnArray['tueishui_4'];
	$ListArr[$i]['g_distribution'] = $DtnArray['distribution_1'];
	$ListArr[$i]['g_distribution_1'] = $DtnArray['distribution_2'];
	$ListArr[$i]['g_distribution_2'] = $DtnArray['distribution_3'];
	$ListArr[$i]['g_distribution_3'] = $DtnArray['distribution_4'];
	$ListArr[$i]['g_distribution_4'] =100- ($DtnArray['distribution_4']+$DtnArray['distribution_3']+$DtnArray['distribution_2']+$DtnArray['distribution_1']); 		//公司占成
	$gMoney = $max['KeYongEr'] - $countZhuEr;
	$ListArr[$i]['KeYongEr'] = $gMoney;
	$tuiShui = sumTuiSui ($ListArr[$i]);
	$_tuiShui = $ListArr[$i]['g_jiner'] * $tuiShui;
	$ListArr[$i]['KeYing'] = $ListArr[$i]['g_jiner'] * $ListArr[$i]['g_odds'] - $ListArr[$i]['g_jiner'] + $_tuiShui;
	$ListArr[$i]['id'] = postForms ($ListArr[$i]);
	if ($ListArr[$i]['id'] == null)
				exit(alert_href("抱歉！{$ListArr[$i]['g_mingxi_1']}『{$ListArr[$i]['g_mingxi_2']}』下註失敗", '../left.php'));
}
upUserKyYongEr ($gMoney, $ListArr[0]['g_nid']);
new AutoLet($s_number, $ListArr, 2);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="../css/left.css" rel="stylesheet" type="text/css">
<style type="text/css">
body {background-color:#FFEFE2}
</style>
</head>
<body>
<form id="dp" action="" method="post">
	                <table border="0" cellpadding="0" cellspacing="1" class="t_list" width="230">
                    <tr>
                        <td class="t_list_caption" colspan="2">下註結果反饋</td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">會員帳戶</td>
                        <td class="t_td_text" width="137"><?php echo $user[0]['g_name']?>（<?php echo $user[0]['g_panlu']?>盤）</td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1">可用金額</td>
                        <td class="t_td_text"><?php echo is_Number($gMoney)?></td>
                    </tr>
                    <tr>
                    	<td class="t_td_but" colspan="2" align="center">
                        	<input type="button" value="打印" onclick="window.print()" class="inputq" />
                            <input type="button" value="返回" onclick="location.href='../left.php'" class="inputq"  />
                        </td>
                    </tr>
                    <tr>
                    	<td class="t_td_text" colspan="2">
                        	<span class="captions"><?php echo $s_number?>期</span>
                        	 <?php 
                        	 	echo '<table border="0" cellpadding="0" cellspacing="1" width="100%" bgcolor="#FFFFF7">';
	                        	 for ($i=0; $i<count($ListArr); $i++)
	                        	 {
	                        	 	$nn = $ListArr[$i]['g_mingxi_1'] == '總和、龍虎和' ? $ListArr[$i]['g_mingxi_2'] : $ListArr[$i]['g_mingxi_1'].'『'.$ListArr[$i]['g_mingxi_2'].'』';
		                        	 echo '<tr><td>&nbsp;註單號：'.$ListArr[$i]['id'].'#</td></tr>
		                        			  <tr><td align="center"><font color="blue">'.$nn.'</font> @ <span style="font-weight:bold; color:red">'.$ListArr[$i]['g_odds'].'</span></td></tr>
		                        			  <tr><td>&nbsp;下註額：'.$ListArr[$i]['g_jiner'].'</td></tr>
		                        			  <tr><td class="f_bt">&nbsp;可贏額：'.$ListArr[$i]['KeYing'].'</td></tr>';
	                        	  }
	                        	  echo '</table>';
                        	 ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">下註筆數</td>
                        <td class="t_td_text" width="137" id="max4">&nbsp;<?php echo $countBiShu?>筆</td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">總計註額</td>
                        <td class="t_td_text" width="137" id="max5">&nbsp;￥<?php echo $countZhuEr?></td>
                    </tr>
                </table>
                </form>
</body>
</html>