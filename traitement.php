<?php
session_start();
require_once('db-functions.php');
$id = (isset($_GET["id"])) ? $_GET["id"] : null;

switch ($_GET["action"]) {
    case "add": //Add a product

        // Collect the data from the form (isset verify if $_POST['submit'] exist AND is not "Null".)
        if (isset($_POST['submit'])) {

            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS); //FILTER_SANITIZE_FULL_SPECIAL_CHARS(FILTER_SANITIZE_STRING is deprecated). It removes any special chars or HTMLcode. Security: no html injection possible.
            $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION); //FILTER_VALIDATE_FLOAT validate the input only if its a Float. FILTER_FLAG_ALLOW_FRACTION does allow chars "," or "." for the decimals.
            $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT); // FILTER_VALIDATE_INT = validate only if the input is an Integer different from 0 (wich is consider as Null)

            /*
        Verify if the 3 filter did worked. No need to compare each variable with anything, because PHP will just checked if they are something positive (as string, int etc...)
        If filter did fail, they will return smth as "False" or "Null", then this If function will not work
        */
            if ($name && $price && $qtt) {
                //FIRST
                $product = [
                    "name" => $name,
                    "price" => $price,
                    "qtt" => $qtt,
                    "total" => $price * $qtt
                ];
                //SECOND
                $_SESSION['products'][] = $product;

                //THIRD
                $qttTotal = 0;
                if (isset($_SESSION['products']) || empty($_SESSION['products'])) {
                    $_SESSION['qttTotal'] += $qtt;
                }
                //SET A SUCCESS MESSAGE
                $_SESSION['message'] = "<p class='succes'>Produit ajouter au panier avec succès.<p>";
            } else {
                //SET AN ERROR MESSAGE
                $_SESSION['message'] = "<p class='error'>Il y a eu une erreur lors de l'ajout du produit. Recommencez s'il vous plait.";
            }
            /*
        FIRST : We create for each product, an associative array "$product"

        /SECOND : We indicate the session array "$_SESSION" with the 'products' key. If the 'product' key was not created before (when a first article added by the client for exemple), it will create a new one.
        The 2 hooks [] is a shortcut wich indicate that we do add an element to the futur 'products' array.
        $_SESSION['products'] as to be an array too, so we can add new element later.
            
        THIRD : If the $_SESSION['qttTotal'] variable is set,  the $qtt value is added
        */
        }
        header("Location:index.php");
        break;

        //increment a product qtt
    case "addQtt":
        if (isset($_SESSION["products"])) {
            $_SESSION["products"][$id]["qtt"]++;
            $_SESSION["products"][$id]["total"] += $_SESSION["products"][$id]["price"];
            $_SESSION['messageQtt'] = "<p class='succes'>Quantité modifiée avec succès.<p>";
            header("Location:recap.php");
        }
        break;
        //decrement a product qtt
    case "minusQtt":
        if (isset($_SESSION['products']) && $_SESSION["products"][$id]["qtt"] == 1) {
            unset($_SESSION['products'][$id]);
            $_SESSION['messageQtt'] = "<p class='succes'>Quantité modifiée avec succès";
            header("Location:recap.php");
        } elseif (isset($_SESSION['products'])) {
            $_SESSION["products"][$id]["qtt"]--;
            $_SESSION["products"][$id]["total"] -= $_SESSION["products"][$id]["price"];
            $_SESSION['messageQtt'] = "<p class='succes'>Quantité modifiée avec succès.";
            header("Location:recap.php");
        }
        break;

    case "deleteProduct":
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products'][$id]);
            $_SESSION['messageDelete'] = "<p class='error'>Article supprimé du panier avec succès.";
            header("Location:recap.php");
        }
        break;


        //remove all products from basket
    case "deleteBasket":
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
            $_SESSION['messageDeleteAll'] = "<p class='error'>Panier vidé avec succès.";
            header("Location:recap.php");
        }
        break;

    case "addToCart":
        if (isset($_SESSION["products"])) {
            foreach ($_SESSION['products'] as $index => $produit) {
                if ($_GET['id'] == $produit['id']) {

                    header("Location:traitement.php?action=addQtt&id=" . $index);
                    die; // si il y a pas de die, il va chercher le dernier header
                }
            }
        }
        $product = findOneById($_GET['id']);
        $product['qtt'] = 1;
        $product['total'] = $product['price'];
        $_SESSION['products'][] = $product;
        $location = "Location:product.php?id=" . $_GET['id'] . "";
        header($location);



        break;
        /* REVOIR PROBLEME ICI */
    case "addProductToDatabase":
        if (isset($_POST['submit'])) {
            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS); //FILTER_SANITIZE_FULL_SPECIAL_CHARS(FILTER_SANITIZE_STRING is deprecated). It removes any special chars or HTMLcode. Security: no html injection possible.
            $price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_FULL_SPECIAL_CHARS); //FILTER_SANITIZE_FULL_SPECIAL_CHARS(FILTER_SANITIZE_STRING is deprecated). It removes any special chars or HTMLcode. Security: no html injection possible.

            $bandwidth = filter_input(INPUT_POST, "bandwidth", FILTER_SANITIZE_FULL_SPECIAL_CHARS); //FILTER_SANITIZE_FULL_SPECIAL_CHARS(FILTER_SANITIZE_STRING is deprecated). It removes any special chars or HTMLcode. Security: no html injection possible.
            $onlinespace = filter_input(INPUT_POST, "onlinespace", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION); //FILTER_VALIDATE_FLOAT validate the input only if its a Float. FILTER_FLAG_ALLOW_FRACTION does allow chars "," or "." for the decimals.
            $support = filter_input(INPUT_POST, "support", FILTER_VALIDATE_INT); // FILTER_VALIDATE_INT = validate only if the input is an Integer different from 0 (wich is consider as Null)
            $domain = filter_input(INPUT_POST, "domain", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sugar = filter_input(INPUT_POST, "sugar", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            insertProduct($name, $price, $bandwidth, $onlinespace, $support, $domain, $sugar);
            //SET A SUCCESS MESSAGE
            $_SESSION['message'] = "<p class='succes'>Produit ajouter à la BDD avec succès.<p>";
            header("Location:admin.php");
        } else {
            //SET AN ERROR MESSAGE
            $_SESSION['message'] = "<p class='error'>Il y a eu une erreur lors de l'ajout du produit à la BDD. Recommencez s'il vous plait.";
        }

        break;
    case "modifyProduct":
        if (isset($_POST['submit'])) {
            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS); //FILTER_SANITIZE_FULL_SPECIAL_CHARS(FILTER_SANITIZE_STRING is deprecated). It removes any special chars or HTMLcode. Security: no html injection possible.
            $price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_FULL_SPECIAL_CHARS); //FILTER_SANITIZE_FULL_SPECIAL_CHARS(FILTER_SANITIZE_STRING is deprecated). It removes any special chars or HTMLcode. Security: no html injection possible.
            $bandwidth = filter_input(INPUT_POST, "bandwidth", FILTER_SANITIZE_FULL_SPECIAL_CHARS); //FILTER_SANITIZE_FULL_SPECIAL_CHARS(FILTER_SANITIZE_STRING is deprecated). It removes any special chars or HTMLcode. Security: no html injection possible.
            $onlinespace = filter_input(INPUT_POST, "onlinespace", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION); //FILTER_VALIDATE_FLOAT validate the input only if its a Float. FILTER_FLAG_ALLOW_FRACTION does allow chars "," or "." for the decimals.
            $support = filter_input(INPUT_POST, "support", FILTER_VALIDATE_INT); // FILTER_VALIDATE_INT = validate only if the input is an Integer different from 0 (wich is consider as Null)
            $domain = filter_input(INPUT_POST, "domain", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sugar = filter_input(INPUT_POST, "sugar", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            modifyProduct($name, $price, $bandwidth, $onlinespace, $support, $domain, $sugar, $_GET["id"]);
            //SET A SUCCESS MESSAGE
            $_SESSION['message'] = "<p class='succes'>Le prix du produit " . $name . " a été modifié. Nouvelle valeur: " . $price . "</p>";
            header("Location:admin.php");
        } else {
            //SET AN ERROR MESSAGE
            $_SESSION['message'] = "<p class='error'>Il y a eu une erreur lors de la modification du produit " . $name . ". Recommencez s'il vous plait.";
        }
}
