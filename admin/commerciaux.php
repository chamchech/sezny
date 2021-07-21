<?php
session_start();
include '../db.php';
if(!isset($_SESSION['admin'])){
    header('location:connexion.php');
}


if(isset($_GET['delete'])){
    $sellerid = $_GET['delete'];
    $stmt = $sql->prepare("delete from vendeurs where id=?");
    $stmt->bindParam(1, $sellerid, PDO::PARAM_INT);
    $stmt->execute();
    $msg = "<div class='alert alert-success'>Commercial supprimer avec succès.</div>";
}


function getTotalSales($id){
    global $sql;
     $stmt = $sql->prepare("select COUNT(*) as totalventes from ventes where vendeur_id = ?");
     $stmt->bindParam(1, $id, PDO::PARAM_INT);
     $stmt->execute();
     $result = $stmt->fetch();
     return $result['totalventes'];
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
    <title>Commerciaux - Abonnement Juridique MEPERY</title>
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
                <h1 class="jumbotron-heading">Commerciaux</h1>
                <a href="index.php"><svg class="bi bi-arrow-bar-left" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M5.854 4.646a.5.5 0 00-.708 0l-3 3a.5.5 0 000 .708l3 3a.5.5 0 00.708-.708L3.207 8l2.647-2.646a.5.5 0 000-.708z" clip-rule="evenodd"/>
  <path fill-rule="evenodd" d="M10 8a.5.5 0 00-.5-.5H3a.5.5 0 000 1h6.5A.5.5 0 0010 8zm2.5 6a.5.5 0 01-.5-.5v-11a.5.5 0 011 0v11a.5.5 0 01-.5.5z" clip-rule="evenodd"/>
</svg> Retour</a>
            </div>
        </section>
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    
                                    <th>Nom</th>
                                    <th>Identifiant</th>
                                    <th>Email</th>
                                    <th>CP/Ville</th>
                                    <th>Ventes</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $stmt = $sql->prepare("select * from vendeurs order by id asc");
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();
                                    foreach($result as $row){
                                ?>
                                <tr>
                                    <td><?php echo $row['firstname'].' '.$row['lastname']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['postcode'].' '.$row['city']; ?></td>
                                    <td><?php echo getTotalSales($row['id']); ?></td>
                                   
                                    <td>
                                    <a href="clients.php?sid=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Voir client</a>
                                    <a onclick="return confirm('Voulez vous vraiment le supprimer ?')" href="commerciaux.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a></td>
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
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/vendor/holder.min.js"></script>
</body>
</html>