DROP TABLE IF EXISTS brand;
DROP TABLE IF EXISTS product;

create table brand
(
    name varchar(255) not null,
    id   int auto_increment
        primary key
) engine = MyISAM
    collate = utf8_unicode_ci;

create table product
(
    id       int auto_increment
        primary key,
    name     varchar(255) not null,
    price    int          not null,
    brand_id int          not null
) engine = MyISAM
    collate = utf8_unicode_ci;


INSERT INTO brand (name) VALUES ('Adidas');
INSERT INTO brand (name) VALUES ('Nike');
INSERT INTO brand (name) VALUES ('Puma');
INSERT INTO brand (name) VALUES ('Levis');
INSERT INTO brand (name) VALUES ('Gucci');
INSERT INTO brand (name) VALUES ('H&M');
INSERT INTO brand (name) VALUES ('Zara');
INSERT INTO brand (name) VALUES ('Calvin Klein');
INSERT INTO brand (name) VALUES ('Under Armour');
INSERT INTO brand (name) VALUES ('Tommy Hilfiger');
INSERT INTO brand (name) VALUES ('Versace');
INSERT INTO brand (name) VALUES ('Ralph Lauren');
INSERT INTO brand (name) VALUES ('Balenciaga');
INSERT INTO brand (name) VALUES ('Dior');

INSERT INTO product ( name, price, brand_id) VALUES ('Tricko happy life', 399, 6);
INSERT INTO product ( name, price, brand_id) VALUES ('TOP SALA COMPETITION IE1548', 1539, 1);
INSERT INTO product ( name, price, brand_id) VALUES ('COURT TEAM BOUNCE 2.0 M HP3341', 1690, 1);
INSERT INTO product ( name, price, brand_id) VALUES ('BOX HOG 2 FX0561', 1499, 1);
INSERT INTO product ( name, price, brand_id) VALUES ('DEFIANT SPEED M ID1508', 2039, 1);
