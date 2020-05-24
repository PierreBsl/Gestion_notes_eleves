create table students
(
    id integer not null constraint students_pkey primary key,
    user_id integer constraint students_user_id_fkey references users,
    nom     varchar(255) not null,
    prenom  varchar(255) not null,
    note    integer
);

alter table students
    owner to postgres;

INSERT INTO public.students (id, user_id, nom, prenom, note) VALUES (4, 1, 'Boislève', 'Pierre', 16);
INSERT INTO public.students (id, user_id, nom, prenom, note) VALUES (1, 1, 'Anselmet', 'Eloi', 18);
INSERT INTO public.students (id, user_id, nom, prenom, note) VALUES (5, 1, 'Gagnaire', 'Damien', 14);
INSERT INTO public.students (id, user_id, nom, prenom, note) VALUES (6, 1, 'Fournier', 'Quentin', 15);
INSERT INTO public.students (id, user_id, nom, prenom, note) VALUES (7, 2, 'Fournier', 'Quentin', 15);
INSERT INTO public.students (id, user_id, nom, prenom, note) VALUES (8, 2, 'Anselmet', 'Eloi', 16);
INSERT INTO public.students (id, user_id, nom, prenom, note) VALUES (3, 1, 'Duplouy', 'Alexandre', 13);