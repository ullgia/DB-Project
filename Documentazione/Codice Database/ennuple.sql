# Ennuple tabella utenti

INSERT INTO utenti
VALUES ('admin','admin','admin','Indirizzo Pizzeria','admin',true, 1112223344);

# Funzione inserisci pizza

CREATE OR REPLACE FUNCTION inserisci_pizza(name text, prize real) 
RETURNS void AS 
$$insert into pizze(nome, prezzo) values(name, prize);$$ 
LANGUAGE sql;

# Margherita Pomodoro e Mozzarella
SELECT inserisci_pizza('Margherita', 4.50);
# Marinara Olio e Aglio, pomodoro
SELECT inserisci_pizza('Marinara', 3.80);
#Capricciosa prosciutto, funghi, carciofi, pomodoro, mozzarella
SELECT inserisci_pizza('Capricciosa', 6.50);
# Diavola: salamino, pomodoro, mozzarella
SELECT inserisci_pizza('Diavola', 5.20);
SELECT inserisci_pizza('Prosciutto e Funghi', 5.50);
# 4 Formaggi: pomodoro, mozzarella, gorgonzola, brie, grana grattuggiato, edamer
SELECT inserisci_pizza('Quattro Formaggi', 6.50);
# 4 stagioni: prosciutto, funghi, carciofi, pomodoro, mozzarella, peperoni
SELECT inserisci_pizza('Quattro Stagioni', 6.80);
SELECT inserisci_pizza('Viennese', 5.00);
# Romana: pomodoro, mozzarella, capperi, acciughe
SELECT inserisci_pizza('Romana', 6.00);


# Funzione inserisci ingrediente nel magazzino

CREATE OR REPLACE FUNCTION inserisci_ingrediente(name text, size integer) 
RETURNS void AS 
$$INSERT INTO magazzino(nomeingrediente, quantita) values(name, size);$$ 
LANGUAGE sql;

SELECT inserisci_ingrediente('Pomodoro', 10);
SELECT inserisci_ingrediente('Mozzarella', 10);
SELECT inserisci_ingrediente('Funghi', 10);
SELECT inserisci_ingrediente('Carciofi', 10);
SELECT inserisci_ingrediente('Prosciutto', 10);
SELECT inserisci_ingrediente('Salamino', 10);
SELECT inserisci_ingrediente('Aglio', 10);
SELECT inserisci_ingrediente('Olio di Oliva', 10);
SELECT inserisci_ingrediente('Brie', 10);
SELECT inserisci_ingrediente('Grana', 10);
SELECT inserisci_ingrediente('Edamer', 10);
SELECT inserisci_ingrediente('Peperoni', 10);
SELECT inserisci_ingrediente('Capperi', 10);
SELECT inserisci_ingrediente('Acciughe', 10);
SELECT inserisci_ingrediente('Gorgonzola', 10);
SELECT inserisci_ingrediente('Wurstel', 10);


# Funzione che mostra gli ingredienti per ogni pizza

CREATE OR REPLACE FUNCTION inserisci_ingrediente_per_pizza(idp integer, idi integer) 
RETURNS void AS 
$$INSERT INTO disponibilitaingredienti(idpizza, idingrediente) values(idp, idi);$$ 
LANGUAGE sql;

SELECT inserisci_ingrediente_per_pizza(1, 1);
SELECT inserisci_ingrediente_per_pizza(1, 2);
SELECT inserisci_ingrediente_per_pizza(2, 1);
SELECT inserisci_ingrediente_per_pizza(2, 7);
SELECT inserisci_ingrediente_per_pizza(2, 8);
SELECT inserisci_ingrediente_per_pizza(3, 1);
SELECT inserisci_ingrediente_per_pizza(3, 2);
SELECT inserisci_ingrediente_per_pizza(3, 4);
SELECT inserisci_ingrediente_per_pizza(3, 5);
SELECT inserisci_ingrediente_per_pizza(4, 1);
SELECT inserisci_ingrediente_per_pizza(4, 2);
SELECT inserisci_ingrediente_per_pizza(4, 6);
SELECT inserisci_ingrediente_per_pizza(5, 1);
SELECT inserisci_ingrediente_per_pizza(5, 2);
SELECT inserisci_ingrediente_per_pizza(5, 3);
SELECT inserisci_ingrediente_per_pizza(5, 5);
SELECT inserisci_ingrediente_per_pizza(6, 1);
SELECT inserisci_ingrediente_per_pizza(6, 2);
SELECT inserisci_ingrediente_per_pizza(6, 15);
SELECT inserisci_ingrediente_per_pizza(6, 9);
SELECT inserisci_ingrediente_per_pizza(6, 10);
SELECT inserisci_ingrediente_per_pizza(6, 11);
SELECT inserisci_ingrediente_per_pizza(7, 1);
SELECT inserisci_ingrediente_per_pizza(7, 2);
SELECT inserisci_ingrediente_per_pizza(7, 3);
SELECT inserisci_ingrediente_per_pizza(7, 4);
SELECT inserisci_ingrediente_per_pizza(7, 5);
SELECT inserisci_ingrediente_per_pizza(7, 12);
SELECT inserisci_ingrediente_per_pizza(8, 1);
SELECT inserisci_ingrediente_per_pizza(8, 2);
SELECT inserisci_ingrediente_per_pizza(8, 2);
SELECT inserisci_ingrediente_per_pizza(8, 16);
SELECT inserisci_ingrediente_per_pizza(9, 1);
SELECT inserisci_ingrediente_per_pizza(9, 2);
SELECT inserisci_ingrediente_per_pizza(9, 13);
SELECT inserisci_ingrediente_per_pizza(9, 14);

SELECT distinct p.nome, p.prezzo, array_to_string(array_agg(m.nomeingrediente),',') as ciao from pizze p, disponibilitaingredienti di, magazzino m where p.idpizza=di.idpizza and m.idingrediente=di.idingrediente group by p.nome, p.prezzo;


insert into magazzino values(1,'Pomodoro',500);
insert into magazzino values(2,'Mozzarella',500);
insert into magazzino values(3,'Funghi',500);
insert into magazzino values(4,'Carciofi',500);
insert into magazzino values(5,'Prosciutto',500);
insert into magazzino values(6,'Salamino',500);
insert into magazzino values(7,'Aglio',500);
insert into magazzino values(8,'Olio di Oliva',500);
insert into magazzino values(9,'Brie',500);
insert into magazzino values(10,'Grana',500);
insert into magazzino values(11,'Edamer',500);
insert into magazzino values(12,'Peperoni',500);
insert into magazzino values(13,'Capperi',500);
insert into magazzino values(14,'Acciughe',500);
insert into magazzino values(15,'Gorgonzola',500);
insert into magazzino values(16,'Wurstel',500);

