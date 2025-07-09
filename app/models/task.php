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

    public function create($user_id, $title, $description)
    {
        $db = getConnection();
        $stmt = $db->prepare("INSERT INTO tasks (user_id, title, description) VALUES (?, ?, ?)");
        return $stmt->execute([$user_id, $title, $description]);
    }
    
    public function delete($task_id, $user_id)
    {
        $db = getConnection();
        $stmt = $db->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
        return $stmt->execute( [$task_id, $user_id]);
    }

    public function update($task_id, $user_id, $title, $description)
    {
        $db = getConnection();
        $stmt = $db->prepare("UPDATE task SET title = ?, decription = ? WHERE id = ? and user_id = ?");
        return $stmt->execute([$title, $description, $task_id, $user_id]);
    }
}
