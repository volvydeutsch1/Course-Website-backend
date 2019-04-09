<?php
class Initial {
    private $db;

    public function __construct() {

    $this->db = new Database;
    }

    // retrieve all announcements with  newest to oldest
    public function getAnnouncements() {
        $this->db->query("SELECT * FROM announcements a, teachers t WHERE a.teacherid = t.id ORDER BY date DESC");

        return $this->db->resultSet();
    }

    // add new announcement
    public function addAnnouncement($data) {
        $this->db->query("INSERT INTO announcements (teacherid, [date], body) VALUES(:teacherid, CURRENT_DATE, :body)");
        // Bind values
        $this->db->bind(':teacherid', $data['teacherid']);
        $this->db->bind(':body', $data['body']);

        // execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
    
    // delete announcement row for the announcement id
    public function deleteAnnouncement($id) {
        $this->db-query("DELETE FROM announcements WHERE id = :id");
        // bind param
        $this->db->bind(':id', $id);

        // execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}