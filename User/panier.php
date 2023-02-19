<!DOCTYPE html>
<html>
<?php 
	$title = "Panier";
	$style = "../Styles/style_panier.css";
	include_once("../Templates/header.php");
 ?>
<style type="text/css">
  #empty{
    text-align: center;
    margin-top: 20px;
    font-size: 16pt;
    color: lightgrey;
  }
</style>

<form class="content" action="checkout.php" method="POST">
<div class="shopping-cart">
  <!-- Title -->

  <div class="title">
    Votre Panier
  </div>

  <!-- Product #1 -->
  <?php 
  	include_once '../php/secure.php';
  	//session_start();
  	if ($_SESSION == null) header('Location: ../log/login.php');

  	$produits = getAllProducts();
  	$achats = getAchatsByClient($_SESSION['numclient']);
  	$total = 0;

    if (count($achats)==0) {
      echo "<p id='empty'>Il n'y a aucun produit demandé</p>";
    }

  	foreach ($achats as $achat):
  		foreach ($produits as $prod):
  			if (trim($achat['numproduit']) == trim($prod['numprod'])):
  				$total+= $achat['quantite']*$prod['prix_vente'];
   ?>
  <div class="item">
    <div class="buttons">
    	<a href="../php/delete_quant_prod.php?numprod=<?php echo $prod['numprod'];?>">
      		<span class="delete-btn"></span>
      	</a>
    </div>

    <div class="image">
      <img src="<?php echo $prod['url']; ?>" alt="" />
    </div>

    <div class="description">
      <span><?php echo $prod['libelle']; ?></span>
      <span><?php echo $prod['prix_vente']; ?>$</span>
      <span>Product num:<?php echo $prod['numprod']; ?></span>
    </div>

    <div class="quantity">
      <button class="plus-btn" type="submit" name="button" onclick="location.href='../php/ajout_quant_prod.php?quantite=<?php echo $achat['quantite']+1;?>&numprod=<?php echo $prod['numprod'];?>'">
        <img src="../Styles/plus.svg" alt="" />
      </button>
      <input type="text" name="name" value="<?php echo $achat['quantite']; ?>">
	      <button class="minus-btn" type="submit" name="button" onclick="location.href='../php/ajout_quant_prod.php?quantite=<?php 
	      	if ($achat['quantite']!=0)
	      		echo $achat['quantite']-1;
	      	else
	      		echo $achat['quantite'];
	      ?>&numprod=<?php echo $prod['numprod'];?>'">
	        <img src="../Styles/minus.svg" alt="" />
	      </button>
    </div>

    <div class="total-price">$<?php echo $t = $achat['quantite']*$prod['prix_vente']; ?></div>
  </div>
	<?php 
			endif;
		endforeach; 
	endforeach;
	?>
</div>
<div class="total">
	<div class="title">
    	Prix total
  	</div>
  	<p><?php echo $total; ?>$</p>
    <?php if (count($achats)!=0): ?>
  	<button type="submit">Commander</button>
    <?php endif; ?>
</div>
</form>

<script type="text/javascript">
  	$('.minus-btn').on('click', function(e) {
		e.preventDefault();
		var $this = $(this);
		var $input = $this.closest('div').find('input');
		var value = parseInt($input.val());

		if (value > 1) {
			value = value - 1;
		} else {
			value = 0;
		}

    $input.val(value);

	});

	$('.plus-btn').on('click', function(e) {
		e.preventDefault();
		var $this = $(this);
		var $input = $this.closest('div').find('input');
		var value = parseInt($input.val());

		if (value < 100) {
  		value = value + 1;
		} else {
			value =100;
		}
		$input.val(value);
	});

</script>