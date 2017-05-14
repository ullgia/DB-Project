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
    <title>Creazione ordine</title>
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

        <div class="navbar-collapse collapse ">
            <ul class="nav navbar-nav">
                <!-- Catalogo pizze -->
                <li><a href="user.php"">Area Riservata</a></li>
                <li><a href="user_pizze.php"">Le Nostre Pizze</a></li>
            </ul>

            <!-- Funzione ricerca -->
            <ul class="nav navbar-nav navbar-right">
                <?php
                    if($_GET['errore'] == 'ricercavuota') {
                        echo "<font color=crimson><b>Inserisci il nome della pizza</b></font><br>";
                    }
                ?>
                <form action="user_ricerca.php" method="post" class="navbar-form navbar-right" role="search">
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

    <br>
    <br>
    <br>    
    <form action="user_aggiunta_ordine.php" method="post" class="form-inline">
        <div class="container" style="width: 500px";>
 
            <?php 
                
                
                    $date=getdate();
    
                    /* Giorno */
                    $days=count_days();
                    echo '<label>Giorno consegna</label><br>';
                    echo"<select name='days' class='form-control'>";
                    for($count=$date['mday'];$count<=$days;$count++) {
                        echo"<option value='$count'>$count </option>";
                    }    
                    echo"</select>";
    
                    /* Mese */
                    echo"<select name='months' class='form-control'>";
                    for($count=$date['mon'];$count<=12;$count++)
                    {
                        echo"<option value='$count'>$count </option>";
                    }
                    echo"</select>";
    
                    /* Anno */
                    echo"<select name='year' class='form-control'>"; 
                    echo"<option value='$date[year]'>$date[year] </option>";
                    echo"</select><br>";
    
                    echo "<br><br>";
    
                    /* Ore */ 
                    echo '<label>Ora consegna</label><br>';            
                    echo"<select name='hours' class='form-control'>";
                    for($count=18;$count<=22;$count++) {
                        echo"<option value='$count'>$count </option>";
                    }    
                    echo"</select>";
    
                    /* Minuti */
                    echo"<select name='minutes' class='form-control'>";
                    echo"<option value='00'>00</option>";
                    echo"<option value='30'>30</option>";
                    echo"</select><br>";
                    echo "<br><br>"; 
                    
            ?>

            <label>Indirizzo consegna</label>
            <br>
            <input type="text" name="indirizzo">    
            <br>
            <br>
            <br>
            <button type="submit" class='form-control btn btn-primary' style='text-align:center;'>Continua con l'aggiunta delle pizze</button>
        </div>
    </form>
    <div class="container">
        <?php
            if($_GET['errore']=='campivuoti') {                 
                echo "<p style:'text-align:center;'> <font color=red face=arial><b>Non hai inserito l'indirizzo</b></font></p>";
            }
        ?> 
    </div>
                     
               
        
    </body>
    
</html>        
