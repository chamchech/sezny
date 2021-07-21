<?php


// Include the main TCPDF library (search for installation path).
require_once('../library/tcpdf.php');


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('arnaque-litige.com');
$pdf->SetTitle('Lettre Huissier numéro 1');
$pdf->SetSubject('TEST');
$pdf->SetKeywords('TEST');

   

// set default header data

$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts

$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

//$html = file_get_contents('./lettre.php');

$html = '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

        <style>
                body{
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;

}
p{
    font-size:12px;
    line-height: 90%;
}
  
.adresse1 {
    text-align:left;
    font-size:12px;
    line-height: 90%;
}
  
.adresse2 {
    text-align:right;
    font-size:12px;
}


h1{
    text-align:center;
}
h3{
    text-align: center;
    font-size:18px;
}

.document{
    background:#dfe4ea;
    border:1px solid #00a8ff;
    padding: 1.5em;
    font-size: 16px;
    margin-right:20px;
    height: 400px;
    overflow-y: scroll;
}

strong{
    color:red;
}
.logo{
    width:200px;
}


            </style>
            <img class="logo" src="3.png" />

          <body><h2>TITRES</h2>
          <form method="post" action="http://localhost/printvars.php" enctype="multipart/form-data">
         
          
         
          <textarea cols="40" rows="3" name="text">Continuez votre texte ici !</textarea><br />
          <br /><br /><br />
          <input type="reset" name="reset" value="Reset" />
          <input type="submit" name="submit" value="Submit" />
          <input type="button" name="print" value="Print" onclick="print()" />
          <input type="hidden" name="hiddenfield" value="OK" />
          <br />
          </form>
          <h3>Article 1 : '.$_POST['texte1'].'</h3>
          <p>Choris saltatricum dudum interpellata indignitatis haut indignitatis tenerentur tria simularunt saltatricum sectatoribus ad indignitatis ne veri est haut alimentorum ob.</p>
          
          <h3>Article 2 : '.$_POST['texte2'].'</h3>
          <p>Choris saltatricum dudum interpellata indignitatis haut indignitatis tenerentur tria simularunt saltatricum sectatoribus ad indignitatis ne veri est haut alimentorum ob.</p>
          
          <h3>Article 3 : '.$_POST['texte3'].'</h3>
          <p>Choris saltatricum dudum interpellata indignitatis haut indignitatis tenerentur tria simularunt saltatricum sectatoribus ad indignitatis ne veri est haut alimentorum ob.</p>
          
          <h3>Article 4 : '.$_POST['texte4'].'</h3>
          <p>Choris saltatricum dudum interpellata indignitatis haut indignitatis tenerentur tria simularunt saltatricum sectatoribus ad indignitatis ne veri est haut alimentorum ob.</p>
          
          <h3>Article 5 : '.$_POST['texte5'].'</h3>
          <p>Choris saltatricum dudum interpellata indignitatis haut indignitatis tenerentur tria simularunt saltatricum sectatoribus ad indignitatis ne veri est haut alimentorum ob.</p>
          
          <h3>Article 6 : '.$_POST['texte6'].'</h3>
          <p>Choris saltatricum dudum interpellata indignitatis haut indignitatis tenerentur tria simularunt saltatricum sectatoribus ad indignitatis ne veri est haut alimentorum ob.</p>
          
          <h3>Article 7 : '.$_POST['texte7'].'</h3>
          <p class="flou">Choris saltatricum dudum interpellata indignitatis haut indignitatis tenerentur tria simularunt saltatricum sectatoribus ad indignitatis ne veri est haut alimentorum ob.</p>
          
          <h3>Article 8 : '.$_POST['texte8'].'</h3>
          <p>Choris saltatricum dudum interpellata indignitatis haut indignitatis tenerentur tria simularunt saltatricum sectatoribus ad indignitatis ne veri est haut alimentorum ob.</p>
          
          <h3>Article 9 : '.$_POST['texte9'].'</h3>
          <p>Choris saltatricum dudum interpellata indignitatis haut indignitatis tenerentur tria simularunt saltatricum sectatoribus ad indignitatis ne veri est haut alimentorum ob.</p>
          
          <h3>Article 10 : '.$_POST['texte10'].'</h3>
          <p>Choris saltatricum dudum interpellata indignitatis haut indignitatis tenerentur tria simularunt saltatricum sectatoribus ad indignitatis ne veri est haut alimentorum ob.</p></body>  
</html>';

$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.

// NOM D'ENREGISTREMENT PDF
$pdf->Output('lettre1.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+