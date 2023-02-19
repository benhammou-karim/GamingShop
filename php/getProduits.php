<?php  
	include_once 'getAchat.php';
	function getAllProducts(){
		$i = 0;
		$file = simplexml_load_file('../data/produits.xml');
		foreach($file->produit as $c){
			$produits[$i]['dateheure'] = $c->dateheure;
			$produits[$i]['libelle'] = $c->libelle;
			$produits[$i]['description'] = $c->description;
			$produits[$i]['prix_vente'] = $c->prix_vente;
			$produits[$i]['url'] = $c->url;
			$produits[$i]['numcat'] = $c->numcat;
			$produits[$i]['numprod'] = $c->attributes()->numproduit;
			$i++;
	    }
	    return $produits;
	}

	function getProduitByDate($value='new',$produits=""){
		if ($produits=="") {
			$produits = getAllProducts();
		}
	    function changeTimeFormat($str)
	    {
		    $format = 'l jS \of F Y h:i:s A';
			$dateobj = DateTime::createFromFormat($format, $str);
		    $iso_datetime = $dateobj->format(Datetime::ATOM);
		    return $iso_datetime;
	    }

	    function sortByDate($a,$b){
	    	$a = changeTimeFormat($a['dateheure']);
	    	$b = changeTimeFormat($b['dateheure']);
	    	$t1 = strtotime($a);
	    	$t2 = strtotime($b);
	    	if ($value = 'new') {
		    	return $t2-$t1;
		    }
		    return $t1-$t2;
	    }
	    usort($produits, 'sortByDate');
	    return $produits;
	}

	function getProduitById($id){
		$produit = getAllProducts();
		foreach ($produit as $value) {
			if ($id == $value['numprod']) {
				return $value;
			}
		}
	}

	function getProduitsByCategory($cat,$produits=""){
		if ($produits=="") {
			$produits = getAllProducts();
		}
		$prodcat = array();
		$i=0;
		foreach ($produits as $prod) {
			if ($cat == $prod['numcat']) {
				$prodcat[$i] = $prod;
				$i++;
			}
		}
		return $prodcat;
	}

	function getProduitsByPrix($produits=""){
		if ($produits=="") {
			$produits = getAllProducts();
		}
		function sortByPrice($a,$b){
	    	$p1 = $a['prix_vente'];
	    	$p2 = $b['prix_vente'];
		    return $p1-$p2;
	    }
	    usort($produits, 'sortByPrice');
	    return $produits;
	}

	function getProduitsByNumachats($produits=""){
		if ($produits=="") {
			$produits = getAllProducts();
		}
		function sortByAchat($a,$b){
	    	$a = getAchatTotal($a['numprod']);
	    	$b = getAchatTotal($b['numprod']);
	    	return $b-$a;
	    }
	    usort($produits, 'sortByAchat');
	    return $produits;
	}

	function getProduitsByAlphabits($produits=""){
		if ($produits=="") {
			$produits = getAllProducts();
		}
		function sortByOrder($a, $b) {
		    return strcmp($a['libelle'] , $b['libelle']);
		}
		usort($produits, 'sortByOrder');
		return $produits;
	}
?>