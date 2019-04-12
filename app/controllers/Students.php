<?php
class Students extends Controller
{

    public function __construct(){
        $this->studentsModel = $this->model('Student');
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

        // inserting data in database and getting back students id
        $id = ["id" => $this->studentsModel->register($data)];

        // Loading students id to view
        $this->view($id);
    }

    public function login(){

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data from POST input
        $data = [
            'id' => trim($_POST['id']),
            'password' => trim($_POST['password'])
        ];

        // Getting back all info of student on success or false, storing it in $student
        $student = $this->studentsModel->login($data);
        
        if ($student) {
            $token = $this->initialModel->setToken($student->id, "student");
            $this->view( ['token' => $token, 'accountType' => 'student', 'id' => $student->id, 'name' => $student->name] );
        }else{
            // $student returned false
            $err_msg = ['error' => 'Incorrect StudentId/Password'];
            $this->view($err_msg);
        }
    }

    public function logout(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Delete token
        $token = $_POST['token'];
        $this->initialModel->clearToken($token);
    }

    // add new submission
    public function addSubmission() {

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data from POST input
        $data = [
            'token' => $_POST['token'],
            'studentid' => trim($_POST['studentid']),
            'assignmentid' => trim($_POST['assignmentid']),
            'text' => trim($_POST['text'])
        ];

        // check if caller is logged in student
        $verified = $this->initialModel->verifyToken($data['token']);
        if($verified){
            //Set Data
            $res_data = $this->studentsModel->addSubmission($data);

            // Load homepage / announcements view (api)
            $this->view($res_data);
        }else{
            // not logged in as student
            $err_msg = ['error' => 'you are not logged in as a student'];
            $this->view($err_msg);
        }

    }


    public function listAssignments() {
        
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Set token POST input
        $data = [
            'token' => $_POST['token']
        ];

        // check if caller is logged in student
        $verified = $this->initialModel->verifyToken($data['token']);
        if($verified){

            //Set Data
            $data = $this->studentsModel->listAssignments($verified->student_id);

            // Load homepage / announcements view (api)
            $this->view($data);
        }else{
            // not student
            $err_msg = ['error' => 'you are not logged in as a student'];
            $this->view($err_msg);
        }
    }

    // add new AnnouncementRead 
    public function addAnnouncementRead() {
        
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data from POST input
        $data = [
            'token' => $_POST['token'],
            'studentid' => trim($_POST['studentid']),
            'assignmentid' => trim($_POST['assignmentid'])
        ];

        // check if caller is logged in student
        $verified = $this->initialModel->verifyToken($data['token']);
        if($verified){
            //Set Data
            $res_data = $this->studentsModel->addAnnoucementRead($data);

            // Load homepage / announcements view (api)
            $this->view($res_data);
        }else{
            // not logged in as student
            $err_msg = ['error' => 'you are not logged in as a student'];
            $this->view($err_msg);
        }

    }

}