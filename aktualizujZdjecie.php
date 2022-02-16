<?php
	session_start();

	if(!isset($_SESSION['user']))
	{
		$_SESSION['zdjecia'] = '<div class="text-danger"><b>nie masz uprawnień do aktualizacji zdjęć</b></div>';
		header('Location: zdjecia');
		exit();
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
			
			<div class="bg-light mt-1 mb-5 content2 d-flex align-items-center justify-content-center row">
			<?php
				if(isset($_POST['submit']))
				{
					if(!isset($_SESSION['id_zdjecia']))
					{
						echo '<div class="col-12 text-danger text-center"><b>blad id zdjecia</b></div>';
					}
					else if (($_POST['title'] == "") || ($_POST['description'] == ""))
					{
						echo '<div class="col-12 text-danger text-center"><b>dodaj tytyl i tresc</b></div>';
					}
					else
					{
						$title = $_POST['title'];
						$description = $_POST['description'];
						$id = $_SESSION['id_zdjecia'];

						require_once "connect.php";
						mysqli_report(MYSQLI_REPORT_STRICT);
						try
						{
							$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
							if($polaczenie->connect_errno == 0)
							{
								$sql = sprintf("UPDATE zdjecia SET tytul='%s', tresc='%s' WHERE id=%s", $title, $description, $id); 
								$rezultat = @$polaczenie->query($sql);

								if($rezultat)
								{
									echo '<div class="col-12 text-center text-success"><b>Zdjęcie zaktualizowane</b></div>';
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
						unset($_SESSION['id_zdjecia']);
					}
				}			
			
				if(isset($_GET['id']))
				{
					$_SESSION['id_zdjecia'] = $_GET['id'];
					
					require_once "connect.php";
					mysqli_report(MYSQLI_REPORT_STRICT);
					try
					{
						$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
						if($polaczenie->connect_errno == 0)
						{
							$sql = $sql = "SELECT * FROM zdjecia WHERE id=".$_SESSION['id_zdjecia']; 
							$rezultat = @$polaczenie->query($sql);

							if($rezultat)
							{
								if($wiersz = $rezultat->fetch_assoc())
								{
									$_SESSION['tytul_zdjecia'] = $wiersz['tytul'];
									$_SESSION['tresc_zdjecia'] = $wiersz['tresc'];
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
				}

			?>				
				<form method="post" enctype="multipart/form-data" class="col-12">
					<h3>Zdjęcie:</h3>
					<label for="title">Tytuł:</label>
					<input type="text" name="title" value="<?php 
							if(isset($_SESSION['tytul_zdjecia']))
							{
								echo $_SESSION['tytul_zdjecia'];
								unset($_SESSION['tytul_zdjecia']);
							}
						?>" class="w-100"/> </br> 
					<label for="description">Treść:</label>
					<input type="text" name="description" value="<?php 
							if(isset($_SESSION['tresc_zdjecia']))
							{
								echo $_SESSION['tresc_zdjecia'];
								unset($_SESSION['tresc_zdjecia']);
							}
						?>" class="w-100"/> </br> 
					<input type="submit" value="Aktualizuj" name="submit" class="mt-1 mb-1"/>
				</form>
			</div>

        </main>

		<?php include 'footer.php'; ?>
    </body>