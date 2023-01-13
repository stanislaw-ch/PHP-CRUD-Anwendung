drop database if exists firma;
create database firma;
use firma;
create table departments (
                             id int primary key auto_increment,
                             name varchar(45) not null

);

insert into departments(id, name)
values (null, 'Hamburg');

insert into departments(id, name)
values (null, 'Berlin');

select * from departments;

create table employees (
                           id int primary key auto_increment,
                           firstname varchar(45) not null,
                           lastname varchar(45) not null,
                           gender varchar(10) not null,
                           salary  double not null,
                           department_id int
);


insert into employees(id, firstname, lastname, salary, gender, department_id)
values (null, 'Peter', 'Panne', 3500, 'male', 1);

insert into employees(id, firstname, lastname, salary, gender, department_id)
values (null, 'Alina', 'Panne', 5500, 'female',2);

select * from employees;

ALTER TABLE employees ADD FOREIGN KEY(department_id) REFERENCES departments(id);