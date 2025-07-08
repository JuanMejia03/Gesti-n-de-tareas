<?php

require_once '../../config/database.php';

class Task
{
    public function getByUser($user_id)
    {
        $db = getConnection();
        $stml = $db->prepare("SELECT * FROM tasks WHERE user_id = ? ORDER BY created_at DESC");
        $stml->execute([$user_id]);
        return $stml->fetchAll(PDO::FETCH_ASSOC);
    }
}
