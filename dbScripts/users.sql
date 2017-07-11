create table users (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50),
	email VARCHAR(50),
	password VARCHAR(50),
	profile VARCHAR(13),
	enabled VARCHAR(50),
	shopId INT
);
insert into users (id, name, email, password, profile, enabled, shopId) values (1, 'Johnny Follis', 'jfollis0@blogtalkradio.com', '0', 'cliente', true, 1);
insert into users (id, name, email, password, profile, enabled, shopId) values (2, 'Alix Merigot', 'amerigot1@bravesites.com', '53507', 'encargado', true, 3);
insert into users (id, name, email, password, profile, enabled, shopId) values (3, 'Nancee Stollmeyer', 'nstollmeyer2@zimbio.com', '83790', 'administrador', true, 1);
insert into users (id, name, email, password, profile, enabled, shopId) values (4, 'Travers Margiotta', 'tmargiotta3@lycos.com', '3012', 'administrador', false, 2);
insert into users (id, name, email, password, profile, enabled, shopId) values (5, 'Hailey McGarvey', 'hmcgarvey4@boston.com', '3', 'administrador', true, 2);
insert into users (id, name, email, password, profile, enabled, shopId) values (6, 'Mitchell Prendergrast', 'mprendergrast5@topsy.com', '06735', 'empleado', false, 3);
insert into users (id, name, email, password, profile, enabled, shopId) values (7, 'Burr Demetr', 'bdemetr6@deliciousdays.com', '5', 'cliente', false, 2);
insert into users (id, name, email, password, profile, enabled, shopId) values (8, 'Wilburt Merrick', 'wmerrick7@sphinn.com', '58', 'administrador', false, 2);
insert into users (id, name, email, password, profile, enabled, shopId) values (9, 'Berri Alliband', 'balliband8@reddit.com', '6496', 'empleado', true, 3);
insert into users (id, name, email, password, profile, enabled, shopId) values (10, 'Anny Hegerty', 'ahegerty9@yelp.com', '114', 'administrador', true, 2);
insert into users (id, name, email, password, profile, enabled, shopId) values (11, 'Rob Kondratyuk', 'rkondratyuka@ustream.tv', '7', 'cliente', false, 3);
insert into users (id, name, email, password, profile, enabled, shopId) values (12, 'Gunar Atkyns', 'gatkynsb@infoseek.co.jp', '00748', 'encargado', true, 3);
insert into users (id, name, email, password, profile, enabled, shopId) values (13, 'Whitby Olczak', 'wolczakc@addtoany.com', '7', 'administrador', false, 2);
insert into users (id, name, email, password, profile, enabled, shopId) values (14, 'Blinny Hollingsbee', 'bhollingsbeed@webs.com', '10852', 'cliente', true, 1);
insert into users (id, name, email, password, profile, enabled, shopId) values (15, 'Pauly McKevitt', 'pmckevitte@weebly.com', '16', 'empleado', true, 3);
