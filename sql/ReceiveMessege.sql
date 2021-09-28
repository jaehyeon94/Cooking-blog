create table receive(
messege_no int not null auto_increment,
send char(20),
receive char(20),
title char(20),
messege varchar(500),
regist_day char(20),
primary key(messege_no),
foreign key (send) references member (id) ON DELETE SET NULL,
foreign key (receive) references member (id) ON DELETE SET NULL
);