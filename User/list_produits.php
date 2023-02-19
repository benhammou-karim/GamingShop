<!DOCTYPE html>
<html>
<?php 
	$title = "Contact";
	$style = "../Styles/style.css";
	require('../Templates/header.php');
	$produits = getAllProducts();
	if (isset($_GET['filter'])) {
		if ($_GET['categorie'] != "Tous") {
			$produits = getProduitsByCategory($_GET['categorie']);
		}
		switch ($_GET['sortby']) {
			case '1':
				$produits = getProduitsByAlphabits($produits);
				break;
			case '2':
				$produits = array_reverse(getProduitsByAlphabits($produits));
				break;
			case '3':
				$produits =	getProduitByDate($produits);
				break;
			case '4':
				$produits =	array_reverse(getProduitByDate($produits));
				break;
			case '5':
				$produits =	getProduitsByPrix($produits);
				break;
			case '6':
				$produits = array_reverse(getProduitsByPrix($produits));
				break;
		}
	}
	if (isset($_GET['search'])) {
		$search = htmlspecialchars($_GET['text']);
	 	$pattern = "/" . $search . "/i";

	 	foreach($produits as $key => $p){ 
			if(!preg_match($pattern, $p['libelle'])){
				unset($produits[$key]);
			}
		}
	}
?>

<div class="content">
	<!-- search -->
	<div>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
			<div class="search">
			    <input type="text" name="text" class="searchTerm" placeholder="Que cherchez-vous?">
			    <button type="submit" name="search" class="searchButton">
				    <i class="fa fa-search"></i>
			    </button>
			</div>
		</form>
	</div>
	<!-- sort bar -->
	<div class="sort">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
			<span>Categories :</span>
			<select name="categorie">
				<option>Tous</option>
			<?php 
				$cats = getCategories();
				foreach ($cats as $cat):
			 ?>
				<option value="<?php echo $cat['numcat']; ?>"><?php echo $cat['libelle']; ?></option>
				<?php endforeach; ?>
			</select>
			
			<div class="space"></div>
			<span>Trier par :</span>
			<select name="sortby">
				<option value="0">Par défaut</option>
				<option value="1">Nom A-Z</option>
				<option value="2">Nom Z-A</option>
				<option value="3">Date nouveau-ancien</option>
				<option value="4">Date ancien-nouveau</option>
				<option value="5">Prix pas cher-cher</option>
				<option value="6">Prix cher-pas cher</option>
			</select>
			<div class="space"></div>
			<button type="submit" name="filter">
				<i class="fa fa-filter"> Trier</i>
			</button>
		</form>
	</div>
	<!-- wrapper -->
	<div class="wrap_list">
		<!-- produits -->
		<?php 
			include_once '../php/getAvis.php';
			foreach ($produits as $produit):
				$avis = getAvisByProd($produit['numprod']);
				$t = 0;
				foreach ($avis as $value) {
					$t+=$value['rate'];
				}
					
				if (count($avis) != 0) {
					$rate = $t/count($avis);
				}else{
					$rate = 0;
				}
				
		?>
		<div class="item_prod">
			<a href="achat_produit.php?prod_id=<?php echo $produit['numprod']; ?>">
				<img src="<?php echo $produit['url']; ?>">
				<?php if(is_int($rate)): ?>
					<p><?php echo $rate; ?><font color="#ffc40c">&#9733;</font></p>
				<?php else: ?>
					<p><?php echo number_format((float)$rate, 2, '.', ''); ?><font color="#ffc40c">&#9733;</font></p>
				<?php endif; ?>
				<div>
					<h3><?php echo $produit['libelle']; ?></h3>
					<p><?php echo $produit['prix_vente']; ?>$</p>
				</div>
			</a>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<?php include_once('../Templates/footer_2.php'); ?>