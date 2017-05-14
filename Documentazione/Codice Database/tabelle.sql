# Tabella utenti (compreso utenti amministratori)

CREATE TABLE utenti
(
  login text NOT NULL,
  nome text NOT NULL,
  cognome text NOT NULL,
  indirizzo text NOT NULL,
  password text NOT NULL,
  admin boolean DEFAULT false,
  numerotelefono integer NOT NULL,
  CONSTRAINT login PRIMARY KEY (login)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE utenti
  OWNER TO a2014u73;
COMMENT ON TABLE utenti
  IS 'Tabella Utenti Admin e non.';


# Tabella ordini 

CREATE TABLE ordini
(
  idordine serial NOT NULL,
  utente text,
  giornoconsegna date,
  oraconsegna time without time zone,
  indirzzoconsegna text,
  CONSTRAINT idordine PRIMARY KEY (idordine),
  CONSTRAINT utente FOREIGN KEY (utente)
      REFERENCES utenti (login) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE ordini
  OWNER TO a2014u73;
COMMENT ON TABLE ordini
  IS 'ordini con dettagli pizze e dettagli di consegna';


# Tabella pizze

CREATE TABLE pizze
(
  idpizza serial NOT NULL,
  nome text,
  prezzo real,
  CONSTRAINT idpizza PRIMARY KEY (idpizza)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE pizze
  OWNER TO a2014u73;


# Tabella pizze contenute (molti a molti)

CREATE TABLE pizzecontenute
(
  idpizza serial NOT NULL,
  idordine serial NOT NULL,
  numeropizze integer,
  CONSTRAINT "idpizza, idordine" PRIMARY KEY (idpizza, idordine),
  CONSTRAINT idpizze FOREIGN KEY (idpizza)
      REFERENCES pizze (idpizza) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE pizzecontenute
  OWNER TO a2014u73;


# Tabella magazzino

CREATE TABLE magazzino
(
  idingrediente serial NOT NULL,
  nomeingrediente text,
  quantita integer,
  CONSTRAINT idingrediente PRIMARY KEY (idingrediente)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE magazzino
  OWNER TO a2014u73; 


# Tabella disponibilità ingredienti (molti a molti)

CREATE TABLE disponibilitaingredienti
(
  idpizza integer NOT NULL,
  idingrediente integer NOT NULL,
  CONSTRAINT "idpizza, idingrediente" PRIMARY KEY (idpizza, idingrediente),
  CONSTRAINT idpizza FOREIGN KEY (idpizza)
      REFERENCES pizze (idpizza) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE disponibilitaingredienti
  OWNER TO a2014u73;