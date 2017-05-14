<?php
	require "../functions.php";
    verifica_accesso();
    $dbconn = db_connection();
    try {
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
        $expire_time = strtotime($_GET['gco']);


        if ($expire_time < $today_time) {
            header('Location:admin_lista_ordini.php?errore=ordinevecchio');    
        }
        else {
    	    $statem = $dbconn->prepare('select di.idingrediente, m.quantita from disponibilitaingredienti di, magazzino m where idpizza = ? and di.idingrediente = m.idingrediente');
            $statem->execute(array($_GET['codpizza']));
       	    foreach ($statem as $key) {
           		$idingrediente=$key[0];
           		$quantitaingrediente=$key[1];
           		aggiorna_magazzino($dbconn,$quantitaingrediente+$_GET['numpizze'],$idingrediente);
           	}
    	   $state = $dbconn->prepare('delete from pizzecontenute where idordine = ? and idpizza = ?');
    	   $state->execute(array($_GET['idordine'],$_GET['codpizza']));
    	   header('Location:admin_lista_ordini.php?msg=cancellazionepizzasavvenuta');
        }
	} catch (PDOException $e) { echo $e->getMessage(); }
?>