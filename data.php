<?php

session_start();

$movies = json_decode(file_get_contents('movies.json'), 1); // add a 1 here, cause we want a associ array. without 1, the json_decode function will convert the content to object. 

if (isset($_SESSION["movies"])) {
  $movies = $_SESSION["movies"];
} else {
  $_SESSION["movies"] = $movies;
}

$genres = [
  'Fantasy',
  'Sci-Fi',
  'Action',
  'Comedy',
  'Drama',
  'Horror',
  'Romance',
  'Family',
];
