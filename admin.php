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
    </header>
<div class="body">
    <main>
        <nav>
            <a href="index.php"><i class="fa-solid fa-house"></i></a>
            <a href="admin.php"><i class="fa-solid fa-wand-magic-sparkles"></i></a>
            <form action="search.php" method="post">
                <input type="text" name="search">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <a href="recap.php"><i class="fa-solid fa-cart-shopping"></i>(<?php
                                                                            $total = 0;
                                                                            if (isset($_SESSION['products'])) {
                                                                                foreach ($_SESSION['products'] as $index => $product) {
                                                                                    $total += $product['qtt'];
                                                                                }
                                                                            }
                                                                            echo $total ?>)</a>
        </nav>

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
        <div id="container">
            <h1>Ajouter un produit dans ma BDD</h1>
            <form action="traitement.php?action=addProductToDatabase" method="post">
                <p class='form'>
                    <label>
                        Nom du produit :
                        <input type="text" name="name">
                    </label>
                </p>
                <p class='form'>
                    <label>
                        Prix :
                        <input type="number" name="price">
                    </label>
                </p>
                <p class='form'>
                    <label>
                        Bandwidth :
                        <input type="number" name="bandwidth" >
                    </label>
                </p>
                <p class='form'>
                    <label>
                        Online space :
                        <input type="text" name="online space">
                    </label>
                </p>
                <p class='form'>
                    <label>
                    support :
                        <input type="text" name="support" >
                    </label>
                </p>
                <p class='form'>
                    <label>
                    Domain :
                        <input type="text" name="Domain" >
                    </label>
                </p>
                <p class='form'>
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
        
        <button id="basket" onclick="location.href='recap.php'" type="button">
            Mon panier (<?php
                $total = 0;
                if (isset($_SESSION['products'])) {
                    foreach ($_SESSION['products'] as $index => $product) {
                        $total += $product['qtt'];
                    }
                }
                echo $total ?>)

</button>


</main>
</body>
</html>