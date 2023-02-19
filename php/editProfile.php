<?php 
    require "secure.php";
    include_once 'getClients.php';
	session_start();

 	$cli = getClientById($_SESSION['numclient']);

	if (!empty($_POST['apass']) && !empty($_POST['pass']) && !empty($_POST['passconf'])) {
		if (trim(sha1($_POST['apass'])) != trim($cli['passwd'])) {
			header("Location: ../User/userProfile.php?msg=Mot de passe incorrect");
		}elseif($_POST['pass'] != $_POST['passconf']){
			header("Location: ../User/userProfile.php?msg=Confirmation incorect");
		}
		edit();
	}elseif(empty($_POST['apass']) && empty($_POST['pass']) && empty($_POST['passconf'])){
		edit();
	}else{
		header("Location: ../User/userProfile.php?msg=il faut remplir tous les champs");
	}
	

	function edit(){
	$cli = getClientById($_SESSION['numclient']);
	if (!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['adresse']) AND !empty($_POST['code_postal']) AND !empty($_POST['mail']) AND !empty($_POST['user']) AND !empty($_POST['tel']) AND !empty($_POST['ville']))
	{

	    $prenom = htmlspecialchars($_POST['prenom']);
	    $nom = htmlspecialchars($_POST['nom']);
	    $adresse = htmlspecialchars($_POST['adresse']);
	    $code_postal = htmlspecialchars($_POST['code_postal']);
	    $mail = htmlspecialchars($_POST['mail']);
	    $user = htmlspecialchars($_POST['user']);
	    $ville = htmlspecialchars($_POST['ville']);
	    $tel = htmlspecialchars($_POST['tel']);
	    $passwd = $_POST['pass'];
	    $hash_passwd = sha1($passwd);
	    if ($_SESSION['admin']) {
	    	$admin = "1";
	    }else{
	    	$admin = "0";
	    }


		$clients = simplexml_load_file('../data/clients.xml');
		$num = $_SESSION['numclient'];
	    $index = 0;
	    $i = 0; 
	    foreach($clients->client as $c){
	        if($c->attributes() == $num){
	            $index = $i;
	            break;
	        }
	        $i++;
	    }

	    //echo $cli['img'] . "    " . $cli['passwd'];
		$client = $clients->addChild('client');
		$newnum = $clients->client[$clients->count()-2]->attributes()['numclient']+1;
		$client->addAttribute('numclient', $newnum);
		$client->addChild('prenom',$prenom);
		$client->addChild('nom',$nom);
		$client->addChild('adresse',$adresse);
		$client->addChild('code_postal',$code_postal);
		$client->addChild('ville',$ville);
		$client->addChild('tel',$tel);
		$client->addChild('mail',$mail);
		$client->addChild('user',$user);


		$uploaddir = '../Styles/images/profiles/';
		$uploadfile = $uploaddir . basename($newnum . $_FILES['userfile']['name']);


		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		  	$client->addChild('img',$uploadfile);
		}else{
			$client->addChild('img',$cli['img']);
		}

		$client->addChild('admin',$admin);			

		if (empty($_POST['apass']) && empty($_POST['pass']) && empty($_POST['passconf'])){
			$client->addChild('passwd',$cli['passwd']);
			//echo "empty";
		}else{
			$client->addChild('passwd',$hash_passwd);
			//echo "not empty";
		}

		include_once 'editWithCli.php';
		editOrder($_SESSION['numclient']);
		editPanier($_SESSION['numclient']);
		editAvis($_SESSION['numclient']);
	
		

	    unset($clients->client[$index]);

		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($clients->asXML());
		$dom->save('../data/clients.xml');

		$_SESSION['numclient'] = $newnum;
		$_SESSION['username'] = $user;
		
	    
	    header('Location: ../user/userprofile.php?msg=Votre profile à été bien modifier');
	}else{
		header('Location: ../user/userprofile.php?msg=Veuillez remplir tous les champs!');
	}
	}
 ?>