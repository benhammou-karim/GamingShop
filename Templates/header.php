
<head>
	<title><?php echo $title; session_start();?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="../Styles/header.css">
	<link rel="stylesheet" type="text/css" href="../Styles/header.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $style; ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="../Styles/owl.carousel.css">
	<link rel="stylesheet" href="../Styles/owl.theme.default.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="../js/owl.carousel.min.js"></script>

	<script type="text/javascript" src="../js/menu.js"></script>
	<script type="text/javascript" src="../js/owl.js"></script>

</head>
<body>
	<header>
		<img class="logo" src="../Styles/images/logo.png" onclick="window.location.href='../index.php'">
		<img class="menu_icon" src="../Styles/images/menu.png" onclick="return toggle_menu();">
		<nav>
			<ul id="nav" class="nav_links menuphone">
				<li><a href="../">Acceuil</a></li>
				<li class="dropdown">
					<a href="list_produits.php" class="dropbtn">Catégories&nbsp;<i class="fa fa-caret-down"></i></a>
					<div class="dropdown-content">
						<?php  
							include_once("../php/getcategorie.php");
							include_once('../php/getProduits.php');
							$categorie = getCategories();
							foreach ($categorie as $id => $cat):
						?>
						<a href="list_produits.php?categorie=<?php echo $cat['numcat']."&sortby=0&filter=";?>"><?php echo $cat['libelle']; ?></a>
						<?php 
							if ($id == 5) {
								break;
							}
							endforeach; 
						?>
					</div>
				</li>
				<li><a href="../#footer">Contactez-nous</a></li>
				<li><a href="../#about">À propos</a></li>
			</ul>
		</nav>
		<div id="login" class="login menuphone">
			<ul>
				<li class="dropdown">
					<?php 
						if ($_SESSION != null){
							include_once '../php/getClients.php';
							$cli = getClientById($_SESSION['numclient']);
							echo '<a href="../User/userprofile.php" class="dropbtn">';
							echo "<img id='userimg' src='" . $cli['img'] . "'>";
					    	echo $_SESSION['username'] . "&nbsp;<i class='fa fa-caret-down'></i>";
						}
	 					else{
	 						echo '<a href="../Login" class="dropbtn">';
	 						echo "Se connecter";
	 					}
	 				?>
					</a>

					<div class="dropdown-content <?php if ($_SESSION == null) echo 'hideit'; ?>">
						<a href="../User/userprofile.php">Profile</a>
						<a href="../User/panier.php">Panier</a>
						<?php 
							if (isset($_SESSION['admin']) == true){
								echo "<a href='../admin/admin.php' id='admin_btn'>Administration</a>";
							}
						 ?>
						 <a href="../User/order.php">Order</a>
						<a href="../Login/logout.php">Se déconnecter</a>
					</div>
				</li>
			</ul>
		</div>
	</header>
