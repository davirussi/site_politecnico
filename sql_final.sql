SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `informatica_poli` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `informatica_poli` ;

-- -----------------------------------------------------
-- Table `informatica_poli`.`usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `informatica_poli`.`usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT ,
  `login` VARCHAR(45) NOT NULL ,
  `senha` VARCHAR(45) NOT NULL ,
  `nivel` INT NOT NULL ,
  PRIMARY KEY (`id_usuario`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `informatica_poli`.`conteudo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `informatica_poli`.`conteudo` (
  `id_conteudo` INT NOT NULL AUTO_INCREMENT ,
  `id_usuario` INT NOT NULL ,
  `tipo` ENUM('link', 'conteudo') NOT NULL ,
  `titulo` VARCHAR(300) NOT NULL ,
  `conteudo` TEXT NOT NULL ,
  `url` TEXT NULL ,
  `data` TIMESTAMP NOT NULL DEFAULT now() ,
  PRIMARY KEY (`id_conteudo`) ,
  INDEX `fk_conteudo_usuario1` (`id_usuario` ASC) ,
  CONSTRAINT `fk_conteudo_usuario1`
    FOREIGN KEY (`id_usuario` )
    REFERENCES `informatica_poli`.`usuario` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `informatica_poli`.`menu`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `informatica_poli`.`menu` (
  `id_menu` INT NOT NULL AUTO_INCREMENT ,
  `id_menu_pai` INT NULL ,
  `titulo` VARCHAR(45) NOT NULL ,
  `ordem` INT NOT NULL ,
  `id_conteudo` INT NOT NULL ,
  PRIMARY KEY (`id_menu`) ,
  INDEX `fk_menu_conteudo1` (`id_conteudo` ASC) ,
  CONSTRAINT `fk_menu_conteudo1`
    FOREIGN KEY (`id_conteudo` )
    REFERENCES `informatica_poli`.`conteudo` (`id_conteudo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `informatica_poli`.`noticia`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `informatica_poli`.`noticia` (
  `id_noticia` INT NOT NULL AUTO_INCREMENT ,
  `id_menu` INT NOT NULL ,
  `id_usuario` INT NOT NULL ,
  `titulo` VARCHAR(45) NOT NULL ,
  `resumo` TEXT NOT NULL ,
  `conteudo` TEXT NOT NULL ,
  `data` TIMESTAMP NOT NULL DEFAULT now() ,
  PRIMARY KEY (`id_noticia`) ,
  INDEX `fk_noticia_menu` (`id_menu` ASC) ,
  INDEX `fk_noticia_usuario1` (`id_usuario` ASC) ,
  CONSTRAINT `fk_noticia_menu`
    FOREIGN KEY (`id_menu` )
    REFERENCES `informatica_poli`.`menu` (`id_menu` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_noticia_usuario1`
    FOREIGN KEY (`id_usuario` )
    REFERENCES `informatica_poli`.`usuario` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `informatica_poli`.`event`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `informatica_poli`.`event` (
  `id` INT(4) NOT NULL AUTO_INCREMENT ,
  `body` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `timestamp` INT(10) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
AUTO_INCREMENT = 26
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `informatica_poli`.`ru`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `informatica_poli`.`ru` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `data` VARCHAR(15) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `conteudo` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 332
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `informatica_poli`.`settings`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `informatica_poli`.`settings` (
  `id` INT(1) NOT NULL AUTO_INCREMENT ,
  `dayColor` VARCHAR(6) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `weekendColor` VARCHAR(6) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `todayColor` VARCHAR(6) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `eventColor` VARCHAR(6) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `iteratorColor1` VARCHAR(6) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `iteratorColor2` VARCHAR(6) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `informatica_poli`.`rss`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `informatica_poli`.`rss` (
  `id_rss` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(45) NOT NULL ,
  `url` TEXT NOT NULL ,
  `nro_itens` INT NOT NULL ,
  `mostrar` TINYINT(1)  NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`id_rss`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `informatica_poli`.`arquivo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `informatica_poli`.`arquivo` (
  `id_arquivo` INT NOT NULL AUTO_INCREMENT ,
  `nome` TEXT NOT NULL ,
  `data` TIMESTAMP NOT NULL DEFAULT now() ,
  PRIMARY KEY (`id_arquivo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `informatica_poli`.`foto`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `informatica_poli`.`foto` (
  `id_foto` INT NOT NULL AUTO_INCREMENT ,
  `nome` TEXT NOT NULL ,
  `data` TIMESTAMP NOT NULL DEFAULT now() ,
  PRIMARY KEY (`id_foto`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



INSERT INTO `settings` (`id`, `dayColor`, `weekendColor`, `todayColor`, `eventColor`, `iteratorColor1`, `iteratorColor2`) VALUES
(1, 'e6e1d3', 'a0a395', 'ffeb45', 'ADFF2F', 'ADFF2F', 'ADFF2F');


INSERT INTO `usuario` (`id_usuario`, `login`, `senha`, `nivel`) VALUES
(1, 'administrador', '91f5167c34c400758115c2a6826ec2e3', 1);
