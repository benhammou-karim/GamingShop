<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="../Styles/snakebar.css">
<?php 
	session_start();
    if ($_SESSION == null){
      header('Location: ../login');
    }

   include_once '../php/getClients.php';
 	$cli = getClientById($_SESSION['numclient']);

    $title = "Profile";
    $style = "../Styles/style.css";
    include_once("../Templates/header.php");

 ?>
<style type="text/css">
	.container{
		margin:50px auto 100px;
		width: 90%;
	}
	.user{
		width: 40%;
		margin: 0 auto;
		//background-color: red;
	}
	.user img{
		width: 200px;
		height: 200px;
		border-radius: 100%;
		object-fit: cover;
		display: block;
		margin: 0 auto;
	}
	.user h3{
		text-align: center;
		font-size: 18pt;
		color: white;
	}

	.user p{
		text-align: center;
		color: white;
	}

	.wrapper{
		background-color: #19191E;
		border-radius: 30px;
		margin:-150px auto 0;
		padding: 160px 20px 20px;
		color: lightgreen;
	}

	.wrapper hr{
		background-color: lightgreen;
		border-color: lightgreen;
	}

	.wrapper p{
		font-size: 14pt;
		color: #D7D7D7;
		margin:3px 0 7px;
	}

	.wrapper div{
		padding: 0 30px;
		margin-bottom: 20px;
		color: #F4F4F4;
		font-size: 16pt;
	}

	.wrapper div table{
		width: 100%;
	}
	.wrapper div input{
		width: 90%;
		height: 30px;
		font-size: 14pt;
	}

	#contact td:first-child{
		width: 80%;
	}

	#apass{
		width: 77%;
	}

	input[type=submit]{
		display: block;
		width: 20%;
		height: 30px;
		font-size: 16pt;
		color: white;
		background-color: green;
		border: none;
		outline: none;
		cursor: pointer;
		margin: 10px auto;
		border-radius: 5px;
	}
	input[type=submit]:hover{
		background-color: darkgreen;
		font-size: 15pt;
	}
</style>


 <div class="container">
 	<div class="user">
 		<img src="<?php echo $cli['img']; ?>">
 		<h3><?php echo $cli['user']; ?></h3>
 		<p><?php echo $cli['mail']; ?></p>
 	</div>
 	
 	<div class="wrapper">
 		<form enctype="multipart/form-data" action="../php/editProfile.php" method="POST">
 		<hr>
 		<p>Informations d'utilisateur</p>
 		<div>
 			<table>
 				<tr><td>Nom d'utilisateur</td><td>E-mail</td></tr>
 				<tr>
 					<td><input type="text" id='user' name="user" value="<?php echo $cli['user']; ?>"/></td>
 					<td><input type="email" id='mail' name="mail" value="<?php echo $cli['mail']; ?>"/></td>
 				</tr>
 				<tr><td>Nom</td><td>Prenom</td></tr>
 				<tr>
 					<td><input type="text" id='nom' name="nom" value="<?php echo $cli['nom']; ?>"/></td>
 					<td><input type="text" id='prenom' name="prenom" value="<?php echo $cli['prenom']; ?>"/></td>
 				</tr>
 			</table>
 		</div>
 		<hr>
 		<p>Informations de contact</p>
 		<div>
 			<table id="contact">
 				<tr><td>Adresse</td><td>Code Postal</td></tr>
 				<tr>
 					<td><input type="text" id='adresse' name="adresse" value="<?php echo $cli['adresse']; ?>"/></td>
 					<td><input type="text" id='code_postal' name="code_postal" value="<?php echo $cli['code_postal']; ?>"/></td>
 				</tr>
 			</table>
 			 <table id="ville">
 				<tr><td>Ville</td><td>Téléphone</td></tr>
 				<tr>
 					<td><input type="text" id='ville' name="ville" value="<?php echo $cli['ville']; ?>"/></td>
 					<td><input type="text" id='tel' name="tel" value="<?php echo $cli['tel']; ?>"/></td>
 				</tr>
 			</table>
 		</div>
 		<hr>
 		<p>Mot de passe</p>
 		<div>
 			<table id="pass">
 				<tr><td colspan="2">Mot de passe : <input id="apass" type="text" name="apass"/></td></tr>
 				<tr><td>Nouveau mot de passe</td><td>Confirm nouveau mot de passe</td></tr>
 				<tr>
 					<td><input type="password" id='pass' name="pass"/></td>
 					<td><input type="password" id='passconf' name="passconf"/></td>
 				</tr>
 			</table>
 		</div>
 		<hr>
 		<p>Image de profile</p>
 		<div>
 			<input type="hidden" id='MAX_FILE_SIZE' name="MAX_FILE_SIZE" value="512000" />
		    Choisi un image : <input name="userfile" id='userfile' type="file" accept="image/*" />
		    
 		</div>
		    <input type="submit" id='submit' name="submit" value="Enregistrer" >
		</form>
 	</div>

 </div>
	<?php if (isset($_GET["msg"])): ?>
		<div id="snackbar"><?php echo $_GET["msg"]; ?></div>
		<script>
		  var x = document.getElementById("snackbar");
		  x.className = "show";
		  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
		</script>
	<?php endif ?>
 <?php include_once('../Templates/footer_2.php'); ?>