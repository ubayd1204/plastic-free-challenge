<?php
$conn = mysqli_connect("localhost", "root", "", "plastic_free_db");

if (!$conn) {
    die("Database connection failed");
}
