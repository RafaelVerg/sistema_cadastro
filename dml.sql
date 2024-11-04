-- DDL pet castro --

use pets_castro;

select *
from funcionario;

insert into funcionario(funcionario, senha)
values ('gerente', MD5('admin123'));

insert into funcionario(funcionario, senha)
values ('atentende', MD5('varoamendes'));

insert into funcionario(funcionario, senha)
values ('Veterinário', MD5('maumau'));


select *
from cliente
order by id;

insert into cliente (nome, email, telefone)
values ('bruno', 'pin@gmail.com', '1189028922');

insert into cliente (nome, email, telefone)
values ('rafael', 'virgilio@gmail.com', '1176880644');

insert into cliente (nome, email, telefone)
values ('geovani', 'rodrigues@gmail.com', '1156748233');

select *
from animal;

insert into animal( cliente_id, nome, descricao, tipo, preco)
values ('3', 'amora', 'animal tem alergias', 'pinsher', '50');

insert into animal( cliente_id, nome, descricao, tipo, preco)
values ('2', 'kiara', 'banho', 'lhasa', '100');