<?php
    session_start();
    require "../php/secure.php";

    if (isset($_POST['send'])){
        if ($_SESSION['admin'] == true)
        {
            if (!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['adresse']) AND !empty($_POST['code_postal']) AND !empty($_POST['mail']) AND !empty($_POST['user']) AND !empty($_POST['passwd']) AND !empty($_POST['ville']) AND !empty($_POST['tel']))
            {
                $prenom = htmlspecialchars($_POST['prenom']);
                $nom = htmlspecialchars($_POST['nom']);
                $adresse = htmlspecialchars($_POST['adresse']);
                $code_postal = htmlspecialchars($_POST['code_postal']);
                $mail = htmlspecialchars($_POST['mail']);
                $user = htmlspecialchars($_POST['user']);
                $ville = htmlspecialchars($_POST['ville']);
                $tel = htmlspecialchars($_POST['tel']);
                $passwd = $_POST['passwd'];
                $hash_passwd = sha1($passwd);
                $admin = htmlspecialchars($_POST['admin']);

                $clients = simplexml_load_file('../data/clients.xml');
                $num = securite_bdd($_POST['num']);
                $index = 0;
                $i = 0; 
                foreach($clients->client as $c){
                    if($c->attributes() == $num){
                        $index = $i;
                        break;
                    }
                    $i++;
                }
                unset($clients->client[$index]);

        		$client = $clients->addChild('client');
        		$client->addAttribute('numclient', $clients->client[$clients->count()-2]->attributes()['numclient']+1);
        		$client->addChild('prenom',$prenom);
        		$client->addChild('nom',$nom);
                $client->addChild('adresse',$adresse);
                $client->addChild('code_postal',$code_postal);
                $client->addChild('ville',$ville);
                $client->addChild('tel',$tel);
        		$client->addChild('mail',$mail);
        		$client->addChild('user',$user);
        		$client->addChild('passwd',$hash_passwd);
                $client->addChild('admin',$admin);			
        		
        		$dom = new DOMDocument('1.0');
        		$dom->preserveWhiteSpace = false;
        		$dom->formatOutput = true;
        		$dom->loadXML($clients->asXML());
        		$dom->save('../data/clients.xml');
		
				
                
                header('Location: ../admin/afficher-utilisateurs.php');
            }
            else { 
                header('Location: ../admin/afficher-utilisateurs.php');}

        }
        else{
            echo "<script>alert(\"Vous n'êtes pas authorisé à accèder a cette page !!\")</script>";
            header('Location: ../admin/admin.php');
        }


    }



?>