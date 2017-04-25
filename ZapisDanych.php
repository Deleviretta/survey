<?php

class ZapisDanych{
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

function _save () {
	$gender = $_POST['gender'];
	$wiek = $_POST['wiek'];
	$godziny = $_POST['godziny'];
	if(isset($_POST['facebook'])){
		$facebook = "tak";
	}
	else{
		$facebook="brak";
	}
	if(isset($_POST['instagram'])){
		$instagram = "tak";
	}
	else{
		$instagram="brak";
	}
	if(isset($_POST['twitter'])){
		$twitter = "tak";
	}
	else{
		$twitter = "brak";
	}
	if(isset($_POST['ask'])){
		$ask = "tak";
	}
	else{
		$ask = "brak";
	}
	if(isset($_POST['none'])){	
		$none = "tak";
	}
	else{
		$none = "brak";		
	}
	$cursor = $this->collection->find();
	$index = 0;
	foreach ( $cursor as $obj ) {
      		$id = $obj['numerAnkiety'];
		if((int)$id > $index){
			$index = (int)$id;			
		}
	}
	$index = $index + 1;
	$query = array('numerAnkiety' => $index,
			'date' => date("Y-m-d"),
			'gender' => $gender,
			'wiek' => $wiek,
			'godziny' => $godziny,
			'facebook' => $facebook,
			'instagram' => $instagram,
			'twitter' => $twitter, 
			'ask' => $ask,				
			'none' => $none);         	
	$this->collection->insert($query);
        $text = "Poprawnie dodano ankietę numer: ".$index;
	return $text;
 } 
function select() {
	$cursor = $this->collection->find();
	echo "<table>";
	echo '<tr><td>Numer ankiety</td><td>Data</td><td>Płeć</td><td>Wiek</td><td>Godziny</td><td>Facebook</td><td>Instagram</td>';
	echo '<td>Twitter</td><td>Ask.fm</td><td>Praca</td></tr>';
      	foreach ( $cursor as $obj ) {
		echo "<tr>";
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

		$query = array('numerAnkiety' => $numerAnkiety,
				'date' => $date,
				'gender' => $gender,
				'wiek' => $wiek,
				'godziny' => $godziny,
				'facebook' => $facebook,
				'instagram' => $instagram,
				'twitter' => $twitter, 
				'ask' => $ask,				
				'none' => $none); 
		foreach ($query as $value) {
    			echo "<td>".$value."</td>";
		}
		echo "</tr>";
		
     	}
	echo "</table>";
    }
	
}
