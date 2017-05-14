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
	    <title>Modifica Ordine</title>
	</head>

	<body>

    <form action="admin_effettua_modifica_ordine.php" method="post" class="form-inline">
        <div class="container" style="width: 500px";>

                
                <label>ID</label>
                <br>
                <input type="integer" value="<?php echo $_GET['ido']; ?>" name='idordine'>
                <br></br>
                <label>Login</label>
                <br>
                <input type="text" value="<?php echo $_GET['usr']; ?>" name="login">
                <br></br>
            <?php
                require "../functions.php";
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
            <?php
                if ($_GET['errore']=='campivuoti') {
                    echo "<font color=crimson><b>Non hai inserito l'indirizzo</b></font><br>";
                }
            ?>
            <br>
            <br>
            <br>
            <button type="submit" name="modifica" class='form-control btn btn-primary' style='text-align:center;'>Modifica dati consegna</button>
        </div>
    </form> 
	</body>
</html>