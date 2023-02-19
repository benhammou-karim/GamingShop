<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="../Styles/snakebar.css">
	<head>
		<title>GamingShop Login</title>
		<link rel="stylesheet" type="text/css" href="../Styles/style_login.css">
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
            <form action="verif.php" method="POST">
                <h1>Se connecter</h1><hr>
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer votre nom d'utilisateur" name="username" value="<?php echo $pseudo; ?>" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer votre mot de passe" name="password" required>

                <input type="submit" id='submit' value='Connecter' >
                <button id="inscrire_dmd"><a href="inscrire.php">Pas de compte? Inscrire</a></button>
                <a href="forgetPass.php">Mot de passe oublié?</a>
                <a href="../index.php" id="accueil">Annuler</a>
            </form>
        </div>
                <?php
	                if(isset($_GET['erreur'])):
	                    $err = $_GET['erreur'];
	                    if($err==1 || $err==2)
	                        $erreur = "Nom d'utilisateur ou Mot de passe incorrect";?>
	                
					<div id="snackbar"><?php echo $erreur; ?></div>
					<?php elseif(isset($_GET['msg'])): ?>
						<div id="snackbar"><?php echo $_GET['msg']; ?></div>
				<?php endif ?>
					<script>
					  var x = document.getElementById("snackbar");
					  x.className = "show";
					  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
					</script>
	</body>
</html>
