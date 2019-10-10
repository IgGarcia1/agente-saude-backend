create table if not EXISTS tbl_escolaridade(
	cod_escolaridade int not null auto_increment primary key,
	nom_escolaridade varchar(255) not null
);

/* tbl_escolaridade */
insert into tbl_escolaridade (cod_escolaridade, nom_escolaridade) value (1, 'Ensino Fundamental');
insert into tbl_escolaridade (cod_escolaridade, nom_escolaridade) value (2, 'Ensino Médio');
insert into tbl_escolaridade (cod_escolaridade, nom_escolaridade) value (3, 'Graduação');
insert into tbl_escolaridade (cod_escolaridade, nom_escolaridade) value (4, 'Licenciatura');
insert into tbl_escolaridade (cod_escolaridade, nom_escolaridade) value (5, 'Bacharelado');
insert into tbl_escolaridade (cod_escolaridade, nom_escolaridade) value (6, 'Pós-graduação');
insert into tbl_escolaridade (cod_escolaridade, nom_escolaridade) value (7, 'Mestrado');
insert into tbl_escolaridade (cod_escolaridade, nom_escolaridade) value (8, 'Doutorado');

create table if not EXISTS tbl_usuario(
	num_sus bigint not null primary key, 
    col_parentesco varchar(50) not null,
    col_genero char(1) not null,
    
    cod_deficiencia int, 
	col_obito boolean default False,
    col_plano_saude boolean default False,
    col_mudanca boolean default False,
	cod_escolaridade int not null,
    col_crianca_fica_com varchar(50),

	foreign key (cod_escolaridade) references tbl_escolaridade(cod_escolaridade),
    foreign key (cod_deficiencia) references tbl_deficiencia(cod_deficiencia)
);

create table tbl_cidadao_rua(
    num_sus bigint not null,
    col_tempo_rua float not null,
    col_alimenta_dia boolean default False,
    col_origem_alimentacao varchar(70) not null,
    col_higiene_pessoal boolean default False,

    col_recebe_beneficio boolean default False,
    col_possui_referencia_familiar boolean default False,

    foreign key (num_sus) references tbl_usuario(num_sus),
    primary key (num_sus)
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

/* ---- Moradia ---- */

create table if not EXISTS tbl_moradia(
	col_cep int not null,
	col_numero int not null,
	tem_abastecimento_agua boolean default False,
	tem_sistema_esgoto boolean default False,
	tem_coleta_lixo boolean default False, 
	tem_animais boolean default False,
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

create table if not exists tbl_rel_categoria_animal_moradia(
	cod_moradia bigint not null,
	cod_categoria_animal bigint not null,

	foreign key (cod_categoria_animal) references tbl_categoria_animal(cod_categoria_animal),
	foreign key (cod_moradia) references tbl_moradia(cod_moradia),
	primary key (cod_moradia, cod_categoria_animal)
);

/* ------ SAUDE ------ */ 
create table if not EXISTS tbl_deficiencia(
	cod_deficiencia int not null auto_increment primary key,
	nom_deficiencia varchar(255) not null
);

create table if not EXISTS tbl_doenca(
	cod_cid varchar(5) not null primary key,
	nom_doenca varchar(255) not null,
	col_descricao_doenca varchar(255) not null
);


create table if not EXISTS tbl_saude_cidadao(
	num_sus bigint not null,
	col_peso float not null,
	col_doenca_cardiaca boolean default False,
    col_doenca_respiratoria boolean default False,
    col_problema_rins boolean default False,
    col_e_fumante boolean default False,
	col_usa_alcool boolean default False,
	col_avc boolean default False,
    col_usa_drogas boolean default False,
	col_hipertensao boolean default False,
	col_diabetes boolean default False,
    col_mudanca boolean default False,
    col_cancer boolean default False

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
	cod_usuario bigint not null,

	foreign key (cod_usuario) references tbl_usuario(num_sus),
	foreign key (cod_intensidade) references tbl_intensidade_ocorrencia(cod_intensidade),
	foreign key (cod_categoria_ocorrencia) references tbl_categoria_ocorrencia(cod_categoria),
	foreign key (cod_localidade) references tbl_moradia(cod_moradia),
	primary key (cod_categoria_ocorrencia, cod_localidade)
);


create table if not EXISTS tbl_notificacao(
	cod_notificacao bigint not null primary key,
	col_mensagem text not null,
	col_valida boolean default False
);

create table if not EXISTS tbl_rel_categoria_ocorrencia_notificacao(
	cod_area int not null,
	cod_notificacao bigint not null,

	FOREIGN key (cod_area) references tbl_categoria_ocorrencia(cod_categoria),
	foreign key (cod_notificacao) references tbl_notificacao(cod_notificacao),
	primary key (cod_area, cod_notificacao)
);


/* ------------------ INSERCOES ---------------*/

/* tbl_cargo_profissional */
insert into tbl_cargo_profissional(cod_cargo, nom_cargo) values("ADM01", "Gerente");
insert into tbl_cargo_profissional(cod_cargo, nom_cargo) values("CMP01", "Fiscal");

/* tbl_categoria_animal */
insert into tbl_categoria_animal (cod_categoria_animal, nom_categoria) values (1, 'Cachorro');
insert into tbl_categoria_animal (cod_categoria_animal, nom_categoria) values (2, 'Gato');
insert into tbl_categoria_animal (cod_categoria_animal, nom_categoria) values (3, 'Pássaro');
insert into tbl_categoria_animal (cod_categoria_animal, nom_categoria) values (4, 'Outros');

/* tbl_intensidade_ocorrencia */

insert into tbl_intensidade_ocorrencia (cod_intensidade, nom_intensidade) values (1, "Baixa");
insert into tbl_intensidade_ocorrencia (cod_intensidade, nom_intensidade) values (2, "Moderada");	
insert into tbl_intensidade_ocorrencia (cod_intensidade, nom_intensidade) values (3, "Alta");

/* tbl_doencas */
insert into tbl_doenca(cod_cid, nom_doenca, col_descricao_doenca) values('J45', 'Asma', '');
insert into tbl_doenca(cod_cid, nom_doenca, col_descricao_doenca) values('J43', 'Enfisema', '');
insert into tbl_doenca(cod_cid, nom_doenca, col_descricao_doenca) values('E14', 'Diabetes melitus não especificado', '');
insert into tbl_doenca(cod_cid, nom_doenca, col_descricao_doenca) values('000', 'Não sabe', '');
insert into tbl_doenca(cod_cid, nom_doenca, col_descricao_doenca) values('001', 'Outras', '');

/* tbl_deficiencia */
insert into tbl_deficiencia(nom_deficiencia) values("Auditiva");
insert into tbl_deficiencia(nom_deficiencia) values("Visual");
insert into tbl_deficiencia(nom_deficiencia) values("Física");
insert into tbl_deficiencia(nom_deficiencia) values("Intelctual/Cognitiva");
insert into tbl_deficiencia(nom_deficiencia) values("Outra");