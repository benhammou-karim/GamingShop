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
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
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
                        <h1 class="mt-4">Afficher Produits</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="afficher-produits.php">Produits</a></li>
                            <li class="breadcrumb-item active">afficher produits</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Produits
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>numProduit</th>
                                                <th>libelle</th>
                                                <th>categorie</th>
                                                <th>description</th>
                                                <th>prix_vente</th>
                                                <th>dateheure</th>
                                                <th>url</th>
                                                <th>modifier</th>
                                                <th>Supprimer</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>numProduit</th>
                                                <th>libelle</th>
                                                <th>categorie</th>
                                                <th>description</th>
                                                <th>prix_vente</th>
                                                <th>date</th>
                                                <th>url</th>
                                                <th>modifier</th>
                                                <th>Supprimer</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php 
                                               $produits = simplexml_load_file('../data/produits.xml');
                                               include_once '../php/getAvis.php';
                                               foreach($produits->produit as $p){ 
                                            ?>

                                            <tr>
                                                <td><?=$p->attributes();?></td>
                                                <td><?=$p->libelle;?></td>
                                                <td><?php
                                                    include_once '../php/getcategorie.php';
                                                    $cat = getCategorieById($p->numcat);
                                                    echo $cat['libelle'];
                                                ?></td>
                                                <td><?=$p->description;?></td>
                                                <td><?=$p->prix_vente;?>€</td>
                                                <td><?=$p->dateheure;?></td>
                                                <td><?php echo "<img width='100px' src='$p->url'>";?></td>
                                                <td><a href="modifier-produit.php?numproduit=<?= $p->attributes(); ?>">Edit</a></td>
                                                <td><a href="../PHP_req/del_article.php?numproduit=<?= $p->attributes(); ?>">delete</a></td>
                                            </tr>

                                            <?php }
  
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
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
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
