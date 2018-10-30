-- ****************** SqlDBM: MySQL ******************;
-- ***************************************************;

DROP TABLE `Adotar`;


DROP TABLE `Animal`;


DROP TABLE `Adotante`;


DROP TABLE `Raca`;


DROP TABLE `Canil`;


DROP TABLE `Dados_Veterinarios`;


DROP TABLE `User`;



-- ************************************** `Raca`

CREATE TABLE `Raca`
(
 `id`        INT NOT NULL ,
 `descricao` VARCHAR(45) NOT NULL ,

PRIMARY KEY (`id`)
);






-- ************************************** `Canil`

CREATE TABLE `Canil`
(
 `id`         INT NOT NULL ,
 `nome`       VARCHAR(45) NOT NULL ,
 `morada`     VARCHAR(45) NOT NULL ,
 `localidade` VARCHAR(45) NOT NULL ,
 `contacto`   DOUBLE NOT NULL ,
 `email`      VARCHAR(45) NOT NULL ,

PRIMARY KEY (`id`)
);






-- ************************************** `Dados_Veterinarios`

CREATE TABLE `Dados_Veterinarios`
(
 `id`         NOT NULL ,
 `vacinacao` VARCHAR(45) NOT NULL ,
 `doencas`   VARCHAR(45) NOT NULL ,
 `chip`      TINYINT NOT NULL ,

PRIMARY KEY (`id`)
);






-- ************************************** `User`

CREATE TABLE `User`
(
 `id`                   INTEGER NOT NULL ,
 `username`             VARCHAR(45) NOT NULL ,
 `password_hash`        VARCHAR(45) NOT NULL ,
 `password_reset_token` VARCHAR(45) ,
 `email`                VARCHAR(45) NOT NULL ,
 `auth_key`             VARCHAR(45) NOT NULL ,
 `status`               INTEGER NOT NULL ,
 `created_at`           INTEGER NOT NULL ,
 `updated_at`           INTEGER NOT NULL ,
 `password`             VARCHAR(45) NOT NULL ,

PRIMARY KEY (`id`)
);






-- ************************************** `Animal`

CREATE TABLE `Animal`
(
 `id`                    INT NOT NULL ,
 `nome`                  VARCHAR(45) NOT NULL ,
 `genero`                CHAR NOT NULL ,
 `tamanho `              FLOAT NOT NULL ,
 `idade`                 INT NOT NULL ,
 `id_dados_veterinarios`  NOT NULL ,
 `id_raca`               INT NOT NULL ,
 `id_canil`              INT ,

PRIMARY KEY (`id`),
KEY `fkIdx_69` (`id_dados_veterinarios`),
CONSTRAINT `FK_69` FOREIGN KEY `fkIdx_69` (`id_dados_veterinarios`) REFERENCES `Dados_Veterinarios` (`id`),
KEY `fkIdx_80` (`id_canil`),
CONSTRAINT `FK_80` FOREIGN KEY `fkIdx_80` (`id_canil`) REFERENCES `Canil` (`id`),
KEY `fkIdx_87` (`id_raca`),
CONSTRAINT `FK_87` FOREIGN KEY `fkIdx_87` (`id_raca`) REFERENCES `Raca` (`id`)
);






-- ************************************** `Adotante`

CREATE TABLE `Adotante`
(
 `id`            INTEGER NOT NULL ,
 `nif`           DOUBLE NOT NULL ,
 `nome`          VARCHAR(45) NOT NULL ,
 `morada`        VARCHAR(45) NOT NULL ,
 `localidade`    VARCHAR(45) NOT NULL ,
 `nacionalidade` VARCHAR(45) NOT NULL ,
 `contacto`      DOUBLE NOT NULL ,
 `id_user`       INTEGER NOT NULL ,

PRIMARY KEY (`id`, `nif`),
KEY `fkIdx_46` (`id_user`),
CONSTRAINT `FK_46` FOREIGN KEY `fkIdx_46` (`id_user`) REFERENCES `User` (`id`)
);






-- ************************************** `Adotar`

CREATE TABLE `Adotar`
(
 `id`           INT NOT NULL ,
 `data_adocao`  DATETIME NOT NULL ,
 `id_adotante`  INTEGER NOT NULL ,
 `nif_adotante` DOUBLE NOT NULL ,
 `id_animal`    INT NOT NULL ,

PRIMARY KEY (`id`),
KEY `fkIdx_49` (`id_adotante`, `nif_adotante`),
CONSTRAINT `FK_49` FOREIGN KEY `fkIdx_49` (`id_adotante`, `nif_adotante`) REFERENCES `Adotante` (`id`, `nif`),
KEY `fkIdx_60` (`id_animal`),
CONSTRAINT `FK_60` FOREIGN KEY `fkIdx_60` (`id_animal`) REFERENCES `Animal` (`id`)
);





