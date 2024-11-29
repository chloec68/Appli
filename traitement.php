<!-- Ce fichier traite la requête provenant de index.php après soumission du formulaire.
 Il ajoute le produit avec son nom, son prix, sa quantité, le total (et le nombre d'articles)
 en session -->

<?php
    session_start(); //crée une session ou restaure celle trouvée sur le serveur;

 
                    // CREATION DE FONCTIONNALITES 



        if(isset($_GET["action"])){
            // -> permet de collecter les infos des champs "input"

            switch($_GET["action"]){
                case "add":

                    if(isset($_POST['submit'])){
    
                        //$_POST -> variable superglobale (variable permettant de récupérer des infos transmises par le client au serveur) qui contient toutes
                        //les données transmises au serveur par l'intermédiaire d'un formulaire 
                        // => if(isset($_POST['submit'])){} -> permet de vérifier l'existence de la clé "submit" dans le tableau $_POST
                        //La clé 'submit' correspond à l'attribut 'name' du bouton <input type="submit" name ="submit">.
                        //Cette condition permet que le fichier traitement.php ne soit pas atteignable par l'URL
                        //Ainsi seules les requêtes HTTP provenant de la soumission du formulaire sont recevables
                        // si la condition est fausse, cf header();
                        
                            $name = filter_input(INPUT_POST,"name",FILTER_SANITIZE_STRING);
                            $price = filter_input(INPUT_POST,"price",FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                            $qtt = filter_input(INPUT_POST,"qtt",FILTER_VALIDATE_INT);
                            $nbArticles = filter_input(INPUT_POST,"nbArticles",FILTER_VALIDATE_INT);
                    
                        // => FILTER_SANITIZE_STRING (champ "name") -> ce filtre supprime une chaîne de caractères de toute présence de caractères spéciaux
                        // et de toute balise HTML potentielle ou les encode -> impossible d'injecter du HTML
                        // => FILTER_VALIDATE_FLOAT (champ "price") : validera le prix que s'il est un nombre à virgule (pas de texte ou autre…)
                        // le drapeau FILTER_FLAG_ALLOW_FRACTION est ajouté pour permettre l'utilisation du caractère "," ou "." pour la décimale.
                        //=> FILTER_VALIDATE_INT : ne valide la quantité renseignée que si elle est un entier différent de 0 (=nul)
                        // => filter_input() renvoie en cas de succès la valeur assainie correspondant au champ traité,
                        // false si le filtre échoue ou null si le champ sollicité par le nettoyage n'existait pas dans la requête POST.
                        // => donc pas de risque que l'utilisateur transmette un champ supplémentaire
                    
                            if($name && $price && $qtt){
                    
                            // => if($name && $price && $qtt){} -> permet de vérifier si les filtres ont fonctionné.
                            //La condition = la variable contient-elle une valeur positive (string, number, ...) ou false, null, 0?
                            //on veut juste vérifier si les variables contiennent chacune une valeur jugée positive, puisqu'un filtre qui échoue renvoie false
                            // ou null 
                    
                         
            $product = [
                "name" => $name,
                "price" => $price,
                "qtt" => $qtt,
                "total" => $price*$qtt,
                "nbArticles" => $nbArticles,
            ];

            // création d'un tableau associatif pour organiser les données 

            $_SESSION['products'][]=$product;

            //$_SESSION -> permet d'enregistrer $product en session
            // plus généralement, cette superglobale contient les données stockées dans la session utilisateur côté serveur
            //(à condition que la session ait été démarrée)

            $_SESSION['message']=$message;

        }
    }
            header("Location:index.php");
            break;
            die;

          

                     case "clear":
                        unset($_SESSION['products']) ;
                    break;
                    die;
                 

                //     <form action="traitement.php?action=add" method="post">;
                //     break;

                // case "delete":
                //     <form action="traitement.php?action=delete" method="post">;
                //     unset($product);
                //     break;

            //     case "clear":
            //         if(isset($_POST["clearAll"]))
            //         <form action="traitement.php?action=clear" method="post">;
            //         reset($products)
            //         break;

            //     case "u-qtt":
            //         if(isset($_POST["plus"])){
            //             <form action="traitement.php?action=u-qtt" method="post">;
            //         }
            //         break;

            //     case "down-qtt":
            //         if(isset($_POST["minus"])){
            //             <form action="traitement.php?action=down-qtt" method="post">;
            //         }
                   
            //         break;
    }

        // l'attribut action : indique la cible du formulaire = le fichier à atteindre lorsque l'utilisateur soumet le formulaire 
        // l'attribut method : précise par quelle méthode HTTP les données du formulaire sont transmises; La méthode POST permet de passer les 
        // données saisies par l'utilisateur dans la requête elle-même. Cette méthode permet de ne pas polluer l'URL contrairement à la méthode
        // GET (méthode par défaut si rien n'est précisé). Avec la méthode GET, les données des champs seraient inscrites dans l'URL et dès lors
        // limitées en nombre de caractères 


        }

        header("Location:index.php");
    


  

     






    // => header() -> dans le cas où la condition précédente est fausse, cette fonction effectue une redirection en envoyant un nouvel entête HTTP
// au client. 
// /!\ la fonction header() nécessite 2 précautions :
// 1. pas d'émission d'un début de réponse avant header() par la page 
// 2. header() doit être la dernière instruction du fichier ou être immédiatement suivie de exit() ou die(), en raison de l'exécution du script
//courant.


// => session_start(); -> cette fonction permet de démarrer une session de l'utilisateur sur le serveur OU récupérer la session de cet
//utilisateur. La récupération est rendue possible par l'enregistrement par le serveur d'un COOKIE PHPSESSID dans le navigateur client. 
//Les cookies sont transmis au serveur par chaque requête HTTP effectuée par le client. 
//La durée de vie d'un cookie dépend de la configuration serveur. Par défaut, le cookie expire à la fermeture du navigateur :
//Expiration/Max-Age=Session






// le tableau associatif $product et $SESSION['products'][]=$product; => permet de stocker les données en session,
// en l'ajoutant au tableau $_SESSION

//['product'] => permet de créer la clé (si 1er article ajouté au panier) ou de récupérer l'existante
// [] => raccourci indiquant que nous ajoutons une nouvelle entrée au futur tableau "productS" associé à cette clé