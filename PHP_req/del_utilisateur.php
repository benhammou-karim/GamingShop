<?php
    session_start();
    require "../php/secure.php";

if ($_SESSION['admin'] == true){
        
    $deluti = securite_bdd($_GET['numutilisateur']);

	$clients = simplexml_load_file('../data/clients.xml'); 
	$index = 0;
	$i = 0; 
	foreach($clients->client as $c){
		if($c->attributes() == $deluti){
			$index = $i;
			break;
		}
		$i++;
	} 
	unset($clients->client[$index]);

	$avis = simplexml_load_file('../data/avis.xml'); 
	$index = 0;
	$j = 0; 
	
	for ($i=0; $i < $avis->avi->count(); $i++) { 
		foreach($avis->avi as $key => $c){
			if($c->attributes()->numclient == $deluti){
				$index = $j;
				$arr[] = $index;
				$j=0;
				unset($avis->avi[$index]);
				break;
			}
			$j++;
		}
	}

	$dom = new DOMDocument('1.0');
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$dom->loadXML($clients->asXML());
	$dom->save('../data/clients.xml');
	
	$dom = new DOMDocument('1.0');
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$dom->loadXML($avis->asXML());
	$dom->save('../data/avis.xml');

	print_r($arr);
	//header('Location: ../admin/afficher-utilisateurs.php');
        
    
}
else{
    echo "<script>alert(\"Vous n'êtes pas authorisé à accèder a cette page !!\")</script>";
    header('Location: ../admin/admin.php');
}

?>
