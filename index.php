<?php
$submit=array("Submit input"=>"Tänd och Släck nu!");
$changed=False;
$status="";
$info=0;

if (array_key_exists("info",$_REQUEST) && $_REQUEST["info"]==1)
	$info=1;

$status="";
$switches=array();
$args="";
$act=(split(":",$_REQUEST["event"]));

if ($args[1]=='toggle') {
	$switches=getstate();
}

$args=" --".$act[1]." \"".$act[0]."\"";
$status.=" $args";
if (strlen($args)>0) {
	$fp=popen("sudo /usr/bin/tdtool $args","r");
	$data=fread($fp,2048);
	$status.=" tdtool: $data";
	fclose($fp);
} 

function getstate() {
	$sws = array();
	$sw=array();

	$fp=popen("sudo /usr/bin/tdtool --list","r");
	$data = fread($fp, 2048);
	$lines=split("\n",$data);
	array_shift($lines);
	foreach ($lines as $line) {
		$sw=split("\t",$line);
		if (sizeof($sw) == 3) {
			$sws[]=$sw;
		}
	}
	fclose($fp);
	unset($sw);
	return $sws;
}

if ($args[1]!='toggle') {
	$switches=getstate();
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="index,follow" name="robots" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />
<link href="pics/lampkontroll.png" rel="apple-touch-icon" />
<link href="css/style.css" rel="stylesheet" media="screen" type="text/css" />
<script src="javascript/functions.js" type="text/javascript"></script>
<title>LampKontroll</title>
</head>

<body>

<div id="topbar" class="black">
	<div id="title">LampKontroll</div>
	<?if ($info==1) {?>
	<div id="rightbutton"><a href="?info=0">info</a></div>
	<?} else {?>
	<div id="rightbutton"><a href="?info=1">info</a></div>
	<?}?>
</div>
<div id="content">
	<form method="get" action="?<?=time()?>&info=<?=$info?>">
		<input type="hidden" name="event" value="" />

		<fieldset>
		<span class="graytitle">Strömbrytare</span>
                <ul class="pageitem">
			<?
			foreach ($switches as $sw) {
				?>
				<? if ($sw[2]=="ON") { ?> 	
					<li class="checkbox"><span class="name"><?=$sw[1]?></span>
					<input name="<?=$sw[1]?>" type="checkbox" checked onChange='this.form.event.value="<?=$sw[1]?>:off";submit();'> </li>
				<? } else { ?>
					<li class="checkbox"><span class="name"><?=$sw[1]?></span>
					<input name="<?=$sw[1]?>" type="checkbox" onChange='this.form.event.value="<?=$sw[1]?>:on";submit();'> </li>
				<? } ?>
				<?
			}
			?>
                </ul>
		</fieldset>
	</form>
	<? if ($info==1) { ?>
		<ul class="pageitem">
			<li class="textbox"><span class="header">Info</span>
			Flippa på eller av lampor med strömbrytarna. Det händer att signalen inte går fram. Då får man försöka igen.</li>
		</ul>
		<? if ($status!="") { ?>
		<ul class="pageitem">
			<li class="textbox"><span class="header">Logg</span>
			<?=strftime("%H:%M:%S",time()).$status?>
		</ul>
		<? } ?>
	<? } ?>
</div>
<div id="footer">
	<a href="http://www.sys.nu/doku.php?id=coding:php:lampkontroll">LampKontroll v0.2</a><br/>
	<a href="http://iwebkit.net">Powered by iWebKit</a>
</div>
</body>

</html>
