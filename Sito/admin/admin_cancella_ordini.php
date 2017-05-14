<?php
    require "../functions.php";
    verifica_accesso();
    try {
        $dbconn = db_connection();
        $statem = $dbconn->prepare('select count(*) from pizzecontenute where idordine = ?');
        $statem->execute(array($_GET['ido']));
                $current_date=getdate(date("U"));

        switch ($current_date[month]) {
            case "January":
                $month_number = "01";
                break;
            case "February":
                $month_number = "02";
                break;
            case "March":
                $month_number = "03";
                break;
            case "April":
                $month_number = "04";
                break;
            case "May":
                $month_number = "05";
                break;
            case "June":
                $month_number = "06";
                break;
            case "July":
                $month_number = "07";
                break;
            case "August":
                $month_number = "08";
                break;
            case "September":
                $month_number = "09";
                break;
            case "October":
                $month_number = "10";
                break;
            case "November":
                $month_number = "11";
                break;
            case "December":
                $month_number = "12";
                break;
            default: 
                echo "Errore conversione data!"; 
                break;
        }

        $date = $current_date[year]."-".$month_number."-".$current_date[mday];
        $today_time = strtotime($date);
        $expire_time = strtotime($_GET['gc']);

        if ($expire_time < $today_time) {
            $statement = $dbconn->prepare('delete from pizzecontenute where idordine=?');
            $statement->execute(array($_GET['ido']));
            $rec = $statement->fetch();
            $state = $dbconn->prepare('select cancella_ordine(?,?)');
            $state->execute(array($_GET['usr'],$_GET['ido']));
            header('Location:admin_lista_ordini.php?msg=cancellazioneavvenutavecchio');
        }
        else {
            foreach ($statem as $key) {
                if ($key[0] >= 1) {
                    header('Location:admin_lista_ordini.php?errore=warningpizze');   
                }
                else {
                    $statement = $dbconn->prepare('delete from pizzecontenute where idordine=?');
                    $statement->execute(array($_GET['ido']));
                    $rec = $statement->fetch();
                    $state = $dbconn->prepare('select cancella_ordine(?,?)');
                    $state->execute(array($_GET['usr'],$_GET['ido']));
                    header('Location:admin_lista_ordini.php?msg=cancellazionesavvenuta');
                }
            }
        }
    } catch (PDOException $e) { echo $e->getMessage(); }
?>