<?php

	@session_start();
	
echo<<<END
	<header class="site-header col-12">
		<div class="row topcontent bg-light">
			<img src="media/Piotr.jpg" alt="Apostoł Piotr" class="col-12 col-md-1 bg-light topimg"/>
			<div class="col-12 col-md-10 bg-light d-flex align-items-center justify-content-center">
			<h2><b>Parafia pw. Św. Apostołów Piotra i Pawła w Bydgoszczy</b></h2>
			</div>
			<img src="media/Pawel.jpg" alt="Apostoł Paweł" class="col-12 col-md-1 bg-light topimg"/>
		</div>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
				<button class="navbar-toggler mr-auto ml-auto w-100 border-dark" style="border-width:2px" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
					<h3 class="text-dark">MENU</h3>
					<span class="navbar-toggler-icon my-1">
						<!--<img style="width: 100%; height: 100%;" src="media/pp.jpg" alt="przycisk rozwijanej nawigacji"/>-->
					</span>
				</button>
				<div class="collapse navbar-collapse" id="navbarToggle">
					<div class="navbar-nav mr-auto ml-auto">
END;
					if(!isset($_SESSION['user']))
					{
echo<<<END
						<a class="btn btn-light w-100 mx-1 font-weight-bold" href="domowa"><h3>Główna</h3></a>
END;
					}
					else {
echo<<<END
						<div class="nav-item dropdown">
							<button class="btn btn-light w-100 mx-1 font-weight-bold" id="subnav" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<h3>Główna</h3>
							</button>
							<div class="dropdown-menu bg-light mr-auto ml-auto" aria-labelledby="subnav">
								<a class="dropdown-item bg-light font-weight-bold" href="domowa"><h3>Domowa</h3></a>
								<a class="dropdown-item bg-light font-weight-bold" href="aktualnosci"><h3>Aktualności</h3></a>
								<a class="dropdown-item bg-light font-weight-bold" href="dodajAktualnosci"><h3>Dodaj Aktualności</h3></a>
							</div>
						</div>
END;
					}
echo<<<END
						<div class="nav-item dropdown">
							<button class="btn btn-light w-100 mx-1 font-weight-bold" id="subnav" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<h3>Parafia</h3>
							</button>
							<div class="dropdown-menu bg-light mr-auto ml-auto" aria-labelledby="subnav">
								<a class="dropdown-item bg-light font-weight-bold" href="kontakt"><h3>Kontakt</h3></a>
								<a class="dropdown-item bg-light font-weight-bold" href="biuro"><h3>Biuro</h3></a>
								<a class="dropdown-item bg-light font-weight-bold" href="parafia"><h3>Historia</h3></a>
								<a class="dropdown-item bg-light font-weight-bold" href="duchowni"><h3>Duchowieństwo</h3></a>
							</div>
						</div>
						<div class="nav-item dropdown">
							<button class="btn btn-light w-100 mx-1 font-weight-bold" id="subnav" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<h3>Ogłoszenia</h3>
							</button>
							<div class="dropdown-menu bg-light mr-auto ml-auto" aria-labelledby="subnav">
								<a class="dropdown-item bg-light font-weight-bold" href="ogloszeniaStale"><h3>Stałe</h3></a>
								<a class="dropdown-item bg-light font-weight-bold" href="ogloszeniaBiezace"><h3>Bieżące</h3></a>
								<a class="dropdown-item bg-light font-weight-bold" href="newsletter"><h3>Newsletter</h3></a>
END;
								if(isset($_SESSION['user']))
								{
echo<<<END
								<a class="dropdown-item bg-light font-weight-bold" href="dodajOgloszenie"><h3>Dodaj bieżące</h3></a>
END;
								}
echo<<<END
							</div>
						</div>
						<div class="nav-item dropdown">
							<button class="btn btn-light w-100 mx-1 font-weight-bold" id="subnav" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<h3>Pliki</h3>
							</button>
							<div class="dropdown-menu bg-light mr-auto ml-auto" aria-labelledby="subnav">
								<a class="dropdown-item bg-light font-weight-bold" href="zdjecia"><h3>Zdjecia</h3></a>
END;
								if(isset($_SESSION['user']))
								{
echo<<<END
								<a class="dropdown-item bg-light font-weight-bold" href="dodajZdjecie"><h3>Dodaj zdjęcie</h3></a>
END;
								}
echo<<<END
								<a class="dropdown-item bg-light font-weight-bold" href="pliki"><h3>Do pobrania</h3></a>
END;
								if(isset($_SESSION['user']))
								{
echo<<<END
								<a class="dropdown-item bg-light font-weight-bold" href="dodajPlik"><h3>Dodaj plik</h3></a>
END;
								}
echo<<<END
							</div>
						</div>
						<div class="nav-item dropdown">
							<button class="btn btn-light w-100 mx-1 font-weight-bold" id="subnav" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<h3>Sakramenty</h3>
							</button>
							<div class="dropdown-menu bg-light mr-auto ml-auto" aria-labelledby="subnav">
								<a class="dropdown-item bg-light font-weight-bold" href="chrzest"><h3>Chrzest</h3></a>
								<a class="dropdown-item bg-light font-weight-bold" href="eucharystia"><h3>Eucharystia</h3></a>
								<a class="dropdown-item bg-light font-weight-bold" href="pokuta"><h3>Pokuta</h3></a>
								<a class="dropdown-item bg-light font-weight-bold" href="malzenstwo"><h3>Małżeństwo</h3></a>
								<a class="dropdown-item bg-light font-weight-bold" href="bierzmowanie"><h3>Bierzmowanie</h3></a>
								<a class="dropdown-item bg-light font-weight-bold" href="pogrzeb"><h3>Pogrzeb</h3></a>
							</div>
						</div>
						<div class="nav-item dropdown">
							<button class="btn btn-light w-100 mx-1 font-weight-bold" id="subnav" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<h3>Stowarzyszenia</h3>
							</button>
							<div class="dropdown-menu bg-light mr-auto ml-auto" aria-labelledby="subnav">
								<a class="dropdown-item bg-light font-weight-bold" href="akcjaKatolicka"><h3>Akcja Katolicka</h3></a>
							</div>
						</div>
END;
						if(!isset($_SESSION['user']))
						{
echo<<<END
						<a class="btn btn-light w-100 mx-1 font-weight-bold" href="logowanie"><h3>Logowanie</h3></a>
END;
						}
						else
						{
echo<<<END
						<div class="nav-item dropdown">
							<button class="btn btn-light w-100 mx-1 font-weight-bold" id="subnav" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<h3>Administracja</h3>
							</button>
							<div class="dropdown-menu bg-light mr-auto ml-auto" aria-labelledby="subnav">
								<a class="dropdown-item bg-light font-weight-bold" href="rejestracja"><h3>Rejestracja</h3></a>
								<a class="dropdown-item bg-light font-weight-bold" href="admini"><h3>Administratorzy</h3></a>
								<a class="dropdown-item bg-light font-weight-bold" href="wyloguj"><h3>Wylogowanie</h3></a>
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