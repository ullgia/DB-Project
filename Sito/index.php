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
    <title>Homepage</title>
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

            <!-- Catalogo pizze -->
            <li><a href="pizze.php">Le Nostre Pizze</a></li>

            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Login/Registrazione<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#login">Login</a></li>
                    <li><a href="#registrazione">Registrazione</a></li>
                </ul>
            </li>

            <!-- Modulo Registrazione -->
            <?php

            ?>

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
    
    <!-- modulo login -->
<br>
<br>
<h1>Accedi per ordinare!</h1>
<br>
<br>
<br>
<section id="login" class="login"> 
    <div class="container" id="login-div">
        <h4 class="modal-title" id="Login">Accedi</h4>
        <div class="modal-body">
            <form role="form" action="accesso.php" method="post">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" id="uLogin" placeholder="Login" name="login">
                            <label for="uLogin" class="input-group-addon glyphicon glyphicon-user"></label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <input type="password" class="form-control" id="uPassword" placeholder="Password" name="password">
                        <label for="uPassword" class="input-group-addon glyphicon glyphicon-lock"></label>
                    </div>
                </div>
                <a href="#registrazione">Non sei ancora Registrato?</a>
            </div>
            <div class="modal-footer">
                <button type="Submit" value="Accedi" class="form-control btn btn-primary">Accedi</button>

            </div>
            </form>
            <?php
                if($_GET['errore'] == 'campivuotilogin') {
                    echo "<font color=crimson><b>Inserisci le credenziali</b></font><br>";
                }
            ?>
        </div>
    </div>
</div>
</section>

<br>
<br>
<br>
<br>
<hr class="featurette-divider">
<br>
<br>
<br>
<br>

    <!-- modulo registrazione -->
<section id="registrazione" class="registrazione">
    <div class="container" id="registrazione-div">
        <h4 class="modal-title">Registrazione</h4>
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
</section>
<br>
<br>
<br>
<br>




    

<!-- Footer -->
<div class="container">
    <footer>
        <hr class="featurette-divider">
        <p class="pull-right"><a href="index.php">Torna su</a></p>

        <p>© 2016, Basi Di Dati, Pizzeria Online

    </footer>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<br>
</body>

</html>
