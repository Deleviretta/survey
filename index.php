<!DOCTYPE HTML>
<html>
  <head>
  	<meta charset="utf-8">
  	<title>System ankietyzacji</title>
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

			function __autoload($class_name) {
				include $class_name . '.php' ;
			}
			session_start();
			$user = new Register_new;
			echo '<nav>';
			if ( ! $user->_is_logged() )
			{  
				echo $user->_is_logged();
				echo '<span class="option"><a href="rejestracja.php">Rejestracja w serwisie</a></span>';
				echo '<span class="option"><a href="logowanie.php">Logowanie do serwisu</a></span>';
				echo '<span class="option"><a href="offline.html">Baza offline</a></span>';
				echo '<div style="clear:both;"></div>';
				foreach ( $_SESSION as $key => $value )
					print '$_SESSION['.$key.'] = '.$value.'<br>' ;
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

	</main>
  </body>
</html>
