<?php 
	include_once 'getClients.php';
	session_start();
	if (isset($_POST['submail'])) {
		if ($_SESSION != null) {
			if (!empty($_POST['message'])){
				$numclient = $_SESSION['numclient'];
				$cli = getClientById($numclient);
			   	
			   	if (!empty($_POST['subject']))
					addMail($cli['mail'],$cli['nom'],$cli['prenom'],$_POST['subject'],$_POST['message']);
				else
					addMail($cli['mail'],$cli['nom'],$cli['prenom'],"",$_POST['message']);

		        header("Location: ../User/main.php?msg=Votre mail a été bien envoyer");
		    }else{
		    	header("Location: ../User/main.php?msg=Il faut remplir le champ message");
		    }
		}else{
			if (!empty($_POST['message']) && !empty($_POST['mail']) && filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL)){

				$clients = getAllClients();
				foreach ($clients as $key => $client) {
					echo "CODE TEST";
					if ($client['mail'] == $_POST['mail']) {
						header("Location: ../login/index.php?msg=Vous avez déja inscrie! connecté pour envoyer un message");
						goto a;
					}
				}

				require_once 'PHPMailer/PHPMailerAutoload.php';
				$mail = new PHPMailer();
			    $message = "
			    	<!DOCTYPE html>
			    	<html>
			    	<head>
			    	<style>
			    		#sub{
			    			width:auto;
			    			display:block;
			    			font-size:14pt;
			    			padding:3px 10px;
			    			margin: 5px auto;
			    			background-color:#19191E;
			    			color:white;
			    		}
			    	</style>
			    	</head>
			    	<body>
			    	<form action='http://localhost/gamingshop/php/contactus.php' method='POST'>
			    		<p>Quelqu'un a essayé d'envoyer un message au admin GamingShop par cette email.</p>
			    		<input type='hidden' name='nom' value='".$_POST['nom']."'>
			    		<input type='hidden' name='prenom' value='".$_POST['prenom']."'>
			    		<input type='hidden' name='mail' value='".$_POST['mail']."'>
			    		<input type='hidden' name='subject' value='".$_POST['subject']."'>
			    		<input type='hidden' name='message' value='".$_POST['message']."'>
			    		<input type='submit' id='sub' name='valid' value='Oui c&apos;est moi'>
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
				$mail->Subject = 'Confirmation de votre mail';
				$mail->Body = $message;
				$mail->AddAddress($_POST['mail']);

				$mail->Send();

				header("Location: ../User/main.php?msg=Un message de confirmation a été envoyé a votre mail");
				a:
			}else{
				header("Location: ../User/main.php?msg=Il faut remplir les champs message et mail");
			}
		}
	}

	if (isset($_POST['valid'])) {
		if (!empty($_POST['mail']) && !empty($_POST['message'])) {

			if (empty($_POST['subject']) && !empty($_POST['nom']) && !empty($_POST['prenom']))
				addMail($_POST['mail'],$_POST['nom'],$_POST['prenom'],"",$_POST['message']);

			elseif(empty($_POST['subject']) && empty($_POST['nom']) && !empty($_POST['prenom']))
				addMail($_POST['mail'],"Inconnu",$_POST['prenom'],"",$_POST['message']);

			elseif(empty($_POST['subject']) && empty($_POST['nom']) && empty($_POST['prenom']))
				addMail($_POST['mail'],"Inconnu","Inconnu","",$_POST['message']);

			elseif(!empty($_POST['subject']) && !empty($_POST['nom']) && !empty($_POST['prenom']))
				addMail($_POST['mail'],$_POST['nom'],$_POST['prenom'],$_POST['subject'],$_POST['message']);

			elseif(!empty($_POST['subject']) && empty($_POST['nom']) && empty($_POST['prenom']))
				addMail($_POST['mail'],"Inconnu","Inconnu",$_POST['subject'],$_POST['message']);

			elseif(!empty($_POST['subject']) && !empty($_POST['nom']) && empty($_POST['prenom']))
				addMail($_POST['mail'],$_POST['nom'],"Inconnu",$_POST['subject'],$_POST['message']);

			elseif(!empty($_POST['subject']) && empty($_POST['nom']) && !empty($_POST['prenom']))
				addMail($_POST['mail'],"Inconnu",$_POST['prenom'],$_POST['subject'],$_POST['message']);

			elseif(empty($_POST['subject']) && !empty($_POST['nom']) && empty($_POST['prenom']))
				addMail($_POST['mail'],$_POST['nom'],"Inconnu","",$_POST['message']);

			header("Location: ../User/main.php?msg=Message bien envoyée");
		}
	}

	function addMail($from,$nom='Inconnu',$prenom='Inconnu',$subject='',$message)
	{
		$msg = htmlspecialchars($message);
        $subject = htmlspecialchars($subject);
        $nom = htmlspecialchars($nom);
        $prenom = htmlspecialchars($prenom);

	    $mails = simplexml_load_file('../data/mails.xml');
		$mail = $mails->addChild('mail');
		$mail->addAttribute('nummail',$mails->count()  );
		$mail->addChild('from',$from);
		$mail->addChild('nom',$nom);
		$mail->addChild('prenom',$prenom);
		$mail->addChild('subject',$subject);
		$mail->addChild('msg',$message);

		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($mails->asXML());
		$dom->save('../data/mails.xml');
	}
 ?>