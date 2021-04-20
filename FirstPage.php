<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
    <title>Budżet</title>
	<link rel="shortcut icon" href="img/dollar.png" type="image/png">
    
	<!--CSS-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="fontello/css/fontello.css" type="text/css">
    

	<!--CZCIONKA-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">

    
	<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<![endif]-->
    </head>

    <body>
		<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
			<a class="navbar-brand col-1" href="FirstPage.html"> <img src="img/logo2.png" alt="Logo aplikacji" width="50" height="50"></a>
			<blockquote class="blockquote col-10">
				<p>"Zrobić budżet to wskazać swoim pieniądzom, dokąd mają iść, zamiast się zastanawiać, gdzie się rozeszły."</p>
				<footer class="blockquote-footer float-right">John C. Maxwell.</footer>
			</blockquote>	
		  </nav>
	  
		  <main class="pb-4">
	  
			<div class="jumbotron pb-3">
			  <div class="container py-1" style="text-align: left;">
				<div class="row">
				
				<div class="col-10 offset-1 col-md-8 offset-md-0">
					<h1 class="text-uppercase">Zarządzaj swoim budżetem!</h1>
						<p><i class="demo-icon icon-dollar"></i> Dołącz do użytkowników aplikacji</p>
						<p><i class="demo-icon icon-dollar"></i> Dowiedz się, gdzie się podziały twoje pieniądze</p>
						<p><i class="demo-icon icon-dollar"></i> Wskaż swoim pieniądzom, dokąd mają iść</p>
					
						<p><a class="btn float-left" id="buttonSingIn" href="SingIn.php" role="button"> Zaloguj się</a></p>
						<p><a class="btn" id="buttonRegistration" href="Registration.php" role="button"> Zarejestruj się</a></p>
				</div>
				<div class="col-6 offset-2 mb-4 col-md-2 offset-md-2 mb-md-0">
					<picture>
						<source media="(max-width: 991px)" srcset="img/personal_finance2.png">
						<source media="(max-width: 767px)" srcset="img/personal_finance.png">
						<img class="mg-thumbnail float-right ml-3 mt-2" src="img/personal_finance.png" style="width:auto" alt="grafika przedstawiająca mężczyznę i wykresy">
					</picture>
				</div>
				</div>
				</div>
			</div>
	  
			<div class="container my-3">
			 <div class="row">
				<div class="col-md-5">
				  <h2 style="color: burlywood;">Dlaczego warto?</h2>
				  <p>Aplikacja umożliwia szybko ogarnąć własne wydatki i dochody. Dowiesz się na co wydajesz pieniądze, dzięki czemu lepiej będziesz mógł je gospodarować.</p>
				
				</div>
				<div class="col-md-5 offset-md-2">
				  <h2  style="color: burlywood;">Jak skorzystać z aplikacji?</h2>
				  <p>To proste! Wystarczy zarejstrować się podając swoje imię, adres email oraz ustawić hasło bezpieczeństwa. Jeśli jesteś zarejstrowany, kliknij przycisk "Zaloguj się".</p>
				</div>
			 </div>
			</div>
		  </main>
	  
		  <footer class="bg-dark fixed-bottom">
			<p class="col-5 offset-5 col-md-2 offset-md-5">&copy;  2021</p>
		  </footer>


		<!--JavaScript-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
				  
		</body>
	</html>