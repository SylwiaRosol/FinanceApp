<?php

session_start();

if(!isset($_SESSION['logged'])) {
  header ("Location: FirstPage.php");
  exit();
}

$userId = $_SESSION['id'];

require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);

try {
$db = new mysqli($host, $db_user, $db_password, $db_name);

$query1= $db->query("SELECT * FROM incomes WHERE user_id='$userId'");
    if(!$query1) {
        throw new Exception($db->error);
    }
        
  $query3= $db->query("SELECT * FROM expenses WHERE user_id='$userId'");
    if(!$query3) {
      throw new Exception($db->error);
    }
}
catch(Exception $e)	{
    echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
    echo '<br />Informacja developerska: '.$e;
}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
    <title>Bilans</title>
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
                            <a class="nav-link" href="AfterSingIn.php">Strona główna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="AddExpense.php">Dodaj wydatek</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="AddIncome.php">Dodaj dochód</a>
                        </li>
                        <li class="nav-item">
                            <a id="active"  class="nav-link" href="Balance.php">Bilans</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Ustawienia</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="LogOut.php">Wyloguj się</a>
                        </li>   
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Okres rozliczeniowy</a>
                          <div class="dropdown-menu" aria-labelledby="dropdown03">
                            <a class="dropdown-item" href="#">Obecny miesiąc</a>
                            <a class="dropdown-item" href="#">Poprzedni miesiąc</a>
                            <a class="dropdown-item" href="#">Niestandardowy</a>
                          </div>
                        </li> 
                    </ul>
                </div>
              </nav>
          </header>
      
          <main class="mt-5"> 
            
			<div class="container mb-4 mb-lg-2">
                <h1 class="text-uppercase">Bilans finansowy</h1>
                <div class="row">
                   <div class="showBalance col-12 mb-2 col-md-8 offset-md-2 col-lg-5 ml-lg-2 mb-lg-0 ml-xl-3 mr-xl-2">
                    <h2>Przychody</h2>

                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                          <thead>
                            <tr>
                              <th>Kwota</th>
                              <th>Data</th>
                              <th>Kategoria</th>
                              <th>Komentarz</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                          $all_incomes = 0;
                          while($row1 = $query1->fetch_assoc()) {
                          $category = $row1['income_category_assigned_to_user_id'];

                          $query2 = $db->query("SELECT * FROM incomes_category_assigned_to_users WHERE id='$category'");
                          $row2=$query2->fetch_assoc();

                          $all_incomes += $row1['amount'];
                            echo '<tr>
                                      <td>'.$row1['amount'].'</td>
                                      <td>'.$row1['date_of_income'].'</td>
                                      <td>'.$row2['name'].'</td>
                                      <td>'.$row1['income_comment'].'</td>';
                          }
                          ?>
                        </tbody>
                        </table>
                        </div>

                   </div>
                   <div class="showBalance col-12 col-md-8 offset-md-2 col-lg-6 ml-lg-4 col-xl-6 ml-xl-4">
                    <h2>Wydatki</h2>

                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                          <thead>
                            <tr>
                              <th>Kwota</th>
                              <th>Data</th>
                              <th>Kategoria</th>
                              <th>Sposób płatności</th>
                              <th>Komentarz</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                          $all_expenses = 0;
                          while($row3 = $query3->fetch_assoc()) {
                          $category_expenses = $row3['expense_category_assigned_to_user_id'];
                          $category_payment = $row3['payment_method_assigned_to_user_id'];

                          $query4 = $db->query("SELECT * FROM expenses_category_assigned_to_users WHERE id='$category_expenses'");
                          $row4=$query4->fetch_assoc();

                          $query5 = $db->query("SELECT * FROM payment_methods_assigned_to_users WHERE id='$category_payment'");
                          $row5=$query5->fetch_assoc();  
                          
                          $all_expenses += $row3['amount'];
                          echo '<tr>
                                      <td>'.$row3['amount'].'</td>
                                      <td>'.$row3['date_of_expense'].'</td>
                                      <td>'.$row4['name'].'</td>
                                      <td>'.$row5['name'].'</td>
                                      <td>'.$row3['expense_comment'].'</td>';
                          }
                          ?>
                        </tbody>
                        </table>
                        </div>

                   </div>
                </div>
                <div class="row mt-4 mb-5 mb-lg-0">
                    <div class=" col-6 offset-2 col-md-3 offset-md-0">
                     <picture>
                         <source media="(max-width: 767px)" srcset="img/wallet.png">
                         <source media="(max-width: 991px)" srcset="img/wallet2.png">
                         <img class="mg-thumbnail float-left m-3" src="img/wallet.png" style="width:auto" alt="grafika przedstawiająca aplikację finansową">
                     </picture>
                     </div>
                     <div class="col-md-8 ml-md-5">
                     <?php $all_amount = $all_incomes - $all_expenses;
                     if($all_amount>0) {
                         echo '<h1>Brawo! Świetnie zarządzasz swoim budżetem!</h1>';
                        } else if ($all_amount<0) {
                          echo '<h1>Uważaj! Twój budżet jest na minusie! </h1>';
                        } else {
                          echo '<h1>Wydajesz tyle samo, co zarabiasz! </h1>';
                        }
                        echo '<h2>Twój stan finansowy to: '.$all_amount.' PLN</h2>';
                         ?>
                     </div>
                </div>
            </div>

          </main>
<?php
$db->close();
?>
          <footer class="bg-dark fixed-bottom">
            <p class="col-5 offset-5 col-md-2 offset-md-5">&copy;  2021</p>
          </footer>

        <!--JavaScript-->
        <script src="jquery-3.2.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
        <script src="script.js"></script>

    </body>
  </html>
