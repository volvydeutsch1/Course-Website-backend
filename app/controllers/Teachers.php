<?php
class Teachers extends Controller {

    public function __construct(){

        // Sanitize POST data
        if(isset($_POST)){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        }

        $this->teachersModel = $this->model('Teacher');
        $this->initialModel = $this->model('Initial');

        $headers = getallheaders();

        // No Authorization header was sent
        if(!isset($headers['Authorization'])){
            // not logged in as teacher echo error message and exit
            $err_msg = ['error' => 'you are not logged in as a teacher'];
            $this->view($err_msg);
            exit;
        }

        $verified = $this->initialModel->verifyToken($headers['Authorization']);

        if($verified == false || $verified->teacher_id == false){
            // not logged in as teacher echo error message and exit
            $err_msg = ['error' => 'you are not logged in as a teacher'];
            $this->view($err_msg);
            exit;
        }
    }

    // add new announcement
    public function addAnnouncement() {

        $data = [
            'teacherid' => $_POST["teacherid"],
            'body' => trim($_POST['body'])
        ];

        // Set Data
        $data = $this->teachersModel->addAnnouncement($data);

        // Load result page api
        $this->view($data);
    }

    // update announcement
    public function updateAnnouncement() {

        $data = [
            'id' => $_POST["id"],
            'teacherid' => $_POST["teacherid"],
            'body' => $_POST['body']
        ];

        // Set Data
        $data = $this->teachersModel->updateAnnouncement($data);

        // Load result page api
        $this->view($data);
    }

    // delete announcement
    public function deleteAnnouncement() {

        $data = [
            'id' => $_POST['id']
        ];

        // Set Data
        $data = $this->teachersModel->deleteAnnouncement($data['id']);

        // Load result page api
        $this->view($data);

    }

    // add new assignment
    public function addAssignment() {

        $data =[
            'teacherid' => trim($_POST['teacherId']),
            'subject' => trim($_POST['subject']),
            'releasedate' => $_POST['releaseDate'],
            'duedate' => $_POST['dueDate'],
            'body' => trim($_POST['body'])
        ];

        // Set Data
        $res_data = $this->teachersModel->addAssignment($data);

        // Load result page api
        $this->view($res_data);

    }

    // update assignment
    public function updateAssignment() {

        $data =[
            'id' => $_POST['id'],
            'teacherid' => $_POST['teacherId'],
            'subject' => $_POST['subject'],
            'releasedate' => $_POST['releaseDate'],
            'duedate' => $_POST['dueDate'],
            'body' => $_POST['body']
        ];

        // Set Data
        $res_data = $this->teachersModel->updateAssignment($data);

        // Load result page api
        $this->view($res_data);

    }

    // delete assignment
    public function deleteAssignment() {

        $data = [
            'id' => $_POST['id']
        ];

        // Set Data
        $data = $this->teachersModel->deleteAssignment($data['id']);

        // Load result page api
        $this->view($data);

    }

    // list of assignments by TeacherID
    public function listAssignments() {

        $data = [
            'teacher_id' => $_POST['teacher_id']
        ];

        // Set Data
        $data = $this->teachersModel->listAssignments($data['teacher_id']);

        // Load result page api
        $this->view($data);

    }

    // list of student submissions for AssignmentID
    public function listSubmissions() {

        $data = [
            'assignment_id' => $_POST['assignment_id']
        ];

        // Set Data
        $data = $this->teachersModel->listSubmissions($data['assignment_id']);

        // Load result page api
        $this->view($data);

    }

    // update submission grade
    public function updateSubmission() {

        // Init data
        $data = [
            'id' => $_POST['id'],
            'grade' => trim($_POST['grade'])
        ];

        // Set Data
        $res_data = $this->teachersModel->updateSubmission($data);

        // Load homepage / announcements view (api)
        $this->view($res_data);

    }
}