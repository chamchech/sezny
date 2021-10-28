<?php
require_once './db.php';
session_start();
if (!isset($_SESSION['vendeur_id'])) {
    header("location:connexion.php");
}
$stmt1 = $sql->prepare("SELECT * FROM vendeurs where id = ?");
$stmt1->bindParam(1, $_SESSION['vendeur_id'], PDO::PARAM_INT);
$stmt1->execute();
$result = $stmt1->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<header>
    <meta charset="UTF-8">
    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- For Resposive Device -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- For Window Tab Color -->
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#151515">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#151515">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#151515">
    <!-- Meta Description -->
    <meta name="robots" content="noindex">
    <title>Vente Part - SEZNY</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="56x56" href="assets/img/favicon-96x96.png">
    <!-- Main style sheet -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/form.css">
    <!-- responsive style sheet -->
    <link rel="stylesheet" type="text/css" href="css/testresponsive.css">
    <!-- Theme-Color css -->
    <link rel="stylesheet" id="jssDefault" href="css/color.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
</header>

<body>
<div class="main-page-wrapper">
    <!-- -------------------------------------------------------------------------- titre -->
    <div class="parallax-inscription section-spacing">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <h2>Vente Particulier</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- -------------------------------------------------------------------------- Formulaire d'inscription -->
    <div class="inscription-us-page section-spacing-inscription">
        <div class="container">
            <form enctype="multipart/form-data" method="post" action="pdf/bc-particulier.php"
                  class="theme-form-one form-validation">
                <input type="hidden" name="date" value="<?php echo date("d / m / Y"); ?>">
                <br/>

                <center><h3 class="liltitle" style="margin-top: 50px">Vente Produit et Prestation</h3></center>

                <div class="formProduit form-group w-50">
                    <div class="form-check form-switch ">
                        <input class="form-check-input " type="checkbox" id="pack1" checked disabled>
                        <label class="form-check-label" for="pack1">Un gestionnaire d'Energie pour
                            résidence principale.
                            Inclus le suivi et le controle de consommation à
                            distance (eau, gaz et éléctiricité)</label>
                    </div>
                    <div class="form-check form-switch">
                        <div>
                            <input class="form-check-input" type="checkbox" id="packautre" name="autredesignation"
                                   onclick="ChangePack()">
                            <label class="form-check-label" for="packautre">Autre</label>
                        </div>
                        <div id="dynamicFormPack" style="display: none">
                            <input id="autreInput" type="text" placeholder="Préciser" name="autre"
                                   class="call-back-form-one"></div>
                    </div>
                </div>
                <center><h3 class="liltitle">Lieu de commande</h3></center>
                <div class="row commandeInfo">
                    <div class="col">
                        <div class="form-info">
                            <input type="radio" class="btn-check call-back-form-one" value="Domicile"
                                   name="lieucommande" id="btn-check-outlined" autocomplete="off">
                            <label class="btn btn-outline-primary btnlieu" for="btn-check-outlined">Domicile</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-info">
                            <input type="radio" class="btn-check call-back-form-one" value="Siège"
                                   name="lieucommande" id="btn-check-2-outlined" autocomplete="off">
                            <label class="btn btn-outline-primary btnlieu" for="btn-check-2-outlined">Siège</label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-info">
                            <input type="radio" class="btn-check call-back-form-one" value="Autre"
                                   name="lieucommande" id="btn-check-3-outlined" autocomplete="off">
                            <label class="btn btn-outline-primary btnlieu" for="btn-check-3-outlined">Autre</label>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12 form-group">
                        <label>Ville</label>
                        <input type="text" placeholder="Ville" name="lieucommande"
                               class="call-back-form-one" required>
                    </div>
                </div>
                <center><h3 class="liltitle">En réunion </h3>
                    <div class="row formInscription">
                        <div class="col-lg-6 col-12">
                            <div class="form-info">
                                <input type="radio" class="btn-check call-back-form-one" value="Oui"
                                       name="enreunion" id="repoui" onclick="ChangeReunion()" autocomplete="off">
                                <label class="btn btn-outline-primary btnlieu" for="repoui">Oui</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-info">
                                <input type="radio" class="btn-check call-back-form-one" id="repnon" name="enreunion"
                                       value="Non">
                                <label class="btn btn-outline-primary btnlieu" for="repnon">Non</label>
                            </div>
                        </div>
                        <div id="dynamicFormReunion" style="display: none">
                            <label class="form-check-reunion" for="case_info3">Si oui nom de l'hote</label>
                            <input class="call-back-form-one" placeholder="Nom de l'hote" type="text"
                                   name="nomdehote" id="inputHote">
                        </div>
                    </div>
        </div>
        <div class="row formInscription">
            <div class="col-lg-12 col-12 form-group w-50">
                <!--
                <div class="row">
                   <div class="col-lg-6 col-12 form-group">-->
                <!--<label>Raison social</label>
                <input type="text" placeholder="Mepery" id="raisonsocialverif" name="raisonsocial" class="call-back-form-one " required>-->

                <!--  <select name="drop1" required="" style="width: 100%;     background: #f7f7f7;
                                                                                border: 1px solid #e4e4e4;
                                                                                margin-bottom: 20px;
                                                                                font-size: 14px;
                                                                                font-style: italic;
                                                                                padding: 10px;">
                       <option> 12 mois</option>
                       <option> 24 mois</option>
                   </select>

               </div>
               <div class="col-lg-6 col-12 form-group">
-->
                <!--<label>RCS</label>
                <input type="text" placeholder="123456789" id="rcsverif" name="rcs" class="call-back-form-one" pattern="[0-9]{3}[ \.\-]?[0-9]{3}[ \.\-]?[0-9]{3}" required>-->
                <!--    <select name="drop2" required="" style="width: 100%;
background: #f7f7f7;
border: 1px solid #e4e4e4;
margin-bottom: 20px;
font-size: 14px;
font-style: italic;
padding: 10px;">

                        <option> 90€/mois</option>

                        <option> 170€/mois</option>
                        <option> 250€/mois</option>
                    </select>
                </div>
            </div>
            -->
                <!--   <div class="row">
                       <div class="col-lg-6 col-12 form-group">
                           <label>Raison social</label>
                           <input type="text" placeholder="Mepery" id="raisonsocialverif" name="raisonsocial"
                                  class="call-back-form-one " required>
                       </div>
                       <div class="col-lg-6 col-12 form-group">
                           <label>RCS</label>
                           <input type="text" placeholder="123456789" id="rcsverif" name="rcs"
                                  class="call-back-form-one" pattern="[0-9]{3}[ \.\-]?[0-9]{3}[ \.\-]?[0-9]{3}"
                                  required>
                       </div>
                   </div> -->
                <center>
                    <h3 class="liltitle">Informations Contact</h3>
                </center>
                <br>
                <div class="row formInscription">
                    <div class="col-lg-6 col-12 form-group">
                        <label>Prénom Contact</label>
                        <input type="text" placeholder="Votre Prénom" name="prenomcontact"
                               class="call-back-form-one" required>
                    </div>
                    <div class="col-lg-6 col-12 form-group">
                        <label>Nom Contact</label>
                        <input type="text" placeholder="Votre Nom" name="nomcontact" class="call-back-form-one"
                               required>
                    </div>
                </div>
                <div class="row formInscription">
                    <div class="col-lg-6 col-12 form-group">
                        <label>Numéro de téléphone (portable)</label>
                        <input type="text" placeholder="0601020304" name="tel" class="call-back-form-one"
                               pattern="[0-9]{2}[ \.\-]?[0-9]{2}[ \.\-]?[0-9]{2}[ \.\-]?[0-9]{2}[ \.\-]?[0-9]{2}[ \.\-]?"
                               required>
                    </div>
                    <div class="col-lg-6 col-12 form-group">
                        <label>Adresse Email</label>
                        <input type="text" placeholder="votreadresse@email.com" id="mailverif" name="email"
                               class="call-back-form-one"
                               pattern="[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})"
                               required>
                    </div>
                </div>
            </div>
            <div class="row formInscription">
                <div class="col-lg-4 col-12 form-group">
                    <label>Adresse</label>
                    <input type="text" placeholder="90 bis Chemin St Jean" class="call-back-form-one" name="adresse"
                           required>
                </div>
                <div class="col-lg-3 col-12 form-group">
                    <label>Code Postal</label>
                    <input type="text" placeholder="31770" name="cp" class="call-back-form-one"
                           pattern="[0-9]{2,3}[ \.\-]?[0-9]{3}" required>
                </div>
                <div class="col-lg-4 col-12 form-group">
                    <label>Ville</label>
                    <input type="text" placeholder="Colomiers" class="call-back-form-one" name="ville" required>
                </div>
            </div>

            <h3 class="liltitle">Situation familiale</h3>

            <div class="row commandeInfo">
                <div class="col">
                    <div class="form-info">
                        <input type="radio" class="btn-check call-back-form-one" value="Marié"
                               name="situation" id="btn-check-outlined-situation" onclick="Change()" autocomplete="off">
                        <label class="btn btn-outline-primary btnlieu" for="btn-check-outlined-situation">Marié</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-info">
                        <input type="radio" class="btn-check call-back-form-one" id="btn-check-outlined-situation2"
                               name="situation"
                               value="Célibataire">
                        <label class="btn btn-outline-primary btnlieu"
                               for="btn-check-outlined-situation2">Celibataire</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-info">
                        <input type="radio" class="btn-check call-back-form-one" id="btn-check-outlined-situation3"
                               name="situation"
                               value="Pacsé">
                        <label class="btn btn-outline-primary btnlieu" for="btn-check-outlined-situation3">Pacsé</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-info">
                        <input type="radio" class="btn-check call-back-form-one" id="btn-check-outlined-situation4"
                               name="situation"
                               value="Veuf">
                        <label class="btn btn-outline-primary btnlieu" for="btn-check-outlined-situation4">Veuf</label>
                    </div>
                </div>
            </div>
            <div id="dynamicForm">
                <h3 class="liltitle">Deuxieme titulaire de contract</h3>

                <br>
                <div class="row formInscription">
                    <div class="col-lg-6 col-12 form-group">
                        <label>Prénom</label>
                        <input type="text" placeholder="Votre Prénom" name="prenomtitulaire"
                               class="call-back-form-one">
                    </div>
                    <div class="col-lg-6 col-12 form-group">
                        <label>Nom</label>
                        <input type="text" placeholder="Votre Nom" name="nomtitulaire"
                               class="call-back-form-one">
                    </div>
                </div>
            </div>
            <h3 class="liltitle">Adresse de l'installation si différente</h3>

            <div class="row formInscription">
                <div class="col-lg-4 col-12 form-group">
                    <label>Adresse</label>
                    <input type="text" placeholder="90 bis Chemin St Jean" class="call-back-form-one"
                           name="adressetitulaire">
                </div>
                <div class="col-lg-3 col-12 form-group">
                    <label>Code Postal</label>
                    <input type="text" placeholder="31770" name="cptitulaire" class="call-back-form-one"
                           pattern="[0-9]{2,3}[ \.\-]?[0-9]{3}">
                </div>
                <div class="col-lg-4 col-12 form-group">
                    <label>Ville</label>
                    <input type="text" placeholder="Colomiers" class="call-back-form-one"
                           name="villetitulaire">
                </div>
            </div>

            <h3 class="liltitle">Mode de règelement</h3>

            <div class="row modecredit">
                <div class="card text-center">
                    <h5 class="card-header">Comptant 2990€</h5>
                    <div class="card-body">
                        <p class="card-text">Condition de réglement : 40% à l'expiration du délai de rétractation et 60% lors de la signature du PV d'installation, soit le jour de la livraison, par chéque à ordre de Sezny</p>
                        <div class="col">
                            <div class="form-info">
                                <input type="radio" class="btn-check call-back-form-one" value="Comptant 2990€ Condition de réglement : 40% à l'expiration du délai de rétractation et 60% lors de la signature du PV d'installation, soit le jour de la livraison, par chéque à ordre de Sezny"
                                       name="methodePaie" id="btn-check-comptant-outlined" autocomplete="off">
                                <label class="btn btn-outline-primary finExpress" for="btn-check-comptant-outlined">Choisir</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card text-center">
                    <h5 class="card-header">Financement par notre partenaire SOFINCO</h5>
                    <div class="card-body">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        12 Mois
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="tab-pane fade show active" id="fin" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <div class="col-sm tableFin">
                                                <!-- Tab panes -->
                                                <div class="tab-content">
                                                    <table class="table table-bordered" style="text-align: center">
                                                        <thead>
                                                        <tr class="table-primary">
                                                            <th scope="col">Mensualités hors assurance</th>
                                                            <th scope="col">Mensualités avec assurance</th>
                                                            <th scope="col">Taeg</th>
                                                            <th scope="col">Cout total hors assurance</th>
                                                            <th scope="col">Cout total avec assurance</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th scope="row">261,23</th>
                                                            <td>264.94</td>
                                                            <td>7,90</td>
                                                            <td>3134,76</td>
                                                            <td>3179,28</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-info">
                                                <input type="radio" class="btn-check call-back-form-one" value="Financement par notre partenaire SOFINCO en 12 Mois : Mensualités hors assurance : 261,23€ Mensualités avec assurance : 264,94€ Taeg : 7.90% Cout total hors assurance : 3134,76€ Cout total avec assurance : 3179,28€"
                                                       name="methodePaie" id="btn-check-fin-outlined" autocomplete="off">
                                                <label class="btn btn-outline-primary finExpress" for="btn-check-fin-outlined">Choisir</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        24 Mois
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="tab-pane fade show active" id="fin2" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="col-sm">
                                                <!-- Tab panes -->
                                                <div class="tab-content">
                                                    <table class="table table-bordered" style="text-align: center">
                                                        <thead>
                                                        <tr class="table-primary">
                                                            <th scope="col">Mensualités hors assurance</th>
                                                            <th scope="col">Mensualités avec assurance</th>
                                                            <th scope="col">Taeg</th>
                                                            <th scope="col">Cout total hors assurance</th>
                                                            <th scope="col">Cout total avec assurance</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th scope="row">134,20</th>
                                                            <td>137,91</td>
                                                            <td>6,90</td>
                                                            <td>3220,80</td>
                                                            <td>3309,84</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-info">
                                                <input type="radio" class="btn-check call-back-form-one" value="Financement par notre partenaire SOFINCO en 24 Mois : Mensualités hors assurance : 134,20€ Mensualités avec assurance : 137,91€ Taeg : 6.90% Cout total hors assurance : 3220,80€ Cout total avec assurance : 3309,84€"
                                                       name="methodePaie" id="btn-check-fin2-outlined" autocomplete="off">
                                                <label class="btn btn-outline-primary finExpress" for="btn-check-fin2-outlined">Choisir</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                        36 Mois
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="tab-pane fade show active" id="fin3" role="tabpanel" aria-labelledby="contact-tab">
                                            <div class="col-sm">
                                                <!-- Tab panes -->
                                                <div class="tab-content">
                                                    <table class="table table-bordered" style="text-align: center">
                                                        <thead>
                                                        <tr class="table-primary">
                                                            <th scope="col">Mensualités hors assurance</th>
                                                            <th scope="col">Mensualités avec assurance</th>
                                                            <th scope="col">Taeg</th>
                                                            <th scope="col">Cout total hors assurance</th>
                                                            <th scope="col">Cout total avec assurance</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th scope="row">92,41</th>
                                                            <td>96,12</td>
                                                            <td>6,90</td>
                                                            <td>3326,76</td>
                                                            <td>3460,32</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-info">
                                                <input type="radio" class="btn-check call-back-form-one" value="Financement par notre partenaire SOFINCO en 36 Mois : Mensualités hors assurance : 92,41€ Mensualités avec assurance : 96,12€ Taeg : 6.90% Cout total hors assurance : 3326,76€ Cout total avec assurance : 3460,32€"
                                                       name="methodePaie" id="btn-check-fin3-outlined" autocomplete="off">
                                                <label class="btn btn-outline-primary finExpress" for="btn-check-fin3-outlined">Choisir</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                        48 Mois
                                    </button>
                                </h2>
                                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="tab-pane fade show active" id="fin4" role="tabpanel" aria-labelledby="contact-tab">
                                            <div class="col-sm">
                                                <!-- Tab panes -->
                                                <div class="tab-content">
                                                    <table class="table table-bordered" style="text-align: center">
                                                        <thead>
                                                        <tr class="table-primary">
                                                            <th scope="col">Mensualités hors assurance</th>
                                                            <th scope="col">Mensualités avec assurance</th>
                                                            <th scope="col">Taeg</th>
                                                            <th scope="col">Cout total hors assurance</th>
                                                            <th scope="col">Cout total avec assurance</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th scope="row">71,57</th>
                                                            <td>75,28</td>
                                                            <td>6,90</td>
                                                            <td>3435,36</td>
                                                            <td>3613,44</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-info">
                                                <input type="radio" class="btn-check call-back-form-one" value="Financement par notre partenaire SOFINCO en 48 Mois : Mensualités hors assurance : 71,57€ Mensualités avec assurance : 75,28€ Taeg : 6.90% Cout total hors assurance : 3435,36€ Cout total avec assurance : 3613,44€"
                                                       name="methodePaie" id="btn-check-fin4-outlined" autocomplete="off">
                                                <label class="btn btn-outline-primary finExpress" for="btn-check-fin4-outlined">Choisir</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingFive">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                        60 Mois
                                    </button>
                                </h2>
                                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="tab-pane fade show active" id="fin5" role="tabpanel" aria-labelledby="contact-tab">
                                            <div class="col-sm">
                                                <!-- Tab panes -->
                                                <div class="tab-content">
                                                    <table class="table table-bordered" style="text-align: center">
                                                        <thead>
                                                        <tr class="table-primary">
                                                            <th scope="col">Mensualités hors assurance</th>
                                                            <th scope="col">Mensualités avec assurance</th>
                                                            <th scope="col">Taeg</th>
                                                            <th scope="col">Cout total hors assurance</th>
                                                            <th scope="col">Cout total avec assurance</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th scope="row">59,10</th>
                                                            <td>62,81</td>
                                                            <td>6,90</td>
                                                            <td>3546,00</td>
                                                            <td>3768,60</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-info">
                                                <input type="radio" class="btn-check call-back-form-one" value="Financement par notre partenaire SOFINCO en 60 Mois : Mensualités hors assurance : 59,10€ Mensualités avec assurance : 62,81€ Taeg : 6.90% Cout total hors assurance : 3546,00€ Cout total avec assurance : 3768,60€"
                                                       name="methodePaie" id="btn-check-fin5-outlined" autocomplete="off">
                                                <label class="btn btn-outline-primary finExpress" for="btn-check-fin5-outlined">Choisir</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <h3 class="liltitle">Acceptation du client</h3>

        <div class="formProduit form-group">
            <div class="form-check form-switch ">
                <input class="form-check-input " type="checkbox" id="cond1">
                <label class="form-check-label" for="cond1">Je reconnais avoir pris connaissance des conditions
                    générales de vente figurant en annexes de ce bon de commande et le
                    document d’informations précontractuelles, dont j’ai reçu un exemplaire.</label>
            </div>
            <div class="form-check form-switch">
                <div>
                    <input class="form-check-input" type="checkbox" id="cond2">
                    <label class="form-check-label" for="cond2">Je reconnais accepter l’ensemble des dites
                        conditions générales de vente.</label>
                </div>
            </div>
            <div class="form-check form-switch">
                <div>
                    <input class="form-check-input" type="checkbox" id="cond3">
                    <label class="form-check-label" for="cond3">Je reconnais être informé de mon droit de
                        rétractation selon l’Art du code de la consommation. Je suis informé(e) que j’ai la
                        possibilité d’annuler librement le présent bon de commande dans les 15 jours suivant la
                        signature.</label>
                </div>
            </div>
            <div class="form-check form-switch">
                <div>
                    <input class="form-check-input" type="checkbox" id="cond4">
                    <label class="form-check-label" for="cond4">J’accepte le principe de signature à distance, je
                        confirme mon consentement plein et entier à signer le présent contrat.</label>
                </div>
            </div>
            <div class="form-check form-switch">
                <div>
                    <input class="form-check-input" type="checkbox" id="cond5">
                    <label class="form-check-label" for="cond5">Je souhaite bénéficier d’une installation immédiate
                        de ma commande et accepte de fait à renoncer à mon délai de
                        rétractation. En cochant cette case je ne pourrai plus faire valoir mes droits au
                        renoncement une fois installé.</label>
                </div>
            </div>

        </div>
    </div>

</div>
<!--   <center>
       <h2>Informations de paiement</h2>
   </center>
   <br>

   <div class="row">
       <div class="col-lg-6 col-12 form-group">
           <label>BIC</label>
           <input type="text" placeholder="Votre BIC" name="bic" class="call-back-form-one" required>
       </div>
       <div class="col-lg-6 col-12 form-group">
           <label>IBAN</label>
           <input type="text" placeholder="Votre IBAN" id="iban" name="iban" class="call-back-form-one"
                  required>
       </div>
   </div>
--><br>

<div class="row formInscription ">
    <div class="col-lg-12 col-12 form-group">

        <p class="pj" style="color:#424242;">Veuillez joindre le <strong>RIB</strong> :
            <label><input type="hidden" name="MAX_FILE_SIZE" value="2000000000">
                <input id="input-validation" type="file" name="validerib" required></label></p>
        <p class="pj" style="color:#424242;">Veuillez joindre votre <strong>CNI</strong> :
            <label><input type="hidden" name="MAX_FILE_SIZE" value="2000000000">
                <input id="input-validation" type="file" name="valideiban" required></label></p>
        <p class="pj" style="color:#424242;">Veuillez joindre votre <strong>justificatif de
                domicile</strong> :
            <label><input type="hidden" name="MAX_FILE_SIZE" value="2000000000">
                <input id="input-validation" type="file" name="validekbis" required></label></p>

        <p><input id="field_terms" type="checkbox" name="terms" required="required">
            <label for="field_terms"><b>J'ai lu et j'accepte les <a href="dossier/Mepery_CGV.pdf"
                                                                    target="_blank"
                                                                    style="color:#424242;">conditions
                        générales de vente</b></a> :</label></p>
        <p><i>Tout les champs sont obligatoires</i></p>
    </div>
</div>

<style type="text/css">
    input[type="checkbox"]:required:invalid + label {
        color: red;
    }

    input[type="checkbox"]:required:valid + label {
        color: green;
    }
</style>
<div class="row justify-content-md-center">
    <div class="col-md-auto">
        <a href="index.php">
            <button type="button" class="btn btn-danger btn-lg btnannul">Annuler</button>
        </a>
    </div>
    <div class="col-md-auto">

    </div>
    <div class="col-md-auto">
        <input type="submit" name="valideinscription" id="valide" class="btn btn-primary btn-lg btnvalid"
               value="Continuer">
    </div>
</div>
</form>
</div>
</div>
<br>
</body>

<footer class="theme-footer-one">
    <div class="container">
        <div class="top-footer">
            <div class="logo">
                <a href="https://sezny.fr/"><img src="images/seznyTrvector.png" alt="logo"
                                                 class="logofooter"></a>
            </div>
        </div> <!-- /.top-footer -->
    </div> <!-- /.container -->

    <div class="bottom-footer">
        <div class="row">
            <div class="col-sm-3">
                <p>RCS : 831 892 443</p>
            </div>
            <div class="col-sm-2">
                <p class="footer-text" style="text-align:center;">© <a class="lienSezny"
                                                                       href="https://sezny.fr/">Sezny</a>
                    2021</p>
            </div>
            <div class="col-sm-7">
                <a class="footer-text" target="blank" href="https://www.mepery.fr/mentions-legales.php">Mentions
                    Légales</a> |
                <a class="footer-text" target="blank" href="https://www.mepery.fr/Mepery_CGU.pdf">CGU</a> |
                <a class="footer-text" target="blank" href="https://www.mepery.fr/Mepery_CGV.pdf">CGV</a> |
                <a class="footer-text" target="blank" href="https://www.mepery.fr/Mepery_RGPD.pdf">Charte des données
                    personnelles</a> |
                <a class="footer-text" target="blank" href="https://www.mepery.fr/cvtheque.php">CVthèque</a>
            </div>
        </div>
    </div>

    <!-- Scroll Top Button -->
    <button class="scroll-top tran3s">
        <i class="fa fa-angle-up" aria-hidden="true"></i>
    </button>


    <!-- Optional JavaScript _____________________________  -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- jQuery -->
    <script src="vendor/jquery.2.2.3.min.js"></script>
    <!-- Popper js -->
    <script src="vendor/popper.js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Style-switcher  -->
    <script src="vendor/jQuery.style.switcher.min.js"></script>
    <!-- Camera Slider -->
    <script src='vendor/Camera-master/scripts/jquery.mobile.customized.min.js'></script>
    <script src='vendor/Camera-master/scripts/jquery.easing.1.3.js'></script>
    <script src='vendor/Camera-master/scripts/camera.min.js'></script>
    <!-- menu  -->
    <script src="vendor/menu/src/js/jquery.slimmenu.js"></script>
    <!-- WOW js -->
    <script src="vendor/WOW-master/dist/wow.min.js"></script>
    <!-- owl.carousel -->
    <script src="vendor/owl-carousel/owl.carousel.min.js"></script>
    <!-- js count to -->
    <script src="vendor/jquery.appear.js"></script>
    <script src="vendor/jquery.countTo.js"></script>
    <!-- Fancybox -->
    <script src="vendor/fancybox/dist/jquery.fancybox.min.js"></script>
    <!-- Theme js -->
    <script src="js/theme.js"></script>
    <script src="js/video.js"></script>
    <script src="js/map-script.js"></script>
    <!-- <script src="js/verifchamp.js"></script> -->
    <script src="http://code.jquery.com/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous"></script>

    <!-- Calendar js -->
    <script type="text/javascript" src="vendor/monthly-master/js/monthly.js"></script>
    <!-- Time picker -->
    <script type="text/javascript" src="vendor/time-picker/jquery.timepicker.min.js"></script>
    <!-- ui js -->
    <script type="text/javascript" src="vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="vendor/sanzzy-map/dist/snazzy-info-window.min.js"></script>

    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script>
        // this is important for IEs
        var polyfilter_scriptpath = '/js/';
    </script>
    <script src="js/cssParser.js"></script>
    <script src="js/css-filters-polyfill.js"></script>
    <div class="overlay"></div>
    <script src="js/func.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
            crossorigin="anonymous"></script>
</footer>

</html>