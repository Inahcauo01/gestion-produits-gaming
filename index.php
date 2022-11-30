<?php include 'scripts.php';
$titlePage = 'ORIGIN GAMER';
include 'assets/components/head.php';
?>



<body>
    <header id="first-view">
        <nav class="navbar navbar-expand-sm bg-transparent navbar-dark">
            <div class="container-fluid">
                <a href="index.php" class="navbar-brand nav-link logo col-4"><h3 class="logo">ORIGIN GAMER</h3></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav col-6">
                        <li class="nav-item">
                            <a class="nav-link fw-light" href="#jeux">Jeux</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-light" href="#">Contactez nous</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-light" href="#">Apropos de nous</a>
                        </li>   
                    </ul>
                    <div class="col-6 d-flex justify-content-end align-items-center">
                        <?php buttons() ?>
                        
                    </div>
                </div>
            </div>
        </nav>

        <?php
        if(isset($_SESSION["msg"])){
            echo '<div class="alert alert-secondary alert-dismissible fade show id="alert-session" role="alert">
            '.$_SESSION["msg"].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            unset($_SESSION["msg"]);
        }
        ?>

        <div class="first-title col-6">
            <h1 class="glow">CHALLENGE YOURSELF <br>AND LET THE GAME BEGIN ...</h1>
            <p>Le site numero un , pour mieux vous servir de trouver les meilleurs jeux videos</p>
            
        </div>
        <div class="my-5 ms-4">
            <!-- < ?php
                if(!isset($_POST["username"])){
                    echo '';
                }else
                echo '';
            ?> -->
            <span class="btn btn-primary rounded-pill px-5 light sinscrire"><?php
                if(!isset($_POST["username"])){
                    echo "s'inscrire";
                }else
                echo '';?></span>
            
            <span class="btn btn-light border rounded-pill px-5 light">commencer</span>
        </div>
        <!-- personaisation du curseur -->
        <div class="cursor-in"></div>
        <div class="cursor-out"></div>
    </header>
    <div class="background-image"></div>
    <main>
        <h1 class="grand-titre titre-steps">Pourquoi ORIGIN GAMER</h1>
        <div class="container-fluid mt-5 text-center mb-5" id="steps">
            <div class="row">
              <div class="col-sm-4">
                <i class="fa-solid fa-gamepad text-dark fa-6x mb-4"></i>
                <p>+100 Jeux videos disponibles</p>
              </div>
              <div class="col-sm-4">
                <i class="fa-regular fa-circle-check text-dark fa-6x mb-4"></i>
                <p>La confiance des clients et leurs satisfaction sont notre objectif</p>
              </div>
              <div class="col-sm-4">
                <i class="fa-solid fa-display text-dark fa-6x mb-4"></i>
                <p>Pour tous les consoles (Xbox, PlayStaion, PC ...)</p>
              </div>
            </div>
          </div>
    </main>
    <article class="container my-5">
        <h1 class="grand-titre">Les categories</h1>
        <!-- La liste des categories -->
        <div class="d-flex row justify-content-around">
            <?php
            $sql    = "select * from categories limit 5";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    echo "<div class=\"categorie-cell\">".$row["nom"]."</div>";
                }
            }
            ?>
            <div class="categorie-cell">Voir plus</div>
        </div>
    </article>

    <section class="container mb-4" id="jeux">
        <h1 class="grand-titre">Les jeux recemment ajout&eacutes</h1>
        <!-- Les cartes des jeux -->
        <div class="d-flex row">
            <?php
                $sql    = "select j.id j_id,title,image,prix,date_ajout,id_cat, c.id,nom, description from jeux j, categories c where j.id_cat=c.id order by date_ajout desc limit 3";
                $result = mysqli_query($conn,$sql);

                if (mysqli_num_rows($result) > 0) {    
                    while($row = mysqli_fetch_assoc($result)) {
                        $image = (!empty($row['image'])) ? 'assets/uploads/'.$row["image"] : 'assets/image/aucune.jpg';
                        ?>

                <div class="col-lg-4 my-4">
                    <div class="card">
                        <img class="card-img-top" src="<?php echo $image ?>" alt="<?php echo $row["title"] ?>">
                        <span class="date"><?php echo $row["date_ajout"] ?></span>
                        <div class="card-body">
                            <small><?php echo $row["nom"] ?></small>
                            <h2><?php echo $row["title"] ?></h2>
                            <p class="card-text"><?php echo $row["description"] ?></p>
                        </div>
                    </div>
                </div>
            <?php
            }}
            ?>
                <!-- <div class="col-sm-4 my-4">
                    <div class="card">
                        <img class="card-img-top" src="assets/image/huntshowdown.jpg" alt="nom-jeu">
                        <span class="date">14/02/2022</span>
                        <div class="card-body">
                            <small>Xbox</small>
                            <h2>Hunt showdown</h2>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-4 my-4">
                    <div class="card">
                        <img class="card-img-top" src="assets/image/the witcher.jpeg" alt="nom-jeu">
                        <span class="date">01/02/2022</span>
                        <div class="card-body">
                            <small>Playstation</small>
                            <h2>The Witcher</h2>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        
                    </div>
                </div>

                <div class="col-sm-4 my-4">
                    <div class="card">
                        <img class="card-img-top" src="assets/image/pes.jpg" alt="nom-jeu">
                        <span class="date">14/02/2021</span>
                        <div class="card-body">
                            <small>PC</small>
                            <h2>PES</h2>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        
                    </div>
                </div>-->
                
        </div> 
        <a href="#" class="btn btn-primary">Voir plus</a>
    </section>
    
    <!-- Form authentification-->
    <div class="popup-form">
        <!-- inscription form -->
        <form action="scripts.php" method="POST" class="login-form col-6" id="formSignup" data-parsley-validate >
            <h2>Creer un compte</h2>
            <input class="input-index" name="usernameSignup" placeholder="Nom complet" type="text" data-parsley-minlength="3" required>
            <input class="input-index" name="emailSignup" placeholder="Email" type="email" data-parsley-type="email" required>
            <input class="input-index" name="pwdSignup" placeholder="mot de passe" type="password" id="pwd" data-parsley-minlength="4" required>
            <input class="input-index" name="cpwdsignup" placeholder="Confirmer le mot de passe" type="password" data-parsley-equalto="#pwd" required>

            <br><button class="btn btn-primary rounded-pill" type="submit" name="signUp">s'inscrire</button>
        </form>
        <!-- connection form -->
        <form action="scripts.php" method="POST" class="sign-form col-6 d-flex flex-column justify-content-between align-items-center"> 
            <h2>Se connecter</h2>
            <span class="close align-self-end"><i class="fa-regular fa-circle-xmark fa-2x"></i></span>
            <div>
                <input class="input-index" name="emailSignin" id="emailSignin" placeholder="Email" type="email" class="mb-3" required>
                <i class="fa-solid fa-circle-xmark text-danger erreur"></i>
                <input class="input-index" name="pwdSignin" placeholder="mot de passe" type="password" required>
                <i class="fa-solid fa-circle-xmark text-danger erreur"></i>
            </div>
            <button class="btn btn-primary rounded-pill" type="submit" name="signIn">se connecter</button>
            
            <span class="alert-erreur">erreur</span>
        </form>


        <div class="slide-form d-flex flex-column justify-content-center align-items-center">
            <h3 id="slide-title">Avez vous deja un compte ?</h3>
            <button class="btn btn-light" id="btn-slide">se connecter</button>
        </div>
    </div>



    <!-- retour vers le haut -->
    <div class="text-center haut">
    <a href="#first-view"><i class="fa-solid fa-chevron-up text-dark fa-2x"></i><br>
    <small class="text-dark txt-haut">Aller vers le haut</small></a>
    </div>

    <!--Footer-->
      <div class="mt-3 p-4 bg-dark text-white">
        <div class="container">
            <div class="">
                <h3 class="logo">ORIGIN GAMER</h3>
            </div>
            <div class="row mb-5">
                <div class="col-sm-6">
                  <h6>Informations utiles</h6>
                  <a href="#"><i class="fas fa-question-circle"></i> Qui sommes-nous ?</a><br>
                  <a href="#"><i class="fas fa-info-circle"></i> Besoin d'aide ?</a><br>
                  <a href="#"><i class="far fa-envelope"></i> Contacter nous</a><br>
                </div>
                <div class="col-sm-6">
                  <h6>Reseaux sociaux</h6>
                  <a href="#"><i class="fab fa-facebook-square p-1"></i></a>
                  <a href="#"><i class="fab fa-whatsapp p-1"></i></a>
                  <a href="#"><i class="fab fa-instagram p-1"></i></a>
                  <a href="#"><i class="fab fa-google p-1"></i></i></a>
                  <a href="#"><i class="fab fa-twitter p-1"></i></a>
                </div>
            </div>
            <div class="row text-center mt-3">
                <span><small>Designed By <a href="mailto:tarek.ouachani01@gmail.com">TAREK Inahcauo</a></small></span>
            </div>
      </div>  
    </div>


    <!-- scripts -->
    <script src="assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>