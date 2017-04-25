<?php


function __autoload($class_name) {
    include $class_name . '.php' ;
}
session_start();
$user = new Register_new;

?>



<!DOCTYPE html>
<html lang="pl" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
      xmlns="http://www.w3.org/1999/html">
<head>
	<meta charset="UTF-8">
	<title>Baza danych offline</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="indexeddb.js" type="text/javascript"></script>
	<link rel="Stylesheet" type="text/css" href="style.css" />
	<link href='https://fonts.googleapis.com/css?family=Economica:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>
<body onload="load()">
	<main>	
		<header>
			<?php
				echo "System ankietyzacji offline";
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
    <form id="form">
        <p>Płeć</p>
        <p><input type="radio" name="gender" value="male" checked> Male
        <input type="radio" name="gender" value="female"> Female
        <input type="radio" name="gender" value="other"> Other</p>
        <p>Ile masz lat?<input type="text" id="wiek" value="20"/></p>
        <p>Ile czasu dziennie spędzasz przed komputerem?<input type="text" id="godziny" value="2"/></p>
        <p>Z jakich portali społecznościowych korzystasz?</p>
        <label>
        <input class="check" type="checkbox" name="facebook" value="facebook"> facebook<br>
        </label>
        <label>
        <input class="check" type="checkbox" name="instagram" value="instagram"> instagram<br>
        </label>
        <label>
        <input class="check" type="checkbox" name="twitter" value="twitter"> twitter<br>
        </label>
        <label>
        <input class="check" type="checkbox" name="ask" value="ask"> ask.fm<br>
        </label>
        <label>
        <input class="check" type="checkbox" name="none" value="none"> Żadnych, komputer służy mi głównie do pracy
        </label>
        <p><input type="button" id="wyslij" value="Wyślij do bazy"/>
        <input type="button" id="pokaz" onclick="read()" value="Pokaż rekordy"/></p>
    </form>
    <div id="input"></div>
	</main>
</body>
</html>
