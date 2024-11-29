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
                        <!-- Chaque INPUT dispose d'un attribut NAME : cela va permettre à la requête de classer le contenu de la saisie dans des
                         clés qui portent alors le nom désigné ; Voir var_DUMP($_POST) -->
                         <!-- Le fait d'attribuer un NAME à l'INPUT bouton permet de vérifier côté serveur que le formulaire ait été validé par 
                          l'utilisteur -->

                          <?php 
                        if(!isset($_SESSION["name"]) || !isset($_SESSION["price"]) || !isset($SESSION["qtt"]) && $_POST["submit"]){
                            $_SESSION["message"]="Veuillez remplir le(s) champ(s) vide(s)";
                            echo "<p id='alerte'>".$_SESSION["message"]."</p>";
                        }else{ 
                            $_SESSION["message"]="Produit ajouté!";
                            echo "<p id='alerte'>".$_SESSION["message"]."</p>";
                        }
                    ?>
                    </form>
  
                </div>
        </div>   

        <footer>
            <p>&copy; 2024</p>
        </footer>
    </body>
</html>







<!-- DEFINITION D'UNE SESSION : La session est un moyen permettant de stocker des données individuelles de chaque utilisateur, en utilisant
un identifiant de session unique.
Les identifiants de session sont envoyés au navigateur via des cookies de session.
L'identifiant est utilisé pour récupérer les données existantes de la session. 
En l'absence d'un cookie de session ou d'un identifiant de session, PHP crée une nouvelle session et génère un nouvel id. 
=> au démarrage d'une session, PHP récupère une session existante  ou en crée une nouvelle 
Note : une session peut être démarrée manuellement avec la fonction session_start()
les session s'arrêtent automatiquement à la fermeture du navigateur ou peuvent être stoppées manuellement avec session_destroy();

DEFINITION D'UNE SUPERGLOBALE : les superglobales sont des variables prédéfinies en PHP, disponibles quel que soit le contexte du script.
Les 9 variables superglobales sont :
    $GLOBALS
    $_SERVER
    $_GET
    $_POST
    $_FILES
    $_COOKIE
    $_SESSION
    $_REQUEST
    $_ENV

DEFINITION D'UNE FAILLE XSS : Cross-site scripting est une faille de sécurité par laquelle est injectée du script via les paramètres
d'entrée côté client (dans un champ de formulaire ou dans l'adresse URL).
Il existe trois types d'attaques XSS :
- les attaques stockées (stored XSS) : le script est stocké sur le serveur 
- les attaques reflettées (reflected XSS) : le script est renvoyé dans la réponse du serveur car il n'est pas stocké
- les attaques basées sur le DOM (DOM-based XSS) : le script n'utilise pas le serveur et permet la modification de la structure DOM
Une des manières sûre de parer les attaques XSS : l'echappement -> tous les caractères spéciaux sont remplacés par des valeurs encodés, de manière
à ce que toute donnée saisie par un utilisateur soit traitée comme du texte. -->

<!-- + filter_input, filter_var, htmlentities, htmlspecialchars -->