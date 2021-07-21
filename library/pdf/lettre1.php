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


            </style>
            <body>
        <div class="adresse1">
            <p>'.$_POST['texte1'].'</p>
            <p>'.$_POST['texte2'].'</p>
            <p>'.$_POST['texte3'].' '.$_POST['texte4'].'</p>
        
            <p class="adresse2">'.$_POST['texte5'].'</p>
            <p class="adresse2">'.$_POST['texte7'].'</p>
            <p class="adresse2">'.$_POST['texte8'].'</p>
        </div>
    
       
        <p class="objet"><b>Objet : '.$_POST['texte6'].'</b></p>
        <div class="corps">
        <p>Hello Lorem ipsum dolor sit amet, <strong>'.$_POST['texte9'].'</strong> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p>Hello Lorem <strong>'.$_POST['texte10'].'</strong> ipsum dolor sit amet, adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p>Hello Lorem ipsum dolor sit amet, adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna <strong>'.$_POST['texte11'].'</strong>.</p>
          <p>Hello Lorem ipsum dolor sit amet, <strong>'.$_POST['texte12'].'</strong> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p>Hello Lorem ipsum dolor sit <strong>'.$_POST['texte13'].'</strong> amet, adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p>Hello Lorem ipsum dolor sit amet, adipiscing elit, sed do eiusmod tempor incididunt <strong>'.$_POST['texte14'].'</strong> ut labore et dolore magna aliqua.</p>
          <p>Hello Lorem ipsum dolor sit amet, adipiscing elit, sed do eiusmod tempor incididunt ut labore et <strong>'.$_POST['texte15'].'</strong> dolore magna aliqua.</p>
          <p>Hello Lorem ipsum dolor sit amet, <strong>'.$_POST['texte16'].'</strong> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p>Hello Lorem ipsum dolor sit amet, <strong>'.$_POST['texte17'].'</strong> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p>Hello Lorem ipsum dolor sit amet, <strong>'.$_POST['texte18'].'</strong> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p>Hello Lorem ipsum dolor sit amet, <strong>'.$_POST['texte19'].'</strong> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p>Hello Lorem ipsum dolor sit amet, <strong>'.$_POST['texte20'].'</strong> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p>Hello Lorem ipsum dolor sit amet, <strong>'.$_POST['texte13'].'</strong> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p>Hello Lorem ipsum dolor sit amet, <strong>'.$_POST['texte14'].'</strong> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p>Hello Lorem ipsum dolor sit amet, <strong>'.$_POST['texte15'].'</strong> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p>Hello Lorem ipsum dolor sit amet, <strong>'.$_POST['texte16'].'</strong> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p>Hello Lorem ipsum dolor sit amet, <strong>'.$_POST['texte17'].'</strong> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p>Hello Lorem ipsum dolor sit amet, <strong>'.$_POST['texte18'].'</strong> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p>Hello Lorem ipsum dolor sit amet, <strong>'.$_POST['texte19'].'</strong> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p>Hello Lorem ipsum dolor sit amet, <strong>'.$_POST['texte20'].'</strong> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
</body>
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