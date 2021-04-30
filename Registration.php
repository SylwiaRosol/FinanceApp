<?php
session_start();


if (isset($_POST['inputName']))
	{
		$itIsGood=true;
		
		$name = $_POST['inputName'];
		if (strlen($name) < 3) {
			$itIsGood=false;
			$_SESSION['e_name']="Imię musi mieć co najmniej 3 litery!";
		}
		
		$email = $_POST['inputEmail'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email)) {
			$itIsGood=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail!";
		}
		
		
		$password1 = $_POST['inputPassword'];
		$password2 = $_POST['inputPassword2'];
		
		if ((strlen($password1)<8) || (strlen($password2)>20))
		{
			$itIsGood=false;
			$_SESSION['e_password']="Hasło musi posiadać od 8 do 20 znaków!";
		}
		
		if ($password1!=$password2)
		{
			$itIsGood=false;
			$_SESSION['e_password']="Podane hasła nie są identyczne!";
		}	

		$password_hash = password_hash($password1, PASSWORD_DEFAULT);
		
		
		//Zapamiętaj wprowadzone dane
		$_SESSION['fr_inputName'] = $name;
		$_SESSION['fr_inputEmail'] = $email;
		$_SESSION['fr_inputPassword1'] = $password1;
		$_SESSION['fr_inputPassword2'] = $password2;
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$db = new mysqli($host, $db_user, $db_password, $db_name);
		
			$query = $db->query("SELECT id FROM users WHERE  email='$email'");
			
			if(!$query) {
				 throw new Exception($db->error);
			} else {

			$howMany = $query->num_rows;
			if($howMany>0) {
				$itIsGood = false;
				$_SESSION['e_email']="Istnieje już konto przypisane do tego email!";
	
			}
			if($itIsGood == true) {

				if ($db->query("INSERT INTO users VALUES (NULL, '$name', '$password_hash', '$email')")) {
					$_SESSION['registrationIsGood']=true;

					$db->query("INSERT INTO incomes_category_assigned_to_users (user_id, name) SELECT users.id, incomes_category_default.name FROM users, incomes_category_default WHERE users.username='$name'");
					$db->query("INSERT INTO expenses_category_assigned_to_users (user_id, name) SELECT users.id, expenses_category_default.name FROM users, expenses_category_default WHERE users.username='$name'");
					$db->query("INSERT INTO  payment_methods_assigned_to_users (user_id, name) SELECT users.id, payment_methods_default.name FROM users, payment_methods_default WHERE users.username='$name'");
							

					header('Location: Save.php');
				}
				else{
					throw new Exception($db->error);
				}
			
			}}
			$db->close();
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
		}
?>



<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
    <title>Rejestracja</title>
    <link rel="shortcut icon" href="img/dollar.png" type="image/png">
    
    <!--CSS-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    

    <!--CZCIONKA-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">

    
	<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<![endif]-->
    </head>

    <body>
      <main>
        <section>
        <form method="post">
		  <div class="form-signin col-10 offset-1 mb-5 col-md-6 offset-md-3 col-xl-4 offset-xl-4 py-4">
            
              <a href="FirstPage.html"><img src="img/logo2.png" alt="Logo strony" width="72" height="72"></a>
              <h1>Rejestracja</h1>
		

            <div class="form-label-group pt-2">
                <input type="text" id="inputName" value="<?php
			if (isset($_SESSION['fr_inputName']))
			{
				echo $_SESSION['fr_inputName'];
				unset($_SESSION['fr_inputName']);
			}?>" name="inputName" class="form-control " placeholder="Imie">
            </div>

			<?php
			if (isset($_SESSION['e_name']))
			{
				echo '<div>'.$_SESSION['e_name'].'</div>';
				unset($_SESSION['e_name']);
			}
			?>

            <div class="form-label-group">
              <input type="email" id="inputEmail" value="<?php
			if (isset($_SESSION['fr_inputEmail']))
			{
				echo $_SESSION['fr_inputEmail'];
				unset($_SESSION['fr_inputEmail']);
			}
		?>" name="inputEmail" class="form-control " placeholder="Adres email">
			</div>

		<?php
			if (isset($_SESSION['e_email']))
			{
				echo '<div>'.$_SESSION['e_email'].'</div>';
				unset($_SESSION['e_email']);
			}
		?>
            
        
            <div class="form-label-group">
              <input type="password" id="inputPassword"  value="<?php
			if (isset($_SESSION['fr_inputPassword1']))
			{
				echo $_SESSION['fr_inputPassword1'];
				unset($_SESSION['fr_inputPassword1']);
			}
		?>"
			  name="inputPassword" class="form-control" placeholder="Hasło">
            </div>

            <div class="form-label-group">
              <input type="password" id="inputPassword2"  value="<?php
			if (isset($_SESSION['fr_inputPassword2']))
			{
				echo $_SESSION['fr_inputPassword2'];
				unset($_SESSION['fr_inputPassword2']);
			}
		?>"
			  name="inputPassword2" class="form-control" placeholder="Powtórz hasło">
            </div>

			<?php
			if (isset($_SESSION['e_password']))
			{
				echo '<div>'.$_SESSION['e_password'].'</div>';
				unset($_SESSION['e_password']);
			}
		?>		
	
            <input class="btn mt-3" id="buttonRegistion" type="submit" value="Zarejstruj się"/>
			
          </div>
		  </form>
        </section>    
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