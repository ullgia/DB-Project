<?php  
/*Crea la form per effettuare l'ordinazione delle pizze, stampando un radio button per ogni pizza nel catalogo.*/
  require "../functions.php";
  verifica_accesso();

  ?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Ordinazione pizze</title>
</head>
<body>
<h1>Scelta pizza</h1>
  <p>Scegliere una pizza da inserire nell'ordine:</p>
  <?php
  try {
	$dbconn = db_connection();
	$st = $dbconn->prepare('select nome, prezzo from pizze');
	$st->execute();
	echo "<form action='esegui_scelta.php' method='post'>";
	foreach($st as $rec) {
		echo "<input type='radio' name='pizza' value=$rec[tipo]> $rec[tipo], $rec[prezzo] euro<br>";
	}
	echo"<br> </br>";
	echo"<tr><td>Quantit&agrave;: </td><td><input type='int' name='numeropizze' value='1'></td></tr>";
	echo"<input type='submit' value='Procedi'>";
  } catch (PDOException $e) { echo $e->getMessage(); }
  ?>
</body>
</html>
