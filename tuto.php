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

    <title>Tutoriel - Abonnement Juridique MEPERY</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

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
                <h1 class="jumbotron-heading">Tutoriel</h1>
                <a href="profil.php"><svg class="bi bi-arrow-bar-left" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M5.854 4.646a.5.5 0 00-.708 0l-3 3a.5.5 0 000 .708l3 3a.5.5 0 00.708-.708L3.207 8l2.647-2.646a.5.5 0 000-.708z" clip-rule="evenodd"/>
  <path fill-rule="evenodd" d="M10 8a.5.5 0 00-.5-.5H3a.5.5 0 000 1h6.5A.5.5 0 0010 8zm2.5 6a.5.5 0 01-.5-.5v-11a.5.5 0 011 0v11a.5.5 0 01-.5.5z" clip-rule="evenodd"/>
</svg> Retour</a>
            </div>
        </section>
        <div class="album py-5 bg-light">
            <div class="container">

             <!-- DEBUT PANEL BOUTON -->
             <div class="container-fluid">
                                <div class="row">
                                <div class="col-md-3 col-sm-4 col-6">
                                            <button type="submit" id="entrervente" class="btn btn-primary buttons buton-select-C" value="div1">FAIRE UNE VENTE</button>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-6">
                                            <button type="submit" id="consultvente" class="btn btn-success buttons buton-select-C" value="div2">SIGNER UNE VENTE</button>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-6">
                                            <button type="submit" id="contactadmin" class="btn btn-info buttons buton-select-C" value="div3">VOS VENTES</button>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-6">
                                            <button type="submit" id="entrervente" class="btn btn-secondary buttons buton-select-C" value="div4">PROFIL</button>
                                    </div>
                                </div>
                            </div>
                            <!-- FIN PANEL BOUTON -->
            <div>

<!-- DEBUT AJOUT VENTES -->
<div id="div1" style="display:none">
<h2 style="font-size:24px;margin-top:3%;text-align: center;">Réaliser une vente</h2>
<p>Pour réaliser une vente, vous devez cliquer sur le bouton "Ajouter une vente"</p>
<p>Une nouvelle page va s'ouvrir avec un formulaire. Vous devez remplir le formulaire. Tout les champs sont obligatoires. Vous devez remplir le formulaire avec les informations du client. Faite attention de remplir un numéro de téléphone que possède le client, il y'en aura besoin pour signer le contrat. Une fois le formulaire rempli, vous devez prendre en photo via votre tablette les 3 pièces jointes obligatoire. Pour terminer, vous devez valider les Conditions Générales de Ventes (le texte passe en vert quand c'est validé).</p>
<p>Voici un exemple vidéo : </p>
<video src="tuto/faire-vente.webm" width=520  height=340 controls poster="tuto/faire-vente.png">
</video>
</div>
<!-- FIN AJOUT VENTES -->

<!-- DEBUT AJOUT VENTES -->
<div id="div2" style="display:none">
<h2 style="font-size:24px;margin-top:3%;text-align: center;">Signer une vente</h2>
<p>Vous venez de réaliser le contrat. Plus qu'une étape, la signature du contrat.</p>
<p>Une fois le formulaire valider, vous arrivez sur une page avec la liste de vos ventes non signés. Pour la signer, c'est très simple il vous suffit de cliquez sur le bouton vert "Signer".</p>
<p>Vous arrivez alors sur une page montrant le contrat générer avec les informations du client. Vérifiez que les informations sont correctes et montrez le contrat au client. Une fois que le client à visualiser le contrat vous pouvez le signer en cliquant sur le bouton vert "Signer"</p>
<p>Le client reçoit alors un code sms sur son téléphone. Il suffit de rentrer le code.</p>
<p>Pour la signature 2 options. Vous avez le nom et le prénom du client en texte, vous pouvez également faire dessiner la signature au client.</p>
<p>Voici un exemple vidéo : </p>
<video src="tuto/signer-vente.webm" width=520  height=340 controls poster="tuto/signer-vente.png"> 
</video>
</div>
<!-- FIN AJOUT VENTES -->


<!-- DEBUT STATISTIQUES VENTES -->
<div id="div3" style="display:none">
<h2 style="font-size:24px;margin-top:3%;text-align: center;">Voir vos clients</h2>
<p>Dans cet espace, vous retrouverez la liste de vos clients.</p>
<p>Vous pouvez avoir plus de détails et télécharger le contrat du client en cliquant sur le bouton "Voir détails".</p>
<p>Voici un exemple vidéo : </p>
<video src="tuto/nos-vente.webm" width=520  height=340 controls poster="tuto/nos-ventes.png"> 
</video>
</div>
<!-- FIN STATISTIQUES VENTES -->


<!-- DEBUT INFORMATIONS -->
<div id="div4" style="display:none">
<h2 style="font-size:24px;margin-top:3%;text-align: center;">Modifier son mot de passe</h2>
<p>Dans votre profil, vous retrouverez vos informations.</p>
<p>Vous pouvez également changer votre mot de passe. Pour ce faire, vous devez cliquer sur le bouton "modifier son mot de passe". Les deux champs doivent être identiques.</p>
<p>Voici un exemple vidéo : </p>
<video src="tuto/profil.webm" width=520  height=340 controls poster="tuto/profil.png"> 
</video>
</div>
<!-- FIN INFORMATIONS -->

</div><!-- FIN CONTENU CACHER -->    

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