<!DOCTYPE html>
<html>
<?php 
  $title = "Panier";
  $style = "../Styles/style_panier.css";
  include_once("../Templates/header.php");
 ?>
<style type="text/css">
   .total{
      margin-right: 5%;
      margin-left: 0;
   }

   .total a{
    text-decoration: none;
    color: white;
    display: block;
    background-color: green;
    height: 30px;
    font-size: 14pt;
    margin: 4px;
    text-align: center;
   }

   .title p{
    font-size: 18pt;
   }

   td{
    text-align: center;
   }
   tbody tr:nth-child(odd){
    background-color: #f9f9f9;
   }
   tbody tr{
    height: 30px;
   }
   .shopping-cart{
    height: auto;
    padding: 0 10px;
    position: relative;
   }

   td a{
    text-decoration: none;
    font-weight: bold;
    color: #19191E;
   }
   .shopping-cart h1{
    font-size:18pt;
    margin-top: 10px;
   }
    .shopping-cart h4{
    font-size:12pt;
    font-weight: normal;
    margin-left: 20px;
   }

   #report{
    width: 30%;
    display: inline-block;
    position: absolute;
    right: 20px;
    top: 15px;
    background-color: green;
    color: white;
    outline: none;
    border: none;
    padding: 5px;
    cursor: pointer;
    border-radius: 5px;
    font-size: 14pt;
   }
   .shopping-cart > h1:first-child{
    width: 30%;
    float: left;
    display: inline-block;
   }

   .image{
    float: left;
    margin: 5px;
   }
   td p{
    text-align: left;
    margin: 5px 0;
    font-size: 11pt;
   }
   span{
    font-weight: bold;
    font-size: 14pt;
   }
   .title h4{
    float: right;
    font-size: 18pt;
   }

   /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 40%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
textarea{
  display: block;
  width: 100%;
  height: 200px;
  font-size: 14pt;
}
input[type=submit]{
  background-color: green;
  outline: none;
  border:none;
  cursor: pointer;
  display: block;
  margin: 5px auto;
  width: 30%;
  height: 30px;
  font-size: 14pt;
  color: white;
  border-radius: 5px;
}
 #confirm{
  //transform: rotate(90deg);
  width: 90%;
  margin: 0 5px;
  font-size: 12pt;
  padding: 2px 3px;
 }
.rating {
  display: inline-block;
  position: relative;
  height: 50px;
  width: 100%;
  line-height: 50px;
  font-size: 50px;
}

.rating label {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  cursor: pointer;
}

.rating label:last-child {
  position: static;
}

.rating label:nth-child(1) {
  z-index: 5;
}

.rating label:nth-child(2) {
  z-index: 4;
}

.rating label:nth-child(3) {
  z-index: 3;
}

.rating label:nth-child(4) {
  z-index: 2;
}

.rating label:nth-child(5) {
  z-index: 1;
}

.rating label input {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}

.rating label .icon {
  float: left;
  color: transparent;
}

.rating label:last-child .icon {
  color: #000;
}

.stars:not(:hover) label input:checked ~ .icon{
  color: #09f;
}
.rating:hover label:hover input ~ .icon {
  color: #09f;
}

.rating label input:focus:not(:checked) ~ .icon:last-child {
  color: #000;
  text-shadow: 0 0 5px #09f;
}

.icon{
  color: black;
}
#lblrate{
  font-size: 14pt; 
}
.stars{
  margin: 0 auto;
}

</style>
<div class="content">
  <div class="total">
  <div class="title"><p>Orders</p></div>
    <a href="order.php">Active</a>
    <a href="Complete_orders.php">Complete</a>
</div>
<div class="shopping-cart">
  <?php 
    require_once "../php/secure.php";
    $numorder = securite_bdd($_GET['numorder']);;
    $orders = simplexml_load_file('../data/orders.xml');
    $index = 0;
    $i = 0; 
    foreach($orders->order as $o){
      if($o->attributes() == $numorder){
        $index = $i;
        break;
      }
      $i++;
    } 
   ?>
  <h1>Order : <?php echo $orders->order[$index]->attributes(); ?></h1>
  <button type="button" id="report">Insertion de chéque</button><hr>
    <!-- The Modal -->
  <div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <form enctype="multipart/form-data" action="../php/enregistrerRecu.php" method="POST">
        <input type="hidden" id='MAX_FILE_SIZE' name="MAX_FILE_SIZE" value="512000" />
        <input type="hidden" name="numorder" value="<?php echo $_GET['numorder']; ?>">
        Recu (format image) : <input name="userfile" id='userfile' type="file" accept="image/*" />
        <textarea></textarea>
        <input type="submit" name="submit" value="Envoyer">
      </form>
    </div>

  </div>

  <h4>Status : <?php echo $orders->order[$index]->status; ?></h4>
  <h4>Payment Status : <?php echo $orders->order[$index]->payment_status; ?></h4>
  <h4>Payment Method : <?php echo $orders->order[$index]->payment_methode; ?></h4>
  <h1>Adresse de livraison</h1><hr>
  <?php 
    $numclient = $_SESSION['numclient'];;
    $clients = simplexml_load_file('../data/clients.xml');
    $index = 0;
    $i = 0; 
    foreach($clients->client as $c){
      if($c->attributes() == $numclient){
        $index = $i;
        break;
      }
      $i++;
    } 
 ?>
  <h4>Prenom : <?php echo $clients->client[$index]->prenom; ?></h4>
  <h4>Nom : <?php echo $clients->client[$index]->nom; ?></h4>
  <h4>Adresse : <?php echo $clients->client[$index]->adresse; ?></h4>
  <h4>Code postal : <?php echo $clients->client[$index]->code_postal; ?></h4>
  <h1>Produits</h1><hr>
  <table>
    <thead>
    <tr>
      <th scope="col">Produit</th>
      <th scope="col">État</th>
      <th scope="col">option</th>
    </tr>
    </thead>
    <tbody>
      <?php 
        $numclient = $_SESSION['numclient'];
        $orders = simplexml_load_file('../data/orders.xml');
        $produits = simplexml_load_file('../data/produits.xml');
        $m = 0;
        foreach ($orders->order as $o){
          if ($o->numclient == $numclient && $numorder == $o->attributes()){
            $string = substr($o->numproduit,0,-1);
            $tab = explode(";",$string);
            $tab1 = explode(";",$o->quantite);
            $tab2 = explode(";",$o->total_prod);
            for($i=0;$i<count($tab);$i++){
                $index = 0;
                    $j = 0; 
                    foreach($produits->produit as $p){
                      if($p->attributes() == trim($tab[$i])){
                        $index = $j;
                        break;
                      }
                      $j++;
                    } 
      ?>
    <tr>
        <td>
          <div class="image">
            <img src="<?php echo $produits->produit[$index]->url; ?>" />
          </div>
          <p><?php echo "<span>".$produits->produit[$index]->libelle."</span>"; ?><br>Price: <?php echo $produits->produit[$index]->prix_vente . "$"; ?><br>Quantite: <?php echo $tab1[$i]?><br>Total: <?php echo $tab2[$i] . "$"?></p></td>
        <td><?=$o->status;?></td>
        <td>
          <?php if (trim($o->status) == "Shipped"): ?>
            <form action="../php_req/edit-order-cli.php" method="POST">
              <input type="hidden" name="numorder" value="<?php echo $o->attributes(); ?>">
              <input type="hidden" name="status" value="Completed">
              <?php if ($m==0): ?>
                <input type="submit" id="confirm" value="Confirmation" name="submit">
              <?php endif ?>
            </form>
          <?php endif ?>
          <?php if (trim($o->status) == "Completed"): ?>
            <button class="btnavis" data-modal="model<?php echo $m;?>" type="button">Avis</button>
              <!-- The Modal -->
              <div id="model<?php echo $m; ?>" class="modal modal2">
                <!-- Modal content -->
                <div class="modal-content">
                  <span class="close">&times;</span>
                  <p id="lblrate">évaluer notre produit : </p>
                  <form action="../php_req/add_review.php" method="POST" class="rating">
                    <div class="stars">
                    <label>
                      <input type="radio" name="stars" value="1" />
                      <span class="icon">★</span>
                    </label>
                    <label>
                      <input type="radio" name="stars" value="2" />
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                    </label>
                    <label>
                      <input type="radio" name="stars" value="3" />
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                      <span class="icon">★</span>   
                    </label>
                    <label>
                      <input type="radio" name="stars" value="4" />
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                    </label>
                    <label>
                      <input type="radio" name="stars" value="5" />
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                    </label>
                    </div>
                    <input type="hidden" name="prodid" value="<?php echo $produits->produit[$index]->attributes(); ?>">
                    <textarea name="avi"></textarea>
                    <input type="submit" name="submit" value="Envoyer">
                  </form>
                </div>
              </div>

          <?php endif ?>
        </td>
    </tr>
    <?php $m++; } }
  }
    ?>
    </tbody>
  </table>
  <div class="title">    
     <?php 
      $orders = simplexml_load_file('../data/orders.xml');
      $index = 0;
      $i = 0; 
      foreach($orders->order as $o){
        if($o->attributes() == $numorder){
          $index = $i;
          break;
        }
        $i++;
      } 
   ?>
   <h4>Total : <?php echo $orders->order[$index]->total . "$"; ?></h4>
   </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
  // Get the modal
  var modal = document.getElementById("myModal");
  var modal2 = document.getElementsByClassName("modal");

  // Get the button that opens the modal
  var btn = document.getElementById("report");
  var modalBtns = document.querySelectorAll('.btnavis');

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on the button, open the modal
  btn.onclick = function() {
    modal.style.display = "block";
  }  
  
  modalBtns.forEach(function(btn){
    btn.onclick = function(){
        var modal = btn.getAttribute("data-modal");
        document.getElementById(modal).style.display = "block";
    }
  });


  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
    modal2.style.display = "none";
  }


  $(".close").click(function(){
      $(".modal").css("display", "none");
  });


  window.onclick = function(event) {
    if (event.target.className === 'modal modal2' || event.target.className === 'modal') {
      event.target.style.display = 'none';
    }
  } 


  $(':radio').change(function() {
    console.log('New star rating: ' + this.value);
  });
</script>
