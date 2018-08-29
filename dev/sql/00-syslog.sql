CREATE USER 'dev'@'localhost' IDENTIFIED BY 'developer01';
GRANT ALL PRIVILEGES ON *.* TO 'dev'@'localhost';
FLUSH PRIVILEGES;
CREATE DATABASE syslog;
GRANT ALL PRIVILEGES ON syslog.* TO 'dev'@'localhost';
FLUSH PRIVILEGES;

