USE yeticave;

insert into categories set
	cat_name = 'Доски и лыжи';

insert into categories set
	cat_name = 'Крепления';

insert into categories set
	cat_name = 'Ботинки';

insert into categories set
	cat_name = 'Одежда';

insert into categories set
	cat_name = 'Инструменты';

insert into categories set
	cat_name = 'Разное';




insert into users set
	email = 'ignat.v@gmail.com',
    user_name = 'Игнат',
    password = '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka';

insert into users set
	email = 'kitty_93@li.ru',
    user_name = 'Дмитрий',
    password = '$2y$10$mZf3tnfOYMot9vClCR0GHu7wgctHkFs2w8fYRSDGb8A27NsHeO9km';

insert into users set
	email = 'warrior07@mail.ru',
    user_name = 'Руслан',
    password = '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW';



insert into products set
	product_name = '2014 Rossignol District Snowboard',
	category = 1,
	start_price = 10999,
	price = 10999,
	rate = 1,
	URL_picture = 'img/lot-1.jpg' ,
	data = null,
	state = 'open',
	author = 1;

insert into products set
	product_name = 'DC Ply Mens 2016/2017 Snowboard',
	category = 1,
	start_price = 159999,
	price = 159999,
	rate = 1,
	URL_picture = 'img/lot-2.jpg' ,
	data = null,
	state = 'open',
	author = 1;

insert into products set
	product_name = 'Крепления Union Contact Pro 2015 года размер L/XL',
	category = 2,
	start_price = 8000,
	price = 8000,
	rate = 1,
	URL_picture = 'img/lot-3.jpg' ,
	data = null,
	state = 'open',
	author = 1;

insert into products set
	product_name = 'Ботинки для сноуборда DC Mutint Charocal',
	category = 3,
	start_price = 10999,
	price = 10999,
	rate = 1,
	URL_picture = 'img/lot-4.jpg' ,
	data = null,
	state = 'open',
	author = 1;

insert into products set
	product_name = 'Куртка для сноуборда DC Mutiny Charocal',
	category = 4,
	start_price = 7500,
	price = 7500,
	rate = 1,
	URL_picture = 'img/lot-5.jpg' ,
	data = null,
	state = 'open',
	author = 1;

insert into products set
	product_name = 'Маска Oakley Canopy',
	category = 6,
	start_price = 5400,
	price = 5400,
	rate = 1,
	URL_picture = 'img/lot-6.jpg' ,
	data = null,
	state = 'open',
	author = 1;






