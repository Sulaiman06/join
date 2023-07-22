<?php
require_once 'connect.php';

$page = $_GET['page'];
if(isset($_GET['page'])) {
    $_GET['page'];
} else {
    $page = 1;
}

if(isset($_GET['keyword'])) {
    $search = '%' . $_GET['keyword'] . '%';
} else {
    $search = '%%';
}
// echo $search;

$dataperpage = 5;

$from = ($dataperpage * $page) - $dataperpage;

$countdata = count(q("SELECT users.name FROM student_jurusans INNER JOIN users ON student_jurusans.users_id=users.id WHERE users.name LIKE '$search'"));

$countpage = ceil($countdata / $dataperpage);

$db = q("SELECT student_jurusans.users_id,users.name,student_groups.name AS jurusan,student_jurusans.student_groups_id FROM student_jurusans INNER JOIN users ON student_jurusans.users_id=users.id INNER JOIN student_groups ON student_jurusans.student_groups_id=student_groups.id WHERE users.name LIKE '$search' ORDER BY users.id LIMIT $from,$dataperpage");

function pre($db) {
    echo "<pre>" . print_r($db,1) . "</pre>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join</title>
</head>
<body>

    <form action="" method="GET">
        <input type="text" name="keyword">
        <button type="submit">Search</button>
    </form>

    <table border=1 cellpadding="10" cellspacing="0">
        <tr>
            <td>No.</td>
            <td>User ID</td>
            <td>Nama</td>
            <td>Jurusan</td>
            <td>Action</td>
        </tr>

        <?php
            $no = ($page * $dataperpage) - ($dataperpage - 1); 
            foreach($db as $data) : 
            $id = $data['users_id'];
        ?>

        <tr>
            <td><?= $no++ ?></td>
            <td><?= $id ?></td>
            <td id="user"><?= $data['name']; ?></td>
            <td id="jurusan"><?= $data['jurusan']; ?></td>
            <td><button onclick="edit('<?= $id ?>','<?= $data['name']; ?>','<?= $data['student_groups_id']; ?>')">Edit</button></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php for($i;$i <= $countpage;$i++) : ?>
        <a href="?page=<?= $i; ?>"><?= $i ?></a>
    <?php endfor; ?>
    <br><br>

    <?php 
        $users_id = $_GET['id'];
        $show = q("SELECT * FROM student_groups");
    ?>

    <input type="hidden" id="user-id">
    <input name="name" type="text" id="username">
    <select name="groups" id="group-select">
        <option selected disabled hidden>Jurusan</option>
      <?php foreach($show as $key => $value) :?>
        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
      <?php endforeach; ?>
    </select>
    <button onclick="update()" id="save">Save</button>

    <script src='script.js'></script>
</body>
</html>