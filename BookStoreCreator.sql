create database bookstore;
use bookstore;

create table if not exists users (
	`user_id` int unsigned auto_increment primary key,
    `first_name` varchar(40) not null default '',
    `last_name` varchar(40) not null default '',
    `email` varchar(80) not null default '',
    `address` varchar(100) not null default''
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


insert into books values
(default, 'Greenlights Hardcover – Oct. 20 2020', '#1 NEW YORK TIMES BESTSELLER • From the Academy Award®–winning actor, an unconventional memoir filled with raucous stories, outlaw wisdom, and lessons learned the hard way about living with greater satisfaction', 24.23, 'https://images-na.ssl-images-amazon.com/images/I/41U3yoF6sXL._SX427_BO1,204,203,200_.jpg', 10),
(default, 'A Promised Land Hardcover – Nov. 17 2020', 'A riveting, deeply personal account of history in the making—from the president who inspired us to believe in the power of democracy', 29.00, 'https://images-na.ssl-images-amazon.com/images/I/41L5qgUW2fL._SX327_BO1,204,203,200_.jpg', 10),
(default, 'My Own Words Paperback – Aug. 7 2018', 'The New York Times bestselling book from Supreme Court Justice Ruth Bader Ginsburg—“a comprehensive look inside her brilliantly analytical, entertainingly wry mind, revealing the fascinating life of one of our generation\'s most influential voices in both law and public opinion” (Harper’s Bazaar).', 39.59, 'https://images-na.ssl-images-amazon.com/images/I/41ZhmNOH8ZL._SX326_BO1,204,203,200_.jpg', 20),
(default, 'Becoming Hardcover – Illustrated, Nov. 13 2018', '#1 NEW YORK TIMES BESTSELLER • WATCH THE EMMY-NOMINATED NETFLIX ORIGINAL DOCUMENTARY • OPRAH’S BOOK CLUB PICK • NAACP IMAGE AWARD WINNER • ONE OF ESSENCE’S 50 MOST IMPACTFUL BLACK BOOKS OF THE PAST 50 YEARS', 31.90, 'https://images-na.ssl-images-amazon.com/images/I/414JfiBCutL._SX327_BO1,204,203,200_.jpg', 12),
(default, 'Mahatma Gandhi Hardcover – Illustrated, April 30 2019', 'New in the Little People, Big Dreams series, discover the life of Mohandas Gandhi, the father of India, in this true story of his life. As a young teenager in India, Gandhi led a rebellious life and went against his parents\' values. But as a young man, he started to form beliefs of his own that harked back to the Hindu principles of his childhood.', 17.33, 'https://images-na.ssl-images-amazon.com/images/I/41QrCZY3laL._SX408_BO1,204,203,200_.jpg', 2);