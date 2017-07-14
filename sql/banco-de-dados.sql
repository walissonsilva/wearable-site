DROP DATABASE wearable;

CREATE DATABASE wearable;

USE wearable;

DROP TABLE IF EXISTS Paciente;

CREATE TABLE Paciente (
  idusuario integer NOT NULL auto_increment,
  cpf varchar(13) NOT NULL,
  altura decimal(3,2) NOT NULL,
  peso decimal(5,2) NOT NULL,
  nome varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  senha varchar(100) NOT NULL,
  sexo varchar(1) NOT NULL,
  datanasc date NOT NULL,
  PRIMARY KEY (idUsuario)
);

DROP TABLE IF EXISTS Medico;

CREATE TABLE Medico (
  idusuario integer NOT NULL auto_increment,
  crm varchar(13) NOT NULL,
  nome varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  senha varchar(100) NOT NULL,
  PRIMARY KEY (idusuario)
);

INSERT INTO Paciente (cpf, altura, peso, nome, email, senha, sexo, dataNasc)
VALUES ('00000000000', 1.75, 67, 'Walisson Silva', 'walissonsilva10@gmail.com', '123', 'M', '17/08/1995');
