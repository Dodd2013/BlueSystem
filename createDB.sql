--create database jol;
use jol;
set names utf8;
create table blueSySusers(
	nick varchar(40) not null,
	email varchar(40) not null primary key,
	pswd varchar(40) not null
)default charset=utf8;
create table blueSySSubmit(
	submit_id int primary key auto_increment,
	context_code varchar(40) not null,
	pid int not null,
	email varchar(40) not null,
	foreign key(email) references blueSySusers(email),
	ans varchar(100) null,
	solution_id int null,
	submit_time datetime not null,
	score int null
)default charset=utf8;
