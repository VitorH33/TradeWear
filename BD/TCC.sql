create database if not exists bd_tcc;
use bd_tcc;
SET SQL_SAFE_UPDATES = 0;

create table tb_cadastro(
	cd_usuario int not null auto_increment,
	
	nm_usuario varchar(45) not null,
	nm_email varchar(80) not null unique,
	nm_senha varchar(50) not null,
    Foto VARCHAR(255) default null,
	tipo_usuario ENUM('user', 'admin') not null,

	constraint primary key(cd_usuario, nm_email)
);

create table tb_produto(
	cd_produto int not null auto_increment,
	cd_usuario int not null,
	nm_produto varchar(80) not null,
	nm_tamanho varchar(5) not null,
	ds_produto varchar(150) not null,
    nm_categoria varchar(20) not null,
	foto1 varchar(100) not null,
    foto2 varchar(100) not null,
    foto3 varchar(100) not null,
    foto4 varchar(100) not null,

	constraint primary key(cd_produto),
	foreign key (cd_usuario) references tb_cadastro(cd_usuario)
);

create table tb_proposta(
	cd_proposta int not null primary key auto_increment,
    cd_usuario int not null,
    cd_usuario_dono_produto int not null,
    cd_produto int not null, 
    nm_produto varchar(100) not null,
    ds_produto varchar(100) not null,
    nr_produto varchar(5) not null,
    tipo_produto varchar(50) not null,
    imagem1 varchar(255),
    imagem2 varchar(255),
    imagem3 varchar(255),
    imagem4 varchar(255),
    
    foreign key (cd_usuario_dono_produto) references tb_produto(cd_usuario)
);

ALTER TABLE tb_proposta ADD status VARCHAR(20) DEFAULT 'pendente';
ALTER TABLE tb_proposta ADD status_usuario_produto_original VARCHAR(20);
ALTER TABLE tb_proposta ADD status_usuario_produto_proposto VARCHAR(20);

INSERT INTO tb_cadastro (nm_usuario, nm_email, nm_senha, tipo_usuario) VALUES ('Administrador', 'admin@gmail.com', MD5('adm123'), 'admin');