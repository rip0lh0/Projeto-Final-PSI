DROP TABLE IF EXISTS `Tratamento_Ficha_Medica`;
DROP TABLE IF EXISTS `Adocao`;
DROP TABLE IF EXISTS `Ficha_Medica`;
DROP TABLE IF EXISTS `Canil_Animal`;
DROP TABLE IF EXISTS `Vacina`;
DROP TABLE IF EXISTS `perfil`;
DROP TABLE IF EXISTS `Animal`;
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `Tratamento`;
DROP TABLE IF EXISTS `Raca`;

CREATE TABLE `user`
(
 `id` integer NOT NULL ,
 `username` varchar
(45) NOT NULL ,
 `password_hash` varchar
(45) NOT NULL ,
 `password_reset_token` varchar
(45) ,
 `email` varchar
(45) NOT NULL ,
 `auth_key` varchar
(45) NOT NULL ,
 `status` integer NOT NULL ,
 `created_at` integer NOT NULL ,
 `updated_at` integer NOT NULL ,
PRIMARY KEY
(`id`)
);






-- ************************************** `Tratamento`

CREATE TABLE `Tratamento`
(
 `id`         int NOT NULL ,
 `created_at` date NOT NULL ,
 `duracao`    int NOT NULL ,
 `descricao`  varchar
(45) NOT NULL ,
 `estado`     varchar
(45) NOT NULL ,
PRIMARY KEY
(`id`)
);






-- ************************************** `Raca`

CREATE TABLE `Raca`
(
 `id` int NOT NULL ,
 `nome`      varchar
(45) NOT NULL ,
 `descricao` varchar
(45) NOT NULL ,
PRIMARY KEY
(`id`)
);






-- ************************************** `Vacina`

CREATE TABLE `Vacina`
(
 `id`            int NOT NULL ,
 `id_tratamento` int NOT NULL ,
 `vacina`        varchar
(45) NOT NULL ,
 `data`          varchar
(45) NOT NULL ,
PRIMARY KEY
(`id`),
KEY `fkIdx_191`
(`id_tratamento`),
CONSTRAINT `FK_191` FOREIGN KEY `fkIdx_191`
(`id_tratamento`) REFERENCES `Tratamento`
(`id`)
);






-- ************************************** `perfil`

CREATE TABLE `perfil`
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
(`id_user`) REFERENCES `user`
(`id`),
KEY `fkIdx_90`
(`id_tipo`),
CONSTRAINT `FK_90` FOREIGN KEY `fkIdx_90`
(`id_tipo`) REFERENCES `tipo_perfil`
(`id`)
);






-- ************************************** `Animal`

CREATE TABLE `Animal`
(
 `id`        int NOT NULL ,
 `id_raca`   int NOT NULL ,
 `nome`      varchar
(45) NOT NULL ,
 `descricao` varchar
(45) NOT NULL ,
PRIMARY KEY
(`id`),
KEY `fkIdx_87`
(`id_raca`),
CONSTRAINT `FK_87` FOREIGN KEY `fkIdx_87`
(`id_raca`) REFERENCES `Raca`
(`id`)
);






-- ************************************** `Ficha_Medica`

CREATE TABLE `Ficha_Medica`
(
 `id`         int NOT NULL ,
 `id_animal`  int NOT NULL ,
 `chip`       tinyint NOT NULL ,
 `genero`     char NOT NULL ,
 `tamanho`    float ,
 `idate`      int ,
 `created_at` integer NOT NULL ,
 `updated_at` integer ,
PRIMARY KEY
(`id`),
KEY `fkIdx_216`
(`id_animal`),
CONSTRAINT `FK_216` FOREIGN KEY `fkIdx_216`
(`id_animal`) REFERENCES `Animal`
(`id`)
);






-- ************************************** `Canil_Animal`

CREATE TABLE `Canil_Animal`
(
 `id`         integer NOT NULL ,
 `id_Animal`  int NOT NULL ,
 `id_Canil`   integer NOT NULL ,
 `discricao`  varchar
(45) NOT NULL ,
 `created_at` datetime NOT NULL ,
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
(`id_Canil`) REFERENCES `perfil`
(`id`)
);






-- ************************************** `Tratamento_Ficha_Medica`

CREATE TABLE `Tratamento_Ficha_Medica`
(
 `id_tratamento`   int NOT NULL ,
 `id_ficha_medica` int NOT NULL ,
KEY `fkIdx_199`
(`id_tratamento`),
CONSTRAINT `FK_199` FOREIGN KEY `fkIdx_199`
(`id_tratamento`) REFERENCES `Tratamento`
(`id`),
KEY `fkIdx_206`
(`id_ficha_medica`),
CONSTRAINT `FK_206` FOREIGN KEY `fkIdx_206`
(`id_ficha_medica`) REFERENCES `Ficha_Medica`
(`id`)
);






-- ************************************** `Adocao`

CREATE TABLE `Adocao`
(
 `id`              int NOT NULL ,
 `id_Adotante`     integer NOT NULL ,
 `id_canil_animal` integer NOT NULL ,
 `data_adocao`     datetime NOT NULL ,
 `descricao`       varchar
(45) ,
 `state`           integer NOT NULL ,
PRIMARY KEY
(`id`),
KEY `fkIdx_162`
(`id_Adotante`),
CONSTRAINT `FK_162` FOREIGN KEY `fkIdx_162`
(`id_Adotante`) REFERENCES `perfil`
(`id`),
KEY `fkIdx_171`
(`id_canil_animal`),
CONSTRAINT `FK_171` FOREIGN KEY `fkIdx_171`
(`id_canil_animal`) REFERENCES `Canil_Animal`
(`id`)
);





