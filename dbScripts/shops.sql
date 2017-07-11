create table shops (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50),
	street VARCHAR(50),
	city VARCHAR(50),
	phone VARCHAR(50),
	image1 VARCHAR(100),
	image2 VARCHAR(100),
	image3 VARCHAR(100)
);
insert into shops (name, street, city, phone, image1, image2, image3) values ('Quire', '97902 Walton Drive', 'Kurjan', '355-(802)735-2230', 'http://dummyimage.com/221x194.bmp/cc0000/ffffff', 'http://dummyimage.com/219x169.png/5fa2dd/ffffff', 'http://dummyimage.com/116x133.bmp/ff4444/ffffff');
insert into shops (name, street, city, phone, image1, image2, image3) values ('Gigazoom', '47917 Park Meadow Crossing', 'Starobin', '375-(720)378-4110', 'http://dummyimage.com/207x224.jpg/dddddd/000000', 'http://dummyimage.com/114x145.bmp/cc0000/ffffff', 'http://dummyimage.com/175x231.bmp/cc0000/ffffff');
insert into shops (name, street, city, phone, image1, image2, image3) values ('Topicshots', '0668 Elgar Park', 'Asahi', '81-(448)621-1082', 'http://dummyimage.com/191x214.bmp/5fa2dd/ffffff', 'http://dummyimage.com/202x213.jpg/5fa2dd/ffffff', 'http://dummyimage.com/181x154.png/ff4444/ffffff');
