<?php include 'scripts.php';

if (!isset($_SESSION['username'])) {
	$msg="Error ! Vous n'avez pas la permission d'entrer";
    header("Location: index.php?msg=$msg");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style/style.css">
    <title>Dashboard</title>
</head>
<body>
<div id="header-dashboard">
    <div id="nav-side" class="bg-dark d-flex flex-column">
        <a href="index.php" class="navbar-brand col-4 mb-3"><h4 class="logo">ORIGIN GAMER</h4></a>

        <a href="dashboard.php" class="p-3 a-link active"><i class="fas fa-chart-line i-link"></i> Tableau de bord</a>
        <a href="#" class="p-3 a-link "><i class="fa-regular fa-handshake i-link"></i> Gestion des commandes</a>
        <a href="#" class="p-3 a-link "><i class="fas fa-users i-link"></i> Utilisateurs</a>
        <a href="pages/jeux.php" class="p-3 a-link "><i class="fa-solid fa-gamepad i-link"></i> Jeux</a>
        <a href="pages/categories.php" class="p-3 a-link "><i class="fa-solid fa-list-ul i-link"></i> Categories</a>
        <a href="#" class="p-3 a-link "><i class="fa-regular fa-message i-link"></i> Messages</a>
        <a href="#" class="p-3 a-link "><i class="fas fa-history i-link"></i> Historique</a>
        
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
                            <img src="assets/image/avatar.png" alt="Avatar" style="width:22px; height: 22px;" class="rounded-pill">
                            <span class="text-white"> <?php username() ?></span>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a href="#"><i class="fa-solid fa-pen-to-square"></i> Voir le profile</a></li>
                          <form action="scripts.php" method="POST">
                          <li><button type="submit" name="signOut"><i class="fa-solid fa-right-to-bracket"></i> Se deconnecter</button></li>
                          </form>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

<main class="main">
    <div class="container p-3">
        <div class="row d-flex justify-content-around flex-wrap">
            <div class="col-lg-2 bg-dark rounded-4 m-2 p-4 ">
                <div class="title">Totale jeux</div>
                <i class="fa-solid fa-gamepad"></i>
                <div class="value">
                    <?php
                        $sql = "select * from jeux ";
                        $result = mysqli_query($conn,$sql);
                        echo mysqli_num_rows($result);
                    ?>
                </div>
            </div>
            <div class="col-lg-2 bg-dark rounded-4 m-2 p-4">
                <div class="title">Totale Categories</div>
                <i class="fa-solid fa-layer-group"></i>
                <div class="value">
                    <?php
                        $sql = "select * from categories ";
                        $result = mysqli_query($conn,$sql);
                        echo mysqli_num_rows($result);
                    ?>
                </div>
            </div>
            <div class="col-lg-2 bg-dark rounded-4 m-2 p-4">
                <div class="title">Totale Utilisateurs</div>
                <i class="fas fa-users"></i>
                <div class="value">40</div>
            </div>
            <div class="col-lg-2 bg-dark rounded-4 m-2 p-4">
                <div class="title">Totale commandes</div>
                <i class="fa-solid fa-cart-shopping"></i>
                <div class="value">12</div>
            </div>
        </div>
    </div>

    <div class="d-flex">

<!-- Table  -->
<div class="container-table mt-5">
    <table class="table ms-3">
        <thead>
            <tr>
                <th colspan="4"><h5 class="fw-light text-dark">Les jeux recemment ajoutés</h5></th>
            </tr>
            <?php
                $sql    = "select j.id j_id,title,image,prix,date_ajout,id_cat, c.id,nom from jeux j, categories c where j.id_cat=c.id order by date_ajout desc";
                $result = mysqli_query($conn,$sql);

                if (mysqli_num_rows($result) > 0) {
            
                    while($row = mysqli_fetch_assoc($result)) {
                        $image = (!empty($row['image'])) ? '../assets/image/'.$row["image"] : '../assets/image/aucune.jpg';
                        echo "<tr><td>" 
                        . $row["title"]. "</td><td>"
                        . $row["prix"] ."</td><td>"
                        . $row["date_ajout"]."</td><td>"
                        . $row["nom"]."</td></tr>";
                        ;
                    }
                }
            ?>
        </tbody>
    </table>
</div>
    <div id="piechart" style="width: 90%; height: 500px;"></div>
</div>

</main>
</div>
    <!-- scripts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://kit.fontawesome.com/dbe94a6a5a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <!-- <script src="assets/js/chart.js"></script> -->
    <script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['categorie', 'nombre des jeux'],
            <?php
                $sql    = "select nom, count(title) as nbr from jeux j, categories c where j.id_cat=c.id group by nom";
                $result = mysqli_query($conn,$sql);

                $row = mysqli_fetch_assoc($result);
                echo "['".$row["nom"]."','".$row["nbr"]."']";

                while($row = mysqli_fetch_assoc($result)){
                    echo ",['".$row["nom"]."','".$row["nbr"]."']";
                }
            ?>
        ]);

        var options = {
            title: 'Le nombre des jeux par categorie'
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
      </script>
</body>
</html>