DROP DATABASE IF EXISTS borseMarcoFederico; 
CREATE DATABASE borseMarcoFederico; 
USE borseMarcoFederico; 

CREATE TABLE Borse (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    CodiceBorsa VARCHAR(50) NOT NULL UNIQUE,
    Descrizione TEXT,
    Prezzo DECIMAL(10,2) NOT NULL
);