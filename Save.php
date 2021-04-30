<?php

	session_start();
	
	if (!isset($_SESSION['registrationIsGood']))
	{
		header('Location: Registration.php');
		exit();
	}
	else
	{

		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		try {

		$db = new mysqli($host, $db_user, $db_password, $db_name);
		
			
		unset($_SESSION['registrationIsGood']);	
		header('Location:FirstPage.php');
	
			}
			
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
	}
	
	//Usuwanie zmiennych pamiętających wartości wpisane do formularza
	if (isset($_SESSION['fr_inputName'])) unset($_SESSION['fr_inputName']);
	if (isset($_SESSION['fr_inputEmail'])) unset($_SESSION['fr_inputEmail']);
	if (isset($_SESSION['fr_inputPassword1'])) unset($_SESSION['fr_inputPassword1']);
	if (isset($_SESSION['fr_inputPassword2'])) unset($_SESSION['fr_inputPassword2']);
	
	//Usuwanie błędów rejestracji
	if (isset($_SESSION['e_name'])) unset($_SESSION['e_name']);
	if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
	if (isset($_SESSION['e_password'])) unset($_SESSION['e_password']);
	
?>