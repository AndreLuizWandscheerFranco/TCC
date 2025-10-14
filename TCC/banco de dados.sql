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
	id int auto_increment primary key,
    nome VARCHAR(100) NOT NULL,
    valor DOUBLE NOT NULL,
    fabricante VARCHAR(100) NOT NULL,
    descricao VARCHAR(100) NOT NULL,
    avaliacao DOUBLE(5,0),
    imagem varchar(255),
    id_pagamento INT,
    FOREIGN KEY (id_pagamento) REFERENCES pagamento(id_pagamento)
);

insert into produto (nome,valor,fabricante,descricao,avaliacao,imagem) values ('celular', '3000', 'sansung', 'celular sansung 256gb', '4', '../imagens_produtos/68d6db9f1f7b0.webp');

insert into produto (nome, valor, fabricante, descricao, avaliacao, imagem) values ('Mouse', '361', 'Redragon', 'Redragon Mouse para jogos M913 Impact Elite', '5', '../imagens_produtos/68d6dbe6d26e3.jpg');

insert into produto (nome, valor, fabricante, descricao, avaliacao, imagem) values ('Teclado', '188', 'Redragon', 'Teclado Mecânico Redragon', '4', '../imagens_produtos/68d6dc1bb05a8.jpg');

insert into produto (nome, valor, fabricante, descricao, avaliacao, imagem) values ('Monitor', '459.99', 'Pichau', 'Monitor Gamer Pichau', '3', '../imagens_produtos/68d6de93258e7.jpg');

insert into produto (nome, valor, fabricante, descricao, avaliacao, imagem) values ('Placa de vídeo', '4399.99', 'Galax', 'Placa de Video GALAX GeForce RTX 5070', '4', '../imagens_produtos/68d6df0984f48.jpg');

insert into produto (nome, valor, fabricante, descricao, avaliacao, imagem) values ('Memória', '848', 'Fury', 'KF432C16BB/32 - Memória de 32GB', '5', '../imagens_produtos/68d6df5c61664.jpg');


