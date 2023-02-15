create database blog;
use blog;
create table if not exists admins(
idAdmin int not null auto_increment primary key,
nomeCompleto varchar(255) not null,
email varchar(255) not null,
senha varchar(255) not null
);
create table if not exists artigos (
idArtigo int not null auto_increment primary key,
titulo varchar(255) not null,
backgroundImg varchar(255) not null,
Texto text not null,
idAdmin int not null,
foreign key (idAdmin) references admins(idAdmin)
);
