	CREATE DATABASE crud;
    use  crud;
   
    
    

CREATE TABLE Cliente
(
	Id INT PRIMARY KEY AUTO_INCREMENT,
	Nome VARCHAR(60) NOT NULL,
    Telefone VARCHAR(30) NOT NULL,
	Email VARCHAR(150) NOT NULL
   );
   
CREATE TABLE Endereco
(
	Id INT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(60) NOT NULL,
	Logradouro VARCHAR(250) NOT NULL,
    Numero int NOT NULL,
	CEP decimal(8) NOT NULL,
    Bairro VARCHAR(150) NOT NULL,
    Cidade VARCHAR(150) NOT NULL,
    Uf CHAR(2) NOT NULL,
    Cliente_Id INT NULL,
    FOREIGN KEY (Cliente_Id) REFERENCES Cliente(Id)
   );
 
   
   
