CREATE DATABASE pets_castro;

-- Expressão SQL para informar à IDE que este é o banco que estará em uso.
USE pets_castro;

-- Expressão SQL para criar a tabela de usuários
CREATE TABLE funcionario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    funcionario VARCHAR(50) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- Expressão SQL para criar a tabela de formecedores
CREATE TABLE cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telefone VARCHAR(20)
);

-- Expressão SQL para criar a tabela de produtos relacionada via FK com a tabela de fornecedores
CREATE TABLE animal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT,
    animal VARCHAR(100) NOT NULL,
    descricao TEXT,
    tipo TEXT,
    preco TEXT,
    FOREIGN KEY (cliente_id) REFERENCES cliente(id)
);

create unique index IDX_animal
on animal(animal);

CREATE TABLE Veterinario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    consultorio VARCHAR(100),
    telefone VARCHAR(20)
);

CREATE unique index IDX_Veterinario
    on Veterinario(nome);

CREATE TABLE consulta (
 id INT AUTO_INCREMENT PRIMARY KEY,
 veterinario_id INT,
 animal_id INT,
 consultorio  TEXT,
 data_de_entrada TEXT,
 pre_consulta TEXT
 );
 alter table consulta add
    constraint FK_animal_consulta FOREIGN KEY(animal_id)
    REFERENCES animal(id);
    
alter table consulta add
    constraint FK_Veterinario_consulta FOREIGN KEY(veterinario_id)
    REFERENCES Veterinario(id);
    
-- Expressão SQL para cadastrar um usuário
INSERT INTO funcionario (funcionario, senha) VALUES ('admin', ('admin123'));