<?php
session_start();
include '../db.php';
if(isset($_SESSION['admin'])){
    header('location:index.php');
}

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $sql->prepare("SELECT * from admin WHERE email = ?");
    $stmt->bindParam(1, $email, PDO::PARAM_STR);
    $stmt->execute();
    if($stmt->rowCount()>0){
        $row = $stmt->fetch();
        if($email == $row['email'] && password_verify($password, $row['password'])){
           $_SESSION['admin'] = $row['id'];
           header('location:index.php');
        }else {
            $msg = "<div style='background:red;color:white;border-color:red;border-radius:5px;padding:10px;margin-top:5px'>L'identifiant ou le mot de passe est incorrect</div>";
        }
    }else{
        $msg = "<div style='background:red;color:white;border-color:red;border-radius:5px;padding:10px;margin-top:5px'>L'identifiant ou le mot de passe est incorrect</div>";
    }
    //header('location:index.php?reg_success');
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

    <title>Connexion - Abonnement Juridique MEPERY</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/connexion.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>

<body>
	<img class="wave" src="../images/wave.png">
	<div class="container">
		<div class="img">
			<img src="../images/bg.svg">
		</div>
		<div class="login-content">
			<form class="login100-form validate-form" method="post" action="">
				<img src="../images/avatar.svg">
				<h2 class="title">Cabinet Juridique MEPERY</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Adresse email</h5>
           		   		<input type="text" class="input"  name="email" >
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Mot de passe</h5>
           		    	<input type="password" class="input"  name="password" >
            	   </div>
            	</div>
				<?php if(isset($msg)){ echo $msg; } ?>
            	<input type="submit" name="submit" class="btn" value="Connexion">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../js/connexion.js"></script>
</body>

</html>