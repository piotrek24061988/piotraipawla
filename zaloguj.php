<?php
	@session_start();
	
	if((!isset($_POST['login'])) || (!isset($_POST['haslo']))) 
	{
		header('Location: logowanie');
		exit();
	}

	require_once "template/connect.php";
	
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if($polaczenie->connect_errno != 0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else 
	{
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	
		echo $login."<br/>";
		echo $haslo."<br/>";
		
		$sql = sprintf("SELECT * FROM admini WHERE name='%s'", mysqli_real_escape_string($polaczenie, $login));
		
		if($rezultat = @$polaczenie->query($sql))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow > 0)
			{
				$wiersz = $rezultat->fetch_assoc();

				if(password_verify($haslo, $wiersz['password']) == true)
				{
					$user = $wiersz['name'];
					$email = $wiersz['email'];
					$id = $wiersz['id'];
					$_SESSION['user'] = $user;
					$_SESSION['email'] = $email;
					$_SESSION['user_id'] = $id;
					echo "zalogowano jako ".$wiersz['user'];
				
					$rezultat->close();
					header('Location: uzytkownik');		
				}			
				else
				{
					header('Location: logowanie');
					$_SESSION['blad'] = '<b class="text-danger">Nieprawidłowe dane logowania</b>';
				}
			}
			else
			{
				header('Location: logowanie');
				$_SESSION['blad'] = '<b class="text-danger">Nieprawidłowe dane logowania</b>';
			}
		}
		
		$polaczenie->close();
	}
?>