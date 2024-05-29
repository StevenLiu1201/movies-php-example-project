<?php
require "data.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // delete movie

    $index = array_key_first(array_filter($movies, function ($movie) {
        return $movie['movie_id'] == $_POST['movie_id'];
    }));

    unset($movies[$index]);
    $_SESSION['movies'] = $movies;
}

header("Location: index.php");
