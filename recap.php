<?php

// Cette page permet d'afficher de manière organisée la liste des produits présents en session

    session_start(); // 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif des produits</title>
    <link rel="stylesheet" href="styles_recap.css">
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
                    <?php include "totalArticles.php"; ?>
                </div>
            </div>
        </nav>

    <?php
    // Si aucun produit 
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
            $nbArticles=0;
        // Création d'une boucle qui permette d'ajouter un produit au tableau (création d'une ligne)
            foreach($_SESSION['products'] as $index => $product){
                echo "<tr>",
                        "<td>".$index."</td>",
                        "<td>".$product['name']."</td>",
                        "<td>".number_format($product['price'],2,",","&nbsp;")."&nbsp;€</td>",
                        "<td><button name='plus'>+</button>"." ".$product['qtt']." "."<button name='minus'>-</button></td>",
                        "<td>".number_format($product['total'],2,",","&nbsp;")."&nbsp;€"." "."<button>Supprimer l'article</button></td>",
                    "</tr>";
                $totalGeneral+=$product['total'];
                $nbArticles+=$product['qtt'];

            }
        // Apparition totaux à la fin du tableau
            echo "<tr>",
                    "<td colspan=4>Total général : </td>",
                    "<td><strong>".number_format($totalGeneral,2,",","&nbsp")."&nbsp;€</strong></td>",
                "</tr>",
            "</tbody>",
                "</table>";
                        echo $nbArticles." articles dans votre panier",
                            "</div>",
                                "</div>";
            echo "<div id='fonctionnalites'>
                <a href='traitement.php?action=clear'>Vider le panier</a>
            </div>";
        };

        ?>

       
        <!-- traitement.php?action=delete&id=<?php echo $index?> -->
</body>
</html>









<!-- session_start() => puisqu'il sera nécessaire de parcourir le tableau de session, il est nécessaire de la récupérer d'abord; -->