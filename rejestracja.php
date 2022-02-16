<?php
	@session_start();

	if(!isset($_SESSION['user']))
	{
		header('Location: domowa');
	}
?>
<!DOCTYPE HTML>
<html lang="pl">

	<head>
		<?php include 'header.php'; ?>
	</head>

    <body>
	
		<?php include 'menu.php'; ?>

        <main class="container">
			<?php include 'scrollup.php'; ?>
			
			<div class="bg-light mt-1 content text-center mb-1">
<?php
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
					$haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);

					if(!isset($_POST['regulamin']))
					{
						$walidacjaOk = false;
						$_SESSION['e_regulamin'] = "Zaakceptuj politykę bezpieczeństwa";
					}

					require_once "connect.php";
					mysqli_report(MYSQLI_REPORT_STRICT);
					try
					{
						$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
						if($polaczenie->connect_errno == 0)
						{
							$sql = sprintf("SELECT id FROM admini WHERE email='%s' OR name='%s'",
											mysqli_real_escape_string($polaczenie, $email),
											mysqli_real_escape_string($polaczenie, $login));		
							$rezultat = @$polaczenie->query($sql);

							if(!$rezultat) throw new Exception($polaczenie->error);

							$ile_uzytkownikow = $rezultat->num_rows;
							if($ile_uzytkownikow > 0)
							{
								$walidacjaOk = false;
								$_SESSION['e_email'] = $_SESSION['e_login'] = "Taki uzytkownik juz istnieje";
							}

							if($walidacjaOk == true) 
							{
								$sql = sprintf("INSERT INTO admini VALUES (NULL, '$login', '$haslo_hash', '$email')"); 		
								$rezultat = @$polaczenie->query($sql);
								if($rezultat)
								{
									echo '<div class="text-success"><b>Udana rejestracja - można się zalogować na konto nowego użytkownika</b></div>';
								}
								else
								{
									throw new Exception($polaczenie->error);
								}
							}

							$polaczenie->close();
						}
					}
					catch(Exception $e)
					{
						echo '<div class="text-danger"><b>Blad serwera. Nie można nawiązać połączenia z bazą danych</b></div>';
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
						<input type="checkbox" name="regulamin"/>
						<b>Oświadzczam, iż nie dokonuję rejestracji osoby przypadkowej,</br>
						   dając jej w ten sposób możliwość korzystania ze strony internetowej</br>
						   na uprawnieniach administratora. Oraz, że osoba ta deklaruje nie przekazywać</br>
						   swojego hasła innym osobom ani rejestrować osób przypdakowych.</b>
					</label></br>
					<?php
						if(isset($_SESSION['e_regulamin']))
						{
							echo '<div class="text-danger"><b>'.$_SESSION['e_regulamin'].'</b></div>';
							unset($_SESSION['e_regulamin']);
						}
					?>
					<input type="submit" value="Rejestruj" class="mt-1 mb-1"/>
				</form>
			</div>
        </main>

		<?php include 'footer.php'; ?>
    </body>
