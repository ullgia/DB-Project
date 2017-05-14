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
    <title>Gestione Utenti</title>
</head>

<body>
    <?php  
        require "../functions.php"; 
        verifica_accesso();        
        if($_GET['msg']=='utentemodificato') {
            echo "<font color=darkgreen face=arial><b>Utente modificato con successo</b></font><br>";
        }
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
        <br>
        <br>
<section id="lista_utenti" class="lista_utenti">
    <div class="container">
        <table class="table table-bordered">
            <tr>
                <th>Login</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Indirizzo</th> 
                <th>Numero di telefono</th>
                <th>Amministratore</th>     
                <th>Modifica utente</th>          
            </tr>
            <tr>
                <?php  
                        
                    $dbconn = db_connection();
                    $res=lista_utenti($dbconn);          
                    foreach($res as $rec) {
                        $admin= $rec['admin']==1 ? "Si":"No";
                        echo"<tr>
                                <td>$rec[login]</td>
                                <td>$rec[nome]</td>
                                <td>$rec[cognome]</td>
                                <td>$rec[indirizzo]</td>
                                <td>$rec[numerotelefono]</td>
                                <td>$admin</td>
                                <td> 
                                <a href='modifica_utente.php?usr=$rec[login]'>
                                <button class='form-control btn btn-primary' style='text-align:center;'>Modifica utente</button>
                                </a>
                                <br>
                                <br></td>
                            </tr>";
                    }                                  
                ?>                                                            
            </tr>
        </table> 
    </div>
</section>

<hr class="featurette-divider">

<section id="aggiungi_utente" class="aggiungi_utente">
    <div class="container" style="width: 500px; text-align:center;">
        <h4 class="modal-title">Aggiungi un nuovo utente inserendo tutti i dati</h4>
        <div class="modal-body">
            <form role="form" action="aggiungi_utente.php" method="post">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" id="rUsername" placeholder="Username" name="login"> 
                        <label for="uPassword" class="input-group-addon glyphicon glyphicon-user"></label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" id="rNome" placeholder="Nome" name="nome">
                        <label for="uLogin" class="input-group-addon glyphicon glyphicon-user"></label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" id="rCognome" placeholder="Cognome" name="cognome">
                        <label for="uPassword" class="input-group-addon glyphicon glyphicon-user"></label>
                    </div>
                </div>


                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" id="rIndirizzo" placeholder="Indirizzo" name="indirizzo">
                        <label class="input-group-addon glyphicon glyphicon-bookmark"></label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <input type="password" class="form-control" id="rPassword" placeholder="Password" name ="password">
                        <label for="uPassword" class="input-group-addon glyphicon glyphicon-lock"></label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" id="rTelefono" placeholder="N° telefono" name="telefono">
                        <label for="uLogin" class="input-group-addon glyphicon glyphicon-phone"></label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="form-control btn btn-primary" value="Aggiungi Utente" >Aggiungi utente</button>
                </div>
                        <?php
                            if ($_GET['errore'] == 'campivuoti') { 
                                echo "<font color=crimson><b>Non hai inserito tutti i dati!!!</b></font><br>";
                            }

                            elseif ($_GET['errore'] == 'erroretelefono') { 
                                echo "<font color=crimson><b>Il numero di telefono deve contenere cifre comprese tra 0 e 9</b></font><br>";
                            }

                            elseif($_GET['errore'] == 'utenteesistente') {
                                echo "<font color=crimson><b>Utente già registrato</b></font><br>";
                            }

                            if($_GET['msg']=='utenteaggiunto') {
                                echo "<font color=darkgreen face=arial><b>Utente aggiunto con successo</b></font><br>";
                            }
                        ?>

            </form>
        </div>
    </div>
</section>

<br>
<br>

<hr class="featurette-divider">
<br>
<br>         

<section id="cancella_utente" class="cancella_utente">         
    <div class="container" style="width: 500px";>          
        <form action="cancella_utente.php" method="post">
                <tr>
                    <td>
                        <label for="delete">Seleziona un'utente da cancellare:</label>
                        <select class="form-control" name="login" id="delete">
                        <?php                  
                            $dbconn = db_connection(); 
                            $res=lista_utenti($dbconn); 
                            foreach($res as $rec) {   
                                if($rec['login']!=$_SESSION['login']) {
                                    echo"<option value='$rec[login]'>$rec[login]</option>";
                                }
                            }
                        ?> 
                        </select>      
                    </td>
                </tr>
        <button class="form-control btn btn-primary" type="submit" value="Cancella Utente">Cancella Utente</button>
        </form>
    </div>
<section>
    <?php        
        if($_GET['msg']=='utentecancellato') {
            echo "<font color=darkgreen face=arial><b>Utente eliminato con successo</b></font><br>";
        }     
    ?>  
<br>
<br>
<!-- Footer -->
<div class="container">
    <footer>
        <hr class="featurette-divider">
        <p class="pull-right"><a href="admin_gestione_utenti.php">Torna su</a></p>

        <p>© 2016, Basi Di Dati, Pizzeria Online</p>

    </footer>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<br>
</body>

</html>
