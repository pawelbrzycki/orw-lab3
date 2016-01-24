<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<meta charset="UTF-8"/>
<title>Cron jobs</title>
</head>
</html>

<br><br><center>CRON - Kurs walut</center><br>
<?php
require ('simple_html_dom.php');

$url = file_get_html("https://internetowykantor.pl/kursy-walut/");

	$msg ="";

	foreach ($url->find("tr[data-currency-id=usd]") as $dane)
	{
		$dane = preg_replace('#<div class="peity_chart_container">(.*?)</div>#','', $dane);
		$dane = preg_replace('/<a\b[^>]*>(.*?)<\/a>/i','', $dane);
	}			
		$pom = strip_tags($dane);
		$pom = preg_replace('/\s+/',' ', $pom);
		$pom = substr($pom,1,-1);
		$tab = explode(' ',$pom);
		
		$msg.="<table width='40%' align='center' border='1'><tr align='center'>
		<td><b>Waluta</b></td>
		<td><b>Kupno</b></td>
		<td><b>Sprzedaż</b></td>
		<td><b>Średni kurs</b></td>
		</tr><tr>";
		
		$msg.= "<td coslpan= '2' align='center'>".$tab[0].' '.$tab[1]."</td>";
		for ($i=2;$i<count($tab);$i++){
			$msg.= "<td align='center'>".$tab[$i]."</td>";
		}
		$msg .= "</tr>";
		echo $msg;
	$naglowek  = 'MIME-Version: 1.0' . "\r\n";
	$naglowek .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$naglowek .= 'Do: KursWalut <me@pawelbrzycki.com>' . "\r\n";
	$tytul = "Kurs Euro z dnia: ".date("d M Y G:i");
	$adresat = "me@pawelbrzycki.com";
	
	mail($adresat,$tytul,$msg,$naglowek);
?>