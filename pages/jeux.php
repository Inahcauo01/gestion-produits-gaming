<?php include '../scripts.php';

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
    <link rel="stylesheet" href="../assets/style/style.css">
    
    <title>Dashboard</title>
</head>
<body>
<div id="header-dashboard">
    <div id="nav-side" class="bg-dark d-flex flex-column">
        <a href="../index.php" class="navbar-brand col-4  mb-3"><h4 class="logo">ORIGIN GAMER</h4></a>

        <a href="../dashboard.php" class="p-3 a-link"><i class="fas fa-chart-line i-link"></i><span class="text-sidebar"> Tableau de bord</a>
        <a href="users.php" class="p-3 a-link "><i class="fas fa-users i-link"></i><span class="text-sidebar"> Utilisateurs</a>
        <a href="jeux.php" class="p-3 a-link active"><i class="fa-solid fa-gamepad i-link"></i><span class="text-sidebar active"> Jeux</a>
        <a href="categories.php" class="p-3 a-link "><i class="fa-solid fa-list-ul i-link"></i><span class="text-sidebar"> Categories</a>
        
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

<main class="main">
<?php
if(isset($_SESSION["msg"])){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    '.$_SESSION["msg"].'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    unset($_SESSION["msg"]);
}
?>
    <div class="d-flex justify-content-between m-2">
        <h4 class="text-dark">Liste des jeux</h4>
        <button class="btn btn-dark rounded-pill btn-sm" id="addgame" data-bs-toggle="modal" data-bs-target="#modal-game"><i class="fa fa-plus"></i> Ajouter un jeu</button>
    </div>
    <table class="table table-hover table-jeux text-center">
    <thead>
        <tr>
            <th scope="col">Image</th>
            <th scope="col">Titre</th>
            <th scope="col">Prix</th>
            <th scope="col">Date d'ajout</th>
            <th scope="col">Categorie</th>
            <th scope="col">Operations</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $sql    = "select j.id j_id,title,image,prix,date_ajout,id_cat, c.id,nom ,description from jeux j, categories c where j.id_cat=c.id";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
    
            while($row = mysqli_fetch_assoc($result)) {
                $image = (!empty($row['image'])) ? '../assets/uploads/'.$row["image"] : '../assets/image/aucune.jpg';
                echo "<tr><td> 
                <img src='".$image."' height='40px' width='30px'></td><td>" 
                . $row["title"]. "</td><td>"
                . $row["prix"] ."</td><td>"
                . $row["date_ajout"]."</td><td>"
                . $row["nom"]
            // liste des actions
                ."</td><td>
                <button class=\"btn btn-sm rounded-pill\" data-bs-toggle=\"modal\" data-bs-target=\"#modal-game\" 
                onclick=\"updateButton(".$row["j_id"].",'".$row["title"]."',".$row["prix"].",'".$row["date_ajout"]."','".$row["description"]."','".$row["image"]."',".$row["id_cat"].")\">
                <i class=\"fa-regular fa-pen-to-square text-dark \"></i></button>

                <a  href=\"../scripts.php?suppJeu=".$row["j_id"]."\" id=\"deleteclick".$row["j_id"]."\" hidden></a>
            <button  onclick=\"confirmSupp(".$row["j_id"].")\" class=\"btn btn-sm rounded-pill\"><i class=\"fas fa-trash-alt text-secondary\"></i></a></td></tr>";
            }
        }
    ?>

    </tbody>
    </table>




</main>


</div>

    <!-- Modal -->
    <div class="modal fade" id="modal-game">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="../scripts.php" method="POST" id="form-jeu" enctype="multipart/form-data" >
					<div class="modal-header">
						<h5 id="modalTitle" class="text-dark">Ajouter un jeu</h5>
						<a href="#" class="btn-close" data-bs-dismiss="modal"></a>
					</div>
					<div class="modal-body text-dark">
							<input type="hidden" name="jeu-id" id="jeu-id">
							<div class="mb-3">
								<label class="form-label text-dark">Title</label>
								<input type="text" class="form-control" id="jeu-title" name="jeu-title" required/>
							</div>
							<div class="mb-3">
								<label class="form-label text-dark">Date d'ajout</label>
								<input type="date" class="form-control" id="jeu-date" name="jeu-date" required/>
							</div>
                            <div class="mb-3">
								<label class="form-label text-dark">Prix</label>
								<input type="number" step="0.01" class="form-control" id="jeu-prix" name="jeu-prix" required/>
							</div>
                            <div class="mb-3">
								<label class="form-label text-dark">Categorie</label>
								<select class="form-select" id="jeu-categorie" name="jeu-categorie">
									<option value="" class="text-secondary fw-light">Please select</option>            
                                    <?php
                                    /* ===== Afficher seulement les categories qui sont exitées au BD ======== */
                                    $sql="SELECT * FROM categories";
                                    $result=mysqli_query($conn,$sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) { 
                                            echo "<option class=\"text-secondary fw-light\"  value=". $row['id'] ." id=".$row['id'].">".$row['nom']."</option>";
                                        }
                                    }
                                    ?>
								</select>
							</div>
                            <div class="mb-3">
								<label class="form-label text-dark">Image</label>
								<input type="file" class="form-control" id="image" name="image" />
							</div>
							<div class="mb-0">
								<label class="form-label text-dark">Description</label>
								<textarea class="form-control" rows="2" id="jeu-description" name="jeu-description" required></textarea>
							</div>
					</div>
					<div class="modal-footer">
						<a href="#" class="btn btn-dark" data-bs-dismiss="modal">Cancel</a>
						<button type="submit" name="modifJeu" class="btn btn-light task-action-btn" id="btnUpdate">Update</button>
						<button type="submit" name="save" 	class="btn btn-secondary task-action-btn" id="btnSave">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>

    <!-- scripts -->
    <script src="https://kit.fontawesome.com/dbe94a6a5a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script>
// vider les champs lorsqu'on click sur ajouter jeu
document.getElementById('addgame').addEventListener('click', ()=>{
		document.getElementById('form-jeu').reset();
		document.getElementById('btnSave').style.display   = 'block';
		document.getElementById('btnUpdate').style.display = 'none';
});

function updateButton(id, title, prix, date, description ,image ,id_cat){
    
    document.getElementById("modalTitle").innerHTML   = "Modifier le jeu";
    document.getElementById('btnSave').style.display  = 'none';
    document.getElementById('btnUpdate').style.display= 'block';

    document.getElementById("jeu-id").value          = id;
    document.getElementById("jeu-title").value       = title;
    document.getElementById("jeu-prix").value        = prix;
    document.getElementById("jeu-date").value        = date;
    document.getElementById("jeu-description").value = description;

    document.getElementById(id_cat).selected = true;

}

// confirmer la suppression

function confirmSupp($id){
    if(confirm("voulez vous vraiment supprimer ce jeu ?"))
    document.getElementById("deleteclick"+$id).click();
};

        
    </script>
</body>
</html>