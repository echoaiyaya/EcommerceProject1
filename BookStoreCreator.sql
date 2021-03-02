create database if not exists bookstore;
use bookstore;

create table if not exists users (
	`user_id` int unsigned auto_increment primary key,
    `first_name` varchar(40) not null default '',
    `last_name` varchar(40) not null default '',
    `email` varchar(80) not null default '',
    `address` varchar(100) not null default'',
    `password` varchar(50) not null default ''
)engine=InnoDB default charset=utf8;

create table if not exists books (
	`book_id` int unsigned auto_increment primary key,
    `book_name` varchar(80) not null default '',
    `book_description` varchar(600) not null default '',
    `book_price` decimal(5,2) not null default 0,
    `book_img` varchar(200) not null default '',
    `book_quality` int not null default 0
)engine=InnoDB default charset=utf8;

create table if not exists orders (
	`order_id` int unsigned auto_increment primary key,
    `user_id` int unsigned,
    `first_name` varchar(40) not null default '',
    `last_name` varchar(40) not null default '',
    `email` varchar(80) not null default '',
    `address` varchar(100) not null default '',
    `price` decimal(9,2) not null default 0,
    `tax` decimal(9,2) not null default 0,
    `total_price` decimal(9,2) not null default 0,
    `payMethod` varchar(20) not null default 'Paypal',
    `public_time` datetime not null default now(),
    foreign key (`user_id`) references users(`user_id`)
)engine=InnoDB default charset=utf8;

create table if not exists order_books (
	`ob_id` int unsigned auto_increment primary key,
    `book_id` int unsigned,
    `order_id` int unsigned,
    `quanlity` int not null default 0,
    foreign key (`book_id`) references books(`book_id`),
    foreign key (`order_id`) references orders(`order_id`)
)engine=InnoDB default charset=utf8;


