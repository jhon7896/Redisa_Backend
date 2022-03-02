drop database if exists redisa;

create database redisa;

use redisa;

drop table if exists roles;
create table roles
(
    role_id                     int not null auto_increment,
    role_description            varchar(255) not null,
    role_abbreviation           varchar(255) not null,
    role_state                  char(01) not null,
    created_at 			        timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at 			        timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(),
    PRIMARY KEY (role_id)

);

drop table if exists users;
CREATE TABLE users (
    user_id                     int not null auto_increment,
    user_name                   varchar(255) NOT NULL,
    user_password               text NOT NULL,
    user_state                  char(1) DEFAULT NULL,
    user_lastLogin              timestamp NULL DEFAULT NULL,
    role_id                     int not null,
    remember_token              varchar(100) DEFAULT NULL,
    created_at 			        timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at 			        timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(),
    PRIMARY KEY (user_id),
    foreign key(role_id) references roles(role_id)
);

drop table if exists user_profiles;
CREATE TABLE user_profiles (
    upro_id                     int not null auto_increment,
    upro_company                varchar(255) DEFAULT 'REDISA',
    upro_email                  varchar(190) null,
    upro_firstName              varchar(100) null,
    upro_lastName               varchar(100) null,
    upro_address                varchar(255) null,
    upro_city                   varchar(100) null,
    upro_country                varchar(100) null,
    upro_postalCode             varchar(100) null,
    upro_image                  varchar(255) DEFAULT 'img\profile\default.jpg',
    upro_aboutMe                varchar(255) null,
    user_id                     int not null,
    created_at 			        timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at 			        timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(),
    PRIMARY KEY (upro_id),
    foreign key(user_id) references users(user_id) ON UPDATE CASCADE
);

drop table if exists categories;
CREATE TABLE categories(
    cate_id                     int not null auto_increment,
    cate_description            varchar(250) not null,
    cate_state                  char(01) not null DEFAULT '1',
    PRIMARY KEY (cate_id)
);

drop table if exists sub_categories;
CREATE TABLE sub_categories(
    subc_id                     int not null auto_increment,
    subc_description            varchar(250) not null,
    subc_state                  char(01) not null DEFAULT '1',
    cate_id                     int not null,
    PRIMARY key (subc_id),
    foreign key(cate_id) references categories(cate_id) ON UPDATE CASCADE
);

drop table if exists products;
CREATE TABLE products(
    prod_id                     int not null auto_increment,
    prod_code                   varchar(50) not null,
    prod_name                   varchar(100) not null,
    prod_description            varchar(255) not null,
    prod_price                  decimal(8,2) not null,
    prod_stock                  int not null,
    prod_state                  char(01) not null DEFAULT '1',
    subc_id                     int not null,
    PRIMARY key (prod_id),
    foreign key(subc_id) references sub_categories(subc_id) ON UPDATE CASCADE
);

DROP TRIGGER IF EXISTS before_users_delete;
CREATE TRIGGER before_users_delete BEFORE DELETE ON users FOR EACH ROW
    DELETE FROM user_profiles WHERE user_id = old.user_id;

insert into roles (role_id, role_description, role_abbreviation, role_state) values
(1, 'Administrador', 'Admin', '1'),
(2, 'Usuario', 'User', '1');

insert into categories (cate_id, cate_description, cate_state) values
(1, 'EQUIPAMIENTO DE LÍNEA FRÍO', '1'),
(2, 'EQUIPAMIENTO DE LÍNEA CALOR', '1'),
(3, 'EQUIPAMIENTO DE LÍNEA NEUTRO', '1'),
(4, 'EQUIPAMIENTO DE LÍNEA METÁLICA', '1');

insert into sub_categories (subc_id, subc_description, subc_state, cate_id) values
(01, 'VITRINAS GÉNOVA (POSTRES Y BEBIDAS)', '1', 1),
(02, 'VITRINAS TOKIO (POSTRES Y BEBIDAS)', '1', 1),
(03, 'VITRINAS MIRAGE', '1', 1),
(04, 'BODEGUERAS GÉNOVA (QUESOS, EMBUTIDOS Y LÁCTEOS)', '1', 1),
(05, 'VITRINAS ESQUINERA GÉNOVA (TORTAS)', '1', 1),
(06, 'VITRINAS EN L GÉNOVA (TORTAS)', '1', 1),
(07, 'VITRINAS PARA CARNE', '1', 1),
(08, 'VITRINA PARA HELADOS', '1', 1),
(09, 'MESAS REFRIGERADAS', '1', 1),
(10, 'CONGELADORAS HORIZONTALES', '1', 1),
(11, 'VISICOOLERS', '1', 1),
(12, 'FREEZERS', '1', 1),
(13, 'REFRIGERADORES', '1', 1),
(14, 'MESAS REFRIGERADAS', '1', 1),
(15, 'REFRESQUERAS', '1', 1),
(16, 'CREMOLADERAS', '1', 1),
(17, 'MÁQUINA DE HELADO SOFT', '1', 1),
(18, 'HORNOS PARA PASTELES', '1', 2),
(19, 'HORNOS PARA PAN', '1', 2),
(20, 'HORNOS PARA PIZZA', '1', 2),
(21, 'CÁMARA DE FERMENTACIÓN', '1', 2),
(22, 'COCINAS INDUSTRIALES', '1', 2),
(23, 'HORNOS DE POLLO', '1', 2),
(24, 'PLANCHA Y PARRILLAS', '1', 2),
(25, 'FREIDORAS DE PAPAS', '1', 2),
(26, 'TÁVOLAS', '1', 2),
(27, 'VITRINAS GÉNOVA (PASTELES SECOS)', '1', 3),
(28, 'PANERA GÉNOVA', '1', 3),
(29, 'BATIDORAS', '1', 3),
(30, 'AMASADORAS', '1', 3),
(31, 'DIVISORA DE MASA', '1', 3),
(32, 'LAMINADORA PARA PASTAS', '1', 3),
(33, 'PROCESADOR DE ALIMENTOS', '1', 3),
(34, 'LICUADORAS', '1', 3),
(35, 'MOLEDORAS', '1', 3),
(36, 'SIERRA PARA CORTES DE CARNE', '1', 3),
(37, 'CORTADORA DE CARNE/EMBUTIDOS', '1', 3),
(38, 'REBANADORA DE CARNE', '1', 3),
(39, 'PELADORA DE PAPAS', '1', 3),
(40, 'BALANZAS', '1', 3),
(41, 'EXPRIMIDOR DE CÍTRICOS', '1', 3),
(42, 'EMPACADORA AL VACIO', '1', 3),
(43, 'MOLINO DE PAN', '1', 3),
(44, 'RAYADOR DE QUESO Y COCO', '1', 3),
(45, 'MOLDE PARA PAN DE MOLDE', '1', 3),
(46, 'BANDEJAS', '1', 4),
(47, 'COCHE PORTABANDEJAS', '1', 4),
(48, 'MESA DE TRABAJO', '1', 4),
(49, 'MESA PARA PANADERIA', '1', 4),
(50, 'LAVADEROS', '1', 4),
(51, 'REPISAS', '1', 4);
