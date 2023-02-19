<?php 

	function getAllAvis()
	{
		$i = 0;
		$file = simplexml_load_file('../data/avis.xml');
		foreach($file->avi as $c){
			$avis[$i]['numclient'] = $c->attributes()->numclient;
			$avis[$i]['numprod'] = $c->attributes()->numproduit;
			$avis[$i]['rate'] = $c->rate;
			$avis[$i]['avi'] = $c->avi;
			$i++;
	    }
	    return $avis;
	}


	function getAvisByProd($id)
	{
		$avis = getAllAvis();
		$avisa = array();
		$i=0;
		foreach ($avis as $key => $avi) {
			if (trim($avi['numprod']) == trim($id)) {
				$avisa[$i] = $avi;
				$i++;
			}
		}
		return $avisa;
	}

 ?>