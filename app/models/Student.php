<?php
class Student {
    private $db;

    public function __construct() {

        $this->db = new Database;
    }


    // retrieve all announcements with newest to oldest for logged-in student with announcements_read (if applicable)
    public function getAnnouncements($id) {
        $this->db->query("SELECT t.name, DATE_FORMAT(a.date, '%b %d %Y %h:%i %p') AS date, a.id, a.body, n.date AS date_read FROM announcements a LEFT JOIN (SELECT * FROM announcements_read ar WHERE ar.studentid = :id) AS n ON a.id = n.announcementid, teachers t WHERE a.teacherid = t.id ORDER BY date DESC");
        // Bind values
        $this->db->bind(':id', $id);
        
        return $this->db->resultSet();
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