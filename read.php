<?php
require_once 'register.php';

class UserData {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUsers() {
        $stmt = $this->db->pdo->query("SELECT id, username, email FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$userData = new UserData($db);
$users = $userData->getUsers();

foreach ($users as $user) {
    echo "ID: " . $user['id'] . " - Username: " . $user['username'] . " - Email: " . $user['email'] . "<br>";
}
?>

