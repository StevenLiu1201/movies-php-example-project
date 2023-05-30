<?php
  require "data.php";
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
        type="text" 
        class="form-control" 
        name="movie_title" 
        placeholder="Movie Title" 
        required 
        value="Labyrinth">
      <div class="error text-danger"></div>
      <input 
        type="text" 
        class="form-control" 
        name="director" 
        placeholder="Director" 
        required
        value="Jim Henson">
      <div class="error text-danger"></div>
      <input 
        type="number" 
        class="form-control" 
        name="year" 
        placeholder="Year" 
        required
        value="1986">
      <div class="error text-danger"></div>
      <select class="form-select" name="genre">
        <option value="">Select a Genre</option>
        <?php foreach ($genres as $genre) : ?>
        <option value="<?php echo $genre; ?>">
          <?php echo $genre; ?>
        </option>
        <?php endforeach; ?>
      </select>
      <div class="error text-danger"></div>
      <button type="submit" class="button">Update Movie</button>
    </form>
  </main>
</body>
</html>