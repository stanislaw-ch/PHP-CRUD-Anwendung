drop database if exists firma;
use firma;
# create table employee (
#                           id int primary key auto_increment,
#                           firstname varchar(45) not null,
#                           surname varchar(45) not null,
#                           salary  double not null,
#                           isIntern bool not null
# );
#
#
# insert into employee(id, firstname, surname, salary, isIntern)
# values (null, 'Peter', 'Panne', 3500, true);
#
# insert into employee(id, firstname, surname, salary, isIntern)
# values (null, 'Alex', 'Panne', 5500, false);
#
# update employee set firstname = 'Patrizia' where id = 1;
#
# DELETE FROM employee WHERE id = 2;
#
# select * from employee;
# describe employee;

create table departments (
 id int primary key auto_increment,
 name varchar(45) not null
);

insert into departments(id, name)
values (null, 'Berlin-Brandenburg');

select * from departments;

# create table employee (
#                           id int primary key auto_increment,
#                           firstname varchar(45) not null,
#                           surname varchar(45) not null,
#                           salary  double not null,
#                           isIntern bool not null
# );
#
#
# insert into employee(id, firstname, surname, salary, isIntern)
# values (null, 'Peter', 'Panne', 3500, true);
#
# insert into employee(id, firstname, surname, salary, isIntern)
# values (null, 'Alex', 'Panne', 5500, false);