<!DOCTYPE HTML>
<html lang="pl">

	<head>
		<?php include 'header.php'; ?>
	</head>

    <body>
	
		<?php include 'menu.php'; ?>

        <main class="container">
			<?php include 'scrollup.php'; ?>
			<?php
				if(isset($_SESSION['user']))
				{
					header('Location: domowa');
				}
			?>
			
			<div class="bg-light mt-1 content text-center">
<?php

				if(isset($_SESSION['blad']))
				{
					echo $_SESSION['blad'];
					unset($_SESSION['blad']);
				}
?>
				<h3>Logowanie:</h3>
				<form action="zaloguj.php" method="post">
					<b>Login:</b></br> <input type="text" name="login"/> </br> 
					<b>Hasło:</b></br> <input type="password" name="haslo"/> </br> 
					<input type="submit" value="Zaloguj się" class="mt-1 mb-1"/>
				</form>
			</div>
        </main>

		<?php include 'footer.php'; ?>
    </body>
