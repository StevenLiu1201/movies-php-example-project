<?php
   require 'data.php';
   require 'functions.php';

   if (isset($_POST['movie_id'])) {
    deleteMovie($_POST['movie_id']);
   }
 
   header("Location: index.php");