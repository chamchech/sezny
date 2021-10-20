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
    <title>Vente - SEZNY</title>
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
            <div enctype="multipart/form-data" method="post" action="pdf/bc-particulier.php"
                 class="theme-form-one form-validation">
                <input type="hidden" name="date" value="<?php echo date("d / m / Y"); ?>">
                <div class='row'>
                    <div class='col-lg-6 col-12 form-group'>
                        <label>Nom du Responsable réseau</label>
                        <h4> <?php echo $result[0]['firstname'] . ' ' . $result[0]['lastname']; ?> </h4>
                    </div> <!-- BLABLABLA FIVERR -->
                    <div class='col-lg-6 col-12 form-group' style="text-align:right">
                        <label>Email du Responsable réseau</label>
                        <h4><?php echo $result[0]['email'] ?> </h4>
                    </div> <!-- BLABLABLA FIVERR -->
                </div>
                <br/>
                <center><h3>Lieu de commande</h3></center>
                <div class="row commandeInfo">
                    <div class="col-sm">
                        <div class="form-info">
                            <label class="form-check-info" for="case_info1">Domicile</label>
                            <input value="Domicile" class="call-back-form-one" type="radio" name="lieucommande"
                                   id="case_info1">
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-info">
                            <label class="form-check-info" for="case_info2">Siège</label>
                            <input value="Siège" class="call-back-form-one" type="radio" name="lieucommande"
                                   id="case_info2">
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-info">
                            <label class="form-check-info" for="case_info3">Autre</label>
                            <input value="Autre" class="call-back-form-one" type="radio" name="lieucommande"
                                   id="case_info3">
                        </div>
                    </div>
                </div>
                <center><h3>En réunion </h3></center>
                <div class="row reunion">
                    <div class="col-sm">
                        <div class="form-info">
                            <label class="form-check-reunion" for="case_info3">Oui</label>
                            <input value="Oui" class="call-back-form-one" type="radio" name="enreunion"
                                   id="case_reunion1">
                            <label class="form-check-reunion" for="case_info3">Si oui nom de l'hote</label>
                            <input class="call-back-form-one" placeholder="Nom de l'hote" type="text" name="nomdehote">
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-info" style="width: 500px">
                            <label class="form-check-reunion" for="case_info3">Non</label>
                            <input value="Non" class="call-back-form-one" type="radio" name="enreunion"
                                   id="case_reunion2">
                        </div>
                    </div>
                </div>
                <f class="col-sm-12 col-12">
                    <div class="form-group">
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
                            <h3>Informations Contact</h3>
                        </center>
                        <br>
                        <div class="row formInscription">
                            <div class="col-lg-6 col-12 form-group  ">
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
                        <label>Adresse</label>
                        <input type="text" placeholder="90 bis Chemin St Jean" class="call-back-form-one" name="adresse"
                               required>
                        <div class="col-lg-4 col-12 form-group">
                            <label>Code Postal</label>
                            <input type="text" placeholder="31770" name="cp" class="call-back-form-one"
                                   pattern="[0-9]{2,3}[ \.\-]?[0-9]{3}" required>
                        </div>
                        <div class="col-lg-8 col-12 form-group">
                            <label>Ville</label>
                            <input type="text" placeholder="Colomiers" class="call-back-form-one" name="ville" required>
                        </div>
                    </div>

                    <center><h3>Situation familiale</h3></center>
                    <div class="row row-cols-4 formInscription">
                        <div class="col">
                            <div class="form-check">
                                <label class="form-check-label" for="case_1">Marié</label>
                                <input value="Marié" class="call-back-form-one" type="radio" name="situation"
                                       id="case_1" onclick="Change()">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <label class="form-check-label" for="case_2">Celibataire</label>
                                <input value="Célibataire" class="call-back-form-one" type="radio" name="situation"
                                       id="case_2">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <label class="form-check-label" for="case_3">Pacsé</label>
                                <input value="Pacsé" class="call-back-form-one" type="radio" name="situation"
                                       id="case_3">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <label class="form-check-label" for="case_4">Veuf</label>
                                <input value="Veuf" class="call-back-form-one" type="radio" name="situation"
                                       id="case_4">
                            </div>
                        </div>
                    </div>

                    <div id="dynamicForm">
                        <center><h3>Deuxieme titulaire de contract</h3></center>
                        <br>
                        <div class="row formInscription">
                            <div class="col-lg-6 col-12 form-group  ">
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
                    <center><h3>Adresse de l'installation si différente</h3></center>
                    <div class="row formInscription">
                        <label>Adresse</label>
                        <input type="text" placeholder="90 bis Chemin St Jean" class="call-back-form-one"
                               name="adressetitulaire">
                        <div class="col-lg-4 col-12 form-group">
                            <label>Code Postal</label>
                            <input type="text" placeholder="31770" name="cptitulaire" class="call-back-form-one"
                                   pattern="[0-9]{2,3}[ \.\-]?[0-9]{3}">
                        </div>
                        <div class="col-lg-8 col-12 form-group">
                            <label>Ville</label>
                            <input type="text" placeholder="Colomiers" class="call-back-form-one"
                                   name="villetitulaire">
                        </div>
                    </div>

                    <center><h3>Vente Produit et Prestation</h3></center>
                    <br>
                    <br>

                    <div class="formProduit">
                        <div class="form-check form-switch ">
                            <input class="form-check-input" type="checkbox" id="pack1" checked disabled>
                            <label class="form-check-label" for="flexSwitchCheckDefault2">Un gestionnaire d'Energie pour
                                résidence principale.
                                Inclus le suivi et le controle de consommation à
                                distance (eau, gaz et éléctiricité)</label>
                        </div>
                        <div class="form-check form-switch">
                            <div>
                                <input class="form-check-input" type="checkbox" id="packautre" name="autre"
                                       onclick="ChangePack()">
                                <label class="form-check-label" for="packautre">Autre</label>
                            </div>
                            <div id="dynamicFormPack" style="display: none">
                                <input id="autreInput" type="text" placeholder="Préciser" name="autre"
                                       class="call-back-form-one">
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
                    <div class="row">
                        <div class="col-lg-12">
                            <br>
                            <br>
                            <center><input type="submit" name="valideinscription" id="valide" class="theme-button-one"
                                           value="Continuer"></center>
                        </div>
                    </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <center><a href="index.php">
                        <button type="button" class="btn btn-danger theme-button-two">Annuler</button>
                    </a></center>
            </div>
        </div>
    </div>
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