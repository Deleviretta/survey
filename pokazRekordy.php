<?php

function __autoload($class_name) {
	include $class_name . '.php' ;
}

session_start();
$user = new Register_new;

$zapis = new ZapisDanych;

?>


<!DOCTYPE HTML>
<html>
  <head>
	<meta charset="UTF-8">
	<title>Wyświetlanie rekordów</title>
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
				echo '<span class="option"><a href="offline.html">Baza offline</a></span>';
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

			$zapis->select();
		?>
	</main>
  </body>
</html>
