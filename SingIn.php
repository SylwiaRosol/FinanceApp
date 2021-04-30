<?php
session_start();

if (isset($_POST['inputEmail'])&& isset($_POST['inputPassword']))
	{
    

    require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$db = new mysqli($host, $db_user, $db_password, $db_name);
      $email = $_POST['inputEmail'];
      $password = $_POST['inputPassword'];
		
			$query = $db->query("SELECT * FROM users WHERE  email='$email'");
			
			if(!$query) {
				 throw new Exception($db->error);
			} else {
        $howUsers =$query->num_rows;
			if($howUsers>0) {
        $data = $query->fetch_assoc();
				
				if (password_verify($password, $data['password']))
				{
					$_SESSION['logged'] = true;
					$_SESSION['id'] = $data['id'];
					$_SESSION['username'] = $data['username'];
					$_SESSION['password'] = $data['password'];
					$_SESSION['email'] = $data['email'];

          $query->free_result();
					header('Location: AfterSingIn.php');
	
			}
    }}

    }
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
		
    $db->close();
  }
?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
    <title>Logowanie</title>
    <link rel="shortcut icon" href="img/dollar.png" type="image/png">
    
    <!--CSS-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    

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
                  
            <h1 class>Zaloguj się</h1>
            <p>Chcesz wiedzieć, gdzie się podziały twoje pieniądze?</p>

            <div class="form-label-group">
                  <input type="email" id="inputEmail" value=" <?php
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
                  <input type="password" id="inputPassword" value="<?php
			if (isset($_SESSION['fr_inputPassword1']))
			{
				echo $_SESSION['fr_inputPassword1'];
				unset($_SESSION['fr_inputPassword1']);
			}
		?>" name="inputPassword" class="form-control" placeholder="Hasło">
            </div>
            
            <?php
              if (isset($_SESSION['e_password']))
              {
                echo '<div>'.$_SESSION['e_password'].'</div>';
                unset($_SESSION['e_password']);
              }
            ?>		
          

            <div class="checkbox">
                  <label style="font-size: 18px;">
                    <input type="checkbox" value="remember-me"> Remember me
                  </label>
            </div>

            <input type= "submit" class="btn mt-3"  name ="buttonSingIn" id="buttonSingIn" value="Zaloguj się" />    
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