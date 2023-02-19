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
    height: 600px;
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
 </style>

<form class="content" action="methode_payment.php" method="POST">
<div class="shopping-cart">
  <!-- Title -->

  <div class="title">
    checkout - <h1>Shipping Information</h1>
  </div>
  <!-- <h1>Shipping Information</h1> -->
  <?php 
    $cli = getClientById($_SESSION['numclient']);
   ?>
  <label for="prenom">prenom</label>
  <input type="text" name="prenom" value="<?php echo $cli['prenom']; ?>">
  <label for="nom">nom</label>
  <input type="text" name="nom" value="<?php echo $cli['nom']; ?>">
  <label for="Email">Email</label>
  <input type="text" name="mail" value="<?php echo $cli['mail']; ?>">
  <label for="telephone">telephone</label>
  <input type="text" name="tel" value="<?php echo $cli['tel']; ?>">
  <label for="adress">adress</label>
  <input type="text" name="adresse" value="<?php echo $cli['adresse']; ?>">
  <label for="ville">Ville</label>
  <input type="text" name="ville" value="<?php echo $cli['ville']; ?>">
  <label for="code_postal">code postal</label>
  <input type="text" name="code_postal" value="<?php echo $cli['code_postal']; ?>">
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
  	<button type="submit">passer au methode de paiement</button>
</div>
</form>
