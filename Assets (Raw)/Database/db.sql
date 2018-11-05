-- ****************** SqlDBM: MySQL ******************;
-- ***************************************************;

DROP TABLE "Adotar";
DROP TABLE "Perfil";
DROP TABLE "Animal";
DROP TABLE "User";
DROP TABLE "Tipo";
DROP TABLE "Raca";
DROP TABLE "Dados_Veterinarios";

-- ************************************** "User"

CREATE TABLE "User"
(
    "id" integer NOT NULL,
    "username" varchar (45) NOT NULL ,
    "password_hash" varchar (45) NOT NULL ,
    "password_reset_token" varchar (45) ,
    "email" varchar (45) NOT NULL ,
    "auth_key" varchar (45) NOT NULL ,
    "status" integer NOT NULL ,
    "created_at" integer NOT NULL ,
    "updated_at" integer NOT NULL ,
    "password" varchar (45) NOT NULL ,
    PRIMARY KEY ("id")
);






-- ************************************** "Tipo"

CREATE TABLE "Tipo"
(
    "id" int NOT NULL ,
    "descricao" varchar
(45) NOT NULL ,

    PRIMARY KEY
("id")
);






-- ************************************** "Raca"

CREATE TABLE "Raca"
(
    "id" int NOT NULL ,
    "descricao" varchar
(45) NOT NULL ,

    PRIMARY KEY
("id")
);






-- ************************************** "Dados_Veterinarios"

CREATE TABLE "Dados_Veterinarios"
(
    "id" NOT NULL ,
    "vacinacao" varchar
(45) NOT NULL ,
    "doencas" varchar
(45) NOT NULL ,
    "chip" tinyint NOT NULL ,

    PRIMARY KEY
("id")
);






-- ************************************** "Perfil"

CREATE TABLE "Perfil"
(
 "id" integer NOT NULL ,
 "nif"           double NOT NULL ,
 "nome"          varchar
(45) NOT NULL ,
 "morada"        varchar
(45) NOT NULL ,
 "localidade"    varchar
(45) NOT NULL ,
 "nacionalidade" varchar
(45) NOT NULL ,
 "contacto"      double NOT NULL ,
 "id_user"       integer NOT NULL ,
 "id_tipo"       int NOT NULL ,

PRIMARY KEY
("id", "nif"),
KEY "fkIdx_46"
("id_user"),
CONSTRAINT "FK_46" FOREIGN KEY "fkIdx_46"
("id_user") REFERENCES "User"
("id"),
KEY "fkIdx_90"
("id_tipo"),
CONSTRAINT "FK_90" FOREIGN KEY "fkIdx_90"
("id_tipo") REFERENCES "Tipo"
("id")
);






-- ************************************** "Animal"

CREATE TABLE "Animal"
(
    "id" int NOT NULL ,
    "nome" varchar
(45) NOT NULL ,
    "genero" char NOT NULL ,
    "tamanho" float NOT NULL ,
    "idade" int NOT NULL ,
    "id_dados_veterinarios" NOT NULL ,
    "id_raca" int NOT NULL ,

    PRIMARY KEY
("id"),
    KEY "fkIdx_69"
    ("id_dados_veterinarios"),
CONSTRAINT "FK_69" FOREIGN KEY "fkIdx_69"
    ("id_dados_veterinarios") REFERENCES "Dados_Veterinarios"
    ("id"),
KEY "fkIdx_87"
    ("id_raca"),
CONSTRAINT "FK_87" FOREIGN KEY "fkIdx_87"
    ("id_raca") REFERENCES "Raca"
    ("id")
);






    -- ************************************** "Adotar"

    CREATE TABLE "Adotar"
(
 "id" int NOT NULL ,
 "data_adocao" datetime NOT NULL ,
 "id_adotante" integer NOT NULL ,
 "nif_adotante" double NOT NULL ,
 "id_animal"    int NOT NULL ,

PRIMARY KEY
    ("id"),
KEY "fkIdx_49"
    ("id_adotante", "nif_adotante"),
CONSTRAINT "FK_49" FOREIGN KEY "fkIdx_49"
    ("id_adotante", "nif_adotante") REFERENCES "Perfil"
    ("id", "nif"),
KEY "fkIdx_60"
    ("id_animal"),
CONSTRAINT "FK_60" FOREIGN KEY "fkIdx_60"
    ("id_animal") REFERENCES "Animal"
    ("id")
);





