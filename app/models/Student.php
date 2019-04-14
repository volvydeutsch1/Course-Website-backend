<?php
class Student {
    private $db;

    public function __construct() {

        $this->db = new Database;
    }

    // add new submission
    public function addSubmission($data) {
        $this->db->query("INSERT INTO submissions (studentid, assignmentid, datesubmitted, text) VALUES(:studentid, :assignmentid, CURRENT_TIMESTAMP, :text)");
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
        $this->db->query("SELECT * FROM teachers t, assignments a LEFT JOIN (SELECT grade, assignmentid, DATE_FORMAT(s.datesubmitted, '%b %d %Y  -  %h:%i %p') AS datesubmitted FROM submissions s WHERE s.studentid = :id) AS n ON a.id = n.assignmentid where a.teacherid = t.id");
        // Bind values
        $this->db->bind(':id', $id);

        return $this->db->resultSet();
    }

    // add new AnnouncementRead
    public function addAnnouncementRead($data) {
        $this->db->query("INSERT INTO announcements_read (studentid, announcementid, date) VALUES(:studentid, :announcementid, CURRENT_DATE)");
        // Bind values
        $this->db->bind(':studentid', $data['studentid']);
        $this->db->bind(':announcementid', $data['announcementid']);

        // execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }


}