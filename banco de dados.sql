create database Banco_de_dados;

use Banco_de_dados;

create table usuarios(
id_usuarios int AUTO_INCREMENT primary key,
Nome varchar(104),
Nome_de_usuario varchar(104),
cpf varchar(14),
telefone varchar(13),
cep varchar(9),
rua varchar(52),
bairro varchar(100),
complemento varchar(100),
numero varchar(5),
cidade varchar(37),
estado varchar(17),
email varchar(254),
senha varchar(100),
tipo varchar(13) default 'cliente'
);

create table pagamento(
id_pagamento int auto_increment primary key,
valor double not null,
date Date not null,
id_usuarios int,
foreign key(id_usuarios)
	references usuarios(id_usuarios)
);

CREATE TABLE produto (
    nome VARCHAR(100) NOT NULL,
    valor DOUBLE NOT NULL,
    fabricante VARCHAR(100) NOT NULL,
    descricao VARCHAR(100) NOT NULL,
    avaliacao DOUBLE(5,0),
    imagem LONGBLOB,
    id_pagamento INT,
    FOREIGN KEY (id_pagamento) REFERENCES pagamento(id_pagamento)
);

