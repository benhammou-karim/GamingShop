<?php  
	require_once "../php/secure.php";
	session_start();
    if ($_SESSION != null && isset($_GET['numprod']) && isset($_POST['quantity'])){
        $quantity = $_POST['quantity'];

        $numclient = $_SESSION['numclient'];
        $numprod = securite_bdd($_GET['numprod']);
	 
	    $achetes = simplexml_load_file('../data/achetes.xml');
		$achete = $achetes->addChild('achete');
		$achete->addAttribute('numclient',$numclient );
		$achete->addAttribute('numproduit',$numprod);
		$achete->addChild('quantite',$quantity);

		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($achetes->asXML());
		$dom->save('../data/achetes.xml');
	   
        header("Location: ../User/panier.php?numprod=$numprod");
    }
    else{
        header('Location: ../login');
    }

?>