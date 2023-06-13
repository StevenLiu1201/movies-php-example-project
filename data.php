<?php 
  $dsn = 'mysql:host=localhost;dbname=movie_mayhem';
  $username = 'root';
  $password = 'root';

  try {
    $db = new PDO($dsn, $username, $password);
  } catch (PDOException $e) {
    $error = $e->getMessage();
    echo $error;
  }

  $sql = 'SELECT * FROM genres';
  $result = $db->query($sql);
  $genres = $result->fetchAll(PDO::FETCH_COLUMN, 1);