<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '256M');
error_reporting(E_ALL);
if(!isset($_SESSION['vendeur_id'])){
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
$stmt1->bindParam(1,$_SESSION['vendeur_id'],PDO::PARAM_INT);
$stmt1->execute();
$result = $stmt1->fetchAll();

      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Souscription SEZNY");
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
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
					<h3 class="title">Responsable réseau : '.$result[0]['firstname']." ".$result[0]['lastname'].' / '.$result[0]['email'].'</h3>
					</td>
				</tr>
			</table>

			<br/>
			<br/>
	
			<table class="first">
				<tr>
					<td style="width:2%"> </td>
					<td style="width:48%">
						<table class="first">
							<tr>
								<td style="width:65%">
									<span style="text-decoration:underline">Information entreprise :</span><br/>
									<span style="font-size:10pt;">SAS CABINET MEPERY </span><br/>
									<span style="font-size:10pt;">25 Route de Seilh –</span><br/>
									<span style="font-size:10pt;">31700 CORNEBARRIEU</span><br/>
									<span style="font-size:10pt;">RCS TOULOUSE 884422510 </span><br/>
									<span style="font-size:10pt;"><a href="mailto:contact@cabinet-mepery.fr">contact@cabinet-mepery.fr</a> </span><br/>
									<span style="font-size:10pt;"><a href="tel:+33988392677">09 88 39 26 77</a></span><br/>
								</td>

								<td style="width:35%">
									<br/>
									<br/>
									<img src="fav.png"/>
								</td>
							</tr>
						</table>
					</td>

					<td style="width:48%">
						<span style="text-decoration:underline">Information du Souscripteur : </span><br/>
                        <strong style="font-size:10pt">Nom et Prénom :</strong><span style="font-size:10pt"> '.$_POST['prenomcontact'].' '.$_POST['nomcontact'].'</span><br />
                        <strong style="font-size:10pt">Adresse :</strong><span style="font-size:10pt"> '.$_POST['adresse'].'</span><br />
                        <strong style="font-size:10pt">Code Postal :</strong><span style="font-size:10pt"> '.$_POST['cp'].'</span><br />
                        <strong style="font-size:10pt">Ville :</strong><span style="font-size:10pt"> '.$_POST['ville'].'</span><br />
                        <strong style="font-size:10pt">Téléphone :</strong><span style="font-size:10pt"> '.$_POST['tel'].'</span><br />
                        <strong style="font-size:10pt">Email :</strong><span style="font-size:10pt"> '.$_POST['email'].'</span><br />
					</td>
				</tr>
			</table>

			<h3 style="font-family: Calibri;font-size: 12pt;background-color:#dfdfdf;text-align:center;">Abonnement commandé </h3>

			<br/>
			<br/>	

			<table class="first">
				<br/>
		
				<tr>
		
					<td class="table_2" style="width:60%;text-align:center;font-size:10pt">Abonnement d’Assistance Juridique, service en ligne,<br/>
						Ligne dédiée <a href="tel:+33988392677">09 88 39 26 77</a>
						<br/>
						Adresse email dédiée <a href="mailto:abonnement@cabinet-mepery.fr">abonnement@cabinet-mepery.fr</a>
						<br/>
						DATE DEBUT DE CONTRAT : '.$_POST['date'].'
						<br/>
					</td>
					<td class="table_2" style="width:20%;text-align:center"><strong>Durée Abonnement</strong>
						<br/><br/>'.$_POST['drop1'].' 
					</td>
					<td class="table_2" style="width:20%;text-align:center">
					<strong>Prix HT</strong>
						<br/><br/>'.$_POST['drop2'].' 
					</td>
					</tr>
		
			</table>



		
			
			<table>
				<tr>
					<td style="width:2%;background-color:#dbd9d9"></td>
					<td style="width:98%;background-color:#dbd9d9">

					Informations<br/><strong style="font-family: Calibri;font-size: 12pt;">AUTORISATION</strong><br/><strong style="font-family: Calibri;font-size: 12pt;">PRELEVEMENT MANDAT SEPA</strong>

					</td>
				</tr>
			</table>

			<br/>

			<table>
				<tr>
					<td style="width:2%;"></td>
					<td style="width:98%;font-size:10pt;">

		En signant ce formulaire de mandat, vous autorisez (A) SAS CABINET MEPERY à envoyer des instructions à votre banque pour 
		débiter votre compte, et (B) votre banque à débiter votre compte conformément aux instructions de SAS CABINET MEPERY, Vous 
		bénéficiez du droit d’être remboursé par votre banque selon les conditions décrites dans la convention que vous avez passée 
		avec elle. Une demande de remboursement doit être présentée dans les 8 semaines suivant la date de débit de votre compte 
		pour un prélèvement autorisé.
					</td>
				</tr>
			</table>


			<h3 style="font-family: Calibri;font-size: 12pt;background-color:#dbd9d9;text-align:center;">A - Créancier</h3>

			<table>
				<tr>
					<td style="width:2%;"></td>
					<td style="width:98%;">
					<strong style="font-size:10pt">Identifiant créancier SEPA (ICS) :</strong> <span style="font-size:10pt">FR19 ZZZ 86E 7B4</span><br/>
					<strong style="font-size:10pt">Nom du créancier :</strong><span style="font-size:10pt"> SAS CABINET MEPERY</span> <br/>
					<strong style="font-size:10pt">Adresse :</strong><span style="font-size:10pt"> 25 Route de Seilh</span><br/>
					<strong style="font-size:10pt">CP/Ville : </strong><span style="font-size:10pt">31700 Cornebarrieu</span><br/>
					<strong style="font-size:10pt">Pays :</strong> <span style="font-size:10pt">France</span>
					</td>
				</tr>
			</table>

			<h3 style="font-family: Calibri;font-size: 12pt;background-color:#dbd9d9;text-align:center;">B - Débiteur</h3>
			<br/>

			<table>
				<tr>
					<td style="width:2%;"></td>
					<td style="width:98%;">

						<strong style="font-size:10pt">Nom du débiteur*: </strong><span style="font-size:10pt"> '.$_POST['prenomcontact'].' '.$_POST['nomcontact'].' </span><br/>
						<strong style="font-size:10pt">Adresse*:</strong> <span style="font-size:10pt">'.$_POST['adresse'].'</span><br/>

						<strong style="font-size:10pt">CP/Ville*:</strong> <span style="font-size:10pt">'.$_POST['cp'].' '.$_POST['ville'].'</span><br/>

						<strong style="font-size:10pt">Pays*:</strong> <span style="font-size:10pt"> FRANCE </span><br/>

						<strong style="font-size:10pt">IBAN*:</strong> <span style="font-size:10pt">'.$_POST['iban'].'</span><br/>

						<strong style="font-size:10pt">BIC*:</strong> <span style="font-size:10pt">'.$_POST['bic'].'</span><br/>
						<span style="font-size:10pt">Type de paiement : RECURRENT TOUS LES 5 DE CHAQUE MOIS</span>

					</td>
				</tr>
			</table>
<br><br>
			<table>
				<tr>
					<td style="width:2%;"></td>
					<td style="width:98%;font-size:10pt;">
				* Réponses obligatoires. Le client déclare être informé que le présent contrat comporte des conditions générales de vente.<br> Le client possède une copie des CGV dans sa boîte email. <br/>
				 Elles sont également disponible en libre accès sur notre <a href="https://cabinet-mepery.fr/Mepery_CGV.pdf" target="_blank">site internet</a>
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
			<h4 style="text-align:center">Signature du Client*</h4>';




$obj_pdf->writeHtml($html);

//Saving it as Base64
$b64Doc = chunk_split(base64_encode($obj_pdf->Output('abonnement-juridique.pdf', 'S')));

//Post Request Middleware
function CurlSendPostRequest($url,$request,$headers){
	$ch = curl_init($url);
	$options = array(CURLOPT_HTTPHEADER => $headers, CURLOPT_POSTFIELDS => $request,CURLOPT_RETURNTRANSFER=>TRUE);
	curl_setopt_array($ch,$options);
	$data = curl_exec($ch);
	$curl_errno = curl_errno($ch);
	$curl_error = curl_error($ch);
	curl_close($ch);
	$decoded =  json_decode((string)$data,true);
	return $decoded;
	}

// Globals
$headers = array(
	"Authorization: Bearer $api_key",
	"Content-Type: application/json"
);

// Request 1
$req1=json_encode(array('name'=>'abonnement-mepery.pdf','content'=>$b64Doc));
$resp1 = CurlSendPostRequest($api_url."/files",$req1,$headers);
if(isset($resp1['id'])){
// Request 2
$req2 = json_encode(array('name'=>'Procedure pour '.$_POST['prenomcontact']." ".$_POST['nomcontact'],
'description'=>'Procedure pour '.$_POST['prenomcontact']." ".$_POST['nomcontact'],
'members'=>[array('firstname'=>$_POST['prenomcontact'],'lastname'=>$_POST['nomcontact'],'email'=>$_POST['email'],'phone'=>$_POST['tel'],"fileObjects"=>[
	array(
		'file'=>$resp1['id'],
		'page'=>1,
		'position'=>'67,54,522,157',
		'mention'=>'Lu et Approuvé',
		'mention2'=>'Signé par '.$_POST['prenomcontact']." ".$_POST['nomcontact'],
	)
	])],'config'=>array(
		'webhook'=>array(
			'member.finished'=>[
				array(
					'url'=> $webhook.'/webhook.php',
					'method'=>'GET',
				)
			]
		)
	)));
$resp2 = CurlSendPostRequest($api_url."/procedures",$req2,$headers);
if(isset($resp2['members'][0]['id'])){
$members = $resp2['members'][0]['id'];

//SQL Query to save in DB
$date = date('Y-m-d');
$stmt = $sql->prepare("INSERT INTO ventes (vendeur_id, nomcontact, prenomcontact, raisonsocial, rcs, adresse, cp, ville, tel, email, iban, members,files,bic, drop1, drop2 ,Date_vente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,'$date')");
$stmt->bindParam(1, $_SESSION['vendeur_id'], PDO::PARAM_INT);
$stmt->bindParam(2, $_POST['nomcontact'], PDO::PARAM_STR);
$stmt->bindParam(3, $_POST['prenomcontact'], PDO::PARAM_STR);
$stmt->bindParam(4, $_POST['raisonsocial'], PDO::PARAM_STR);
$stmt->bindParam(5, $_POST['rcs'], PDO::PARAM_STR);
$stmt->bindParam(6, $_POST['adresse'], PDO::PARAM_STR);
$stmt->bindParam(7, $_POST['cp'], PDO::PARAM_STR);
$stmt->bindParam(8, $_POST['ville'], PDO::PARAM_STR);
$stmt->bindParam(9, $_POST['tel'], PDO::PARAM_STR);
$stmt->bindParam(10, $_POST['email'], PDO::PARAM_STR);
$stmt->bindParam(11, $_POST['iban'], PDO::PARAM_STR);
$stmt->bindParam(12, $members, PDO::PARAM_STR);
$stmt->bindParam(13, $resp1['id'], PDO::PARAM_STR);
$stmt->bindParam(14, $_POST['bic'], PDO::PARAM_STR);
$stmt->bindParam(15, $_POST['drop1'], PDO::PARAM_STR);
$stmt->bindParam(16, $_POST['drop2'], PDO::PARAM_STR);
$stmt->execute();




$mail = new PHPMailer(true);

try{
	//Email envoyé à MEPERY
    $message2 ="Vous avez recu une nouvelle souscription a l'offre SEZNY<br>" ;
    $message2.="-------------------------------------------------"."<br>";
    $message2.="<b><u>Commercial :</u></b> <br><br>";
    $message2.="<b>nomcommercial :</b> ".$result[0]['firstname']." ".$result[0]['lastname']."<br>";
    $message2.="<b>emailcommercial :</b> ".$result[0]['email']."<br><br><br>";

    $message2.="<b><u>Client :</u></b> <br><br>";
    $message2.="<b>raisonsocial :</b> ".$_POST['raisonsocial']."<br>";
    $message2.="<b>rcs :</b> ".$_POST['rcs']."<br>";
    $message2.="<b>adresse :</b> ".$_POST['adresse']."<br>";
    $message2.="<b>cp :</b> ".$_POST['cp']."<br>";
    $message2.="<b>ville :</b> ".$_POST['ville']."<br>";
    $message2.="<b>tel :</b> ".$_POST['tel']."<br>";
    $message2.="<b>email :</b> ".$_POST['email']."<br><br><br>";
    $message2.="<b><u>Paiement :</u></b> <br><br>";
    $message2.="<b>bic :</b> ".$_POST['bic']."<br>";
    $message2.="<b>iban :</b> ".$_POST['iban']."<br>";
	$message2.="-------------------------------------------------"."<br>";
	
	$mail->IsSMTP();                                //Use SMTP
	//$mail->SMTPDebug   = 2;                         //2 to enable SMTP debug information
	$mail->Host        = "smtp.ionos.fr";   //Sets SMTP server
	$mail->Port        = 587;                       //set the SMTP port
	$mail->SMTPAuth    = TRUE;                      //enable SMTP authentication
	$mail->SMTPSecure  = "tls";                     //Secure conection
	$mail->Username    = 'souscription@sezny.fr';   //SMTP account username
	$mail->Password    = 'VforVendetta31000!Sezny?';              //SMTP account password*/
	$mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
	);
	$mail->From = 'souscription@sezny.fr';
	$mail->IsHTML(true);
	$mail->FromName    = 'SEZNY'; //Your web name
	$mail->Subject     = 'Souscription'; //Your mail subject
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

}catch (Exception $e){
	echo "Le message n'a pas pu être envoyé. Erreur de l'expéditeur : {$mail->ErrorInfo}";
}
//$obj_pdf->Output(__DIR__ . '/../dossier/abonnement-juridique.pdf', 'FI');


header("location: ../signature.php");
}else{
	echo "<h2 style='text-align:center'>{$resp2['title']} <br/>{$resp2['detail']}</h2>";
}// } else {
	//echo "<h2 style='text-align:center'>{$resp2['title']} <br/>{$resp2['detail']}</h2>";
}
