<?php
require "../functions.php";

verifica_accesso();

                
        if (empty($_POST['login']) ||empty($_POST['nome']) || empty($_POST['cognome']) || empty($_POST['indirizzo']) || empty ($_POST['password']) ||empty($_POST['telefono']))
        {
            header('Location:admin_gestione_utenti.php?errore=campivuoti');
        }
        
        elseif((!preg_match("/^[0-9]*$/",$_POST['telefono'])))
        {
            header('Location:admin_gestione_utenti.php?errore=erroretelefono');
        }
        
        else
        {
          try{
            
            $dbconn = db_connection();
            $statement = $dbconn->prepare('select count (*) from utenti where login = ?');
            $statement->execute(array($_POST['login']));
            $rec = $statement->fetch();
            if ($rec[0] == 1) 
            {               
                header('Location:admin_gestione_utenti.php?errore=utenteesistente');
            }
            else{
            
                
                    $stat = $dbconn->prepare('select crea_utente(?,?,?,?,?,?)');  
                    $stat->execute(array($_POST['login'],$_POST['nome'],$_POST['cognome'],$_POST['indirizzo'],$_POST['password'],$_POST['telefono']));
                    header('Location:admin_gestione_utenti.php?msg=utenteaggiunto');
                      
           
                }
        
           } catch (PDOException $e) { echo $e->getMessage(); }
        }
    
    



?>
