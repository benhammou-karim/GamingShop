<!DOCTYPE html>
<html>
<?php 
	$title = "Panier";
	$style = "../Styles/style_panier.css";
	include_once("../Templates/header.php");
 ?>
<style type="text/css">
   .title h1{
    display: inline-block;
    font-size: 16pt;
   }

  label{
    width: 80%;
    margin: 5px auto 0;
    font-size: 14pt;
   }

  input[type=text]{
    width: 80%;
    margin: 0 auto;
    height: 30px;
    font-size: 14pt;
  }

  .shopping-cart a{
    text-decoration: none;
    color: white;
    background-color: green;
    height: 30px;
    font-size: 14pt;
    display: block;
    text-align: center;
    width: 40%;
    margin: 10px auto;
    border-radius: 5px;
  }

  .shopping-cart{
    width: 60%;
    height: 250px;
    position: relative;
    display: block;
  }

  .total{
    width: 35%;
    height: auto;
  }

  .item:nth-child(odd){
    background-color: #f9f9f9;
  }

  .total-price{
    width: 100%;
    padding: 0px;
  }

  .total-price span{
    display: block;
    width: 100%;
  }

  .image{
    padding: 0px;
    margin-right: 10px;
  }
  .description{
    margin: 0px;
    padding: 0px;
  }
  .shopping-cart label{
    width: 50%;
    text-align: left;
    margin: 0px;

  }
  .shopping-cart input[type=radio]{
    margin: 5px 10px;
  }
  .shopping-cart .title:first-child{
    margin-bottom: 20px;
  }
 </style>
<?php 

	if (isset($_POST['sub'])) {
		if ($_POST['method'] == "paypal") {
			header("Location: paypal.php");
		}
		else{
			header("Location: payment.php");
		}
	}


 ?>


<form class="content" action="#" method="POST">
<div class="shopping-cart">
  <!-- Title -->

  <div class="title">
    checkout - <h1>Payment Method</h1>
  </div>
  
  <input type="radio" id="paypal" value="paypal" name="method" checked>
  <label for="paypal">paypal</label><br>
  <input type="radio" id="Bank_Transfer" value="bank" name="method">
  <label for="Bank_Transfer">Bank Transfer</label><br>
  <span>&nbsp;(Payer directement dans notre compte bancaire)</span>
  <a href="panier.php">retourner vers le panier</a>
</div>
<div class="total">
	<div class="title">
    	Order Summary
  	</div>
  	<!-- Product #1 -->
  <?php 
  	include_once '../php/secure.php';
  	//session_start();
  	if ($_SESSION == null) header('Location: ../log/login.php');

  	$produits = getAllProducts();
  	$achats = getAchatsByClient($_SESSION['numclient']);
  	$total = 0;

  	foreach ($achats as $achat):
  		foreach ($produits as $prod):
  			if (trim($achat['numproduit']) == trim($prod['numprod'])):
  				$total+= $achat['quantite']*$prod['prix_vente'];
   ?>
  <div class="item">
    <div class="image">
      <img src="<?php echo $prod['url']; ?>" alt="" />
      <div class="total-price">
        <span>Prix : $<?php echo $t = $achat['quantite']*$prod['prix_vente']; ?></span>
      </div>
    </div>

    <div class="description">
      <span><?php echo $prod['libelle']; ?></span>
      <span>Quantité: <?php echo $achat['quantite']; ?></span>
      <span>Product num:<?php echo $prod['numprod']; ?></span>
    </div>
  </div>
	<?php 
			endif;
		endforeach; 
	endforeach;
	?>
  	<p> TOTAL : <?php echo $total; ?>$</p>
  	<button type="submit" name="sub">Passer au Paiement</button>
</div>
</form>
