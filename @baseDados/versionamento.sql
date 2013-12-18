/* 
	 - versionamento.sql 
	 @OBS: Arquivo de gerenciamento de banco de dados (criação e versionamento.)
	 @Author: Leandro de Souza Araujo
*/

-- Criação da database 'deninciew3project';
CREATE DATABASE IF NOT EXISTS denunciew3project;

USE denunciew3project;

-- Tabela Users (convenção)
CREATE TABLE IF NOT EXISTS  `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) UNIQUE NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `active` INT(1) NULL DEFAULT 0,
  `role` VARCHAR(25) NULL DEFAULT 'usuario',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;