drop database if exists firma;
create database firma;
use firma;
create table departments (
                             id int primary key auto_increment,
                             name varchar(45) not null

);

insert into departments(id, name)
values (null, 'Produktion'),
       (null, 'Personalwesen'),
       (null, 'Marketing'),
       (null, 'Kundendienst');

select * from departments;

create table employees (
                           id int primary key auto_increment,
                           firstname varchar(45) not null,
                           lastname varchar(45) not null,
                           gender varchar(10) not null,
                           salary  double not null,
                           department_id int,
                           FOREIGN KEY(department_id) REFERENCES departments(id)
                            ON DELETE SET NULL
                            ON UPDATE SET NULL
);


insert into employees(id, firstname, lastname, salary, gender, department_id)
values (null, 'Peter', 'Panne', 3500, 'männlich', 1),
       (null, 'Freya', 'Riding', 2450.3, 'weiblich', 2),
       (null, 'Michael', 'Lawson', 3550.00, 'männlich', 3),
       (null, 'Lindsay', 'Ferguson', 4700.00, 'weiblich', 4),
       (null, 'Tobias', 'Funke', 2350.00, 'männlich', 2),
       (null, 'Byron', 'Fields', 5000.00, 'männlich', 1),
       (null, 'George', 'Edwards', 9050.00, 'männlich', 4),
       (null, 'Rachel', 'Howell', 2750.00, 'weiblich', 3);

select * from employees;
