<?php
    session_start();
    require "../php/secure.php";

if ($_SESSION['admin'] == true){
        
    $delorder = securite_bdd($_GET['numorder']);

	$orders = simplexml_load_file('../data/orders.xml'); 
	$index = 0;
	$i = 0; 
	foreach($orders->order as $o){
		if($o->attributes() == $delorder){
			$index = $i;
			break;
		}
		$i++;
	} 
	unset($orders->order[$index]);
		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($orders->asXML());
		$dom->save('../data/orders.xml');
			
		header('Location: ../admin/afficher-orders.php');
        
    
}
else{
    echo "<script>alert(\"Vous n'êtes pas authorisé à accèder a cette page !!\")</script>";
    header('Location: ../admin/admin.php');
}

?>
