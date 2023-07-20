<?php

class Join {
    protected $host = 'localhost';
    protected $dbnm = 'school_management_system';
    protected $user = 'root';
    protected $pass = '';

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbnm", $this->user, $this->pass);
        } catch(PDOException $e) {
            echo 'Terjadi Galat :' . $e->getMassage();
        }
    }

    public function q($query) {
        $store = $this->conn->prepare($query);
        $store->execute();
        $data = $store->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}

$x = new Join;
$db = $x->q("SELECT student_jurusans.users_id,users.name FROM student_jurusans INNER JOIN users ON student_jurusans.users_id=users.id");
var_dump($db);


// $db=q("select xxxx");
// var_dump($db);