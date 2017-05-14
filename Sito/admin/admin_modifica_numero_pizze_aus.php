<?php
	require "../functions.php";
    verifica_accesso();
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
    $expire_time = strtotime($_GET['gico']);

    if ($expire_time < $today_time) {
        header('Location:admin_lista_ordini.php?errore=ordinevecchionumpizze');
    }
    else {

        $memorizzapizze = $_POST['numeropizzereali'];
        /*
         *	Se il numero pizze che voglio variare è minore del numero già
         *	interno al database allora sicuramente nel magazzino c'è spazio perchè
         *	devo aggiungere ingredienti al magazzino e non toglierli.
         */
        if (($_POST['numeropizze'] > 0) && ($memorizzapizze > $_POST['numeropizze'])) {
        	$view = view_ingrediente_con_meno_quantita($dbconn, $_GET['codp']);
        	$statem = $dbconn->prepare('select di.idingrediente, m.quantita from disponibilitaingredienti di, magazzino m where idpizza = ? and di.idingrediente = m.idingrediente');
            $statem->execute(array($_GET['codp']));
            $differenzapizze = $memorizzapizze - $_POST['numeropizze'];
           	foreach ($statem as $key) {
           		$idingrediente=$key[0];
           		$quantitaingrediente=$key[1];
           		aggiorna_magazzino($dbconn,$quantitaingrediente+$differenzapizze,$idingrediente);
           	}
       		aggiorna_numero_pizze($dbconn,$_POST['numeropizze'],$_GET['codp'],$_GET['ido']);
        	header('Location:admin_lista_ordini.php?msg=modificaavvenuta');
        }
        /*
         *	Altrimenti se il numero di pizze che inserisco per modificare
         *	è maggiore del numero pre-inserito nel database allora controllo
         *	se effettivamente ci sono ingredienti sufficienti per poter aggiungere
         *	la quantità richiesta, se si scala dal magazzino quello che può scalare 
         *	altrimenti stampa errore che non ci sono ingredienti sufficienti per aggiungere
         * 	nessuna pizza.
         */
        else if (($_POST['numeropizze'] > 0) && ($memorizzapizze < $_POST['numeropizze'])) {
            $view = view_ingrediente_con_meno_quantita($dbconn, $_GET['codp']);
            foreach ($view as $key) {
                    $min = $key['quantita'];
            }
    	    if ($min <= 0) {
    	        header('Location:admin_lista_ordini.php?errore=ingredientiinsufficienti');
    	    }
    	    else if (($_POST['numeropizze'] > $min) && ($min > 0)) {
    	        $quantita = ingredienti_disponibili_per_pizza($dbconn, $_GET['codp']);
    	        foreach ($quantita as $quantitaingredienti) {
    	            $idingredienteperpizza = $quantitaingredienti[0];
    	            $quantitaingredienteperpizza = $quantitaingredienti[1];
    	            aggiorna_magazzino($dbconn,$quantitaingredienteperpizza-($min-$memorizzapizze),$idingredienteperpizza);
    	        }
    	        aggiorna_numero_pizze($dbconn,$min,$_GET['codp'],$_GET['ido']);
    	        header("Location:admin_lista_ordini.php?errore=ingredientiparziali&minimun=".$min."&"."nump=$_POST[numeropizze]");
    	    }
    	    else {
    	        $quantita = ingredienti_disponibili_per_pizza($dbconn, $_GET['codp']);
    	        $differenzapizze_due = $_POST['numeropizze'] - $memorizzapizze;
    	        foreach ($quantita as $quantitaingredienti) {
    	            $idingredienteperpizza = $quantitaingredienti[0];
    	            $quantitaingredienteperpizza = $quantitaingredienti[1];
    	            aggiorna_magazzino($dbconn,$quantitaingredienteperpizza-$differenzapizze_due,$idingredienteperpizza);
    	        }
    	        aggiorna_numero_pizze($dbconn,$_POST['numeropizze'],$_GET['codp'],$_GET['ido']);
    	        header('Location:admin_lista_ordini.php?msg=modificaavvenuta');
    	    }
        }
        else {
        	header('Location:admin_lista_ordini.php?errore=quantitainvalida');
        }
    }
?>