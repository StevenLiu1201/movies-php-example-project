<?php
require "data.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Movie</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main class="main">
    <?php require "header.php"; ?>
    <h2 class="form-title">New Movie</h2>
    <form class="form" action="index.php" method="post">
      <input type="text" class="form-control" name="movie_title" placeholder="Movie Title" required>
      <input type="text" class="form-control" name="director" placeholder="Director" required>
      <input type="number" class="form-control" name="year" placeholder="Year" required>
      <select class="form-select" name="genre_id">
        <option value="">Select a Genre</option>
        <?php foreach($genres as $genre) : ?>
        <option value="<?php echo $genre; ?>"><?php echo $genre; ?></option>
        <?php endforeach; ?>
      </select>
      <button type="submit" class="button">Add Movie</button>
    </form>
  </main>
</body>
</html>