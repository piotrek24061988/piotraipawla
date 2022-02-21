<?php
	@session_start();

	if(!isset($_SESSION['user']))
	{
		$_SESSION['stale'] = '<div class="text-danger"><b>nie masz uprawnień do aktualizacji ogłoszeń stałych</b></div>';
		header('Location: ogloszeniaStale');
		exit();
	}
?>
<!DOCTYPE HTML>
<html lang="pl">

	<head>
		<?php include 'template/header.php'; ?>
	</head>

    <body>
	
		<?php include 'template/menu.php'; ?>

        <main class="container">
			<?php include 'template/scrollup.php'; ?>
			
			<div class="bg-light mt-1 mb-5 content2 d-flex align-items-center justify-content-center row">
			<?php
				if(isset($_POST['submit']))
				{
					if ($_POST['description'] == "")
					{
						echo '<div class="col-12 text-danger text-center"><b>dodaj tresc ogloszenia</b></div>';
					}
					else
					{
						$description = $_POST['description'];

						require_once "template/connect.php";
						mysqli_report(MYSQLI_REPORT_STRICT);
						try
						{
							$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
							if($polaczenie->connect_errno == 0)
							{
								$user_id = $_SESSION['user_id']; 
								$sql = sprintf("INSERT INTO memo VALUES (NULL, '$description', CURRENT_TIMESTAMP, '$user_id')"); 
								$rezultat = $polaczenie->query($sql);

								if($rezultat)
								{
									echo  '<div class="col-12 text-center text-success"><b>Ogłoszenie stałe zaktualizowane</b></div>';
								}
								else
								{
									throw new Exception($polaczenie->error);
								}	
						
								$polaczenie->close();
							}
						}
						catch(Exception $e)
						{
							echo '<div class="text-danger col-12 text-center"><b>Blad serwera. Nie można nawiązać połączenia z bazą danych</b></div>';
							exit();
						}
						unset($_POST['submit']);
					}
				}			
				require_once "template/connect.php";
				mysqli_report(MYSQLI_REPORT_STRICT);
				try
				{
					$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
					if($polaczenie->connect_errno == 0)
					{
						$sql = "SELECT * FROM memo ORDER BY id DESC LIMIT 1"; 
						$rezultat = @$polaczenie->query($sql);

						if($rezultat)
						{
							if($wiersz = $rezultat->fetch_assoc())
							{
								$_SESSION['tresc_stalego'] = $wiersz['text'];
							}
						}
						else
						{
							throw new Exception($polaczenie->error);
						}	
				
						
						$polaczenie->close();
					}
				}
				catch(Exception $e)
				{
					echo '<div class="text-danger col-12 text-center"><b>Blad serwera. Nie można nawiązać połączenia z bazą danych</b></div>';
				}
			?>				
				<form method="post" enctype="multipart/form-data" class="col-12">
					<h3>Ogłoszenia stałe:</h3>
					<textarea rows="20" style="width: 100%;" name="description">
					<?php 
							if(isset($_SESSION['tresc_stalego']))
							{
								echo $_SESSION['tresc_stalego'];
								unset($_SESSION['tresc_stalego']);
							}
					?>
					</textarea></br>
					<input type="submit" value="Aktualizuj" name="submit" class="mt-1 mb-1 btn btn-warning font-weight-bold"/>
				</form>
			</div>

        </main>

		<?php include 'template/footer.php'; ?>
    </body>