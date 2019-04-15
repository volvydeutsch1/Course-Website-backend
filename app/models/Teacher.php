<?php
class Teacher {
    private $db;

    public function __construct() {

        $this->db = new Database;
    }

    // add new announcement
    public function addAnnouncement($data) {
        $this->db->query("INSERT INTO announcements (teacherid, date, body) VALUES(:teacherid, current_timestamp, :body)");
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

    // update announcement
    public function updateAnnouncement($data) {
        $this->db->query("UPDATE announcements set teacherid = :teacherid, date = CURRENT_DATE, body = :body WHERE id = :id");
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':teacherid', $data['teacherid']);
        $this->db->bind(':body', $data['body']);

        // execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    // delete announcement
    public function deleteAnnouncement($id) {
        $this->db->query("DELETE FROM announcements WHERE id = :id");
        // bind param
        $this->db->bind(':id', $id);

        // execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    // add new assignment
    public function addAssignment($data) {
        $this->db->query("INSERT INTO assignments (teacherid, subject, releasedate, duedate, body) VALUES(:teacherid, :subject, :releasedate, :duedate, :body)");
        // Bind values
        $this->db->bind(':teacherid', $data['teacherid']);
        $this->db->bind(':subject', $data['subject']);
        $this->db->bind(':releasedate', $data['releasedate']);
        $this->db->bind(':duedate', $data['duedate']);
        $this->db->bind(':body', $data['body']);

        // execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    // update assignment
    public function updateAssignment($data) {
        $this->db->query("UPDATE assignments SET teacherid = :teacherid, subject = :subject, releasedate = :releasedate, duedate = :duedate, body = :body WHERE id = :id");
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':teacherid', $data['teacherid']);
        $this->db->bind(':subject', $data['subject']);
        $this->db->bind(':releasedate', $data['releasedate']);
        $this->db->bind(':duedate', $data['duedate']);
        $this->db->bind(':body', $data['body']);

        // execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }


    // delete announcement 
    public function deleteAssignment($id) {
        $this->db->query("DELETE FROM assignments WHERE id = :id");
        // bind param
        $this->db->bind(':id', $id);

        // execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }


    // list of assignments by TeacherID
    public function listAssignments($id) {
        $this->db->query("SELECT * FROM assignments WHERE teacherid = :id");
        // Bind values
        $this->db->bind(':id', $id);


        return $this->db->resultSet();
    }


    // list of student submissions for AssignmentID
    public function listSubmissions($id) {
        $this->db->query("SELECT * FROM students st LEFT JOIN (SELECT * FROM submissions s WHERE s.assignmentid = :id) AS n ON st.id = n.studentid ORDER BY st.name");

        // Bind values
        $this->db->bind(':id', $id);

        return $this->db->resultSet();
    }


    // update submission grade
    public function updateSubmission($data) {
        $this->db->query("UPDATE submissions set grade = :grade WHERE id = :id");
        // Bind values
        $this->db->bind(':grade', $data['grade']);
        $this->db->bind(':id', $data['id']);
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }

    }
}