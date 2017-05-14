<?php   
error_reporting(E_ALL & ~E_NOTICE);  
    
/*qui ci verranno messe le funzioni per la creazione di query*/    
    
    
    function db_connection()
    {
     $dbconn = new PDO('pgsql:host=dblab.dsi.unive.it;port=5432;dbname= a2014u73',' a2014u73','I.vSp.4Z');
     $dbconn -> setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     return $dbconn;
    }

    function verifica_accesso() {
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location:index.php');
        }
    }


        
    function query_utenti_registrati($dbconn)
    {
            $stat=$dbconn->prepare('select login, nome, cognome, indirizzo, numerotelefono from utenti');
            $stat->execute();

            
            return $stat;
    }
  
    function lista_pizze($dbconn)
    {
            $stat=$dbconn->prepare('select p.nome,p.prezzo, array_to_string(array_agg(m.nomeingrediente),?) as ingredienti from disponibilitaingredienti di,pizze p ,magazzino m where p.idpizza=di.idpizza and m.idingrediente=di.idingrediente group by p.nome,p.prezzo order by p.prezzo');
            
            $stat->execute(array(','));

            
            return $stat;
    }


    function cerca_pizze($dbconn, $parola) {
        $parola_con_wildcard = '%'.$parola.'%';
        
        if(!(empty($parola)))
        {

        $stat=$dbconn->prepare('select p.nome,p.prezzo, array_to_string(array_agg(m.nomeingrediente),?) as ingredienti from disponibilitaingredienti di,pizze p ,magazzino m where p.idpizza=di.idpizza and m.idingrediente=di.idingrediente and nome ilike ? group by p.nome,p.prezzo order by p.prezzo');
            
            $stat->execute(array(',',$parola_con_wildcard));
        return $stat;
        }
        
    }


    
    
    /*function inserisci_utente($dbconn)
    {
        $stat=$dbconn->prepare('insert into utenti (login,nome,cognome,indirizzo,password,numerotelefono) values(?,?,?,?,?,?)');
        $stat->execute(array($_POST['login'],$_POST['nome'],$_POST['cognome'],$_POST['indirizzo'],md5($_POST['password']),$_POST['telefono']));
        return $stat; 
        
        create or replace function crea_utente(log text,name text,surname text,address text,pass text,tel text) returns void as $$
  insert into utenti (login,nome,cognome,indirizzo, password,numerotelefono) values (log,name,surname,address,md5(pass),tel);
$$ language sql;       
    
      
    
    }*/
    
    function restituisci_ingredienti($dbconn) {
        $stat=$dbconn->prepare('select * from magazzino');
        $stat->execute();
        return $stat;         
         
    
    }
    
     function prezzo_totale($dbconn)
    {
        $stat=$dbconn->prepare('select * from magazzino');
        $stat->execute();
        return $stat;         
         
    
    }
    
    
    function dati_utenti_registrati($dbconn) {
        $stat=$dbconn->prepare('select nome,cognome,indirizzo,login,numerotelefono from utenti where login=?');
        $stat->execute(array($_SESSION['login']));
        foreach($stat as $record) {
            echo "<font face=arial> <br>username: $record[login] <br> nome: $record[nome]<br> cognome: $record[cognome]<br> indirizzo: $record[indirizzo] <br> numero di telefono: $record[numerotelefono]</font><br>";     
        }
        return $stat;
    }
    
    function stampa_ordini($dbconn) {
        $stat=$dbconn->prepare('select * from ordini');
        $stat->execute();        
        return $stat;
    }

    function stampa_ordini_per_utente($dbconn) {
        $stat=$dbconn->prepare('select * from ordini where login = ?');
        $stat->execute(array($_SESSION['login']));
        return $stat;
    }

    function count_days() {    
        $date=getdate();
        if($date['mon']==4 || $date['mon']==6 || $date['mon']==9 || $date['mon']==11) {
            $k=30;
        }
        elseif($date['mon']==1 || $date['mon']==3 || $date['mon']==5 || $date['mon']==7 || $date['mon']==8 || $date['mon']==10 || $date['mon']==12) {
            $k=31;
        }
        else {
            $k=28;
        }
        return $k;
    }

    function lista_utenti($dbconn) {
        $stat=$dbconn->prepare('select * from utenti ');    
        $stat->execute();    
        return $stat;
    }

    /*NOTA BENE: E' stato aggiunto un order by perchè nelle ordinazioni quando vengono scalati gli ingredienti dal magazzino, la tabella non è più ordinata */
    function ingredienti_disponibili($dbconn) {
        $stat=$dbconn->prepare('select idingrediente, nomeingrediente, quantita from magazzino order by idingrediente asc');
        $stat->execute();
        return $stat;
    }

    function ingredienti_disponibili_per_pizza($dbconn,$idp) {
        $stat=$dbconn->prepare('select di.idingrediente, m.quantita from pizze p, disponibilitaingredienti di, magazzino m where di.idingrediente = m.idingrediente and p.idpizza = di.idpizza and p.idpizza = ?');
        $stat->execute(array($idp));
        return $stat;
    }

    function aggiorna_magazzino($dbconn,$quant,$idi) {
        $stat=$dbconn->prepare('update magazzino set quantita = ? where idingrediente = ?');
        $stat->execute(array($quant,$idi));
    }


    function pizze_per_ordine($dbconn,$usr,$ido) {
        $stat=$dbconn->prepare('select p.idpizza, p.nome, pc.numeropizze from ordini o, pizzecontenute pc, pizze p where pc.idordine = o.idordine and p.idpizza = pc.idpizza and o.login = ? and pc.idordine = ?');
        $stat->execute(array($usr,$ido));
        return $stat;
    }

   function pizze_per_idordine($dbconn,$usr,$id) {
        $stat=$dbconn->prepare('select p.nome, pc.numeropizze from ordini o, pizzecontenute pc, pizze p where pc.idordine = o.idordine and p.idpizza = pc.idpizza and o.login = ? and o.idordine=?');
        $stat->execute(array($usr,$id));
        return $stat;
    }


    function numero_ingredienti_per_pizza($dbconn,$idp) {
        $stat=$dbconn->prepare('select count(idingrediente) from disponibilitaingredienti where idpizza = ?');
        $stat->execute(array($idp));
        return $stat;
    }

    function idordine_data_una_login($dbconn,$usr) {
        $stat = $dbconn->prepare('select IDordine from ordini where login = ?');
        $stat->execute(array($usr));
        return $stat;
    }

    function view_ingrediente_con_meno_quantita($dbconn, $idi) {
        $stat = $dbconn->prepare('select m.quantita from disponibilitaingredienti di, magazzino m where di.idingrediente = m.idingrediente and di.idpizza = ? order by m.quantita asc limit 1;');
        $stat->execute(array($idi));
        return $stat;
    }

    function aggiorna_numero_pizze($dbconn,$numpiz,$idp,$ido) {
        $stat=$dbconn->prepare('update pizzecontenute set numeropizze=? where idpizza=? and idordine=?');
        $stat->execute(array($numpiz,$idp,$ido));
    }

     function ripristina_ingredienti($dbconn,$numpiz,$idp,$ido) {
        $stat=$dbconn->prepare('update disponibilitaingredienti set numeropizze=? where idpizza=? and idordine=?');
        $stat->execute(array($numpiz,$idp,$ido));
    }

?>
