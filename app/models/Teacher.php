<?php
class Teacher {
    private $db;

    public function __construct() {

        $this->db = new Database;
    }

    // register teacher
    public function register($data) {
        $this->db->query('INSERT INTO teachers (name, password) VALUES(:name, :password)');
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':password', $data['password']);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
    // teacher login
    public function login($data){
        $this->db->query('SELECT * FROM teachers WHERE id = :id AND password = :password');

        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':password', $data['password']);

        $row = $this->db->single();

        $password = $data['password'];
        $hashed_password = $row->password;
        if(password_verify($password, $hashed_password)){
            return $row;
        } else {
            return false;
        }
    }



public function listAssignments($id) {
    $this->db->query("SELECT * FROM assignments WHERE teacherid = :id");
    // Bind values
    $this->db->bind(':id', $id);


    return $this->db->resultSet();
}
}