<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a45e9c27c8.js" crossorigin="anonymous"></script>
    <title>Ajout produit en BDD</title>
</head>

<body>
    <header>
        <nav>
            <ul class="nav-container">
            <a href="index.php" class="nav-items-admin"><i class="fa-solid fa-house"></i></a>
            <a href="admin.php" class="nav-items-admin"><i class="fa-solid fa-wand-magic-sparkles"></i></a>
            <a href="recap.php" class="nav-items-admin"><i class="fa-solid fa-cart-shopping"></i>(<?php
                                                                            $total = 0;
                                                                            if (isset($_SESSION['products'])) {
                                                                                foreach ($_SESSION['products'] as $index => $product) {
                                                                                    $total += $product['qtt'];
                                                                                }
                                                                            }
                                                                            echo $total ?>)</a>
            </ul>    
    </nav>
    </header>
<div class="body">
    <main>

        <?php
        // Check if a message is set in the session
        if (isset($_SESSION['message'])) {
            // Display the message with class='message' style
            echo '<div class="message">' . $_SESSION['message'] . '</div>';
            echo '<script>
        setTimeout(function() {
            // Select all elements with class="message" and set their display style to "none"
            var messages = document.getElementsByClassName("message");
            for (var i = 0; i < messages.length; i++) {
                messages[i].style.display = "none";
            }
        }, 3000);
            </script>';
            // Unset the message so it is not displayed again on subsequent page loads
            unset($_SESSION['message']);
        }
        ?>
        <!-- CONTAINER -->
        <div class="admin-action">
            <h1>Ajouter un produit dans ma BDD</h1>
            <form class="form-container" action="traitement.php?action=addProductToDatabase" method="post">
                <p class='form-items'>
                    <label>
                        Nom du produit :
                        <input type="text" name="name">
                    </label>
                </p>
                <p class='form-items'>
                    <label>
                        Prix :
                        <input type="number" name="price">
                    </label>
                </p>
                <p class='form-items'>
                    <label>
                        Bandwidth :
                        <input type="number" name="bandwidth" >
                    </label>
                </p>
                <p class='form-items'>
                    <label>
                        Online space :
                        <input type="text" name="online space">
                    </label>
                </p>
                <p class='form-items'>
                    <label>
                    support :
                        <input type="text" name="support" >
                    </label>
                </p>
                <p class='form-items'>
                    <label>
                    Domain :
                        <input type="text" name="Domain" >
                    </label>
                </p>
                <p class='form-items'>
                    <label>
                    Sugar :
                        <input type="text" name="Sugar" >
                    </label>
                </p>
                <p>
                    <input id="addProduct" type="submit" name="submit" value="Ajouter le produit en BDD">
                </p>
            </form>
        </div>
        <!-- MODIFIER PRODUIT VIA FORM NAME/PRICE -->
        <!-- <div class="admin-action">
            <h1>Modifier un produit dans ma BDD</h1>
            <form class="form-container" action="traitement.php?action=modifyProduct" method="post">
                <p class='form-items'>
                    <label>
                        Nom du produit :
                        <input type="text" name="name">
                    </label>
                </p>
                <p class='form-items'>
                    <label>
                        Prix :
                        <input type="number" name="price">
                    </label>
                </p>
                <p>
                    <input class="modifyProduct" type="submit" name="submit" value="Modifier le produit en BDD">
                </p>
            </form>
        </div>
    -->




</main>
</body>
</html>