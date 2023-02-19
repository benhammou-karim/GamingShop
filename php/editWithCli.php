<?php 
	function editOrder($editedCli)
	{
		$orders = simplexml_load_file('../data/orders.xml');
	    $index = 0;
	    $i = 0; 
	    $arr = []; 

	    foreach($orders->order as $o){
	        if(trim($o->numclient) == trim($editedCli)){
	            $arr[] = $i;
	        }
	        $i++;
	    }
	    //print_r($arr);
	foreach ((array)$arr as $key => $index) {
	    $total = $orders->order[$index]->total;
	    $total_prod = $orders->order[$index]->total_prod;
	    $quantite = $orders->order[$index]->quantite;
	    $payment_methode = $orders->order[$index]->payment_methode;
	    $numclient = $editedCli+1;
	    $numproduit = $orders->order[$index]->numproduit;
	    $paystatus = $orders->order[$index]->payment_status;
		$status = $orders->order[$index]->status;

		$imgname = $orders->order[$index]->attributes()['numorder'];

	    $order = $orders->addChild('order');
	    $n =$orders->order[$orders->count()-2]->attributes()['numorder']+1;
	    $order->addAttribute('numorder', $orders->order[$orders->count()-2]->attributes()['numorder']+1);
	    $order->addChild('total', "".$total); 
		$order->addChild('total_prod',$total_prod);
	    $order->addChild('quantite',$quantite);
	    $order->addChild('status', $status);
	    $order->addChild('payment_status', $paystatus);
	    $order->addChild('numclient',$numclient);
	    $order->addChild('numproduit',$numproduit);

	    if (file_exists("../Styles/images/recus/".$imgname.".jpeg")) {
	        rename("../Styles/images/recus/".$imgname.".jpeg","../Styles/images/recus/$n.jpeg");
	    }elseif(file_exists("../Styles/images/recus/".$imgname.".jpg")) {
	        rename("../Styles/images/recus/".$imgname.".jpg","../Styles/images/recus/$n.jpg");
	    }elseif(file_exists("../Styles/images/recus/".$imgname.".png")) {
	        rename("../Styles/images/recus/".$imgname.".png","../Styles/images/recus/$n.png");
	    }
		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($orders->asXML());
		$dom->save('../data/orders.xml');
	}

	$rarr = array_reverse($arr);

	for ($i=0; $i < count($rarr); $i++) { 
		unset($orders->order[$rarr[$i]]);
		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($orders->asXML());
		$dom->save('../data/orders.xml');
	}

	}

	function editPanier($editedCli){
		$achetes = simplexml_load_file('../data/achetes.xml');

		$index = 0;
	    $i = 0; 
	    $arr = []; 


	    foreach($achetes->achete as $o){
	        if(trim($o->attributes()['numclient']) == trim($editedCli)){
	            $arr[] = $i;
	        }
	        $i++;
	    }

	    foreach ((array)$arr as $key => $index) {
		    $quantite = $achetes->achete[$index]->quantite;
		    $numclient = $editedCli+1;
		    $numproduit = $achetes->achete[$index]->attributes()['numproduit'];

			$achete = $achetes->addChild('achete');
			$achete->addAttribute('numclient',$numclient );
			$achete->addAttribute('numproduit',$numproduit);
			$achete->addChild('quantite',$quantite);

			$dom = new DOMDocument('1.0');
			$dom->preserveWhiteSpace = false;
			$dom->formatOutput = true;
			$dom->loadXML($achetes->asXML());
			$dom->save('../data/achetes.xml');
		}

		$rarr = array_reverse($arr);

		for ($i=0; $i < count($rarr); $i++) { 
			unset($achetes->achete[$rarr[$i]]);
			$dom = new DOMDocument('1.0');
			$dom->preserveWhiteSpace = false;
			$dom->formatOutput = true;
			$dom->loadXML($achetes->asXML());
			$dom->save('../data/achetes.xml');
		}
	}

	function editAvis($editedCli){
		$avis = simplexml_load_file('../data/avis.xml');

		$index = 0;
	    $i = 0; 
	    $arr = []; 
	    
	    foreach($avis->avi as $o){
	        if(trim($o->attributes()['numclient']) == trim($editedCli)){
	            $arr[] = $i;
	        }
	        $i++;
	    }

	    foreach ((array)$arr as $key => $index) {
		    $rate = $avis->avi[$index]->rate;
		    $avi = $avis->avi[$index]->avi;
		    $numclient = $editedCli+1;
		    $numproduit = $avis->avi[$index]->attributes()['numproduit'];

			$avi = $avis->addChild('avi');
			$avi->addAttribute('numclient',$numclient );
			$avi->addAttribute('numproduit',$numproduit);
			$avi->addChild('rate',$rate);
			$avi->addChild('avi',$avi);

			$dom = new DOMDocument('1.0');
			$dom->preserveWhiteSpace = false;
			$dom->formatOutput = true;
			$dom->loadXML($avis->asXML());
			$dom->save('../data/avis.xml');
		}

		$rarr = array_reverse($arr);

		for ($i=0; $i < count($rarr); $i++) { 
			unset($avis->achete[$rarr[$i]]);
			$dom = new DOMDocument('1.0');
			$dom->preserveWhiteSpace = false;
			$dom->formatOutput = true;
			$dom->loadXML($avis->asXML());
			$dom->save('../data/avis.xml');
		}
	}
 ?>