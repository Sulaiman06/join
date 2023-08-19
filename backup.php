<?php
require_once 'connect.php';

$dataperpage = 5;
$countdata = count(q("SELECT users.name FROM student_jurusans INNER JOIN users ON student_jurusans.users_id=users.id"));
$countpage = ceil($countdata / $dataperpage);
$db = q("SELECT student_jurusans.users_id,users.name,student_groups.name AS jurusan,student_jurusans.student_groups_id FROM student_jurusans INNER JOIN users ON student_jurusans.users_id=users.id INNER JOIN student_groups ON student_jurusans.student_groups_id=student_groups.id ORDER BY users.name LIMIT 0,5");

function pre($array) {
    echo "<pre>" . print_r($array,1) . "</pre>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join</title>
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <link href="assets/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="assets/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="assets/startmin.css" rel="stylesheet">
</head>
<body>
    <div class="panel-body">
        <div class="table-responsive">
            <input type="text" placeholder="Search" id="search">
            <br><br>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <td>No.</td>
                    <td>User ID</td>
                    <td>Nama</td>
                    <td>Jurusan</td>
                    <td>Action</td>
                </thead>
                <tbody id="table">
                <?php
                    $no = (1 * $dataperpage) - ($dataperpage - 1);
                    foreach($db as $data) : 
                    $id = $data['users_id'];
                ?>

                <tr id="tr_<?= $id ?>">
                    <td><?= $no++ ?></td>
                    <td><?= $id ?></td>
                    <td class="nama"><?= $data['name']; ?></td>
                    <td class="jurusan" id_jurusan="<?= $data['student_groups_id'] ?>"><?= $data['jurusan']; ?></td>
                    <td><button onclick="edit('<?= $id ?>')">Edit</button></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php for($i = 1;$i <= $countpage;$i++) : ?>
        <button onclick="page('<?= $i; ?>','<?= $dataperpage; ?>')"><?= $i ?></button>
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
    <button onclick="update()">Save</button>
    
    <script src='main.js'></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/dataTables/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>
</body>
</html>