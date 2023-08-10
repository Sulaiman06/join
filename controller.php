<?php
require_once 'connect.php';

function search() {
    $search = '%' . $_POST['keyword'] . '%';

    $db = q("SELECT student_jurusans.users_id,users.name,student_groups.name AS jurusan,student_jurusans.student_groups_id FROM student_jurusans INNER JOIN users ON student_jurusans.users_id=users.id INNER JOIN student_groups ON student_jurusans.student_groups_id=student_groups.id WHERE users.name LIKE '$search' ORDER BY users.name");
    
    echo json_encode($db);
}

function page($page) {
    $dataperpage = 5;
    $from = ($dataperpage * $page) - $dataperpage;

    $db = q("SELECT student_jurusans.users_id,users.name,student_groups.name AS jurusan,student_jurusans.student_groups_id FROM student_jurusans INNER JOIN users ON student_jurusans.users_id=users.id INNER JOIN student_groups ON student_jurusans.student_groups_id=student_groups.id ORDER BY users.name LIMIT $from,$dataperpage");

    echo json_encode($db);
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

if(isset($_POST['keyword'])) {
    search();
}

if(isset($_GET['page'])) {
    $page = $_GET['page'];
    page($page);
}