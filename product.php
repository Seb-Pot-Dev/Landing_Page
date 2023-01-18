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
        <a href="index.php"><i class="fa-solid fa-house"></i></a>
        <a href="recap.php"><i class="fa-solid fa-cart-shopping"></i></a>
    </nav>
    <?php


    ?>
    <main>
        <a href="index.php"><i class="fa-solid fa-arrow-left"></i></a>
        <div class="offer-focus-detail">
            <div>
                <?php // l'expression "<?=" est equivalent a <?php echo ?>
                <h5><?= ucFirst($product['name']); ?></h5>
                <p class='offer-details-item'>Bandwidth: <?= $product['bandwidth']; ?>Mbps</p>
                <p class='offer-details-item'>Online space: <?= $product['onlinespace']; ?>Go</p>
                <p class='offer-details-item'>support: <?= $product['support']; ?></p>
                <p class='offer-details-item'>Domain : <?= $product['domain']; ?></p>
                <p class='offer-details-item'>Sugar : <?= $product['sugar']; ?></p>
            </div>
            <a href="traitement.php?action=addToCart&id=<?= $_GET['id'] ?>">Ajouter au panier<i class="fa-solid fa-cart-arrow-down"></i></a>
        </div>
        </div class="product-detail">
    </main>