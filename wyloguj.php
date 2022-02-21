<?php
	@session_start();
		
	if(isset($_SESSION['user']))
	{
		unset($_SESSION['user']);
		unset($_SESSION['email']);
		unset($_SESSION['user_id']);
		header('Location: domowa');
	}
?>