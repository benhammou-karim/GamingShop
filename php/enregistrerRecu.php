<?php  
	
	session_start();
	$uploaddir = '../Styles/images/recus/';
	$uploadfile = $uploaddir . $_POST['numorder']. "." . basename($_FILES['userfile']['type']);


	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
	  	echo "<script>alert('image sauvegarder d\'image')</script>";
	}else{
		echo "<script>alert('Erreur de sauvegarde d\'image')</script>";
	}
	header("location: ../user/order.php");
?>