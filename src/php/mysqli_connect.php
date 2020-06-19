<?php

// Set the database access information as constants:
DEFINE('DB_USER', 'user');
DEFINE('DB_PASSWORD', 'user');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'test_oneoff');

// Make the connection:
$link = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die('Could not connect to MySQL: ' . mysqli_connect_error());

// Set the encoding...
mysqli_set_charset($link, 'utf8');
