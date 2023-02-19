<?php
    session_start();

    if (isset($_POST['send'])){
        if ($_SESSION['admin'] == true)
        {
            if (!empty($_POST['title']) AND !empty($_POST['price']) AND !empty($_POST['image']) AND !empty($_POST['description']) AND !empty($_POST['cate']))
            {
                $title = htmlspecialchars($_POST['title']);
                $price = htmlspecialchars($_POST['price']);
                $image = htmlspecialchars($_POST['image']);
                $description = htmlspecialchars($_POST['description']);
                $categorie = htmlspecialchars($_POST['cate']);
                $numproduit = null;

			
		$produits = simplexml_load_file('../data/produits.xml');
		$produit = $produits->addChild('produit');
        $produit->addAttribute('numproduit', $produits->produit[$produits->count()-2]->attributes()['numproduit']+1);
		$produit->addAttribute('numproduit',$produits->count() );
		$produit->addChild('libelle',$title);
		$produit->addChild('description',$description);
		$produit->addChild('prix_vente',$price);
		$produit->addChild('dateheure',date('l jS \of F Y h:i:s A'));
		$produit->addChild('url',$image);
		$produit->addChild('numcat',$categorie);
			
		
		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($produits->asXML());
		$dom->save('../data/produits.xml');
		
				
                $valideraddprod = "Produit bien enregistré !";
                header('Location: ../admin/ajouter-produit.php?valideraddprod='.$valideraddprod.'');
            }
            else { $erreuraddprod = "Oupss vous n'avez pas saisie un titre !";
                header('Location: ../admin/ajouter-produit.php?erreuraddprod='.$erreuraddprod.'');}

        }
        else{
            echo "<script>alert(\"Vous n'êtes pas authorisé à accèder a cette page !!\")</script>";
            header('Location: ../admin/admin.php');
        }


    }



?>