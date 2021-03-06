<?php
include_once('./LabCharts/LabChartsBar.php');
include_once('./LabCharts/LabChartsPie.php');

class Analiza {

private $user = "4derwecka";
private $pass = "pass";
private $host = "pascal.fis.agh.edu.pl";
private $base = "4derwecka";
private $coll;
private $conn;
private $dbase;
private $collection;

function __construct () {
	$this->coll = $_SESSION['user'];
	$this->conn = new Mongo("mongodb://{$this->user}:{$this->pass}@{$this->host}/{$this->base}");
	$this->dbase = $this->conn->selectDB($this->base);
	$this->collection = $this->dbase->selectCollection($this->coll);  
}
function analiza() {
	$iloscGodzin;
	$uFacebook = 0;
	$uInstagram = 0;
	$uTwitter = 0;
	$uAsk = 0;
	$uNone = 0;
      	$cursor = $this->collection->find();
	$srednia = 0;
	$female = 0;
	$male = 0;
	$other = 0;
      	foreach ( $cursor as $obj ) {
		$numerAnkiety = $obj['numerAnkiety'];
		$date = $obj['date'];
      		$gender = $obj['gender'];
		$wiek = $obj['wiek'];
		$godziny = $obj['godziny'];
		$facebook = $obj['facebook'];
		$instagram = $obj['instagram'];
		$twitter = $obj['twitter'];
		$ask = $obj['ask'];
		$none = $obj['none'];
		$iloscGodzin[] = $godziny; 
		if($facebook=="tak"){
			$uFacebook = $uFacebook + 1;			
		}
		if($instagram=="tak"){
			$uInstagram = $uInstagram + 1;			
		}
		if($twitter=="tak"){
			$uTwitter = $uTwitter + 1;			
		}
		if($ask=="tak"){
			$uAsk = $uAsk + 1;			
		}
		if($none=="tak"){
			$uNone = $uNone + 1;			
		}
		if($gender=="female"){
			$female = $female + $godziny;		
		}
		if($gender=="male"){
			$male = $male + $godziny;		
		}
		if($gender=="other"){
			$other = $other + $godziny;		
		}
     	}
	$length = count($iloscGodzin);
	$suma = 0;
	for($i = 0; $i<$length; $i++){
		$suma = $suma + $iloscGodzin[$i];	
	} 
	$srednia = $suma/$length; 
echo <<<END
<p>Liczba użytkowników facebooka: $uFacebook</p>
<p>Liczba użytkowników instagrama: $uInstagram</p>
<p>Liczba użytkowników twittera: $uTwitter</p>
<p>Liczba użytkowników ask.fm: $uAsk</p>
<p>Osoby, które wykorzystują komputer tylko do pracy: $uNone</p>
<p>Średni czas jaki ankietowani spędzają przed komputerem: $srednia</p> 
END;
	echo "<p> Wykres ilość godzin spędzanych przed komputerem dla poszczególnych ankiet</p>";
	$LabChartsBar = new LabChartsBar();
	$LabChartsBar->setsize("600x400");
    	$LabChartsBar->setData($iloscGodzin);
	$LabChartsBar->setBarStyles(40,10);
	$LabChartsBar->setTitle('Godziny');
	$LabChartsBar->setAxis(1);
    	echo '<img src='.$LabChartsBar->getChart().' />';
	echo '<br/>';
	echo "<p> Wykres kołowy obrazujący ilość godzin spędzonych przed komputerem według płci</p>";
	$LabChartsPie = new LabChartsPie();
	$LabChartsPie->setData(array($female, $male, $other));
	$LabChartsPie->setLabels ('female|male|other');
	echo '<img src='.$LabChartsPie->getChart().' />';
    }
}
?>
