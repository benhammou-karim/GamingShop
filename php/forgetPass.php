<?php  

	include_once 'getClients.php';
	if (isset($_POST['submit'])) {
		if (!empty($_POST['mail'])) {
			$cli = getAllClients();
			foreach ($cli as $key => $value) {
				if (trim($value['mail']) == trim($_POST['mail'])) {
					$newPass = generateRandomString(12);

					$clients = simplexml_load_file('../data/clients.xml');
				    $i = 0; 
				    $numItems = $clients->client->count();
				    $j=0;
				    foreach($clients->client as $c){
				        if(trim($c->attributes()) == trim($value['numclient'])){
				        	$numclient = $clients->client[$clients->count()-2]->attributes()['numclient']+1;
							$prenom = $c->prenom;
							$nom = $c->nom;
							$adresse = $c->adresse;
							$code_postal = $c->code_postal;
							$mail = $c->mail;
							$user = $c->user;
							$passwd = $c->passwd;
							$img = $c->img;
							$tel = $c->tel;
							$admin = $c->admin;
							$ville = $c->ville;

							$client = $clients->addChild('client');
							$client->addAttribute('numclient', $numclient);
							$client->addChild('prenom',$prenom);
							$client->addChild('nom',$nom);
							$client->addChild('adresse',$adresse);
							$client->addChild('code_postal',$code_postal);
							$client->addChild('ville',$ville);
							$client->addChild('tel',$tel);
							$client->addChild('mail',$mail);
							$client->addChild('user',$user);
							$client->addChild('img',$img);
							$client->addChild('admin',$admin);
							$client->addChild('passwd',sha1($newPass));

							unset($clients->client[$i]);

							$dom = new DOMDocument('1.0');
							$dom->preserveWhiteSpace = false;
							$dom->formatOutput = true;
							$dom->loadXML($clients->asXML());
							$dom->save('../data/clients.xml');

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
				    	span{
				    		background-color:#19191E;
				    		color:#44D62C;
				    		font-size: 16pt;
				    		display:block;
				    		width:50%;
				    		border-radius:10px;
				    		margin:10px auto;
				    		text-align:center;
				    	}
				    </style>
				    </head>
				    <body>
				    <p>GamingShop</p>
				    Votre nouvelle mot de passe :
					<span>".$newPass."</span>
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
					$mail->Subject = 'Chengement de mot de passe';
					$mail->Body = $message;
					$mail->AddAddress($value['mail']);

					$mail->Send();

							break;
				        }
				        $i++;
				    }
				    header("location: ../Login/index.php?msg=Un nouveau mot de passe a été envoyer a votre boite mail");
					break;
				}
			}
		}else{
			header("location: ../Login/forgetPass.php?msg=Entrer votre mail");
		}
	}

	header("location: ../Login/forgetPass.php?msg=Il n'y a aucune compte avec ce mail");
	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
?>