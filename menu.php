<?php

	session_start();
	
echo<<<END
	<header class="site-header col-12">
		<div class="row topcontent bg-light">
			<img src="media/pip5.jpg" alt="ołtarz" class="col-12 col-md-2 bg-light topimg"/>
			<div class="col-12 col-md-8 bg-light d-flex align-items-center justify-content-center">
			<h2><b>Parafia pw. Św. Apostołów Piotra i Pawła w Bydgoszczy</b></h2>
			</div>
			<img src="media/pip4.jpg" alt="ołtarz" class="col-12 col-md-2 bg-light topimg"/>
		</div>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
				<button class="navbar-toggler mr-auto ml-auto" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<img style="width: auto; height: 100%;" src="media/pp.jpg" alt="przycisk rozwijanej nawigacji"/>
					</span>
				</button>
				<div class="collapse navbar-collapse" id="navbarToggle">
					<div class="navbar-nav mr-auto ml-auto">
						<a class="btn btn-light w-100 mx-1 font-weight-bold" href="domowa">Głowna</a>
						<div class="nav-item dropdown">
							<button class="btn btn-light w-100 mx-1 font-weight-bold" id="subnav" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Parafia
							</button>
							<div class="dropdown-menu bg-light mr-auto ml-auto" aria-labelledby="subnav">
								<a class="dropdown-item bg-light font-weight-bold" href="kontakt">Kontakt</a>
								<a class="dropdown-item bg-light font-weight-bold" href="biuro">Biuro</a>
								<a class="dropdown-item bg-light font-weight-bold" href="parafia">Historia</a>
								<a class="dropdown-item bg-light font-weight-bold" href="duchowni">Duchowieństwo</a>
							</div>
						</div>
						<div class="nav-item dropdown">
							<button class="btn btn-light w-100 mx-1 font-weight-bold" id="subnav" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Ogłoszenia
							</button>
							<div class="dropdown-menu bg-light mr-auto ml-auto" aria-labelledby="subnav">
								<a class="dropdown-item bg-light font-weight-bold" href="#">Stałe</a>
								<a class="dropdown-item bg-light font-weight-bold" href="#">Bieżące</a>
							</div>
						</div>
						<div class="nav-item dropdown">
							<button class="btn btn-light w-100 mx-1 font-weight-bold" id="subnav" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Galeria
							</button>
							<div class="dropdown-menu bg-light mr-auto ml-auto" aria-labelledby="subnav">
								<a class="dropdown-item bg-light font-weight-bold" href="zdjecia">Zdjecia</a>
END;
								if(isset($_SESSION['user']))
								{
echo<<<END
									<a class="dropdown-item bg-light font-weight-bold" href="dodajZdjecie">Dodaj zdjęcie</a>
END;
								}
echo<<<END
							</div>
						</div>
						<a class="btn btn-light w-100 mx-1 font-weight-bold" href="#">Sakramenty</a>
						<a class="btn btn-light w-100 mx-1 font-weight-bold" href="#">Stowarzyszenia</a>
END;
						if(!isset($_SESSION['user']))
						{
echo<<<END
								<a class="btn btn-light w-100 mx-1 font-weight-bold" href="logowanie">Logowanie</a>
END;
						}
						else
						{
echo<<<END
							<div class="nav-item dropdown">
								<button class="btn btn-light w-100 mx-1 font-weight-bold" id="subnav" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Administracja
								</button>
								<div class="dropdown-menu bg-light mr-auto ml-auto" aria-labelledby="subnav">
									<a class="dropdown-item bg-light font-weight-bold" href="rejestracja">Rejestracja</a>
									<a class="dropdown-item bg-light font-weight-bold" href="admini">Administratorzy</a>
									<a class="dropdown-item bg-light font-weight-bold" href="wyloguj">Wylogowanie</a>
								</div>
							</div>
END;
						}
echo<<<END
					</div>
				</div>
			</div>
		</nav>
	</header>

END;
?>