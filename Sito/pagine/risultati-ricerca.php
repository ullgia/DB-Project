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
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/personal.css">
    <!-- Titolo -->
    <title>Risulati ricerca</title>
</head>

<body>

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
        <a class="navbar-brand" href="../index.php">Homepage</a>
    </div>

    <!-- MENU DI NAVIGAZIONE-->
    <div class="navbar-collapse collapse ">
        <ul class="nav navbar-nav">

            <!-- Catalogo pizze -->
            <li><a href="pizze.php">Le Nostre Pizze</a></li>

            <!-- Login -->
            <li><a href="#" data-toggle="modal" data-target="#myModal">Login</a></li>
            <!-- Modulo Login -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Accedi</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" action="accesso.php" method="post">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="uLogin" placeholder="Login" name="login">
                                        <label for="uLogin"
                                               class="input-group-addon glyphicon glyphicon-user"></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="uPassword"
                                               placeholder="Password" name="password">
                                        <label for="uPassword"
                                               class="input-group-addon glyphicon glyphicon-lock"></label>
                                    </div>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Ricordami
                                    </label>
                                </div>
                                <a data-toggle="modal" data-target="#registrazione">Non sei ancora Registrato?</a>
                                <br>
                                <div class="modal-footer">
                                    <button class="form-control btn btn-primary" type="submit" value="Accedi">Accedi</button>
                                </div>
                                <?php
                                    require "functions.php";
                                    $dbconn = db_connection();
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modulo Registrazione -->
            <div class="modal fade" id="registrazione" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Registrazione</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" role="form" action="registrazione.php">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="rLogin"
                                               placeholder="Login" name="login">
                                        <label for="uPassword"
                                               class="input-group-addon glyphicon glyphicon-user">                                                  
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="rNome" placeholder="Nome" name="nome">
                                        <label for="uLogin"
                                               class="input-group-addon glyphicon glyphicon-user">                                                  
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="rCognome"
                                               placeholder="Cognome" name="cognome">
                                        <label for="uPassword"
                                               class="input-group-addon glyphicon glyphicon-user"></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="rIndirizzo"
                                               placeholder="Indirizzo" name="indirizzo">
                                        <label for="uIndirzzo"
                                               class="input-group-addon glyphicon glyphicon-bookmark"></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="rPassword"
                                               placeholder="Password" name="password">
                                        <label for="uPassword"
                                               class="input-group-addon glyphicon glyphicon-lock"></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="rTelefono"
                                               placeholder="Telefono" name="telefono">
                                        <label for="uTelefono"
                                               class="input-group-addon glyphicon glyphicon-phone-alt"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="form-control btn btn-primary" value="Registrazione">Registrazione</button>
                        </div>
                            <?php
                            if ($_GET['errore'] == 'campivuoti') { 
                                echo "<font color=crimson face=arial><b>Non hai inserito tutti i dati!!!</b></font><br>";
                            }                                                       
                            elseif ($_GET['errore'] == 'erroretelefono') { 
                                echo "<font color=crimson face=arial><b>Numero di telefono invalido</b></font><br>";
                            }
                            ?>
                            </form>
                        </div>             
                    </div>
                </div>
            <!--</div> -->


        </ul>

        <!-- Funzione ricerca -->
        <ul class="nav navbar-nav navbar-right">
            <form action="risultati-ricerca.php" method="post" class="navbar-form navbar-right" role="search">
                <!-- Campo compilabile -->
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Cerca pizza" name="pizzasearch">
                </div>
                <!-- Pulsante di ricerca -->
                <button type="submit" class="btn btn-default"><a href="pagine/risultati-ricerca.html">Ricerca</a>
                </button>
            </form>
        </ul>

    </div>

</nav>


<!-- In Evidenza -->
    
<br>
<br>
<br>
<br>
<br>
<table border=1 style='width:100%;text-align:center;font-family:arial;font-size:18px;border-collapse: collapse;'>
             <tr>
                <th>Nome:</th>
                <th>Prezzo:</th>            
            </tr>
             <tr>    
    <?php
    require "functions.php";
    try {
        $dbconn = db_connection();
        echo $_GET['pizzasearch'];
        $ris = cerca_pizze($dbconn, $_POST['pizzasearch']);
        foreach($ris as $rec) {
            echo"<tr><td>$rec[nome]<br>\nIngredienti:$rec[ingredienti]</td><td>$rec[prezzo] euro</td></tr>";
        }
    } catch (PDOException $e) { echo $e->getMessage(); }
    ?>
            </tr>
        </table> 

<!-- Footer -->
<div class="container">
    <footer>
        <hr class="featurette-divider">
        <p class="pull-right"><a href="homepage.html">Top</a></p>

        <p>© 2016, Basi Di Dati, Pizzeria Online <a href="contacts.html">Contatti</a></p>

    </footer>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<br>
</body>

</html>