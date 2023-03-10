<!DOCTYPE html>
 <html lang="en"><?php session_start(); ?>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="../">Gaming Shop</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
             <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Dashboard</div>
                            <a class="nav-link" href="admin.php">
                                
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Gestion</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                
                                Utilisateurs
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="ajouter-utilisateur.php">ajouter utilisateurs</a>
                                    <a class="nav-link" href="afficher-utilisateurs.php">afficher utilisateurs</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCat" aria-expanded="false" aria-controls="collapseCat">
                                
                                Categories
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCat" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="ajouter-categorie.php">Ajouter</a>
                                    <a class="nav-link" href="afficher-categories.php">Afficher</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePro" aria-expanded="false" aria-controls="collapsePro">
                                
                                Produits
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePro" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="ajouter-produit.php">Ajouter</a>
                                    <a class="nav-link" href="afficher-produits.php">Afficher</a>
                                </nav>
                            </div>
                           <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrder" aria-expanded="false" aria-controls="collapseOrder">
                                
                                Orders
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseOrder" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="afficher-orders.php">Afficher</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMails" aria-expanded="false" aria-controls="collapseMails">
                                
                                Mails
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseMails" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="afficher-mails.php">Afficher</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php  echo $_SESSION['username']; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Modifier Produit</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="afficher-produits.php">Produits</a></li>
                            <li class="breadcrumb-item active">modifier produit</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Produit
                            </div>
                            <div class="card-body">
                                <form name="test" method="POST" action="../PHP_req/edit_prod.php" >
                                            <?php 
                                                    require "../php/secure.php";
                                                    $produits = simplexml_load_file('../data/produits.xml');
                                                    $num = securite_bdd($_GET['numproduit']);
                                                    $index = 0;
                                                    $i = 0; 
                                                    foreach($produits->produit as $p){
                                                        if($p->attributes() == $num){
                                                            $index = $i;
                                                            break;
                                                        }
                                                        $i++;
                                                    } 
                                             ?>
					                <table>
                                        <tr><td>Num Article :</td><td><input type="text" name="num" value="<?=$produits->produit[$index]->attributes();?>" readonly></td> </tr>
					                    <tr>
					                        <td><label for='nom'>Article name:</label></td>
					                        <td><input type="text" placeholder="title" id='title' name='title' value="<?=$produits->produit[$index]->libelle;?>"/></td>
					                    </tr>

					                    <tr>
					                        <td><label for='price'>Price:</label></td>

					                        <td><input type="text" placeholder="$$" id='price' name='price' value="<?=$produits->produit[$index]->prix_vente;?>"/></td>
					                    </tr>

					                    <tr>
					                        <td><label for='nom'>Image url:</label></td>

					                        <td><input type="text" placeholder="!! url only !!" id='image' name='image' value="<?=$produits->produit[$index]->url;?>"/></td>
					                    </tr>
					                        
					                    <td>
					                        <label for='descrition'>Description:</label></td>

					                        <td><textarea cols="30" rows="4" name="description" id="description"><?=$produits->produit[$index]->description;?></textarea><br></td>
					                    </tr>

					                    <tr><td><label for='nom'>Cat??gorie:</label></td>
					                        <td><select name="cate" id="catedef">
					                                <?php 
													
														
									   $file = simplexml_load_file('../data/categories.xml');
									   foreach($file->categorie as $c):
                                        if (trim($c->attributes()) == trim($produits->produit[$index]->numcat)):
					                        ?>
											 <option value="<?=  $c->attributes();?>" selected><?=  $c->libelle; ?></option>
					                        <?php 
                                        else:
                                            ?>
                                            <option value="<?=  $c->attributes();?>"><?=  $c->libelle; ?></option>
                                            <?php
                                        endif;
					                    endforeach;
														
											 ?>			
																		
					                            </select>
					                            
					                        </td>
					                    </tr>
					                </table>
					                <br/></br>
					                <input type="submit" name="send" value="Submit"/>
					                <br></br>
            					</form>
                            </div>
                        </div>        
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
