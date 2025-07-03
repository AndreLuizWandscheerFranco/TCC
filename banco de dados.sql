create database Banco_de_dados;

use Banco_de_dados;

create table usuarios(
id_usuario int AUTO_INCREMENT primary key,
Nome varchar(104),
cpf varchar(11),
telefone int(13),
pais varchar(56),
cep varchar(9),
rua varchar(52),
numero varchar(5),
cidade varchar(37),
estado varchar(17),
email varchar(254),
senha varchar(100),
tipo varchar(13)
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
