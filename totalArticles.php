<?php
    session_start();

    $qtt = filter_input(INPUT_POST,"qtt",FILTER_VALIDATE_INT);
    $nbArticles = filter_input(INPUT_POST,"nbArticles",FILTER_VALIDATE_INT);

    $product = [
        "qtt" => $qtt,
        "nbArticles" => $nbArticles,
    ];

    foreach($_SESSION['products'] as $index => $product){
        $nbArticles+=$product['qtt'];
    }

echo $nbArticles." articles dans votre panier";
