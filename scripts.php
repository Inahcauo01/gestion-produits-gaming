<?php include 'conf.php' ;

session_start();

if(isset($_POST["signUp"]))     signup();
if(isset($_POST["signIn"]))     signin(); 
if(isset($_POST["signOut"]))    logout();
if(isset($_POST['addCat']))     addCategorie();
if(isset($_GET['suppCat']))     suppCategorie();
if(isset($_GET['suppJeu']))     suppJeu();


function signup(){
    include 'conf.php';
    $nom   = mysqli_real_escape_string($conn,$_POST["usernameSignup"]);
    $email = mysqli_real_escape_string($conn,$_POST["emailSignup"]);
    $pwd   = md5($_POST["pwdSignup"]);
    $cpwd  = md5($_POST["cpwdsignup"]);

if($pwd != $cpwd){
    $msg="les pwds sont pas identiques !";
    header("Location: index.php?msg=$msg");
}
else{
    $sql    = "select * from user where email = '$email' and type_user= 1";
    $result = mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result)>0){
        $msg="L'email a déja utilisé !";
        header("Location: index.php?msg=$msg");
    }else{
        $sql    = "INSERT INTO user (username, email, password) VALUES ('$nom', '$email', '$pwd' )";
        $result = mysqli_query($conn,$sql);

        if($result){
            $msg="l'utilisateur a bien été inscrit";
            header("Location: index.php?msg=$msg");
        }
        else{
            $msg="Erreur lors de l inscription Veuillez ressayer plus tard :/";
            header("Location: index.php?msg=$msg");
        }

    }

}


}

function signin(){
    include 'conf.php';
    $email  = $_POST['emailSignin'];
    $pwd    = md5($_POST['pwdSignin']);

    $sql    = "select * from user where email = '$email' and password = '$pwd' and type_user= 1";
    $result = mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result)){
        $msg="vous êtes connecté";
        header("Location: index.php?msg=$msg");
    }
    else{
        $sql    = "select * from user where email = '$email' and password = '$pwd' and type_user = 2";
        $result = mysqli_query($conn,$sql);

        if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];

            header("location: dashboard.php");
        }else{
            $msg="l email ou le mot de passe est incorrect";
            header("Location: index.php?msg=$msg");
        }
        
    }
}

function logout(){
    include 'conf.php';
    session_destroy();
    header("Location: index.php");
}


function buttons(){
    if(isset($_SESSION['username'])){
        echo "<form action=\"scripts.php\" method=\"POST\">
        <button class=\"bg-transparent\" type=\"submit\" name=\"signOut\"><i class=\"fa-solid fa-right-to-bracket\"></i> Se deconnecter</button>
        </form>";
    }else {
        echo "<span class=\"btn btn-light border rounded-5 seconnecter\">se connecter</span>";
        
    }
}

function username(){
    if(isset($_SESSION['username'])){
        echo $_SESSION['username'];
    }else {
        echo "username";
    }
}

function addCategorie(){
    include 'conf.php';
    $nom=$_POST['nom_cat'];
    
    $sql = "INSERT INTO categories (nom)	VALUES ('$nom')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: pages/categories.php");
    }else{
        $msg="Problem lors de l'insertion !";
        header("Location: pages/categories.php?msg=$msg");
    }

}
function suppCategorie(){
   include 'conf.php';
   $sql    = "delete from categories where id=".$_GET["suppCat"];
   $result = mysqli_query($conn,$sql);
   if($result){
        header("Location: pages/categories.php");
   }else{
        $msg="Problem lors de la suppression !";
        header("Location: pages/categories.php?msg=$msg");
   }
}
function suppJeu(){
    include 'conf.php';
    $sql    = "delete from jeux where id=".$_GET["suppJeu"];
    $result = mysqli_query($conn,$sql);
    if($result){
        header("Location: pages/jeux.php");
        
    }else{
        $msg="Problem lors de la suppression !";
        header("Location: pages/jeux.php?msg=$msg");
   }
}

?>