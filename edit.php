<?php
  require "data.php";
  require "functions.php";

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $movie = sanitize($_POST);
    $errors = validate($movie);
    
    if (count($errors) === 0) {
      $movie_id = updateMovie($movie);
      
      header("Location: movie.php?id=" . $movie_id);
    }
  } else if (isset($_GET['id'])) {
    $movie = getMovie($_GET['id']);
    
    if (!$movie) {
      // go back to index.php
      header("Location: index.php");
    }
  } else {
    header("Location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Movie</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main class="main">
    <?php require "header.php"; ?>
    <h2 class="form-title">Edit Movie</h2>
    <form class="form" method="post">
      <input type="hidden" name="movie_id" value="<?php echo $movie['movie_id']; ?>">
      <?php require "inputs.php"; ?>
      <button type="submit" class="button">Update Movie</button>
    </form>

    <form class="form" action="delete.php" method="post">
      <input type="hidden" name="movie_id" value="<?php echo $movie['movie_id']; ?>">
      <button type="submit" class="button danger">Delete Movie</button>
    </form>
  </main>
</body>
</html>