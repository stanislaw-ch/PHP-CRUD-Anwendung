drop database if exists firma_1;
create database firma_1;
use firma_1;
drop table employees;
drop table departments;
drop table genders;
create table departments (
                             id int primary key auto_increment,
                             name varchar(45) not null,
                             UNIQUE (name)
);

insert into departments(id, name)
values (null, 'Produktion'),
       (null, 'Personalwesen'),
       (null, 'Marketing'),
       (null, 'Buchhaltung '),
       (null, 'Forschung'),
       (null, 'Geschäftsleitung'),
       (null, 'IT und EDV'),
       (null, 'Kundendienst');

create table genders (
                         id int primary key auto_increment,
                         gender varchar(10) not null
);

insert into genders(id, gender)
values (null, 'weiblich'),
       (null, 'männlich'),
       (null, 'diverse');

create table employees (
                           id int primary key auto_increment,
                           firstname varchar(45) not null,
                           lastname varchar(45) not null,
                           gender_id int,
                           salary  double not null,
                           department_id int,
                           FOREIGN KEY(department_id) REFERENCES departments(id)
                               ON DELETE SET NULL
                               ON UPDATE SET NULL,
                           FOREIGN KEY(gender_id) REFERENCES genders(id)
                               ON DELETE SET NULL
                               ON UPDATE SET NULL,
                           CONSTRAINT UC_Employee UNIQUE (firstname,lastname)
);

insert into employees(id, firstname, lastname, salary, gender_id, department_id)
values (null, 'Peter', 'Panne', 3500, 2, 1),
       (null, 'Freya', 'Riding', 2450.3, 1, 2),
       (null, 'Michael', 'Lawson', 3550.00, 2, 3),
       (null, 'Lindsay', 'Ferguson', 4700.00, 1, 4),
       (null, 'Tobias', 'Funke', 2350.00, 2, 2),
       (null, 'Byron', 'Fields', 5000.00, 2, 1),
       (null, 'George', 'Edwards', 9050.00, 2, 4),
       (null, 'Rachel', 'Howell', 2750.00, 1, 3),
       (null, 'Celia', 'Hunter', 5650.00, 1, 7),
       (null, 'Samara', 'Garrett', 4600.00, 1, 7),
       (null, 'Carlos', 'Cain', 6600.00, 2, 7),
       (null, 'Lia', 'Walls', 3750.00, 1, 8);

SELECT employees.id, gender FROM employees LEFT JOIN genders g on g.id = employees.gender_id
                            GROUP BY g.id;

SELECT e.id, gender FROM genders LEFT JOIN employees e on e.gender_id = genders.id
                            GROUP BY genders.id;

SELECT employees.id, firstname, lastname, salary, gender, department_id FROM employees
    JOIN genders g on g.id = employees.gender_id
    AND employees.id = 8
GROUP BY employees.id


