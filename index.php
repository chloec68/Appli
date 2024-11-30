<!-- PAGE CONTENANT LE FORMULAIRE -->


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajout produit</title>
        <!-- FEUILLES DE STYLE -->
        <link rel="stylesheet" href="styles_index.css">
        <!-- FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
      
    </head>

    <body>
        <!-- NAVBAR -->
        <nav>
            <div id="navBar">
                <div id="navBar__previous">
                    <a href="recap.php"><p>Retour au panier</p></a>
                </div>
                <div id="navBar__nbArticles">
                    <?php include "totalArticles.php"; ?>
                </div>
            </div>
        </nav>

        <!-- FORMULAIRE -->
        <div id="mainContent__wrapper">
            <h1>Ajouter un produit</h1>
                <div id="form__wrapper">
                    <form action="traitement.php?action=add" method="post">
                        <!-- l'attribut action : indique la cible du formulaire = le fichier à atteindre lorsque
                         l'utilisateur soumet le formulaire -->
                         <!-- l'attribut method : précise par quelle méthode HTTP les données du formulaire sont transmises;
                          cette méthode permet de ne pas polluer l'URL contrairement à la méthode GET (méthode par défaut si rien 
                          n'est précisé). Avec la méthode GET, les données des champs seraient inscrites dans l'URL et dès lors limitées en
                          nombre de caractères -->
                        <p>
                            <label>
                                Nom du produit : 
                                <input class="champsFormulaire" type="text" name="name">
                            </label>
                        </p>
                        <p>
                            <label>
                                Prix du produit : 
                                <input class="champsFormulaire" type="number" step="any" name="price">
                            </label>
                        </p>
                        <p>
                            <label>
                                Quantité désirée :
                                <input class="champsFormulaire" type="number" name="qtt" value="1">
                            </label>
                        </p>
                        <p>
                            <input id="boutonAjouter" type="submit" name="submit" value="Ajouter le produit">
                        </p>
                        <!--  ATTRIBUT NAME -> NOM DE LA KEY DANS TABLEAU ASSOCIATIF $_POST -->
                        <!-- Chaque INPUT dispose d'un attribut NAME : cela va permettre à la requête de classer le contenu de la saisie dans des
                         clés qui portent alors le nom désigné ; Voir var_DUMP($_POST) -->
                         <!-- Le fait d'attribuer un NAME à l'INPUT bouton permet de vérifier côté serveur que le formulaire ait été validé par 
                          l'utilisteur -->

                        <!-- Le bouton du formulaire a été nommé pour pouvoir vérifier côté serveur que le formulaire a été validé par l'utilisateur -->
                    </form>

                    <?php 

                        if (isset($_POST['submit']) && !empty($_SESSION['name']) && !empty($_SESSION['price']) && !empty($_SESSION['qtt'])){
                            echo "Produit ajouté!";
               
                        }else{
                            echo "Veuillez remplir le(s) champ(s) vide(s)";
                         
                        }
                        // echo "<br>";
                        // var_dump(isset($_POST['submit'])); ---- > RENVOIE FALSE
                        // echo "<br>";
                        // var_dump($_SESSION);
                    ?>
  
                </div>
        </div>  

       <!-- FOOTER -->
        <footer>
            <p>&copy; 2024</p>
        </footer>
    </body>
</html>


