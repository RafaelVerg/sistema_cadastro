-- DDL pet castro --
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

insert into animal(cliente_id, animal, descricao, tipo, preco, Idade)
values ('3', 'amora', 'animal tem alergias', 'pinsher', '50', '5');

insert into animal(cliente_id, animal, descricao, tipo, preco, Idade)
values ('2', 'kiara', 'banho', 'lhasa', '100', '10');

select *
from Veterinario;

insert into Veterinario (nome, consultorio, telefone)
values ('Adriano','03','1192313421');

insert into Veterinario (nome, consultorio, telefone)
values ('Mariana','05','1192313421');

insert into Veterinario (nome, consultorio, telefone)
values ('Lucas','06','1192313421');

select *
from consulta;

insert into consulta (veterinario_id, animal_id, consultorio, data_de_entrada,  problema_do_pet)
values (1, 2, '04','5/2/25','vacina');

insert into consulta (veterinario_id, animal_id, consultorio, data_de_entrada,  problema_do_pet)
values (2, 2, '03','2/12/24','castração');

