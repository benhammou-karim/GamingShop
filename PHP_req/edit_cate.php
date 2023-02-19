<?php
session_start();
require "../php/secure.php";

if ($_SESSION['admin'] == true){
    if (isset($_POST['sendcate']))
    {
        if (!empty($_POST['titleCate']))
        {   
                $titleCate = htmlspecialchars($_POST['titleCate']);
                $categories = simplexml_load_file('../data/categories.xml');
                $num = securite_bdd($_POST['num']);
                $index = 0;
                $i = 0; 
                foreach($categories->categorie as $c){
                    if($c->attributes() == $num){
                        $index = $i;
                        break;
                    }
                    $i++;
                }
                unset($categories->categorie[$index]);
		        $categorie = $categories->addChild('categorie');
                $categorie->addAttribute('numcat', $categories->categorie[$categories->count()-2]->attributes()['numcat']+1);
                $categorie->addChild('libelle',$titleCate);  
				
		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($categories->asXML());
		$dom->save('../data/categories.xml');
						
				
				
                
                header('Location: ../admin/afficher-categories.php');
        }
        else { 
            header('Location: ../admin/afficher-categorie.php');}
    }
}
else{
    echo "<script>alert(\"Vous n'êtes pas authorisé à accèder a cette page !!\")</script>";
    header('Location: ../admin/admin.php');
}


?>           