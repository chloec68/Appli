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
        if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
            echo "<p>Aucun produit en session...</p>";
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
            $totalGeneral=0;
            $nbArticles=0;
            foreach($_SESSION['products'] as $index => $product){
                echo "<tr>",
                        "<td>".$index."</td>",
                        "<td>".$product['name']."</td>",
                        "<td>".number_format($product['price'],2,",","&nbsp;")."&nbsp;€</td>",
                        "<td>".$product['qtt']."</td>",
                        "<td>".number_format($product['total'],2,",","&nbsp;")."&nbsp;€</td>",
                    "</tr>";
                $totalGeneral+=$product['total'];
                $nbArticles+=$product['qtt'];
            }

            echo "<tr>",
                    "<td colspan=4>Total général : </td>",
                    "<td><strong>".number_format($totalGeneral,2,",","&nbsp")."&nbsp;€</strong></td>",
                "</tr>",
            "</tbody>",
                "</table>";
                        echo $nbArticles." articles dans votre panier",
                            "</div>",
                                "</div>";
            
        }

        // header("refresh: 3"); 

        ?>

</body>
</html>









<!-- session_start() => puisqu'il sera nécessaire de parcourir le tableau de session, il est nécessaire de la récupérer d'abord; -->