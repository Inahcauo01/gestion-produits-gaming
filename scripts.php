<?php include 'conf.php' ;

session_start();

if(isset($_POST["signUp"]))     signup();
if(isset($_POST["signIn"]))     signin(); 
if(isset($_POST["signOut"]))    logout();

if(isset($_POST['addCat']))     addCategorie();
if(isset($_GET['suppCat']))     suppCategorie();

if(isset($_POST['save']))       addjeu();
if(isset($_GET['suppJeu']))     suppJeu();
if(isset($_POST['modifJeu']))   modifJeu();



function signup(){
    include 'conf.php';
    $nom   = mysqli_real_escape_string($conn,$_POST["usernameSignup"]);
    $email = mysqli_real_escape_string($conn,$_POST["emailSignup"]);
    $pwd   = md5($_POST["pwdSignup"]);
    $cpwd  = md5($_POST["cpwdsignup"]);

if($pwd != $cpwd){
    $_SESSION["msg"] = "les pwds sont pas identiques !";
    header("Location: index.php");
}
else{
    $sql    = "select * from user where email = '$email'";
    $result = mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result)>0){
        $_SESSION["msg"] = "L'email a déja utilisé !";
        header("Location: index.php");
    }else{
        $sql    = "INSERT INTO user (username, email, password) VALUES ('$nom', '$email', '$pwd' )";
        $result = mysqli_query($conn,$sql);

        if($result){
            $_SESSION["msg"] = "l'utilisateur a bien été inscrit";
            header("Location: index.php");
        }
        else{
            $_SESSION["msg"] = "Erreur lors de l inscription Veuillez ressayer plus tard :/";
            header("Location: index.php");
        }

    }
}


}

function signin(){
    include 'conf.php';
    $email  = $_POST['emailSignin'];
    $pwd    = md5($_POST['pwdSignin']);

        $sql    = "select * from user where email = '$email' and password = '$pwd'";
        $result = mysqli_query($conn,$sql);

        if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];

            header("location: dashboard.php");
        }else{
            $_SESSION["msg"] ="l email ou le mot de passe est incorrect";
            header("Location: index.php");
        }
        
}

function logout(){
    include 'conf.php';
    session_destroy();
    header("Location: index.php");
}


function buttons(){
    if(isset($_SESSION['username'])){
        echo "
        <div class=\"btn-dashboard\">
        <a href=\"dashboard.php\" class=\"btn-light fw-normal btn-dash\">Dashboard</a>
        <form action=\"scripts.php\" method=\"POST\">
        <button class=\"bg-dark rounded-pill\" type=\"submit\" name=\"signOut\"><i class=\"fa-solid fa-right-to-bracket\"></i> Se deconnecter</button>
        </form>
        </div>
        ";
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
        $msg="Probleme lors de la suppression !";
        $_SESSION['msg'] = "Probleme lors de la suppression !";
        header("Location: pages/jeux.php");
   }
}
function addjeu(){
    include 'conf.php';
    $title       = $_POST["jeu-title"];
    $date        = $_POST["jeu-date"];
    $prix        = $_POST["jeu-prix"];
    $categorie   = $_POST["jeu-categorie"];
    $description = $_POST["jeu-description"];

    $filename = $_FILES['image']['name'];

    if(!empty($filename)){
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $new_filename = time().'.'.$ext;
        move_uploaded_file($_FILES['image']['tmp_name'], 'assets/uploads/'.$new_filename);
    }
    else{
        $new_filename = '';
    }
    
    $sql    ="INSERT INTO jeux (`title`, `prix`, `date_ajout`, `id_cat`, `image`, `description`) 
                    VALUES ('$title', '$prix','$date','$categorie','$new_filename','$description')";
    $result = mysqli_query($conn,$sql);
    if($result){
        header("Location: pages/jeux.php");
    }else{
        $_SESSION["msg"]="Probleme lors de l'ajout !";
        header("Location: pages/jeux.php");
   }
}

function modifJeu(){
    include 'conf.php';
    $id          = $_POST["jeu-id"];
    $title       = $_POST["jeu-title"];
    $date        = $_POST["jeu-date"];
    $prix        = $_POST["jeu-prix"];
    $categorie   = $_POST["jeu-categorie"];
    $desc        = $_POST["jeu-description"];

    $filename = $_FILES['image']['name'];
    
    if(!empty($filename)){
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $new_filename = time().'.'.$ext;
        move_uploaded_file($_FILES['image']['tmp_name'], 'assets/uploads/'.$new_filename);
        $sql    = "UPDATE jeux set title='{$title}', prix='{$prix}' , date_ajout='{$date}' ,id_cat='{$categorie}', description='{$desc}', image='{$new_filename}' WHERE id=$id";

    }
    else{
        $new_filename = '';
        $sql    = "UPDATE jeux set title='{$title}', prix='{$prix}' , date_ajout='{$date}' ,id_cat='{$categorie}', description='{$desc}' WHERE id=$id";
    }

    $result = mysqli_query($conn,$sql);
        
        if ($result) {
            $_SESSION['msg'] = "Task has been updated successfully !";
		    header('location: pages/jeux.php');
        }else{
            $_SESSION['msg'] = "error lors de la modification";
            header('location: pages/jeux.php');
        }
         
}

?>