create table users
(
    id integer not null constraint users_pkey primary key,
    login    varchar(255) not null,
    password varchar(255) not null,
    mail     varchar(255) not null,
    nom      varchar(255) not null,
    prenom   varchar(255) not null
);

alter table users
    owner to postgres;

INSERT INTO public.users (id, login, password, mail, nom, prenom) VALUES (1, 'Ayoub', '$2y$10$CtteYJh2DYgj8DAC3oMsqer57j8PdXlu.R7dNdlcsiz7Bkom7Vh6S', 'ayoub.karine@isen-ouest.yncrea.fr', 'Karine', 'Ayoub');
INSERT INTO public.users (id, login, password, mail, nom, prenom) VALUES (2, 'Jérémy', '$2y$10$Pw2Y3LU0ocnLztLhhqxZre6FAvVACs3gCyF7dkQfAzBb1gezB1HIe', 'jeremy.freixas@isen-ouest.yncrea.fr', 'Freixas', 'Jérémy');