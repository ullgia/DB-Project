<?php
    require "../functions.php";
    verifica_accesso();
    try {
        $dbconn = db_connection();
        $statement = $dbconn->prepare('select count (*) from magazzino where nomeingrediente=?');
        $statement->execute(array($_POST['nomeingrediente']));
        $rec = $statement->fetch();
        if ($rec[0]==1) {
            $dbconn = db_connection();
            $stat = $dbconn->prepare('select quantita from magazzino where nomeingrediente =?');
            $stat->execute(array($_POST['nomeingrediente']));
            $res = $stat->fetch();
            $insert = $dbconn->prepare('UPDATE magazzino SET quantita=? WHERE nomeingrediente=?');
            if ($_POST['quantita'] <= 0) {
                header('Location:admin_ricarica_magazzino.php?errore=quantitanonvalida');
            }
            else {
                $quantita_da_inserire = $_POST['quantita'] + $res[0];
                $insert->execute(array($quantita_da_inserire, $_POST['nomeingrediente']));
                $result = $insert->fetch();
                header('Location:admin_ricarica_magazzino.php?msg=ricaricaavvenuta');
            }
        } 
    } catch (PDOException $e) { echo $e->getMessage(); }
           
?>