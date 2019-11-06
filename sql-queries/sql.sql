CREATE DATABASE moviepass; 

USE moviepass;

CREATE TABLE roles(
id TINYINT UNSIGNED AUTO_INCREMENT NOT NULL,
preority VARCHAR(255),
CONSTRAINT pk_id_rol PRIMARY KEY (id)
);

INSERT INTO roles (preority) VALUES ('Developer');
INSERT INTO roles (preority) VALUES ('Administrador');
INSERT INTO roles (preority) VALUES ('Customer');

CREATE TABLE users(
id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
rol TINYINT UNSIGNED, 
name VARCHAR(255) NOT NULL,
lastname VARCHAR(255) NOT NULL,  
dni VARCHAR(255) NOT NULL,   
nikname VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL,
CONSTRAINT pk_id_user PRIMARY KEY (id),
CONSTRAINT fk_id_user_rol FOREIGN KEY (rol) REFERENCES roles (id),
CONSTRAINT unq_dni_user UNIQUE (dni)    
);

CREATE TABLE cinemas(
id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
name VARCHAR(255) NOT NULL,
address VARCHAR(255) NOT NULL,
total_capacity SMALLINT UNSIGNED NOT NULL,
estimated_price FLOAT UNSIGNED NOT NULL,
CONSTRAINT pk_id_cinema PRIMARY KEY (id)    
);

    
CREATE TABLE genres(
id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
idapi BIGINT UNSIGNED,
name VARCHAR(255),
image VARCHAR(255),
CONSTRAINT pk_id_genres PRIMARY KEY (id)
);

CREATE TABLE movies(
id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,  
idapi BIGINT,
vote SMALLINT,
poster VARCHAR(255),
backdrop VARCHAR(255),
lan TINYTEXT,
title VARCHAR(255),
popularity FLOAT,
overview VARCHAR(255),
datemdy DATE,
average VARCHAR(255),
duration VARCHAR(10),
CONSTRAINT pk_id_movies PRIMARY KEY (id)
); 

CREATE TABLE movie_for_genres(
id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
genre BIGINT UNSIGNED,  
movie BIGINT UNSIGNED,
CONSTRAINT pk_id_movie_for_genre PRIMARY KEY (id),
CONSTRAINT fk_id_genre_movie_for_genre FOREIGN KEY (genre) REFERENCES genres (id),
CONSTRAINT fk_id_movie_movie_for_genre FOREIGN KEY (movie) REFERENCES movies (id)   
);

CREATE TABLE functions(
id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
cinema BIGINT UNSIGNED,    
movie BIGINT UNSIGNED,
day DATE NOT NULL,
hours TIME NOT NULL,   
CONSTRAINT pk_id_functio PRIMARY KEY (id),
CONSTRAINT fk_id_cinema_functions FOREIGN KEY (cinema) REFERENCES cinemas (id),    
CONSTRAINT fk_id_movie FOREIGN KEY (movie) REFERENCES movies (id)
);


CREATE TABLE discounts(
id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
discount FLOAT UNSIGNED NOT NULL,
description VARCHAR(255),
day DATE NOT NULL,
hours TIME,
CONSTRAINT pk_id_discount PRIMARY KEY (id)
);

CREATE TABLE shoppings(
id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
client BIGINT UNSIGNED,
discount BIGINT UNSIGNED,
day DATE NOT NULL,
countrtiket SMALLINT UNSIGNED NOT NULL,   
cost FLOAT UNSIGNED NOT NULL,    
total FLOAT UNSIGNED NOT NULL,
CONSTRAINT pk_id_shoppings PRIMARY KEY (id),
CONSTRAINT fk_user_id FOREIGN KEY (client) REFERENCES  users (id),
CONSTRAINT fk_discounts_id FOREIGN KEY (client) REFERENCES  discounts (id)  
);

CREATE TABLE tikets(
id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
shopping BIGINT UNSIGNED,
movie BIGINT UNSIGNED,    
seat BIGINT UNSIGNED,       
qr VARCHAR(255) NOT NULL ,
numbre BIGINT UNSIGNED NOT NULL,
CONSTRAINT pk_id_tiket PRIMARY KEY (id),
CONSTRAINT fk_id_shopping_tikets FOREIGN KEY (shopping) REFERENCES shoppings (id),
CONSTRAINT fk_id_movie_tikets FOREIGN KEY (movie) REFERENCES shoppings (id),
CONSTRAINT unq_numbertikets UNIQUE(numbre)     
);


