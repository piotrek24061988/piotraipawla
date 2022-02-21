<?php
	@session_start();

	if(!isset($_SESSION['user']))
	{
		header('Location: domowa');
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
				if(isset($_POST['submit']) && isset($_FILES['file']))
				{
					$img_name = $_FILES['file']['name'];
					$img_size = $_FILES['file']['size'];
					$tmp_name = $_FILES['file']['tmp_name'];
					$error = $_FILES['file']['error'];

					if($error == 0)
					{
						if($img_size > 10000000)
						{
							echo '<div class="col-12 text-danger text-center"><b>za duży plik</b></div>';
						}
						else if ($_POST['title'] == "")
						{
							echo '<div class="col-12 text-danger text-center"><b>dodaj tytyl i tresc</b></div>';
						}
						else
						{
							$title = $_POST['title'];
							$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
							$img_ex_lc = strtolower($img_ex);

							$new_img_name = uniqid("file-", true).'.'.$img_ex_lc;
							$upload_path = 'media/files/'.$new_img_name;
							move_uploaded_file($tmp_name, $upload_path);

							require_once "template/connect.php";
							mysqli_report(MYSQLI_REPORT_STRICT);
							try
							{
								$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
								if($polaczenie->connect_errno == 0)
								{
									$sql = sprintf("INSERT INTO pliki VALUES (NULL, '$title', '$new_img_name')"); 
									$rezultat = @$polaczenie->query($sql);

									if($rezultat)
									{
										echo '<div class="col-12 text-center text-success"><b>Plik dodany do bazy</b></div>';
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
							unset($_FILES['file']);
						}
					}
					else
					{
						echo '<div class="col-12 text-danger text-center"><b>blad podczas ładowania pliku</b></div>';
					}

					unset($_POST['submit']);
					unset($_FILES['file']);
				}

				?>				
					<form method="post" enctype="multipart/form-data" class="col-12">
						<h3>Plik:</h3>
						<label for="title">Opis:</label>
						<input type="text" name="title" class="w-100"/> </br> 
						<input type="file" name="file" class="mt-1 mb-1 w-100" style=""></br> 
						<input type="submit" value="Dodaj plik" name="submit" class="mt-1 mb-1 btn btn-warning font-weight-bold"/>
					</form>
				
			</div>

        </main>

		<?php include 'template/footer.php'; ?>
    </body>