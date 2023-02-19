<!DOCTYPE html>
<html>
<?php  
	$title = "main";
	$style = "../Styles/style.css";
	include_once('../Templates/header.php');
?>

<link rel="stylesheet" type="text/css" href="../Styles/snakebar.css">

<div class="container">
	<div class="banner">
		<div>
			<h1>Bienvenue</h1>
		</div>
	</div>
	<div class="wrap">
		<!-- search bar -->
		<form action="list_produits.php" method="GET">
			<div class="search">
			    <input type="text" name="text" class="searchTerm" placeholder="Que cherchez-vous?">
			    <button type="submit" name="search" class="searchButton">
				    <i class="fa fa-search"></i>
			    </button>
			</div>
		</form>

	</div>
	<div class="wrapper">
		<!---------------------------Popular--------------------------->
		<div class="popular owl-carousel owl-theme">
			<?php 
			$produits = getProduitsByNumachats();
			include_once '../php/getAvis.php';

			foreach ($produits as $id => $produit):
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
				<a href="achat_produit.php?prod_id=<?php echo $produit['numprod'] ?>">
				<div class="items">
					<div>
						<p><?php echo $produit['prix_vente']; ?>$</p><br>
						<?php if(is_int($rate)): ?>
							<p><?php echo $rate; ?><font color="#ffc40c">&#9733;</font></p>
						<?php else: ?>
							<p><?php echo number_format((float)$rate, 2, '.', ''); ?><font color="#ffc40c">&#9733;</font></p>
						<?php endif; ?>
						<span><?php echo $produit['libelle']; ?></span>
						<p><?php echo substr($produit['description'], 0, 180)."..."; ?></p>
					</div>
					<img src="<?php echo $produit['url']; ?>">
				</div>
				</a>
			<?php endforeach; ?>
		</div>

		<!----------------New-------------------------->

		<div class="new">
			<?php 
			$produits = getProduitByDate();
			foreach ($produits as $id => $produit):
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
				<div class="items_new">
					<img src="<?php echo $produit['url']; ?>">
					<div>
						<div class="items_new_text">
							<p><?php echo substr($produit['description'], 0, 120)."..."; ?></p>
							<p><?php echo $produit['prix_vente']; ?>$</p>
							<?php if(is_int($rate)): ?>
							<p><?php echo $rate; ?>&#9733;</p>
							<?php else: ?>
							<p><?php echo number_format((float)$rate, 2, '.', ''); ?>&#9733;</p>
							<?php endif; ?>
						</div>
						<a href="achat_produit.php?prod_id=<?php echo $produit['numprod'] ?>">Plus</a>
					</div>
				</div>
			<?php 
			if ($id == 11) {
				break;
			}
			endforeach; ?>
			<button class="more" onclick="window.location.replace('list_produits.php')">Voir Plus de Produit</button>
		</div>
	</div>

	<?php if (isset($_GET["msg"])): ?>
		<div id="snackbar"><?php echo $_GET["msg"]; ?></div>
		<script>
		  var x = document.getElementById("snackbar");
		  x.className = "show";
		  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
		</script>
	<?php endif ?>
	

	<!--------------------------------About-------------------------------------->
	<div class="about" id="about">
		<div class="about_img"><img src="../Styles/images/logo_about.png"></div>
		<div class="about_content">
			<h1>Magasin des accessoires de gaming</h1><hr>
			<h2>Souries, Tapies, Claviers...</h2>
			<div>
				<p>GamingShop est un magasin spécialisée dans la vente des accessoires de gaming au Maroc, que se soit des souris ou claviers...Nous vous proposants une multitude de choix en vous aidant a trouver les accessoires qui convient a vos besoins. Ainsi, vous trouverez dans nos catégories : Des périphérique de grandes marques ( Razer, HyperX, Steelseries, Logitech, Benq, Asus, Intel, AMD, NVIDIA, Gigabyte, Msi, ...). Et pour conclure en beauté, on vous invite a visiter et saisir l’opportunité des promotions offertes avec des prix très réduit.</p>
			</div>
		</div>
		<div class="empty"></div>
	</div>
	<!---------------------------------Catgories----------------------------------->
	<div class="categorie">
		
		<div class="categorie_item">
			<a href="list_produits.php?categorie=1&sortby=0&filter=">
				<div><img src="../Styles/images/mouse.png"></div>
				<p>Sourie</p>
			</a>
		</div>
		
		<div class="categorie_item">
			<a href="list_produits.php?categorie=7&sortby=0&filter=">
				<div><img src="../Styles/images/keyboard.png"></div>
				<p>Clavier</p>
			</a>
		</div>
		<div class="categorie_item">
			<a href="list_produits.php?categorie=5&sortby=0&filter=">
				<div><img src="../Styles/images/mousepad.png"></div>
				<p>Tapie</p>
			</a>
		</div>
		<div class="categorie_item">
			<a href="list_produits.php?categorie=4&sortby=0&filter=">
				<div><img src="../Styles/images/gc.png"></div>
				<p>Carte graphique</p>
			</a>
		</div>
		<div class="categorie_item">
			<a href="list_produits.php?categorie=6&sortby=0&filter=">
				<div><img src="../Styles/images/controller.png"></div>
				<p>Manettes</p>
			</a>
		</div>
	</div>
</div>

<?php 
	include_once('../Templates/footer.php'); 
	include_once('../Templates/footer_2.php'); 

?>