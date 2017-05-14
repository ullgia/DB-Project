<?php
    require "../functions.php";
    verifica_accesso();
    try {
        $dbconn = db_connection();
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
            $state->execute(array($_SESSION['login'],$_GET['ido']));
            header('Location:user_lista_ordini.php?msg=cancellazioneavvenuta');
        }
        else if ($expire_time >= $today_time){
            $get_id_pizza = $dbconn->prepare('select idpizza, numeropizze from pizzecontenute where idordine = ?');
            $get_id_pizza->execute(array($_GET['ido']));
            $statem = $dbconn->prepare('select di.idingrediente, m.quantita from disponibilitaingredienti di, magazzino m where idpizza = ? and di.idingrediente = m.idingrediente');
            foreach ($get_id_pizza as $get_cod_pizza) {
                $idpizza = $get_cod_pizza[0];
                $numeropizze = $get_cod_pizza[1];

                $statem->execute(array($idpizza));
                foreach ($statem as $key) {
                    $idingrediente=$key[0];
                    $quantitaingrediente=$key[1];
                    aggiorna_magazzino($dbconn,$quantitaingrediente+$numeropizze,$idingrediente);
                } 
            }
            $statement = $dbconn->prepare('delete from pizzecontenute where idordine=?');
            $statement->execute(array($_GET['ido']));
            $rec = $statement->fetch();
            $state = $dbconn->prepare('select cancella_ordine(?,?)');
            $state->execute(array($_SESSION['login'],$_GET['ido']));
            header('Location:user_lista_ordini.php?msg=ordineannullato');
        }
    } catch (PDOException $e) { echo $e->getMessage(); }
?>