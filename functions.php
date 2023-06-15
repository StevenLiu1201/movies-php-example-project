<?php
  function sanitize($data) {
    return array_map(function ($value) {
      return htmlspecialchars(stripslashes(trim($value)));
    }, $data);
  }

  // movie_title is required | fewer than 255 characters
  // director is required | characters and spaces only
  // year is required | numeric only
  // genre is required | must be in the list of genres
  function validate($movie) {
    $fields = ['movie_title', 'director', 'year', 'genre_title'];
    $errors = [];
    global $genres;

    foreach ($fields as $field) {
      switch ($field) {
        case 'movie_title':
          if (empty($movie[$field])) {
            $errors[$field] = 'Movie title is required';
          } else if (strlen($movie[$field]) > 255) {
            $errors[$field] = 'Movie title must be fewer than 255 characters';
          }
          break;
        case 'director':
          if (empty($movie[$field])) {
            $errors[$field] = 'Director is required';
          } else if (!preg_match('/^[a-zA-Z\s]+$/', $movie[$field])) {
            $errors[$field] = 'Director must contain only letters and spaces';
          }
          break;
        case 'year':
          if (empty($movie[$field])) {
            $errors[$field] = 'Year is required';
          } else if (filter_var($movie[$field], FILTER_VALIDATE_INT) === false) {
            $errors[$field] = 'Year must contain only numbers';
          }
          break;
        case 'genre_title':
          if (empty($movie[$field])) {
            $errors[$field] = 'Genre is required';
          } else if (!in_array($movie[$field], $genres)) {
            $errors[$field] = 'Genre must be in the list of genres';
          }
          break;
      }
    }


    return $errors;
  }

  // savePoster
  // process uploaded image for movie poster
  function savePoster ($movie_id) {
    // file data $_FILES['poster']
    $poster = $_FILES['poster'];

    if ($poster['error'] === UPLOAD_ERR_OK) {
      // get file extension
      $ext = pathinfo($poster['name'], PATHINFO_EXTENSION);
      $filename = $movie_id . '.' . $ext;

      if (!file_exists('posters/')) {
        mkdir('posters/');
      }

      $dest = 'posters/' . $filename;

      if (file_exists($dest)) {
        unlink($dest);
      }

      return move_uploaded_file($poster['tmp_name'], $dest);
    }

    return false;
  }

  function getMovies () {
    global $db;
    $sql = "SELECT * FROM movies";
    $result = $db->query($sql);
    $movies = $result->fetchAll(PDO::FETCH_ASSOC);
    return $movies;
  }

  function searchMovies ($search) {
    global $db;
    $sql = "SELECT * FROM movies WHERE movie_title LIKE :search";
    $stmt = $db->prepare($sql);
    $stmt->execute(['search' => '%' . $search . '%']);
    $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $movies;
  }

  function getMovie ($movie_id) {
    global $db;

    $sql = "SELECT * FROM movies JOIN genres ON movies.genre_id = genres.genre_id WHERE movie_id = :movie_id";
    $stmt = $db->prepare($sql);
    $stmt->execute(['movie_id' => $movie_id]);
    $movie = $stmt->fetch(PDO::FETCH_ASSOC);
    return $movie;
  }

  function addMovie ($movie) {
    global $db;
    global $genres;

    $genre_id = array_search($movie['genre_title'], $genres) + 1;

    $sql = "INSERT INTO movies (movie_title, director, year, genre_id) VALUES (:movie_title, :director, :year, :genre_id)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
      'movie_title' => $movie['movie_title'],
      'director' => $movie['director'],
      'year' => $movie['year'],
      'genre_id' => $genre_id
    ]);

    $movie_id = $db->lastInsertId();
    savePoster($movie_id);

    return $movie_id;
  }

  function updateMovie ($movie) {
    global $db;
    global $genres;

    $genre_id = array_search($movie['genre_title'], $genres) + 1;

    $sql = "UPDATE movies SET movie_title = :movie_title, director = :director, year = :year, genre_id = :genre_id WHERE movie_id = :movie_id";
    $stmt = $db->prepare($sql);
    $stmt->execute([
      'movie_title' => $movie['movie_title'],
      'director' => $movie['director'],
      'year' => $movie['year'],
      'genre_id' => $genre_id,
      'movie_id' => $movie['movie_id']
    ]);

    savePoster($movie['movie_id']);

    return $movie['movie_id'];
  }

  function deleteMovie ($movie_id) {
    global $db;
    $sql = "DELETE FROM movies WHERE movie_id = :movie_id";
    $stmt = $db->prepare($sql);
    $stmt->execute(['movie_id' => $movie_id]);
    
    return $stmt->rowCount();
  } 