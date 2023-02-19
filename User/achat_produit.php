<!DOCTYPE html>
<html>

<?php 
	session_start();
	require ("../php/secure.php");
	include_once '../php/getClients.php';
	$title = "Contact";
	$style = "../Styles/style.css";
	require('../Templates/header.php');
	if (isset($_GET['prod_id'])) {
		$id = securite_bdd($_GET['prod_id']);
		$produits = getAllProducts();
		foreach ($produits as $prod) {
			if (trim($prod['numprod']) == trim($id)) {
				$current = $prod;
				break;
			}
		}
	}
?>
<style type="text/css">
	.commentimg{
		width: 30px;
		height: 30px;
		object-fit: cover;
		border-radius: 100%;
	}
	.comment span{
		height: 30px;
	}
</style>
<div class="wrapper_prod">
	<form method="POST" action="../php/addPanier.php?numprod=<?php echo $id;?>">
		<div class="produit">
			<div class="prod_img"><img src="<?php echo $current['url']; ?>"></div>
			<div class="info_prod">
				<p id="prod_name"><?php echo $current['libelle']; ?></p>
				<hr>
				<div>
					<div class="rate_prod">
						<span class="heading">Rate </span>
						<?php
						include_once '../php/getAvis.php';
						$avis = getAvisByProd($current['numprod']);
						$t = 0;
						foreach ($avis as $value) {
							$t+=$value['rate'];
						}
							
						if (count($avis) != 0) {
							$rate = $t/count($avis);
						}else{
							$rate = 0;
						}

						 echo $rate; 

						 for ($i=0; $i < floor($rate) ; $i++):
						 ?>
						<span class="fa fa-star checked"></span>
						<?php endfor;
							for ($j=$i; $j < 5; $j++):
						?>
						<span class="fa fa-star"></span>
					<?php endfor; ?>
						<span id="prod_price"><span id="price"><?php echo $current['prix_vente']; ?></span>$</span>

					</div>
				</div>
				<p id="prod_desc"><?php echo $current['description']; ?></p>
				<div class="quantity">
					<span>Quantity </span>
					<button type="button" class="fa fa-arrow-circle-left change_qtt" onclick="count(-1);"></button>
					<input type="number" name="quantity" id="quantity" value="0" min="0">
					<button type="button" class="fa fa-arrow-circle-right change_qtt" onclick="count(1);"></button>
				</div>
				<p id="t_prix">Prix Total: <span id="tp">0</span>$</p>
					<script type="text/javascript">
						function count(c) {
						    var quantity = document.getElementById('quantity');
						    var price = document.getElementById('price');
						    if (quantity.value == 0 && c == -1) {return;}
						    var i = parseFloat(quantity.value, 10);
						    var q = i + c;
						    quantity.value = q;
						    var p = parseFloat(price.innerHTML, 10);
						    document.getElementById('tp').innerHTML = q*p;
					    }
					</script>
				<button type="submit" class="submit">
				    <i class="fa fa-cart-plus"></i> Add to cart
				</button>
			</div>
		</div>
		
		<div class="comments">
			<div class="comments_title">
				<h3>Avis de notre clients&nbsp;</h3><hr>
			</div>
			<?php 
				
				foreach ($avis as $key => $avi):
					$cli = getClientById($avi['numclient']);
			 ?>
			<div class="comment">
				<img class="commentimg" src="<?php echo $cli['img']; ?>"><span><?php echo $cli['user']; ?></span>
				<p><?php echo $avi['avi']; ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</form>
	
	<div class="similar_prod">
		<!-- produits -->
		<?php 
		$produits = getProduitsByCategory(trim($current['numcat']));
		foreach ($produits as $key => $produit):
			if ($key == 5) {
				break;
			}
		?>
		
		<div class="item_prod">
			<a href="achat_produit.php?prod_id=<?php echo $produit['numprod']; ?>">
				<img src="<?php echo $produit['url']; ?>"><?php  ?>
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