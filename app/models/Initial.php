<?php
class Initial {
    private $db;

    public function __construct() {

        $this->db = new Database;
    }

    // retrieve all announcements with newest to oldest
    public function getAnnouncements() {
        $this->db->query("SELECT t.name, DATE_FORMAT(a.date, '%b %d %Y %h:%i %p') AS date, a.id, a.body FROM announcements a, teachers t WHERE a.teacherid = t.id ORDER BY date DESC");

        return $this->db->resultSet();
    }

    // register new account
    public function register($data){

        if($data['accountType'] == 'student') {
            $table = 'students';
        }elseif($data['accountType'] == 'teacher') {
            $table = 'teachers';
        }else {
            return;
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $this->db->query("INSERT INTO " . $table . " (name, password) VALUES(:name, :password)");

        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':password', $data['password']);

        // Execute
        if ($this->db->execute()) {
            // return the new teacher / student ID
            $this->db->query("SELECT * FROM " . $table . " WHERE name = :name AND password = :password ORDER BY id DESC LIMIT 1");
            // Bind values
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':password', $data['password']);
            $row = $this->db->single();
            return $row->id;
        } else {
            return false;
        }
    }


    // login
    public function login($data){

        if($data['accountType'] == 'student' || $data['accountType'] == 'teacher') {
            $account_type_table = $data['accountType'] . "s";

            $this->db->query("SELECT * FROM $account_type_table WHERE id = :id");

            // Bind values
            $this->db->bind(':id', $data['id']);

            $row = $this->db->single();
            if ($row) {
                $password = $data['password'];
                $hashed_password = $row->password;
                if (password_verify($password, $hashed_password)) {
                    return $row;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }else {
            return false;
        }
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