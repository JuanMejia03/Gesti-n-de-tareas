<?php 

require_once '../../config/database.php';

class User {
    public function getByUsername($username) {
        $db = getConnection();
        $stml = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stml->execute([$username]);
        return $stml->fetch(PDO::FETCH_ASSOC);
    }
}
?>