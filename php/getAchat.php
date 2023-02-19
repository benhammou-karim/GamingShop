<?php  

	function getAllAchats(){
		$i = 0;
		$file = simplexml_load_file('../data/achetes.xml');
		foreach($file->achete as $c){
			$achetes[$i]['numclient'] = $c->attributes()->numclient;
			$achetes[$i]['numproduit'] = $c->attributes()->numproduit;
			$achetes[$i]['quantite'] = $c->quantite;
			$i++;
	    }
	    return $achetes;
	}

	function getAchatTotal($numprod){
		$achats = getAllAchats();
		$total = 0;
		foreach ($achats as $value) {
			if (trim($value['numproduit']) == trim($numprod)) {
				$total++;
			}
		}
		return $total;
	}

	function getAchatsByClient($numclient){
		$achats = getAllAchats();
		$client_achats = array();
		$i = 0;
		foreach ($achats as $key => $value) {
			if (trim($value['numclient']) == trim($numclient)) {
				$client_achats[$i] = $value;
				$i++;
			}
		}
		return $client_achats;
	}


?>