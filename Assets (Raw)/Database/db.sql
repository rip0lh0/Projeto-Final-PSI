-- ****************** SqlDBM: MySQL ******************;
-- ***************************************************;

DROP TABLE IF EXISTS `Adotar`;


DROP TABLE IF EXISTS `Canil_Animal`;


DROP TABLE IF EXISTS `Perfil`;


DROP TABLE IF EXISTS `Animal`;


DROP TABLE IF EXISTS `User`;


DROP TABLE IF EXISTS `Tipo_Perfil`;


DROP TABLE IF EXISTS `Raca`;


DROP TABLE IF EXISTS `Dados_Veterinarios`;



-- ************************************** `User`

CREATE TABLE `User`
(
 `id`                   integer NOT NULL ,
 `username`             varchar
(45) NOT NULL ,
 `password_hash`        varchar
(45) NOT NULL ,
 `password_reset_token` varchar
(45) ,
 `email`                varchar
(45) NOT NULL ,
 `auth_key`             varchar
(45) NOT NULL ,
 `status`               integer NOT NULL ,
 `created_at`           integer NOT NULL ,
 `updated_at`           integer NOT NULL ,
 `password`             varchar
(45) NOT NULL ,
PRIMARY KEY
(`id`)
);






-- ************************************** `Tipo_Perfil`

CREATE TABLE `Tipo_Perfil`
(
 `id`        int NOT NULL ,
 `descricao` varchar
(45) NOT NULL ,
PRIMARY KEY
(`id`)
);






-- ************************************** `Raca`

CREATE TABLE `Raca`
(
 `id`        int NOT NULL ,
 `descricao` varchar
(45) NOT NULL ,
PRIMARY KEY
(`id`)
);






-- ************************************** `Dados_Veterinarios`

CREATE TABLE `Dados_Veterinarios`
(
 `id`        integer NOT NULL ,
 `vacinacao` varchar
(45) NOT NULL ,
 `doencas`   varchar
(45) NOT NULL ,
PRIMARY KEY
(`id`)
);






-- ************************************** `Perfil`

CREATE TABLE `Perfil`
(
 `id`            integer NOT NULL ,
 `id_user`       integer NOT NULL ,
 `id_tipo`       int NOT NULL ,
 `nif`           double NOT NULL ,
 `nome`          varchar
(45) NOT NULL ,
 `morada`        varchar
(45) ,
 `localidade`    varchar
(45) ,
 `nacionalidade` varchar
(45) ,
 `contacto`      double NOT NULL ,
PRIMARY KEY
(`id`),
KEY `fkIdx_46`
(`id_user`),
CONSTRAINT `FK_46` FOREIGN KEY `fkIdx_46`
(`id_user`) REFERENCES `User`
(`id`),
KEY `fkIdx_90`
(`id_tipo`),
CONSTRAINT `FK_90` FOREIGN KEY `fkIdx_90`
(`id_tipo`) REFERENCES `Tipo_Perfil`
(`id`)
);

-- ************************************** `Animal`

CREATE TABLE `Animal`
(
 `id`                    int NOT NULL ,
 `id_dados_veterinarios` integer NOT NULL ,
 `id_raca`               int NOT NULL ,
 `chip`                  tinyint NOT NULL ,
 `nome`                  varchar
(45) NOT NULL ,
 `genero`                char NOT NULL ,
 `tamanho`               float NOT NULL ,
 `idade`                 int NOT NULL ,
 `descricao`             varchar
(45) NOT NULL ,
PRIMARY KEY
(`id`),
KEY `fkIdx_69`
(`id_dados_veterinarios`),
CONSTRAINT `FK_69` FOREIGN KEY `fkIdx_69`
(`id_dados_veterinarios`) REFERENCES `Dados_Veterinarios`
(`id`),
KEY `fkIdx_87`
(`id_raca`),
CONSTRAINT `FK_87` FOREIGN KEY `fkIdx_87`
(`id_raca`) REFERENCES `Raca`
(`id`)
);

-- ************************************** `Canil_Animal`

CREATE TABLE `Canil_Animal`
(
 `id`           integer NOT NULL ,
 `discricao`    varchar
(45) NOT NULL ,
 `data_entrada` datetime NOT NULL ,
 `id_Animal`    int NOT NULL ,
 `id_Canil`     integer NOT NULL ,
PRIMARY KEY
(`id`),
KEY `fkIdx_147`
(`id_Animal`),
CONSTRAINT `FK_147` FOREIGN KEY `fkIdx_147`
(`id_Animal`) REFERENCES `Animal`
(`id`),
KEY `fkIdx_150`
(`id_Canil`),
CONSTRAINT `FK_150` FOREIGN KEY `fkIdx_150`
(`id_Canil`) REFERENCES `Perfil`
(`id`)
);






-- ************************************** `Adotar`

CREATE TABLE `Adotar`
(
 `id`              int NOT NULL ,
 `id_Adotante`     integer NOT NULL ,
 `id_canil_animal` integer NOT NULL ,
 `data_adocao`     datetime NOT NULL ,
 `descricao`       varchar
(45) NOT NULL ,
 `state`           integer NOT NULL ,
PRIMARY KEY
(`id`),
KEY `fkIdx_162`
(`id_Adotante`),
CONSTRAINT `FK_162` FOREIGN KEY `fkIdx_162`
(`id_Adotante`) REFERENCES `Perfil`
(`id`),
KEY `fkIdx_171`
(`id_canil_animal`),
CONSTRAINT `FK_171` FOREIGN KEY `fkIdx_171`
(`id_canil_animal`) REFERENCES `Canil_Animal`
(`id`)
);
