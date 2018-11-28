-- ****************** SqlDBM: MySQL ******************;
-- ***************************************************;

DROP TABLE `Adoption`;


DROP TABLE `Vaccine`;


DROP TABLE `Social`;


DROP TABLE `Schedule`;


DROP TABLE `Kennel_Animal`;


DROP TABLE `Contact`;


DROP TABLE `Treatment`;


DROP TABLE `Profile_Kennel`;


DROP TABLE `Profile_Adopter`;


DROP TABLE `User`;


DROP TABLE `Animal_File`;


DROP TABLE `Local`;


DROP TABLE `Breed`;


DROP TABLE `Animal`;



-- ************************************** `Local`

CREATE TABLE `Local`
(
 `id`        integer NOT NULL ,
 `id_parent` integer ,
 `name`      varchar(45) NOT NULL ,
PRIMARY KEY (`id`),
KEY `fkIdx_263` (`id_parent`),
CONSTRAINT `FK_263` FOREIGN KEY `fkIdx_263` (`id_parent`) REFERENCES `Local` (`id`)
);






-- ************************************** `Breed`

CREATE TABLE `Breed`
(
 `id`        integer NOT NULL ,
 `id_parent` integer ,
 `name`      varchar(45) NOT NULL ,
PRIMARY KEY (`id`),
KEY `fkIdx_283` (`id_parent`),
CONSTRAINT `FK_283` FOREIGN KEY `fkIdx_283` (`id_parent`) REFERENCES `Breed` (`id`)
);






-- ************************************** `Animal`

CREATE TABLE `Animal`
(
 `id`          integer NOT NULL ,
 `name`        varchar(45) NOT NULL ,
 `description` varchar(45) NOT NULL ,
PRIMARY KEY (`id`)
);






-- ************************************** `User`

CREATE TABLE `User`
(
 `id`                   integer NOT NULL ,
 `id_local`             integer NOT NULL ,
 `username`             varchar(45) NOT NULL ,
 `password_hash`        varchar(45) NOT NULL ,
 `password_reset_token` varchar(45) ,
 `email`                varchar(45) NOT NULL ,
 `auth_key`             varchar(45) NOT NULL ,
 `status`               integer NOT NULL ,
 `created_at`           integer NOT NULL ,
 `updated_at`           integer NOT NULL ,
PRIMARY KEY (`id`),
KEY `fkIdx_354` (`id_local`),
CONSTRAINT `FK_354` FOREIGN KEY `fkIdx_354` (`id_local`) REFERENCES `Local` (`id`)
);






-- ************************************** `Animal_File`

CREATE TABLE `Animal_File`
(
 `id`         integer NOT NULL ,
 `id_Animal`  integer NOT NULL ,
 `id_Breed`   integer NOT NULL ,
 `genero`     char NOT NULL ,
 `tamanho`    float ,
 `idade`      integer ,
 `castrado`   varchar(45) NOT NULL ,
 `chip`       tinyint NOT NULL ,
 `created_at` integer NOT NULL ,
 `updated_at` integer ,
PRIMARY KEY (`id`),
KEY `fkIdx_291` (`id_Breed`),
CONSTRAINT `FK_291` FOREIGN KEY `fkIdx_291` (`id_Breed`) REFERENCES `Breed` (`id`),
KEY `fkIdx_297` (`id_Animal`),
CONSTRAINT `FK_297` FOREIGN KEY `fkIdx_297` (`id_Animal`) REFERENCES `Animal` (`id`)
);






-- ************************************** `Treatment`

CREATE TABLE `Treatment`
(
 `id`              integer NOT NULL ,
 `id_ficha_medica` integer NOT NULL ,
 `duration`        int NOT NULL ,
 `description`     varchar(45) NOT NULL ,
 `created_at`      datetime NOT NULL ,
 `updated_at`      datetime NOT NULL ,
 `state`           varchar(45) NOT NULL ,
PRIMARY KEY (`id`),
KEY `fkIdx_223` (`id_ficha_medica`),
CONSTRAINT `FK_223` FOREIGN KEY `fkIdx_223` (`id_ficha_medica`) REFERENCES `Animal_File` (`id`)
);






-- ************************************** `Profile_Kennel`

CREATE TABLE `Profile_Kennel`
(
 `id`      integer NOT NULL ,
 `id_user` integer NOT NULL ,
 `name`    varchar(45) NOT NULL ,
 `nif`     double NOT NULL ,
 `address` varchar(45) NOT NULL ,
PRIMARY KEY (`id`),
KEY `fkIdx_372` (`id_user`),
CONSTRAINT `FK_372` FOREIGN KEY `fkIdx_372` (`id_user`) REFERENCES `User` (`id`)
);






-- ************************************** `Profile_Adopter`

CREATE TABLE `Profile_Adopter`
(
 `id`        integer NOT NULL ,
 `id_user`   integer NOT NULL ,
 `Name`      varchar(45) NOT NULL ,
 `Cellphone` double NOT NULL ,
PRIMARY KEY (`id`),
KEY `fkIdx_46` (`id_user`),
CONSTRAINT `FK_46` FOREIGN KEY `fkIdx_46` (`id_user`) REFERENCES `User` (`id`)
);






-- ************************************** `Vaccine`

CREATE TABLE `Vaccine`
(
 `id`            integer NOT NULL ,
 `id_tratamento` integer NOT NULL ,
 `vaccine`       varchar(45) NOT NULL ,
 `date`          datetime NOT NULL ,
PRIMARY KEY (`id`),
KEY `fkIdx_191` (`id_tratamento`),
CONSTRAINT `FK_191` FOREIGN KEY `fkIdx_191` (`id_tratamento`) REFERENCES `Treatment` (`id`)
);






-- ************************************** `Social`

CREATE TABLE `Social`
(
 `id`        integer NOT NULL ,
 `id_kennel` integer NOT NULL ,
 `link`      varchar(45) NOT NULL ,
PRIMARY KEY (`id`),
KEY `fkIdx_337` (`id_kennel`),
CONSTRAINT `FK_337` FOREIGN KEY `fkIdx_337` (`id_kennel`) REFERENCES `Profile_Kennel` (`id`)
);






-- ************************************** `Schedule`

CREATE TABLE `Schedule`
(
 `id`         integer NOT NULL ,
 `id_kennel`  integer NOT NULL ,
 `day`        integer NOT NULL ,
 `open_time`  time ,
 `close_time` time ,
PRIMARY KEY (`id`),
KEY `fkIdx_346` (`id_kennel`),
CONSTRAINT `FK_346` FOREIGN KEY `fkIdx_346` (`id_kennel`) REFERENCES `Profile_Kennel` (`id`)
);






-- ************************************** `Kennel_Animal`

CREATE TABLE `Kennel_Animal`
(
 `id`         integer NOT NULL ,
 `id_Animal`  integer NOT NULL ,
 `id_kennel`  integer NOT NULL ,
 `created_at` datetime NOT NULL ,
 `updated_at` datetime NOT NULL ,
 `state`      varchar(45) NOT NULL ,
PRIMARY KEY (`id`),
KEY `fkIdx_147` (`id_Animal`),
CONSTRAINT `FK_147` FOREIGN KEY `fkIdx_147` (`id_Animal`) REFERENCES `Animal` (`id`),
KEY `fkIdx_369` (`id_kennel`),
CONSTRAINT `FK_369` FOREIGN KEY `fkIdx_369` (`id_kennel`) REFERENCES `Profile_Kennel` (`id`)
);






-- ************************************** `Contact`

CREATE TABLE `Contact`
(
 `id`        integer NOT NULL ,
 `Id_Kennel` integer NOT NULL ,
 `Phone`     double ,
 `Cellphone` double ,
 `Fax`       double ,
PRIMARY KEY (`id`),
KEY `fkIdx_363` (`Id_Kennel`),
CONSTRAINT `FK_363` FOREIGN KEY `fkIdx_363` (`Id_Kennel`) REFERENCES `Profile_Kennel` (`id`)
);






-- ************************************** `Adoption`

CREATE TABLE `Adoption`
(
 `id`          int NOT NULL ,
 `id_Adopter`  integer NOT NULL ,
 `id_Animal`   integer NOT NULL ,
 `created_at`  datetime NOT NULL ,
 `updated_at`  datetime NOT NULL ,
 `description` varchar(45) ,
 `state`       integer NOT NULL ,
PRIMARY KEY (`id`),
KEY `fkIdx_162` (`id_Adopter`),
CONSTRAINT `FK_162` FOREIGN KEY `fkIdx_162` (`id_Adopter`) REFERENCES `Profile_Adopter` (`id`),
KEY `fkIdx_303` (`id_Animal`),
CONSTRAINT `FK_303` FOREIGN KEY `fkIdx_303` (`id_Animal`) REFERENCES `Kennel_Animal` (`id`)
);





