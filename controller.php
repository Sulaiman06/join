<?php
require_once 'connect.php';

function create() {
    //
}

function store() {
    //
}

function update() {
    $id = $_GET['user_id'];
    $username = $_GET['user'];
    $jurusan_id = $_GET['jurusan_id'];
    global $conn;

    $query = "UPDATE users,student_jurusans SET users.name = '$username',student_jurusans.student_groups_id = $jurusan_id WHERE student_jurusans.users_id = $id AND users.id = $id";
    $store = $conn->prepare($query);
    $store->execute();
}

function delete() {
    //
}

if(isset($_GET['func'])) {
    update();
}