<?php
class Register_new extends Register {

$plik = fopen('config','r');

$config=array();
while(!feof($plik))
{
	$linia = fgets($plik);
   	array_push($config, $linia);		
}

private $user = $config[0];
private $pass = $config[1];
private $host = $config[2];
private $base = $config[3];
private $coll = $config[4];
private $conn;
private $dbase;
private $collection;

function __construct () {
	parent::__construct() ;
	$this->conn = new Mongo("mongodb://{$this->user}:{$this->pass}@{$this->host}/{$this->base}");
	$this->dbase = $this->conn->selectDB($this->base);
	$this->collection = $this->dbase->selectCollection($this->coll);  
}

function _save () {
	$query = array('email' => $this->data['email']);
	$count = $this->collection->findOne($query);

	if(!count($count)){             
		$this->collection->insert($this->data);
		$text = "Twoje konto zostało poprawnie stworzone. Możesz się zalogować za pomocą adresu email i podanego hasła";
	}
	else{
		$text = "Podany email istnieje w bazie. Spróbuj z innym.";
	}

	return $text;
}  

function _login() {
        echo "logowanie";
	$email = $_POST['email'] ;
	$pass  = $_POST['haslo'] ;
	$access = false ;

	$query = array('email' => $email);
	$count = $this->collection->findOne($query);
	$n = count($count);
	if(count($count)){  
		$this->data = $count;
		if ( $this->data['haslo'] == $pass ){
		$_SESSION['auth'] = 'OK' ;
		$_SESSION['user'] = $email ;
		$access = true ;
         	}           
	}
	if($access=="true"){
		$text = "Użytkownik poprawnie zalogowany";
		header('Location:index.php');
	}
      	else{
		$text = "Błędny login lub hasło. Spróbuj zalogować się jeszcze raz.";
	}
	return $text ;
}



function _is_logged() {
	if ( isset ( $_SESSION['auth'] ) ) { 
		$ret = $_SESSION['auth'] == 'OK' ? true : false ;
	} else { $ret = false ; } 
	return $ret ;
} 


private function select() {
	$cursor = $this->collection->find();
	$table = iterator_to_array($cursor);
	return $table ;
}

private function insert($user) {
	$ret = $this->collection->insert($user) ;
	return $ret;
}

function _logout() {
	unset($_SESSION); 
	session_destroy();   
	$text =  'Uzytkownik wylogowany ' ;
	return $text ;
   }

}
?>
