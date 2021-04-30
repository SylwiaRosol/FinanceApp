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
$payment = $_POST['paymentMethod'];
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

$query1= $db->query("SELECT * FROM expenses_category_assigned_to_users WHERE user_id='$userId' AND name='$category'");
    if(!$query1) {
        throw new Exception($db->error);
    } else {

        $row = $query1->fetch_assoc();
        $id_expense = $row['id'];
    }
$query2= $db->query("SELECT * FROM payment_methods_assigned_to_users WHERE user_id='$userId' AND name='$payment'");
    if(!$query2) {
        throw new Exception($db->error);
    } else {

        $row2 = $query2->fetch_assoc();
        $id_payment = $row2['id'];
    }
$query3 = $db->query("INSERT INTO expenses VALUES (NULL, '$userId', '$id_expense', '$id_payment', '$amount', '$date', '$coment')");
    if(!$query3) {
            throw new Exception($db->error);
    } else {

        $_SESSION['addExpenses']=true;
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
    <title>Dodaj wydatek</title>
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
                            <a id="active" class="nav-link" href="AddExpense.php">Dodaj wydatek</a>
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
      
          <main class="py-4"> 
            <section>
            <form method="post">
    			<div class="container py-2">
                <h1 class="text-uppercase py-1">Dodaj wydatek</h1>

                <div class="col-8 offset-2 col-sm-6 offset-sm-3 col-lg-4 offset-lg-4 py-2">
                    <div class="input-group has-validation">
                      <span class="input-group-text"><i class="demo-icon icon-wallet"></i> </span>
                      <input type="number" class="form-control" id="amount" name='amount' placeholder="Kwota" required>
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
                        <input type="date" class="form-control" id="date" name='date' required>
                    </div>
                </div>


                  <div class="category col-lg-10 offset-lg-1">
                      <h3>Kategorie</h3>
                      
                      <div class="icon">
                            <input type="radio" name="category" id="transport" value="Transport" class="input-hidden" style="display:none;"/>
                            <label for="transport"> <img src="img/car.png" alt="Transport"/></label><p>Transport</p> 
                        </div>
                        <div class="icon">
                            <input type="radio" name="category" id="book" value="Books" class="input-hidden" style="display:none;"/>
                            <label for="book"> <img src="img/book.png" alt="Książki"/></label><p>Książki</p> 
                        </div>
                        <div class="icon">
                            <input type="radio" name="category" id="food" value="Food" class="input-hidden" style="display:none;"/>
                            <label for="food"> <img src="img/fast-food.png" alt="Jedzenie"/> </label><p>Jedzenie</p>
                        </div>
                        <div class="icon">
                            <input type="radio" name="category" id="house" value="Apartments" class="input-hidden" style="display:none;"/>
                            <label for="house"> <img src="img/home.png" alt="Dom"/></label><p>Dom</p>
                        </div>
                        <div class="icon">
                            <input type="radio" name="category" id="phone" value="Telecommunication" class="input-hidden" style="display:none;"/>
                            <label for="phone"> <img src="img/phone.png" alt="Telefon"/></label><p>Telefon</p> 
                        </div>
                        <div class="icon">
                            <input type="radio" name="category" id="medicine" value="Health" class="input-hidden" style="display:none;"/>
                            <label for="medicine"> <img src="img/medicine.png" alt="Zdrowie"/></label><p>Zdrowie</p> 
                        </div>
                        <div class="icon">
                            <input type="radio" name="category" id="clothes" value="Clothes" class="input-hidden" style="display:none;"/>
                            <label for="clothes"> <img src="img/clothes.png" alt="Ubrania"/></label><p>Ubrania</p> 
                        </div>
                        <div class="icon">
                            <input type="radio" name="category" id="water" value="Hygiene" class="input-hidden" style="display:none;"/>
                            <label for="water"> <img src="img/water.png" alt="Higiena"/></label><p>Higiena</p> 
                        </div>
                        <div class="icon">
                            <input type="radio" name="category" id="kids" value="Kids" class="input-hidden" style="display:none;"/>
                            <label for="kids"> <img src="img/kids.png" alt="Dziecko"/></label><p>Dziecko</p> 
                        </div>
                        <div class="icon">
                            <input type="radio" name="category" id="party" value="Recreation" class="input-hidden" style="display:none;"/>
                            <label for="party"> <img src="img/party.png" alt="Rozrywka"/></label><p>Rozrywka</p> 
                        </div>
                        <div class="icon">
                            <input type="radio" name="category" id="trip" value="Trip" class="input-hidden" style="display:none;"/>
                            <label for="trip"> <img src="img/tour.png" alt="Wycieczka"/></label><p>Wycieczka</p> 
                        </div>
                        <div class="icon">
                            <input type="radio" name="category" id="pet" value="Pet" class="input-hidden" style="display:none;"/>
                            <label for="pet"> <img src="img/pet.png" alt="Zwierzę"/></label><p>Zwierzę</p> 
                        </div>
                      <div class="icon">
                           <input type="radio" name="category" id="investments" value='Investments' class="input-hidden" style="display:none;"/>
                           <label for="investments"> <img src="img/inwestycje.png" alt="Inwestycje"/></label><p>Inwestycje</p>
                        </div>
                        <div class="icon">
                          <input type="radio" name="category" id="coin" value='Debt Repayment' class="input-hidden" style="display:none;"/>
                          <label for="coin"> <img src="img/coin.png" alt="Długi"/></label><p>Długi</p> 
                      </div>
                      <div class="icon">
                           <input type="radio" name="category" id="gift" value='Gift' class="input-hidden" style="display:none;"/>
                           <label for="gift"> <img src="img/gift.png" alt="Darowizna"/></label><p>Darowizna</p>
                        </div>
                        <div class="icon">
                            <input type="radio" name="category" id="Another"value='Another' class="input-hidden" style="display:none;"/>
                            <label for="Another"> <img src="img/money.png" alt="Inne"/></label><p>Inne</p> 
                        </div>
                        <div style="clear: both;"></div>
                  </div>


                  <h3 class="mb-3">Sposób płatności</h3>
                
                <div class="d-block col-12  col-md-8 offset-md-2 col-xl-6 offset-xl-3 py-2">
                  <div class="form-check mr-3 mr-lg-5">
                    <input id="credit" name="paymentMethod" type="radio" value='Credit Card'class="form-check-input" checked required>
                    <label class="form-check-label" for="credit">Karta kredytowa</label>
                  </div>
                  <div class="form-check mr-3 mr-lg-5">
                    <input id="debit" name="paymentMethod" type="radio" value='Debit Card' class="form-check-input" required>
                    <label class="form-check-label" for="debit">Karta debetowa</label>
                  </div>
                  <div class="form-check">
                    <input id="cash" name="paymentMethod" type="radio" value='Cash' class="form-check-input" required>
                    <label class="form-check-label" for="cash">Gotówka</label>
                  </div>
                </div>
                <div style="clear: both;"></div>


                <div class="col-8 offset-2 col-sm-6 offset-sm-3 col-lg-4 offset-lg-4 py-3">
                    <div class="input-group">
                      <span class="input-group-text"><i class="demo-icon icon-pencil"></i> </span>
                      <input type="text" class="form-control" id="coment"name='coment' placeholder="Komentarz" required>
                    </div>
                </div>


                <div class= "col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-5 offset-xl-4 py-2 mb-4">
                  <input class="btn ml-2 mr-xl-4" style="float: left;" id="addExpense" type="submit" value="Dodaj"/>
                  <p class="ml-xl-5"><a class="btn" id="back" href="AfterSingIn.php" role="button">Wróć</a></p>  
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
