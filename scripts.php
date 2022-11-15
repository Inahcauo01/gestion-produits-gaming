<?php include 'conf.php' ;

if(isset($_POST["signUp"]))     signup();
if(isset($_POST["signIn"]))     signin(); 

function signup(){
    include 'conf.php';
    $nom = mysql_real_escape_string($_POST["usernameSignup"]);
    $email = mysql_real_escape_string($_POST["emailSignup"]);
    $password = md5($_POST["pwdSignup"]);
    $cpassword = md5($_POST["cpwdsignup"]);

if($password != $cpassword){
    echo "ils sont pas identiques !";
}
else{
    echo "ils sont identiques";
}


}

function signin(){
    include 'conf.php';
    $email = $_POST['emailSignin'];
    $pwd = $_POST['pwdSignin'];

$sql    = "select * from user where email = '$email' and password = '$pwd' and type_user = 2";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){
    header("location: dashboard.html");
}
else{
    echo 'l email ou le mot de passe est incorrect';
}
}


?>