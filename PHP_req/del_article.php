<?php
    session_start();
    require "../php/secure.php";

if ($_SESSION['admin'] == true){
        
    $delart = securite_bdd($_GET['numproduit']);

	$produits = simplexml_load_file('../data/produits.xml'); 
	$index = 0;
	$i = 0; 
	foreach($produits->produit as $p){
		if($p->attributes() == $delart){
			$index = $i;
			break;
		}
		$i++;
	} 
	unset($produits->produit[$index]);
			
		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($produits->asXML());
		$dom->save('../data/produits.xml');
			
		header('Location: ../admin/afficher-produits.php');
        
    
}
else{
    echo "<script>alert(\"Vous n'êtes pas authorisé à accèder a cette page !!\")</script>";
    header('Location: ../admin/admin.php');
}

?>
