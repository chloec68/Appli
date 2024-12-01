<!-- Ce fichier traite la requête provenant de index.php après soumission du formulaire.
 Il ajoute le produit avec son nom, son prix, sa quantité, le total (et le nombre d'articles)
 en session -->

<?php
    session_start(); //crée une session ou restaure celle trouvée sur le serveur;
    // => session_start(); -> cette fonction permet de démarrer une session de l'utilisateur sur le serveur OU récupérer la session de cet
    //utilisateur. La récupération est rendue possible par l'enregistrement par le serveur d'un COOKIE PHPSESSID dans le navigateur client. 
    //Les cookies sont transmis au serveur par chaque requête HTTP effectuée parle client. 
    //La durée de vie d'un cookie dépend de la configuration serveur. Par défaut, le cookie expire à la fermeture du navigateur :
    //Expiration/Max-Age=Session

        if(isset($_GET["action"])){
            // -> permet de collecter les infos des champs "input"

            switch($_GET["action"]){
                case "add":
                    if(isset($_POST['submit'])){
                    // vérifie l'existence de la clé 'submit' dans le tableau associatif $_POST qui contient infos transmises
                    // par client au serveur via formulaire 

                    // isset() -> détermine si une variable est définie (/non-définie -> valeur = null -> renvoie false)
         
                    //La clé 'submit' correspond à l'attribut 'name' du bouton : 
                    //                    <input type="submit" name ="submit" value="Ajouter un produit">.
                    // lorsqu'un utilisateur clique sur "Ajouter le produit", l'élément $_POST['submit'] est ajouté à $_POST : 
                    //                      $_POST = [
                    //                                'submit' => 'Ajouter le produit'
                    //                               ]
                    
                    // Ce test vérifie si le formulaire a été soumis par l'utilisateur ET rend traitement.php inatteignable via l'URL :
                    // Le test ne renvoie TRUE QUE si les données sont envoyées via la méthode POST 
                    // Si une requête GET est reçue, le test renvoie FALSE et renvoie à header () et le code dans la condition n'est pas exécuté
                    // REQUÊTE GET = accéder à la page directement via l'URL sans soumettre de formulaire 
            
                    // ====> seules les requêtes HTTP provenant de la soumission du formulaire sont recevables
                        
                        $name = filter_input(INPUT_POST,"name",FILTER_SANITIZE_STRING);
                        $price = filter_input(INPUT_POST,"price",FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        $qtt = filter_input(INPUT_POST,"qtt",FILTER_VALIDATE_INT);
                
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
                                ];
                                // création d'un tableau associatif pour organiser les données 

                                $_SESSION['products'][]=$product;
                                    //$_SESSION -> enregistre $product en session 
                                    // [] création d'un nouvel array pour chaque produit 
                                


                     
                        
                             }

                             $nbArticles=0;

                             if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
                                 echo $_SESSION['nbArticles'] = "0 article dans le panier";
                             }else{
                                 foreach($_SESSION['products'] as $index => $product){
                                     $nbArticles+= $_SESSION['products'][$index]['qtt'];
                                 }
                                 echo $nbArticles . " article(s) dans le panier";
                             }
                             
                             $_SESSION['nbArticles'] = $nbArticles;
                    }
           
                    header("Location:index.php");
                    break;
                    die;

          

                case "clear":
                    unset($_SESSION['products']) ;
                    header("Location:index.php");
                    break;
                    die;
                
                case "deleteItem":
                    // je vais chercher la valeur de l'index dans l'url pour pointer le bon objet  
                     
                    unset($_SESSION['products'][$_GET['id']]);
                    header("Location:index.php");
                    break;
                    die;
                
                case "u-qtt":
                    ($_SESSION['products'][$_GET['id']]['qtt']++);
                    header("Location:index.php");
                    break;
                    die;
                
                case "down-qtt":
                    ($_SESSION['products'][$GET_['id']]['qtt']++);
                    header("Location:index.php");
                    break;
                    die;
             }
        }

       
        header("Location:index.php");

        // => header() -> dans le cas où la condition filter_input() est fausse, cette fonction effectue une redirection en envoyant un nouvel en-tête HTTP
        // au client. 
        // Une en-tête HTTP est une ligne de texte envoyée par le serveur web au navigateur avant le contenu de la page
        // /!\ la fonction header() nécessite 2 précautions :
        // 1. pas d'émission d'un début de réponse avant header() par la page 
        // 2. header() doit être la dernière instruction du fichier ou être immédiatement suivie de exit() ou die(), en raison de l'exécution du script
        //courant = n'arrête pas l'exécution du script courant 











//['product'] => permet de créer la clé (si 1er article ajouté au panier) ou de récupérer l'existante
// [] => raccourci indiquant que nous ajoutons une nouvelle entrée au futur tableau "productS" associé à cette clé