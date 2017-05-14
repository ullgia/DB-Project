<?php  
    require "../functions.php"; 
    verifica_accesso();
    if (empty($_POST['indirizzo'])) {
        header('Location:user_crea_ordine.php?errore=campivuoti');
    }
    else
    {
        $current_user = $_SESSION['login'];
    
        $year = $_POST['year'];
        $month = $_POST['months'];
        $day = $_POST['days'];
        $dateformat = $year."-".$month."-".$day;
    
        $minute=$_POST['minutes'];
        $hour=$_POST['hours'];
        $timeformat=$hour.":".$minute.":"."00";
    
        try {
            $dbconn = db_connection();
            $check = $dbconn->prepare('select count(*) from ordini where login = ? and giornoconsegna = ?');
            $check->execute(array($current_user,$dateformat));
            foreach ($check as $check_o) {
                if ($check_o[0] == 1) {
                    echo "Ordine esistente!";
                    echo "<br></br>";
                    echo "Cambiare data oppure cancella l'ordine e rifai";
                    header( "refresh:2;url=user.php" );
                }
                else {
                    $statement = $dbconn->prepare('select crea_ordine(?,?,?,?)');
                    $statement->execute(array($current_user,$dateformat,$timeformat,$_POST['indirizzo']));
                    header('Location: user_aggiunta_pizze.php');
                }
            }
        } catch (PDOException $e) { echo $e->getMessage(); }
    }

?>


