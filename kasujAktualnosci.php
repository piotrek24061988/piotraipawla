<?php

	@session_start();
	
	if((!isset($_GET['id'])) || (!isset($_SESSION['user']))) 
	{
		$_SESSION['aktualnosci'] = '<div class="text-danger"><b>nie masz uprawnień do kasowania</b></div>';
		header('Location: aktualnosci');
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
		$id = $_GET['id'];
		
		$sql = 'DELETE FROM aktualnosci WHERE id='.$id;
		
		if($rezultat = @$polaczenie->query($sql))

		{
			$_SESSION['aktualnosci'] = '<div class="text-success"><b>wykasowano ogłoszenie</b></div>';
		} else {
			$_SESSION['aktualnosci'] = '<div class="text-danger"><b>nie wykasowano ogłoszenia - błąd serwera</b></div>';
		}
		
		$polaczenie->close();
		
		header('Location: aktualnosci');
	}
?>