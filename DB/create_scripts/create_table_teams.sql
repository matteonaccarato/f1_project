-- auto-generated definition
create table teams
(
    id              int auto_increment
        primary key,
    name            varchar(100) not null,
    logo_url        varchar(255) null,
    color_rgb_value char(11)     null
);

