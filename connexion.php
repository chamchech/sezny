<?php
session_start();
include 'db.php';
if(isset($_SESSION['vendeur_id'])){
    header("location:accueil.php");
}

if(isset($_POST['valider'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $sql->prepare("SELECT * from vendeurs WHERE username = ?");
    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->execute();
    if($stmt->rowCount()>0){
        $row = $stmt->fetch();
        if($username == $row['username'] && password_verify($password, $row['password'])){
           $_SESSION['vendeur_id'] = $row['id'];
           header('location:accueil.php');
        }else {
            $msg = "<div style='background:red;color:white;border-color:red;border-radius:5px;padding:10px;margin-top:5px'>L'identifiant ou le mot de passe est incorrect</div>";
        }
    }else{
        $msg = "<div style='background:red;color:white;border-color:red;border-radius:5px;padding:10px;margin-top:5px'>L'identifiant ou le mot de passe est incorrect</div>";
    }
    //header('location:index.php?reg_success');
}

?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Connexion - Sezny</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" sizes="56x56" href="assets/img/favicon-96x96.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/fav-icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/fav-icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/fav-icon/favicon-16x16.png">
   <!-- <link rel="manifest" href="images/fav-icon/site.webmanifest">-->
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/connexion.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<!--===============================================================================================-->
</head>

<body>
	<div class="container">
        <img class="wave" src="images/back-sezny2.png">
		<div class="img">

		</div>
		<div class="login-content">
			<form class="login100-form validate-form" method="post" action="">
				<img src="images/avatar_sezny2.png">
				<h2 class="title"> S'identifier</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Identifiant</h5>
           		   		<input type="text" class="input"  name="username" >
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
            	<input type="submit" name="valider" class="btn" value="Connexion">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/connexion.js"></script>
</body>

</html>