   
<?php
require "../functions.php";
verifica_accesso();


            try
            {
                $dbconn = db_connection();
                $statement = $dbconn->prepare('select count (*) from utenti where login=?');
                $statement->execute(array($_POST['login']));
                $rec = $statement->fetch();
                  if ($rec[0]==1) 
                    {
                      $dbconn = db_connection();
                      $stat = $dbconn->prepare('select cancella_utente(?)');
                      $stat->execute(array($_POST['login']));
                      $res = $stat->fetch();

                        
                        header('Location:admin_gestione_utenti.php?msg=utentecancellato');

                        
                    } 

    
            }
            catch (PDOException $e) { echo $e->getMessage(); }
           



?>
