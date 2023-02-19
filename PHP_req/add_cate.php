<?php
session_start();

if ($_SESSION['admin'] == true){
    if (isset($_POST['sendcate']))
    {
        if (!empty($_POST['titleCate']))
        {   
                $titleCate = htmlspecialchars($_POST['titleCate']);
                $num = null;

		$categories = simplexml_load_file('../data/categories.xml');
		$categorie = $categories->addChild('categorie');
		$categorie->addAttribute('numcat', $categories->categorie[$categories->count()-2]->attributes()['numcat']+1);
		$categorie->addChild('libelle',$titleCate);
				
		
		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($categories->asXML());
		$dom->save('../data/categories.xml');
						
				
				
                $validercate = "Catégories bien ajouté!" ;
                header('Location: ../admin/ajouter-categorie.php?validercate='.$validercate.'');
        }
        else { $erreurcate = "Oupss vous n'avez pas saisie un titre !";
            header('Location: ../admin/ajouter-categorie.php?erreurcate='.$erreurcate.'');}
    }
}
else{
    echo "<script>alert(\"Vous n'êtes pas authorisé à accèder a cette page !!\")</script>";
    header('Location: ../admin/admin.php');
}


?>           