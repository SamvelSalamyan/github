<?php
class Dbh {
    private $host = "localhost";
    private $user = "root";
    private $pwd = "";
    private $dbName = "register-bd";

    protected function connect() {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' .$this->dbName;
        $pdo = new PDO($dsn, $this->user, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}

class Test extends Dbh {

    public function getUsers() {
        $sql = "SELECT * FROM users ";
        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetch()){
             echo $row['name'];
        }
    }

    public function getUsersStmt($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $names = $stmt->fetchAll();
        foreach ($names as $name) {
            echo $name['name'];
        }
    }
}