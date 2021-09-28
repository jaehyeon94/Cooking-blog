create table member (
id char(15) not null,
pass char(20) not null,
nick char(20) not null,
mail char(80) not null,
photo char(60) default 'images/default.png' not null,
primary key(id,nick)
);