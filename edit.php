<?php
  require "data.php";
  require "function.php";


  // you can is isset post to check, or use this to check if a form has been submit
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    updateMovie($_POST);

    header("Location: movie.php?id=" . $_POST['movie_id']);
  }


  if (isset($_GET['id'])) {
    $movie = getMovie($_GET['id']);

    if (!$movie) {
      // go back to movie.php
      header("Location: movie.php");
    }
  } else {
    header("Location: movie.php");
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
      <input 
          type="hidden"
          name="movie_id"
          value="<?php echo $movie['movie_id']; ?>"> <!--check with video -->
      <input 
        type="text" 
        class="form-control" 
        name="movie_title" 
        placeholder="movie title" 
        required 
        value="<?php echo $movie['movie_title']; ?>">
      <div class="error text-danger"></div>
      <input 
        type="text" 
        class="form-control" 
        name="director" 
        placeholder="Director" 
        required
        value="<?php echo $movie['director']; ?>">
      <div class="error text-danger"></div>
      <input 
        type="number" 
        class="form-control" 
        name="year" 
        placeholder="Year" 
        required
        value="<?php echo $movie['year']; ?>">
      <div class="error text-danger"></div>
      <select class="form-select" name="genre">
        <option value="">Select a Genre</option>
        <?php foreach ($genres as $genre) : ?>
        <option value="<?php echo $genre; ?>"
        <?php if ($genre == $movie['genre']) : ?> selected <?php endif; ?>>
          <?php echo $genre; ?>
        </option>
        <?php endforeach; ?>
      </select>
      <div class="error text-danger"></div>
      <button type="submit" class="button">Update Movie</button>
    </form>

    <form method="post" action="delete.php">
          <input
          type="hidden"
          name="movie_id"
          value="<?php echo $movie['movie_id']; ?>">
          <button type="submit" class="button danger">delete</button>
    </form>
  </main>
</body>
</html>