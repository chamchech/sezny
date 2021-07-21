<?php
session_start();
include 'db.php';
if(!isset($_SESSION['vendeur_id'])){
    header('location:connexion.php');
}


?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="56x56" href="assets/img/favicon-96x96.png">

    <title>Nos accompagnements Juridique - Abonnement Juridique MEPERY</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="assets/css/album.css" rel="stylesheet">
</head>

<body>
<div id="page">
        <div id="bloc-principal">
        <?php include 'nav.php'; ?>
    <main role="main">
        
        <section class="jumbotron text-center" style="padding:20px">
            <div class="container">
                <h1 class="jumbotron-heading">Nos prestations Juridique</h1>
                <a href="accueil.php"><svg class="bi bi-arrow-bar-left" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M5.854 4.646a.5.5 0 00-.708 0l-3 3a.5.5 0 000 .708l3 3a.5.5 0 00.708-.708L3.207 8l2.647-2.646a.5.5 0 000-.708z" clip-rule="evenodd"/>
  <path fill-rule="evenodd" d="M10 8a.5.5 0 00-.5-.5H3a.5.5 0 000 1h6.5A.5.5 0 0010 8zm2.5 6a.5.5 0 01-.5-.5v-11a.5.5 0 011 0v11a.5.5 0 01-.5.5z" clip-rule="evenodd"/>
</svg> Retour</a>
            </div>
        </section>
        <div class="album py-5 bg-light">
            <div class="container">

 <!-- 
			=============================================
				Service Style Two
			============================================== 
			-->
            <div class="service-style-two section-spacing-abonnement">
            <div class="container">
                <section class="pricing">
                    <div class="container">
                        <div class="row">
                            <!-- Free Tier -->
                            <div class="col-lg-4">
                                <div class="cardformule mb-5 mb-lg-0">
                                    <div class="cardformule-body">
                                        <h6 class="cardformule-price text-center">90€<span class="period">ht/mois</span></h6>
                                        <hr>
                                        <ul class="fa-ul">
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Assistance
                                                juridique</li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Assistance à la rédaction des
                                                documents de ventes (bons de commandes, bon de livraison, factures,
                                                CGV…)</li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Assistance à la rédaction des
                                                actes de sociétés (AGO, AGE…) </li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Recouvrement de
                                                créances </li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Tentative de
                                                règlement amiable des litiges (salariés, clients…) </li>
                                            <li class="text-muted"><span class="fa-li"><i
                                                        class="fas fa-times"></i></span><div class="text_formule">Dépôt de marques et de brevets</div>
                                            </li>
                                            <li class="text-muted"><span class="fa-li"><i
                                                        class="fas fa-times"></i></span><div class="text_formule">Assistance à la rédaction et mise à jour des
                                                            mentions légales</div></li>
                                            <li class="text-muted"><span class="fa-li"><i
                                                        class="fas fa-times"></i></span><div class="text_formule">Assistance à la rédaction des contrats
                                                            commerciaux</div> </li>
                                            <li class="text-muted"><span class="fa-li"><i
                                                        class="fas fa-times"></i></span><div class="text_formule">Assistance à la rédaction des contrats de
                                                            travail </div></li>
                                            <li class="text-muted"><span class="fa-li"><i
                                                        class="fas fa-times"></i></span><div class="text_formule"rike>Mise en relation avec un avocat
                                                            partenaire en cas de procédure judiciaire</div></li>
                                            <li class="text-muted"><span class="fa-li"><i
                                                        class="fas fa-times"></i></span><div class="text_formule">Assistance à la rédaction Chartes de Données
                                                            Personnelles et Cookies</div></li>
                                            <li class="text-muted"><span class="fa-li"><i
                                                        class="fas fa-times"></i></span><div class="text_formule">Assistance à la rédaction Conditions Générales
                                                            d’Utilisation</div> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Plus Tier -->
                            <div class="col-lg-4">
                                <div class="cardformule mb-5 mb-lg-0">
                                    <div class="cardformule-body">
                                        <h6 class="cardformule-price text-center">170€<span class="period">ht/mois</span></h6>
                                        <hr>
                                        <ul class="fa-ul">
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span> Assistance
                                                juridique</li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Assistance à la rédaction des
                                                documents de ventes (bons de commandes, bon de livraison, factures,
                                                CGV…)</li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Assistance à la rédaction des
                                                actes de sociétés (AGO, AGE…) </li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Recouvrement de
                                                créances </li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Tentative de
                                                règlement amiable des litiges (salariés, clients…) </li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Dépôt de marques
                                                et de brevets </li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Assistance à la rédaction et
                                                mise à jour des mentions légales</li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Assistance à la rédaction des
                                                contrats commerciaux </li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Assistance à la rédaction des
                                                contrats de travail </li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Mise en relation
                                                avec un avocat partenaire en cas de procédure judiciaire</li>
                                            <li class="text-muted"><span class="fa-li"><i
                                                        class="fas fa-times"></i></span><div class="text_formule">Assistance à la rédaction Chartes de Données
                                                            Personnelles et Cookies</div></li>
                                            <li class="text-muted"><span class="fa-li"><i
                                                        class="fas fa-times"></i></span><div class="text_formule">Assistance à la rédaction Conditions Générales
                                                            d’Utilisation</div> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Pro Tier -->
                            <div class="col-lg-4">
                                <div class="cardformule">
                                    <div class="cardformule-body">

                                        <h6 class="cardformule-price text-center">250€<span class="period">ht/mois</span></h6>
                                        <hr class="separationcomp">
                                        <ul class="fa-ul">
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span> Assistance
                                                juridique</li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Assistance à la rédaction des
                                                documents de ventes (bons de commandes, bon de livraison, factures,
                                                CGV…)</li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Assistance à la rédaction des
                                                actes de sociétés (AGO, AGE…) </li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Recouvrement de
                                                créances </li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Tentative de
                                                règlement amiable des litiges (salariés, clients…) </li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Dépôt de marques
                                                et de brevets </li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Assistance à la rédaction et
                                                mise à jour des mentions légales</li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Assistance à la rédaction des
                                                contrats commerciaux </li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Assistance à la rédaction des
                                                contrats de travail </li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Mise en relation
                                                avec un avocat partenaire en cas de procédure judiciaire</li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Assistance à la rédaction Chartes
                                                de Données Personnelles et Cookies</li>
                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Assistance à la rédaction
                                                Conditions Générales d’Utilisation </li>
                                        </ul>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>



               
            </div>

        </div> <!-- fin service-style-two section-spacing-abonnement -->
  

            </div>
        </div>

    </main>
    <?php include 'footer.php'; ?>

       
</div>

    </div><!-- fin page -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/vendor/holder.min.js"></script>

    <script src="js/contenu-cacher.js"></script>
</body>

</html>