<?php  
	function getCategories()
	{
		$categories = array();
		$file = simplexml_load_file('../data/categories.xml');
		$i = 0;
		foreach($file->categorie as $id => $c){
			$categories[$i]['numcat'] = $c->attributes()->numcat;
			$categories[$i]['libelle'] = $c->libelle;
			$i++;
	    }	  
	    return $categories;
	}

	function getCategorieById($id){
		$cats = getCategories();

		foreach ($cats as $key =>$cat) {
			if (trim($cat['numcat']) == trim($id)) {
				return $cats[$key];
			}
		}
		return;
	}
?>