<?php  

	function getAllClients(){
		$i = 0;
		$file = simplexml_load_file('../data/clients.xml');
		foreach($file->client as $c){
			$clients[$i]['numclient'] = $c->attributes()->numclient;
			$clients[$i]['prenom'] = $c->prenom;
			$clients[$i]['nom'] = $c->nom;
			$clients[$i]['adresse'] = $c->adresse;
			$clients[$i]['code_postal'] = $c->code_postal;
			$clients[$i]['mail'] = $c->mail;
			$clients[$i]['user'] = $c->user;
			$clients[$i]['passwd'] = $c->passwd;
			$clients[$i]['img'] = $c->img;
			$clients[$i]['tel'] = $c->tel;
			$clients[$i]['ville'] = $c->ville;
			$i++;
	    }
	    return $clients;
	}

	function getClientById($id){
		$clients = getAllClients();
		foreach ($clients as $key => $client) {
			if (trim($client['numclient']) == trim($id)) {
				return $clients[$key];
			}
		}
		return;
	}

?>