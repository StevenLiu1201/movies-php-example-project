<?php
//  session_start();

//  $movies = json_decode(file_get_contents('movies.json'), 1);

//  if (isset($_SESSION['movies'])) {
//   $movies = $_SESSION['movies'];
//  } else {
//   $_SESSION['movies'] = $movies;
//  }

//  $genres = [
//   'Fantasy',
//   'Sci-Fi',
//   'Action',
//   'Comedy',
//   'Drama',
//   'Horror',
//   'Romance',
//   'Family',
// ];
$dsn = 'mysql:host=localhost;dbname=movie_mayhem';
$user = 'root';
$pass = 'root';
try {
  $db = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
  echo $e->getMessage() . "<br/>";
  exit();
}


$sql = "select * from genres";
$result = $db->query($sql);
$genres = $result->fetchAll(PDO::FETCH_COLUMN,1); // only return the second column form the table ( which is only the genres name)