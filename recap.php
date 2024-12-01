<?php
// Cette page permet d'afficher de manière organisée la liste des produits présents en session

    session_start(); // 
    // On doit parcourir le tableau de session ($_SESSION['products'])
    // En appelant la session, on permet donc la récupération du tableau de session d'abord;
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Récapitulatif des produits</title>
        <link rel="stylesheet" href="styles_&_img/styles_recap.css">
        <!-- FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    </head>
    <body>
        <nav>
            <div id="navBar">
                <div id="navBar__previous">
                    <a href="index.php"><p>Ajouter un produit</p></a>
                </div>
                <div id="navBar__nbArticles">
                    
                    <?php
                    //Affichage du nombre de produits dans le panier
                    $nbArticles=0;
                    if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
                        echo $_SESSION['nbArticles'] = "0 article dans le panier";
                    }else{
                        foreach($_SESSION['products'] as $index => $product){
                            $nbArticles+= $_SESSION['products'][$index]['qtt'];
                        }
                            if($nbArticles > 1){
                                echo $nbArticles . " articles dans le panier";
                            }else{
                                echo $nbArticles . " article dans le panier";
                            }
                    }
                    ?>

                </div>
            </div>
        </nav>

        <?php
        // Si 1. le tableau associatif $_SESSION['products'] n'existe ou pas OU 2.si ce tableau associatif est vide
            if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
                echo "<p>Aucun produit en session...</p>";
        // Si produit, afficher tableau
            }else{
            
                echo "<div id='wrapper'>",
                        "<div id='tableContainer'>",
                            "<table>",
                                "<thead>",
                                    "<tr>",
                                        "<th>#</th>",
                                        "<th>Nom</th>",
                                        "<th>Prix</th>",
                                        "<th>Quantité</th>",
                                        "<th>Total</th>",
                                    "</tr>",
                                "</thead>",
                                "<tbody>";
            // Déclaration des variables de totaux
                $totalGeneral=0;
            // Création d'une boucle qui permette d'ajouter un produit au tableau (création d'une ligne)
                foreach($_SESSION['products'] as $index => $product){
                    echo "<tr>",
                            "<td>".$index."</td>",
                            "<td>".$product['name']."</td>",
                            "<td>".number_format($product['price'],2,",","&nbsp;")."&nbsp;€</td>",
                            "<td>"."<button><a id='plus' href='traitement.php?action=u-qtt&id=$index'>+</a></button>"." ".$product['qtt']." "."<button><a id='moins' href='traitement.php?action=down-qtt&id=$index'>-</a></button>"."</td>",
                            "<td>".number_format($product['total'],2,",","&nbsp;")."&nbsp;€"."</td>",
                            "<td>"."<a href='traitement.php?action=deleteItem&id=$index'>Supprimer l'article</a>"."</td>";
                        "</tr>";
                    $totalGeneral+=$product['total'];
                }
                
           
            // Apparition totaux à la fin du tableau
                echo "<tr>",
                        "<td colspan=4>Total général : </td>",
                        "<td><strong>".number_format($totalGeneral,2,",","&nbsp")."&nbsp;€</strong></td>",
                    "</tr>",
                "</tbody>",
                    "</table>",
                                "</div>",
                                    "</div>";
                echo "<div id='viderPanier__Container'>
                    <a href='traitement.php?action=clear'>Vider le panier</a>
                    </div>";
                   
            };
    
            ?>
    </body>
</html>









