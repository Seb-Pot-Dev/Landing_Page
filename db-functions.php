<?php
function dbFunction()
{
    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=landing_page;charset=utf8',
            'root',
            '',
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_CASE => PDO::CASE_NATURAL,
                PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
            ]

        );
        return $db;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

// Fonction pour récupérer tous les produits de la base de données
function findAll()
{
    // Appel de la fonction de connexion à la base de données
    $db = dbFunction();

    // Requête SQL pour récupérer tous les produits
    $sqlQuery = 'SELECT * FROM offers';
    // Préparation de la requête
    $storeStatement = $db->prepare($sqlQuery);

    // Exécution de la requête
    $storeStatement->execute();
    // Récupération des résultats
    $store = $storeStatement->fetchAll();
    // Retourne les résultats
    return $store;
}

// Fonction pour récupérer un produit par son identifiant
function findOneById($id)
{
    // Appel de la fonction de connexion à la base de données
    $db = dbFunction();

    // Requête SQL pour récupérer un produit en fonction de son identifiant
    $sqlQuery = 'SELECT * FROM offers WHERE id= :id';
    // Préparation de la requête
    $storeStatement = $db->prepare($sqlQuery);

    // Exécution de la requête en passant l'identifiant en paramètre
    $storeStatement->execute([':id' => $id]);
    // Récupération des résultats
    $store = $storeStatement->fetch();
    // Retourne les résultats
    return $store;
}
// Fonction pour insérer un nouveau produit dans la base de données
function insertProduct($name, $price, $bandwidth, $onlinespace, $support, $domain, $sugar)
{
    // Appel de la fonction de connexion à la base de données
    $db = dbFunction();
    // Définition d'une var = requête SQL pour insérer un nouveau produit dans la table offers
    $sqlInsert = 'INSERT INTO offers (name, price, bandwidth, onlinespace, support, domain, sugar)
    VALUES (:name, :price, :bandwidth, :onlinespace, :support, :domain, :sugar)';
    // Préparation de la requête
    $storeStatement = $db->prepare($sqlInsert);
    // Exécution de la requête en passant les informations du produit en paramètre
    $storeStatement->execute([':name' => $name, ':price' => $price, ':bandwidth' => $bandwidth, ':onlinespace' => $onlinespace, ':support' => $support, ':domain' => $domain, ':sugar' => $sugar]);
    // Récupération des résultats
    $store = $storeStatement->fetch();
    // Retourne les résultats
    return $store;
}


// Fonction pour modifier le contenu d'un produit
function modifyProduct($id, $price){
    //Appel de la fonction de connexion à la base de données
    $db = dbFunction();
    $sqlUpdate = "UPDATE offers SET price='$price' WHERE id=$id";

    //Preparation de la requête
    $statement = $db->prepare($sqlUpdate);
    
    //Execution de la requête
    $statement->execute();

        // Récupération des résultats
        $store = $statement->fetch();
        // Retourne les résultats
        return $store;

}