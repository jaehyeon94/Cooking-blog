create table food (
food_no int not null auto_increment,
user_id char(20) not null,
name char(30) not null,
title char(30) not null,
type char(30) not null,
photo char(60),
content varchar(8000) not null,
primary key(food_no),
regist_day char(20),
foreign key (user_id,name) references member (id,nick)
);
