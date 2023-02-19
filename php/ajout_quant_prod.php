<?php
    session_start();
    if ($_SESSION == null){
      header('Location: ../login');
    }

    require "../php/secure.php";

    $quantite = securite_bdd($_GET['quantite']);
    $numprod = securite_bdd($_GET['numprod']);
    $numclient = $_SESSION['numclient'];
	
		$achetes = simplexml_load_file('../data/achetes.xml');
		foreach($achetes->achete as $a){
			if($a->attributes()->numclient == $numclient && $a->attributes()->numproduit == $numprod ){
				$a->quantite = $quantite;
				break;
			}
		}
 
		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($achetes->asXML());
		$dom->save('../data/achetes.xml');
	
	
    header('Location: ../User/panier.php');

?>