

/*Criando tabelas*/

create table tbl_escolaridade(
	cod_escolaridade int not null auto_increment primary key,
	nom_escolaridade varchar(255) not null
);

create table tbl_usuario(
	num_sus bigint not null primary key, 
	col_nome varchar(255) not null,
	col_genero char(1) not null,
	col_obito boolean default False,
	col_email varchar(255) not null,
	col_senha varchar(20) not null,
	cod_escolaridade int not null,

	foreing key (cod_escolaridade) references tbl_escolaridade(cod_escolaridade)
);


create table tbl_cargo_profissional(
	cod_cargo varchar(5) not null primary key,
	nom_cargo varchar(255) not null
);

create table tbl_profissional(
	cod_profissional bigint not null primary key,
	num_sus bigint not null,
	cod_cargo varchar(5) not null,
	col_email varchar(255) not null,
	col_senha varchar(20) not null,

	foreing key (num_sus) references tbl_profissional(num_sus),
	foreing key (cod_cargo) references tbl_cargo_profissional(cod_cargo)
);


create table tbl_plano_saude(
	cod_plano_saude int not null auto_increment primary key,
	nom_plano varchar(255) not null
);


create table tbl_rel_plano_saude_usuario(
	num_sus bigint not null,
	cod_plano_saude int not null,

	foreing key (num_sus) references tbl_usuario(num_sus),
	foreing key (cod_plano_saude) references tbl_plano_saude(cod_plano_saude),
	primary key (num_sus, cod_plano_saude)
);


/* ---- Moradia ---- */

create table tbl_moradia(
	col_cep int not null,
	col_numero int not null,
	col_abastecimento_agua boolean default False,
	col_sistema_esgoto boolean default False,
	col_coleta_lixo boolean default False, 
	col_tem_animais boolean default False,
	col_rua_moradia varchar(100) not null,

	primary key (col_cep, col_rua_moradia, col_numero) 
);

create table tbl_rel_usuario_moradia(
	num_sus bigint not null, 
	cod_moradia (int, varchar, int) not null,

	foreing key (num_sus) references tbl_usuario(num_sus),
	foreing key (cod_moradia) references tbl_moradia(col_cep, col_rua_moradia, col_numero)

	primary key (num_sus, cod_moradia)
);

/* -- Animais -- */

create table tbl_categoria_animal(
	cod_categoria_animal bigint auto_increment not null primary key,
	nom_categoria varchar(255) not null
);

create table tbl_animal(
	cod_animal bigint not null auto_increment primary key, 
	col_genero char(1) not null,
	num_sus_responsavel bigint not null,
	cod_categoria_animal bigint not null,
	cod_moradia (int, varchar, int) default null,

	foreing key (num_sus_responsavel) references tbl_usuario(num_sus),
	foreing key (cod_categoria_animal) references tbl_categoria_animal(cod_categoria_animal)
	foreing key (cod_moradia) references tbl_moradia(col_cep, col_rua_moradia, col_numero)
);

/* ------ SAUDE ------ */ 
create table tbl_deficiencia(
	cod_deficiencia int not null auto_increment primary key;
	nom_deficiencia varchar(255) not null
);

create table tbl_droga_ilicita(
	cod_droga int not null primary key,
	nom_droga varchar(255) not null
);

create table tbl_doenca(
	cod_cid varchar(5) not null primary key,
	nom_doenca varchar(255) not null,
	col_descricao_doenca varchar(255) not null
);

create table tbl_area_afetada_doenca(
	cod_area int not null primary key,
	nom_area varchar(255) not null
);

create table tbl_rel_area_afetada_doenca(
	cod_area int not null,
	cod_cid varchar(5) not null,

	foreing key (cod_cid) references tbl_doenca(cod_cid),
	foreing key (cod_area) references tbl_area_afetada_doenca(cod_area),
	primary key (cod_area, cod_cid)
);

create table tbl_saude_cidadao(
	num_sus bigint not null,
	col_peso float not null,
	col_e_fumante boolean not null,
	col_usa_alcool boolean not null,
	col_qtd_avc int not null,

	foreing key (num_sus) references tbl_usuario(num_sus),
	primary key num_sus	
);

create table tbl_rel_saude_cidadao_doenca(
	cod_saude bigint not null,
	cod_doenca varchar(5) not null,

	foreing key (cod_saude) references tbl_saude_cidadao(num_sus),
	foreing key (cod_doenca) references tbl_doenca(cod_cid),
	primary key (cod_saude, cod_doenca)
);


create table tbl_rel_droga_ilicita_usuario(
	cod_saude bigint not null,
	cod_droga int not null,

	foreing key (cod_saude) references tbl_saude_cidadao(num_sus),
	foreing key (cod_droga) references tbl_droga_ilicita(cod_droga),

	primary key (cod_saude, cod_droga)
);

create table tbl_rel_deficiencia_usuario(
	num_sus bigint not null,
	cod_deficiencia int not null,
	foreing key (num_sus) references tbl_saude_cidadao(num_sus),
	foreing key (cod_deficiencia) references tbl_deficiencia(cod_deficiencia),

	primary key (num_sus, cod_deficiencia)
);


/* ----- OCORRENCIAS ----- */

create table tbl_categoria_ocorrencia(
	cod_categoria int not null primary key,
	nom_categoria varchar(150) not null
);


create table tbl_intensidade_ocorrencia(
	cod_intensidade int not null primary key,
	nom_intensidade varchar(70) not null,
);

create table tbl_ocorrencia(
	cod_intensidade int not null,
	col_descricao_ocorrencia varchar(255),
	cod_localidade (int, varchar, int) not null,
	cod_categoria_ocorrencia int not null,

	foreing key (cod_intensidade) references tbl_intensidade_ocorrencia(cod_intensidade),
	foreing key (cod_categoria_ocorrencia) references tbl_categoria_ocorrencia(cod_categoria),
	foreing key (cod_localidade) references tbl_moradia(col_cep, col_rua_moradia, col_numero)
	primary key (cod_categoria_ocorrencia, cod_localidade)
);


create table tbl_notificacao(
	cod_notificacao bigint not null primary key,
	col_mensagem text not null
);

create table tbl_rel_categoria_ocorrencia_notificacao(
	cod_area int not null,
	cod_notificacao bigint not null,

	foreing key (cod_area) references tbl_categoria_ocorrencia(cod_categoria),
	foreing key (cod_notificacao) references tbl_notificacao(cod_notificacao),
	primary key (cod_area, cod_notificacao)
);
