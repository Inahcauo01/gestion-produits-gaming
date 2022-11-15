<?php include 'config.php' ;

if(isset($_POST["signup"]))     signup();
if(isset($_POST["signin"]))     signin(); 

function signup(){
    include 'config.php';
    $nom = mysql_real_escape_string($_POST["username-signup"]);
    $email = mysql_real_escape_string($_POST["email-signup"]);
    $tele = mysql_real_escape_string($_POST["tele-signup"]);
    $password = md5($_POST["password-signup"]);
    $cpassword = md5($_POST["password-signup"]);

}





?>