<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a45e9c27c8.js" crossorigin="anonymous"></script>
    <title>Landing Page</title>
</head>

<body>
    <section class="background">
        <header>
            <nav>
                <h1><a href="index.html" class="brand-nav-home">Cookies</a></h1>
                <!-- accès admin.php -->
                <a href="admin.php"><i class="fa-solid fa-wand-magic-sparkles"></i></a>


                <ul class="nav-container">
                    <a href="#HOME" class="nav-items">HOME</a>
                    <a href="#FEATURES" class="nav-items">FEATURES</a>
                    <a href="#CLIENT" class="nav-items">CLIENT</a>
                    <a href="#PRICING" class="nav-items">PRICING</a>
                    <a href="#FAQ" class="nav-items">FAQ</a>
                    <a href="#ABOUT" class="nav-items">ABOUT</a>
                    <a href="#BLOG" class="nav-items">BLOG</a>
                    <a href="#CONTACT" class="nav-items">CONTACT</a>
                    <!-- accès panier -->
                </ul>
                <a class="nav-items" href='recap.php'>
                    <i class="fa-solid fa-cart-shopping"></i>
                    <p class="basket"> (<?php
                                        $total = 0;
                                        if (isset($_SESSION['products'])) {
                                            foreach ($_SESSION['products'] as $index => $product) {
                                                $total += $product['qtt'];
                                            }
                                        }
                                        echo $total ?>)</p>
                </a>
                <ul class="socials">
                    <a href=""><i class="fa-brands fa-facebook"></i></a>
                    <a href=""><i class="fa-brands fa-twitter"></i></a>
                    <a href=""><i class="fa-brands fa-instagram"></i></a>
                </ul>
            </nav>
        </header>
        <main>
            <section id="HOME">
                <div class="hello">
                    <h1>
                        We are StartUp Creative Cookies Agency
                    </h1>
                    <p>
                        Carefully crafter after analysing the needs
                        of different industries and the design achieves a great balance between
                        purpose & presentation
                    </p>

                    <form action="">
                        <label for="mail-subscribe">Enter you email</label>
                        <input type="text" id="email-subscribe" name="email-subscribe">
                    </form>
                </div>
                <div class="illustration-home">
                    <img src="illustration.svg" alt="illustration-home">
                </div>
            </section>
    </section>
    <section id="PRICING">
        <div class="pricing-head">
            <div class="pricing-article">
                <h3>
                    We are StartUp Creative Cookies Agency
                </h3>
                <p>
                    Carefully crafter after analysing the needs
                    of different industries and the design achieves a great balance between
                    purpose & presentation
                </p>
                <div class="detail-happy-user">
                    <div class="detail-happy-user-1">
                        <p>
                            5000
                        </p>
                        <p>
                            Happy users
                        </p>
                    </div>
                    <div class="detail-happy-user-1">
                        <p>
                            1600
                        </p>
                        <p>
                            Completed Project
                        </p>
                    </div>
                </div>
                <button class="button-blue-1">Learn more</button>
            </div>
            <div class="illustration-pricing">
                <img src="PngItem_5364585.png" alt="creativity">
            </div>
        </div>
        <div class="our-pricing">
            <h2>
                Our pricing
            </h2>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem cum quod dicta perspiciatis?
                Ab, debitis aspernatur necessitatibus dolorum corporis optio alias aliquid doloremque dolore,
                quaerat dolores officiis voluptatum, aperiam reiciendis?
            </p>
        </div>
        <div class="offers">
            <?php //require db functions

            require_once('db-functions.php');

            $store = findAll();
            foreach ($store as $product) {
            ?>
                <a class="offer-details-container" href="product.php?id=<?= $product['id'] ?>">
                    <?php // l'expression "<?=" est equivalent a <?php echo 
                        ?>
                        <h5><?= ucFirst($product['name']); ?></h5>
                        <p class='offer-details-item'>€ <?= $product['price']; ?></p>
                    <ul class="offer-details-list">
                        <div class="details-box"><p class='offer-details-item'>Bandwidth: </p> <p class='offer-details-item'> <?= $product['bandwidth']; ?> Mbps</p></div>
                        <div class="details-box"><p class='offer-details-item'>Online space: </p class='offer-details-item'> <p> <?= $product['onlinespace']; ?> Go</p></div>
                        <div class="details-box"><p class='offer-details-item'>Support: </p><p class='offer-details-item'> <?= $product['support']; ?></p></div>
                        <div class="details-box"><p class='offer-details-item'>Domain: </p><p class='offer-details-item'> <?= $product['domain']; ?></p></div>
                        <div class="details-box"><p class='offer-details-item'>Sugar: </p><p class='offer-details-item'> <?= $product['sugar']; ?></p></div>
                    </ul>
                </a>
            <?php } ?>
            <!-- <article class="offer">


            <h5>
                Starter
            </h5>
            <p class="price">
                $9/month
            </p>
            <li class="offer-detail">
                <ul>Bandwidth</ul>
                <ul>Onlinespace</ul>
                <ul>Support 12.1</ul>
                <ul>Domain free</ul>
                <ul>Sugar Free</ul>
            </li>
            <button class="button-blue-1">Join now</button>
        </article>
        <article class="offer">
            <h5>
                Advanced
            </h5>
            <p class="price">
                $19/month
            </p>
            <li class="offer-detail">
                <ul>Bandwidth</ul>
                <ul>Onlinespace</ul>
                <ul>Support 12.1</ul>
                <ul>Domain free</ul>
                <ul>Sugar Free</ul>
            </li>
            <button class="button-blue-1">Join now</button>

        </article>
        <article class="offer">
            <h5>
                Professional
            </h5>
            <p class="price">
                $29/month
            </p>
            <li class="offer-detail">
                <ul>Bandwidth</ul>
                <ul>Onlinespace</ul>
                <ul>Support 12.1</ul>
                <ul>Domain free</ul>
                <ul>Sugar Free</ul>
                <button class="button-blue-1">Join now</button>

            </li>
        </article>
    </div>
    </section> -->

            </main>
</body>

</html>