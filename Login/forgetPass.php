<!DOCTYPE html>
<html>
	<head>
		<title>GamingShop Mot de passe oublié</title>
		<link rel="stylesheet" type="text/css" href="../Styles/style_login.css">
		<link rel="stylesheet" type="text/css" href="../Styles/snakebar.css">
		<?php
		    session_start();
		    if ($_SESSION != null)
		    {
		        $user=$_SESSION['username'];
		        echo "<script>alert('Your are allready login as : $user')</script>";
		        echo "<script>document.location.href='../index.php'</script>";
		    }

		    if (isset($_GET['pseudo'])) {
		    	$pseudo = $_GET['pseudo'];
		    }else{
		    	$pseudo ="";
		    }

		?>
	</head>

	<body>
		<div class="dark"></div>
		<div id="container">
            <form action="../php/forgetPass.php" method="POST">
                <label>Entrer votre adresse mail :</label>
                <input type="email" name="mail">
                <input type="submit" value="Envoyer" name="submit">
                <a href="index.php">Annuler</a>
            </form>
        </div>
         <?php
            if(isset($_GET['msg'])):?>
            
			<div id="snackbar"><?php echo $_GET['msg']; ?></div>
			<script>
			  var x = document.getElementById("snackbar");
			  x.className = "show";
			  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
			</script>
		<?php endif ?>
	</body>
</html>
