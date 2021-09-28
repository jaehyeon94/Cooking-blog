create table review(
review_no int not null auto_increment,
food_no int,
user_id char(20),
name char(20),
title char(20) not null,
review_content varchar(500),
regist_day char(20),
primary key(review_no),
foreign key (food_no) references food (food_no) ON DELETE SET NULL,
foreign key (user_id,name) references member (id,nick) ON DELETE SET NULL
);