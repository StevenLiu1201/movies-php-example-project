<?php
require "data.php";


// retrieve a single movie
function getMovie($movie_id) { // don't know why can't use 'use' key word here
    global $movies;
    return current(array_filter($movies, function ($movie) {
        return $movie['movie_id'] == $_GET['id'];
      }));
}

// add a new movie
function addMovie($movie){
    global $movies;

    array_push($movies, [
        'movie_id' => end($movies)['movie_id'] + 1,
        'movie_title' => $movie['movie_title'],
        'director' => $movie['director'],
        'year' => $movie['year'],
        'genre' => $movie['genre']
      ]);
  
      $_SESSION['movies'] = $movies;
}


// update movie
function updateMovie($movie){
    global $movies;

    $new = [
        'movie_id' => $movie['movie_id'], 
        'movie_title' => $movie['movie_title'],
        'director' => $movie['director'],
        'year' => $movie['year'],
        'genre' => $movie['genre']
      ];
  
      $movies = array_map(function($movie) use ($new){
        
        if($movie['movie_id'] == $new['movie_id']){
          // return the new movie        
          return $new;
        }else{
          return $movie;
  
        }
      }, $movies);
  
      // update the session as well
      $_SESSION['movies'] = $movies;
}

//delete movie
function deleteMovie($movie_id){
    global $movies;

    $index = array_key_first(array_filter($movies, function ($movie) use ($movie_id) {
        return $movie['movie_id'] == $movie_id;
    }));

    unset($movies[$index]);
    $_SESSION['movies'] = $movies;
}

//sanitize function 
// clear the data of all unnecessary or dangrous charactors
// @param $data (array)
function sanitize($data){
    return array_map(function($value){
        // trim() remove white space
        // stripslashes remove slashes
        // himlspecialchars convert html into non-executable format

        return htmlspecialchars(stripslashes(trim($value)));
    },$data);
}

// validate
//movie_title is required | less than 255 charactors

//director is required | charactor and spaces only

//year is required | numetric only

//genre is required | must be pick from the list

function validate($movie){
    $fields = ['movie_title','director','year','genre'];
    $errors = [];

    global $genres;
    foreach($fields as $field){
        switch($field){
            case 'movie_title':
                if(empty($movie[$field])){
                    $errors[$field] = 'Movie title is required.';
                } elseif (strlen($movie[$field]) > 255){
                    $errors[$field] = 'Movie title should be less than 255 charactors.';
                }
                break;
            case 'director':
                if(empty($movie[$field])){
                    $errors[$field] = 'director is required.';
                } elseif(!preg_match("/^[a-zA-Z\s]+$/",$movie[$field])){
                    $errors[$field] = 'director charactor and spaces only .';

                }
                break;
            case 'year':
                if(empty($movie[$field])){
                    $errors[$field] = 'year is required.';
                } elseif(filter_var($movie[$field],FILTER_VALIDATE_INT) === false){
                    $errors[$field] = 'year only contain numetric..';

                }
                break;
            case 'genre':
                if(empty($movie[$field])){
                    $errors[$field] = 'genre is required.';
                } elseif(!in_array($movie[$field],$genres)){
                    $errors[$field] = 'genre must be in the list of genres';

                }
                break;
        }
    }

    return $errors;
}
