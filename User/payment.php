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
    height: 25px;
    display: block;
    text-align: center;
    width: 30%;
    margin: 10px auto;
  }

  .shopping-cart{
    width: 60%;
    height: 200px;
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

  .shopping-cart span{
    background-color: green;
    width: 300px;
    color: white;
    font-size: 18pt;
    padding: 10px;
    display: block;
    margin: 10px auto;
    text-align: center;
    border-radius: 10px;
  }
  .shopping-cart > p{
    width: 90%;
    margin: 0 auto;
  }
  span p{
    font-size: 10pt;
  }
 </style>

<form class="content" action="../php/add_order.php" method="POST">
<div class="shopping-cart">
  <!-- Title -->

  <div class="title">
    checkout - <h1>Payment</h1>
  </div>
  
  <span><p>Attijariwafa Bank - BENHAMMOU Karim</p>5514 9601 6533 4189</span>
  <p>Une foit vous placer votre command, vous pouvez envoyer d'argent a cette compte bancaire.</p>
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
        Prix : $<?php echo $t = $achat['quantite']*$prod['prix_vente']; ?> 
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
  	<button type="submit">Commander</button>
</div>
</form>
