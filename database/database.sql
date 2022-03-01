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

drop table if exists

insert into roles (role_id, role_description, role_abbreviation, role_state) values
(1, 'Administrador', 'Admin', '1'),
(2, 'Usuario', 'User', '1');

DROP TRIGGER IF EXISTS before_users_delete;
CREATE TRIGGER before_users_delete BEFORE DELETE ON users FOR EACH ROW
    DELETE FROM user_profiles WHERE user_id = old.user_id;
