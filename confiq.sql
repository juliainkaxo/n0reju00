-- Loin php tiedostot niin, että vaatii authorizationin myös silloin kun haluaa hakea omia tietoja.

-- Luo databasen
CREATE DATABASE n0reju00;


-- Luo user taulun
CREATE TABLE IF NOT EXISTS `user`(
    username varchar(50) NOT NULL,
    password varchar(150) NOT NULL,
    PRIMARY KEY (username)
    );


-- Luo info taulun
CREATE TABLE IF NOT EXISTS personal (
    username varchar(50) NOT NULL,
    fname varchar(50) NOT NULL,
    lname varchar(50) NOT NULL
    );