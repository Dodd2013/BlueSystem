--create database jol;
use jol;
set names utf8;
create table blueSySusers(
	nick varchar(40) not null,
	email varchar(40) not null primary key,
	pswd varchar(40) not null
)default charset=utf8;