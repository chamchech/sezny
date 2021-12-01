<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" type="text/css" href="fonts/icon/font/flaticon.css">
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<style>

    h3 {
    }

    table.first {
        margin-top: 10px;
    }

    td.test_1 {
        background-color: #ffffee;
        text-decoration: underline;
    }

    td.second {
        border: 2px dashed green;
    }

    table.first {
        margin-top: 10px;
    }

    td.test_1 {
        background-color: #ffffee;
        text-decoration: underline;
    }

    td.test_2 {
        color: blue;
        text-decoration: underline;
    }

    td.second {
        border: 1px dashed green;
    }

    table.first {
        margin-top: 10px;
    }

    td.table_2 {

        border: 1px solid #dbd9d9;
    }

    td.table_3 {
        border: 1px solid #dbd9d9;
    }

    td.test_2 {
        color: blue;
        text-decoration: underline;
    }

    td.second {
        border: 1px dashed green;
    }

</style>

<table style="border: solid 2px #0c7484;border-radius: 5px;">
    <tr>
        <td style="width:2%;background-color:#dbd9d9"></td>
        <td style="width:98%;background-color:#dbd9d9">
            <h3 class="title">Commercial(e) : ' . $result[0]['firstname'] . " " . $result[0]['lastname'] . ' N° Bon de
                commande : ' .$result2['0']['id'] . '</h3>
        </td>
    </tr>
</table>

<br/>
<br/>
<table class="first" style="border-radius:5px;border: solid 2px #0c7484">
    <tr>
        <td style="width:50%;border-right: solid 2px #0c7484 ">
            <span style="text-decoration:underline">Intermédiaire : </span><br/>
            <br/><strong style="font-size:11pt">Nom :</strong><span style="font-size:12pt"> Mti.co</span><br/>
            <strong style="font-size:11pt">Tel :</strong><span
                    style="font-size: 12pt"> 05 05 05 06 06</span><br/>
            <strong style="font-size:11pt">Lieu de commande:</strong>
            <span class="LieuCommande1 LieuClassActive CheckClassList">
                            <input type="radio" name="LieuClassList" id="LieuClassList1" value="1" checked="checked">
                            Domicile</span>
            <span class="LieuCommande2 LieuClassInactive CheckClassList">
                            <input type="radio" name="LieuClassList" id="LieuClassList2" value="2">
                            Siège</span>
            <span class="LieuCommande3 LieuClassInactive CheckClassList">
                            <input type="radio" name="LieuClassList" id="LieuClassList3" value="3">
                            Autre</span>
            <br/>
            <strong style="font-size:11pt">En réunion :</strong>
            <span class="EnReunion ReunionClassActive ReunionClassList">
                            <input type="radio" name="ReunionClassList" id="ReunionClassList1" value="1"
                                   checked="checked">
                            Oui</span>
            <span class="EnReunion2 ReunionClassInactive ReunionClassList">
                            <input type="radio" name="ReunionClassList" id="ReunionClassList2" value="2">
                            Non</span>
            <br/>
            <label> Si oui nom de l'hote ? <input type="text"></label>
        </td>
        <td style="width:30%;">
            <br/>
            <br/>
            <img src="./images/seznyTrvector.png" style="width: 200px;margin-left: 200px"/>
        </td>
        <td style="width:50%;">
            <span style="text-decoration:underline">Information entreprise :</span><br/>
            <br/><span style="font-size:10pt;">SEZNY / Marque de la SAS PVEX </span><br/>
            <span style="font-size:10pt;">23 PETIT CHEMIN DE LOUDET –</span><br/>
            <span style="font-size:10pt;">31770 COLOMIERS</span><br/>
            <span style="font-size:10pt;">RCS TOULOUSE 831892443 </span><br/>
            <span style="font-size:10pt;"><a href="contact@sezny.fr">contact@sezny.fr</a> </span><br/>
            <span style="font-size:10pt;"><a href="tel:+33561300606">05 61 30 06 06</a></span><br/>
        </td>

    </tr>
</table>


<h3 style="font-family: Calibri;font-size: 12pt;background-color:#dfdfdf;text-align:center;">Informations du client</h3>

<br/>
<br/>


<table class="first" style="border: solid 2px #0c7484;border-radius:5px;">
    <tr>
        <td style="width:50%">
            <span style="text-decoration:underline">Information des Clients : </span><br/>
            <br/><strong style="font-size:10pt">Nom et Prénom 1 :</strong><span style="font-size:10pt"> ' . $_POST['prenomcontact'] . ' ' . $_POST['nomcontact'] . '</span><br/>
            <strong style="font-size:10pt">Nom et Prénom 2 : </strong><span style="font-size: 10pt"> ' . $_POST['prenomtitulaire'] . ' ' . $_POST['nomtitulaire'] . '</span><br/>
            <strong style="font-size:10pt">Adresse :</strong><span
                    style="font-size:10pt"> ' . $_POST['adresse'] . '</span><br/>
            <strong style="font-size:10pt">Code Postal :</strong><span
                    style="font-size:10pt"> ' . $_POST['cp'] . '</span><br/>
            <strong style="font-size:10pt">Ville :</strong><span
                    style="font-size:10pt"> ' . $_POST['ville'] . '</span><br/>
            <strong style="font-size:10pt">Téléphone (mobile) :</strong><span style="font-size:10pt"> ' . $_POST['tel'] . '</span><br/>
            <strong style="font-size:10pt">Email :</strong><span
                    style="font-size:10pt"> ' . $_POST['email'] . '</span><br/>
        </td>

        <td style="width:50%;">
            <span style="text-decoration: underline">Situation du client<br/></span><br/>
            <span class="Situation1 SituationClassActive SituationClassList">
                            <input type="radio" name="SituationClassList" id=SituationClassList1" value="1"
                                   checked="checked">
                            Célibataire</span>
            <span class="Situation2 SituationClassInactive SituationClassList">
                            <input type="radio" name="SituationClassList" id=SituationClassList2" value="2">
                            Marié</span>
            <span class="Situation3 SituationClassInactive SituationClassList">
                            <input type="radio" name="SituationClassList" id=SituationClassList3" value="3">
                            Pacsé</span>
            <span class="Situation4 SituationClassInactive SituationClassList">
                            <input type="radio" name="SituationClassList" id=SituationClassList4" value="4">
                            Veuf</span>
            <br/>
            <br/>
            <span style="text-decoration: underline;">Adresse de l'installation si différente :<br/></span><br/>
            <strong style="font-size:10pt">Adresse :</strong><span
                    style="font-size:10pt"> ' . $_POST['adressedif'] . '<br/></span><br/>
            <span style="text-decoration: underline">Information livraison : </span>
            <p style="width: 670px;"> A compter de la date de signature du présent bon de commande et après la
                réalisation de la dernière
                condition suspensive (prêt bancaire) 30 jours maximum après la livraison du matériel et 7 jours pour
                l'exécution des travaux, sauf cas particuliers. </p>

        </td>
    </tr>
</table>

<br/>

<h3 style="font-family: Calibri;font-size: 12pt;background-color:#dbd9d9;text-align:center;">Vente Produit et
    Prestation</h3>

<table>
    <tr>
        <td style="width:70%;">
            <strong style="font-size:12pt;text-decoration: underline">Désignation :</strong><br/>
            <p>Vente d'une offre SEZNY comprenant :</p>
            <p> - Un gestionnaire d'Energie pour résidence principale. Inclus le suivi et le controle de consommation à
                distance (eau, gaz et éléctiricité)</p>
            <span style="font-size:12pt"> - Autre : </span><br/>

            <strong style="font-size:12pt">Prix HT :</strong><span style="font-size:12pt"> 2724,64€</span><br/>
            <strong style="font-size:12pt">Prix TTC : </strong><span style="font-size:12pt">2890€</span><br/>
            <strong style="font-size:12pt">Montant TVA :</strong> <span style="font-size:12pt">155.36€</span>
        </td>

        <td style="width:30%;padding-top: 100px;">
            <p style="border: solid 2px #0c7484;border-radius: 5px;width: 300px;padding:15px;font-weight: bold">Montant
                total de la commande : 2890€ TTC</p>
        </td>
    </tr>
</table>

<h3 style="font-family: Calibri;font-size: 12pt;background-color:#dbd9d9;text-align:center;">Mode de règlement :</h3>
<br/>

<table>
    <tr>
        <td style="width:2%;"></td>
        <td style="width:98%;">

            <strong style="font-size:12pt">Comptant: 2890€</strong><span style="font-size:11pt"> Condition de réglement : 40% à l'expiration du délai de rétractation et 60% lors de la signature du PV d'installation, soitle jour de la livraison, par chéque à l'ordre de Sezny</span><br/>
            <br/><strong style="font-size:12pt">Financement par notre partenaire:</strong> <span style="font-size:12pt"></span><br/>

           <br/> <p> Nom du préteur : Sofinco .... Montant financé: 2890€</p>
            <p>Partie Financée : 2890€.... Taux nominal : ...% TAEG : ...% Taux assurance TAEA ....%</p>
            <p>Nombre de mensualités : ...... Montant des mensualités : .... Première échéance .... Jours après l'installation</p>

        </td>
    </tr>
</table>
<br><br>
<h3 style="font-family: Calibri;font-size: 12pt;background-color:#dbd9d9;text-align:center;">Acceptation du Client</h3>
<br/>
<table>
    <tr>
        <td style="width:2%;"></td>
        <td style="width:98%;font-size:10pt;">
           <span> Je reconnais avoir pris connaissance des conditions générales de vente figurant en annexes de ce bon de commande et le
document d’informations précontractuelles, dont j’ai reçu un exemplaire</span><br/>
            <span>Je reconnais accepter l’ensemble des dites conditions générales de vente </span><br/>
            <span>Je reconnais être informé de mon droit de rétractation selon l’Art du code de la consommation. Je suis informé(e) que j’ai la
possibilité d’annuler librement le présent bon de commande dans les 15 jours suivant la signature</span><br/>
            <span>J’accepte le principe de signature à distance, je confirme mon consentement plein et entier à signer le présent contrat </span><br/>
            <br/>
            <strong><span>□ Je souhaite bénéficier d’une installation immédiate de ma commande, et accepte de fait à renoncer à mon délai de
rétractation. En cochant cette case je ne pourrai plus faire valoir mes droits au renoncement une fois installé.</span></strong>
            <br/>
            <br/>
        </td>
    </tr>
</table>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<span>DATE DE SOUSCRIPTION : ' . $_POST['date'] . '</span>
<br/>
<span>Lieu : </span>
<h4 style="text-align:center">Signature du Client*</h4>


</body>

<script src="js/func.js"></script>
</html>