<?php

	session_start();

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
	
		echo $login."<br/>";
		echo $haslo."<br/>";
		
		$sql = "SELECT * FROM uzytkownicy WHERE user='$login' AND pass='$haslo'";
		
		if($rezultat = @$polaczenie->query($sql))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow > 0)
			{
				$wiersz = $rezultat->fetch_assoc();
				$user = $wiersz['user'];
				$email = $wiersz['email'];
				$_SESSION['user'] = $user;
				$_SESSION['email'] = $email;
				echo "zalogowano jako ".$wiersz['user'];
				
				$rezultat->close();
				header('Location: uzytkownik.php');
			}
			else
			{
				echo "nie zalogowano";
				header('Location: index.php');
			}
		}
		
		$polaczenie->close();
	}

?>