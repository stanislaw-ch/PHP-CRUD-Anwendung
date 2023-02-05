# "PHP-CRUD-Anwendung"
Die praktische Aufgabe für OOP PHP Anwendung

Weblink: https://php-crud.na4u.ru

## Table of contents
- Overview
- Die Aufgabe
- Technologien

## Overview
![image](https://user-images.githubusercontent.com/57729597/216296368-409ffec0-909d-4d61-b041-472d55306edf.png)
------
![216296787-cf9c8185-0664-4fdd-8c2d-f9b5e54134e5](https://user-images.githubusercontent.com/57729597/216297703-36ff9417-b23d-4ffa-a8b2-6509c52eb47c.png)
------
![image](https://user-images.githubusercontent.com/57729597/216297007-e2659101-4306-4a32-89c2-be93400fa9b2.png)
## Die Aufgabe

Erstelle eine objektorientierte CRUD-Anwendung in der Mitarbeiter und Abteilungen enthalten sind.  
- Mitarbeiter bestehen aus id, geschlecht, vorname, nachname, monatslohn und abteilung_id.  
- Abteilungen bestehen aus id und name.  
- Die Persistenz soll durch eine db gewährleistet sein.  
- Auf die Tabelle mitarbeiter darf nur die Klasse Mitarbeiter zugreifen.  
- Auf die Tabelle abteilung darf nur die Klasse Abteilung zugreifen.  
- Es darf und soll aus den vorhandenen Projekten all das kopiert werden, was man hier gebrauchen kann.  
- Bei den Übergabevariablen soll ausser $action auch $area übergeben werden, damit die Anwendung weiß,  ob z.B. die Tabelle mitarbeiter oder die Tabelle abteilung gemeint ist für CRUD.    
  
Alle Variablen sollen auf englisch geschrieben werden:  
name firstName lastName salary, department_id Klassennamen: Employee, Department.  

Ferner soll eine Navigation eingebaut werden, damit man alle Funktionalitäten erreichen kann,  
es ist showRead 2 mal, und create 2 mal gemeint.

Zwischenaufgaben:
1. Kombination Vor- und Nachname muss Unique (einzigartig) sein
2. Monatslohn soll nur Zeichen enthalten, die als Zahl interpretiert werden können
3. SQL-Injection muss verhindert werden
4. Alle Felder dürfen nicht leer sein
5. Cross Site Scripting XSS z.B. <script>alert('123'); </script> in input-text-Feld

- ad 1: wenn Kombi vom user eingegeben wird : Warnmeldung: "gibts schon" auf showCreate bzw. showUpdate
        -> spaltenkombi firstName-lastName auf UNIQUE setzen
        -> Möglichkeit a: SQL-Fehlermeldung aus lesen: wenn UNIQUE drin steht, dann: $view showCreateUser
            plus Fehlermeldung
           Möglichkeit b: Abfrage db: gibt es schon firstname= and lastName= in der Tabelle employee,
           dann: $view showCreateUser plus Fehlermeldung
        -> was muss ich bei showUpdateEmployee beachten?
- ad 2, 5: es gibt in php sanitizer
- ad 3: (es gibt sanitizer und) prepared statements bei sql
- ad 4: Übergabeparameter überprüfen, wenn leer, muss user in showCreateEmployee neu eingeben plus Warnmeldung

## Technologien
The stack used for this project was:
- PHP
- SQL
- JavaScript
- HTML
- Tailwindcss
