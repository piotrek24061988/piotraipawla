<?php

	@session_start();
	
	if((!isset($_GET['id'])) || (!isset($_SESSION['user']))) 
	{
		$_SESSION['pliki'] = '<div class="text-danger"><b>nie masz uprawnień do kasowania</b></div>';
		header('Location: pliki');
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
		
		$sql = 'DELETE FROM pliki WHERE id='.$id;
		
		if($rezultat = @$polaczenie->query($sql))

		{
			$_SESSION['pliki'] = '<div class="text-success"><b>wykasowano plik</b></div>';
		} else {
			$_SESSION['pliki'] = '<div class="text-danger"><b>nie wykasowano pliku - błąd serwera</b></div>';
		}
		
		$polaczenie->close();
		
		header('Location: pliki');
	}
?>