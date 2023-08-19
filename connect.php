<?php

$host = 'localhost';
$dbnm = 'school_management_system';
$user = 'root';
$pass = '';
$conn = new PDO("mysql:host=$host;dbname=$dbnm", $user, $pass);

function q($query) {
    global $conn;
    $store = $conn->prepare($query);
    $store->execute();
    $data = $store->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}