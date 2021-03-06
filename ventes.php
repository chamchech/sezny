<?php
session_start();
include 'db.php';
if(!isset($_SESSION['vendeur_id'])){
    header('location:connexion.php');
}
if(isset($_POST["data"])){
    echo $_POST["data"];
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="56x56" href="assets/img/favicon-96x96.png">
    <title>Mes ventes - Abonnement Juridique MEPERY</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/album.css" rel="stylesheet">

<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
<!--Font Awesome (added because you use icons in your prepend/append)-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Inline CSS based on choices in "Settings" tab -->
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>
<!-- <style>

table {
	background:#666;
	border-collapse:collapse;
	width:100%;
}
th, td {
	text-align:center;
	padding:5px;
	border-right:1px solid black;
}
th:last-child, td:last-child {
	border-right:0;
}
tbody tr:nth-child(odd) {
	background:#ccc;
}
tbody tr:nth-child(even) {
	background:#aaa;
}
@media screen and (max-width:600px) {
	table {
		display:flex;
	}
	thead {
		width:20%;
		min-width:90px;
	}
	tbody {
		flex:1;
	}
	tr {
		display:flex;
		flex-direction:column;
	}
	th, td {
		text-align:left;
		border-right:0;
		border-bottom:1px solid black;
	}
	tr:last-child td:last-child {
		border-bottom:0;
	}
	tbody tr:not(:first-child) td::before {
		position:absolute;
		content:'Date';
		font-weight:bold;
		width:calc(20% - 13px);
		min-width:90px;
		padding:5px;
		border-bottom:1px solid black;
		margin-left:calc(-20% - 2px);
		margin-top:-5px;
	}
	tbody tr:last-child td:last-child::before {
		border-bottom:0;
	}
	tbody tr:not(:first-child) td:nth-of-type(2)::before {
		content:'Raison Social';
	}
	tbody tr:not(:first-child) td:nth-of-type(3)::before {
		content:'Nom Contact';
	}
    tbody tr:not(:first-child) td:nth-of-type(4)::before {
		content:'Adresse email';
	}
    tbody tr:not(:first-child) td:nth-of-type(5)::before {
		content:'CP/Ville';
	}
    tbody tr:not(:first-child) td:nth-of-type(6)::before {
		content:'Sign??';
	}

}
@media screen and (max-width:461px) {
	tbody tr:not(:first-child) td::before {
		margin-left:-95px;
	}
}
@media screen and (max-width:800px) {
    table{
        margin-left: -5%;
    }
}
		</style> -->
</head>
<body>
<div id="page">
        <div id="bloc-principal">
        <?php include 'nav.php'; ?>
    <main role="main">
        <?php if(isset($msg)){ echo $msg; } ?>
        <section class="jumbotron text-center" style="padding:20px">
            <div class="container">
                <h1 class="jumbotron-heading">Mes ventes</h1>
                <a href="accueil.php"><svg class="bi bi-arrow-bar-left" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M5.854 4.646a.5.5 0 00-.708 0l-3 3a.5.5 0 000 .708l3 3a.5.5 0 00.708-.708L3.207 8l2.647-2.646a.5.5 0 000-.708z" clip-rule="evenodd"/>
  <path fill-rule="evenodd" d="M10 8a.5.5 0 00-.5-.5H3a.5.5 0 000 1h6.5A.5.5 0 0010 8zm2.5 6a.5.5 0 01-.5-.5v-11a.5.5 0 011 0v11a.5.5 0 01-.5.5z" clip-rule="evenodd"/>
</svg> Retour</a>
            </div>
        </section>
        <div class="album py-5 bg-light">
            <div class="container">
            <div class="text-right" >
    <form class="form-inline" method="post">
       <div class="form-group" style="margin: auto;text-align:right;margin-right: 0px;margin-bottom: 10px;">
       <label class="control-label requiredField" for="date">
       Du
       <span class="asteriskField">
        *
       </span>
      </label> 
      &nbsp; 
        <input class="form-control form-control-sm" id="date" name="fromdate" placeholder="AA-MM-JJ" type="text" autocomplete="off" value='<?php if(isset($_POST['fromDate'])) echo $_POST['fromDate']; ?>'/>
        &nbsp;
      <label  class="control-label requiredField" for="date1">
       Au
       <span class="asteriskField">
        *
       </span>
      </label>
     
      &nbsp;
        <input class="form-control form-control-sm" id="date1" name="enddate" placeholder="AA-MM-JJ" type="text" autocomplete="off" value='<?php if(isset($_POST['endDate'])) echo $_POST['endDate']; ?>'/>
        &nbsp;
     
       <button class="btn btn-primary btn-sm form-control-sm" name="but_search" type="submit">
       <i class="fa fa-search"></i>
       </button>
       </div>
    </form>
    </div>
                <div class="row justify-content-center" id="details">
                    <div class="col-md-12">                        
                        <table class="table table-striped" id="tb1"  cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Date</th>
                                <th>Raison Sociale</th>
                                    <th>Nom Contact</th>
                                    <th>Dur??e/Prix</th>
                                    <th>CP/Ville</th>
                                    <th>Sign??</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql_str = "select * from ventes where vendeur_id = ?";

                                     // Date filter
                                    if(isset($_POST['but_search'])){
                                        $fromDate = $_POST['fromdate'];
                                        $endDate = $_POST['enddate'];

                                        if(!empty($fromDate) && !empty($endDate)){
                                        $sql_str .= " and Date_vente 
                                                        between '".$fromDate."' and '".$endDate."' ";
                                        }
                                    }

                                    // Sort
                                    $sql_str .= " ORDER BY Date_vente DESC";

                                    $stmt = $sql->prepare($sql_str);
                                    $stmt->bindParam(1, $_SESSION['vendeur_id'], PDO::PARAM_INT);
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();
                                    foreach($result as $row){
                                ?>
                                <tr>
                                <td><?php echo $row['Date_vente']; ?></td>
                                <td><?php echo $row['raisonsocial']; ?></td>
                                    <td><?php echo $row['nomcontact']; ?></td>
                                    <td><?php echo $row['drop1'].' - '.$row['drop2']; ?></td>
                                    <td><?php echo $row['cp'].' '.$row['ville']; ?></td>
                                    <td><?php echo $row['signed']; ?></td>
                                    
                                   <td>
                                    <a href="form-details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Voir d??tails</a>
                                    </td>
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

    </div><!-- fin page -->
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/locales/bootstrap-datepicker.fr.min.js"></script>
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


<script type="text/javascript">
$(document).ready(function(){

var table = $('#tb1').DataTable( {
    lengthChange: false,
     "language": {
    "sEmptyTable":     "Aucune donn??e disponible dans le tableau",
    "sInfo":           "Affichage des ventes _START_ ?? _END_ sur _TOTAL_ ventes",
    "sInfoEmpty":      "Affichage des ventes 0 ?? 0 sur 0 vente",
    "sInfoFiltered":   "(filtr?? ?? partir de _MAX_ ventes au total)",
    "sInfoPostFix":    "",
    "sInfoThousands":  ",",
    "sLengthMenu":     "Afficher _MENU_ ventes",
    "sLoadingRecords": "Chargement...",
    "sProcessing":     "Traitement...",
    "sSearch":         "Rechercher :",
    "sZeroRecords":    "Aucun ??l??ment correspondant trouv??",
    "oPaginate": {
        "sFirst":    "Premier",
        "sLast":     "Dernier",
        "sNext":     "Suivant",
        "sPrevious": "Pr??c??dent"
    },
    "oAria": {
        "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
        "sSortDescending": ": activer pour trier la colonne par ordre d??croissant"
    },
    "select": {
            "rows": {
                "_": "%d lignes s??lectionn??es",
                "0": "Aucune ligne s??lectionn??e",
                "1": "1 ligne s??lectionn??e"
            } 
    }
     },
    buttons: [ { extend: 'copy', text: 'Copie' }, 'excel', 'pdf',{ extend: 'colvis', text: 'Visibilit?? des colonnes' } ]
} );

table.buttons().container()
    .appendTo( '#details .col-md-6:eq(0)' );})
$(document).ready(function(){

  $('#date').datepicker({
   format: "yy-mm-dd",
   startDate: '-1y -1m',
   autoclose:true,
   endDate: '0d',
   language:'fr'
   
  });

  $('#date1').datepicker({
   format: "yy-mm-dd",
   startDate: '-1y -1m',
   autoclose:true,
   endDate: '0d',
   language:'fr'
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