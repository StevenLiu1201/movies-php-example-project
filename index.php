<?php
  require "data.php";

  if (isset($_POST['movie_title'])) {
    array_push($movies, [
      'movie_id' => end($movies)['movie_id'] + 1,
      'movie_title' => $_POST['movie_title'],
      'director' => $_POST['director'],
      'year' => $_POST['year'],
      'genre' => $_POST['genre']
    ]);

    $_SESSION['movies'] = $movies;
  }

  if (isset($_GET['search'])) {
    $movies = array_filter($movies, function ($movie) {
      return strpos(strtolower($movie['movie_title']), strtolower($_GET['search'])) !== false;
    });
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movies</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main class="main">
    <?php require "header.php"; ?>
    <form class="form">
      <input type="search" class="form-control" name="search" placeholder="Search">
    </form>
    <section class="movies">
      <?php foreach ($movies as $movie) : ?>
      <a class="movie" href="movie.php?id=<?php echo $movie['movie_id']; ?>"><?php echo $movie['movie_title']; ?></a>
      <?php endforeach; ?>
    </section>
  </main>
</body>
</html>
