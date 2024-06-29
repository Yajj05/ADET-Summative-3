<?php
function addTask($title, $time, $date) {
    if (!isset($_SESSION['tasks'])) {
        $_SESSION['tasks'] = [];
    }
    $_SESSION['tasks'][] = ['title' => $title, 'time' => $time, 'date' => $date];
}

function editTask($index, $title, $time, $date) {
    if (isset($_SESSION['tasks'][$index])) {
        $_SESSION['tasks'][$index] = ['title' => $title, 'time' => $time, 'date' => $date];
    }
}

function deleteTask($index) {
    if (isset($_SESSION['tasks'][$index])) {
        array_splice($_SESSION['tasks'], $index, 1);
    }
}
?>
