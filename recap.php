<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Récapitulatif des produits</title>


</head>

<body>
    <?php
    //-------------DISPLAY MESSAGE AND HIDE AFTER 3 SEC------------------------

    //part 1: Display ----------
    if (isset($_SESSION['messageQtt']) || isset($_SESSION['messageDelete']) || isset($_SESSION['messageDeleteAll'])) {
        // Display the message with class='message' style and an class of 'messageQtt'
        if (isset($_SESSION['messageQtt'])) {
            echo '<div class="message" class="messageQtt">' . $_SESSION['messageQtt'] . '</div>';
            unset($_SESSION['messageQtt']);
        }
        // Display the message with class='message' style and an class of 'messageDelete'
        if (isset($_SESSION['messageDelete'])) {
            echo '<div class="message" class="messageDelete">' . $_SESSION['messageDelete'] . '</div>';
            unset($_SESSION['messageDelete']);
        }
        // Display the message with class='message' style and an class of 'messageDeleteAll'
        if (isset($_SESSION['messageDeleteAll'])) {
            echo '<div class="message" class="messageDeleteAll">' . $_SESSION['messageDeleteAll'] . '</div>';
            unset($_SESSION['messageDeleteAll']);
        }

        // Add a JS script that uses setTimeout to hide all messages with class='message' after 3 seconds
        // Using boucle 'for' to browse all element with class="message"

        //part 2 : Hide ---------
        echo '<script>
            setTimeout(function() {
                var messages = document.getElementsByClassName("message");
                for (var i = 0; i < messages.length; i++) {
                    messages[i].style.display = "none";
                }
            }, 3000);
          </script>';
    }
    //------------------------------------------------------------------------- 

    //VERIFY IF $_SESSION['products'] exist || VERIFY IF $_SESSION['products'] is empty
    if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
        echo "<p>Aucun produit en session...<br></p>";
        echo "<button class='backHome' onclick='location.href=`index.php`' type='button'>retour à l'acceuil</button>";
    }
    //In case $_SESSION['products'] exist and isnt empty, display a table header(#, Nom, Prix, Quantité, Total)
    else {
        echo "<table border=4px>",
        "<thead>",
        "<tr>",
        "<th>#</th>",
        "<th>Nom</th>",
        "<th>Prix</th>",
        "<th>Quantité</th>",
        "<th>Total</th>",
        "</tr>",
        "</thead>",
        //Then we initialize the tbody, wich will be rows for each products with all informations about it.
        "<tbody>";
        $totalGeneral = 0; // Initialize a new variable $totalGeneral to 0.
        $qttTotal = 0; // Initialize a new variable $qttTotal to 0.

        //creating a foreach loop to display each data elements of the $_SESSION['products'] array. Each element has 2 variable : $index and $product; For each loop, the price ($product['total]) is added to $totalGeneral so we have the total price.
        foreach ($_SESSION['products'] as $index => $product) {
            echo
            "<td>" . $index . "</td>",
            "<td>" . $product['name'] . "</td>",
            "<td>" . number_format($product['price'], 2, ",", "&nbsp;") . "&nbsp;€</td>", /*number_format allows to modify the display of a numerical value according to different parameters as: number_format(variable à modifier, nombre de décimales souhaité,caractère séparateur décimal, caractère séparateur de milliers) */
            "<td><span class='minusAndPlus'><span class='minus'><a href='traitement.php?action=minusQtt&class=$index'>-</a></span>" . $product['qtt'] . "<span class='plus'><a href='traitement.php?action=addQtt&class=$index'>+</a></td></span></span>",
            "<td><span class='totalProduct'>" . number_format($product['total'], 2, ",", "&nbsp;") . "&nbsp;€<span class='deleteProduct'><a href='traitement.php?action=deleteProduct&class=$index'>suppr</a></span></span> </td>",
            "</tr>";
            // var_dump($index);die;
            //We add the product total price to $totalGeneral, wich will be done for each elements "product" of the array thanks to the foreach boucle.
            $totalGeneral += $product['total']; // EACH LOOP,  PRICE*QTT is added to $totalGeneral, so we have the total cost of all products and quantities added.
            $qttTotal += $product['qtt']; // EACH LOOP, $product['qtt'] is added to $qttTotal, so we have the total amount of products. If your take 36 exemples of 1 products, qttTotal takes +36
        }
        // Now the foreach boucle is over, we're doing an echo of a row wich is composed of 2 cells. The first one fusionate 3 cells (colspan=3) and display "Total général:", the second one display $qttTotal, the third one display the $totalGeneral formatted with number_format()
        echo "<tr>",
        "<td colspan=3>Total général : </td>",
        "<td><strong>" . $qttTotal . "</strong></td>",
        "<td><strong>" . number_format($totalGeneral, 2, ",", "&nbsp;") . "&nbsp;€</strong></td>",
        "</tr>",
        "<tr>",
        "<td class='deleteBasketCell' colspan=2><a class='deleteBasket'><a href='traitement.php?action=deleteBasket&class=$index'>Vider le panier</a></a></td>",
        "<td class='backHomeCell' colspan=1><a class='backHome' href='index.php' >Retour a l'accueil</a></td>",

        "<td colspan=2>Passer au paiement</td>",
        "</tr>",
        "</tbody>",
        "</table>";
    }
    ?>
</body>

</html>