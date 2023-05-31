-- Active: 1667564824134@@127.0.0.1@3306
Create DATABASE hw1;
USE hw1;

CREATE TABLE users (
    id integer primary key auto_increment,
    username varchar(16) not null unique,
    password varchar(255) not null,
    email varchar(255) not null unique,
    name varchar(255) not null,
    surname varchar(255) not null,
    propic varchar(255)
);
CREATE TABLE prenotazioni (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_utente INT NOT NULL,
    data_prenotazione DATE NOT NULL,
    ora_prenotazione TIME NOT NULL
    -- CHECK (
    --     (WEEKDAY(data_prenotazione) % 2 = 1 AND
    --      (ora_prenotazione >= '10:00' AND ora_prenotazione <= '13:00' OR 
    --       ora_prenotazione >= '15:00' AND ora_prenotazione <= '21:00'))
    --     OR
    --     (WEEKDAY(data_prenotazione) % 2 = 0 AND
    --      (ora_prenotazione >= '12:00' AND ora_prenotazione <= '14:00' OR 
    --       ora_prenotazione >= '17:00' AND ora_prenotazione <= '21:00'))
    -- )
);


CREATE TABLE likes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    exercise VARCHAR(255) UNIQUE,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

DROP TABLE likes;
DROP TABLE prenotazioni;
DROP TABLE users;


