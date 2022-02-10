<!DOCTYPE HTML>
<html lang="pl">

	<head>
		<?php include 'header.php'; ?>
	</head>

    <body>
	
		<?php include 'menu.php'; ?>

        <main class="container">
			<?php include 'scrollup.php'; ?>
			
			<div class="bg-light mt-1 content text-center">
<?php
				if(!isset($_SESSION['user']))
				{
					header('Location: domowa');
					exit();
				}

				if(isset($_POST['email'])) 
				{
					$walidacjaOk = true;
					$login = $_POST['login'];
					$email = $_POST['email'];
					$emailSan = filter_var($email, FILTER_SANITIZE_EMAIL);
					$haslo = $_POST['haslo'];
					$haslo2 = $_POST['haslo2'];

					if((strlen($login) < 4) || (strlen($login) > 20) || (ctype_alnum($login) == false)) {
						$walidacjaOk = false;
						$_SESSION['e_login'] = "Nick musi posiadac od 4 do 20 znaków, tylko litery i cyfry";
					}

					if((filter_var($emailSan, FILTER_VALIDATE_EMAIL) == false) || ($emailSan != $email)) {
						$walidacjaOk = false;
						$_SESSION['e_email'] = "Adres email niepoprawny";
					}

					if(($haslo != $haslo2) != (strlen($haslo) < 6)) {
						$walidacjaOk = false;
						$_SESSION['e_haslo'] = "Hasło i powtórzone hasło muszą być indentyczne i posiadać conajmniej 6 znaków";
					}

					if($walidacjaOk == true) {
						echo "Udana walidacja";
						exit();
					}

					unset($_SESSION['email']);
				}
?>
				<h3>Rejestracja:</h3>
				<form method="post">
					<b>Login:</b></br> <input type="text" name="login"/> </br> 
					<?php
						if(isset($_SESSION['e_login']))
						{
							echo '<div class="text-danger"><b>'.$_SESSION['e_login'].'</b></div>';
							unset($_SESSION['e_login']);
						}
					?>
					<b>E-mail:</b></br> <input type="text" name="email"/> </br>
					<?php
						if(isset($_SESSION['e_email']))
						{
							echo '<div class="text-danger"><b>'.$_SESSION['e_email'].'</b></div>';
							unset($_SESSION['e_email']);
						}
					?>
					<b>Hasło:</b></br> <input type="password" name="haslo"/> </br>
					<b>Powtórzone hasło:</b></br> <input type="password" name="haslo2"/> </br>
					<?php
						if(isset($_SESSION['e_haslo']))
						{
							echo '<div class="text-danger"><b>'.$_SESSION['e_haslo'].'</b></div>';
							unset($_SESSION['e_haslo']);
						}
					?>
					<label>
						<input type="checkbox" name="regulamin"/><b> Zapoznałem się z zasadami bezpieczeństwa</b>
					</label></br>
					<input type="submit" value="Rejestruj" class="mt-1 mb-1"/>
				</form>
			</div>
        </main>

		<?php include 'footer.php'; ?>
    </body>
