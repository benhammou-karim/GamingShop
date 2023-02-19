<?php
    session_start();
    if ($_SESSION == null){
      header('Location: ../login');
    }

    require "../php/secure.php";

    $numprod = securite_bdd($_GET['numprod']);
    $numclient = $_SESSION['numclient'];
	
	$achetes = simplexml_load_file('../data/achetes.xml');
	$index = 0;
	$i = 0; 
	foreach($achetes->achete as $a){
		if($a->attributes()['numclient'] == $numclient &&  $a->attributes()['numproduit'] == $numprod ){
			$index = $i;
			break;
		}
		$i++;
	} 
	unset($achetes->achete[$index]);
			
		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($achetes->asXML());
		$dom->save('../data/achetes.xml');
	
    header('Location: ../User/panier.php');

?>