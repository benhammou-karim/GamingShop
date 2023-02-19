<?php  
	require_once "../php/secure.php";
	require_once "getProduits.php";
	require_once "getAchat.php";
	session_start();
    if ($_SESSION != null){
    	$numorder = null;
    	$numclient = $_SESSION['numclient'];
    	$produits = getAllProducts();
  		$achats = getAchatsByClient($_SESSION['numclient']);
  		$string;
  		$total;
  		$quantite;
  		$t;

  	foreach ($achats as $achat){
  		foreach ($produits as $prod){	
  			if (trim($achat['numproduit']) == trim($prod['numprod'])){
  				$numproduit = $prod['numprod'];
		    	$achetes = simplexml_load_file('../data/achetes.xml');
			    $string = $string . $numproduit . ";";
			    $quantite = $quantite . $achat['quantite'] . ";";
			    $total = $total . $achat['quantite']*$prod['prix_vente'] . ";";
			    $t += $achat['quantite']*$prod['prix_vente'];
				$numprod = securite_bdd(trim($prod['numprod']));
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
		   }
	     }
	 }

	 $orders = simplexml_load_file('../data/orders.xml');
				$order = $orders->addChild('order');
				$order->addAttribute('numorder', $orders->order[$orders->count()-2]->attributes()['numorder']+1);
				$order->addChild('total', $t);
				$order->addChild('total_prod', $total);
				$order->addChild('quantite', $quantite);
				$order->addChild('status', "Processing");
				$order->addChild('payment_status', "Awaiting Payment");
				$order->addChild('payment_methode', "Bank Transfer");
				$order->addChild('numclient', $numclient);
				$order->addChild('numproduit', $string);

				$dom = new DOMDocument('1.0');
				$dom->preserveWhiteSpace = false;
				$dom->formatOutput = true;
				$dom->loadXML($orders->asXML());
				$dom->save('../data/orders.xml');

		 $validerorder = "votre commande a été bien enregistrée!" ;

        header('Location: ../User/order.php?validerorder='.$validerorder.'');
    }
    else{
        header('Location: ../login');
    }

?>