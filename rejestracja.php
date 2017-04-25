<?php

function __autoload($class_name) {
    include $class_name . '.php' ;
}

session_start() ;
$user = new Register_new;

if(isset($_POST['email'])){
	$reg = new Register_new ;
	$reg->_read();
	if($_POST['haslo1']==$_POST['haslo2']){
		$_SESSION['ok'] = 'ok';
	}
	else{
		$_SESSION['errorHaslo'] = "Podane hasła nie są takie same";
	}
}

?>



<!DOCTYPE HTML>
<html>
  <head>
	<meta charset="utf-8">
	<title>System ankietyzacji - rejestracja</title>
	<link rel="Stylesheet" type="text/css" href="style.css" />
	<link href='https://fonts.googleapis.com/css?family=Economica:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
  </head>
  <body>
	<main>	
		<header>
			<?php
				echo "System ankietyzacji";
			?>
		</header>

		<?php

			echo '<nav>';
			if ( ! $user->_is_logged() )
			{  

				echo '<span class="option"><a href="rejestracja.php">Rejestracja w serwisie</a></span>';
				echo '<span class="option"><a href="logowanie.php">Logowanie do serwisu</a></span>';
				echo '<span class="option"><a href="offline.php">Baza offline</a></span>';
				echo '<div style="clear:both;"></div>';
			} 
			else
			{
				echo '<span class="option"><a href="dodajRekord.php">Dodaj ankiete</a></span>' ;
				echo '<span class="option"><a href="pokazRekordy.php">Moje ankiety</a></span>';
				echo '<span class="option"><a href="pokazAnalize.php">Analiza</a></span>';
				echo '<span class="option"><a href="wyloguj.php">Wylogowanie z serwisu</a></span>' ;
				echo '<div style="clear:both;"></div>';
			}
			echo '</nav>';

		?>

	<form class="formularz" method="post">
	        Podaj imię:<input type="text" name="imie"><br/>
	        Podaj nazwisko:<input type="text" name="nazwisko"><br/>
		Podaj uczelnie:<input type="text" name="uczelnia"><br/>
	        Podaj e-mail:<input type="email" name="email"><br/>
	        Podaj hasło:<input type="password" name="haslo1"><br/>
		<?php
			if(isset($_SESSION['errorHaslo'])){
				echo '<div class="error">'.$_SESSION['errorHaslo'].'</div>';	
				unset($_SESSION['errorHaslo']);
			}
		?>
		Powtórz hasło:<input type="password" name="haslo2"><br/>
		<input type="submit" value="Zarejestruj">
	</form> 
	<?php
		if(isset($_SESSION['ok'])){
			echo $reg->_save();
			$_SESSION = array() ;
			session_destroy();
		}
	?>  
	</main>
  </body>
</html>

