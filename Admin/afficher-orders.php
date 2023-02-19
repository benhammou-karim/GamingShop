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
        <link href="css/model.css" rel="stylesheet" />
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
                        <h1 class="mt-4">Afficher Orders</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="afficher-orders.php">Orders</a></li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Orders
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>numOrder</th>
                                                <th>buyer</th>
                                                <th>total</th>
                                                <th>status</th>
                                                <th>Payment Status</th>
                                                <th>Options</th>
                                                <th>Recu</th>
                                                <th>delete</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>numOrder</th>
                                                <th>buyer</th>
                                                <th>total</th>
                                                <th>status</th>
                                                <th>Payment Status</th>
                                                <th>Options</th>
                                                <th>Recu</th>
                                                <th>delete</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php 
                                               $orders = simplexml_load_file('../data/orders.xml');
                                               $i=0;
                                               foreach($orders->order as $key => $o){
                                            ?>

                                            <tr>
                                                <td><?=$o->attributes();?></td>
                                                <td><?php
                                                    include_once '../php/getClients.php';
                                                    $cli = getClientById($o->numclient);
                                                    echo $cli['user'];
                                                ?></td>
                                                <td><?=$o->total;?></td>
                                                <td><?=$o->status;?></td>
                                                <td><?=$o->payment_status;?></td>
                                                <td><a href="#" class="edit" data-modal="model<?php echo $i;?>">edit order status</a></td>
                                                <div id="model<?php echo $i; $i++;?>" class="modal">

                                                      <div class="modal-content">
                                                        <span class="close">&times;</span>
                                                        <form action="../PHP_req/edit-order.php" method="POST">
                                                        <select name="status">
                                                            <option>Processing</option>
                                                            <option>Shipped</option>
                                                            <option>Completed</option>
                                                            <option>Cancelled</option>
                                                        </select>
                                                        <input type="hidden" name="numorder" value="<?= $o->attributes(); ?>">
                                                        <button type="submit" id="save">Save changes</button>
                                                        </form>
                                                      </div>

                                                </div>
                                                <td><?php echo "<img width='200px' src='../Styles/images/recus/".$o->attributes()."'>" ?></td>
                                                <td><a href="../PHP_req/del_order.php?numorder=<?= $o->attributes(); ?>">delete</a></td>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </body>
</html>
<script type="text/javascript">

var modalBtns = document.querySelectorAll('.edit');

modalBtns.forEach(function(btn){
    btn.onclick = function(){
        var modal = btn.getAttribute("data-modal");
        document.getElementById(modal).style.display = "block";
    }
});


$(".close").click(function(){
    $(".modal").css("display", "none");
});


window.onclick = function(event) {
  if (event.target.className === 'modal') {
    event.target.style.display = 'none';
  }
} 

</script>