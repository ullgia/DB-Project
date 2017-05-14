<!DOCTYPE html> 
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
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/personal.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/home_pages.css">
    <!-- Titolo -->
    <title>Conferma registrazione!</title>
</head>
<body>

<!-- Menu di navigazione -->
<nav class="navbar-default" id="menu">
    <div class="col-lg-12">
        <h1> Pizzeria Online - Progetto di Basi di Dati </h1>
    </div>
    
    <div class="navbar-header hidden-print">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Ritorna alla pagina precedente</a>
    </div>
        <div class="navbar-collapse collapse ">
        <ul class="nav navbar-nav">
        <!-- NAVBAR VUOTA -->
        </ul>
        </div>
    </nav>
        
        
<?php
    require "functions.php";
    if(!(isset($_POST['Registrazione']))) {
        if (empty($_POST['login']) ||empty($_POST['nome']) || empty($_POST['cognome']) || empty($_POST['indirizzo']) || empty ($_POST['password']) ||empty($_POST['telefono'])) {
                header('Location:index.php?errore=campivuoti');
        }
        
        elseif((!preg_match("/^[0-9]*$/",$_POST['telefono']))) {
            header('Location:index.php?errore=erroretelefono');
        }     
        else {
            try{
                $dbconn = db_connection();
                $statement = $dbconn->prepare('select count (*) from utenti where login = ?');
                $statement->execute(array($_POST['login']));
                $rec = $statement->fetch();
                if ($rec[0] == 1) {               
                    header('Location:index.php?errore=utenteesistente');
                }
                else{
                    session_start();
                    $_SESSION['login'] = $_POST['login'];
                    $stat = $dbconn->prepare('select crea_utente(?,?,?,?,?,?)');  
                    $stat->execute(array($_POST['login'],$_POST['nome'],$_POST['cognome'],$_POST['indirizzo'],$_POST['password'],$_POST['telefono']));
                    echo "<br>
                        <h2><p style='text-align:center;'><font color=darkgreen><b>Registrazione effettuata</b></font></p></h2>
                        <br>";
                        /*header('Location:index.php');*/
                }
            } catch (PDOException $e) { echo $e->getMessage(); }
        }
    }
    echo "<p style='font-family:arial;text-align: center;'>
        <br>
        Le tue credenziali sono:
        <br>
        Login = ".$_POST['login']."
        <br>
        Nome = ".$_POST['nome']."
        <br>
        Cognome = ".$_POST['cognome']."
        <br>
        Indirizzo = ".$_POST['indirizzo']."
        <br> 
        Password = ".$_POST['password']."
        <br>
        Telefono = ".$_POST['telefono']."
        </p>";
    
    echo "<h3><p style='text-align:center;'>Utilizza il bottone in alto a sinistra per ritornare alla homepage</p></h3>";
?>


    
    </body>
</html>
