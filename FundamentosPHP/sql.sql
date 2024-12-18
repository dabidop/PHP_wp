--Filtra por un valor de una columna 
SELECT * FROM tabla WHERE columna = valor;

--Devuelve uno de cada valor, no se repiten
SELECT DISTINCT Country FROM Customers;
SELECT DISTINCT age FROM users WHERE age = 15;


SELECT * FROM users ORDER BY age;
SELECT * FROM users ORDER BY age ASC;
SELECT * FROM users ORDER BY age DESC;

--En caso de tener dos personas o más con el mismo correo, claro
SELECT * FROM users WHERE email = 'dabidop@gmail.com' ORDER BY age DESC;


SELECT * FROM users WHERE email LIKE '%gmail.com';

SELECT * FROM users WHERE NOT email = 'dabidop@gmail.com';
SELECT * FROM users WHERE NOT email = 'dabidop@gmail.com' AND age = 15;
SELECT * FROM users WHERE NOT email = 'dabidop@gmail.com' OR age = 15 LIMIT 2;

SELECT * FROM users LIMIT 6;

SELECT * FROM users WHERE email IS NULL;
SELECT * FROM users WHERE email IS NOT NULL;
SELECT * FROM users WHERE email IS NOT NULL AND age = 15;

SELECT MAX(age) FROM users;
SELECT COUNT(age) FROM users;
--También valores nulos
SELECT COUNT(*) FROM users;


SELECT SUM(age) FROM users;
SELECT AVG(age) FROM users;

--Todos los Davids y todas las saras, no importan las mayúsculas
SELECT * FROM users WHERE name IN ('David', 'sara');

SELECT * FROM users WHERE age BETWEEN 15 AND 30;

SELECT name FROM users WHERE age BETWEEN 20 AND 30;

SELECT name, fecha AS 'fecha inicio de algo' FROM users WHERE name = 'David';

SELECT CONCAT (name, last_name) FROM users;
SELECT CONCAT ('Nombre: ', name, 'Apellido: ', last_name) AS 'Nombre completo' FROM users;

SELECT COUNT(age), age FROM users GROUP BY age;
SELECT COUNT(age), age FROM users WHERE age > 15 GROUP BY age ASC;

SELECT * FROM users HAVING age > 15; --MÁS PREGUNTAS

select *, CASE WHEN age > 17 THEN 'Es mayor de edad' ELSE 'Es menor de edad' END FROM users;

select *, CASE WHEN age > 17 THEN True ELSE False END AS 'Es mayor o menor de edad?' FROM users;

select *, CASE WHEN age > 17 THEN 'Es mayor de edad' WHEN age = 18 THEN 'Primer año de mayoría de edad'
ELSE 'Es menor de edad' END FROM users;

SELECT name, last_name, IFNULL (age, 0) FROM users;
SELECT name, last_name, IFNULL (age, 0) AS age FROM users;

INSERT INTO users (name, surname, age) VALUES ('David', 'Álvarez', 14);

UPDATE users SET age = 21 WHERE id_user = 3;

DELETE FROM users WHERE id_user = 4;
 
CREATE TABLE persona (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name VARCHAR NOT NULL,
    surname VARCHAR NOT NULL,
    age INT NOT NULL,
    email VARCHAR UNIQUE NOT NULL
)

SELECT * FROM users
INNER JOIN cedula
ON users.user_id = dni.user_id;


