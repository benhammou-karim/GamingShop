<?php
    session_start();
    require "../php/secure.php";

if ($_SESSION['admin'] == true){
        
    $delcat = securite_bdd($_GET['numcategorie']);

	$categories = simplexml_load_file('../data/categories.xml'); 
	$index = 0;
	$i = 0; 
	foreach($categories->categorie as $c){
		if($c->attributes() == $delcat){
			$index = $i;
			break;
		}
		$i++;
	} 
	unset($categories->categorie[$index]);
		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($categories->asXML());
		$dom->save('../data/categories.xml');
			
		header('Location: ../admin/afficher-categories.php');
        
    
}
else{
    echo "<script>alert(\"Vous n'êtes pas authorisé à accèder a cette page !!\")</script>";
    header('Location: ../admin/admin.php');
}

?>
