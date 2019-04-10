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

    
}