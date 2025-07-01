create database Banco_de_dados;

use Banco_de_dados;

create table usuario(
id_usuario int AUTO_INCREMENT primary key,
Nome varchar(104) not null,
cpf varchar(11) not null,
telefone int(13) not null,
pais varchar(56) not null,
cep varchar(9) not null,
rua varchar(52) not null,
numero varchar(5) not null,
cidade varchar(37) not null,
estado varchar(17) not null,
email varchar(254) not null,
senha varchar(100) not null,
tipo varchar(13) not null
);

create table pagamento(
id_pagamento int auto_increment primary key,
valor double not null,
date Date not null,
id_usuario int,
foreign key(id_usuario)
	references usuario(id_usuario)
);

create table produto(
nome varchar(100) not null,
valor double not null,
fabricante varchar(100) not null,
descricao varchar(100) not null,
avaliaçao double(5,0),
id_pagamento int,
	foreign key (id_pagamento)
		references pagamento(id_pagamento)
);
