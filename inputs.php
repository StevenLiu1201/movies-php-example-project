<input 
  type="text" 
  class="form-control" 
  name="movie_title" 
  placeholder="Movie Title"  
  value="<?php echo $movie['movie_title'] ?? ''; ?>">
<div class="error text-danger"><?php echo $errors['movie_title'] ?? ''; ?></div>
<input 
  type="text" 
  class="form-control" 
  name="director" 
  placeholder="Director" 
  required
  value="<?php echo $movie['director'] ?? ''; ?>">
<div class="error text-danger"><?php echo $errors['director'] ?? ''; ?></div>
<input 
  type="number" 
  class="form-control" 
  name="year" 
  placeholder="Year" 
  required
  value="<?php echo $movie['year'] ?? ''; ?>">
<div class="error"><?php echo $errors['year'] ?? ''; ?></div>
<select class="form-select" name="genre_title">
  <option value="">Select a Genre</option>
  <?php foreach ($genres as $genre) : ?>
  <option value="<?php echo $genre; ?>" 
    <?php if (isset($movie['genre_title']) && $genre === $movie['genre_title']) : ?> selected <?php endif; ?>>
    <?php echo $genre; ?>
  </option>
  <?php endforeach; ?>
</select>
<div class="error text-danger"><?php echo $errors['genre_title'] ?? ''; ?></div>