<!DOCTYPE html>
<html lang="it">

    <!-- Meta e CSS -->
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
        <!-- Titolo -->
        <title>Aggiunta pizze</title>
    </head>

    <?php  
        require "../functions.php";
        verifica_accesso();
    ?>

    <body>

        <div class="container">
            <div class="row">
                <br></br>
                <h3>Scelta pizza da aggiungere nell'ordine (è possibile scegliere solo un tipo di pizza per volta)</h3>
                <br></br>
                <br></br>
                <?php
                
                    if($_GET['errore']=="nessunapizza")
                    {
                        echo "<font color=red><b>Seleziona una pizza</b></font><br>";
                    }
                    elseif($_GET['errore']=="quantitainvalida")
                    {
                        
                        echo "<font color=red><b>Quantità invalida</b></font><br>";
                        
                    }
                    

                       try {
                           $dbconn = db_connection();
                           $st = $dbconn->prepare('select idpizza, nome, prezzo from pizze');
                           $st->execute();
                           echo "<form action='esegui_scelta.php' method='post'>";
                           foreach($st as $rec) {
                                echo "<input type='radio' class='radio-inline' name='idpizza' value='$rec[idpizza]'>$rec[idpizza] $rec[nome], $rec[prezzo] euro<br>";
                           }
                           echo"<br> </br>";
                           echo"<tr><td>Quantità: </td><td><input class='btn btn-default' type='int' name='numeropizze' value='1'></td></tr>";
                           echo "<br></br>";
                           echo"<input type='submit' class='form-control btn btn-primary' style='width: 500px;' value='Procedi'>";
                           echo "</form>";
                        } catch (PDOException $e) { echo $e->getMessage(); }
                    
                ?>
                <a href='user_lista_ordini.php'>
                <button class='form-control btn btn-primary' style='text-align:center; width:500px;'>Gestione ordine</button>
        </a>
            </div>
        </div>
    </body>
</html>
