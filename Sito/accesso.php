   
<?php
  require "functions.php";

    if(!(isset($_POST['Accedi']))) {

        if (empty($_POST['login']) || empty($_POST['password'])) {
            header('Location:index.php?errore=campivuotilogin');
        }

        else {
            try {
                $dbconn = db_connection();
                $statement = $dbconn->prepare('select dati_validi(?, ?)');
                $statement->execute(array($_POST['login'],$_POST['password']));
                $rec = $statement->fetch();
                if ($rec[0]==1) {
                    $dbconn = db_connection();
                    $stat = $dbconn->prepare('select is_admin(?)');
                    $stat->execute(array($_POST['login']));
                    $res = $stat->fetch();  
                    if($res[0]==true) {
                        header('Location: admin/admin.php');
                        session_start();                            
                        $_SESSION['login'] = $_POST['login'];
                    }
                    else {
                        header('Location: user/user.php');
                        session_start();                            
                        $_SESSION['login'] = $_POST['login'];
                    }                       
                } 
                else {
                header('Location:index.php?errore=credenzialiinvalide');
                }     
            }
        catch (PDOException $e) { echo $e->getMessage(); }
        }

    }

?>