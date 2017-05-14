<html>
    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description"
              content="Progetto Basi di Dati, pizzeria online">
        <meta name="author" content="Giacomo Ulliana, Francesco Benetello, Federico Carraro">
        <!-- CSS -->
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/personal.css">
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/admin_pages.css">
        <!-- Titolo -->
        <title>Pizze ordinate</title>
    </head>

    <body>
        <?php
            require "../functions.php";
            verifica_accesso();
            echo "<br></br>";
            echo "<p>Hai selezionato l'ordine dell'utente: ".$_GET['usr']."</p>";
        ?>

        <a href='admin_lista_ordini.php'>
        <button class='form-control btn btn-primary' style='text-align:left; width:500px;'>Ritorna alla pagina precedente</button>
        </a>
        <div class="container">
            <br></br>
            <table class="table table-bordered">
                <tr>
                    <th>ID pizza</th>
                    <th>Nome pizza</th>
                    <th>Numero pizze ordinate</th>
                    <th>Modifica numero di pizze</th>
                    <th>Cancella tutte le pizze di questo tipo</th>
                </tr>

                <?php
                    try {
                        $dbconn = db_connection();
                        /* ppo = Pizze Per Ordine ;-) */
                        $ppo = pizze_per_ordine($dbconn,$_GET['usr'],$_GET['ido']);
                        foreach($ppo as $rec) {
                            echo "<tr>
                                <td>$rec[0]</td>
                                <td>$rec[1]</td>
                                <td>$rec[2]</td>
                                <td><a href='admin_modifica_numero_pizze.php?user=$_GET[usr]&idordine=$_GET[ido]&codpizza=$rec[0]&gco=$_GET[gc]'>
                                <button class='form-control btn btn-primary' name='modifica_pizze' style='text-align:center;'>Modifica quantità</button>
                                </td>
                                <td><a href='admin_cancella_tipo_pizze.php?user=$_GET[usr]&idordine=$_GET[ido]&codpizza=$rec[0]&numpizze=$rec[2]&gco=$_GET[gc]'>
                                    <button class='form-control btn btn-primary' name='modifica_pizze' style='text-align:center;'>Cancella tutte le pizze</button></td>
                            </tr>";
                        }
                    } catch (PDOException $e) { echo $e->getMessage(); }
                ?> 
            </table>
        </div>

        <br>
        <br>
        <!-- Footer -->
        <div class="container">
            <footer>
                <hr class="featurette-divider">
                <p class="pull-right"><a href="admin_lista_ordini.php">Torna su</a></p>

                <p>© 2016, Basi Di Dati, Pizzeria Online</p>

            </footer>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <br>

    </body>
</html>