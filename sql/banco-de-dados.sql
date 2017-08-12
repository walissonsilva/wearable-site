DROP DATABASE wearable;

CREATE DATABASE wearable;

USE wearable;

DROP TABLE IF EXISTS Paciente;

CREATE TABLE Paciente (
  idusuario integer NOT NULL auto_increment,
  cpf varchar(13) NOT NULL,
  altura varchar(1000) NOT NULL,
  peso varchar(1000) NOT NULL,
  nome varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  senha varchar(100) NOT NULL,
  sexo varchar(1) NOT NULL,
  datanasc date NOT NULL,
  PRIMARY KEY (idusuario)
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

DROP TABLE IF EXISTS Data;

CREATE TABLE Data (
  id_data integer NOT NULL auto_increment,
  id_paciente integer NOT NULL,
  created_at varchar(20) NOT NULL,
  freq integer NOT NULL,
  PRIMARY KEY (id_data)
);

DROP TABLE IF EXISTS Json;

CREATE TABLE Json (
  id_json integer NOT NULL auto_increment,
  id_paciente integer NOT NULL,
  freq varchar(200) NOT NULL,
  temp varchar(200) NOT NULL,
  passos varchar(200) NOT NULL,
  PRIMARY KEY (id_json)
);

INSERT INTO Paciente (cpf, altura, peso, nome, email, senha, sexo, datanasc)
VALUES ('00000000000', 'D00A175', 'D00P67', 'Walisson Silva', 'walissonsilva10@gmail.com', '123', 'M', STR_TO_DATE( "17/08/1995", "%d/%m/%Y" ));
INSERT INTO Paciente (cpf, altura, peso, nome, email, senha, sexo, datanasc)
VALUES ('00000000001', 'D00A175', 'D00P67', 'ROOT', 'paciente@gmail.com', '123', 'M', STR_TO_DATE( "17/08/1995", "%d/%m/%Y" ));
INSERT INTO Medico (crm, nome, email, senha)
VALUES ('00000000002', 'ROOT', 'medico@gmail.com', '123');
INSERT INTO Json (id_paciente, freq, temp, passos)
VALUES ('1', 'https://api.thingspeak.com/channels/306028/fields/1.json?api_key=DTWASHAB2FDWY6HC&results=8', 'https://api.thingspeak.com/channels/306028/fields/2.json?api_key=DTWASHAB2FDWY6HC&results=8', 'https://api.thingspeak.com/channels/306028/fields/3.json?api_key=DTWASHAB2FDWY6HC&results=8');