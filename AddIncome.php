<?php

session_start();

if(!isset($_SESSION['logged'])) {
        header ("Location: FirstPage.php");
        exit();
}


if(isset($_POST['category'])) {

    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $category = $_POST['category'];
    $userId = $_SESSION['id'];
    $itGood = true;

        if(isset($_POST['coment'])) {
            $coment = $_POST['coment'];
        }
        if($amount <=0) {
         $e_amount = 'Podana kwota jest błędna'; 
         $itGood = false;  
        }
if ($itGood == true) {
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

try {
    $db = new mysqli($host, $db_user, $db_password, $db_name);

    $query1= $db->query("SELECT * FROM incomes_category_assigned_to_users WHERE user_id='$userId' AND name='$category'");
        if(!$query1) {
            throw new Exception($db->error);
        } else {

            $row = $query1->fetch_assoc();
            $id_incomes = $row['id'];
        }
    
    $query2 = $db->query("INSERT INTO incomes VALUES (NULL, '$userId', '$id_incomes', '$amount', '$date', '$coment')");
        if(!$query2) {
                throw new Exception($db->error);
        } else {

            $_SESSION['addIncomes']=true;
            header('Location: AfterSingIn.php');
        }

}
catch(Exception $e)	{
    echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
    echo '<br />Informacja developerska: '.$e;
} 

    $db->close();
}}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
    <title>Dodaj dochód</title>
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
                            <a  id="active" class="nav-link" href="AddIncome.php">Dodaj dochód</a>
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
      
          <main class="py-4"> 
            <section>
            <form method="post">
    			<div class="container py-2">
                <h1 class="text-uppercase py-1">Dodaj dochód</h1>

                <div class="col-8 offset-2 col-sm-6 offset-sm-3 col-lg-4 offset-lg-4 py-2">
                    <div class="input-group has-validation">
                      <span class="input-group-text"><i class="demo-icon icon-wallet"></i> </span>
                      <input type="number" class="form-control" id="amount" name="amount" placeholder="Kwota" required>
                        <div class="invalid-feedback">
                            Podaj kwotę
                        </div>
                    </div>
                    <?php if (isset($e_amount)) {
                          echo $e_amount;
                      } ?>
                </div>

                <div class="col-8 offset-2 col-sm-6 offset-sm-3 col-lg-4 offset-lg-4 py-2">
                    <div class="input-group has-validation">
                        <span class="input-group-text"><i class="demo-icon icon-calendar"></i> </span>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                </div>

                    <h3>Kategorie</h3>
                  <div class="category col-12 col-lg-8 offset-lg-2 col-xl-8 offset-xl-3">  
                        <div class="icon">
                          <input type="radio" name="category" id="payment" value="Salary" class="input-hidden" style="display:none;"/>
                          <label for="payment"> <img src="img/payemnt.png" alt="Wypłata"/></label><p>Wynagrodzenie</p> 
                      </div>
                      <div class="icon">
                           <input type="radio" name="category" id="chart" value="Interest" class="input-hidden" style="display:none;"/>
                           <label for="chart"> <img src="img/chart.png" alt="Odsetki bankowe"/></label><p>Odsetki bankowe</p> 
                        </div>
                        <div class="icon">
                           <input type="radio" name="category" id="sale" value="Allegro" class="input-hidden" style="display:none;"/>
                           <label for="sale"> <img src="img/sale.png" alt="Sprzedarz na allegro"/></label><p>Sprzedarz na allegro</p> 
                        </div>
                        <div class="icon">
                            <input type="radio" name="category" id="money" value="Another" class="input-hidden" style="display:none;"/>
                            <label for="money"> <img src="img/money.png" alt="Inne"/></label><p>Inne</p> 
                         </div>
                        <div style="clear: both;"></div>
                  </div>

                  
                <div class="col-8 offset-2 col-sm-6 offset-sm-3 col-lg-4 offset-lg-4 py-3">
                    <div class="input-group">
                      <span class="input-group-text"><i class="demo-icon icon-pencil"></i> </span>
                      <input type="text" class="form-control" name="coment" id="coment" placeholder="Komentarz" required>
                    </div>
                </div>
                <div class= "col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-5 offset-xl-4 mt-2">
                    <input class="btn" style="float: left;" id="addIncome" type="submit" value="Dodaj"/>
                    <p><a class="btn" id="back" href="AfterSingIn.php" role="button">Wróć</a></p>  
                </div>

            </div>
            </form>
            </section>

          </main>

          <footer class="bg-dark fixed-bottom">
            <p class="col-5 offset-5 col-md-2 offset-md-6">&copy;  2021</p>
          </footer>
      

    <!--JavaScript-->
    <script src="jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
   </body>
   </html>
