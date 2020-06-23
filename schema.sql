USE yeticave;

DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
user_id int auto_increment primary key,
email varchar(128),
password varchar(64),
user_name varchar(128)
);


CREATE TABLE categories (
cat_id int auto_increment primary key,
cat_name char(60)
);


CREATE TABLE products (
product_id int auto_increment primary key,
product_name varchar(160),
category int,
start_price int,
price int,
rate int,
URL_picture varchar(160),
author int,
data datetime,
state varchar(64),
description varchar(255)
);

create unique index email on users(email);
create unique index cat_name on categories(cat_name);
