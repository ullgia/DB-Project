<?php
    try {
        require '../functions.php';
        $dbconn = db_connection();
        echo $_GET['min_ing'];
        //aggiorna_magazzino($dbconn,$quantitaingredienteperpizza-1,$idingredienteperpizza);
        echo "<p>Non ci sono abbastanza ingredienti per fare</p>".$_GET['codpizza'];
    } catch (PDOException $e) { echo $e->getMessage(); }
?>