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
					
					$img_name2 = $_FILES['file2']['name'];
					$img_size2 = $_FILES['file2']['size'];
					$tmp_name2 = $_FILES['file2']['tmp_name'];
					$error2 = $_FILES['file2']['error'];
					
					$img_name3 = $_FILES['file3']['name'];
					$img_size3 = $_FILES['file3']['size'];
					$tmp_name3 = $_FILES['file3']['tmp_name'];
					$error3 = $_FILES['file3']['error'];
					
					$img_name4 = $_FILES['file4']['name'];
					$img_size4 = $_FILES['file4']['size'];
					$tmp_name4 = $_FILES['file4']['tmp_name'];
					$error4 = $_FILES['file4']['error'];
					
					$img_name5 = $_FILES['file5']['name'];
					$img_size5 = $_FILES['file5']['size'];
					$tmp_name5 = $_FILES['file5']['tmp_name'];
					$error5 = $_FILES['file5']['error'];
					
					if(($error == 0) || ($error == 4))
					{
						if($img_size > 10000000)
						{
							echo '<div class="col-12 text-danger text-center"><b>za duży plik</b></div>';
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
							
							$new_img_name2 = NULL;
							$new_img_name3 = NULL;
							$new_img_name4 = NULL;
							$new_img_name5 = NULL;
							
							if($error != 4)
							{
								$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
								$img_ex_lc = strtolower($img_ex);
							}
							else
							{
								$img_ex_lc = 'brakpliku';
							}
							if($error2 != 4)
							{
								$img_ex2 = pathinfo($img_name2, PATHINFO_EXTENSION);
								$img_ex_lc2 = strtolower($img_ex2);
							}
							else
							{
								$img_ex_lc2 = 'brakpliku';
							}
							if($error3 != 4)
							{
								$img_ex3 = pathinfo($img_name3, PATHINFO_EXTENSION);
								$img_ex_lc3 = strtolower($img_ex3);
							}
							else
							{
								$img_ex_lc3 = 'brakpliku';
							}
							if($error4 != 4)
							{
								$img_ex4 = pathinfo($img_name4, PATHINFO_EXTENSION);
								$img_ex_lc4 = strtolower($img_ex4);
							}
							else
							{
								$img_ex_lc4 = 'brakpliku';
							}
							if($error5 != 4)
							{
								$img_ex5 = pathinfo($img_name5, PATHINFO_EXTENSION);
								$img_ex_lc5 = strtolower($img_ex5);
							}
							else
							{
								$img_ex_lc5 = 'brakpliku';
							}
							
							$allowed_exs = array('jpg', 'jpeg', 'png', 'brakpliku');

							if(in_array($img_ex_lc, $allowed_exs)) {
								
								if($error != 4)
								{
									$new_img_name = uniqid("img-", true).'.'.$img_ex_lc;
									$upload_path = 'media/user/'.$new_img_name;
									move_uploaded_file($tmp_name, $upload_path);
								}
								else {
									$new_img_name = NULL;
								}
								
								if(in_array($img_ex_lc2, $allowed_exs)) {
								
									if($error2 != 4)
									{
										$new_img_name2 = uniqid("img-", true).'.'.$img_ex_lc2;
										$upload_path2 = 'media/user/'.$new_img_name2;
										move_uploaded_file($tmp_name2, $upload_path2);
									}
								}
								
								if(in_array($img_ex_lc3, $allowed_exs)) {
								
									if($error3 != 4)
									{
										$new_img_name3 = uniqid("img-", true).'.'.$img_ex_lc3;
										$upload_path3 = 'media/user/'.$new_img_name3;
										move_uploaded_file($tmp_name3, $upload_path3);
									}
								}
								
								if(in_array($img_ex_lc4, $allowed_exs)) {
								
									if($error4 != 4)
									{
										$new_img_name4 = uniqid("img-", true).'.'.$img_ex_lc4;
										$upload_path4 = 'media/user/'.$new_img_name4;
										move_uploaded_file($tmp_name4, $upload_path4);
									}
								}
								
								if(in_array($img_ex_lc5, $allowed_exs)) {
								
									if($error5 != 4)
									{
										$new_img_name5 = uniqid("img-", true).'.'.$img_ex_lc5;
										$upload_path5 = 'media/user/'.$new_img_name5;
										move_uploaded_file($tmp_name5, $upload_path5);
									}
								}

								require_once "template/connect.php";
								mysqli_report(MYSQLI_REPORT_STRICT);
								try
								{
									$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
									if($polaczenie->connect_errno == 0)
									{
										$user_id = $_SESSION['user_id'];
										$sql = sprintf("INSERT INTO aktualnosci VALUES (NULL, '$title', '$new_img_name', '$description', '$new_img_name2', '$description2', '$new_img_name3', '$description3', '$new_img_name4', '$description4', '$new_img_name5', '$description5', CURRENT_TIMESTAMP, '$user_id')"); 
										$rezultat = @$polaczenie->query($sql);

										if($rezultat)
										{
											echo '<div class="col-12 text-center text-success"><b>Aktualności dodane do bazy danych</b></div>';
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
							}
							else {
								echo '<div class="col-12 text-danger text-center"><b>niedozwolony format</b></div>';
							}
							unset($_POST['submit']);
							unset($_FILES['file']);
						}
					}
					else
					{
						echo '<div class="col-12 text-danger text-center"><b>blad podczas ładowania pliku</b></div>';
						echo $error;
					}
					unset($_POST['submit']);
					unset($_FILES['file']);
				}

				?>				
					<form method="post" enctype="multipart/form-data" class="col-12">
						<h3>Aktualności:</h3>
						<label for="title">Tytuł:</label>
						<input type="text" name="title" class="w-100"/> </br>
						<input type="file" name="file" class="mt-1 mb-1 w-100" style=""></br> 
						<textarea rows="20" style="width: 100%;" name="description">
						</textarea></br>
						<input type="file" name="file2" class="mt-1 mb-1 w-100" style=""></br> 
						<textarea rows="20" style="width: 100%;" name="description2">
						</textarea></br>
						<input type="file" name="file3" class="mt-1 mb-1 w-100" style=""></br> 
						<textarea rows="20" style="width: 100%;" name="description3">
						</textarea></br>
						<input type="file" name="file4" class="mt-1 mb-1 w-100" style=""></br> 
						<textarea rows="20" style="width: 100%;" name="description4">
						</textarea></br>
						<input type="file" name="file5" class="mt-1 mb-1 w-100" style=""></br> 
						<textarea rows="20" style="width: 100%;" name="description5">
						</textarea></br>
						<input type="submit" value="Dodaj aktualności" name="submit" class="mt-1 mb-1 btn btn-warning font-weight-bold"/>
					</form>
				
			</div>

        </main>

		<?php include 'template/footer.php'; ?>
    </body>