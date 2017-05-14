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
            echo "<p>Hai selezionato l'ordine dell'utente: ".$_GET['user']."</p>";
            echo "<p>IDordine: ".$_GET['idordine']."</p>";
            echo "<p>IDpizza: ".$_GET['codpizza']."</p>";
        ?>

        <a href='admin_lista_ordini.php'>
        <button class='form-control btn btn-primary' style='text-align:left; width:500px;'>Ritorna alla lista ordini</button>
        </a>
        <div class="container">
            <br></br>
            <table class="table table-bordered">
                <tr>
                    <th>ID pizza</th>
                    <th>Nome pizza</th>
                    <th>Numero pizze ordinate</th>
                    <th>Modifica numero di pizze</th>
                </tr>

                <?php
                    try {
                        $dbconn = db_connection();
                        $stat=$dbconn->prepare('select p.idpizza, p.nome, pc.numeropizze from ordini o, pizzecontenute pc, pizze p where pc.idordine = o.idordine and p.idpizza = pc.idpizza and o.login = ? and o.idordine=? and p.idpizza = ?');
                        $stat->execute(array($_GET['user'],$_GET['idordine'],$_GET['codpizza']));
                        foreach ($stat as $state) {
                            echo "<tr>
                                <td>$state[0]</td>
                                <td>$state[1]</td>
                                <td><form action='admin_modifica_numero_pizze_aus.php?codp=$_GET[codpizza]&ido=$_GET[idordine]&gico=$_GET[gco]' method='post'>
                                <input type='int' name='numeropizze' value=$state[2]>
                                <input type='hidden' name='numeropizzereali' value=$state[2]>
                                </td>
                                <td><button class='form-control btn btn-primary' type='submit'>Modifica</button></td>
                                </form>
                            </tr>";
                        }
                    } catch (PDOException $e) { echo $e->getMessage(); }
                ?> 
            </table>
            <br></br>
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