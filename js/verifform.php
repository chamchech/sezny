<?php 
include_once('con_bdd.php');

if(isset($_POST['rcsverif'])){
    $rcs = $_POST['rcsverif'];

    $sql = "SELECT * FROM clients_mepery WHERE rcs='$rcs'";
    $result = $bdd->query($sql);
    $rows = $result->rowCount();

    if($rows >= 1){
        echo "Le numéro RCS que vous venez de rentré est deja utilisé";
    }
}

if(isset($_POST['mailverif'])){
    $mail = $_POST['mailverif'];

    $sql = "SELECT * FROM clients_mepery WHERE email='$mail'";
    $result = $bdd->query($sql);
    $rows = $result->rowCount();

    if($rows >= 1){
        echo "L'email que vous venez de rentré est deja utilisé";
    }
}

if(isset($_POST['raisonsocialverif'])){
    $rs = $_POST['raisonsocialverif'];

    $sql = "SELECT * FROM clients_mepery WHERE raison_sociale='$rs'";
    $result = $bdd->query($sql);
    $rows = $result->rowCount();

    if($rows >= 1){
        echo "La raison social que vous venez de rentré est deja utilisé";
    }
}
?>