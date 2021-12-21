CREATE DATABASE musica;
use musica;
CREATE TABLE user(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) CHECK(nome!=""),
    senha VARCHAR(100) CHECK(senha!=""),
    bi   VARCHAR(13) NOT NULL,
    celular  VARCHAR(12),
    workspace   VARCHAR(50),
    endereco VARCHAR(100),
    genero  VARCHAR(10),
    data_nascimento  VARCHAR(12)
);


CREATE TABLE projecto (
    id  INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tipo   VARCHAR(15),
    duracao  VARCHAR(10),
    artista   VARCHAR(50),
    ano_lancamento  VARCHAR(50),
    titulo  VARCHAR(50),
    preco  DECIMAL,
    num_faixa  INT,
    ficheiro  VARCHAR(200),
    capa  VARCHAR(200)
);