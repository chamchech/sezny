<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '256M');
error_reporting(E_ALL);
if (!isset($_SESSION['vendeur_id'])) {
    header("location:connexion.php");
}
require_once '../library/tcpdf.php';
require_once '../db.php';
require '../app_config.php';
require '../mailer/src/Exception.php';
require '../mailer/src/PHPMailer.php';
require '../mailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$stmt1 = $sql->prepare("SELECT * FROM vendeurs where id = ?");
$stmt1->bindParam(1, $_SESSION['vendeur_id'], PDO::PARAM_INT);
$stmt1->execute();
$result = $stmt1->fetchAll();
// Méthode last_insert_id
$stmt2 = $sql->prepare("SELECT id FROM ventes ORDER by id DESC");
$stmt2->bindParam(1, $_SESSION['ventes_id'], PDO::PARAM_INT);
$stmt2->execute();
$result2 = $stmt2->fetchAll();

$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle("Souscription SEZNY");
$obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins('0', '5', '0');
$obj_pdf->setPrintHeader(false);
$obj_pdf->setPrintFooter(false);
$obj_pdf->SetAutoPageBreak(TRUE, 10);
$obj_pdf->SetFont('helvetica', '', 12);
$obj_pdf->AddPage();
$html = '

<style>

.first{
border-collapse: collapse;
padding: 5px;

}
.titre{
font-size: 12px;
background-color: #0c7484;
text-align: center;
color: #FFFFFF;

}

.minititre{
font-weight: bold;
font-size: 11pt;
margin-left: 5px;
}
span,strong{
font-size: 10pt;
}

.montantTotal{
font-weight: bold;
border: solid 2px #0c7484;
}
/*.infoClient{
font-weight: bold;
}*/
</style>
		
			<h3 style="padding: 15px;" class="titre">Commercial(e) : ' . $result[0]['firstname'] . " " . $result[0]['lastname'] . ' | Bon de commande N° ' . $result2['0']['id'] . '</h3>
			<br/>
			<br/>
			<table class="first">
				<tr>
					<td style="width:50%;border-right: 2px solid #dfdfdf">
            <span class="minititre">Intermédiaire : </span><br>
            <span>Nom :</span><span> J2M</span><br>
            <span>Tel :</span><span> 05 05 05 06 06</span><br>
            <span>Lieu de commande :</span>
            <span>' . $_POST['lieucommande'] . '</span>
            <br>
            <span>En réunion :</span>
            <span>' . $_POST['enreunion'] . '</span>
            <br>
            <span>Si oui nom de l\'hote ? :</span>
            <span>' . $_POST['nomdehote'] . '</span>
            
        </td>
								<td style="width:20%;">
									<br> 
									<br>
									<img class="logo" src="seznyTrvector.png"/>
								</td>
								
			<td style="width:50%;">
            <span class="minititre">Information entreprise :</span><br>
            <span>SEZNY / Marque de la SAS PVEX </span><br>
            <span>23 PETIT CHEMIN DE LOUDET –</span><br>
            <span>31770 COLOMIERS</span><br>
            <span>RCS TOULOUSE 831892443 </span><br>
            <span>contact@sezny.fr</span><br>
            <span>05 61 30 06 06</span>
                        </td>
							</tr>
						</table>
		<h3 class="titre">Informations du client</h3>

<br/>
<br/>


<table class="first">
    <tr>
        <td style="width:40%;border: 2px solid #dfdfdf ">
            <span class="minititre">Information des Clients :</span><br>
            <span>Nom et Prénom 1 :</span><span class="infoClient"> ' . $_POST['prenomcontact'] . ' ' . $_POST['nomcontact'] . '</span><br>
            <span>Nom et Prénom 2 : </span><span class="infoClient"> ' . $_POST['prenomtitulaire'] . ' ' . $_POST['nomtitulaire'] . '</span><br>
            <span>Adresse :</span><span class="infoClient"> ' . $_POST['adresse'] . '</span><br>
            <span>Code Postal :</span><span class="infoClient"> ' . $_POST['cp'] . '</span><br>
            <span>Ville :</span><span class="infoClient"> ' . $_POST['ville'] . '</span><br>
            <span>Téléphone (mobile) :</span><span class="infoClient"> ' . $_POST['tel'] . '</span><br>
            <span>Email :</span><span class="infoClient"> ' . $_POST['email'] . '</span><br>
        </td>
        <td style="width:60%;border:2px solid #dfdfdf ">
            <span class="minititre">Situation du client :</span>
            <span>' . $_POST['situation'] . '</span>
            <br>
            <span class="minititre">Adresse de l\'installation si différente :</span><br>
            <span>' . $_POST['adressetitulaire'] . ' ' . $_POST['cptitulaire'] . ' ' . $_POST['villetitulaire'] . '<br></span><br>
            <span class="minititre">Information livraison :</span>
            <span>A compter de la date de signature du présent bon de commande et après la réalisation de la dernière
                condition suspensive (prêt bancaire) 30 jours maximum après la livraison du matériel et 7 jours pour
                l\'exécution des travaux, sauf cas particuliers.</span>
        </td>
    </tr>
</table>
<h3 class="titre">Vente Produit et Prestation</h3>
<table class="first">
    <tr>
    <td style="width:2%;border-bottom:2px solid #246874;"></td>
        <td style="width:58%;border-bottom:2px solid #246874;">
            <strong><span>Vente d\'une offre SEZNY comprenant :</span></strong><br/>
            <span> - Un gestionnaire d\'energie pour résidence principale. 
                    Inclus le suivi et le controle de consommation à
                    distance (eau, gaz et éléctiricité)</span><br>
               
            <span> - Autre : ' . $_POST['autre'] . ' </span>
        </td>
        <td style="width:40%;border:2px solid #246874;">
        <br>
        <br>
           <span>2834,12€ HT</span><br>
           <span></span><br>
            <span></span><span>0€ HT</span><br>
            <span>Montant total HT : 2834,12€</span><br>
            <span>TVA 10% : </span><span>0€</span><br>
            <span>TVA 5.5% : </span><span>155,88€</span><br>
            <span class="montantTotal">Montant total TTC : 2990€</span>
        </td>
    </tr>
</table>
<h3 class="titre">Mode de règlement :</h3>
<br/>
<table class="first">
    <tr>
    <td style="width:2%"></td>
        <td style="width:98%;">
<br/>
            <strong>' . $_POST['methodePaie'] . '</strong><span></span><br/>
        </td>
    </tr>
</table>
<h3 class="titre"> Acceptation du client </h3>
<br/>
<table class="first">
    <tr>
        <td style="width:2%"></td>
        <td style="width:98%">
        <br/>
        <span style="font-family:zapfdingbats;">3</span><span>Je reconnais avoir pris connaissance des conditions générales de vente figurant en annexes de ce bon de commande et le
document d’informations précontractuelles, dont j’ai reçu un exemplaire.</span><br/>
        <span style="font-family:zapfdingbats;">3</span><span>Je reconnais accepter l’ensemble des dites conditions générales de vente.</span><br/>
             <span style="font-family:zapfdingbats;">3</span><span>Je reconnais être informé de mon droit de rétractation selon l’Art du code de la consommation. Je suis informé(e) que j’ai la
possibilité d’annuler librement le présent bon de commande dans les 15 jours suivant la signature.</span><br/>
             <span style="font-family:zapfdingbats;">3</span><span>J’accepte le principe de signature à distance, je confirme mon consentement plein et entier à signer le présent contrat.</span><br/>
             <span style="font-family:zapfdingbats;">3</span><strong><span>Je souhaite bénéficier d’une installation immédiate de ma commande et accepte de fait à renoncer à mon délai de
rétractation. En cochant cette case je ne pourrai plus faire valoir mes droits au renoncement une fois installé.</span></strong><br>
        </td>
    </tr>
</table>
<br>
<table>
<tr>
    <td style="width:2%"></td>
        <td style="width:98%">
<span class="minititre">DATE DE SOUSCRIPTION : ' . $_POST['date'] . '</span><br>
<span class="minititre">Lieu : ' . $_POST['lieucommande'] . '

 </span> </td></tr></table>';

$obj_pdf->writeHtml($html);

//Saving it as Base64
$b64Doc = chunk_split(base64_encode($obj_pdf->Output('souscription-sezny.pdf', 'S')));

//Post Request Middleware
function CurlSendPostRequest($url, $request, $headers)
{
    $ch = curl_init($url);
    $options = array(CURLOPT_HTTPHEADER => $headers, CURLOPT_POSTFIELDS => $request, CURLOPT_RETURNTRANSFER => TRUE);
    curl_setopt_array($ch, $options);
    $data = curl_exec($ch);
    $curl_errno = curl_errno($ch);
    $curl_error = curl_error($ch);
    curl_close($ch);
    $decoded = json_decode((string)$data, true);
    return $decoded;

}

// Globals
$headers = array(
    "Authorization: Bearer $api_key",
    "Content-Type: application/json"
);

// Request 1
$req1 = json_encode(array('name' => 'souscription-sezny.pdf', 'content' => $b64Doc));
$resp1 = CurlSendPostRequest($api_url . "/files", $req1, $headers);
if (isset($resp1['id'])) {
// Request 2
    $req2 = json_encode(array('name' => 'Procedure pour ' . $_POST['prenomcontact'] . " " . $_POST['nomcontact'],
        'description' => 'Procedure pour ' . $_POST['prenomcontact'] . " " . $_POST['nomcontact'],
        'members' => [array('firstname' => $_POST['prenomcontact'], 'lastname' => $_POST['nomcontact'], 'email' => $_POST['email'], 'phone' => $_POST['tel'], "fileObjects" => [
            array(
                'file' => $resp1['id'],
                'page' => 1,
                'position' => '356,17,500,87',
                'mention' => 'Lu et Approuvé',
                'mention2' => 'Signé par ' . $_POST['prenomcontact'] . " " . $_POST['nomcontact'],
            )
        ])], 'config' => array(
            'webhook' => array(
                'member.finished' => [
                    array(
                        'url' => $webhook . '/webhook.php',
                        'method' => 'GET',
                    )
                ]
            )
        )));
    $resp2 = CurlSendPostRequest($api_url . "/procedures", $req2, $headers);
    if (isset($resp2['members'][0]['id'])) {
        $members = $resp2['members'][0]['id'];

//SQL Query to save in
        $date = date('Y-m-d');
        $stmt = $sql->prepare("INSERT INTO ventes (vendeur_id, nomcontact, prenomcontact , adresse, cp, ville,lieucommande, nomtitulaire, prenomtitulaire, adressetitulaire, cptitulaire, villetitulaire, tel, email, members, files, Date_vente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '$date')");
        $stmt->bindParam(1, $_SESSION['vendeur_id'], PDO::PARAM_INT);
        $stmt->bindParam(2, $_POST['nomcontact'], PDO::PARAM_STR);
        $stmt->bindParam(3, $_POST['prenomcontact'], PDO::PARAM_STR);
//$stmt->bindParam(4, $_POST['raisonsocial'], PDO::PARAM_STR);
//$stmt->bindParam(5, $_POST['rcs'], PDO::PARAM_STR);
        $stmt->bindParam(4, $_POST['adresse'], PDO::PARAM_STR);
        $stmt->bindParam(5, $_POST['cp'], PDO::PARAM_STR);
        $stmt->bindParam(6, $_POST['ville'], PDO::PARAM_STR);
        $stmt->bindParam(7, $_POST['lieucommande'], PDO::PARAM_STR);
        $stmt->bindParam(8, $_POST['nomtitulaire'], PDO::PARAM_STR);
        $stmt->bindParam(9, $_POST['prenomtitulaire'], PDO::PARAM_STR);
        $stmt->bindParam(10, $_POST['adressetitulaire'], PDO::PARAM_STR);
        $stmt->bindParam(11, $_POST['cptitulaire'], PDO::PARAM_STR);
        $stmt->bindParam(12, $_POST['villetitulaire'], PDO::PARAM_STR);
        $stmt->bindParam(13, $_POST['tel'], PDO::PARAM_STR);
        $stmt->bindParam(14, $_POST['email'], PDO::PARAM_STR);
//$stmt->bindParam(11, $_POST['iban'], PDO::PARAM_STR);
        $stmt->bindParam(15, $members, PDO::PARAM_STR);
        $stmt->bindParam(16, $resp1['id'], PDO::PARAM_STR);
//$stmt->bindParam(14, $_POST['bic'], PDO::PARAM_STR);
//$stmt->bindParam(15, $_POST['drop1'], PDO::PARAM_STR);
//$stmt->bindParam(16, $_POST['drop2'], PDO::PARAM_STR);
        $stmt->execute();
        $mail = new PHPMailer(true);

        try {
            //Email envoyé à SEZNY
            $message2 = "Vous avez recu une nouvelle souscription a l'offre SEZNY<br><br>";
            $message2 .= "--------------------------------------------------------------------------------------------------------" . "<br><br>";
            $message2 .= "<b><u>Commercial :</u></b> <br><br>";
            $message2 .= "<b>Nom :</b> " . $result[0]['firstname'] . " " . $result[0]['lastname'] . "<br>";
            $message2 .= "<b>Email :</b> " . $result[0]['email'] . "<br>";
            $message2 .= "--------------------------------------------------------------------------------------------------------" . "<br><br>";
            $message2 .= "<b><u>Client :</u></b> <br><br>";
            //$message2.="<b>raisonsocial :</b> ".$_POST['raisonsocial']."<br>";
            //$message2.="<b>rcs :</b> ".$_POST['rcs']."<br>";
            $message2 .= "<b>Prenom :</b> " . $_POST['prenomcontact'] . "<br>";
            $message2 .= "<b>Nom :</b> " . $_POST['nomcontact'] . "<br>";
            $message2 .= "<b>Adresse :</b> " . $_POST['adresse'] . "<br>";
            $message2 .= "<b>CP :</b> " . $_POST['cp'] . "<br>";
            $message2 .= "<b>Ville :</b> " . $_POST['ville'] . "<br>";
            $message2 .= "<b>Tel :</b> " . $_POST['tel'] . "<br>";
            $message2 .= "<b>Email :</b> " . $_POST['email'] . "<br>";
            $message2 .= "--------------------------------------------------------------------------------------------------------" . "<br><br>";
            $message2 .= "<b><u>Informations sur le deuxieme titulaire :</u></b> <br><br>";
            $message2 .= "<b>Prenom :</b> " . $_POST['prenomtitulaire'] . "<br>";
            $message2 .= "<b>Nom :</b> " . $_POST['nomtitulaire'] . "<br>";
            $message2 .= "<b>Adresse :</b> " . $_POST['adressetitulaire'] . "<br>";
            $message2 .= "<b>CP :</b> " . $_POST['cptitulaire'] . "<br>";
            $message2 .= "<b>Ville :</b> " . $_POST['villetitulaire'] . "<br>";
            //$message2.="<b><u>Paiement :</u></b> <br><br>";
            //$message2.="<b>bic :</b> ".$_POST['bic']."<br>";
            //$message2.="<b>iban :</b> ".$_POST['iban']."<br>";

            $mail->IsSMTP();                                //Use SMTP
            //$mail->SMTPDebug   = 2;                         //2 to enable SMTP debug information
            $mail->Host = "smtp.ionos.fr";   //Sets SMTP server
            $mail->Port = 587;                       //set the SMTP port
            $mail->SMTPAuth = TRUE;                      //enable SMTP authentication
            $mail->SMTPSecure = "tls";                     //Secure conection
            $mail->Username = 'souscription@sezny.fr';   //SMTP account username
            $mail->Password = 'VforVendetta31000!Sezny?';              //SMTP account password*/
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->From = 'souscription@sezny.fr';
            $mail->IsHTML(true);
            $mail->FromName = 'SEZNY'; //Your web name
            $mail->Subject = 'Souscription'; //Your mail subject
            $mail->AddAttachment($_FILES['validerib']['tmp_name'],
                $_FILES['validerib']['name']);
            $mail->AddAttachment($_FILES['valideiban']['tmp_name'],
                $_FILES['valideiban']['name']);
            $mail->AddAttachment($_FILES['validekbis']['tmp_name'],
                $_FILES['validekbis']['name']);
            // $mail->addAddress('engie@mepery.fr', ''); //Owner email
            $mail->addAddress($owner_email, '');
            $mail->Body = $message2;
            $mail->send();

        } catch (Exception $e) {
            echo "Le message n'a pas pu être envoyé. Erreur de l'expéditeur : {$mail->ErrorInfo}";
        }
       // $obj_pdf->Output(__DIR__ . '/../dossier/souscription-sezny.pdf', 'FI');


        header('Location: ../signature.php');


    } else {
        echo "<h2 style='text-align:center'>{$resp2['title']} <br/>{$resp2['detail']}</h2>";
    } //} else {
    //echo "<h2 style='text-align:center'>{$resp2['title']} <br/>{$resp2['detail']}</h2>";
}
