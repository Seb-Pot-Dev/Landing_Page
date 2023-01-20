<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php /* appel la bdd*/ require_once('db-functions.php');

    /*applique la fn findOneById qui va chercher les infos en bdd d'un ID produit défini dans l'URL grace la requete HTTP de methode GET */
    $product = findOneById($_GET['id']); ?>

    <!-- le reste qui suit est de l' HTML utilisans du php pour afficher les infos du produit renvoyé par findOne by ID -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a45e9c27c8.js" crossorigin="anonymous"></script>
    <title><?= ucFirst($product['name']) ?></title>
</head>

<body>
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
    <?php


    ?>
    <main>
        <a href="index.php"><i class="fa-solid fa-arrow-left"></i></a>
        <div class="admin-action">
            <div class="offer-focus-detail">
                <div>
                    <?php // l'expression "<?=" est equivalent a <?php echo 
                    ?>
                    <form class="form-container" action="traitement.php?action=modifyProduct&id=<?= $product["id"] ?>" method="post">
                        <h5><?= ucFirst($product['name']); ?></h5>
                        <p class='form-items'>
                        <p>
                            <label>Price
                                <input type="number" name="price" value="<?= $product['price']; ?>">
                            </label>
                        </p>
                        <p>
                            <label>Bandwidth:
                                <input type="text" name="bandwidth" value="<?= $product['bandwidth']; ?>">
                            </label>Mbps
                        </p>
                        <p class='form-items'>
                            <label>Online space:
                                <input type="number" name="onlinespace" value="<?= $product['onlinespace']; ?>">
                            </label>Go
                        </p>
                        <p class='form-items'>
                            <label>Support:
                                <input type="text" name="support" value="<?= $product['support']; ?>">
                            </label><?= $product['support']; ?>
                        </p>
                        <p class='form-items'>
                            <label>Domain:
                                <input name="domain" value="<?= $product['domain']; ?>">
                            </label><?= $product['domain']; ?>
                        </p>
                        <p class='form-items'>
                            <label>Sugar:
                                <input type="text" name="sugar" value="<?= $product['sugar']; ?>">
                            </label><?= $product['sugar']; ?>
                        </p>
                        <p>
                            <input class="modifyProduct" type="submit" name="submit" value="Modifier le produit en BDD">
                        </p>
                    </form>
                </div>
            </div>
        </div class="product-detail">
    </main>

    ?>