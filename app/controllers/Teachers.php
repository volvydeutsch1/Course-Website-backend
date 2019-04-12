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
            $_SESSION["account_type"] = "teacher";
            $_SESSION["teacher_id"] = $teacher->id;
            $_SESSION["teacher_name"] = $teacher->name;
            $this->view( ['accountType' => 'teacher', 'id' => $teacher->id, 'name' => $teacher->name] );
        }else{
            // $teacher returned false
            $err_msg = ['error' => 'Incorrect TeacherId/Password'];
            $this->view($err_msg);
        }
    }

    public function logout(){
        if(isset($_SESSION["teacher_id"])) {
            unset($_SESSION['account_type']);
            unset($_SESSION["teacher_id"]);
            unset($_SESSION["teacher_name"]);
            session_destroy();
        }
    }

    // add new announcement
    public function addAnnouncement() {

        // check if caller is logged in as teacher
        if(isset($_SESSION["teacher_id"])) {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'teacherid' => $_SESSION["teacher_id"],
                'body' => trim($_POST['body'])
            ];
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

        // check if caller is logged in as teacher
        if(isset($_SESSION["teacher_id"])) {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $_SESSION["id"],
                'teacherid' => $_SESSION["teacher_id"],
                'body' => trim($_POST['body'])
            ];
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

        // check if caller is logged in as teacher
        if(isset($_SESSION["teacher_id"])) {

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

        // check if caller is logged in as teacher
        if(isset($_SESSION["teacher_id"])) {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data =[
                'teacherid' => $_SESSION["teacher_id"],
                'subject' => trim($_POST['subject']),
                'releasedate' => trim($_POST['releasedate']),
                'duedate' => trim($_POST['duedate']),
                'body' => trim($_POST['body'])
            ];
            // Set Data
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

        // check if caller is logged in as teacher
        if(isset($_SESSION["teacher_id"])) {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data =[
                'id' => trim($_POST['id']),
                'teacherid' => trim($_POST['teacherid']),
                'subject' => trim($_POST['subject']),
                'releasedate' => trim($_POST['releasedate']),
                'duedate' => trim($_POST['duedate']),
                'body' => trim($_POST['body'])
            ];
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

    // delete announcement
    public function deleteAssignment($id) {

        // check if caller is logged in as teacher
        if(isset($_SESSION["teacher_id"])) {
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

        // check if caller is logged in as teacher
        if(isset($_SESSION["teacher_id"])) {
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

        // check if caller is logged in as teacher
        if(isset($_SESSION["teacher_id"])) {
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

        // check if caller is logged in as teacher
        if(isset($_SESSION["teacher_id"])) {

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'id' => trim($_POST['id']),
                'grade' => trim($_POST['grade'])
            ];

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