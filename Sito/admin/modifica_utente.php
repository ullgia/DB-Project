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
        <!-- Titolo -->
        <title>Modifica utente</title>
    </head>

    <?php  
        require "../functions.php"; 
        verifica_accesso();
    
        if($_GET['errore']=='erroretelefono') {
            echo "<font color=crimson><b>Il numero di telefono inserito non è valido</b></font><br>";
        }
    
        $dbconn = db_connection();
        $statement = $dbconn->prepare('select * from utenti where login = ?');
        $statement->execute(array($_GET['usr']));
        $rec = $statement->fetch();
        $admin= $rec['admin']==1 ? "Si":"No";
    ?>
    
    <body>
    
    <h1 style="text-align:center;">Modifica i dati di <?php echo $_GET['usr']?>:</h1>
        
    <a href='admin_gestione_utenti.php'><Button style="width: 500px"; class = "form-control btn btn-primary">Ritorna alla pagina di gestione degli utenti</button></a><br></br>
    
    <form action="" method="post"> 
        <div class="container">
            <table class="table table-bordered">
                <label>Nome</label>
                &nbsp;
                <input class="form-control" "type="text" name="nome" value='<? echo $rec['nome']; ?>'>
                <br>
                <label>Cognome</label>
                &nbsp;
                <input class="form-control" type="text" name="cognome" value='<? echo $rec['cognome'];?>'>
                <br>
                <label>Indirizzo</label>
                &nbsp;
                <input class="form-control" type="text" name="indirizzo" value='<? echo $rec['indirizzo'];?>'>
                <br>
                <label>Telefono</label> 
                &nbsp;
                <input class="form-control" type="text" name="telefono" value='<? echo $rec['numerotelefono'];?>'>
                <br>
                <label>Username</label>
                &nbsp;
                <input class="form-control" type="text" name="login" value='<? echo $rec['login'];?>'>
                <br>
                <label>Admin</label>
                &nbsp;
                <select name='admin' class="form-control">
                    <option value='<? echo $rec['admin'];?>'> <? echo $admin; ?>
                    </option>
                    <option value='<? echo !$rec['admin'];?>'> <? if(!$rec['admin']){ echo"Si";} else {echo"No";} ?>
                    </option>
                </select>              
            </table>
        </div>
        <input class = "form-control btn btn-primary" type="submit" name="modifica" value="Modifica" style="font-family:arial;width:500px;">
    </form>
        
    <?php
        try {
            if(isset($_POST['modifica'])) {   
                if((!preg_match("/^[0-9]*$/",$_POST['telefono']))) {
                    header('Location:modifica_utente.php?errore=erroretelefono');
                }
                
                else {
                    if ($_POST['admin'] == 1) {
                        $isAdmin = t;
                    }
                    else {
                        $isAdmin = f;
                    }
                    $stat = $dbconn->prepare('select modifica_utente(?,?,?,?,?,?)');  
                    $stat->execute(array($_POST['login'],$_POST['nome'],$_POST['cognome'],$_POST['indirizzo'],$isAdmin,$_POST['telefono']));
                    header('Location:admin_gestione_utenti.php?msg=utentemodificato');
                }
            }
        } catch(PDOException $e) { echo $e->getMessage(); }
    ?>
           
    </body>
</html>    
