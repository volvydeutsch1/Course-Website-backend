<?php
class Student {
    private $db;

    public function __construct() {

        $this->db = new Database;
    }

    // register student
    public function register($data){
        $this->db->query('INSERT INTO students (name, password) VALUES(:name, :password)');
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':password', $data['password']);

        // Execute
        if($this->db->execute()){
            // return the new studentID
            $this->db->query('SELECT * FROM students WHERE name = :name AND password = :password');
            // Bind values
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':password', $data['password']);
            $row = $this->db->single();
            return $row->id;
        } else {
            return false;
        }
    }


    // student login
    public function login($data){
        $this->db->query('SELECT * FROM students WHERE id = :id AND password = :password');

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


    // add new submission
    public function addSubmission($data) {
        $this->db->query("INSERT INTO submissions (studentid, assignmentid, datesubmitted, text) VALUES(:studentid, :assignmentid, CURRENT_DATE, :text)");
        // Bind values
        $this->db->bind(':studentid', $data['studentid']);
        $this->db->bind(':assignmentid', $data['assignmentid']);
        $this->db->bind(':text', $data['text']);

        // execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    
    public function listAssignments($id) {
        $this->db->query("SELECT * FROM assignments a LEFT JOIN (SELECT * FROM submissions s WHERE s.studentid = :id) AS n ON a.id = n.assignmentid");
        // Bind values
        $this->db->bind(':id', $id);

        return $this->db->resultSet();
    }

    
}