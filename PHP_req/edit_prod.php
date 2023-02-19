<?php
    session_start();
    require "../php/secure.php";

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

			
		$produits = simplexml_load_file('../data/produits.xml');
        $num = securite_bdd($_POST['num']);
                $index = 0;
                $i = 0; 
                foreach($produits->produit as $p){
                    if($p->attributes() == $num){
                        $index = $i;
                        break;
                    }
                    $i++;
                }
                
                unset($produits->produit[$index]);
		$produit = $produits->addChild('produit');
		$produit->addAttribute('numproduit', $produits->produit[$produits->count()-2]->attributes()['numproduit']+1);
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
		
				
                
                header('Location: ../admin/afficher-produits.php');
            }
            else { 
                header('Location: ../admin/afficher-produits.php');}

        }
        else{
            echo "<script>alert(\"Vous n'êtes pas authorisé à accèder a cette page !!\")</script>";
            header('Location: ../admin/admin.php');
        }


    }



?>