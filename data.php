<?php

$servername = "localhost";
$username   = "sepp";
$password   = "seppderdepp";
$dbname     = "wall_clock";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "hello...? ";
}

