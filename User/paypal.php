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

<form class="content" action="#" method="POST">
<div class="shopping-cart">
  <?php
      if (isset($_GET['message'])){
          echo '<font color="green">'.$_GET['message'].'</font>';
          echo '<br>';
      }
  ?>
  <!-- Title -->

  <div class="title">
    checkout - <h1>Payment</h1>
  </div>
  <div id="paypal-payment-button">
    
  </div>
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
  	<p> TOTAL : <span id="totalp"><?php echo $total; ?></span>$</p>
</div>
</form>
<script src="https://www.paypal.com/sdk/js?client-id=AZeSaj92AZzKlQGfvpN6BzoeQdiPeR3HSrW2I1FzIwn1kublKsEb5SzpNu3bSthb1Ckd2M37-HsXqUrR&disable-funding=credit,card"></script>
<script>
  var total = document.getElementById('totalp').innerHTML;

  paypal.Buttons({
  style:{
    color:'blue',
    shape:'pill'
  },
  createOrder:function(data,actions){
    return actions.order.create({
      purchase_units:[{
        amount:{
          value:total
        }
      }]
    });
  },
  onApprove:function(data,actions){
    return actions.order.capture().then(function(details){
      window.location.replace("http://localhost/GamingShop/php/add_order_paypal.php")
    })
  },
  onCancel:function(data){
  	window.location.replace("http://localhost/GamingShop/User/paypal.php?message=ERROR")
  }
}).render('#paypal-payment-button');</script>