<?php

// session_start();

//Variabili d'ambiente
$percorso = '/Progetto_Settimana_11_PHP_MySql';

$config = [
    'mysql_host' => 'localhost',
    'mysql_user' => 'root',
    'mysql_password' => ''
];

$my_db = new mysqli(
    $config['mysql_host'],
    $config['mysql_user'],
    $config['mysql_password']
);

if ($my_db->connect_error) {
    die($my_db->connect_error);
} else {
    $sql = 'CREATE DATABASE IF NOT EXISTS gestione_libreria;';
    $my_db->query($sql);

    $my_db->query('USE gestione_libreria');

    $creazione_tabella_autori = "CREATE TABLE IF NOT EXISTS autori(
        id INT PRIMARY KEY AUTO_INCREMENT, 
        nome VARCHAR(500) NOT NULL,
        anno_nascita INT ,
        city VARCHAR(255)  
        )";
    $creazione_tabella_generi = "CREATE TABLE IF NOT EXISTS generi(
        id INT PRIMARY KEY, 
        genere VARCHAR(500) NOT NULL
        )";
    $creazione_tabella_libri = "CREATE TABLE IF NOT EXISTS libri(
        id INT PRIMARY KEY AUTO_INCREMENT,
        isbn BIGINT UNIQUE NOT NULL,
        titolo VARCHAR(500) NOT NULL,
        anno_pub INT NOT NULL,
        id_autore INT NOT NULL,
        id_genere INT NOT NULL,
        created_by_user_id INT NOT NULL,
        img_src VARCHAR(800),
        FOREIGN KEY (id_autore) REFERENCES autori(id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (id_genere) REFERENCES generi(id) ON DELETE CASCADE ON UPDATE CASCADE
        )";
    $creazione_tabella_users = "CREATE TABLE IF NOT EXISTS users(
                                id INT PRIMARY KEY AUTO_INCREMENT,
                                name VARCHAR(255) NOT NULL,
                                username VARCHAR(40) NOT NULL,
                                email VARCHAR(300) NOT NULL UNIQUE,
                                pwd VARCHAR(255) NOT NULL,
                                image_src VARCHAR(500)
                                )";

    $creazione_generi = "INSERT IGNORE INTO generi(id, genere) VALUES 
                        (1, 'Fiction'), 
                        (2, 'Non-Fiction'), 
                        (3, 'Fantasy'), 
                        (4, 'Mystery'), 
                        (5, 'Thriller')";

    $my_db->query($creazione_tabella_autori);
    $my_db->query($creazione_tabella_generi);
    $my_db->query($creazione_tabella_libri);
    $my_db->query($creazione_tabella_users);
    $my_db->query($creazione_generi);

};


function mysqltoarray($oggetto) {
    $result = [];
    if ($oggetto) { // Controllo se ci sono dei dati nella variabile $res
        while ($row = $oggetto->fetch_assoc()) { // Trasformo $res in un array associativo
            $result[] = $row; // estraggo ogni singola riga che leggo dal DB e la inserisco in un array
            //array_push($contacts, $row); // estraggo ogni singola riga che leggo dal DB e la inserisco in un array
        }
    }
    return $result;
}


//funzione per trasformare genere in ID
function getGenreId($genre) {
    $genreId = null; 
    
    switch ($genre) {
        case 'fiction':
            $genreId = 1;
            break;
        case 'non-fiction':
            $genreId = 2;
            break;
        case 'fantasy':
            $genreId = 3;
            break;
        case 'mystery':
            $genreId = 4;
            break;
        case 'thriller':
            $genreId = 5;
            break;
        default:
   
            break;
    }

    return $genreId;
}

/* $umberto = "INSERT INTO autori (nome) VALUES ('Umberto Eco')";
$my_db->query($umberto);
$Gabriel = "INSERT INTO autori (nome) VALUES ('Gabriel García Márquez')";
$my_db->query($Gabriel);
$Tolkien = "INSERT INTO autori (nome) VALUES ('J.R.R. Tolkien')";
$my_db->query($Tolkien);
$Orwell = "INSERT INTO autori (nome) VALUES ('George Orwell')";
$my_db->query($Orwell);
$Vladimir = "INSERT INTO autori (nome) VALUES ('Vladimir Nabokov')";
$my_db->query($Vladimir);


$books = "INSERT INTO libri (isbn, titolo, anno_pub, id_autore, id_genere, img_src) VALUES
(9788845292613, 'Il nome della rosa', 1980, 3, 4, 'https://m.media-amazon.com/images/I/61WOxzGgv5L._SL1498_.jpg'),
(9788804669095, 'Cent'anni di solitudine', 1967, 4, 1, 'https://m.media-amazon.com/images/I/81nxsT-8NWS._SL1500_.jpg'),
(9780007203543, 'Il Signore degli Anelli', 1954, 5, 3, 'https://m.media-amazon.com/images/I/61PQNxRVagL._SL1354_.jpg'),
(9780141187761, '1984', 1949, 6, 2, 'https://m.media-amazon.com/images/I/91wTb2PkiHL._SL1500_.jpg'),
(9780141182537, 'Lolita', 1955, 7, 5, 'https://m.media-amazon.com/images/I/81StK7GTdBL._SL1500_.jpg')";

$my_db->query($books); */



