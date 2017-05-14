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
    <title>Console Amministrazione</title>
</head>

<body>
    <?php  
        require "../functions.php"; 
        verifica_accesso();
    ?>

<!-- Menu di navigazione -->
<nav class="navbar-default" id="menu">
    <div class="col-lg-12 block-center" style="text-align:center;">
        <h1> Pizzeria Online - Progetto di Basi di Dati </h1>
    </div>
    
    <div class="navbar-header hidden-print">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../logout.php">Logout</a>
    </div>


    <!-- MENU DI NAVIGAZIONE-->
    <div class="navbar-collapse collapse ">
        <ul class="nav navbar-nav">

            <!-- Catalogo pizze -->
            <li><a href="admin.php"">Console Amministrazione</a></li>
            <li><a href="admin_pizze.php"">Le Nostre Pizze</a></li>


        </ul>

 

        <!-- Funzione ricerca -->
        <ul class="nav navbar-nav navbar-right">
            <?php
                if($_GET['errore'] == 'ricercavuota') {
                    echo "<font color=crimson><b>Inserisci il nome della pizza</b></font><br>";
                }
            ?>
            <form action="admin_ricerca.php" method="post" class="navbar-form navbar-right" role="search">
                <!-- Campo compilabile -->
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Cerca pizza" name ="pizzasearch">
                </div>
                <!-- Pulsante di ricerca -->
                <button type="submit" class="btn btn-default">Ricerca</button>
            </form>
        </ul>

    </div>

</nav>


<!-- In Evidenza -->

<hr class="featurette-divider">


<div class="container">
    <div class="row">
        <a class="gerarchia-livello-0"><h3>Gestione ordini</h3></a><br>
        <br>
        <a class="gerarchia-livello-1" href="admin_lista_ordini.php"><Button style="text-align:center;">Visualizzazione/Modifica/Cancellazione ordini</button></a><br>
        <br>
    </div>
</div>

<hr class="featurette-divider">

<div class="container">
    <div class="row">
        <a class="gerarchia-livello-0"><h3>Gestione utenti</h3></a><br>
        <br>
        <a class="gerarchia-livello-1" href="admin_gestione_utenti.php#lista_utenti"><Button style="text-align:center;">Elenco utenti registrati</Button></a><br>
        <br>
        <a class="gerarchia-livello-1" href="admin_gestione_utenti.php"><Button style="text-align:center;">Gestione utenti registrati</Button></a><br>
        <br>
        <a class="gerarchia-livello-2" href="admin_gestione_utenti.php#aggiungi_utente"><Button style="text-align:center;">Aggiungi un nuovo utente</Button></a><br>
        <br>
        <a class="gerarchia-livello-2" href="admin_gestione_utenti.php#cancella_utente"><Button style="text-align:center;">Cancella un utente</Button></a><br>
        <br>
    </div>
</div>

<hr class="featurette-divider">

<div class="container">
    <div class="row">
        <a class="gerarchia-livello-0"><h3>Gestione Magazzzino</h3></a><br>
        <br>
        <a class="gerarchia-livello-1" href="admin_ricarica_magazzino.php#disponibilita_ingredienti"><Button style="text-align:center;">Disponibilità ingredienti</Button></a><br>
        <br>
        <a class="gerarchia-livello-1" href="admin_ricarica_magazzino.php#ricarica_ingrediente"><Button style="text-align:center;">Ricarica magazzino</Button></a><br>
        <br>
    </div>
</div>

    

<!-- Footer -->
<div class="container">
    <footer>
        <hr class="featurette-divider">
        <p class="pull-right"><a href="admin.php">Torna su</a></p>

        <p>© 2016, Basi Di Dati, Pizzeria Online</p>

    </footer>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<br>
</body>

</html>

