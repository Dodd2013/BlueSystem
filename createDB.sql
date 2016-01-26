create database blueSysDB;
use blueSysDB;
set names utf8;
create table users(
	nick varchar(40) not null,
	email varchar(40) not null primary key,
	pswd varchar(40) not null
)default charset=utf8;