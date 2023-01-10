<?php
	@session_start();

	if(!isset($_SESSION['user']))
	{
		$_SESSION['biezace'] = '<div class="text-danger"><b>nie masz uprawnień do aktualizacji zdjęć</b></div>';
		header('Location: aktualnosci');
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
					if(!isset($_SESSION['id_aktualnosci']))
					{
						echo '<div class="col-12 text-danger text-center"><b>blad id aktualnosci</b></div>';
					}
					else if (($_POST['title'] == "") || ($_POST['description'] == ""))
					{
						echo '<div class="col-12 text-danger text-center"><b>dodaj tytyl i tresc</b></div>';
					}
					else
					{
						$title = $_POST['title'];
						$description = $_POST['description'];
						if($_POST['description2']){
							$description2 = $_POST['description2'];
						} else {
							$description2 = NULL;
						}
						if($_POST['description3']){
							$description3 = $_POST['description3'];
						} else {
							$description3 = NULL;
						}
						if($_POST['description4']){
							$description4 = $_POST['description4'];
						} else {
							$description4 = NULL;
						}
						if($_POST['description5']){
							$description5 = $_POST['description5'];
						} else {
							$description5 = NULL;
						}
						$id = $_SESSION['id_aktualnosci'];

						require_once "template/connect.php";
						mysqli_report(MYSQLI_REPORT_STRICT);
						try
						{
							$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
							if($polaczenie->connect_errno == 0)
							{
								$sql = sprintf("UPDATE aktualnosci SET tytul='%s', tresc1='%s', tresc2='%s', tresc3='%s', tresc4='%s', tresc5='%s' WHERE id='%s'", $title, $description, $description2, $description3, $description4, $description5, $id); 
								$rezultat = @$polaczenie->query($sql);

								if($rezultat)
								{
									echo '<div class="col-12 text-center text-success"><b>Aktualności zaktualizowane</b></div>';
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
						unset($_SESSION['id_aktualnosci']);
					}
				}			
			
				if(isset($_GET['id']))
				{
					$_SESSION['id_aktualnosci'] = $_GET['id'];
					
					require_once "template/connect.php";
					mysqli_report(MYSQLI_REPORT_STRICT);
					try
					{
						$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
						if($polaczenie->connect_errno == 0)
						{
							$sql = $sql = "SELECT * FROM aktualnosci WHERE id=".$_SESSION['id_aktualnosci']; 
							$rezultat = @$polaczenie->query($sql);

							if($rezultat)
							{
								if($wiersz = $rezultat->fetch_assoc())
								{
									$_SESSION['tytul_aktualnosci'] = $wiersz['tytul'];
									$_SESSION['tresc_aktualnosci'] = $wiersz['tresc1'];
									$_SESSION['tresc2_aktualnosci'] = $wiersz['tresc2'];
									$_SESSION['tresc3_aktualnosci'] = $wiersz['tresc3'];
									$_SESSION['tresc4_aktualnosci'] = $wiersz['tresc4'];
									$_SESSION['tresc5_aktualnosci'] = $wiersz['tresc5'];
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
					<h3>Aktualności:</h3>
					<label for="title">Tytuł:</label>
					<input type="text" name="title" value="<?php 
							if(isset($_SESSION['tytul_aktualnosci']))
							{
								echo $_SESSION['tytul_aktualnosci'];
								unset($_SESSION['tytul_aktualnosci']);
							}
						?>" class="w-100"/> </br> 
					<textarea rows="20" style="width: 100%;" name="description">
					<?php 
							if(isset($_SESSION['tresc_aktualnosci']))
							{
								echo $_SESSION['tresc_aktualnosci'];
								unset($_SESSION['tresc_aktualnosci']);
							}
					?>
					</textarea></br>
					<textarea rows="20" style="width: 100%;" name="description2">
					<?php 
							if(isset($_SESSION['tresc2_aktualnosci']))
							{
								echo $_SESSION['tresc2_aktualnosci'];
								unset($_SESSION['tresc2_aktualnosci']);
							}
					?>
					</textarea></br>
					<textarea rows="20" style="width: 100%;" name="description3">
					<?php 
							if(isset($_SESSION['tresc3_aktualnosci']))
							{
								echo $_SESSION['tresc3_aktualnosci'];
								unset($_SESSION['tresc3_aktualnosci']);
							}
					?>
					</textarea></br>
					<textarea rows="20" style="width: 100%;" name="description4">
					<?php 
							if(isset($_SESSION['tresc4_aktualnosci']))
							{
								echo $_SESSION['tresc4_aktualnosci'];
								unset($_SESSION['tresc4_aktualnosci']);
							}
					?>
					</textarea></br>
					<textarea rows="20" style="width: 100%;" name="description5">
					<?php 
							if(isset($_SESSION['tresc5_aktualnosci']))
							{
								echo $_SESSION['tresc5_aktualnosci'];
								unset($_SESSION['tresc5_aktualnosci']);
							}
					?>
					</textarea></br>
					<input type="submit" value="Aktualizuj" name="submit" class="mt-1 mb-1 btn btn-warning font-weight-bold"/>
				</form>
			</div>

        </main>

		<?php include 'template/footer.php'; ?>
    </body>