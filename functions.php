<?php
// functions.php

// Initialize session if not started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Function to add an anime
function addAnime($title, $genre, $price_per_day) {
    $new_id = count($_SESSION['animes']) + 1;
    $_SESSION['animes'][] = [
        'id' => $new_id,
        'title' => $title,
        'genre' => $genre,
        'price_per_day' => $price_per_day
    ];
}

// Function to get all animes
function getAnimes() {
    return $_SESSION['animes'];
}

// Function to get a single anime by ID
function getAnimeById($id) {
    foreach ($_SESSION['animes'] as $anime) {
        if ($anime['id'] == $id) {
            return $anime;
        }
    }
    return null;
}

// Function to edit an anime
function editAnime($id, $title, $genre, $price_per_day) {
    foreach ($_SESSION['animes'] as $key => $anime) {
        if ($anime['id'] == $id) {
            $_SESSION['animes'][$key] = [
                'id' => $id,
                'title' => $title,
                'genre' => $genre,
                'price_per_day' => $price_per_day
            ];
            break;
        }
    }
}

// Function to delete an anime
function deleteAnime($id) {
    foreach ($_SESSION['animes'] as $key => $anime) {
        if ($anime['id'] == $id) {
            unset($_SESSION['animes'][$key]);
            $_SESSION['animes'] = array_values($_SESSION['animes']); // Re-index array after unsetting
            break;
        }
    }
}
?>

