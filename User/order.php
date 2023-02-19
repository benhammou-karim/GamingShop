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
   }

   td a{
    text-decoration: none;
    font-weight: bold;
    color: #19191E;
   }
 </style>

<form class="content" action="#" method="POST">
  <div class="total">
    <div class="title"><p>Orders</p></div>
    <a href="#">Active</a>
    <a href="Complete_orders.php">Complete</a>
  </div>
<div class="shopping-cart">
  <?php
      if (isset($_GET['validerorder'])){
          echo '<font color="green">'.$_GET['validerorder'].'</font>';
          echo '<br>';
      }
  ?>

  <table>
    <thead>
    <tr>
      <th scope="col">order</th>
      <th scope="col">total</th>
      <th scope="col">payment</th>
      <th scope="col">status</th>
      <th scope="col">option</th>
    </tr>
    </thead>
    <tbody>
  <?php 
  $numclient = $_SESSION['numclient'];
  $orders = simplexml_load_file('../data/orders.xml');
    foreach ($orders->order as $o){
        if ($o->numclient == $numclient && $o->status != "Completed"){
  ?>
    <tr>
        <td><?=$o->attributes();?></td>
        <td><?=$o->total;?></td>
        <td><?=$o->payment_status;?></td>
        <td><?=$o->status;?></td>
        <td><a href="detail.php?numorder=<?=$o->attributes();?>">detail <i class="fa fa-angle-double-right"/></a></td>
    </tr>

    <?php }
  }
    ?>
    </tbody>
  </table>
</div>

</form>
