
function goToTheMenu() {
    window.location.href = 'Menu.html'; 
    return false; 
}


$('#signIn').on('click', goToTheMenu);
$('#goToTheMenu').on('click', goToTheMenu);
$('#add').on('click', goToTheMenu);
$('#cancel').on('click', goToTheMenu);



$('#registration').click(function() { 
    window.location.href = 'Registration.html'; 
    return false; 
}); 

$('#addNewUser').on('click',function() { 
    window.location.href = 'SignIn.html'; 
    return false;  
});

$('#billingPeriod').click(function() {

    ($('.dropdownContent').css('display') == 'none') ? $('.dropdownContent').css('display', 'block') : $('.dropdownContent').css('display', 'none');
    
});