<?php

	session_start();
	
	if((!isset($_GET['id'])) || (!isset($_SESSION['user']))) 
	{
		$_SESSION['zdjecia'] = '<div class="text-danger"><b>nie masz uprawnień do kasowania</b></div>';
		header('Location: zdjecia');
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
		$id = $_GET['id'];
		
		$sql = 'DELETE FROM zdjecia WHERE id='.$id;
		
		if($rezultat = @$polaczenie->query($sql))

		{
			$_SESSION['zdjecia'] = '<div class="text-success"><b>wykasowano zdjęcie</b></div>';
		} else {
			$_SESSION['zdjecia'] = '<div class="text-danger"><b>nie wykasowano zdjęcia - błąd serwera</b></div>';
		}
		
		$polaczenie->close();
		
		header('Location: zdjecia');
	}
?>