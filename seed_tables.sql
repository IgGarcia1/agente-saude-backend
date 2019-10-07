create table if not EXISTS tbl_escolaridade(
	cod_escolaridade int not null auto_increment primary key,
	nom_escolaridade varchar(255) not null
);

create table if not EXISTS tbl_usuario(
	num_sus bigint not null primary key, 
	col_nome varchar(255) not null,
	col_genero char(1) not null,
	col_obito boolean default False,
	col_email varchar(255) not null,
	col_senha varchar(20) not null,
	cod_escolaridade int not null,

	foreign key (cod_escolaridade) references tbl_escolaridade(cod_escolaridade)
);


create table if not EXISTS tbl_cargo_profissional(
	cod_cargo varchar(5) not null primary key,
	nom_cargo varchar(255) not null
);

create table if not EXISTS tbl_profissional(
	cod_profissional bigint not null primary key,
	num_sus bigint not null,
	cod_cargo varchar(5) not null,
	col_email varchar(255) not null,
	col_senha varchar(20) not null,

	foreign key (num_sus) references tbl_usuario(num_sus),
	foreign key (cod_cargo) references tbl_cargo_profissional(cod_cargo)
);


create table if not EXISTS tbl_plano_saude(
	cod_plano_saude int not null auto_increment primary key,
	nom_plano varchar(255) not null
);


create table if not EXISTS tbl_rel_plano_saude_usuario(
	num_sus bigint not null,
	cod_plano_saude int not null,

	foreign key (num_sus) references tbl_usuario(num_sus),
	foreign key (cod_plano_saude) references tbl_plano_saude(cod_plano_saude),
	primary key (num_sus, cod_plano_saude)
);


/* ---- Moradia ---- */

create table if not EXISTS tbl_moradia(
	col_cep int not null,
	col_numero int not null,
	col_abastecimento_agua boolean default False,
	col_sistema_esgoto boolean default False,
	col_coleta_lixo boolean default False, 
	col_tem_animais boolean default False,
	col_rua_moradia varchar(100) not null,

	cod_moradia bigint not null auto_increment,

	primary key (cod_moradia)
	/*primary key (col_cep, col_rua_moradia, col_numero) */
);

create table if not EXISTS tbl_rel_usuario_moradia(
	num_sus bigint not null, 
	cod_moradia bigint not null,

	foreign key (num_sus) references tbl_usuario(num_sus),
	foreign key (cod_moradia) references tbl_moradia(cod_moradia),
	/*foreign key (cod_moradia) references tbl_moradia(col_cep, col_rua_moradia, col_numero),*/

	primary key (num_sus, cod_moradia)
);

/* -- Animais -- */

create table if not EXISTS tbl_categoria_animal(
	cod_categoria_animal bigint auto_increment not null primary key,
	nom_categoria varchar(255) not null
);

create table if not EXISTS tbl_animal(
	cod_animal bigint not null auto_increment primary key, 
	col_genero char(1) not null,
	num_sus_responsavel bigint not null,
	cod_categoria_animal bigint not null,
	cod_moradia bigint default null,

	foreign key (num_sus_responsavel) references tbl_usuario(num_sus),
	foreign key (cod_categoria_animal) references tbl_categoria_animal(cod_categoria_animal),
	foreign key (cod_moradia) references tbl_moradia(cod_moradia)
	/*foreign key (cod_moradia) references tbl_moradia(col_cep, col_rua_moradia, col_numero)*/
);

/* ------ SAUDE ------ */ 
create table if not EXISTS tbl_deficiencia(
	cod_deficiencia int not null auto_increment primary key,
	nom_deficiencia varchar(255) not null
);

create table if not EXISTS tbl_droga_ilicita(
	cod_droga int not null primary key,
	nom_droga varchar(255) not null
);

create table if not EXISTS tbl_doenca(
	cod_cid varchar(5) not null primary key,
	nom_doenca varchar(255) not null,
	col_descricao_doenca varchar(255) not null
);

create table if not EXISTS tbl_area_afetada_doenca(
	cod_area int not null primary key,
	nom_area varchar(255) not null
);

create table if not EXISTS tbl_rel_area_afetada_doenca(
	cod_area int not null,
	cod_cid varchar(5) not null,

	foreign key (cod_cid) references tbl_doenca(cod_cid),
	foreign key (cod_area) references tbl_area_afetada_doenca(cod_area),
	primary key (cod_area, cod_cid)
);

create table if not EXISTS tbl_saude_cidadao(
	num_sus bigint not null,
	col_peso float not null,
	col_e_fumante boolean not null,
	col_usa_alcool boolean not null,
	col_qtd_avc int not null,

	foreign key (num_sus) references tbl_usuario(num_sus),
	primary key (num_sus)	
);

create table if not EXISTS tbl_rel_saude_cidadao_doenca(
	cod_saude bigint not null,
	cod_doenca varchar(5) not null,

	foreign key (cod_saude) references tbl_saude_cidadao(num_sus),
	foreign key (cod_doenca) references tbl_doenca(cod_cid),
	primary key (cod_saude, cod_doenca)
);


create table if not EXISTS tbl_rel_droga_ilicita_usuario(
	cod_saude bigint not null,
	cod_droga int not null,

	foreign key (cod_saude) references tbl_saude_cidadao(num_sus),
	foreign key (cod_droga) references tbl_droga_ilicita(cod_droga),

	primary key (cod_saude, cod_droga)
);

create table if not EXISTS tbl_rel_deficiencia_usuario(
	num_sus bigint not null,
	cod_deficiencia int not null,
	foreign key (num_sus) references tbl_saude_cidadao(num_sus),
	foreign key (cod_deficiencia) references tbl_deficiencia(cod_deficiencia),

	primary key (num_sus, cod_deficiencia)
);


/* ----- OCORRENCIAS ----- */

create table if not EXISTS tbl_categoria_ocorrencia(
	cod_categoria int not null primary key,
	nom_categoria varchar(150) not null
);


create table if not exists tbl_intensidade_ocorrencia(
	cod_intensidade int not null primary key,
	nom_intensidade varchar(70) not null
);

create table if not EXISTS tbl_ocorrencia(
	cod_intensidade int not null,
	col_descricao_ocorrencia varchar(255),
	cod_localidade bigint not null,
	cod_categoria_ocorrencia int not null,

	foreign key (cod_intensidade) references tbl_intensidade_ocorrencia(cod_intensidade),
	foreign key (cod_categoria_ocorrencia) references tbl_categoria_ocorrencia(cod_categoria),
	foreign key (cod_localidade) references tbl_moradia(cod_moradia),
	primary key (cod_categoria_ocorrencia, cod_localidade)
);


create table if not EXISTS tbl_notificacao(
	cod_notificacao bigint not null primary key,
	col_mensagem text not null
);

create table if not EXISTS tbl_rel_categoria_ocorrencia_notificacao(
	cod_area int not null,
	cod_notificacao bigint not null,

	FOREIGN key (cod_area) references tbl_categoria_ocorrencia(cod_categoria),
	foreign key (cod_notificacao) references tbl_notificacao(cod_notificacao),
	primary key (cod_area, cod_notificacao)
);


/* ------------------ INSERCOES ---------------*/

/* tbl_escolaridade */
insert into tbl_escolaridade (cod_escolaridade, nom_escolaridade) value (1, 'Ensino Fundamental');
insert into tbl_escolaridade (cod_escolaridade, nom_escolaridade) value (2, 'Ensino Médio');
insert into tbl_escolaridade (cod_escolaridade, nom_escolaridade) value (3, 'Graduação');
insert into tbl_escolaridade (cod_escolaridade, nom_escolaridade) value (4, 'Licenciatura');
insert into tbl_escolaridade (cod_escolaridade, nom_escolaridade) value (5, 'Bacharelado');
insert into tbl_escolaridade (cod_escolaridade, nom_escolaridade) value (6, 'Pós-graduação');
insert into tbl_escolaridade (cod_escolaridade, nom_escolaridade) value (7, 'Mestrado');
insert into tbl_escolaridade (cod_escolaridade, nom_escolaridade) value (8, 'Doutorado');

/* tbl_categoria_animal */

insert into tbl_categoria_animal (cod_categoria_animal, nom_categoria) values (1, 'Canino');
insert into tbl_categoria_animal (cod_categoria_animal, nom_categoria) values (2, 'Felino');
insert into tbl_categoria_animal (cod_categoria_animal, nom_categoria) values (3, 'Ave');
insert into tbl_categoria_animal (cod_categoria_animal, nom_categoria) values (4, 'Reptil');
insert into tbl_categoria_animal (cod_categoria_animal, nom_categoria) values (5, 'Equino');
insert into tbl_categoria_animal (cod_categoria_animal, nom_categoria) values (6, 'Bovino');
insert into tbl_categoria_animal (cod_categoria_animal, nom_categoria) values (7, 'Primata');
insert into tbl_categoria_animal (cod_categoria_animal, nom_categoria) values (8, 'Peixe');
insert into tbl_categoria_animal (cod_categoria_animal, nom_categoria) values (9, 'Caprino');
insert into tbl_categoria_animal (cod_categoria_animal, nom_categoria) values (10, 'Ovinos');

/* tbl_plano_saude */

insert into tbl_plano_saude (nom_plano) values ("SUS");
insert into tbl_plano_saude (nom_plano) values ("Unimed");
insert into tbl_plano_saude (nom_plano) values ("Hapvida");
insert into tbl_plano_saude (nom_plano) values ("Amil");
insert into tbl_plano_saude (nom_plano) values ("Sul América");
insert into tbl_plano_saude (nom_plano) values ("Bradesco");
insert into tbl_plano_saude (nom_plano) values ("One Health");
insert into tbl_plano_saude (nom_plano) values ("Intermédica");
insert into tbl_plano_saude (nom_plano) values ("Caixa");
insert into tbl_plano_saude (nom_plano) values ("Omint");
insert into tbl_plano_saude (nom_plano) values ("Sompo");
insert into tbl_plano_saude (nom_plano) values ("Next saúde");

/* tbl_intensidade_ocorrencia */

insert into tbl_intensidade_ocorrencia (cod_intensidade, nom_intensidade) values (1, "Fraco");
insert into tbl_intensidade_ocorrencia (cod_intensidade, nom_intensidade) values (2, "Baixo");	
insert into tbl_intensidade_ocorrencia (cod_intensidade, nom_intensidade) values (3, "Normal");
insert into tbl_intensidade_ocorrencia (cod_intensidade, nom_intensidade) values (4, "Acima da média");
insert into tbl_intensidade_ocorrencia (cod_intensidade, nom_intensidade) values (5, "Alto");
insert into tbl_intensidade_ocorrencia (cod_intensidade, nom_intensidade) values (6, "Extremo");

/* tbl_doencas */

/* tbl_area_afetada_doenca */
