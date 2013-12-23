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
  `active` INT(1) NULL DEFAULT 1, --Ativo
  `role` VARCHAR(25) NULL DEFAULT 'usuario',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- Tabela Tags
CREATE TABLE IF NOT EXISTS `tags` (
	id INT NOT NULL AUTO_INCREMENT,
	titulo VARCHAR(1024) NOT NULL,
	PRIMARY KEY(id)
);

INSERT INTO tags (titulo) VALUE ('Atraso na entrega');
INSERT INTO tags (titulo) VALUE ('Especificações erradas');
INSERT INTO tags (titulo) VALUE ('Assistencia tecnica');
INSERT INTO tags (titulo) VALUE ('Mal atendimento');
INSERT INTO tags (titulo) VALUE ('Má qualidade');
INSERT INTO tags (titulo) VALUE ('Mal funcionamento');
INSERT INTO tags (titulo) VALUE ('Empresa não responde aos chamados');

-- Tabela Denuncias
CREATE TABLE IF NOT EXISTS `denuncias` (
	id 		INT NOT NULL AUTO_INCREMENT,
	user_id	INT NOT NULL,
	descricao TEXT NULL, 
	link 	VARCHAR(2048) NULL,
	empresa VARCHAR(1024) NULL,

	FOREIGN KEY (user_id) REFERENCES users(id),
	PRIMARY KEY (id)
);

-- Tabela Tags_denuncias
CREATE TABLE IF NOT EXISTS `denuncias_tags` (
	id INT NOT NULL AUTO_INCREMENT,
	denuncia_id INT NOT NULL,
	tag_id 		INT NOT NULL,
	FOREIGN KEY (denuncia_id) REFERENCES denuncias(id),
	FOREIGN KEY (tag_id) REFERENCES tags(id),
	PRIMARY KEY(id)
);