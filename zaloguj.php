<?php

	session_start();
	
	if((!isset($_POST['login'])) || (!isset($_POST['haslo']))) 
	{
		header('Location: logowanie');
		exit();
	}

	require_once "connect.php";
	
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
		$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
	
		echo $login."<br/>";
		echo $haslo."<br/>";
		
		$sql = sprintf("SELECT * FROM admini WHERE name='%s' AND password='%s'",
		               mysqli_real_escape_string($polaczenie, $login),
					   mysqli_real_escape_string($polaczenie, $haslo));
		
		if($rezultat = @$polaczenie->query($sql))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow > 0)
			{
				$wiersz = $rezultat->fetch_assoc();
				$user = $wiersz['name'];
				$email = $wiersz['email'];
				$_SESSION['user'] = $user;
				$_SESSION['email'] = $email;
				echo "zalogowano jako ".$wiersz['user'];
				
				$rezultat->close();
				header('Location: uzytkownik');
			}
			else
			{
				echo "nie zalogowano";
				header('Location: logowanie');
				$_SESSION['blad'] = '<b class="text-danger">Nieprawidłowe dane logowania</b>';
			}
		}
		
		$polaczenie->close();
	}

?>