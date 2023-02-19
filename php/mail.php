<?php  

	if (isset($_POST['formins'])){
	    if (!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['code']) AND !empty($_POST['adresse']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['ville']) AND !empty($_POST['telephone']) AND !empty($_POST['mail']) AND !empty($_POST['mail2'])){	

	    	$nom = htmlspecialchars($_POST['nom']);
	        $prenom = htmlspecialchars($_POST['prenom']);
	        $pseudo = htmlspecialchars($_POST['pseudo']);
	        $code = htmlspecialchars($_POST['code']);
	        $adresse = htmlspecialchars($_POST['adresse']);
	        $mdp = $_POST['mdp'];
	        $mdp2 = $_POST['mdp2'];
	        $hash_passwd = sha1($mdp);
	        $mail1 = htmlspecialchars($_POST['mail']);
	        $mail2 = htmlspecialchars($_POST['mail2']);
	        $ville = htmlspecialchars($_POST['ville']);
	        $tel = htmlspecialchars($_POST['telephone']);
	        
	        $prenomlength = strlen($prenom);
	        $nomlength = strlen($nom);
	        $mdplength = strlen($mdp);

		    if ($nomlength < 30 AND $prenomlength < 30)
	        {
	            if ($mail1 == $mail2){
	                if(filter_var($mail1,FILTER_VALIDATE_EMAIL)){

						$clients = simplexml_load_file('../data/clients.xml');
						$mailverif = 0;
	                    foreach($clients->client as $c){
	                            if($c->mail==$mail1)
								          $mailverif = 1; 
	                    }		
						
	                    if ($mailverif == 0){
							
							$pseudoVerif =0;
							foreach($clients->client as $c){
	                            if($c->user==$pseudo)
								          $pseudoVerif = 1; 
							}	
	                        if ($pseudoVerif == 0){

	                            if ($mdp == $mdp2 AND $mdplength >=6){
	                require_once 'PHPMailer/PHPMailerAutoload.php';
					$mail = new PHPMailer();
			        $message = "
				    <html>
				    <head>
				    <title>My Shop</title>
				    <style type='text/css'>
				    	p{
				    		text-align:center;
				    		background-color:#19191E;
				    		height:50px;
				    		color:white;
				    		font-size:18pt;
				    		padding-top:5px;
				    	}
				    	input{
				    		background-color:#19191E;
				    		color:#44D62C;
				    		font-size: 16pt;
				    	}
				    </style>
				    </head>
				    <body>
				    <p>GamingShop</p>
				    Merci de cliquer ci dessus pour confirmer votre email!
					<form action='http://localhost/gamingshop/php/inscrire.php' method='POST'>
					  <input type='hidden' name='nom' value='$nom'>
					  <input type='hidden' name='prenom' value='$prenom'>
					  <input type='hidden' name='pseudo' value='$pseudo'>
					  <input type='hidden' name='code' value='$code'>
					  <input type='hidden' name='adresse' value='$adresse;'>
					  <input type='hidden' name='mdp' value='$mdp'>
					  <input type='hidden' name='mdp2' value='$mdp2'>
					  <input type='hidden' name='mail' value='$mail1'>
					  <input type='hidden' name='mail2' value='$mail2'>
					  <input type='hidden' name='ville' value='$ville'>
					  <input type='hidden' name='telephone' value='$tel'>
					  <input type='submit' name='formins'>
					</form>
				    </body>
				    </html>
				    ";

			    	$mail->isSMTP();
					$mail->SMTPAuth =true;
					$mail->SMTPSecure = 'ssl';
					$mail->Host = 'smtp.gmail.com';
					$mail->Port = '465';
					$mail->isHTML();
					$mail->Username = 'gamingshop419@gmail.com';
					$mail->Password = 'pufdmrjlqtenpuxx';
					$mail->setFrom('no-reply@walid.com');
					$mail->Subject = 'Inscription sur GamingShop';
					$mail->Body = $message;
					$mail->AddAddress($mail1);

					$mail->Send();

					
							}
                            elseif ($mdplength < 6){
                                $erreur3 = "Votre mot de passe doit contenir au moins 6 caractères !";
                                header("location: ../login/inscrire.php?err=$erreur3");
                            }
                            else{
                                $erreur4 = "Les mot de passes ne correspondent pas !!";
                                header("location: ../login/inscrire.php?err=$erreur4");
                            }
                        }
                        else{
                            $erreur4 = "Pseudo déjâ utilisé !";
                            header("location: ../login/inscrire.php?err=$erreur4");
                        }
                    }
                    else{
                        $erreur = "Adresse mail deja utilisée !";
                        header("location: ../login/inscrire.php?err=$erreur");
                    }
                }
                else{
                    $erreur = "Votre adresse mail n'est pas valide !";
                    header("location: ../login/inscrire.php?err=$erreur");
                }
            }
            else{
                $erreur3 = "Les adresses mail ne correspondent pas !";
                header("location: ../login/inscrire.php?err=$erreur3");
            }
        }
        else{
            $erreur2 = "Votre Prenom et Nom ne peut contenir que 30 caractères !!";
            header("location: ../login/inscrire.php?err=$erreur2");
        }
    }
    else{
        $erreur = "Tout les champs ne sont pas correctement complètés ";
        header("location: ../login/inscrire.php?err=$erreur");
    }
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Attend d'inscription</title>
	<style type="text/css">
		body{
			background-color: #19191E;
		}
		div{
			position: absolute;
			transform: translate(-50%,-50%);
			left: 50%;
			top: 50%;
			background-color: #44D62C;
			font-size: 16pt;
			width: 30%;
			border-radius: 10px;
		}
		img{
			position: absolute;
			transform: translate(-50%,-50%);
			left: 50%;
			top: 30%;
			width: 40%;
			display: block;
			object-fit: contain;
		}
		p{
			text-align: center;
			font-family: sans-serif;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<img src="../styles/images/logo.png">
	<div>
		
		<p>Merci d'attendez de recevoir un email de confirmation</p>
	</div>
</body>
</html>