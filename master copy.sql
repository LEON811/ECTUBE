drop table if exists ban_history;
drop table if exists delete_record;
drop table if exists admin;
drop table if exists chat_report;
drop table if exists chat;
drop table if exists favorite_list;
drop table if exists live_report;
drop table if exists tip;
drop table if exists live;
drop table if exists order_detail;
drop table if exists order_list;
drop table if exists ppoint_charge;
drop table if exists product_report;
drop table if exists shopping_cart;
drop table if exists vedio_report;
drop table if exists video;
drop table if exists products;
drop table if exists product_category;
drop table if exists report_category;
drop table if exists user;
drop table if exists access_logs;
drop table if exists live_products;

/* create tables */

create table admin
(
	admin_id int not null auto_increment,
	admin_pw char(32) not null,
	family_name varchar(64) not null,
	first_name varchar(64) not null,
	email varchar(255) not null,
	primary key (admin_id),
	unique (admin_id)
);


create table ban_history
(
	ban_id int not null auto_increment,
	user_id int not null,
	admin_id int not null,
	ban_start_date datetime not null,
	ban_end_date datetime not null,
	ban_reason text,
	primary key (ban_id),
	unique (ban_id)
);


create table chat
(
	live_id int not null,
	chat_number int not null,
	user_id int not null,
	chat_content text,
	chat_datetime datetime,
	primary key (live_id, chat_number),
	unique (live_id, chat_number)
);


create table chat_report
(
	chat_report_id int not null auto_increment,
	live_id int not null,
	chat_number int not null,
	report_id int not null,
	reporter_id int not null,
	datetime datetime not null,
	primary key (chat_report_id),
	unique (chat_report_id)
);


create table delete_record
(
	delete_id int not null auto_increment,
	admin_id int not null,
	live_report_id int not null,
	product_report_id int not null,
	vedio_report_id int not null,
	chat_report_id int not null,
	reason text,
	datetime datetime,
	primary key (delete_id),
	unique (delete_id)
);


create table favorite_list
(
	user_id int not null,
	favorite_id int not null,
	primary key (user_id, favorite_id)
);


create table live
(
	live_id int not null auto_increment,
	user_id int not null,
	product_id int,
	title varchar(64),
	start_date datetime,
	end_date datetime,
	thumbnail varchar(255),
	sum_live_tip int,
	description text,
	primary key (live_id)
);


create table live_report
(
	live_report_id int not null auto_increment,
	live_id int not null,
	report_id int not null,
	reporter_id int not null,
	datetime datetime,
	primary key (live_report_id),
	unique (live_report_id)
);


create table order_detail
(
	order_id int not null,
	product_id int not null,
	quantity int not null,
	payment int not null,
	primary key (order_id, product_id)
);


create table order_list
(
	order_id int not null auto_increment,
	user_id int not null,
	purchase_date date not null,
	shipping_date date,
	tracking_number varchar(64),
	delivery_days varchar(64),
	receipt_date datetime,
	completion_date datetime,
	 cancel_date datetime,
	summary int,
	pay_id int,
	primary key (order_id),
	unique (order_id)
);


create table ppoint_charge
(
	user_id int not null,
	charge int,
	datetime datetime,
	pay_id int,
	primary key (user_id)
);


create table products
(
	product_id int not null auto_increment,
	user_id int not null,
	category_id int not null,
	product_name varchar(64) not null,
	product_price int not null,
	product_inventory int,
	product_maker varchar(64),
	image_id varchar(255),
	product_number varchar(64),
	product_description text,
	size varchar(64),
	delete_date datetime,
	upload_date datetime,
	discount float,
	primary key (product_id),
	unique (product_id),
	unique (product_id, user_id)
);

create table products_size
(
	product_id int not null,
	product_size varchar(10),
	product_inventory int,
	primary key (product_id,product_size)
);


create table product_category
(
	category_id int not null,
	category_name varchar(64),
	primary key (category_id)
);


create table product_report
(
	product_report_id int not null auto_increment,
	product_id int not null,
	reporter_id int not null,
	report_id int not null,
	report_datetime datetime not null,
	primary key (product_report_id),
	unique (product_report_id)
);


create table report_category
(
	report_id int not null,
	report_name varchar(64),
	primary key (report_id),
	unique (report_id)
);


create table shopping_cart
(
	user_id int not null,
	product_id int not null,
	quantity int,
	add_date datetime,
	primary key (user_id, product_id)
);


create table tip
(
	live_id int not null,
	user_id int not null,
	datetime datetime not null,
	ppoint int,
	primary key (live_id, user_id)
);


create table user
(
	user_id int not null auto_increment,
	user_password char(128) not null,
	email varchar(255) not null,
	user_name varchar(64) not null,
	family_name varchar(64) not null,
	first_name varchar(64) not null,
	furigana_family_name varchar(64),
	furigana_first_name varchar(64),
	user_icon varchar(255),
	user_address varchar(255),
	user_zip char(7),
	tel varchar(13),
	ban_count int not null,
	delete_date datetime,
	ppoint int,
	bank varchar(64),
	bank_id varchar(64),
	bank_account varchar(64),
	card_number char(16),
	card_cvv char(5),
	card_valid date,
	primary key (user_id),
	unique (user_id),
	unique (email)
);


create table video_report
(
	vedio_report_id int not null auto_increment,
	video_id int,
	reporter_id int not null,
	report_id int not null,
	datetime datetime,
	primary key (vedio_report_id),
	unique (vedio_report_id)
);


create table video
(
	video_id int not null auto_increment,
	user_id int not null,
	product_id int ,
	video_title varbinary(64) not null,
	views int not null,
	upload_date datetime not null,
	delete_date datetime,
	thumbnail varchar(255) not null,
	description text,
	primary key (video_id)
);

create table live_products
(
	live_id int not null ,
	product_id int not null,
	PRIMARY KEY(live_id,product_id)
);

create table access_logs
(
	log_id int not null auto_increment,
	uri text,
	ipaddress text,
	created timestamp,
	primary key (log_id)
);