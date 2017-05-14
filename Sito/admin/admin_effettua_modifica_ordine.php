<?php  
    require "../functions.php"; 
    verifica_accesso();
    if (empty($_POST['indirizzo'])) {
        header('Location:admin_modifica_ordine.php?errore=campivuoti');
    }

    try {
        $dbconn = db_connection();
        $year = $_POST['year'];
        $month = $_POST['months'];
        $day = $_POST['days'];
        $dateformat = $year."-".$month."-".$day;

        $minute=$_POST['minutes'];
        $hour=$_POST['hours'];
        $timeformat=$hour.":".$minute.":"."00";
        if(isset($_POST['modifica'])) {
            $stat = $dbconn->prepare('select modifica_ora_data_ordine(?,?,?,?,?)'); 
            $stat->execute(array($_POST['idordine'],$_POST['login'],$dateformat,$timeformat,$_POST['indirizzo']));
            header('Location:admin_lista_ordini.php?msg=ordinemodificato');
        }
    } catch(PDOException $e) { echo $e->getMessage(); }
?>              
