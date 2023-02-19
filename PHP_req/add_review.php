<?php  

	require_once "../php/secure.php";
	session_start();
    if ($_SESSION != null){
        $rate = $_POST['stars'];
        $review = $_POST['avi'];

        
        $numclient = $_SESSION['numclient'];
        $numprod = securite_bdd($_POST['prodid']);
	 
	    $avis = simplexml_load_file('../data/avis.xml');
		$avi = $avis->addChild('avi');
		$avi->addAttribute('numclient',$numclient );
		$avi->addAttribute('numproduit',$numprod);
		$avi->addChild('rate',$rate);
		$avi->addChild('avi',$review);

		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($avis->asXML());
		$dom->save('../data/avis.xml');
	   
        header("Location: ../User/order.php");
    }
    else{
        header('Location: ../login');
    }

?>