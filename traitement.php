<!-- Ce fichier traite la requête provenant de index.php après soumission du formulaire.
 Il ajoute le produit avec son nom, son prix, sa quantité, le total (et le nombre d'articles)
 en session -->

<?php
    session_start(); //crée un session ou restaure celle trouvée sur le serveur;

    if(isset($_POST['submit'])){
    
    //$_POST -> variable superglobale (variable permettant de récupérer des infos transmises par le client au serveur) qui contient toutes
    //les données transmises au serveur par l'intermédiaire d'un formulaire 
    
        $name = filter_input(INPUT_POST,"name",FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST,"price",FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt = filter_input(INPUT_POST,"qtt",FILTER_VALIDATE_INT);
        $nbArticles = filter_input(INPUT_POST,"nbArticles",FILTER_VALIDATE_INT);

        if($name && $price && $qtt){

            $product = [
                "name" => $name,
                "price" => $price,
                "qtt" => $qtt,
                "total" => $price*$qtt,
                "nbArticles" => $nbArticles,
            ];

            $_SESSION['products'][]=$product;

            //$_SESSION -> contient les données stockées dans la session utilisateur côté serveur (à condition que la session ait été démarrée)
        }
    }


    $_SESSION["alert"]

    if(isset($_POST['submit'])){}

    unset()



    header("Location:index.php");


// => session_start(); -> cette fonction permet de démarrer une session de l'utilisateur sur le serveur OU récupérer la session de cet
//utilisateur. La récupération est rendue possible par l'enregistrement par le serveur d'un COOKIE PHPSESSID dans le navigateur client. 
//Les cookies sont transmis au serveur par chaque requête HTTP effectuée par le client. 
//La durée de vie d'un cookie dépend de la configuration serveur. Par défaut, le cookie expire à la fermeture du navigateur :
//Expiration/Max-Age=Session

// => if(isset($_POST['submit'])){} -> permet de vérifier l'existence de la clé "submit" dans le tableau $_POST
//La clé 'submit' correspond à l'attribut 'name' du bouton <input type="submit" name ="submit">.

// => header() -> dans le cas où la condition précédente est fausse, cette fonction effectue une redirection en envoyant un nouvel entête HTTP
// au client. 
// /!\ la fonction header() nécessite 2 précautions :
// 1. pas d'émission d'un début de réponse avant header() par la page 
// 2. header() doit être la dernière instruction du fichier ou être immédiatement suivie de exit() ou die(), en raison de l'exécution du script
//courant.

// => FILTER_SANITIZE_STRING (champ "name") -> ce filtre supprime une chaîne de caractères de toute présence de caractères spéciaux
// et de toute balise HTML potentielle ou les encode -> impossible d'injecter du HTML

// => FILTER_VALIDATE_FLOAT (champ "price") : validera le prix que s'il est un nombre à virgule (pas de texte ou autre…)
// le drapeau FILTER_FLAG_ALLOW_FRACTION est ajouté pour permettre l'utilisation du caractère "," ou "." pour la décimale.

// => filter_input() renvoie en cas de succès la valeur assainie correspondant au champ traité,
// false si le filtre échoue ou null si le champ sollicité par le nettoyage n'existait pas dans la requête POST.

// => if($name && $price && $qtt){} -> permet de vérifier si les filtres ont fonctionné. La condition = la variale contient-elle une valeur
//positive (string, number, ...) ou false, null, 0?

// le tableau associatif $product et $SESSION['products'][]=$product; => permet de stocker les données en session,
// en l'ajoutant au tableau $_SESSION

//['product'] => permet de créer la clé (si 1er article ajouté au panier) ou de récupérer l'existante
// [] => raccourci indiquant que nous ajoutons une nouvelle entrée au futur tableau "productS" associé à cette clé