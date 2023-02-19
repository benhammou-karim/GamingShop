<!-- <?php					
//    include("../php/inscrire.php");
?> -->
 
<html> 
<head>
    <title>GamingShop Registery</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../Styles/style_login.css" media="screen" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../Styles/snakebar.css">
</head>
<body>
	<div class="dark"></div>
    <div align="center" id="container_inscrire">
        <form method="POST" action="../php/mail.php">
        	<h1>S'inscrire</h1><hr>
            <table>
                <tr>
                    <td><label for='nom'>Prenom :</label></td>
                    <td><input type="text" placeholder="Prenom" id='prenom' name='prenom'/></td>
                </tr>
                <tr>
                    <td><label for='nom'>Nom :</label></td>
                    <td><input type="text" placeholder="Nom" id='nom' name='nom'/></td>
                </tr>
                <tr>
                    <td><label for='nom'>Pseudo :</label></td>
                    <td><input type="text" placeholder="pseudo" id='pseudo' name='pseudo'/></td>
                </tr>
                <tr>
                    <td><label for='nom'>Adresse :</label></td>
                    <td><input type="text" placeholder="Adresse" id='adresse' name='adresse'/></td>
                </tr>
                <tr>
                    <td><label for='nom'>Ville :</label></td>
                    <td><input type="text" placeholder="Ville" id='ville' name='ville'/></td>
                </tr>
                <tr>
                    <td><label for='nom'>Téléphone :</label></td>
                    <td><input type="text" placeholder="Telephone" id='telephone' name='telephone'/></td>
                </tr>
                <tr>
                	<td><label for='nom'>Code postal :</label></td>
                    <td><input type="text" placeholder="Code postal" id='code postal' name='code'/></td>
                </tr>
                <tr>
                	<td><label for='nom'>Mot de passe :</label></td>
                    <td><input type="password" placeholder="Mot de passe" id='mdp' name='mdp'/></td>
                </tr>
                <tr>
                    <td><label for='nom'>Confirmer Mot de passe :</label></td>
                    <td><input type="password" placeholder="Répéter mot de passe" id='mdp2' name='mdp2'/></td>
                </tr>
                <tr>
                    <td><label for='nom'>E-mail :</label></td>
                    <td><input type="email" placeholder="user@mail.domain" id='mail' name='mail'/></td>
                </tr>
                <tr>
                    <td><label for='nom'>Confirmation Email :</label></td>
                    <td><input type="email" placeholder="user@mail.domain" id='mail2' name='mail2'/></td>
                </tr>
            </table>
            <input type="submit" name="formins" value="Submit"/>
            <a href="../index.php" id="accueil">Annuler</a>
	        
        </form>
    </div>
                <?php if(isset($_GET['err'])):?>
                    <div id="snackbar"><?php echo $_GET['err']; ?></div>
                <?php elseif(isset($valider)): ?>
                    <div id="snackbar"><?php echo $_GET['err']; ?></div>
                <?php elseif(isset($send)): ?>
                    <div id="snackbar"><?php echo $_GET['err']; ?></div>
                <?php endif ?>
                    <script>
                      var x = document.getElementById("snackbar");
                      x.className = "show";
                      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                    </script>
</body>
</html>