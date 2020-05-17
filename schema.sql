create database yeticave
	default character set utf8
	default collate utf8_general_ci;

USE yeticave;

CREATE TABLE users (
user_id int auto_increment primary key,
email varchar(128),
password varchar(64),
user_name varchar(128)
);


CREATE TABLE categories (
cat_id int auto_increment primary key,
cat_name varchar(160)
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
state varchar(64)
);

create unique index email on users(email);
create unique index cat_name on categories(cat_name);
