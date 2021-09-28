create table comment(
comment_no int not null auto_increment,
food_no int,
user_id char(20),
nick char(20),
comment varchar(500),
comment_day char(20),
primary key(comment_no),
foreign key (food_no) references food (food_no) on delete cascade,
foreign key (user_id,nick) references member (id,nick) on delete cascade
);
