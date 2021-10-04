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

		    h3 {
		    }
		    table.first {
		    	margin-top:10px;
		    }
		    td.test_1 {
		        background-color: #ffffee;
		        text-decoration: underline;
		    }
		    td.second {
		        border: 2px dashed green;
		    }

		    table.first {
		    	margin-top:10px;
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
		    	margin-top:10px;
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
			
			<table> 
				<tr>
					<td style="width:2%;background-color:#dbd9d9"></td>
					<td style="width:98%;background-color:#dbd9d9">
					<h4 class="title">Commercial(e) : ' . $result[0]['firstname'] . " " . $result[0]['lastname'] . ' N° Bon de commande : ' . $result2['0']['id'] . '</h4>
					</td>
				</tr>
			</table>

			<br/>
			<br/>
	
			<table class="first">
				<tr>
						<table class="first">
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
                            <label> Si oui nom de l\'hote ? <input type="text"></label>
            <br/>
        </td>
								<td style="width:35%;">
									<br/>
									<br/>
									<img src="seznyTrvector.png"/>
								</td>
							</tr>
						</table>
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
            <span style="text-decoration: underline;">Adresse de l\'installation si différente :<br/></span><br/>
            <strong style="font-size:10pt">Adresse :</strong><span
                    style="font-size:10pt"> POST Adresse<br/></span><br/>
            <span style="text-decoration: underline">Information livraison : </span>
            <p style="width: 670px;"> A compter de la date de signature du présent bon de commande et après la
                réalisation de la dernière
                condition suspensive (prêt bancaire) 30 jours maximum après la livraison du matériel et 7 jours pour
                l\'exécution des travaux, sauf cas particuliers. </p>

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
            <p>Vente d\'une offre SEZNY comprenant :</p>
            <p> - Un gestionnaire d\'Energie pour résidence principale. Inclus le suivi et le controle de consommation à
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

            <strong style="font-size:12pt;">Comptant: 2890€</strong><span style="font-size:11pt;"> Condition de réglement : 40% à l\'expiration du délai de rétractation et 60% lors de la signature du PV d\'installation, soitle jour de la livraison, par chéque à ordre de Sezny</span><br/>
           

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
<h4 style="text-align:center">Signature du Client*</h4>';


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
                'position' => '67,54,522,157',
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
        $stmt = $sql->prepare("INSERT INTO ventes (vendeur_id, nomcontact, prenomcontact , adresse, cp, ville, nomtitulaire, prenomtitulaire, adressetitulaire, cptitulaire, villetitulaire, tel, email, members, files, Date_vente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '$date')");
        $stmt->bindParam(1, $_SESSION['vendeur_id'], PDO::PARAM_INT);
        $stmt->bindParam(2, $_POST['nomcontact'], PDO::PARAM_STR);
        $stmt->bindParam(3, $_POST['prenomcontact'], PDO::PARAM_STR);
//$stmt->bindParam(4, $_POST['raisonsocial'], PDO::PARAM_STR);
//$stmt->bindParam(5, $_POST['rcs'], PDO::PARAM_STR);
        $stmt->bindParam(4, $_POST['adresse'], PDO::PARAM_STR);
        $stmt->bindParam(5, $_POST['cp'], PDO::PARAM_STR);
        $stmt->bindParam(6, $_POST['ville'], PDO::PARAM_STR);
        $stmt->bindParam(7, $_POST['nomtitulaire'], PDO::PARAM_STR);
        $stmt->bindParam(8, $_POST['prenomtitulaire'], PDO::PARAM_STR);
        $stmt->bindParam(9, $_POST['adressetitulaire'], PDO::PARAM_STR);
        $stmt->bindParam(10, $_POST['cptitulaire'], PDO::PARAM_STR);
        $stmt->bindParam(11, $_POST['villetitulaire'], PDO::PARAM_STR);
        $stmt->bindParam(12, $_POST['tel'], PDO::PARAM_STR);
        $stmt->bindParam(13, $_POST['email'], PDO::PARAM_STR);
//$stmt->bindParam(11, $_POST['iban'], PDO::PARAM_STR);
        $stmt->bindParam(14, $members, PDO::PARAM_STR);
        $stmt->bindParam(15, $resp1['id'], PDO::PARAM_STR);
//$stmt->bindParam(14, $_POST['bic'], PDO::PARAM_STR);
//$stmt->bindParam(15, $_POST['drop1'], PDO::PARAM_STR);
//$stmt->bindParam(16, $_POST['drop2'], PDO::PARAM_STR);
        $stmt->execute();
        $mail = new PHPMailer(true);

        try {
            //Email envoyé à SEZNY
            $message2 = "Vous avez reçu une nouvelle souscription a l'offre SEZNY<br><br>";
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
        $obj_pdf->Output(__DIR__ . '/../dossier/souscription-sezny.pdf', 'FI');


        header('Location: ../signature.php');


    } else {
        echo "<h2 style='text-align:center'>{$resp2['title']} <br/>{$resp2['detail']}</h2>";
    } //} else {
    //echo "<h2 style='text-align:center'>{$resp2['title']} <br/>{$resp2['detail']}</h2>";
}
