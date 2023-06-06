<?php
  require "data.php";
  require "functions.php";

  if (isset($_GET['search'])) {
    $movies = searchMovies($_GET['search']);
  } else {
    $movies = getMovies();
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
