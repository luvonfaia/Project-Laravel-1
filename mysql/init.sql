DROP USER IF EXISTS  'root'@'localhost' ;
DROP USER IF EXISTS  'root'@'%' ;

CREATE USER 'root'@'%' IDENTIFIED BY 'root';
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;

ALTER USER `root`@`%` IDENTIFIED WITH mysql_native_password BY 'root';

FLUSH PRIVILEGES ;