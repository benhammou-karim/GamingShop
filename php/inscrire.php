<?php  
if (isset($_POST['formins'])){
    if (!empty($_POST['nom']) AND !empty($_POST['prenom'])  AND !empty($_POST['pseudo']) AND !empty($_POST['code']) AND !empty($_POST['adresse']) AND !empty($_POST['mdp']) AND !empty($_POST['ville']) AND !empty($_POST['telephone']) AND !empty($_POST['mdp2']) AND !empty($_POST['mail']) AND !empty($_POST['mail2'])){

        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $code = htmlspecialchars($_POST['code']);
        $adresse = htmlspecialchars($_POST['adresse']);
        $mdp = $_POST['mdp'];
        $mdp2 = $_POST['mdp2'];
        $hash_passwd = sha1($mdp);
        $mail = htmlspecialchars($_POST['mail']);
        $mail2 = htmlspecialchars($_POST['mail2']);
        $ville = htmlspecialchars($_POST['ville']);
        $tel = htmlspecialchars($_POST['telephone']);
        
        $prenomlength = strlen($prenom);
        $nomlength = strlen($nom);
        $mdplength = strlen($mdp);

        if ($nomlength < 30 AND $prenomlength < 30)
        {
            if ($mail == $mail2){
                if(filter_var(trim($mail),FILTER_VALIDATE_EMAIL)){

					$clients = simplexml_load_file('../data/clients.xml');
					$mailverif = 0;
                    foreach($clients->client as $c){
                            if($c->mail==$mail)
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
							
								$client = $clients->addChild('client');
								$client->addAttribute('numclient',  $clients->client[$clients->count()-2]->attributes()['numclient']+1);
								$client->addChild('prenom', $prenom);
								$client->addChild('nom', $nom);
								$client->addChild('adresse', $adresse);
								$client->addChild('code_postal', $code);
                                $client->addChild('ville', $ville);
                                $client->addChild('tel', $tel);
								$client->addChild('mail', $mail);
								$client->addChild('user', $pseudo);
								$client->addChild('passwd', $hash_passwd);
								$client->addChild('admin', "0");
                                $client->addChild('img', "../Styles/images/profiles/profile.png");
										
								$dom = new DOMDocument('1.0');
								$dom->preserveWhiteSpace = false;
								$dom->formatOutput = true;
								$dom->loadXML($clients->asXML());
								$dom->save('../data/clients.xml');			

                                $mail1 = $mail;

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
                    </style>
                    </head>
                    <body>
                    <p>Merci d'inscrire sur GamingShop</p>
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
                    $mail->Subject = "Merci d'inscrire";
                    $mail->Body = $message;
                    $mail->AddAddress($mail1);

                    $mail->Send();

                    $valider = "Votre compte a bien été enregistré";
                    header("location: ../login/index.php?pseudo=$pseudo");
									
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