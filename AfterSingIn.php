<?php

session_start();

if (!isset($_SESSION['logged'])) {
    header ('Location: FirstPage.php');
    exit();
}
if (isset($e_amount)) {
    unset($e_amount);
}

?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
    <title>Witaj</title>
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
        
        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <a class="navbar-brand col-1" href="AfterSingIn.php"> <img src="img/logo2.png" alt="Logo aplikacji" width="50" height="50"></a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
          
                <div class="collapse navbar-collapse" id="navbarsExample03">
                    <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                        <li class="nav-item">
                            <a id="active" class="nav-link" href="AfterSingIn.php">Strona główna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="AddExpense.php">Dodaj wydatek</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="AddIncome.php">Dodaj dochód</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Balance.php">Bilans</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Ustawienia</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="LogOut.php">Wyloguj się</a>
                        </li>      
                    </ul>
                </div>
              </nav>
          </header>
      
          <main class="mt-5 pb-sm-5 pb-lg-0"> 
            
			<div class="container py-2 mb-5">
                <div class="row">
                   <div class="col-12 col-md-4 pb-sm-5 col-lg-5 pb-lg-0">
                    <picture>
                        <source media="(max-width: 767px)" srcset="img/revenue.png">
                        <source media="(max-width: 991px)" srcset="img/revenue2.png">
                        <img class="mg-thumbnail float-left m-3" src="img/revenue.png" style="width:auto" alt="grafika przedstawiająca wykres">
                    </picture>

                   </div>
                   <div class=" col-12 pb-sm-5 col-md-8 col-lg-6 offset-lg-1 pb-lg-0 col-xl-7 offset-xl-0 " style="text-align: left;">
                    <h1 class="text-uppercase pb-3"><?php if(isset($_SESSION['addIncomes'])) {
                        echo "Dochód został dodany.<br> Oto twoje możliwości:";
                        unset($_SESSION['addIncomes']);
                    } else if (isset($_SESSION['addExpenses'])) {
                        echo "Wydatek został dodany.<br> Oto twoje możliwości:";
                        unset($_SESSION['addExpenses']);
                    } else { echo 'Witaj '.$_SESSION['username'].'!<br>Oto Twoje możliwości:';
                    }?></h1>
                    <p class="pb-1"><i class="demo-icon icon-money-1"></i> Dodawaj szybko i wygodnie swoje przychody i wydatki, określając ich kategorie</p>
                    <p class="pb-1"><i class="demo-icon icon-money-1"></i> Sprawdzaj swój obecny stan finansów, by wiedzieć, czy nie wydajesz za dużo</p>
                    <p class="pb-1"><i class="demo-icon icon-money-1"></i> Dopasuj ustawienia do swoich potrzeb</p>
                    <p class="pb-1"><i class="demo-icon icon-money-1"></i> Ogarnij swój budżet i zmień swoje życie! </p>
                   </div>
                </div>
               </div>

          </main>
      
          <footer class="bg-dark fixed-bottom">
			<p class="col-5 offset-5 col-md-2 offset-md-5">&copy;  2021</p>
		  </footer>

    <!--JavaScript-->
    <script src="jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
     </body>
    </html>
