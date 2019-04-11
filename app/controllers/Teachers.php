<?php
class Teachers extends Controller{

    public function __construct(){
        $this->teachersModel = $this->model('Teacher');
    }

    public function index(){

    }

    public function register(){

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data = [
            'name' => trim($_POST['name']),
            'password' => trim($_POST['password'])
        ];

        // inserting data in database and getting back teachers id
        $id = ["id" => $this->teachersModel->register($data)];

        // Loading teachers id to view
        $this->view($id);
    }

    public function login(){

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
            'id' => trim($_POST['id']),
            'password' => trim($_POST['password'])
        ];

        // Getting back all info of teacher on success or false
        $teacher = $this->teachersModel->login($data);

        if($teacher){
            $_SESSION["teacher_id"] = $teacher->id;
            $_SESSION["teacher_name"] = $teacher->name;
            $this->view( ['accountType' => 'teacher', 'id' => $teacher->id, 'name' => $teacher->name] );
        }
    }

    public function logout(){
        unset($_SESSION["teacher_id"]);
        unset($_SESSION["teacher_name"]);
    }

    // add new announcement
    public function addAnnouncement() {
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
            'teacherid' => trim($_POST['teacherid']),
            'body' => trim($_POST['body'])
        ];
        // Set Data
        $data = $this->teachersModel->addAnnouncement($data);

        // Load homepage / announcements view (api)
        $this->view($data);
    }

    // delete announcement
    public function deleteAnnouncement($id) {

        // Set Data
        $data = $this->teachersModel->deleteAnnouncement($id);

        // Load homepage / announcements view (api)
        $this->view($data);
    }

    // add new assignment
    public function addAssignment() {
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
            'teacherid' => trim($_POST['teacherid']),
            'subject' => trim($_POST['subject']),
            'releasedate' => trim($_POST['releasedate']),
            'duedate' => trim($_POST['duedate']),
            'body' => trim($_POST['body'])
        ];
        // Set Data
        // Set Data
        $data = $this->teachersModel->addAssignment($data);

        // Load homepage / announcements view (api)
        $this->view($data);
    }

    // delete announcement
    public function deleteAssignment($id) {
        // Set Data
        $data = $this->teachersModel->deleteAssignment($id);

        // Load homepage / announcements view (api)
        $this->view($data);
    }

    // list of assignments by TeacherID
    public function listAssignments($id) {
        // Set Data
        $data = $this->teachersModel->listAssignments($id);

        // Load homepage / announcements view (api)
        $this->view($data);
    }

    // list of student submissions for AssignmentID
    public function listSubmissions($id) {
        // Set Data
        $data = $this->teachersModel->listSubmissions($id);

        // Load homepage / announcements view (api)
        $this->view($data);
    }

    // update submission grade
    public function updateSubmission($data) {
        // Set Data
        $data = $this->teachersModel->updateSubmission($data);

        // Load homepage / announcements view (api)
        $this->view($data);
    }
}