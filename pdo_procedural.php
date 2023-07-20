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

$db = q("SELECT student_jurusans.users_id,users.name,student_groups.name AS jurusan FROM student_jurusans INNER JOIN users ON student_jurusans.users_id=users.id INNER JOIN student_groups ON student_jurusans.student_groups_id=student_groups.id WHERE users.name LIKE '$search' ORDER BY users.id LIMIT $from,$dataperpage");

function pre($db) {
    echo "<pre>" . print_r($db,1) . "</pre>";
}
// pre($db);

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
            <td><?= $data['name']; ?></td>
            <td><?= $data['jurusan']; ?></td>
            <form action="" method="GET">
                <input type="hidden" name="id" value="<?= $id ?>">
            <td><button onclick="edit()">Edit</button></td>
            </form>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php for($i;$i <= $countpage;$i++) : ?>
        <a href="?page=<?= $i; ?>"><?= $i ?></a>
    <?php endfor; ?>

    <?php 
        $users_id = $_GET['id'];
        $show = q("SELECT student_jurusans.users_id,users.name,student_groups.name AS jurusan FROM student_jurusans INNER JOIN users ON student_jurusans.users_id=users.id INNER JOIN student_groups ON student_jurusans.student_groups_id=student_groups.id WHERE users.id=$users_id"); 
    ?>

    <div style="display: none;" id="edit">
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input name="name" type="text" value="<?= $show[0]['name']; ?>">
            <select name="groups">
                <option value selected disabled>Jurusan</option>
                <option value="1">Programmer</option>
                <option value="2">Multimedia</option>
                <option value="3">Marketing</option>
            </select>
            <button name="submit">Save</button>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>