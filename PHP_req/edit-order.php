<?php
session_start();
require "../php/secure.php";

if ($_SESSION['admin'] == true){
 
    $orders = simplexml_load_file('../data/orders.xml');
    $numorder = securite_bdd($_POST['numorder']);
    $status = $_POST['status'];
    $index = 0;
    $i = 0; 
    foreach($orders->order as $o){
        if($o->attributes() == $numorder){
            $index = $i;
            break;
        }
        $i++;
    }
    $total = $orders->order[$index]->total;
    $total_prod = $orders->order[$index]->total_prod;
    $quantite = $orders->order[$index]->quantite;
    $payment_methode = $orders->order[$index]->payment_methode;
    $numclient = $orders->order[$index]->numclient;
    $numproduit = $orders->order[$index]->numproduit;


    $order = $orders->addChild('order');
    $n =$orders->order[$orders->count()-2]->attributes()['numorder']+1;
    $order->addAttribute('numorder', $orders->order[$orders->count()-2]->attributes()['numorder']+1);
    $order->addChild('total', "".$total); 
	$order->addChild('total_prod',$total_prod);
    $order->addChild('quantite',$quantite);
    $order->addChild('status', $status);
    $order->addChild('payment_status', "Payment Received");
    $order->addChild('payment_methode', $payment_methode);
    $order->addChild('numclient',$numclient);
    $order->addChild('numproduit',$numproduit);
    unset($orders->order[$index]);

    if (file_exists("../Styles/images/recus/".$_POST['numorder'].".jpeg")) {
        rename("../Styles/images/recus/".$_POST['numorder'].".jpeg","../Styles/images/recus/$n.jpeg");
    }elseif(file_exists("../Styles/images/recus/".$_POST['numorder'].".jpg")) {
        rename("../Styles/images/recus/".$_POST['numorder'].".jpg","../Styles/images/recus/$n.jpg");
    }elseif(file_exists("../Styles/images/recus/".$_POST['numorder'].".png")) {
        rename("../Styles/images/recus/".$_POST['numorder'].".png","../Styles/images/recus/$n.png");
        echo "changed";
    }
                

	$dom = new DOMDocument('1.0');
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$dom->loadXML($orders->asXML());
	$dom->save('../data/orders.xml');
					
    header('Location: ../admin/afficher-orders.php');
}

else{
    echo "<script>alert(\"Vous n'êtes pas authorisé à accèder a cette page !!\")</script>";
    header('Location: ../user/main.php');
}


?>           