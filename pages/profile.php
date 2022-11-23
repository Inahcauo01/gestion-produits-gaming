<?php include '../scripts.php';

if (!isset($_SESSION['username'])) {
	$msg="Error ! Vous n'avez pas la permission d'entrer";
    header("Location: ../index.php?msg=$msg");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Dashboard</title>
</head>
<body>
<div id="header-dashboard">
    <div id="nav-side" class="bg-dark d-flex flex-column">
        <a href="../index.php" class="navbar-brand col-4  mb-3"><h4 class="logo">ORIGIN GAMER</h4></a>

        <a href="../dashboard.php" class="p-3 a-link"><i class="fas fa-chart-line i-link"></i><span class="text-sidebar"> Tableau de bord</a>
        <a href="users.php" class="p-3 a-link "><i class="fas fa-users i-link"></i><span class="text-sidebar"> Utilisateurs</a>
        <a href="jeux.php" class="p-3 a-link "><i class="fa-solid fa-gamepad i-link"></i><span class="text-sidebar"> Jeux</a>
        <a href="#" class="p-3 a-link"><i class="fa-solid fa-list-ul i-link"></i><span class="text-sidebar"> Categories</a>
        
    </div>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark" id="nav-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <div class="col-12 d-flex justify-content-end align-items-center">
                    <div class="btn-group me-5 align-items-center">
                        <button class="btn btn-transparent text-white btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../assets/image/avatar.png" alt="Avatar" style="width:22px; height: 22px;" class="rounded-pill">
                            <span class="text-white"> <?php username() ?></span>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a href="#"><i class="fa-solid fa-pen-to-square"></i> Voir le profile</a></li>
                          <form action="../scripts.php" method="POST">
                          <li><button type="submit" name="signOut"><i class="fa-solid fa-right-to-bracket"></i> Se deconnecter</button></li>
                          </form>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main class="main bg-danger m-3">
        <form action="scripts.php" method="post">
            
        </form>
    </main>
</div>


    <!-- scripts -->
<script src="https://kit.fontawesome.com/dbe94a6a5a.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script>
    // confirmer la suppression
function confirmSupp($id){
    if(confirm("voulez vous vraiment supprimer ?"))
    document.getElementById("deleteclick"+$id).click();
};
</script>
</body>
</html>