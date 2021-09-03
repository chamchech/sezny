<?php
session_start();
include '../db.php';
include '../app_config.php';
if(!isset($_SESSION['admin'])){
    header('location:connexion.php');
}


if(isset($_GET['delete'])){
    $sellerid = $_GET['delete'];
    $stmt = $sql->prepare("delete from ventespro where id=?");
    $stmt->bindParam(1, $sellerid, PDO::PARAM_INT);
    $stmt->execute();
    $msg = "<div class='alert alert-success'>Client supprimer avec succès</div>";
}

if(isset($_GET["download"])){
    $sellerid = $_GET['download'];
    $stmt = $sql->prepare("SELECT files from ventespro where id=?");
    $stmt->bindParam(1, $sellerid, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll();
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
    $resp=CurlSendGetRequest($api_url.$data[0]['files']."/download?alt=media",$headers);
    header('Content-type: application/pdf');
    echo $resp;
}


function addedBy($id){
    global $sql;
    $stmt = $sql->prepare("select firstname,lastname from vendeurs where id = ?");
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['firstname'].' '.$result['lastname'];
    }


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="56x56" href="assets/img/favicon-96x96.png">
    <title>Clients Pro - SEZNY</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/album.css" rel="stylesheet">
</head>
<body>
<div id="page">
        <div id="bloc-principal">
        <?php include 'nav.php'; ?>
    <main role="main">
        <?php if(isset($msg)){ echo $msg; } ?>
        <section class="jumbotron text-center" style="padding:20px">
            <div class="container">
                <h1 class="jumbotron-heading">Clients Pro</h1>

            </div>
        </section>
        <div class="album py-5 bg-light">
            <a class="retour" href="index.php"><svg class="bi bi-arrow-bar-left" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5.854 4.646a.5.5 0 00-.708 0l-3 3a.5.5 0 000 .708l3 3a.5.5 0 00.708-.708L3.207 8l2.647-2.646a.5.5 0 000-.708z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M10 8a.5.5 0 00-.5-.5H3a.5.5 0 000 1h6.5A.5.5 0 0010 8zm2.5 6a.5.5 0 01-.5-.5v-11a.5.5 0 011 0v11a.5.5 0 01-.5.5z" clip-rule="evenodd"/>
                </svg> Retour</a>
            <div class="container">
            <form class="form-inline" method="post">
                    <div class="form-group" style="margin: auto;text-align:right;margin-right: 0px;margin-bottom: 10px;">
                    <label class="control-label requiredField" for="date">
                    Du
                    <span class="asteriskField">
                        *
                    </span>
                    </label> 
                    &nbsp; 
                        <input class="form-control form-control-sm" id="date" name="fromdate" placeholder="AA-MM-JJ" type="text" value='<?php if(isset($_POST['fromDate'])) echo $_POST['fromDate']; ?>'/>
                        &nbsp;
                    <label  class="control-label requiredField" for="date1">
                    Au
                    <span class="asteriskField">
                        *
                    </span>
                    </label>
                    
                    &nbsp;
                        <input class="form-control form-control-sm" id="date1" name="enddate" placeholder="AA-MM-JJ" type="text" value='<?php if(isset($_POST['endDate'])) echo $_POST['endDate']; ?>'/>
                        &nbsp;
                    
                    <button class="btn btn-primary btn-sm form-control-sm" name="but_search" type="submit">
                    <i class="fa fa-search"></i>
                    </button>
                    </div>
            </form>
                <div class="row justify-content-center" id="details">
                    <div class="col-md-12">
                        
                        <table class="table table-striped" id="tb1" style="width: 1000px">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Raison Sociale</th>
                                    <th>Nom Contact</th>
                                   <!-- <th>Durée/Prix</th>-->
                                    <th>CP/Ville</th>
                                    <th>Ajouté par</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($_GET['sid'])){
                                        $stmt = $sql->prepare("select * from ventespro where vendeur_id = ? order by id asc");
                                        $stmt->bindParam(1, $_GET['sid'], PDO::PARAM_INT);
                                    }else if(isset($_POST['but_search']) && $_POST['fromdate'] != '' && $_POST['enddate'] != ''){
                                        $sql_str = "select * from ventespro where";
                                        $fromDate = $_POST['fromdate'];
                                        $endDate = $_POST['enddate'];
                                        if(!empty($fromDate) && !empty($endDate)){
                                        $sql_str .= " Date_vente 
                                                        between '".$fromDate."' and '".$endDate."' ";
                                        // Sort
                                        $sql_str .= " ORDER BY Date_vente DESC";
                                        $stmt = $sql->prepare($sql_str);
                                        }
                                    }else{
                                        $stmt = $sql->prepare("select * from ventespro order by id asc");
                                    }
                                    
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();
                                    foreach($result as $row){
                                ?>
                                <tr>
                                    <td><?php echo $row['Date_vente']; ?></td>
                                    <td><?php echo $row['raisonsocial']; ?></td>
                                    <td><?php echo $row['nomcontact']; ?></td>
                                  <!--  <td><?php //echo $row['drop1'].' - '.$row['drop2']; ?></td>-->
                                    <td><?php echo $row['cp'].' '.$row['ville']; ?></td>
                                    <td><?php echo addedBy($row['vendeur_id']); ?></td>
                                   <td>
                                       <a href="details-client-pro.php?id=<?php echo $row['id']; ?>" class="btn btn-dark btn-sm">Voir détails</a></td>
                                    <td>
                                        <a href="clients-pro.php?download=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Télécharger</a></td>
                                   <td> <a onclick="return confirm('Voulez vous vraiment supprimer ce client ?')" href="clients-pro.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>

       
</div>

    </div>
    <!-- fin page -->
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/holder.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"></link>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css"></link>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css"></link>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">





<script type="text/javascript">
$(document).ready(function(){

var table = $('#tb1').DataTable( {
    lengthChange: false,
     "language": {
    "sEmptyTable":     "Aucune donnée disponible dans le tableau",
    "sInfo":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
    "sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
    "sInfoFiltered":   "(filtré à partir de _MAX_ éléments au total)",
    "sInfoPostFix":    "",
    "sInfoThousands":  ",",
    "sLengthMenu":     "Afficher _MENU_ éléments",
    "sLoadingRecords": "Chargement...",
    "sProcessing":     "Traitement...",
    "sSearch":         "Rechercher :",
    "sZeroRecords":    "Aucun élément correspondant trouvé",
    "oPaginate": {
        "sFirst":    "Premier",
        "sLast":     "Dernier",
        "sNext":     "Suivant",
        "sPrevious": "Précédent"
    },
    "oAria": {
        "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
        "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
    },
    "select": {
            "rows": {
                "_": "%d lignes sélectionnées",
                "0": "Aucune ligne sélectionnée",
                "1": "1 ligne sélectionnée"
            } 
    }
     },
    buttons: [ { extend: 'copy', text: 'Copie' }, 'excel', 'pdf',{ extend: 'colvis', text: 'Visibilité des colonnes' } ]
} );

table.buttons().container()
    .appendTo( '#details .col-md-6:eq(0)' );})


$(document).ready(function(){

  $('#date').datepicker({
   format: "yy-mm-dd",
   startDate: '-1y -1m',
   autoclose:true,
   endDate: '0d'
  });

  $('#date1').datepicker({
   format: "yy-mm-dd",
   startDate: '-1y -1m',
   autoclose:true,
   endDate: '0d'
  }); 

  $('#date,#date1').change(function(){
    var minDate = $("#date").val();
    var maxDate = $("#date1").val();
    console.log(minDate,maxDate)
    if(minDate != ''){
   $('#date1').datepicker("setStartDate",minDate);
  }
 
  if(maxDate != ''){
   $('#date').datepicker('setEndDate', maxDate);
  }
  })
});
</script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
</body>
</html>