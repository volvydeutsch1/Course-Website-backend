<?php
class Teachers extends Controller{

    public function __construct(){
        $this->teachersModel = $this->model('Teacher');
        $this->initialModel = $this->model('Initial');
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

        if ($teacher) {
            $token = $this->initialModel->setToken($teacher->id, "teacher");
            $this->view( ['token' => $token, 'accountType' => 'teacher', 'id' => $teacher->id, 'name' => $teacher->name] );
        }else{
            // $teacher returned false
            $err_msg = ['error' => 'Incorrect TeacherId/Password'];
            $this->view($err_msg);
        }
    }

    public function logout(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Delete token
        $token = $_POST['token'];
        $this->initialModel->clearToken($token);
    }

    // add new announcement
    public function addAnnouncement() {

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'token' => $_POST['token'],
            'teacherid' => $_SESSION["teacher_id"],
            'body' => trim($_POST['body'])
        ];

        // check if caller is logged in teacher
        $verified = $this->initialModel->verifyToken($data['token']);
        if($verified){
            // Set Data
            $data = $this->teachersModel->addAnnouncement($data);

            // Load homepage / announcements view (api)
            $this->view($data);
        }else{
            // not logged in as teacher
            $err_msg = ['error' => 'you are not logged in as a teacher'];
            $this->view($err_msg);
        }
    }

    // update announcement
    public function updateAnnouncement() {

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'token' => $_POST['token'],
            'id' => $_POST["id"],
            'teacherid' => $_POST["teacherid"],
            'body' => $_POST['body']
        ];

        // check if caller is logged in teacher
        $verified = $this->initialModel->verifyToken($data['token']);
        if($verified){
            // Set Data
            $data = $this->teachersModel->updateAnnouncement($data);

            // Load homepage / announcements view (api)
            $this->view($data);
        }else{
            // not logged in as teacher
            $err_msg = ['error' => 'you are not logged in as a teacher'];
            $this->view($err_msg);
        }
    }

    // delete announcement
    public function deleteAnnouncement($id) {

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Set token POST input
        $data = [
            'token' => $_POST['token']
        ];

        // check if caller is logged in teacher
        $verified = $this->initialModel->verifyToken($data['token']);
        if($verified){

            // Set Data
            $data = $this->teachersModel->deleteAnnouncement($id);

            // Load homepage / announcements view (api)
            $this->view($data);
        }else{
            // not logged in as teacher
            $err_msg = ['error' => 'you are not logged in as a teacher'];
            $this->view($err_msg);
        }

    }

    // add new assignment
    public function addAssignment() {

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
            'token' => $_POST['token'],
            'teacherid' => trim($_POST['teacherid']),
            'subject' => trim($_POST['subject']),
            'releasedate' => trim($_POST['releasedate']),
            'duedate' => trim($_POST['duedate']),
            'body' => trim($_POST['body'])
        ];

        // check if caller is logged in teacher
        $verified = $this->initialModel->verifyToken($data['token']);
        if($verified){
            // Set Data
            $res_data = $this->teachersModel->addAssignment($data);

            // Load homepage / announcements view (api)
            $this->view($res_data);
        }else{
            // not logged in as teacher
            $err_msg = ['error' => 'you are not logged in as a teacher'];
            $this->view($err_msg);
        }

    }

    // update assignment
    public function updateAssignment() {

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
            'token' => $_POST['token'],
            'id' => $_POST['id'],
            'teacherid' => $_POST['assignmentid'],
            'subject' => $_POST['subject'],
            'releasedate' => $_POST['releasedate'],
            'duedate' => $_POST['duedate'],
            'body' => $_POST['body']
        ];

        // check if caller is logged in teacher
        $verified = $this->initialModel->verifyToken($data['token']);
        if($verified){
            // Set Data
            $res_data = $this->teachersModel->updateAssignment($data);

            // Load homepage / announcements view (api)
            $this->view($res_data);
        }else{
            // not logged in as teacher
            $err_msg = ['error' => 'you are not logged in as a teacher'];
            $this->view($err_msg);
        }

    }

    // delete assignment
    public function deleteAssignment($id) {

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Set token POST input
        $data = [
            'token' => $_POST['token']
        ];

        // check if caller is logged in teacher
        $verified = $this->initialModel->verifyToken($data['token']);
        if($verified){
            // Set Data
            $data = $this->teachersModel->deleteAssignment($id);

            // Load homepage / announcements view (api)
            $this->view($data);
        }else{
            // not logged in as teacher
            $err_msg = ['error' => 'you are not logged in as a teacher'];
            $this->view($err_msg);
        }

    }

    // list of assignments by TeacherID
    public function listAssignments($id) {

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Set token POST input
        $data = [
            'token' => $_POST['token']
        ];

        // check if caller is logged in teacher
        $verified = $this->initialModel->verifyToken($data['token']);
        if($verified){
            // Set Data
            $data = $this->teachersModel->listAssignments($id);

            // Load homepage / announcements view (api)
            $this->view($data);
        }else{
            // not logged in as teacher
            $err_msg = ['error' => 'you are not logged in as a teacher'];
            $this->view($err_msg);
        }

    }

    // list of student submissions for AssignmentID
    public function listSubmissions($id) {

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Set token POST input
        $data = [
            'token' => $_POST['token']
        ];

        // check if caller is logged in teacher
        $verified = $this->initialModel->verifyToken($data['token']);
        if($verified){
            // Set Data
            $data = $this->teachersModel->listSubmissions($id);

            // Load homepage / announcements view (api)
            $this->view($data);
        }else{
            // not logged in as teacher
            $err_msg = ['error' => 'you are not logged in as a teacher'];
            $this->view($err_msg);
        }

    }

    // update submission grade
    public function updateSubmission() {

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data = [
            'token' => $_POST['token'],
            'id' => trim($_POST['id']),
            'grade' => trim($_POST['grade'])
        ];

        // check if caller is logged in teacher
        $verified = $this->initialModel->verifyToken($data['token']);
        if($verified){


            // Set Data
            $res_data = $this->teachersModel->updateSubmission($data);

            // Load homepage / announcements view (api)
            $this->view($res_data);
        }else{
            // not logged in as teacher
            $err_msg = ['error' => 'you are not logged in as a teacher'];
            $this->view($err_msg);
        }

    }
}