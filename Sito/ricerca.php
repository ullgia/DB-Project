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
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/home_pages.css">
    <!-- Titolo -->
    <title>Risultati ricerca</title>
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
        <a class="navbar-brand" href="index.php">Homepage</a>
    </div>

    <!-- MENU DI NAVIGAZIONE-->
    <div class="navbar-collapse collapse ">
        <ul class="nav navbar-nav">

            <!-- Linkcatalogo pizze -->
            <li><a href="pizze.php">Le Nostre Pizze</a></li>

            <!-- Link login/registrazione -->
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Login/Registrazione<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="index.php#login">Login</a></li>
                    <li><a href="index.php#registrazione">Registrazione</a></li>
                </ul>
            </li>

            <!-- Modulo Login -->
            <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                        </div>
                        <div class="modal-footer">
                            <button type="Submit" value="Accedi" class="form-control btn btn-primary">Accedi</button>
                        </div>
                            </form>
                    </div>
                </div>
            </div>

            <!-- Modulo Registrazione -->
            <?php

            ?>
            
            <div class="modal fade" id="registrazione" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Registrazione</h4>
                        </div>

                        <div class="modal-body">
                            <form role="form" action="registrazione.php" method="post">
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
                                        <input type="password" class="form-control" id="rPassword"
                                               placeholder="Password" name ="password">
                                        <label for="uPassword"
                                               class="input-group-addon glyphicon glyphicon-lock"></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="rTelefono" placeholder="N° telefono" name="telefono">
                                        <label for="uLogin" class="input-group-addon glyphicon glyphicon-phone"></label>
                                    </div>
                                </div>
                            <div class="modal-footer">
                            <button type="submit" class="form-control btn btn-primary" value="Registrazione" >Registrazione</button>
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
                            ?>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </ul>

 


        </ul>

        <!-- Funzione ricerca -->
        <ul class="nav navbar-nav navbar-right">
            <?php
                if($_GET['errore'] == 'ricercavuota') {
                    echo "<font color=crimson><b>Inserisci il nome della pizza</b></font><br>";
                }
            ?>
            <form action="ricerca.php" method="post" class="navbar-form navbar-right" role="search">
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
                <br>

                <div class="container">
                        <?php
                            require "functions.php";
                                try {
                                    $dbconn=db_connection();
                                    $prova=cerca_pizze($dbconn, $_POST['pizzasearch']);
                                   
                                    if($prova>0 ){
                                        $ciao= 0;
                                        foreach ($prova as $provo ) {
                                            $ciao = $ciao +1;
                                        }
                                        if($ciao && $_POST['pizzasearch']!=' '){
                                            $dbconn=db_connection();
                                            $ris=cerca_pizze($dbconn, $_POST['pizzasearch']);
                                            echo "<table class='table table-bordered'>
                                                    <thead>
                                                        <tr>
                                                            <th>Nome pizza: </th>
                                                            <th>Ingredienti: </th>
                                                            <th>Prezzo: </th>
                                                        </tr>
                                                    </thead>";
                                            foreach($ris as $rec) {
                                                echo "<tbody>
                                                    <tr>
                                                        <td>$rec[nome] </td>
                                                        <td>$rec[ingredienti] </td>
                                                        <td>$rec[prezzo] €</td>
                                                    </tr>
                                                </tbody>";
                                            }
                                        }
                                        else echo "<h1 style='text-align:center;'>La/e pizza/e da te cercate non sono state trovate.</h1>";
                                    }
                                    else {
                                        echo "<h1 style='text-align:center;''>Non è stato inserito niente da cercare.</h1>";
                                        echo "<h1 style='text-align:center;''>Riprova.</h1>";
                                    }
        
                                }catch (PDOException $e) { echo $e->getMessage(); }
                        ?>
                    </table>
                </div>

        <!--    </tr>
        </table> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<br>
    
    </body>
</html>
