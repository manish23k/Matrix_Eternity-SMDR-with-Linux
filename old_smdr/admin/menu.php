<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<div id="left2">

<script type="text/javascript">function DisplayAlertMsg(){	alert("We have used software for translation and regret any inaccuracies. In case of any confusion, please check corresponding English page. Thank You.");}function GetDocumentTotalWidth(){	if(window.innerWidth)	{		return (window.innerWidth);	}	else if(document.body.clientWidth)	{		return (document.body.clientWidth);	}	else if(document.documentElement.clientWidth)	{		return (document.documentElement.clientWidth);	}}function AdjustTopFrameWidth(){	var width = 0;	width += document.getElementById("MatrixLogoTdId").offsetWidth;	width += document.getElementById("BkgImgTdId1").offsetWidth;	width += document.getElementById("ProdLogoTdId").offsetWidth;	width += document.getElementById("MixBkgImgTdId").offsetWidth;	width += document.getElementById("BkgImgTdId2").offsetWidth;	width += document.getElementById("ProdTitleTblId").offsetWidth;	document.getElementById("topBarMiddleImage").width = GetDocumentTotalWidth() - width;}</script>
<style type="text/css">
<!--body {margin-left: 0px;margin-top: 0px;}-->.txtbox {	color:#CDCDCD;	font-size:12px;	font-family:Arial;	vertical-align: middle;	text-align:left;	}
</style>
<body style="width:100%; margin:0px">
<table width='100%' border='0' align='left' cellpadding='0' cellspacing='0'>
<tr><td colspan='2' align='left' valign='top'>
<table width='100%' border='0' align='left' cellpadding='0' cellspacing='0'>
<tr><td id='MatrixLogoTdId' width='153' height='53' align='left' valign='top'>
<IMG style="background-repeat:no-repeat;" src="headbar_01.jpg"></td>
<td id='BkgImgTdId1' width='40' align='left' valign='top' background='headbar_02.jpg'>&nbsp;</td>
<td id='ProdLogoTdId' width='120' height='53' align='left' valign='top'><IMG style="background-repeat:no-repeat;" src="headbar_03.png"></td>
<td id='topBarMiddleImage' width='422' height='53' align='left' valign='top' background='headbar_04.jpg'>&nbsp;</td>
<td id='MixBkgImgTdId' width='64' height='53' align='left' valign='top'><IMG style="background-repeat:no-repeat;" src="headbar_05.jpg"></td>
<td id='BkgImgTdId2' width='17' height='53' align='left' valign='top' background='headbar_06.jpg'></td>
<td height='53' align='left' valign='middle' background='headbar_06.jpg'>
<table id='ProdTitleTblId' width='220' border='0' cellspacing='0' cellpadding='0'>
<?php		
$username = $_SESSION['USERNAME'];
$con = mysqli_connect("localhost","cron","1234","smdr");
$sql= "SELECT * FROM smdr_users WHERE username LIKE '$username'";
//$y1 = mysqli_query("SELECT * FROM smdr_users WHERE username LIKE '$username'");
$y1= mysqli_query($con,$sql);
//$rj3 = mysqli_fetch_array($con,$y1);
while($row = mysqli_fetch_array( $y1,MYSQLI_ASSOC)){
//printe_r($row);
}
?>
<tr><td width="155"><em color="#99bbe8">| <?php echo $rj3['username'];?> |</em></td><td>
<td>&nbsp;</td>
<td width='29px'><span style="color:#FFFFFF;" class='txtbox'><img src='headbar_06.jpg'/></td>
<td width='29px'><em><a href="home.php"><img src="home.png" width='22px' height='22px' title='Home Page' border='0' ></a></em></td>
<td width='29px'><em><a href="logout.php"><img src="logoff.png" width='22px' height='22px' title='Logout' border='0'></a></em></td>
</tr></table></td></tr></table></td></tr></table>
<script type="text/javascript">AdjustTopFrameWidth();</script>
</body>


</div>
<div id="left">	
<table>

<div id="menu">

  <ul>
     <li><a href='search.php'>Outgoing Calls</a></li>
	 <li><a href='search2.php'>Incoming Calls</a></li>
	 <li><a href='search3.php'>Outgoing Calls(VoIP)</a></li>
	 <li><a href='search4.php'>Incoming Calls(VoIP)</a></li>
	 <li><a href='search5.php'>Internal Calls</a></li>
  <!--     <li><a href='accountcode.php'>Outgoing Calls with Account Codes by Month</a></li>--> 
     <!--<li><a href='user.php'>Users/Extensions</a></li>-->
	 <!--<li><a href='gldir.php'>Directory</a></li>-->
     <!--<li><a href='accountcodelist.php'>Account Code</a></li>-->
     <!--<li><a href='trunk.php'>Trunks</a></li>-->
	 <li><a href="settings.php">Settings</a></li>
     <li><a href='signout.php'>Log Out</a></li>

  </ul>
</div>
</table>

</div>
</head>
<html>
