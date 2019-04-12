<?php
class Initial {
    private $db;

    public function __construct() {

    $this->db = new Database;
    }

    // retrieve all announcements with newest to oldest
    public function getAnnouncements() {
        $this->db->query("SELECT t.name, DATE_FORMAT(a.date, '%b %d %Y') AS date, a.body FROM announcements a, teachers t WHERE a.teacherid = t.id ORDER BY date DESC");

        return $this->db->resultSet();
    }

    public function setToken($id, $type) {
        // try creating random token else throw error
        $token = bin2hex(random_bytes(32));
        $this->db->query('INSERT INTO auth(token, student_id, teacher_id) VALUES (:token, :studentID, :teacherID)');
        $this->db->bind(':token', $token);
        // checks if teacher or student to assign right foreign key
        switch ($type){
            case 'teacher':
                $this->db->bind(':studentID', null);
                $this->db->bind(':teacherID', $id);
                break;
            case 'student':
                $this->db->bind(':studentID', $id);
                $this->db->bind(':teacherID', null);
        }
        // inserts token to database, return token on success or false on failure
        if ($this->db->execute()){
            return $token;
        }else{
            return false;
        }
    }

    public function verifyToken($token) {
        $this->db->query('SELECT * FROM auth WHERE token = :token');

        // Bind values
        $this->db->bind(':token', $token);

        $row = $this->db->single();
        return $row;

    }

    public function clearToken($token) {
        $this->db->query('DELETE FROM auth WHERE token = :token');

        // Bind values
        $this->db->bind(':token', $token);

        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}