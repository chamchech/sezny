<?php
require './app_config.php';
require './mailer/src/Exception.php';
require './mailer/src/PHPMailer.php';
require './mailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once './db.php';
    

function CurlSendGetRequest($url,$headers){
    $ch = curl_init($url);
    $options = array(CURLOPT_HTTPHEADER => $headers, CURLOPT_RETURNTRANSFER=>TRUE);
    curl_setopt_array($ch,$options);
    $data = curl_exec($ch);
    $curl_errno = curl_errno($ch);
    $curl_error = curl_error($ch);
    curl_close($ch);
    return $data;
    }
$headers = array(
    "Authorization: Bearer $api_key",
    "Content-Type: application/json"
);
$x = stripslashes(html_entity_decode(file_get_contents('php://input')));
$data=json_decode(trim($x),true);
$smt=$sql->prepare("UPDATE ventes SET signed='oui' WHERE files = ?");
$smt->bindParam(1, $data['fileid'], PDO::PARAM_STR);
echo $data['fileid'];
$smt->execute();

$resp=CurlSendGetRequest($api_url.$data['fileid']."/download",$headers);
    // $resp=CurlSendGetRequest($api_url.$data["data"]['member']."/download",$headers);
    $resp=base64_decode($resp);
    // Email envoyé au client
    
    $message ="Merci d'avoir souscrit à l'abonnement juridique de Mepery<br>" ;
    $message ="Madame, Monsieur,<br>Merci d'avoir souscrit à l'abonnement juridique MEPERY.<br>Vous trouverez en Pièces Jointes de ce mail :<br> - Une copie de votre contrat<br> - Les Conditions Générales de Ventes<br> - La presentation de votre offre.<br>Vous pouvez des à présent nous contacter pour répondre a vos demandes Juridiques.<br>Bien Cordialement,<br>Cabinet MEPERY.<br><br><img src='https://cial.mepery.fr/images/logo/logo.png' width='200'>";
  
    $mail = new PHPMailer(true);
    try {
      //SMTP CONFIG
        $mail->IsSMTP();                                //Use SMTP
        $mail->SMTPDebug   = 2;                         //2 to enable SMTP debug information
        $mail->Host        = "smtp.ionos.fr";   //Sets SMTP server
        $mail->Port        = 465;                       //set the SMTP port
        $mail->SMTPAuth    = TRUE;                      //enable SMTP authentication
        $mail->SMTPSecure  = "tls";                     //Secure conection
        $mail->Username    = 'abonnement@cabinet-mepery.fr';   //SMTP account username
        $mail->Password    = 'MmMp1503!mepery';              //SMTP account password*/
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
            );
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->addStringAttachment($resp,"abonnement-juridique.pdf","base64","application/pdf");
    	$mail->addAttachment(__DIR__ . '/dossier/Mepery_CGV.pdf', '');
    	$mail->addAttachment(__DIR__ . '/dossier/Prestation_abonnement_mepery.pdf', '');
        $mail->IsHTML(true);
        $mail->From = 'abonnement@cabinet-mepery.fr';
        $mail->FromName    = 'Cabinet Juridique MEPERY'; //Your web name
        $mail->Subject     = 'Abonnement Juridique'; //Your mail subject
        $mail->Body        = $message;
        $mail->AltBody     = 'This is the body in plain text for non-HTML mail clients';
        $mail->WordWrap    = 50; // set word wrap to 50 characters
        $mail->AddAddress($data['mailid']);
        $mail->AddAddress($owner_email);
        $mail->send();
    } catch (Exception $e) {
        echo "Le message n'a pas pu être envoyé. Erreur de l'expéditeur : {$mail->ErrorInfo}";
    }
?>