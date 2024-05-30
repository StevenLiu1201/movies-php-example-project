<?php
require "data.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // delete movie
    deleteMovie($_POST['movie_id']);
}

header("Location: index.php");
